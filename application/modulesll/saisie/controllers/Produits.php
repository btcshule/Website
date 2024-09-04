<?php
/**
/**
* @author NSHIMIRIMANA Révérien/+25768051821/rnshimirimana48@gmail.com
  #gestion des materiels par categories
  #2023-07-29 07:15
*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");


 class Produits extends CI_Controller
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

 		$data['page_title']="Produits";
 		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
 		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
 		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
 		<li class="breadcrumb-item"><a href="#">Library</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Data</li>
 		</ol>
 		</nav>';

 		// $data['familles']=$this->Model->getRequete("SELECT `FAMILLE_ID`, `DESC_FAMILLE`,GROUPE_ID, `DATE_CREATION`, `IS_ACTIVE` FROM `famille` WHERE IS_ACTIVE=1 ORDER BY DESC_FAMILLE ASC");

 		$data['unite_qte']=$this->Model->getRequete("SELECT `UNITE_QTE_ID`, `UNITE_QTE_DESC` FROM `unite_par_qte` WHERE STATUT=1 ORDER BY UNITE_QTE_DESC ASC");

 		$data['categories']=$this->Model->getRequete("SELECT `CATEGORIE_ID`, `CATEGORIE_DESC`, `STATUT` FROM `categories` WHERE STATUT=1 ORDER BY CATEGORIE_DESC ASC");

 		// $data['marques']=$this->Model->getRequete("SELECT `MARQUE_ID`, `DESC_MARQUE`, `DATE_CREATION`, `IS_ACTIVE` FROM `marque` WHERE 1 AND IS_ACTIVE=1  ORDER by DESC_MARQUE ASC");

 		$data['unites']=$this->Model->getRequete("SELECT `UNITE_ID`, `UNITE_DESC` FROM `unites` WHERE 1 ORDER BY UNITE_DESC ASC");

 		$this->load->view('Produits_view',$data);
 	}

 	function add()
 	{
 		$this->_validate();

 		$DESC_CAT_MAT=trim($this->input->post('DESC_CAT_MAT'));
 		$CATEGORIE_ID=$this->input->post('CATEGORIE_ID');
 		$UNITE_QTE_ID=$this->input->post('UNITE_QTE_ID');
 		$SEUIL_N1=(!empty($this->input->post('SEUIL_N1'))) ? $this->input->post('SEUIL_N1') : 0;
 		$SEUIL_N2=(!empty($this->input->post('SEUIL_N2'))) ? $this->input->post('SEUIL_N2') : 0;
 		$UNITE_ID=$this->input->post('UNITE_ID');
 		$QTE_PAR_UNITE=$this->input->post('QTE_PAR_UNITE');
 		$USER_ID=$this->session->userdata('EMPLOYE_ID');
 		$DATE_CREATION=date('Y-m-d H:i:s');

 		$data=array(
 			'DESC_CAT_MAT'=>$DESC_CAT_MAT,
 			'CATEGORIE_ID'=>$CATEGORIE_ID,
 			'UNITE_QTE_ID'=>$UNITE_QTE_ID,
 			'SEUIL_N1'=>$SEUIL_N1,
 			'SEUIL_N2'=>$SEUIL_N2,
 			'UNITE_ID'=>$UNITE_ID,
 			'QTE_PAR_UNITE'=>$QTE_PAR_UNITE,
 			'USER_ID'=>$USER_ID,
 			'DATE_CREATION'=>$DATE_CREATION
 		);

 		$this->Model->create('cat_materiel',$data);
 		echo json_encode(array('status'=>true));

 	}

 	function update()
 	{
 		$this->_validate();

 		$CAT_MAT_ID=$this->input->post('CAT_MAT_ID');
 		$DESC_CAT_MAT=trim($this->input->post('DESC_CAT_MAT'));
 		$CATEGORIE_ID=$this->input->post('CATEGORIE_ID');
 		$SEUIL_N1=(!empty($this->input->post('SEUIL_N1'))) ? $this->input->post('SEUIL_N1') : 0;
 		$SEUIL_N2=(!empty($this->input->post('SEUIL_N2'))) ? $this->input->post('SEUIL_N2') : 0;
 		$UNITE_ID=$this->input->post('UNITE_ID');
 		$UNITE_QTE_ID=$this->input->post('UNITE_QTE_ID');
 		$QTE_PAR_UNITE=$this->input->post('QTE_PAR_UNITE');

 		$data=array(
 			'DESC_CAT_MAT'=>$DESC_CAT_MAT,
 			'CATEGORIE_ID'=>$CATEGORIE_ID,
 			'UNITE_QTE_ID'=>$UNITE_QTE_ID,
 			'UNITE_ID'=>$UNITE_ID,
 			'QTE_PAR_UNITE'=>$QTE_PAR_UNITE,
 			'SEUIL_N1'=>$SEUIL_N1,
 			'SEUIL_N2'=>$SEUIL_N2,
 			'IS_ACTIF'=>0
 		);

 		$this->Model->update('cat_materiel',array('CAT_MAT_ID'=>$CAT_MAT_ID),$data);
 		echo json_encode(array('status'=>true));

 	}

 	function getOne($id)
 	{
 		$data=$this->Model->getOne('cat_materiel',array('CAT_MAT_ID'=>$id));
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

 		$this->Model->update('cat_materiel',array('CAT_MAT_ID'=>$id),array('IS_ACTIF'=>$IS_ACTIF));
 		echo json_encode(array('status'=>true));
 	}

 	function confirm_item($id,$stat)
 	{

 		$this->Model->update('cat_materiel',array('CAT_MAT_ID'=>$id),array('IS_ACTIF'=>1));
 		echo json_encode(array('status'=>true));
 	}


 	function liste()
 	{


 		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 		$query_principal="SELECT
 		mat.CAT_MAT_ID,
 		mat.DESC_CAT_MAT,
 		mat.SEUIL_N1,
 		mat.SEUIL_N2,
 		mat.DATE_CREATION,
 		mat.IS_ACTIF,
 		(CASE WHEN IS_ACTIF=0 THEN 'En attente de validation' WHEN IS_ACTIF=1 THEN 'Validée' WHEN IS_ACTIF=2 THEN 'Annulé' END)STATUT,
 		c.CATEGORIE_DESC,
 		CONCAT(mat.SEUIL_N1,' <i>',u.UNITE_DESC,'</i>') SEUIL_MIN_LOGISTIQUE,
 		CONCAT(mat.SEUIL_N2,' <i>',u.UNITE_DESC,'</i>') SEUIL_MIN_AGENCE,
 		CONCAT(mat.QTE_PAR_UNITE,' <i>',uq.UNITE_QTE_DESC,'</i>') UNITE_QTE
        
 		FROM
 		cat_materiel mat
 		JOIN categories c ON
 		c.CATEGORIE_ID = mat.CATEGORIE_ID
        JOIN unites u ON u.UNITE_ID=mat.UNITE_ID
        JOIN unite_par_qte uq ON uq.UNITE_QTE_ID=mat.UNITE_QTE_ID
 		WHERE
 		c.STATUT=1";

 		$order_column=array("DESC_CAT_MAT","c.CATEGORIE_DESC","CONCAT(mat.SEUIL_N1,' ',mat.QTE_PAR_UNITE)","CONCAT(mat.SEUIL_N2,' ',mat.QTE_PAR_UNITE)","CONCAT(mat.SEUIL_N1,' ',mat.QTE_PAR_UNITE)","(CASE WHEN IS_ACTIF=0 THEN 'En attente de validation' WHEN IS_ACTIF=1 THEN 'Validée' WHEN IS_ACTIF=2 THEN 'Annulé' END)","");

 		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY mat.DESC_CAT_MAT  DESC';

 		$search = !empty($_POST['search']['value']) ? (" AND  (mat.DESC_CAT_MAT LIKE '%$var_search%' OR (CASE WHEN IS_ACTIF=0 THEN 'En attente de validation' WHEN IS_ACTIF=1 THEN 'Validée' WHEN IS_ACTIF=2 THEN 'Annulé' END) LIKE '%var_search%' OR CONCAT(mat.SEUIL_N1,' ',mat.QTE_PAR_UNITE) LIKE '%$var_search%' OR CONCAT(mat.SEUIL_N2,' ',mat.QTE_PAR_UNITE) LIKE '%$var_search%' OR mat.DATE_CREATION LIKE '%$var_search%' OR c.CATEGORIE_DESC LIKE '%$var_search%' OR CONCAT(mat.SEUIL_N1,' ',mat.QTE_PAR_UNITE) LIKE '%$var_search%') ") : '';

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

 			$sub_array[] = $row->CATEGORIE_DESC;
 			$sub_array[] = $row->DESC_CAT_MAT.'<br>'.$statut;
 			$sub_array[] = $row->SEUIL_MIN_LOGISTIQUE;
 			$sub_array[] = $row->SEUIL_MIN_AGENCE;
 			$sub_array[] = $row->UNITE_QTE;

 			// $sub_array[] = ($row->IS_ACTIF==1) ? '<span class="badge bg-success">'.$row->STATUT.'</span>' : '<span class="badge bg-danger">'.$row->STATUT.'</span>';

 			// $sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_mat('.$row->CAT_MAT_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 			// <a href="javascript:void(0);" onclick="supp_logic('.$row->CAT_MAT_ID.','.$row->IS_ACTIF.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';



 			$statut_trait="";
 			$option="";

 			$condi=($this->session->userdata('PROD_VALIDEUR')==1) ? 'onclick="confirm_item('.$row->CAT_MAT_ID.','.$row->IS_ACTIF.')"' : '';

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



 			if ($this->session->userdata('PROD_VALIDEUR')==1) {

 				$option.='<a href="javascript:void(0);" style="color:green;" onclick="edit_mat('.$row->CAT_MAT_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 				<a href="javascript:void(0);" onclick="supp_logic('.$row->CAT_MAT_ID.','.$row->IS_ACTIF.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>'.$statut_trait;
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







 	function _validate()
 	{
 		$data=array();
 		$data['error_string']=array();
 		$data['inputerror']=array();
 		$data['status']=true;

 		$check_mat=$this->Model->getOne('cat_materiel',array('DESC_CAT_MAT'=>$this->input->post('DESC_CAT_MAT'),'CAT_MAT_ID!='=>$this->input->post('CAT_MAT_ID'),'CATEGORIE_ID<>'=>$this->input->post('CATEGORIE_ID')/*,'MARQUE_ID<>'=>$this->input->post('MARQUE_ID')*/));


 		if ($this->input->post('DESC_CAT_MAT')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="DESC_CAT_MAT";
 			$data['status']=false;
 		}

 		
 		if ($check_mat) {
  			# code...
 			$data['error_string'][]="Le matériel existe déjà";
 			$data['inputerror'][]="DESC_CAT_MAT";
 			$data['status']=false;
 		}


 		if (empty($this->input->post('CATEGORIE_ID'))) 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="CATEGORIE_ID";
 			$data['status']=false;
 		}

 		// if (empty($this->input->post('SEUIL'))) 
 		// {

 		// 	$data['error_string'][]="Le champs est obligatoire";
 		// 	$data['inputerror'][]="SEUIL";
 		// 	$data['status']=false;
 		// }

 		if (empty($this->input->post('UNITE_ID'))) 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="UNITE_ID";
 			$data['status']=false;
 		}

 		if (empty($this->input->post('QTE_PAR_UNITE'))) 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="QTE_PAR_UNITE";
 			$data['status']=false;
 		}

 		if ($this->input->post('QTE_PAR_UNITE')<0) 
 		{

 			$data['error_string'][]="La quantité est invalide!";
 			$data['inputerror'][]="QTE_PAR_UNITE";
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