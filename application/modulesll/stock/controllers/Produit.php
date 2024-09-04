<?php 
/**
/**
* @author nadvaxe2023
* le 08/10/2023
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Produit extends CI_Controller
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
    $data['page_title']="Ajout des nouveaux articles";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>';
    $data['Measure']=$this->Model->getRequete('SELECT * FROM `gros_unite` WHERE 1');    
    $this->load->view('Produit_view',$data);
  }

  function ajouter()
  {    
    $GROS_UNIT_ID=$this->input->post('GROS_UNIT_ID');
    $DESIGNATION=$this->input->post('DESIGNATION');
    $hourtime=date('Y-m-d H:i:s');

    $data=array(
      'GROS_UNIT_ID'=>$GROS_UNIT_ID,
      'GROS_PRODUIT_DESCR'=>$DESIGNATION,
      'DATE_INSERTION'=>$hourtime
    );


    $creation=$this->Model->create('gros_produit',$data);
    if ($creation)
    {

      $data['message']='<div class="alert alert-success alert-dismissible alert-alt solid fade show">
      <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
      </button>
      <center><strong>Opération effectuée avec succès</strong></center>
      </div>';
      $this->session->set_flashdata($data);
    }

    redirect(base_url('index.php/stock/Entrees_stock/'));

  }

  function liste()
  {


    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal="SELECT `GROS_PRODUIT_ID`, `GROS_PRODUIT_DESCR`, `GROS_UNIT_ID`, `DATE_INSERTION` FROM `gros_produit` WHERE 1";

    $order_column=array("GROS_PRODUIT_DESCR","GROS_UNIT_ID","DATE_INSERTION");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY GROS_PRODUIT_ID  ASC';

    $search = !empty($_POST['search']['value']) ? (" AND  (GROS_PRODUIT_ID LIKE '%$var_search%' OR GROS_PRODUIT_DESCR LIKE '%$var_search%',OR DATE_INSERTION LIKE '%$var_search%') ") : '';

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
      $sub_array[] = $row->GROS_UNIT_ID;
      $sub_array[] = $row->GROS_PRODUIT_DESCR;
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
    $this->Model->update('clients_sanya',array('ID_CLIENT'=>$id),array('STATUT'=>$value));
    echo json_encode(array('status'=>true));
  }
  function getOne($id)
  {
    $data=$this->Model->getRequeteOne('SELECT `ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `TEL_CLIENT`, `LOC_CLIENT`, `STATUT`, `DATE_INSERTION` FROM `clients_sanya` WHERE  ID_CLIENT='.$id);
    echo json_encode($data);
  }
  function update()
  {
    $nom=$this->input->post('NOM_CLIENT');
    $prenom=$this->input->post('PRENOM_CLIENT');
    $tel=$this->input->post('TEL_CLIENT');
    $localisation=$this->input->post('LOCALISATION');
    $this->Model->update('clients_sanya',array('ID_CLIENT'=>$this->input->post('ID_CLIENT')),array('NOM_CLIENT'=>$nom,'PRENOM_CLIENT'=>$prenom,'TEL_CLIENT'=>$tel,'LOC_CLIENT'=>$localisation));
    echo json_encode(array('status'=>true));
  }
}
?>