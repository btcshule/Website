<?php 
/**
/**
* @author nadvaxe2023
* le 08/10/2023
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Fournisseurs extends CI_Controller
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
		$data['page_title'] = "Gestionnaire des fournisseurs";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="' . base_url() . 'index.php/rapport/Statistiques"><i class="uil-home-alt"></i> Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Données</a></li>
		<li class="breadcrumb-item active" aria-current="page">Fournisseurs</li>
		</ol>
		</nav>';
		
		$this->load->view('Fournisseurs_view',$data);
	}

	function ajouter()
	{    

		$table='fournisseurs_sanya';
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

		$data=array('NOM_FOURNISSEUR'=>trim($nom),'PRENOM_FOURNISSEUR'=>trim($prenom),'TEL_FOURNISSEUR'=>trim($tel),'LOC_FOURNISSEUR'=>trim($localisation),'STATUT'=>trim($STATUT),'NIF'=>trim($NIF),'RS'=>trim($RaisonSociale),'RC'=>trim($RegistreCommerce),'ID_BRANCHE'=>trim($ID_BRANCHE));
		$this->Model->create($table,$data);
		echo json_encode(array('status'=>true));

	}
	function liste()
	{


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `ID_FOURNISSEUR`, `NOM_FOURNISSEUR`, `PRENOM_FOURNISSEUR`, `TEL_FOURNISSEUR`, `LOC_FOURNISSEUR`, `STATUT`, `NIF`, `RC`, `RS`, `ID_BRANCHE`, `DATE_INSERTION` FROM `fournisseurs_sanya` WHERE 1";

		$order_column=array("NOM_FOURNISSEUR","NOM_FOURNISSEUR","LOC_FOURNISSEUR","TEL_FOURNISSEUR","RC","NIF","RS","(CASE WHEN STATUT=1 THEN 'Inactif' ELSE 'Actif' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY RS  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (RS LIKE '%$var_search%' OR PRENOM_FOURNISSEUR LIKE '%$var_search%' OR TEL_FOURNISSEUR LIKE '%$var_search%' OR NIF LIKE '%$var_search%' OR RC LIKE '%$var_search%' OR RS LIKE '%$var_search%' OR NOM_FOURNISSEUR LIKE '%$var_search%' OR LOC_FOURNISSEUR LIKE '%$var_search%' OR STATUT LIKE '%$var_search%') ") : '';

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


			$sub_array[] = $row->NOM_FOURNISSEUR.' '.$row->PRENOM_FOURNISSEUR;
			$sub_array[] = $row->TEL_FOURNISSEUR;
			$sub_array[] = $row->RS;
			$sub_array[] = $row->NIF;
			$sub_array[] = $row->RC;
			$sub_array[] = $row->LOC_FOURNISSEUR;
			
			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->ID_FOURNISSEUR.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
			<a href="javascript:void(0);" onclick="supp_logic('.$row->ID_FOURNISSEUR.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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
		$this->Model->update('fournisseurs_sanya',array('ID_FOURNISSEUR'=>$id),array('STATUT'=>$value));
		echo json_encode(array('status'=>true));
	}
			
	function getOne($id)
	{
		$data=$this->Model->getRequeteOne('SELECT `ID_FOURNISSEUR`, `NOM_FOURNISSEUR`, `PRENOM_FOURNISSEUR`, `TEL_FOURNISSEUR`, `LOC_FOURNISSEUR`, `STATUT`, `NIF`, `RC`, `RS`, `ID_BRANCHE`, `DATE_INSERTION` FROM `fournisseurs_sanya` WHERE  ID_FOURNISSEUR='.$id);
		echo json_encode($data);
	}
	function update()
	{
		$table='fournisseurs_sanya';
		$nom=$this->input->post('NOM_CLIENT');
		$prenom=$this->input->post('PRENOM_CLIENT');
		$tel=$this->input->post('TEL_CLIENT');
		$localisation=$this->input->post('LOCALISATION');
		$RaisonSociale=$this->input->post('RaisonSociale');
		$RegistreCommerce=$this->input->post('RegistreCommerce');
		$NIF=$this->input->post('NIF');
		$ID_BRANCHE=$this->session->userdata('ID_BRANCHE');
		$STATUT=1;
		$this->Model->update($table,array('ID_FOURNISSEUR'=>$this->input->post('ID_FOURNISSEUR')),array('NOM_FOURNISSEUR'=>$nom,'PRENOM_FOURNISSEUR'=>$prenom,'TEL_FOURNISSEUR'=>$tel,'LOC_FOURNISSEUR'=>$localisation,'STATUT'=>$STATUT,'NIF'=>$NIF,'RS'=>$RaisonSociale,'RC'=>$RegistreCommerce));
		echo json_encode(array('status'=>true));

	}
}

?>