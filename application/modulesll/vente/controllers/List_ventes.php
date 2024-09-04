<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class List_ventes extends CI_Controller
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

    $data['page_title']="Historique des ventes";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>';
    $data['somme']=$this->Model->getRequeteOne('SELECT sum(`PA_T`) as montant FROM `stock_secretariat` WHERE 1');

    $this->load->view('List_ventes_view',$data);
  }

  
  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal="SELECT `ID_VENTES`, `NUM_FACTURE`, `PRODUCT_DESC`, `QUANTITE`, `PRIX_UNITAIRE`, `PRIX_TOTAL`, `NET_PAID`, `P_ACHAT_TOTAL`, mag_ventes_produits.DATE_INSERTION FROM `mag_ventes_produits` LEFT JOIN products ON products.PRODUCT_ID=mag_ventes_produits.PRODUCT_ID LEFT JOIN mag_client_facture ON mag_client_facture.GROS_CLIENT_FACT_ID=mag_ventes_produits.GROS_CLIENT_FACT_ID  WHERE 1";

    $order_column=array("QUANTITE","NET_PAID","NUM_FACTURE");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY QUANTITE  ASC';

    $search = !empty($_POST['search']['value']) ? (" AND  (QUANTITE LIKE '%$var_search%' OR PRODUCT_DESC LIKE '%$var_search%',OR NUM_FACTURE LIKE '%$var_search%') ") : '';

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
      $sub_array[] = $row->NUM_FACTURE;
      $sub_array[] = $row->PRODUCT_DESC;
      $sub_array[] = $row->QUANTITE;
      $sub_array[] = $row->PRIX_UNITAIRE;
      $sub_array[] = $row->PRIX_TOTAL;
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
  
}
?>