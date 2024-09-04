<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class E_money extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->is_auth();
  }

  function is_auth()
  {
    if (empty($this->session->userdata('EMPLOYE_ID'))) {
      redirect(base_url(''));
    }
  }

  function index()
  {

    $data['page_title']="Transactions éléctroniques";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>';
    $data['imputation']=$this->Model->getRequete('SELECT `ID_IMPUTATION`, `CODE_IMPUTATION`, `DESC_IMPUTATION` FROM `imputations` WHERE 1 ORDER BY CODE_IMPUTATION ASC');
    $this->load->view('E_money_view',$data);
  }

  function ajouter()
  {
    $CASH=$this->input->post('CASH');
    $COMMENTS=$this->input->post('COMMENTS');
    $ELECTRONIQUE=$this->input->post('ELECTRONIQUE');
    $COMMISSION=$this->input->post('COMMISSION');
    $TYPE_AGENT=$this->input->post('TYPE_AGENT');
    $TELEPHONE=$this->input->post('TELEPHONE');
    $RESP_ELECT=$this->session->userdata('EMPLOYE_ID');
    $STATUT=1;
    $DATE_ENTREE=$this->input->post('DATE_ENTREE');
    $max = $this->Model->getRequeteOne("SELECT MAX(ID_E_BANK) AS MAXIMUM FROM e_bank");
    $idmax = $max['MAXIMUM'];
    // print_r($idmax);die();
    if (!empty($idmax)) {
       $solde = $this->Model->getRequeteOne("SELECT SOLDE FROM e_bank WHERE ID_E_BANK=".$idmax);
      $SOLDE = $solde['SOLDE'];
      $SOLDE1 = $SOLDE+$COMMISSION;

    } else {
      $SOLDE1 =$COMMISSION+$CASH;
    }
    $data=array('LIBELLE'=>trim($COMMENTS),'MONTANT'=>trim($CASH),'ELECTRONIQUE'=>trim($ELECTRONIQUE),'COMMISSION'=>trim($COMMISSION),'SOLDE'=>trim($SOLDE1),'TYPE_AGENT'=>trim($TYPE_AGENT),'DATE_ENTREE'=>trim($DATE_ENTREE),'TELEPHONE'=>trim($TELEPHONE),'STATUT'=>trim($STATUT),'RESP_ELECT'=>trim($RESP_ELECT));
    $data_suivi= array('CASH' =>trim($CASH),'ELECTRONIQUE'=>trim($ELECTRONIQUE),'RESP_ELECT'=>trim($RESP_ELECT));
    $this->Model->create('e_bank',$data);
    $this->Model->create('suivi_ebank',$data_suivi);
    echo json_encode(array('status'=>true));
  }
  function supp_logic($id,$is_actif)
  {
    if ($is_actif==0) {
      # code...
      $STATUT = 2;
    }elseif ($is_actif==1) {
      # code...
      $STATUT = 2;
    }else{
      $STATUT = 0;
    }

    $this->Model->update('electroniques',array('ID_AGENT'=>$id),array('STATUT'=>$STATUT));
    echo json_encode(array('status'=>true));
  }

  function confirm_item($id,$stat)
  {

    $this->Model->update('electroniques',array('ID_AGENT'=>$id),array('STATUT'=>1));
    echo json_encode(array('status'=>true));
  }
  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $query_principal=" SELECT `ID_E_BANK`, `LIBELLE`, `MONTANT`,ELECTRONIQUE, `COMMISSION`, `SOLDE`, `TYPE_AGENT`, `DATE_ENTREE`, e_bank.STATUT, `DATE_ACTION`, NOM_EMP,PRENOM_EMP,TELEPHONE FROM `e_bank` JOIN employes ON employes.EMPLOYE_ID=e_bank.RESP_ELECT WHERE 1";
    $order_column=array('LIBELLE','MONTANT','COMMISSION','ELECTRONIQUE','SOLDE','TELEPHONE','TYPE_AGENT','DATE_ENTREE','STATUT','DATE_ACTION','NOM_EMP');

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DATE_ACTION  DESC';

    $search = !empty($_POST['search']['value']) ? (" AND  (LIBELLE LIKE '%$var_search%' OR MONTANT LIKE '%var_search%' OR COMMISSION LIKE '%var_search%' OR SOLDE LIKE '%var_search%' OR ELECTRONIQUE LIKE '%var_search%' OR OR TELEPHONE LIKE '%var_search%' OR TYPE_AGENT LIKE '%var_search%' OR DATE_ENTREE LIKE '%var_search%' OR STATUT LIKE '%var_search%' OR DATE_ACTION LIKE '%var_search%' OR NOM_EMP LIKE '%var_search%') ") : '';

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
      $option='';
      $sub_array[] = $row->TYPE_AGENT;
      $sub_array[] = $row->LIBELLE;
      $sub_array[] = $row->TELEPHONE;
      $sub_array[] = $row->MONTANT;
      $sub_array[] = $row->ELECTRONIQUE;
      $sub_array[] = $row->COMMISSION;
      $sub_array[] = $row->SOLDE;
      $sub_array[] = $row->DATE_ENTREE;
      $sub_array[] = $row->PRENOM_EMP.' '.$row->NOM_EMP;

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
