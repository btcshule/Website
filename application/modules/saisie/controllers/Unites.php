<?php
/**
/**
* @author NSHIMIRIMANA Révérien/+25768051821/rnshimirimana48@gmail.com
 ---gestion des fournisseurs---
*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");


 class Unites extends CI_Controller
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

 		$data['page_title']="Unités";
 		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
 		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
 		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
 		<li class="breadcrumb-item"><a href="#">Library</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Data</li>
 		</ol>
 		</nav>';
 		$this->load->view('Unites_view',$data);
 	}

 	function add()
 	{
 		$this->_validate();
 		$UNITE_DESC=trim($this->input->post('UNITE_DESC'));
 		$DATE_CREATION=date('Y-m-d H:i:s');

 		$data=array('UNITE_DESC'=>$UNITE_DESC,'DATE_CREATION'=>$DATE_CREATION);

 		$this->Model->create('unites',$data);
 		echo json_encode(array('status'=>true));

 	}

 	function update()
 	{
 		$this->_validate();
 		$UNITE_ID=$this->input->post('UNITE_ID');
 		$UNITE_DESC=trim($this->input->post('UNITE_DESC'));

 		$data=array('UNITE_DESC'=>$UNITE_DESC,'IS_ACTIVE'=>0);

 		$this->Model->update('unites',array('UNITE_ID'=>$UNITE_ID),$data);
 		echo json_encode(array('status'=>true));

 	}

 	function getOne($id)
 	{
 		$data=$this->Model->getOne('unites',array('UNITE_ID'=>$id));
 		echo json_encode($data);
 	}

 	function supp_logic($id,$is_actif)
 	{

 		if ($is_actif==0) {
 			# code...
 			$IS_ACTIVE = 2;
 		}elseif ($is_actif==1) {
 			# code...
 			$IS_ACTIVE = 2;
 		}else{
 			$IS_ACTIVE = 0;
 		}

 		$this->Model->update('unites',array('UNITE_ID'=>$id),array('IS_ACTIVE'=>$IS_ACTIVE));
 		echo json_encode(array('status'=>true));
 	}


 	function confirm_item($id,$stat)
 	{

 		$this->Model->update('unites',array('UNITE_ID'=>$id),array('IS_ACTIVE'=>1));
 		echo json_encode(array('status'=>true));
 	}


 	function liste()
 	{


 		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 		$query_principal="SELECT `UNITE_ID`, `UNITE_DESC`, `DATE_CREATION`,IS_ACTIVE,(CASE WHEN IS_ACTIVE=0 THEN 'En attente de validation' WHEN IS_ACTIVE=1 THEN 'Validée' WHEN IS_ACTIVE=2 THEN 'Annulé' END)STATUT FROM `unites` WHERE 1";

 		$order_column=array("UNITE_DESC","DATE_CREATION","(CASE WHEN IS_ACTIVE=0 THEN 'En attente de validation' WHEN IS_ACTIVE=1 THEN 'Validée' WHEN IS_ACTIVE=2 THEN 'Annulé' END)","");

 		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY UNITE_DESC  ASC';

 		$search = !empty($_POST['search']['value']) ? (" AND  (UNITE_DESC LIKE '%$var_search%' OR (CASE WHEN IS_ACTIVE=0 THEN 'En attente de validation' WHEN IS_ACTIVE=1 THEN 'Validée' WHEN IS_ACTIVE=2 THEN 'Annulé' END) LIKE '%var_search%' OR DATE_CREATION LIKE '%$var_search%') ") : '';

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
 			$option='';  

 			$sub_array[] = $row->UNITE_DESC;
 			$sub_array[] =date('d-m-Y H:i:s',strtotime($row->DATE_CREATION));


 			if ($row->IS_ACTIVE==0) {
 				# code...
 				$sub_array[] ='<span class="badge bg-primary">'.$row->STATUT.'</span>';
 			}elseif ($row->IS_ACTIVE==1) {
 				# code...
 				$sub_array[] = '<span class="badge bg-success">'.$row->STATUT.'</span>';
 			}else{
 				$sub_array[] = '<span class="badge bg-danger">'.$row->STATUT.'</span>';
 			}


 			$statut_trait="";

 			$condi=($this->session->userdata('UNITE_VALIDEUR')==1) ? 'onclick="confirm_item('.$row->UNITE_ID.','.$row->IS_ACTIVE.')"' : '';

 			# code...
 			if ($row->IS_ACTIVE==0) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);" '.$condi.' style="color:blue;" title="Valider"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span></a>';

 			}elseif ($row->IS_ACTIVE==1) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);" style="color:blue;" title="Déjà validée"><i class="mdi mdi-checkbox-marked-circle"></i></a>';
 			}elseif ($row->IS_ACTIVE==2) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);"  style="color:black;" title="Annulé"><span class="mdi mdi-alert" aria-hidden="true"></span></a>';
 			}



 			if ($this->session->userdata('UNITE_VALIDEUR')==1) {

 				$option.='<a href="javascript:void(0);" style="color:green;" onclick="edit_unite('.$row->UNITE_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 				<a href="javascript:void(0);" onclick="supp_logic('.$row->UNITE_ID.','.$row->IS_ACTIVE.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>'.$statut_trait;
 			}else{

 				$option.=$statut_trait;
 			}




 			$sub_array[] = $option;

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

 		$check_marq=$this->Model->getOne('unites',array('UNITE_DESC'=>$this->input->post('UNITE_DESC'),'UNITE_ID!='=>$this->input->post('UNITE_ID')));


 		if ($this->input->post('UNITE_DESC')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="UNITE_DESC";
 			$data['status']=false;
 		}

 		
 		if ($check_marq) {
  			# code...
 			$data['error_string'][]="L'unité existe déjà";
 			$data['inputerror'][]="UNITE_DESC";
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