<?php 
/**
/**
* @author nadvaxe2023
* le 08/10/2023
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Utilisateurs extends CI_Controller
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
		$data['page_title'] = "Nos clients";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="' . base_url() . 'index.php/rapport/Statistiques"><i class="uil-home-alt"></i> Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Données</a></li>
		<li class="breadcrumb-item active" aria-current="page">Clients</li>
		</ol>
		</nav>';
		// SELECT `PROFILE_ID`, `DESC_PROFIL`, `IS_DELETED` FROM `profil` WHERE 1
		$data['profil']=$this->Model->getRequete('SELECT `PROFILE_ID`, `DESC_PROFIL`, `IS_DELETED` FROM `profil` WHERE 1');
		$data['branche']=$this->Model->getRequete('SELECT `ID_BRANCHE`, `DESCRIPTION_BRANCH`, `LOCALISATION`, `STATUT` FROM `sanya_branches` WHERE 1');
		$data['niveaux']=$this->Model->getRequete('SELECT `ID_NIVEAU`, `DESC_NIVEAU` FROM `niveaux` WHERE 1');

		$this->load->view('Utilisateurs_view',$data);
	}

	function ajouter()
	{    


		$table='employes';
		$NOM=$this->input->post('NOM');
		$PRENOM=$this->input->post('PRENOM');
		$TELEPHONE=$this->input->post('TELEPHONE');
		$EMAIL=$this->input->post('EMAIL');
		$DIPLOME=$this->input->post('ID_NIVEAU');
		$PROFILE_ID=$this->input->post('PROFILE_ID');
		$ID_BRANCHE=$this->input->post('ID_BRANCHE');
		// $ID_BRANCHE=$this->session->userdata('ID_BRANCHE');
		$STATUT=1;
		$IS_ACTIF=1;
		$IS_USER_SYSTEM=1;
		$MOT_DE_PASSE=md5(123456);
		$IS_MUST_CHANGE_PWD=1;

		$data=array('NOM_EMP'=>trim($NOM),'PRENOM_EMP'=>trim($PRENOM),'EMAIL_EMP'=>trim($EMAIL),'DIPLOME'=>trim($DIPLOME),'STATUT'=>trim($STATUT),'TEL_EMP'=>trim($TELEPHONE),'IS_ACTIF'=>trim($IS_ACTIF),'PROFILE_ID'=>trim($PROFILE_ID),'IS_USER_SYSTEM'=>trim($IS_USER_SYSTEM),'MOT_DE_PASSE'=>trim($MOT_DE_PASSE),'IS_MUST_CHANGE_PWD'=>trim($IS_MUST_CHANGE_PWD),'ID_BRANCHE'=>trim($ID_BRANCHE));
		$this->Model->create($table,$data);
		echo json_encode(array('status'=>true));

	}
	function liste()
	{

		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal=" SELECT employes.EMPLOYE_ID, `NOM_EMP`, `PRENOM_EMP`, `EMAIL_EMP`, `TEL_EMP`,DESC_PROFIL,DESC_NIVEAU, `IS_USER_SYSTEM`, `MOT_DE_PASSE`, `USER_ID`, `DATE_CREATION`, `IS_ACTIF`, `IS_MUST_CHANGE_PWD`, DESCRIPTION_BRANCH,LOCALISATION, employes.STATUT FROM `employes` LEFT JOIN niveaux ON niveaux.ID_NIVEAU=employes.DIPLOME LEFT JOIN profil ON profil.PROFILE_ID=employes.PROFILE_ID JOIN sanya_branches ON sanya_branches.ID_BRANCHE=employes.ID_BRANCHE WHERE 1";

		$order_column=array("NOM_EMP","EMAIL_EMP","LOCALISATION","TEL_EMP","DESC_PROFIL","DESCRIPTION_BRANCH","(CASE WHEN STATUT=1 THEN 'Inactif' ELSE 'Actif' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DESC_PROFIL  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (RS LIKE '%$var_search%' OR NOM_EMP LIKE '%$var_search%',OR DESC_PROFIL LIKE '%$var_search%' OR DESCRIPTION_BRANCH LIKE '%$var_search%' OR OR EMAIL_EMP LIKE '%$var_search%'OR STATUT LIKE '%$var_search%') ") : '';

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