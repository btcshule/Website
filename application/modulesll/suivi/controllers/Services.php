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
    $data['page_title']="Gestionnaire des vente de services";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Stock</a></li>
    <li class="breadcrumb-item active" aria-current="page">Services</li>
    </ol>
    </nav>';
    $data['Measure']=$this->Model->getRequete('SELECT * FROM `cathegories` WHERE CATH_ID!=0');    
    $dateAujourdhui = date('Y-m-d');
    $data['somme'] = $this->Model->getRequeteOne("SELECT sum(`TOTAL_ACHAT`) as montant, DATE_INSERTION FROM `gros_entrees_stock` WHERE DATE(DATE_INSERTION) = '$dateAujourdhui'");    $data['fournisseur']=$this->Model->getRequete('SELECT `ID_FOURNISSEUR`, `NOM_FOURNISSEUR`, `PRENOM_FOURNISSEUR`, `TEL_FOURNISSEUR`, `LOC_FOURNISSEUR`, `STATUT` FROM `fournisseurs_sanya` WHERE 1 ORDER BY NOM_FOURNISSEUR ASC'); 
    $data['imputation']=$this->Model->getRequete('SELECT `ID_IMPUTATION`, `CODE_IMPUTATION`, `DESC_IMPUTATION` FROM `imputations` WHERE 1 ORDER BY CODE_IMPUTATION ASC');
    $data['clients'] = $this->Model->getRequete("SELECT GROS_CLIENT_ID,ADRESS_GROS_CLIENT,RS,RC,NIF,IS_CLIENT,ID_BRANCHE,NOM_GROS_CLIENT,TEL_GROS_CLIENT FROM `gros_client` WHERE IS_CLIENT=1 AND ID_BRANCHE=".$this->session->userdata('ID_BRANCHE')) ;
    $data['users'] = $this->Model->getRequete("SELECT `EMPLOYE_ID`, `NOM_EMP`, `PRENOM_EMP`, `EMAIL_EMP`, `TEL_EMP`, `PROFILE_ID`, `DIPLOME`, `IS_USER_SYSTEM`, `MOT_DE_PASSE`, `USER_ID`, `DATE_CREATION`, `IS_ACTIF`, `IS_MUST_CHANGE_PWD`, `ID_BRANCHE`, `STATUT` FROM `employes` WHERE 1 AND ID_BRANCHE=".$this->session->userdata('ID_BRANCHE')) ;




    $this->load->view('Services_view',$data);
  }

  function ajouter()
  {    

    $GROS_CLIENT_ID=$this->input->post('GROS_CLIENT_ID');
    $ID_USER=$this->input->post('EMPLOYE_ID');
    $LIBELLE=$this->input->post('LIBELLE');
    $PC=$this->input->post('PC');
    $MO=$this->input->post('MO');
    $AF=$this->input->post('AF');
    $COMMENTAIRE=$this->input->post('COMMENTAIRE');
    $PT=$PC+$MO+$AF;
    $VA=$this->input->post('VA');
    $PV=$PT+$VA;
    $STATUT=1;
    $RESP_CAISSE=$this->session->userdata('EMPLOYE_ID');
    $BRANCHE=$this->session->userdata('ID_BRANCHE');
    $hourtime=date('Y-m-d H:i:s');

    $data_inserer=array(
      'DESIGNATION'=>$LIBELLE,
      'ID_USER'=>$ID_USER,
      'BRANCHE'=>$BRANCHE,
      'ID_CLIENT'=>$GROS_CLIENT_ID,
      'PC'=>$PC,
      'MO'=>$MO,
      'AF'=>$AF,
      'PT'=>$PT,
      'VA'=>$VA,
      'PV'=>$PV,
      'STATUT'=>$STATUT,
      'COMMENTAIRE'=>$COMMENTAIRE,
      'DATE_CREATION'=>$hourtime
    );

    // $data_update=array(
    //   'QNTE'=>$Quantity,
    //   'PA_U'=>$PRIX_ACHAT,
    //   'PV_U'=>$PRIX_VENTE,
    //   'PA_T'=>$PT1,
    //   'DATE_INSERTION'=>$hourtime
    // );
    // $critaire = array(
    //   'PRODUCT_ID' => $GROS_PRODUIT_ID,
    //   'TYPE_STOCK' => $TYPE_STOCK
    // );
    $creation=$this->Model->create('services',$data_inserer);
    // $update = $this->Model->update('stock_secretariat', array('PRODUCT_ID' => $GROS_PRODUIT_ID, 'TYPE_STOCK' => $TYPE_STOCK), $data_update); 
    if ($creation)
    {
      $data['message']='<div class="alert alert-success alert-dismissible alert-alt solid fade show">
      <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
      </button>
      <center><strong>Opération effectuée avec succès</strong></center>
      </div>';
      $this->session->set_flashdata($data);
    }
    redirect(base_url('index.php/suivi/Services/'));
  }
  function del($id, $stat)
  {
    if ($stat == 1) 
    {
      $value = ($stat == 1) ? 0 : 1;
      $this->Model->update('data_livre_caisse', array('ID_LIVRE_CAISSE' => $id), array('STATUT' => $value));
      echo json_encode(array('status' => true));
    } else 
    {
      echo json_encode(array('status' => false, 'message' => 'La réactivation n\'est pas autorisée. Crée plutôt une nouvelle!'));
    }
  }

  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    // SELECT `ID_SERVICE`, `DESIGNATION`, `ID_USER`, `BRANCHE`, `ID_CLIENT`, `LIBELLE`, `PC`, `MO`, `AF`, `PT`, `VA`, `PV`, `DATE_CREATION`, `STATUT` FROM `services` WHERE 1

    $query_principal="SELECT `ID_SERVICE`, `DESIGNATION`, PRENOM_EMP, `DESCRIPTION_BRANCH`, `RS`, `PC`, `MO`, `AF`, `PT`, `VA`, `PV`,COMMENTAIRE, services.DATE_CREATION, services.STATUT FROM `services` JOIN employes ON employes.EMPLOYE_ID=services.ID_USER JOIN gros_client ON gros_client.GROS_CLIENT_ID=services.ID_CLIENT JOIN sanya_branches ON sanya_branches.ID_BRANCHE=services.BRANCHE WHERE 1";

    $order_column=array("DESIGNATION","PRENOM_EMP","DATE_CREATION");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DATE_CREATION  ASC';

    $search = !empty($_POST['search']['value']) ? (" AND  (DESIGNATION LIKE '%$var_search%' OR PRENOM_EMP LIKE '%$var_search%',OR DATE_CREATION LIKE '%$var_search%') ") : '';

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
      $sub_array[] = $row->DATE_CREATION;
      $sub_array[] = $row->RS; 
      $sub_array[] = $row->DESIGNATION;
      $sub_array[] = $row->PC;
      $sub_array[] = $row->MO;
      $sub_array[] = $row->AF;
      $sub_array[] = $row->PT;
      $sub_array[] = $row->VA;
      $sub_array[] = $row->PV;
      $sub_array[] = $row->COMMENTAIRE;
      $sub_array[] = $row->PRENOM_EMP;

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
  function getdesignations($GROS_UNIT_ID)
  {
    $html="<option value=''>-- Séléctionner --</option>";
    // SELECT `PRODUCT_ID`, `PRODUCT_DESC`, `CATH_ID`, `ID_BRANCHE` FROM `products` WHERE 1
    $DESIGNATION=$this->Model->getRequete("SELECT `PRODUCT_ID`, `PRODUCT_DESC`, `CATH_ID` FROM `products` WHERE  CATH_ID=".$GROS_UNIT_ID." ORDER BY PRODUCT_DESC ASC");

    foreach ($DESIGNATION as $article)
    {
      $html.="<option value='".$article['PRODUCT_ID']."'>".$article['PRODUCT_DESC']."</option>";
    }
    echo json_encode($html);
  }

  function getprix($GROS_PRODUIT_ID=0)
  {
    $data_stock = $this->Model->getOne('stock_secretariat',array('PRODUCT_ID'=>$GROS_PRODUIT_ID));
    echo json_encode($data_stock);
  }

}
?>