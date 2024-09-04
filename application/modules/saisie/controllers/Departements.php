<?php 
/**
/**
* @author NSHIMIRIMANA Révérien/+25768051821/rnshimirimana48@gmail.com

*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");


class Departements extends CI_Controller
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

 		$data['page_title']="Unité d'organisations";
 		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
 		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
 		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
 		<li class="breadcrumb-item"><a href="#">Library</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Data</li>
 		</ol>
 		</nav>';
 		$this->load->view('Departements_view',$data);
 	}

 	function add()
 	{
 		$this->_validate();
 		$DESC_DEPARTEMENT=$this->input->post('DESC_DEPARTEMENT');

 		$data=array('DESC_DEPARTEMENT'=>$DESC_DEPARTEMENT);

 		$this->Model->create('departement',$data);
 		echo json_encode(array('status'=>true));

 	}

 	function update()
 	{
 		$this->_validate();
 		$DEPARTEMENT_ID=$this->input->post('DEPARTEMENT_ID');
 		$DESC_DEPARTEMENT=$this->input->post('DESC_DEPARTEMENT');

 		$data=array('DESC_DEPARTEMENT'=>$DESC_DEPARTEMENT,'STATUT'=>0);

 		$this->Model->update('departement',array('DEPARTEMENT_ID'=>$DEPARTEMENT_ID),$data);
 		echo json_encode(array('status'=>true));

 	}

 	function getOne($id)
 	{
 		$data=$this->Model->getOne('departement',array('DEPARTEMENT_ID'=>$id));
 		echo json_encode($data);
 	}

 	// function supp_logic($id,$is_actif)
 	// {
 	// 	$STATUT = ($is_actif==1) ? 0 : 1 ;
 	// 	$this->Model->update('departement',array('DEPARTEMENT_ID'=>$id),array('STATUT'=>$STATUT));
 	// 	echo json_encode(array('status'=>true));
 	// }



 	function supp_logic($id,$is_actif)
 	{
 		if ($is_actif==0) {
 			# code...
 			$STATUT = 2;
 		}elseif ($is_actif==1) {
 			# code...
 			$STATUT = 2;
 		}else{
 			$STATUT = 0;
 		}

 		$this->Model->update('departement',array('DEPARTEMENT_ID'=>$id),array('STATUT'=>$STATUT));
 		echo json_encode(array('status'=>true));
 	}

 	function confirm_item($id,$stat)
 	{

 		$this->Model->update('departement',array('DEPARTEMENT_ID'=>$id),array('STATUT'=>1));
 		echo json_encode(array('status'=>true));
 	}

 	function liste()
 	{


 		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 		$query_principal="SELECT `DEPARTEMENT_ID`, `DESC_DEPARTEMENT`,(CASE WHEN STATUT=0 THEN 'En attente de validation' WHEN STATUT=1 THEN 'Validée' WHEN STATUT=2 THEN 'Annulé' END)STAT, `STATUT` FROM `departement` WHERE 1";

 		$order_column=array("DESC_DEPARTEMENT","(CASE WHEN STATUT=0 THEN 'En attente de validation' WHEN STATUT=1 THEN 'Validée' WHEN STATUT=2 THEN 'Annulé' END)","");

 		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DESC_DEPARTEMENT  ASC';

 		$search = !empty($_POST['search']['value']) ? (" AND  (DESC_DEPARTEMENT LIKE '%$var_search%' OR (CASE WHEN STATUT=0 THEN 'En attente de validation' WHEN STATUT=1 THEN 'Validée' WHEN STATUT=2 THEN 'Annulé' END) LIKE '%var_search%') ") : '';

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

 			$sub_array[] = $row->DESC_DEPARTEMENT;


 			if ($row->STATUT==0) {
 				# code...
 				$sub_array[] ='<span class="badge bg-primary">'.$row->STAT.'</span>';
 			}elseif ($row->STATUT==1) {
 				# code...
 				$sub_array[] = '<span class="badge bg-success">'.$row->STAT.'</span>';
 			}else{
 				$sub_array[] = '<span class="badge bg-danger">'.$row->STAT.'</span>';
 			}



 			$statut_trait="";
 			$condi=($this->session->userdata('STR_DEPARTEMENT_VALIDEUR')==1) ? 'onclick="confirm_item('.$row->DEPARTEMENT_ID.','.$row->STATUT.')"' : '';

 			# code...
 			if ($row->STATUT==0) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);" '.$condi.' style="color:blue;" title="Valider"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span></a>';

 			}elseif ($row->STATUT==1) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);" style="color:blue;" title="Déjà validée"><i class="mdi mdi-checkbox-marked-circle"></i></a>';
 			}elseif ($row->STATUT==2) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);"  style="color:black;" title="Annulé"><span class="mdi mdi-alert" aria-hidden="true"></span></a>';
 			}



 			if ($this->session->userdata('STR_DEPARTEMENT_VALIDEUR')==1) {

 				$option.='<a href="javascript:void(0);" style="color:green;" onclick="edit_agence('.$row->DEPARTEMENT_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 				<a href="javascript:void(0);" onclick="supp_logic('.$row->DEPARTEMENT_ID.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>'.$statut_trait;
 			}else{

 				$option.=$statut_trait;
 			}

 			$sub_array[]=$option;

 			// $sub_array[] = ($row->STATUT==0) ? '<span class="badge bg-success">'.$row->STAT.'</span>' : '<span class="badge bg-danger">'.$row->STAT.'</span>';
 			// $sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_agence('.$row->DEPARTEMENT_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 			// <a href="javascript:void(0);" onclick="supp_logic('.$row->DEPARTEMENT_ID.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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

 		$check_dep=$this->Model->getOne('departement',array('DESC_DEPARTEMENT'=>$this->input->post('DESC_DEPARTEMENT'),'DEPARTEMENT_ID!='=>$this->input->post('DEPARTEMENT_ID')));


 		if ($this->input->post('DESC_DEPARTEMENT')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="DESC_DEPARTEMENT";
 			$data['status']=false;
 		}

 		
 		if ($check_dep) {
  			# code...
 			$data['error_string'][]="Le département existe déjà";
 			$data['inputerror'][]="DESC_DEPARTEMENT";
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