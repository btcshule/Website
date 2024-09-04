<?php 
/**
/**
* @author nadvaxe2023
* le 09/01/2024
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Espace_personnel extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// $this->is_auth();
	}

	function is_auth()
	{
		if (empty($this->session->userdata('EMPLOYE_ID'))) {
			redirect(base_url('index.php/'));
		}
	}

	function index()
	{
		 $ID_USER=$this->session->userdata('EMPLOYE_ID');
		//$ID_USER=$id;
		// print_r($ID_USER);die();
		$data['page_title'] = "Espace Personnel";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="' . base_url() . 'index.php/rapport/Statistiques"><i class="uil-home-alt"></i> Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Utilisateurs</a></li>
		<li class="breadcrumb-item active" aria-current="page">Espace Personnel</li>
		</ol>
		</nav>';
		// SELECT `PROFILE_ID`, `DESC_PROFIL`, `IS_DELETED` FROM `profil` WHERE 1
		$data['infos_perso']=$this->Model->getRequeteOne('SELECT `ID_INFO_PERSONNEL`, sexe.SEXE, `NOM`, `PRENOM`,handicap. `HANDICAP`, P.PROVINCE_NAME AS PROVINCE, C.COMMUNE_NAME AS COMMUNE, Z.ZONE_NAME AS ZONE,CO.COLLINE_NAME AS COLLINE, `DATE_NAISSANCE`,matrimonial.MATRIMONIAL, `TELEPHONE1`, `TELEPHONE2`, `EMAIL`, `EMAIL_PRO`, `CNI`,P1.PROVINCE_NAME AS PROINCE1, C1.COMMUNE_NAME AS COMMUNE1, Z1.ZONE_NAME AS ZONE1,CO1.COLLINE_NAME AS COLLINE1,niveaux.DESC_NIVEAU, `METIER`, `DATE_EMBAUCHE`, `LIEU_EMBAUCHE`, dossier_embauche.EMBAUCHE, `POSITION`, `COMPETENCE`, empl_presta.EMPL_PRESTA, `NUM_CARTE`, `NOM_REF`, `PRENOM_REF`, `TEL_REF`, `MAIL_REF`, `DIVERTISSEMENT`, spdp.SPDP, mnrs.MNRS, saso.SASO,nace.NACE, `DATE_CREATION` FROM `infos_personnel`  LEFT JOIN sexe ON sexe.ID_SEXE=infos_personnel.ID_INFO_PERSONNEL LEFT JOIN handicap ON handicap.ID_HANDICAP=infos_personnel.ID_HANDICAP LEFT JOIN syst_provinces P ON P.PROVINCE_ID=infos_personnel.PROVINCE_ID LEFT JOIN syst_provinces P1 ON P1.PROVINCE_ID=infos_personnel.PROVINCE1 LEFT JOIN syst_communes C ON C.COMMUNE_ID=infos_personnel.COMMUNE_ID LEFT JOIN syst_communes C1 ON C1.COMMUNE_ID=infos_personnel.COMMUNE1 LEFT JOIN syst_zones Z ON Z.ZONE_ID=infos_personnel.ZONE_ID LEFT JOIN syst_zones Z1 ON Z1.ZONE_ID=infos_personnel.ZONE1 LEFT JOIN syst_collines CO ON CO.COLLINE_ID=infos_personnel.COLLINE_ID LEFT JOIN syst_collines CO1 ON CO1.COLLINE_ID=infos_personnel.COLLINE1 LEFT JOIN matrimonial ON matrimonial.ID_MATRIMONIAL=infos_personnel.ID_MATRIMONIAL LEFT JOIN niveaux ON niveaux.ID_NIVEAU=infos_personnel.ID_DIPLOME LEFT JOIN dossier_embauche ON dossier_embauche.ID_EMBAUCHE=infos_personnel.ID_EMBAUCHE LEFT JOIN empl_presta ON empl_presta.ID_EMPLACEMENT=infos_personnel.ID_EMPL_PRESTA LEFT JOIN spdp ON spdp.ID_SPDP=infos_personnel.ID_SPDP LEFT JOIN mnrs ON mnrs.ID_MNRS=infos_personnel.ID_MNRS LEFT JOIN saso ON saso.ID_SASO=infos_personnel.ID_SASO LEFT JOIN nace ON nace.ID_NACE=infos_personnel.ID_NACE  WHERE  ID_INFO_PERSONNEL='.$ID_USER);
		 // print_r($data['infos_perso']);die;

		$this->load->view('Espace_personnel_view',$data);
	}

	function details($id)
	{  
		
	}
	function liste()
	{

		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal=" SELECT employes.EMPLOYE_ID, `NOM_EMP`, `PRENOM_EMP`, `EMAIL_EMP`, `TEL_EMP`,DESC_PROFIL,DESC_NIVEAU, `IS_USER_SYSTEM`, `MOT_DE_PASSE`, `USER_ID`, `DATE_CREATION`, `IS_ACTIF`, `IS_MUST_CHANGE_PWD`, DESCRIPTION_BRANCH,LOCALISATION, employes.STATUT FROM `employes` LEFT JOIN niveaux ON niveaux.ID_NIVEAU=employes.DIPLOME LEFT JOIN profil ON profil.PROFILE_ID=employes.PROFILE_ID JOIN sanya_branches ON sanya_branches.ID_BRANCHE=employes.ID_BRANCHE WHERE 1";

		$order_column=array("NOM_EMP","EMAIL_EMP","LOCALISATION","TEL_EMP","DESC_PROFIL","DESCRIPTION_BRANCH","(CASE WHEN STATUT=1 THEN 'Inactif' ELSE 'Actif' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DESC_PROFIL  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (PRENOM_EMP LIKE '%$var_search%' OR NOM_EMP LIKE '%$var_search%' OR DESC_PROFIL LIKE '%$var_search%' OR DESCRIPTION_BRANCH LIKE '%$var_search%' OR EMAIL_EMP LIKE '%$var_search%' OR employes.STATUT LIKE '%$var_search%') ") : '';

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

			if ($row->STATUT==1) {
				$STATUT='Actif';
			}else{
				$STATUT='Inactif';
			}
			$sub_array = array();  
			$sub_array[] = $row->NOM_EMP.' '.$row->PRENOM_EMP;
			$sub_array[] = $row->TEL_EMP;
			$sub_array[] = $row->EMAIL_EMP;
			$sub_array[] = $row->DESC_PROFIL;
			$sub_array[] = $row->DESC_NIVEAU;
			$sub_array[] = $row->DESCRIPTION_BRANCH.' '.$row->LOCALISATION;
			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->EMPLOYE_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
			<a href="javascript:void(0);" onclick="supp_logic('.$row->EMPLOYE_ID.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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


	function del($id,$stat)
	{
		$value = ($stat==1) ? 0 : 1 ;
		$this->Model->update('gros_client',array('GROS_CLIENT_ID'=>$id),array('STATUT'=>$value));
		echo json_encode(array('status'=>true));
	}
			
	function getOne($id)
	{
		$data=$this->Model->getRequeteOne('SELECT `GROS_CLIENT_ID`, `PRENOM_GROS_CLIENT`, `NOM_GROS_CLIENT`, `ADRESS_GROS_CLIENT`, `TEL_GROS_CLIENT`, `IS_CLIENT`, `STATUT`, `NIF`, `RS`, `RC`, `ID_BRANCHE`, `DATE_INSERTION` FROM `gros_client` WHERE  GROS_CLIENT_ID='.$id);
		echo json_encode($data);
	}
	function update()
	{
		$table='gros_client';
		$nom=$this->input->post('NOM_CLIENT');
		$prenom=$this->input->post('PRENOM_CLIENT');
		$tel=$this->input->post('TEL_CLIENT');
		$localisation=$this->input->post('LOCALISATION');
		$RaisonSociale=$this->input->post('RaisonSociale');
		$RegistreCommerce=$this->input->post('RegistreCommerce');
		$NIF=$this->input->post('NIF');
		$ID_BRANCHE=$this->session->userdata('ID_BRANCHE');
		$STATUT=1;
		$IS_CLIENT=1;


		$this->Model->update('gros_client',array('GROS_CLIENT_ID'=>$this->input->post('GROS_CLIENT_ID')),array('NOM_GROS_CLIENT'=>$nom,'PRENOM_GROS_CLIENT'=>$prenom,'TEL_GROS_CLIENT'=>$tel,'ADRESS_GROS_CLIENT'=>$localisation,'STATUT'=>$STATUT,'IS_CLIENT'=>$IS_CLIENT,'NIF'=>$NIF,'RS'=>$RaisonSociale,'RC'=>$RegistreCommerce));
		echo json_encode(array('status'=>true));

	}
}

?>