<?php
/**
/**
* @author NSHIMIRIMANA Révérien/+25768051821/rnshimirimana48@gmail.com

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");


class Logos extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->is_auth();
	}

	function is_auth()
	{
		if (empty($this->session->userdata('EMPLOYE_ID'))) {
			redirect(base_url(''));
		}
	}

	function index()
	{

		$data['page_title']="Logos";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';
		$this->load->view('Logos_view',$data);
	}

	function add()
	{
		$this->_validate();
		$CATEGORIE_DESC=$this->input->post('CATEGORIE_DESC');

		$data=array('CATEGORIE_DESC'=>$CATEGORIE_DESC);

		$this->Model->create('categories',$data);
		echo json_encode(array('status'=>true));

	}

	function update()
	{

		// $this->_validate();

		$LOGO_ID=$this->input->post('LOGO_ID');
	

		$photoreperatoire =FCPATH.'/uploads/logo';
		$photo_avatar="LOGO_".date('Ymdi');
		$LOGO_DESC= $_FILES['LOGO_DESC']['name'];
		$config['upload_path'] ='./uploads/logo/';
		$config['allowed_types'] = '*';
		$test = explode('.', $LOGO_DESC);
		$ext = end($test);
		$name = $photo_avatar.'.'.$ext;
		$config['file_name'] =$name;
          if(!is_dir($photoreperatoire)) //create the folder if it does not already exists   
          {
          	mkdir($photoreperatoire,0777,TRUE);

          } 

          $this->upload->initialize($config);
          $this->upload->do_upload('LOGO_DESC');

          if (!empty($_FILES['LOGO_DESC']['name'])) 
          {
          	$LOGO_DESC=$config['file_name'];
          }else
          {
          	$LOGO_DESC=$this->input->post('PHOTO');
          }
          
          $data_image=$this->upload->data();

          $this->Model->update('logo',array('LOGO_ID'=>$LOGO_ID),array('LOGO_DESC'=>$LOGO_DESC));

          echo json_encode(array("status" => TRUE));


      }



      function getOne($id)
      {
      	$data=$this->Model->getOne('logo',array('LOGO_ID'=>$id));
      	echo json_encode($data);
      }

      function supp_logic($id,$is_actif)
      {
      	$STATUT = ($is_actif==1) ? 0 : 1 ;
      	$this->Model->update('categories',array('CATEGORIE_ID'=>$id),array('STATUT'=>$STATUT));
      	echo json_encode(array('status'=>true));
      }


      function liste()
      {


      	$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

      	$query_principal="SELECT `LOGO_ID`, `LOGO_DESC`, `LIBELLE`,(CASE WHEN TYPE_LOGO=1 THEN 'Login' ELSE 'Entete' END)TYPE_LOGO FROM `logo` WHERE 1";

      	$order_column=array("LOGO_DESC","LIBELLE","");

      	$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY LIBELLE  ASC';

      	$search = !empty($_POST['search']['value']) ? (" AND  (LIBELLE LIKE '%$var_search%') ") : '';

      	$limit='LIMIT 0,10';
      	if($_POST['length'] != -1){
      		$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
      	}


      	$critaire="";
      	$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
      	$query_filter = $query_principal.' '.$critaire.' '.$search;



      	$fetch_data = $this->Model->datatable($query_secondaire); 
      	$u=0; 
      	$data = array();

      	foreach ($fetch_data as $row) {


      		$sub_array = array();  

      		$sub_array[] = $row->LIBELLE;
      		$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_logo('.$row->LOGO_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>';

      		$data[] = $sub_array;
      	}

      	$output = array(
      		"draw" => intval($_POST['draw']),
      		"recordsTotal" =>$this->Model->all_data($query_principal),
      		"recordsFiltered" => $this->Model->filtrer($query_filter),
      		"data" => $data
      	);

      	echo json_encode($output);
      }







      function _validate()
      {
      	$data=array();
      	$data['error_string']=array();
      	$data['inputerror']=array();
      	$data['status']=true;

      	

      	if (empty($_FILES['LOGO_DESC']['name'])) 
      	{

      		$data['error_string'][]="Le champs est obligatoire";
      		$data['inputerror'][]="LOGO_DESC";
      		$data['status']=false;
      	}


      	


      	if ($data['status']==FALSE) 
      	{
			# code...
      		echo json_encode($data);
      		exit();
      	}
      }
  } 
  ?>