<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class List_dettes extends CI_Controller
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

    $data['page_title']="Historique des dettes";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>';
    $data['somme']=$this->Model->getRequeteOne('SELECT sum(`PA_T`) as montant FROM `stock_secretariat` WHERE 1');

    $this->load->view('List_dettes_view',$data);
  }

  
  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal="SELECT `GROS_CLIENT_FACT_ID`, `RS`, `PATH_FACTURE`, mag_client_facture.STATUT, `AMOUNT_DETTE`, `ECHEANCE`, `TYPE_DETTE`, `IS_DETTE_PAID`, PRENOM_EMP, `NUM_FACTURE`, mag_client_facture.DATE_ACTION, mag_client_facture.ID_BRANCHE FROM `mag_client_facture` JOIN gros_client ON gros_client.GROS_CLIENT_ID=mag_client_facture.GROS_CLIENT_ID JOIN employes ON employes.EMPLOYE_ID=mag_client_facture.SELLER WHERE 1";

    $order_column=array("RS","TYPE_DETTE","PRENOM_EMP");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER BY GROS_CLIENT_FACT_ID ASC';

    $search = !empty($_POST['search']['value']) ? (" AND  (TYPE_DETTE LIKE '%$var_search%' OR ECHEANCE LIKE '%$var_search%',OR PRENOM_EMP LIKE '%$var_search%') ") : '';

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
      // SELECT `GROS_CLIENT_FACT_ID`, `RS`, `PATH_FACTURE`, `STATUT`, `AMOUNT_DETTE`, `ECHEANCE`, `TYPE_DETTE`, `IS_DETTE_PAID`, `SELLER`, `NUM_FACTURE`, `DATE_ACTION`, `ID_BRANCHE` FROM `mag_client_facture` WHERE 1
      $sub_array[] = $row->NUM_FACTURE;
      $sub_array[] = $row->RS;
      $sub_array[] = $row->AMOUNT_DETTE;
      $sub_array[] = $row->ECHEANCE;
      $sub_array[] = $row->PRENOM_EMP;
      $sub_array[] = $row->DATE_ACTION;
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
  
}
?>