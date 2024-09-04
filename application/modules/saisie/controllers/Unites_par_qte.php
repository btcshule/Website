<?php
/**
/**
* @author NSHIMIRIMANA Révérien/+25768051821/rnshimirimana48@gmail.com
 ---gestion des fournisseurs---
*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");


 class Unites_par_qte extends CI_Controller
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

 		$data['page_title']="Unité par quantité";
 		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
 		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
 		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
 		<li class="breadcrumb-item"><a href="#">Library</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Data</li>
 		</ol>
 		</nav>';

 		
 		
 		$this->load->view('Unites_par_qte_view',$data);
 	}

 	function add()
 	{
 		$this->_validate();
 		$UNITE_QTE_DESC=trim($this->input->post('UNITE_QTE_DESC'));

 		$data=array('UNITE_QTE_DESC'=>$UNITE_QTE_DESC);

 		$this->Model->create('unite_par_qte',$data);
 		echo json_encode(array('status'=>true));

 	}

 	function update()
 	{
 		$this->_validate();
 		$UNITE_QTE_ID=$this->input->post('UNITE_QTE_ID');
 		$UNITE_QTE_DESC=trim($this->input->post('UNITE_QTE_DESC'));

 		$data=array('UNITE_QTE_DESC'=>$UNITE_QTE_DESC,'STATUT'=>0);

 		$this->Model->update('unite_par_qte',array('UNITE_QTE_ID'=>$UNITE_QTE_ID),$data);
 		echo json_encode(array('status'=>true));

 	}

 	function getOne($id)
 	{
 		$data=$this->Model->getOne('unite_par_qte',array('UNITE_QTE_ID'=>$id));
 		echo json_encode($data);
 	}

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

 		$this->Model->update('unite_par_qte',array('UNITE_QTE_ID'=>$id),array('STATUT'=>$STATUT));
 		echo json_encode(array('status'=>true));
 	}


 	function confirm_item($id,$stat)
 	{

 		$this->Model->update('unite_par_qte',array('UNITE_QTE_ID'=>$id),array('STATUT'=>1));
 		echo json_encode(array('status'=>true));
 	}


 	function liste()
 	{


 		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 		$query_principal="SELECT `UNITE_QTE_ID`, `UNITE_QTE_DESC`,STATUT,(CASE WHEN STATUT=0 THEN 'En attente de validation' WHEN STATUT=1 THEN 'Validée' WHEN STATUT=2 THEN 'Annulé' END) STATUT_U FROM `unite_par_qte` WHERE 1";

 		$order_column=array("UNITE_QTE_DESC","(CASE WHEN STATUT=0 THEN 'En attente de validation' WHEN STATUT=1 THEN 'Validée' WHEN STATUT=2 THEN 'Annulé' END)","");

 		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY UNITE_QTE_DESC  ASC';

 		$search = !empty($_POST['search']['value']) ? (" AND  (UNITE_QTE_DESC LIKE '%$var_search%' OR (CASE WHEN STATUT=0 THEN 'En attente de validation' WHEN STATUT=1 THEN 'Validée' WHEN STATUT=2 THEN 'Annulé' END) LIKE '%var_search%') ") : '';

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

 			$sub_array[] = $row->UNITE_QTE_DESC;

 			if ($row->STATUT==0) {
 				# code...
 				$sub_array[] ='<span class="badge bg-primary">'.$row->STATUT_U.'</span>';
 			}elseif ($row->STATUT==1) {
 				# code...
 				$sub_array[] = '<span class="badge bg-success">'.$row->STATUT_U.'</span>';
 			}else{
 				$sub_array[] = '<span class="badge bg-danger">'.$row->STATUT_U.'</span>';
 			}


 			$statut_trait="";

 			$condi=($this->session->userdata('UNITE_PAR_QTE_VALIDEUR')==1) ? 'onclick="confirm_item('.$row->UNITE_QTE_ID.','.$row->STATUT.')"' : '';

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



 			if ($this->session->userdata('UNITE_PAR_QTE_VALIDEUR')==1) {

 				$option.='<a href="javascript:void(0);" style="color:green;" onclick="edit_unite('.$row->UNITE_QTE_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 			<a href="javascript:void(0);" onclick="supp_logic('.$row->UNITE_QTE_ID.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>'.$statut_trait;
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

 		$check_items=$this->Model->getOne('unite_par_qte',array('UNITE_QTE_DESC'=>$this->input->post('UNITE_QTE_DESC'),'UNITE_QTE_ID!='=>$this->input->post('UNITE_QTE_ID')));


 		if ($this->input->post('UNITE_QTE_DESC')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="UNITE_QTE_DESC";
 			$data['status']=false;
 		}

 		
 		if ($check_items) {
  			# code...
 			$data['error_string'][]="L'élément existe déjà";
 			$data['inputerror'][]="UNITE_QTE_DESC";
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