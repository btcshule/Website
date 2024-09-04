<?php 

/**
/**
* @author nadvaxe2023

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Recouvrement extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->is_auth();
  }

  function is_auth()
  {
    if (empty($this->session->userdata('EMPLOYE_ID'))) {
      redirect(base_url('index.php/'));
    }
  }

  function index()
  {
    $data['page_title']=" Récouvrement des créances";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Dettes & Créances</a></li>
    <li class="breadcrumb-item active" aria-current="page">Historique des créances</li>
    </ol>
    </nav>';
        $data['CLIENT'] = $this->Model->getRequete("SELECT `GROS_CLIENT_ID`, `PRENOM_GROS_CLIENT`, `NOM_GROS_CLIENT`, `ADRESS_GROS_CLIENT`, `TEL_GROS_CLIENT`, `IS_CLIENT`, `STATUT`, `NIF`, `RS`, `RC`, `ID_BRANCHE`, `DATE_INSERTION` FROM `gros_client` WHERE IS_CLIENT=1 AND ID_BRANCHE=".$this->session->userdata('ID_BRANCHE')) ;
    $this->load->view('Recouvrements_view',$data);
  }
  function liste()
  {
$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal='SELECT recouvrement.ID_CLIENT, `ID_RECOUVREMENT`, gros_client.PRENOM_GROS_CLIENT, gros_client.NOM_GROS_CLIENT,gros_client.RS,gros_client.ADRESS_GROS_CLIENT,gros_client.TEL_GROS_CLIENT, `DATE_DETTE`, `MONTANT_PAYE`,employes.NOM_EMP,employes.PRENOM_EMP,employes.TEL_EMP,recouvrement.DATE_INSERTION FROM `recouvrement` LEFT JOIN gros_client ON  gros_client.GROS_CLIENT_ID=recouvrement.ID_CLIENT LEFT JOIN employes ON employes.EMPLOYE_ID=recouvrement.ID_EMPLOYE WHERE 1 ';

    $order_column=array("PRENOM_GROS_CLIENT","NOM_GROS_CLIENT","ADRESS_GROS_CLIENT","TEL_GROS_CLIENT","DATE_DETTE","MONTANT_PAYE","NOM_EMP","PRENOM_EMP","TEL_EMP","recouvrement.DATE_INSERTION");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY recouvrement.DATE_INSERTION  DESC';

    $search = !empty($_POST['search']['value']) ? (" AND  (PRENOM_GROS_CLIENT LIKE '%$var_search%' OR NOM_GROS_CLIENT LIKE '%$var_search%' OR ADRESS_GROS_CLIENT LIKE '%$var_search%' OR TEL_GROS_CLIENT LIKE '%$var_search%' OR recouvrement.DATE_DETTE LIKE '%$var_search%' OR MONTANT_PAYE LIKE '%$var_search%' OR NOM_EMP LIKE '%$var_search%' OR PRENOM_EMP LIKE '%$var_search%' OR TEL_EMP LIKE '%$var_search%' OR recouvrement.DATE_INSERTION LIKE '%$var_search%') ") : '';

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
      $sub_array[] = $row->DATE_DETTE;
      $sub_array[] = $row->MONTANT_PAYE;
      $sub_array[] = $row->PRENOM_GROS_CLIENT.' '.$row->NOM_GROS_CLIENT;
      $sub_array[] = $row->TEL_GROS_CLIENT;
      $sub_array[] = $row->PRENOM_EMP.' '.$row->NOM_EMP;
      $sub_array[] = $row->DATE_INSERTION;
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
    $this->Model->update('dettes_externes',array('ID_DETTE_EXTERNE'=>$id),array('STATUT'=>$value));
    echo json_encode(array('status'=>true));
  }
  function getOne($id)
  {
    $data=$this->Model->getRequeteOne('SELECT * FROM `dettes_externes` WHERE ID_DETTE_EXTERNE='.$id);
    echo json_encode($data);
  }

}
?>