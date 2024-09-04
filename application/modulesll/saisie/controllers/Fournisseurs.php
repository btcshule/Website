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


 class Fournisseurs extends CI_Controller
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

 		$data['page_title']="Fournisseurs";
 		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
 		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
 		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
 		<li class="breadcrumb-item"><a href="#">Library</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Data</li>
 		</ol>
 		</nav>';
 		$this->load->view('Fournisseurs_view',$data);
 	}

 	function add()
 	{
 		$this->_validate();
 		$NOM_FOURN=$this->input->post('NOM_FOURN');
 		$TEL_FOURN=$this->input->post('TEL_FOURN');
 		$ADRESSE=$this->input->post('ADRESSE');
 		$NIF=$this->input->post('NIF');
 		$EMAIL_FOURN=$this->input->post('EMAIL_FOURN');
 		$DATE_CREATION=date('Y-m-d H:i:s');
 		$USER_ID=$this->session->userdata('EMPLOYE_ID');

 		$datas=array('NOM_FOURN'=>$NOM_FOURN,'NIF'=>$NIF,'EMAIL_FOURN'=>$EMAIL_FOURN,'TEL_FOURN'=>$TEL_FOURN,'ADRESSE'=>$ADRESSE,'DATE_CREATION'=>$DATE_CREATION,'USER_ID'=>$USER_ID);

 		$this->Model->create('fournisseur',$datas);
 		echo json_encode(array('status'=>true));

 	}

 	function update()
 	{
 		$this->_validate();
 		$FOURN_ID=$this->input->post('FOURN_ID');
 		$NOM_FOURN=$this->input->post('NOM_FOURN');
 		$TEL_FOURN=$this->input->post('TEL_FOURN');
 		$ADRESSE=$this->input->post('ADRESSE');
 		$NIF=$this->input->post('NIF');
 		$EMAIL_FOURN=$this->input->post('EMAIL_FOURN');


 		$data=array('NOM_FOURN'=>$NOM_FOURN,'EMAIL_FOURN'=>$EMAIL_FOURN,'NIF'=>$NIF,'TEL_FOURN'=>$TEL_FOURN,'ADRESSE'=>$ADRESSE,'IS_ACTIF_FOURN'=>0);

 		$this->Model->update('fournisseur',array('FOURN_ID'=>$FOURN_ID),$data);
 		echo json_encode(array('status'=>true));

 	}

 	function getOne($id)
 	{
 		$data=$this->Model->getOne('fournisseur',array('FOURN_ID'=>$id));
 		echo json_encode($data);
 	}

 	// function supp_logic($id,$is_actif)
 	// {
 	// 	$IS_ACTIF_FOURN = ($is_actif==1) ? 0 : 1 ;
 	// 	$this->Model->update('fournisseur',array('FOURN_ID'=>$id),array('IS_ACTIF_FOURN'=>$IS_ACTIF_FOURN));
 	// 	echo json_encode(array('status'=>true));
 	// }


 	function supp_logic($id,$is_actif)
 	{
 		if ($is_actif==0) {
 			# code...
 			$IS_ACTIF_FOURN = 2;
 		}elseif ($is_actif==1) {
 			# code...
 			$IS_ACTIF_FOURN = 2;
 		}else{
 			$IS_ACTIF_FOURN = 0;
 		}

 		$this->Model->update('fournisseur',array('FOURN_ID'=>$id),array('IS_ACTIF_FOURN'=>$IS_ACTIF_FOURN));
 		echo json_encode(array('status'=>true));
 	}

 	function confirm_item($id,$stat)
 	{

 		$this->Model->update('fournisseur',array('FOURN_ID'=>$id),array('IS_ACTIF_FOURN'=>1));
 		echo json_encode(array('status'=>true));
 	}


 	function liste()
 	{


 		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 		$query_principal="SELECT
 		`FOURN_ID`,
 		`NOM_FOURN`,
 		NIF,
 		CONCAT(TEL_FOURN,'<br>',EMAIL_FOURN) CONTACTS,
 		ADRESSE,
 		IS_ACTIF_FOURN,
 		(CASE WHEN IS_ACTIF_FOURN=0 THEN 'En attente de validation' WHEN IS_ACTIF_FOURN=1 THEN 'Validée' WHEN IS_ACTIF_FOURN=2 THEN 'Annulé' END)STATUT,
 		`USER_ID`,
 		`DATE_CREATION`
 		FROM
 		`fournisseur`
 		WHERE 1";

 		$order_column=array("NOM_FOURN","CONCAT(TEL_FOURN,'<br>',EMAIL_FOURN)","ADRESSE","NIF","DATE_CREATION","(CASE WHEN IS_ACTIF_FOURN=0 THEN 'En attente de validation' WHEN IS_ACTIF_FOURN=1 THEN 'Validée' WHEN IS_ACTIF_FOURN=2 THEN 'Annulé' END)","");

 		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY NOM_FOURN  DESC';

 		$search = !empty($_POST['search']['value']) ? (" AND  (NOM_FOURN LIKE '%$var_search%'  OR CONCAT(TEL_FOURN,'<br>',EMAIL_FOURN) LIKE '%$var_search%' OR (CASE WHEN IS_ACTIF_FOURN=0 THEN 'En attente de validation' WHEN IS_ACTIF_FOURN=1 THEN 'Validée' WHEN IS_ACTIF_FOURN=2 THEN 'Annulé' END) LIKE '%var_search%'  OR DATE_CREATION LIKE '%$var_search%' OR ADRESSE LIKE '%$var_search%' OR NIF LIKE '%$var_search%') ") : '';

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


 			



 			$sub_array[] = $row->NOM_FOURN/*.$this->session->userdata('FOURN_VALIDEUR')*/;
 			$sub_array[] = $row->CONTACTS;
 			$sub_array[] = $row->ADRESSE;
 			$sub_array[] = $row->NIF;
 			$sub_array[] =date('d-m-Y H:i:s',strtotime($row->DATE_CREATION));
 			if ($row->IS_ACTIF_FOURN==0) {
 				# code...
 				$sub_array[] ='<span class="badge bg-primary">'.$row->STATUT.'</span>';
 			}elseif ($row->IS_ACTIF_FOURN==1) {
 				# code...
 				$sub_array[] = '<span class="badge bg-success">'.$row->STATUT.'</span>';
 			}else{
 				$sub_array[] = '<span class="badge bg-danger">'.$row->STATUT.'</span>';
 			}


 			$statut_trait="";
 			$option="";

 			$condi=($this->session->userdata('FOURN_VALIDEUR')==1) ? 'onclick="confirm_item('.$row->FOURN_ID.','.$row->IS_ACTIF_FOURN.')"' : '';

 			# code...
 			if ($row->IS_ACTIF_FOURN==0) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);" '.$condi.' style="color:blue;" title="Valider"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span></a>';

 			}elseif ($row->IS_ACTIF_FOURN==1) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);" style="color:blue;" title="Déjà validée"><i class="mdi mdi-checkbox-marked-circle"></i></a>';
 			}elseif ($row->IS_ACTIF_FOURN==2) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);"  style="color:black;" title="Annulé"><span class="mdi mdi-alert" aria-hidden="true"></span></a>';
 			}



 			if ($this->session->userdata('FOURN_VALIDEUR')==1) {

 				$option.='<a href="javascript:void(0);" style="color:green;" onclick="edit_fourni('.$row->FOURN_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 				<a href="javascript:void(0);" onclick="supp_logic('.$row->FOURN_ID.','.$row->IS_ACTIF_FOURN.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>'.$statut_trait;
 			}else{

 				$option.=$statut_trait;
 			}


 			// $sub_array[] = ($row->IS_ACTIF_FOURN==1) ? '<span class="badge bg-success">'.$row->STATUT.'</span>' : '<span class="badge bg-danger">'.$row->STATUT.'</span>';
 			// $sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_fourni('.$row->FOURN_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 			// <a href="javascript:void(0);" onclick="supp_logic('.$row->FOURN_ID.','.$row->IS_ACTIF_FOURN.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

 			$sub_array[]=$option;

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

		$regex_email = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		$regex_nif='/^[1-9][0-9]{9}$/';

 		$id=$this->input->post('FOURN_ID');
 		$tel=$this->input->post('TEL_FOURN');
 		$nif=$this->input->post('NIF');
 		$email=$this->input->post('EMAIL_FOURN');

 		$check_tel=$this->Model->getOne('fournisseur',array('TEL_FOURN'=>$tel,'FOURN_ID!='=>$id));
 		$check_nif=$this->Model->getOne('fournisseur',array('NIF'=>$nif,'FOURN_ID!='=>$id));


 		if ($this->input->post('NOM_FOURN')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="NOM_FOURN";
 			$data['status']=false;
 		}

 		if ((!preg_match($regex_email,$email)) && !empty($email)) {
			$data['inputerror'][]='EMAIL_FOURN';
			$data['error_string'][]='L\'email est invalide!';
			$data['status']=FALSE;
		}

 		if ($this->input->post('NIF')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="NIF";
 			$data['status']=false;
 		}

 		if (!empty($check_nif) && ($nif!="" || $nif!=NULL )) {
         # code...
			$data['error_string'][]="Le NIF ".$this->input->post('NIF')." existe déjà";
			$data['inputerror'][]="NIF";
			$data['status']=FALSE;
		} 

		if (strlen($nif)<>10) {
            # code...
			$data['error_string'][]="Le NIF est invalide!";
			$data['inputerror'][]="NIF";
			$data['status']=false;
		}


 		if ($this->input->post('TEL_FOURN')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="TEL_FOURN";
 			$data['status']=false;
 		}

 		if ($this->input->post('ADRESSE')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="ADRESSE";
 			$data['status']=false;
 		}

 		

 		if (strlen($this->input->post('TEL_FOURN'))<8 && !empty($this->input->post('TEL_FOURN'))) {
			# code...
 			$data['error_string'][]="Le numéro est trop court";
 			$data['inputerror'][]="TEL_FOURN";
 			$data['status']=false;
 		}

 		if ($check_tel) {
  			# code...
 			$data['error_string'][]="Le téléphone existe déjà";
 			$data['inputerror'][]="TEL_FOURN";
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