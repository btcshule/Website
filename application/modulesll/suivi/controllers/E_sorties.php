<?php 
/**
/**
* @author nadvaxe
*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");


class E_sorties extends CI_Controller
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

    $this->load->view('E_sorties_view',$data);
  }

function ajouter()
  {
    $CASH=$this->input->post('CASH');
    $COMMENTS=$this->input->post('COMMENTS');
    $ELECTRONIQUE=$this->input->post('ELECTRONIQUE');
    $TYPE_AGENT=$this->input->post('TYPE_AGENT');
    $IMPUTATION=$this->input->post('IMPUTATION');
    $RESP_ELECT=$this->session->userdata('EMPLOYE_ID');
    $SOMME_DEBIT=0;
    $SOMME_CREDIT=$CASH+$ELECTRONIQUE;
    $EST_ENTREE=0;
    $STATUT=1;
    $DATE_ENTREE=$this->input->post('DATE_ENTREE');
    $max = $this->Model->getRequeteOne("SELECT MAX(ID_ELE) AS MAXIMUM FROM data_electronique");
    if (!empty($max)) 
    {
    $idmax = $max['MAXIMUM'];
    $solde = $this->Model->getRequeteOne("SELECT SOLDE FROM data_electronique WHERE ID_ELE=".$idmax);
    }
    $SOLDE=0;
    if (!empty($solde)) {
     $SOLDE = $solde['SOLDE'];    
    }
    $SOLDE1 = $SOLDE - $SOMME_CREDIT;
    $data=array('CASH'=>trim($CASH),'DESC_TRANS'=>trim($COMMENTS),'ELECTRONIQUE'=>trim($ELECTRONIQUE), 'TYPE_AGENT'=>trim($TYPE_AGENT),'DEBIT'=>trim($SOMME_DEBIT),'CREDIT'=>trim($SOMME_CREDIT),'SOLDE'=>trim($SOLDE1),'EST_ENTREE'=>trim($EST_ENTREE),'RESP_ELECT'=>trim($RESP_ELECT));
    $datas=array('DATE_ENTREE'=>trim($DATE_ENTREE),'LIBELLE'=>trim($COMMENTS),'IMPUTATION'=>trim($IMPUTATION),'DEBIT'=>trim($SOMME_DEBIT),'STATUT'=>trim($STATUT),'CREDIT'=>trim($SOMME_CREDIT),'SOLDE'=>trim($SOLDE1),'RESP_ELECT'=>trim($RESP_ELECT),'EST_ENTREE'=>trim($EST_ENTREE));

    $this->Model->create('data_electronique',$datas);
    $this->Model->create('electroniques',$data);
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

    $this->Model->update('s_electroniques',array('ID_AGENT'=>$id),array('STATUT'=>$STATUT));
    echo json_encode(array('status'=>true));
  }

  function confirm_item($id,$stat)
  {

    $this->Model->update('s_electroniques',array('ID_AGENT'=>$id),array('STATUT'=>1));
    echo json_encode(array('status'=>true));
  }


  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $query_principal="SELECT `ID_AGENT`,  `TYPE_AGENT`,`CASH`, `ELECTRONIQUE`, `DESC_TRANS`, `DATE_INSERTION`, `RESP_ELECT`,PRENOM_EMP,NOM_EMP, EST_ENTREE,SOLDE FROM `electroniques`  JOIN employes ON employes.EMPLOYE_ID=electroniques.RESP_ELECT WHERE 1 AND EST_ENTREE=0";
    $order_column=array('CASH','TYPE_AGENT','ELECTRONIQUE','DESC_TRANS','DATE_INSERTION','RESP_ELECT');

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DATE_INSERTION  DESC';

    $search = !empty($_POST['search']['value']) ? (" AND  (CASH LIKE '%$var_search%' OR ELECTRONIQUE LIKE '%var_search%' OR TYPE_AGENT LIKE '%var_search%' OR RESP_ELECT LIKE '%var_search%' OR DESC_TRANS LIKE '%var_search%' OR DATE_INSERTION LIKE '%var_search%') ") : '';

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
      $sub_array[] = $row->CASH;
      $sub_array[] = $row->ELECTRONIQUE;
      $tot=$row->ELECTRONIQUE+$row->CASH;
      $sub_array[] = $tot;
      $sub_array[] = $row->DESC_TRANS;
      $sub_array[] = $row->DATE_INSERTION;
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