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
    $data['somme']=$this->Model->getRequeteOne('SELECT sum(`VALEUR`) as montant FROM `stock_valeur` WHERE 1');

    $this->load->view('Stock_global_view',$data);
  }

  
  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal="SELECT stock_secretariat.SECR_STOCK_ID,products.PRODUCT_DESC,TYPE_STOCK, `QNTE`,STATUT FROM `stock_secretariat` JOIN products ON products.PRODUCT_ID=stock_secretariat.PRODUCT_ID WHERE `QNTE`>0";

    $order_column=array("PRODUCT_DESC","QNTE","PA_U");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY PRODUCT_DESC  ASC';

    $search = !empty($_POST['search']['value']) ? (" AND  (QNTE LIKE '%$var_search%' OR PRODUCT_DESC LIKE '%$var_search%' OR PA_T LIKE '%$var_search%') ") : '';

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
      $type = $row->TYPE_STOCK;
      if ($type == 1) {
        $tpe = "Pièces";
      }else{
        $tpe = "Paquets";
      }
      $sub_array[] = $tpe;
      $sub_array[] = $row->QNTE;
      $sub_array[] = '<a href="'.base_url('index.php/stock/Stock_global/fiche/'.$row->SECR_STOCK_ID).'" style="color:green;" class="action-icon">Voir la fiche</a>';

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
  public function fiche($SECR_STOCK_ID){
    $data['page_title'] = "Fiche de stock du produit";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="' . base_url() . 'index.php/rapport/Statistiques"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Stock</a></li>
    <li class="breadcrumb-item active" aria-current="page">Fiche du stock</li>
    </ol>
    </nav>';
        $data_stock=$this->Model->getRequeteOne("SELECT `SECR_STOCK_ID`, `PRODUCT_ID`, `TYPE_STOCK` FROM `stock_secretariat` WHERE SECR_STOCK_ID=".$SECR_STOCK_ID);
         $data['article']=$data_stock['PRODUCT_ID'];
         $data['type']=$data_stock['TYPE_STOCK'];
    // print_r($data_stock);die();
    $this->load->view('Fiche_stock_view',$data);
  } 

    function info_fiche()
  {
    $article=$this->input->post('article');
    $type=$this->input->post('type');
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

   $query_principal = "SELECT `STOCK_VALEUR_ID`,  products.PRODUCT_ID, products.PRODUCT_DESC, `TYPE_STOCK`, `QNTE_ENTREE`, `VALEUR`, `QNTE_SORTIE`, stock_valeur.`STATUT`,employes.NOM_EMP, employes.PRENOM_EMP, stock_valeur.`DATE_INSERTION` 
                   FROM `stock_valeur` 
                   JOIN products ON products.PRODUCT_ID = stock_valeur.PRODUCT_ID 
                   JOIN employes ON employes.EMPLOYE_ID=stock_valeur.RESPONSABLE
                   WHERE products.PRODUCT_ID = " . $article . " AND `TYPE_STOCK` = '" . $type . "'";
                   // print_r($query_principal);die();

    $order_column=array("PRODUCT_DESC","QNTE_ENTREE","QNTE_SORTIE","TYPE_STOCK","DATE_INSERTION");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DATE_INSERTION  DESC';

    $search = !empty($_POST['search']['value']) ? (" AND  (QNTE_ENTREE LIKE '%$var_search%' OR PRODUCT_DESC LIKE '%$var_search%' OR QNTE_SORTIE LIKE '%$var_search%') ") : '';

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
    // print_r($fetch_data);die();
    

    foreach ($fetch_data as $row) {
      $sub_array = array();  
      $sub_array[] = $row->PRODUCT_DESC;
      $type = $row->TYPE_STOCK;
      if ($type == 1) {
        $tpe = "Pièces";
      }else{
        $tpe = "Paquets";
      }
      $sub_array[] = $tpe;
      $sub_array[] = $row->QNTE_ENTREE;
      $sub_array[] = $row->QNTE_SORTIE;
      $sub_array[] = $row->NOM_EMP.' '.$row->PRENOM_EMP;
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