<?php
/**
* @author NSHIMIRIMANA Révérien/+25768051821/rnshimirimana48@gmail.com
 ---gestion des employes---
*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");

 class Employes extends CI_Controller
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
 		$data['page_title']="Employés";
 		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
 		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
 		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
 		<li class="breadcrumb-item"><a href="#">Library</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Data</li>
 		</ol>
 		</nav>';
 		$data['profil']="";
 		$this->load->view('Employes_view',$data);
 	}

 	function add()
 	{
 		$this->_validate();

 		$NOM_EMP=$this->input->post('NOM_EMP');
 		$PRENOM_EMP=$this->input->post('PRENOM_EMP');
 		$MATRICULE=$this->input->post('MATRICULE');
 		$PROFILE_ID=$this->input->post('PROFILE_ID');
 		$DEPARTEMENT_ID=$this->input->post('DEPARTEMENT_ID');
 		$AGENCE_ID=$this->input->post('AGENCE_ID');
 		$EMAIL_EMP=(empty($this->input->post('EMAIL_EMP'))) ? NULL : $this->input->post('EMAIL_EMP');
 		$IS_USER_SYSTEM=($this->input->post('IS_USER_SYSTEM')==NULL) ? 0 : $this->input->post('IS_USER_SYSTEM');

 		// print_r($IS_USER_SYSTEM);die();
 		$USER_ID=$this->session->userdata('EMPLOYE_ID');
 		$DATE_CREATION=date('Y-m-d H:i:s');

 		$MOT_DE_PASSE = ($IS_USER_SYSTEM==1) ? md5(trim($this->input->post('MATRICULE'))) : NULL ;

 		$data=array('NOM_EMP'=>trim($NOM_EMP),'AGENCE_ID'=>$AGENCE_ID,'PRENOM_EMP'=>trim($PRENOM_EMP),'MATRICULE'=>trim($MATRICULE),'MOT_DE_PASSE'=>trim($MOT_DE_PASSE),'EMAIL_EMP'=>trim($EMAIL_EMP),'PROFILE_ID'=>$PROFILE_ID,'DEPARTEMENT_ID'=>$DEPARTEMENT_ID,'IS_USER_SYSTEM'=>$IS_USER_SYSTEM,'USER_ID'=>$USER_ID,'IS_MUST_CHANGE_PWD'=>1,'DATE_CREATION'=>$DATE_CREATION);

 		$this->Model->create('employes',$data);

 		echo json_encode(array('status'=>true));
 	}

 	function getOne($id)
 	{
 		$data=$this->Model->getOne('employes',array('EMPLOYE_ID'=>$id));
 		echo json_encode($data);
 	}
 	


 	function supp_logic($id,$is_actif)
 	{
 		if ($is_actif==0) {
 			# code...
 			$IS_ACTIF = 2;
 		}elseif ($is_actif==1) {
 			# code...
 			$IS_ACTIF = 2;
 		}else{
 			$IS_ACTIF = 0;
 		}

 		$this->Model->update('employes',array('EMPLOYE_ID'=>$id),array('IS_ACTIF'=>$IS_ACTIF));
 		echo json_encode(array('status'=>true));
 	}

 	function confirm_item($id,$stat)
 	{

 		$this->Model->update('employes',array('EMPLOYE_ID'=>$id),array('IS_ACTIF'=>1));
 		echo json_encode(array('status'=>true));
 	}




 	function update()
 	{
 		$this->_validate();

 		$EMPLOYE_ID=$this->input->post('EMPLOYE_ID');
 		$NOM_EMP=$this->input->post('NOM_EMP');
 		$PRENOM_EMP=$this->input->post('PRENOM_EMP');
 		$MATRICULE=$this->input->post('MATRICULE');
 		$PROFILE_ID=$this->input->post('PROFILE_ID');
 		$DEPARTEMENT_ID=$this->input->post('DEPARTEMENT_ID');
 		$AGENCE_ID=$this->input->post('AGENCE_ID');
 		$EMAIL_EMP=(empty($this->input->post('EMAIL_EMP'))) ? NULL : $this->input->post('EMAIL_EMP');

 		$data=array('NOM_EMP'=>trim($NOM_EMP),'PRENOM_EMP'=>trim($PRENOM_EMP),'AGENCE_ID'=>$AGENCE_ID,'MATRICULE'=>trim($MATRICULE),'PROFILE_ID'=>$PROFILE_ID,'IS_ACTIF'=>0,'DEPARTEMENT_ID'=>$DEPARTEMENT_ID,'EMAIL_EMP'=>trim($EMAIL_EMP));


 		$this->Model->update('employes',array('EMPLOYE_ID'=>$EMPLOYE_ID),$data);
 		$this->Model->update('menu_users',array('USER_ID'=>$EMPLOYE_ID),array('PROFIL_ID'=>$PROFILE_ID));

 		echo json_encode(array('status'=>true));
 	}



 	function liste()
 	{


 		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 		$query_principal="SELECT
 		em.EMPLOYE_ID,
 		CONCAT(em.NOM_EMP,' ',em.PRENOM_EMP) EMPLOYE,
 		em.IS_USER_SYSTEM,
 		em.EMAIL_EMP,
 		em.IS_ACTIF,
 		em.MATRICULE,
 		em.DATE_CREATION,
 		(CASE WHEN IS_ACTIF=0 THEN 'En attente de validation' WHEN IS_ACTIF=1 THEN 'Validée' WHEN IS_ACTIF=2 THEN 'Annulé' END)STATUT ,
 		p.DESC_PROFIL,
 		d.DESC_DEPARTEMENT,
 		CONCAT(a.AGENCE_NOM,'<br>',d.DESC_DEPARTEMENT)ORGANISATION
 		FROM
 		employes em
 		LEFT JOIN departement d ON
 		d.DEPARTEMENT_ID = em.DEPARTEMENT_ID
 		LEFT JOIN profil p ON
 		p.PROFILE_ID = em.PROFILE_ID
 		LEFT JOIN agences a ON
 		a.AGENCE_ID = em.AGENCE_ID
 		WHERE
 		1 ";

 		$order_column=array("CONCAT(em.NOM_EMP,' ',em.PRENOM_EMP)","em.MATRICULE","em.EMAIL_EMP","p.DESC_PROFIL","CONCAT(a.AGENCE_NOM,'<br>',d.DESC_DEPARTEMENT)","(CASE WHEN IS_ACTIF=0 THEN 'En attente de validation' WHEN IS_ACTIF=1 THEN 'Validée' WHEN IS_ACTIF=2 THEN 'Annulé' END)","");

 		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY em.EMPLOYE_ID  DESC';

 		$search = !empty($_POST['search']['value']) ? (" AND  (CONCAT(em.NOM_EMP,' ',em.PRENOM_EMP) LIKE '%$var_search%'  OR em.MATRICULE LIKE '%$var_search%' OR p.DESC_PROFIL LIKE '%var_search%' OR CONCAT(a.AGENCE_NOM,'<br>',d.DESC_DEPARTEMENT) LIKE '%$var_search%' OR em.DATE_CREATION LIKE '%$var_search%' OR em.EMAIL_EMP LIKE '%$var_search%'  OR (CASE WHEN IS_ACTIF=0 THEN 'En attente de validation' WHEN IS_ACTIF=1 THEN 'Validée' WHEN IS_ACTIF=2 THEN 'Annulé' END) LIKE '%$var_search%') ") : '';

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

 			$statut="";

 			if ($row->IS_ACTIF==0) {
 				# code...
 				$statut.='<span class="badge bg-primary">'.$row->STATUT.'</span>';
 			}elseif ($row->IS_ACTIF==1) {
 				# code...
 				$statut.= '<span class="badge bg-success">'.$row->STATUT.'</span>';
 			}else{
 				$statut.= '<span class="badge bg-danger">'.$row->STATUT.'</span>';
 			}




 			if ($this->session->userdata('EMPLOYE_PROFIL')==1) {
 				# code...
 				$sub_array[] = "<a href='".base_url('administration/Roles_Utilisateurs/index/'.$row->EMPLOYE_ID)."'>".$row->EMPLOYE.'<br>'.$row->EMAIL_EMP."</a>";
 			}else{
 				$sub_array[] = $row->EMPLOYE;
 			}
 			
 			$sub_array[] = $row->MATRICULE;
 			// $sub_array[] = $row->EMAIL_EMP;
 			$sub_array[] = $row->DESC_PROFIL;
 			$sub_array[] = $row->ORGANISATION;
 			// $sub_array[] =date('d-m-Y H:i:s',strtotime($row->DATE_CREATION));
 			$sub_array[] = $statut;


 			$statut_trait="";
 			$option="";

 			$condi=($this->session->userdata('EMPLOYE_VALIDEUR')==1) ? 'onclick="confirm_item('.$row->EMPLOYE_ID.','.$row->IS_ACTIF.')"' : '';

 			# code...
 			if ($row->IS_ACTIF==0) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);" '.$condi.' style="color:blue;" title="Valider"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span></a>';

 			}elseif ($row->IS_ACTIF==1) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);" style="color:blue;" title="Déjà validée"><i class="mdi mdi-checkbox-marked-circle"></i></a>';
 			}elseif ($row->IS_ACTIF==2) {
 					# code...
 				$statut_trait.='<a href="javascript:void(0);"  style="color:black;" title="Annulé"><span class="mdi mdi-alert" aria-hidden="true"></span></a>';
 			}



 			if ($this->session->userdata('EMPLOYE_VALIDEUR')==1) {

 				$option.='<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->EMPLOYE_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 				<a href="javascript:void(0);" onclick="supp_logic('.$row->EMPLOYE_ID.','.$row->IS_ACTIF.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>'.$statut_trait;
 			}else{

 				$option.=$statut_trait;
 			}
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


 	function view_detail($EMPLOYE_ID)
 	{

 		$data['page_title']="Détail ";
 		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
 		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
 		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
 		<li class="breadcrumb-item"><a href="#">Library</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Data</li>
 		</ol>
 		</nav>';
 		$data['profil']=$this->Model->getRequete("SELECT `PROFILE_ID`, `DESC_PROFIL` FROM `profil` WHERE 1 ORDER BY DESC_PROFIL ASC");
 		$data['depts']=$this->Model->getRequete("SELECT `DEPARTEMENT_ID`, `DESC_DEPARTEMENT`, `STATUT` FROM `departement` WHERE STATUT=0 ORDER BY DESC_DEPARTEMENT ASC");
 		$data['agences']=$this->Model->getRequete("SELECT `AGENCE_ID`, `AGENCE_NOM`, `CODE_AGENCE`, `STATUT_AG` FROM `agences` WHERE 1 ORDER BY AGENCE_NOM ASC");

 		$this->load->view('Employes_detail_view',$data);
 	}








 	function _validate()
 	{
 		$data=array();

 		$data['error_string']=array();
 		$data['inputerror']=array();
 		$data['status']=TRUE;


 		$get_info=$this->Model->getOne('employes',array('MATRICULE'=>$this->input->post('MATRICULE'),'EMPLOYE_ID!='=>$this->input->post('EMPLOYE_ID')));

 		$get_check_mail_exist=array();

 		if (!empty($this->input->post('EMAIL_EMP'))) {
 			# code...
 			$get_check_mail_exist=$this->Model->getOne('employes',array('EMAIL_EMP'=>$this->input->post('EMAIL_EMP'),'EMPLOYE_ID!='=>$this->input->post('EMPLOYE_ID')));
 		}

 		

 		// $get_info=$this->Model->getRequete('SELECT * FROM employes WHERE MATRICULE="'.$this->input->post('MATRICULE').'" AND EMPLOYE_ID!='.$this->input->post('EMPLOYE_ID'));

 		// $get_check_mail_exist=$this->Model->getRequete('SELECT * FROM employes WHERE EMAIL_EMP="'.$this->input->post('EMAIL_EMP').'" AND EMPLOYE_ID!='.$this->input->post('EMPLOYE_ID'));

 		// print_r('SELECT * FROM employes WHERE EMAIL_EMP="'.$this->input->post('EMAIL_EMP').'" AND EMPLOYE_ID!='.$this->input->post('EMPLOYE_ID'));die();

 		$regex_email = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

 		if (!empty($get_info)) {

 			$data['inputerror'][]="MATRICULE";
 			$data['error_string'][]="La matricule existe déjà";
 			$data['status']=FALSE;
 			
 		}



 		if (!empty($get_check_mail_exist)) {

 			$data['inputerror'][]="EMAIL_EMP";
 			$data['error_string'][]="L'email existe déjà";
 			$data['status']=FALSE;
 			
 		}

 		if ((!preg_match($regex_email,$this->input->post('EMAIL_EMP'))) && !empty($this->input->post('EMAIL_EMP'))) {
			$data['inputerror'][]='EMAIL_EMP';
			$data['error_string'][]='Le email est invalide';
			$data['status']=FALSE;
		}

 		if ($this->input->post('NOM_EMP')=='') 
 		{
 			$data['inputerror'][]="NOM_EMP";
 			$data['error_string'][]="Le champs est obligatoire";
 			$data['status']=FALSE;
 		}
 		if ($this->input->post('PRENOM_EMP')=='') 
 		{
 			$data['inputerror'][]="PRENOM_EMP";
 			$data['error_string'][]="Le champs est obligatoire";
 			$data['status']=FALSE;
 		}


 		if ($this->input->post('DEPARTEMENT_ID')=='') 
 		{
 			$data['inputerror'][]="DEPARTEMENT_ID";
 			$data['error_string'][]="Le champs est obligatoire";
 			$data['status']=FALSE;
 		}

 		if ($this->input->post('AGENCE_ID')=='') 
 		{
 			$data['inputerror'][]="AGENCE_ID";
 			$data['error_string'][]="Le champs est obligatoire";
 			$data['status']=FALSE;
 		}

 		if ($this->input->post('PROFILE_ID')=='') 
 		{
 			$data['inputerror'][]="PROFILE_ID";
 			$data['error_string'][]="Le champs est obligatoire";
 			$data['status']=FALSE;
 		}

 		if ($this->input->post('MATRICULE')=='') 
 		{
 			$data['inputerror'][]="MATRICULE";
 			$data['error_string'][]="Le champs est obligatoire";
 			$data['status']=FALSE;
 		}



 		if (strlen($this->input->post('MATRICULE'))<6) {
 			# code...
 			$data['inputerror'][]="MATRICULE";
 			$data['error_string'][]="La matricule doit contenir au moins 6 caractères";
 			$data['status']=FALSE;
 		}




 		if ($data['status']==FALSE) 

 		{
 			echo json_encode($data);

 			exit();

 		}


 	}
 }