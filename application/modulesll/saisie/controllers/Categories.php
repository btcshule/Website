<?php
/**
  * 
  */

/**
* @author NSHIMIRIMANA Révérien/+25768051821/rnshimirimana48@gmail.com
 ---gestion des fournisseurs---
*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");


 class Categories extends CI_Controller
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

 		$data['page_title']="Catégories";
 		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
 		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
 		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
 		<li class="breadcrumb-item"><a href="#">Library</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Data</li>
 		</ol>
 		</nav>';

 		$data['groupes']=$this->Model->getRequete("SELECT `GROUPE_ID`, `GROUPE_DESC` FROM `groupe` WHERE 1 ORDER BY GROUPE_DESC ASC");

 		$this->load->view('Categories_view',$data);
 	}

 	function add()
 	{
 		$this->_validate();
 		$DESC_FAMILLE=$this->input->post('DESC_FAMILLE');
 		$GROUPE_ID=$this->input->post('GROUPE_ID');
 		$DATE_CREATION=date('Y-m-d H:i:s');

 		$data=array('DESC_FAMILLE'=>$DESC_FAMILLE,'GROUPE_ID'=>$GROUPE_ID,'DATE_CREATION'=>$DATE_CREATION);

 		$this->Model->create('famille',$data);
 		echo json_encode(array('status'=>true));

 	}

 	function update()
 	{
 		$this->_validate();
 		$FAMILLE_ID=$this->input->post('FAMILLE_ID');
 		$GROUPE_ID=$this->input->post('GROUPE_ID');
 		$DESC_FAMILLE=$this->input->post('DESC_FAMILLE');

 		$data=array('DESC_FAMILLE'=>$DESC_FAMILLE,'GROUPE_ID'=>$GROUPE_ID);

 		$this->Model->update('famille',array('FAMILLE_ID'=>$FAMILLE_ID),$data);
 		echo json_encode(array('status'=>true));

 	}

 	function getOne($id)
 	{
 		$data=$this->Model->getOne('famille',array('FAMILLE_ID'=>$id));
 		echo json_encode($data);
 	}

 	function supp_logic($id,$is_actif)
 	{
 		$IS_ACTIVE = ($is_actif==1) ? 0 : 1 ;
 		$this->Model->update('famille',array('FAMILLE_ID'=>$id),array('IS_ACTIVE'=>$IS_ACTIVE));
 		echo json_encode(array('status'=>true));
 	}


 	function liste()
 	{


 		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 		$query_principal="SELECT `FAMILLE_ID`, `DESC_FAMILLE`,DATE_CREATION,IS_ACTIVE,g.GROUPE_DESC, (CASE WHEN IS_ACTIVE=1 THEN 'Active' ELSE 'Inactive' END) STATUT FROM famille f LEFT JOIN groupe g ON g.GROUPE_ID=f.GROUPE_ID WHERE 1";

 		$order_column=array("DESC_FAMILLE","g.GROUPE_DESC","DATE_CREATION","(CASE WHEN IS_ACTIVE=1 THEN 'Active' ELSE 'Inactive' END)","");

 		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DESC_FAMILLE  DESC';

 		$search = !empty($_POST['search']['value']) ? (" AND  (DESC_FAMILLE LIKE '%$var_search%' OR (CASE WHEN IS_ACTIVE=1 THEN 'Active' ELSE 'Inactive' END) LIKE '%var_search%' OR g.GROUPE_DESC LIKE '%$var_search%' OR DATE_CREATION LIKE '%$var_search%') ") : '';

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

 			$sub_array[] = $row->DESC_FAMILLE;
 			$sub_array[] = $row->GROUPE_DESC;
 			$sub_array[] =date('d-m-Y H:i:s',strtotime($row->DATE_CREATION));
 			$sub_array[] = ($row->IS_ACTIVE==1) ? '<span class="badge bg-success">'.$row->STATUT.'</span>' : '<span class="badge bg-danger">'.$row->STATUT.'</span>';
 			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_fam('.$row->FAMILLE_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 			<a href="javascript:void(0);" onclick="supp_logic('.$row->FAMILLE_ID.','.$row->IS_ACTIVE.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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

 		$check_fam=$this->Model->getOne('famille',array('DESC_FAMILLE'=>$this->input->post('DESC_FAMILLE'),'FAMILLE_ID!='=>$this->input->post('FAMILLE_ID')));


 		if ($this->input->post('DESC_FAMILLE')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="DESC_FAMILLE";
 			$data['status']=false;
 		}

 		if ($this->input->post('GROUPE_ID')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="GROUPE_ID";
 			$data['status']=false;
 		}

 		
 		if ($check_fam) {
  			# code...
 			$data['error_string'][]="La catégorie existe déjà";
 			$data['inputerror'][]="DESC_FAMILLE";
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