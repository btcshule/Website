<?php 
/**
/**
* @author nadvaxe
*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");
class Approvisionnement extends CI_Controller
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
    $data['page_title']="Gestionnaire des Approvisionnement";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>';
     $data['imputation']=$this->Model->getRequete('SELECT `ID_IMPUTATION`, `CODE_IMPUTATION`, `DESC_IMPUTATION` FROM `imputations` WHERE 1 ORDER BY CODE_IMPUTATION ASC');

    $this->load->view('Approvisionnement_view',$data);
  }

  function ajouter()
  {
    // $this->_validate();
    $DATE_ENTREE=$this->input->post('DATE_ENTREE');
    $LIBELLE=$this->input->post('LIBELLE');
    $IMPUTATION=$this->input->post('IMPUTATION');
    $MONTANT=$this->input->post('MONTANT');
    $RESP_CAISSE=$this->session->userdata('EMPLOYE_ID');
    $EST_ENTREE=1;
    $STATUT=1;
    $CREDIT=0;

    $max = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_APPRO) AS MAXIMUM FROM data_livre_approvisionnement");
    $idmax = $max['MAXIMUM'];
    if (empty($idmax)) 
    {
      $SOLDE = 0;
    } else 
    {
     $solde = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_approvisionnement WHERE ID_LIVRE_APPRO=".$idmax);
     $SOLDE = $solde['SOLDE'];
    }
   $SOLDE1 = $SOLDE + $MONTANT;
    $data=array('DATE_ENTREE'=>trim($DATE_ENTREE),'LIBELLE'=>trim($LIBELLE),'IMPUTATION'=>trim($IMPUTATION),'DEBIT'=>trim($MONTANT),'STATUT'=>trim($STATUT),'CREDIT'=>trim($CREDIT),'SOLDE'=>trim($SOLDE1),'RESP_CAISSE'=>trim($RESP_CAISSE),'EST_ENTREE'=>trim($EST_ENTREE));
    $this->Model->create('data_livre_approvisionnement',$data);
    echo json_encode(array('status'=>true));
  }

   function del($id, $stat)
  {
    if ($stat == 1) {
      $value = 0;
    $this->Model->update('data_livre_approvisionnement',array('ID_LIVRE_APPRO'=>$id),array('STATUT'=>$value));
      echo json_encode(array('status' => true));
    } else {
      echo json_encode(array('status' => false, 'message' => 'Erreur : Action non autorisée.'));
    }
  }

  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal="SELECT `ID_LIVRE_APPRO`, `LIBELLE`,`IMPUTATION`,NOM_EMP,PRENOM_EMP, `DEBIT`, `CREDIT`, `DATE_ENTREE`, `EST_ENTREE`, data_livre_approvisionnement.STATUT, `DATE_ACTION`, `RESP_CAISSE` FROM `data_livre_approvisionnement` JOIN employes ON employes.EMPLOYE_ID=data_livre_approvisionnement.RESP_CAISSE WHERE EST_ENTREE=1";
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

  function _validate()
  {
    $data=array();
    $data['error_string']=array();
    $data['inputerror']=array();
    $data['status']=true;

    $check_livre_caisse=$this->Model->getOne('data_livre_approvisionnement',array('LIBELLE'=>$this->input->post('LIBELLE'),'ID_LIVRE_APPRO!='=>$this->input->post('ID_LIVRE_APPRO')));


    if ($this->input->post('LIBELLE')=="") 
    {

      $data['error_string'][]="Le champs est obligatoire";
      $data['inputerror'][]="LIBELLE";
      $data['status']=false;
    }

    
    if ($check_livre_caisse) {
        # code...
      $data['error_string'][]="Vous l'avez déjà tapé";
      $data['inputerror'][]="ID_LIVRE_APPRO";
      $data['status']=false;
    }



    if ($data['status']==FALSE) 
    {
      # code...
      echo json_encode($data);
      exit();
    }
  }



}

?>