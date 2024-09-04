<?php 
/**
/**
* @author nadvaxe2023
* le 08/10/2023
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Users_profil extends CI_Controller
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
		$data['page_title'] = "Cahier des charges utilisateurs";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="' . base_url() . 'index.php/rapport/Statistiques"><i class="uil-home-alt"></i> Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Données</a></li>
		<li class="breadcrumb-item active" aria-current="page">Profils</li>
		</ol>
		</nav>';
		// SELECT `PROFILE_ID`, `DESC_PROFIL`, `IS_DELETED` FROM `profil` WHERE 1
		$data['profil']=$this->Model->getRequete('SELECT `PROFILE_ID`, `DESC_PROFIL`, `IS_DELETED` FROM `profil` WHERE 1');
		$this->load->view('User_profils_view',$data);
	}

	function ajouter()
	{    


		$table='user_profil';

		$PROFILE_ID=$this->input->post('PROFILE_ID');
		$USERPROFIL=$this->input->post('USERPROFIL');
		$CHARGES=$this->input->post('CHARGES');
		$data=array('PROFIL_ID'=>trim($PROFILE_ID),'DESC_USER_PROFIL'=>trim($USERPROFIL),'TACHES'=>trim($CHARGES));
		$this->Model->create($table,$data);
		echo json_encode(array('status'=>true));

	}
	function liste()
	{

		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `ID_USER_PROFIL`,profil.DESC_PROFIL, `DESC_USER_PROFIL`, `TACHES` FROM `user_profil` JOIN profil ON profil.PROFILE_ID=user_profil.PROFIL_ID WHERE 1";

		$order_column=array("DESC_PROFIL","DESC_USER_PROFIL","TACHES");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DESC_PROFIL  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (DESC_PROFIL LIKE '%$var_search%' OR DESC_USER_PROFIL LIKE '%$var_search%' OR TACHES LIKE '%$var_search%') ") : '';

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
			$sub_array[] = $row->DESC_USER_PROFIL;
			$sub_array[] = $row->DESC_PROFIL;
			$sub_array[] = $row->TACHES;
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