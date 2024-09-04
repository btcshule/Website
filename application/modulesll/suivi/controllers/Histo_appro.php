<?php 
/**
/**
* @author nadvaxe
*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");


class Histo_appro extends CI_Controller
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
    $data['page_title']="Suivi des approvisionnements";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>';
    $this->load->view('Histo_appro_view',$data);
  }
  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal="SELECT `ID_LIVRE_APPRO`, `LIBELLE`, `IMPUTATION`, NOM_EMP, PRENOM_EMP, `DEBIT`, `CREDIT`,SOLDE, `DATE_ENTREE`, `DATE_ACTION`,data_livre_banque.STATUT FROM `data_livre_banque` JOIN employes ON employes.EMPLOYE_ID=data_livre_banque.RESP_CAISSE WHERE 1";
    $order_column=array('LIBELLE','IMPUTATION','DEBIT','CREDIT','DATE_ACTION','NOM_EMP','PRENOM_EMP');

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DATE_ENTREE  DESC';
    $search = !empty($_POST['search']['value']) ? (" AND  (LIBELLE LIKE '%$var_search%' OR DEBIT LIKE '%$var_search%' OR IMPUTATION LIKE '%$var_search%' OR DATE_ENTREE LIKE '%$var_search%' OR PRENOM_EMP LIKE '%$var_search%') ") : '';
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
        $STATUT='Enregistrée';
      }else{
        $STATUT='Erronée';
      }

      $sub_array = array();  
      $option='';
      $sub_array[] = $row->ID_LIVRE_APPRO;
      $sub_array[] = $row->DATE_ENTREE;
      $sub_array[] = $row->LIBELLE;
      $sub_array[] = $row->IMPUTATION;
      $sub_array[] = $row->DEBIT;
      $sub_array[] = $row->CREDIT;
      $sub_array[] = $row->SOLDE;

      $sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
      $sub_array[] = $row->NOM_EMP.' '.$row->PRENOM_EMP;

      $sub_array[] = '<a href="javascript:void(0);" onclick="supp_logic('.$row->ID_LIVRE_APPRO.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
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

 function del($id, $stat)
  {
    if ($stat == 1) 
    {
      $value = ($stat == 1) ? 0 : 1;
      $this->Model->update('data_livre_banque', array('ID_LIVRE_APPRO' => $id), array('STATUT' => $value));
      echo json_encode(array('status' => true));
    } else 
    {
      echo json_encode(array('status' => false, 'message' => 'La réactivation n\'est pas autorisée. Crée plutôt une nouvelle!'));
    }
  }
}

?>