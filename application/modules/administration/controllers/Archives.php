<?php 
/**
/**
* @author nadvaxe2023
* le 08/10/2023
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Archives extends CI_Controller
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
		$data['page_title'] = "Document pour Archives";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="' . base_url() . 'index.php/rapport/Statistiques"><i class="uil-home-alt"></i> Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Données</a></li>
		<li class="breadcrumb-item active" aria-current="page">Archives</li>
		</ol>
		</nav>';
		// SELECT `PROFILE_ID`, `DESC_PROFIL`, `IS_DELETED` FROM `profil` WHERE 1
		$data['dossiers']=$this->Model->getRequete('SELECT `DOSSIER_ID`, `DOSSIER_ARCHIVE`, `IS_DELETED` FROM `dossier_archive` WHERE 1');
		$this->load->view('Archives_view',$data);
	} 

	function ajouter()
	{    


		$table='nos_archives';
		$data=array('DOSSIER_ID '=>$this->input->post('DOSSIER_ID'),
			'CONTENU'=>$this->input->post('CONTENU'),
			'PATH_ARCHIVE'=>$this->upload_file_archive('FICHIER'),
			'EMPLOYE_ID'=>$this->session->userdata('EMPLOYE_ID'));
		$this->Model->create($table,$data);
		echo json_encode(array('status'=>true));
	}
	  public function upload_file_archive($input_name)
  {

    $nom_file = $_FILES[$input_name]['tmp_name'];
    $nom_champ = $_FILES[$input_name]['name'];
    $ext=pathinfo($nom_champ, PATHINFO_EXTENSION);
    $repertoire_fichier = FCPATH .'archives/uploads/';
    $code=uniqid();
    $name=$code . 'archive.' .$ext;
    $file_link = $repertoire_fichier . $name;
    // $fichier = basename($nom_champ);
    if (!is_dir($repertoire_fichier)) {
      mkdir($repertoire_fichier, 0777, TRUE);
    }
    move_uploaded_file($nom_file, $file_link);
    return $name;
  }
	function liste()
	{

		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `ID_ARCHIVES`,dossier_archive.DOSSIER_ARCHIVE, `CONTENU`, `PATH_ARCHIVE`,employes.NOM_EMP,employes.PRENOM_EMP, `DATE_INSERTION` FROM `nos_archives` JOIN employes ON employes.EMPLOYE_ID=nos_archives.EMPLOYE_ID JOIN dossier_archive ON dossier_archive.DOSSIER_ID=nos_archives.DOSSIER_ID WHERE 1";

		$order_column=array("DOSSIER_ARCHIVE","CONTENU","PATH_ARCHIVE","NOM_EMP","PRENOM_EMP","DATE_INSERTION");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DATE_INSERTION  DESC';

		$search = !empty($_POST['search']['value']) ? (" AND  (DOSSIER_ARCHIVE LIKE '%$var_search%' OR CONTENU LIKE '%$var_search%' OR PRENOM_EMP LIKE '%$var_search%' OR NOM_EMP LIKE '%$var_search%' OR DATE_INSERTION LIKE '%$var_search%') ") : '';

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
			$sub_array[] = $row->DOSSIER_ARCHIVE;
			$sub_array[] = $row->CONTENU;
			$sub_array[] = $row->NOM_EMP;
			$sub_array[] = $row->PRENOM_EMP;
			$sub_array[] = $row->DATE_INSERTION;
			$sub_array[] = '
			<center>
			      <a type="button" data-toggle="modal" onclick="afficherDocument(\''.$row->PATH_ARCHIVE.'\')">
			<i class="mdi mdi-printer-eye"></i>
			</a>
			</center>';
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