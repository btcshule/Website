<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");


class Articles extends CI_Controller
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
    $data['page_title']="Gestionnaire des approvisionnements";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Gestion de stock</a></li>
    <li class="breadcrumb-item active" aria-current="page">Articles</li>
    </ol>
    </nav>';
    $data['Measure']=$this->Model->getRequete('SELECT * FROM `cathegories` WHERE CATH_ID!=0');    
    $this->load->view('Articles_view',$data);
  }
  function ajouter()
  { 
    $CATHEGORIE=$this->input->post('GROS_UNIT_ID');
    $DESIGNATION=$this->input->post('DESIGNATION');
    $CODE=$this->input->post('CODE');
    $NOMBRE_PIECE=$this->input->post('NOMBRE_PIECE');
    $hourtime=date('Y-m-d H:i:s');

    $verify= array('PRODUCT_DESC'=>$DESIGNATION);

    $check = $this->Model->getOne("products",$verify);

    if(!empty($check)){
     $data['message']='<div class="alert alert-danger alert-dismissible alert-alt solid fade show">
     <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
     </button>
     <center><strong>Ce produit existe déjà</strong></center>
     </div>';
     $this->session->set_flashdata($data);
     $data['page_title']="Gestion des approvisionnements";
     $data['Measure']=$this->Model->getRequete('SELECT * FROM `cathegories` WHERE 1');    

     $this->load->view('Articles_view',$data);
     
   }
   else
   {

    $table='products';
    $table1='stock_secretariat';

    if ($CATHEGORIE!=0) {    
    $data= array(
      'PRODUCT_DESC' =>$DESIGNATION,
      'CATH_ID'=>$CATHEGORIE,
      'PIECES'=>$NOMBRE_PIECE,
      'CODE'=>$CODE
    );
    $creation=$this->Model->insert_last_id($table,$data);
    $dataS = array(
      'PRODUCT_ID' => $creation,
      'TYPE_STOCK' => 1,
      'STATUT' => 1
    );
    $creationleft = $this->Model->create($table1, $dataS);
    $data1 = array(
      'PRODUCT_ID' => $creation,
      'TYPE_STOCK' => 2,
      'STATUT' => 1
    );
    $creationright = $this->Model->create($table1, $data1);
    }
    else{
      $data= array(
      'PRODUCT_DESC' =>$DESIGNATION,
      'CATH_ID'=>$CATHEGORIE,
      'PIECES'=>$NOMBRE_PIECE,
      'CODE'=>$CODE
    );
    $creation=$this->Model->insert_last_id($table,$data);
    }

    if ($creation && $creationleft)
    {

      $data['message']='<div class="alert alert-danger alert-dismissible alert-alt solid fade show">
      <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
      </button>
      <center><strong>Operation done,'.$this->input->post('DESIGNATION').'insérée.</strong></center>
      </div>';
      $this->session->set_flashdata($data);
    }
    
    redirect(base_url('index.php/stock/Articles/'));
  }
}

function liste()
{


  $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
  $query_principal="SELECT `PRODUCT_ID`, `PRODUCT_DESC`, `CATH_DESC`, `CODE`, `PIECES`, `DATE_INSERTION` FROM `products` JOIN cathegories ON cathegories.CATH_ID=products.CATH_ID WHERE 1";
  $order_column=array("PRODUCT_DESC","CATH_ID","DATE_INSERTION","CODE","PIECES");

  $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY PRODUCT_DESC ASC';

  $search = !empty($_POST['search']['value']) ? (" AND  (PRODUCT_ID LIKE '%$var_search%' OR PRODUCT_DESC LIKE '%$var_search%' OR DATE_INSERTION LIKE '%$var_search%') ") : '';

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
    $sub_array[] = $row->CATH_DESC;
    $sub_array[] = $row->CODE;
    $sub_array[] = $row->PRODUCT_DESC;
    $sub_array[] = $row->PIECES;
    // $sub_array[] = $row->DATE_INSERTION;
    $sub_array[] = date("d-m-Y H:i", strtotime($row->DATE_INSERTION));
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
function _validate()
{
  $data=array();
  $data['error_string']=array();
  $data['inputerror']=array();
  $data['status']=true;

  $check_livre_caisse=$this->Model->getOne('data_livre_caisse',array('LIBELLE'=>$this->input->post('LIBELLE'),'ID_LIVRE_CAISSE!='=>$this->input->post('ID_LIVRE_CAISSE')));

  if ($this->input->post('LIBELLE')=="") 
  {
    $data['error_string'][]="Le champs est obligatoire";
    $data['inputerror'][]="LIBELLE";
    $data['status']=false;
  }
  if ($check_livre_caisse) {
    $data['error_string'][]="Vous l'avez déjà tapé";
    $data['inputerror'][]="ID_LIVRE_CAISSE";
    $data['status']=false;
  }
  if ($data['status']==FALSE) 
  {
    echo json_encode($data);
    exit();
  }
}
}
?>