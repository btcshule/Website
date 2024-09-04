<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");


class Services extends CI_Controller
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
    $data['page_title']="Gestion des approvisionnements";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Gestion de stock</a></li>
    <li class="breadcrumb-item active" aria-current="page">Articles</li>
    </ol>
    </nav>';
    $data['Measure']=$this->Model->getRequete('SELECT * FROM `cathegories_services` WHERE 1');    
    $this->load->view('Services_view',$data);
  }
  function ajouter()
  { 
    $CATHEGORIE=$this->input->post('GROS_UNIT_ID');
    $LIBELLE=$this->input->post('LIBELLE');
    $CODE=$this->input->post('CODE');
    $PRIX=$this->input->post('PRIX');
    $hourtime=date('Y-m-d H:i:s');

    $verify= array('PRODUCT_DESC'=>$LIBELLE);

    $check = $this->Model->getOne("products",$verify);

    if(!empty($check)){
     $data['message']='<div class="alert alert-danger alert-dismissible alert-alt solid fade show">
     <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
     </button>
     <center><strong>Ce service existe déjà</strong></center>
     </div>';
     $this->session->set_flashdata($data);
     $data['page_title']="Gestion des services";
     $data['Measure']=$this->Model->getRequete('SELECT * FROM `cathegories_services` WHERE 1');    

     $this->load->view('Services_view',$data);
     
   }
   else
   {

    $table='sanya_services';
    // $table1='stock_secretariat';

    // if ($CATHEGORIE!=0) {    
    $data= array(
      'PRODUCT_DESC' =>$LIBELLE,
      'CATH_ID'=>$CATHEGORIE,
      'PRIX'=>$PRIX,
      'CODE'=>$CODE
    );
    $creation=$this->Model->insert_last_id($table,$data);
    if ($creation)
    {

      $data['message']='<div class="alert alert-danger alert-dismissible alert-alt solid fade show">
      <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
      </button>
      <center><strong>Operation faite,'.$this->input->post('LIBELLE').'insérée.</strong></center>
      </div>';
      $this->session->set_flashdata($data);
    }
    
    redirect(base_url('index.php/stock/Services/'));
  }
}

function liste()
{


  $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
  $query_principal="SELECT `PRODUCT_ID`, `PRODUCT_DESC`, `CATH_DESC`, `CODE`, `PRIX`, `ID_BRANCHE`, `DATE_INSERTION` FROM `sanya_services` LEFT JOIN cathegories_services ON cathegories_services.CATH_ID=sanya_services.CATH_ID WHERE 1";
  $order_column=array("PRODUCT_DESC","CATH_DESC","CODE","PRIX","DATE_INSERTION");

  $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY PRODUCT_DESC ASC';

  $search = !empty($_POST['search']['value']) ? (" AND  (PRODUCT_DESC LIKE '%$var_search%' OR CATH_DESC LIKE '%$var_search%' OR CODE LIKE '%$var_search%' OR PRIX LIKE '%$var_search%' OR DATE_INSERTION LIKE '%$var_search%') ") : '';

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
    $sub_array[] = $row->PRIX;
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