<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Stock_global extends CI_Controller
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

    $data['page_title']="";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>';
    $data['somme']=$this->Model->getRequeteOne('SELECT sum(`PA_T`) as montant FROM `stock_secretariat` WHERE 1');

    $this->load->view('Stock_global_view',$data);
  }

  
  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal="SELECT `SECR_STOCK_ID`, products.PRODUCT_DESC, `QNTE`, `PA_U`, `PV_U`, `PA_T`, `STATUT`, stock_secretariat.DATE_INSERTION FROM `stock_secretariat` LEFT JOIN products ON products.PRODUCT_ID=stock_secretariat.PRODUCT_ID WHERE QNTE>0";

    $order_column=array("PRODUCT_DESC","QNTE","PA_U");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY PRODUCT_DESC  ASC';

    $search = !empty($_POST['search']['value']) ? (" AND  (QNTE LIKE '%$var_search%' OR PRODUCT_DESC LIKE '%$var_search%',OR PA_T LIKE '%$var_search%') ") : '';

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
      $sub_array[] = $row->PRODUCT_DESC;
      $sub_array[] = $row->QNTE;
      $sub_array[] = $row->PA_U;
      $sub_array[] = $row->PV_U;
      $sub_array[] = $row->PA_T;
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