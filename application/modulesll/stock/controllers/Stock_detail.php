<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Stock_detail extends CI_Controller
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

    $data['page_title']="Stock Détaillé";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Acceuil</a></li>
    <li class="breadcrumb-item"><a href="#">Stock</a></li>
    <li class="breadcrumb-item active" aria-current="page">Détails</li>
    </ol>
    </nav>';
    $data['Measure']=$this->Model->getRequete('SELECT * FROM `gros_unite` WHERE 1');    
    $data['somme']=$this->Model->getRequeteOne('SELECT sum(`TOTAL_ACHAT`) as montant FROM `gros_entrees_stock` WHERE 1');
    $data['fournisseur']=$this->Model->getRequete('SELECT `ID_FOURNISSEUR`, `NOM_FOURNISSEUR`, `PRENOM_FOURNISSEUR`, `TEL_FOURNISSEUR`, `LOC_FOURNISSEUR`, `STATUT` FROM `fournisseurs_sanya` WHERE 1 ORDER BY NOM_FOURNISSEUR ASC');   

    // $somme1=$data['somme']['montant'];
    // print_r($somme1);die();
    $this->load->view('Stock_detail_view',$data);
  }

  function ajouter()
  {    
    $GROS_UNIT_ID=$this->input->post('GROS_UNIT_ID');
    $GROS_PRODUIT_ID=$this->input->post('GROS_PRODUIT_ID');
    $QUANT_DISPO=$this->input->post('QUANT_DISPO');
    $PRIX_ACHAT=$this->input->post('PRIX_ACHAT');
    $PRIX_VENTE=$this->input->post('PRIX_VENTE');
    $QUANTITE=$this->input->post('QUANTITE');
    $COMMENTAIRE=$this->input->post('COMMENTAIRE');
    $ID_FOURNISSEUR=$this->input->post('ID_FOURNISSEUR');
    $RESP_CAISSE=$this->session->userdata('EMPLOYE_ID');
    $hourtime=date('Y-m-d H:i:s');

    $Quantity=$QUANT_DISPO+$QUANTITE;
    $PT=$QUANTITE*$PRIX_ACHAT;
    $PT1=$Quantity*$PRIX_ACHAT;

    $data_inserer=array(
      'GROS_STOCK_ID'=>$GROS_PRODUIT_ID,
      'QUANTITE_PRODUIT'=>$QUANTITE,
      'PRIX_ACHAT_UNITAIRE'=>$PRIX_ACHAT,
      'PRIX_VENTE_UNITAIRE'=>$PRIX_VENTE,
      'TOTAL_ACHAT'=>$PT,
      'ID_FOURNISSEUR'=>$ID_FOURNISSEUR,
      'RESP_CAISSE'=>$RESP_CAISSE,
      'COMMENTAIRE'=>$COMMENTAIRE,
      'DATE_INSERTION'=>$hourtime
    );
    $data_update=array(
      'QNTE'=>$Quantity,
      'PA_U'=>$PRIX_ACHAT,
      'PV_U'=>$PRIX_VENTE,
      'PA_T'=>$PT1,
      'DATE_INSERTION'=>$hourtime
    );
    $creation=$this->Model->create('gros_entrees_stock',$data_inserer);
    $update=$this->Model->update('gros_stock', array('GROS_PRODUIT_ID' =>$GROS_PRODUIT_ID), $data_update);
    if ($creation && $update)
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

    $query_principal="SELECT
    `ID_ENTREE`,
    products.PRODUCT_DESC,
    `QUANTITE_PRODUIT`,
    `PRIX_ACHAT_UNITAIRE`,
    fournisseurs_sanya.NOM_FOURNISSEUR,
    fournisseurs_sanya.PRENOM_FOURNISSEUR,
    fournisseurs_sanya.LOC_FOURNISSEUR,
    employes.NOM_EMP,
    employes.PRENOM_EMP,
    `TOTAL_ACHAT`,
    `PRIX_VENTE_UNITAIRE`,
    `COMMENTAIRE`,
    gros_entrees_stock.DATE_INSERTION
FROM
    `gros_entrees_stock`
LEFT JOIN stock_secretariat ON stock_secretariat.SECR_STOCK_ID = gros_entrees_stock.GROS_STOCK_ID
LEFT JOIN products ON products.PRODUCT_ID = stock_secretariat.PRODUCT_ID
LEFT JOIN fournisseurs_sanya ON fournisseurs_sanya.ID_FOURNISSEUR = gros_entrees_stock.ID_FOURNISSEUR
JOIN employes ON employes.EMPLOYE_ID = gros_entrees_stock.RESP_CAISSE
WHERE
    1";

    $order_column=array("GROS_PRODUIT_DESCR","NOM_FOURNISSEUR","DATE_INSERTION");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY gros_entrees_stock.DATE_INSERTION  ASC';

    $search = !empty($_POST['search']['value']) ? (" AND  (GROS_PRODUIT_DESCR LIKE '%$var_search%' OR NOM_FOURNISSEUR LIKE '%$var_search%',OR gros_entrees_stock.DATE_INSERTION LIKE '%$var_search%') ") : '';

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
      $sub_array[] = $row->QUANTITE_PRODUIT;
      $sub_array[] = $row->PRIX_ACHAT_UNITAIRE;
      $sub_array[] = $row->PRIX_VENTE_UNITAIRE;
      $sub_array[] = $row->TOTAL_ACHAT;
      $sub_array[] = $row->NOM_FOURNISSEUR.' '.$row->PRENOM_FOURNISSEUR.'('.$row->LOC_FOURNISSEUR.')';
      $sub_array[] = $row->PRENOM_EMP.' '.$row->NOM_EMP;
      $sub_array[] = $row->COMMENTAIRE;
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
  function getdesignations($GROS_UNIT_ID)
  {
    $html="<option value=''>-- Séléctionner --</option>";
    $DESIGNATION=$this->Model->getRequete("SELECT `GROS_PRODUIT_ID`, `GROS_PRODUIT_DESCR`, `GROS_UNIT_ID`, `DATE_INSERTION` FROM `gros_produit` WHERE  GROS_UNIT_ID=".$GROS_UNIT_ID." ORDER BY GROS_PRODUIT_DESCR ASC");
    foreach ($DESIGNATION as $article)
    {
      $html.="<option value='".$article['GROS_PRODUIT_ID']."'>".$article['GROS_PRODUIT_DESCR']."</option>";
    }
    echo json_encode($html);
  }

  function getprix($GROS_PRODUIT_ID=0)
  {
    // $datas=$this->Model->getRequeteOne("SELECT `GROS_STOCK_ID`, `GROS_PRODUIT_ID`, `QNTE`, `PA_U`, `PV_U`, `PA_T`, `STATUT`, `DATE_INSERTION` FROM `gros_stock` WHERE 1");
  $data_stock = $this->Model->getOne('gros_stock',array('GROS_PRODUIT_ID'=>$GROS_PRODUIT_ID));

    // print_r($datas);die();

    echo json_encode($data_stock);
  }

}
?>