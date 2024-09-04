<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");


class Statistiques extends CI_Controller
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
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Rapport</a></li>
    <li class="breadcrumb-item active" aria-current="page">Statistiques</li>
    </ol>
    </nav>';
     $year = date('Y'); // Récupère le numéro du mois en cours
    $data['stock']=$this->Model->getRequeteOne("SELECT COUNT(PRODUCT_ID) AS produits FROM `products` WHERE 1");
    $data['achats']=$this->Model->getRequeteOne("SELECT SUM(TOTAL_ACHAT) AS somme FROM `gros_entrees_stock` WHERE 1");

    $emax = $this->Model->getRequeteOne("SELECT MAX(ID_E_BANK) AS MAXIMUM FROM e_bank");

    if (is_array($emax) && isset($emax['MAXIMUM'])) {
      $idmax = $emax['MAXIMUM'];
      $solde = $this->Model->getRequeteOne("SELECT SOLDE FROM e_bank WHERE ID_E_BANK=".$idmax);
    } else {
      $solde = array('SOLDE' => 0);
    }

    $data['solde'] = $solde;

    $smax = $this->Model->getRequeteOne("SELECT MAX(ID_E_BANK) AS MAXIMUM FROM s_bank");

    if (is_array($smax) && isset($smax['MAXIMUM'])) {
      $idmax = $smax['MAXIMUM'];
      $soldes = $this->Model->getRequeteOne("SELECT SOLDE FROM s_bank WHERE ID_E_BANK=".$idmax);
    } else {
      $soldes = array('SOLDE' => 0);
    }

    $data['soldes'] = $soldes;

    $cs_max = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_CAISSE) AS MAXIMUM FROM data_livre_caisse");

    if (is_array($cs_max) && isset($cs_max['MAXIMUM'])) {
      $idmax = $cs_max['MAXIMUM'];
      $ventes = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_caisse WHERE ID_LIVRE_CAISSE=".$idmax);
    } else {
      $ventes = array('SOLDE' => 0);
    }
    $data['ventes'] = $ventes;
    
    $approv_max = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_APPRO) AS MAXIMUM FROM data_livre_approvisionnement");
    if (is_array($approv_max) && isset($approv_max['MAXIMUM'])) {
      $idmax = $approv_max['MAXIMUM'];
      $approv = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_approvisionnement WHERE ID_LIVRE_APPRO=".$idmax);
    } else {
      $approv = array('SOLDE' => 0);
    }
    $data['approv'] = $approv;


    $bq_max = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_BANQUE) AS MAXIMUM FROM data_livre_banque");
    if (is_array($bq_max) && isset($bq_max['MAXIMUM'])) {
      $idmax = $bq_max['MAXIMUM'];
      $banque = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_banque WHERE ID_LIVRE_BANQUE=".$idmax);
    } else {
      $banque = array('SOLDE' => 0);
    }
    $data['banque'] = $banque;

   $app_max = $this->Model->getRequeteOne("SELECT MAX(ID_LIVRE_APPRO) AS MAXIMUM FROM data_livre_approvisionnement");
    if (is_array($app_max) && isset($app_max['MAXIMUM'])) {
      $idmax = $app_max['MAXIMUM'];
      $appro = $this->Model->getRequeteOne("SELECT SOLDE FROM data_livre_approvisionnement WHERE ID_LIVRE_APPRO=".$idmax);
    } else {
      $appro = array('SOLDE' => 0);
    }
    $data['appro'] = $appro;

    $data['dettes']=$this->Model->getRequeteOne("SELECT SUM(MONTANT) AS somme2 FROM `dettes_internes` WHERE 1");
    $data['creances']=$this->Model->getRequeteOne("SELECT SUM(MONTANT) AS creance FROM `dettes_externes` WHERE 1"); 
    $data['clients']=$this->Model->getRequeteOne("SELECT COUNT(GROS_CLIENT_ID) AS somme4 FROM `gros_client` WHERE 1");
    $data['frss']=$this->Model->getRequeteOne("SELECT COUNT(ID_FOURNISSEUR) AS frss FROM `fournisseurs_sanya` WHERE 1");

    $data['services']=$this->Model->getRequeteOne("SELECT SUM(NET_PAID) AS somme3 FROM `mag_ventes_services` WHERE 1");
    $data['produits_achetes']=$this->Model->getRequeteOne("SELECT SUM(TOTAL_ACHAT) AS stocks FROM `gros_entrees_stock` WHERE 1");
    $data['produits_vendus']=$this->Model->getRequeteOne("SELECT SUM(PRIX_TOTAL) AS ventes FROM `mag_ventes_produits` WHERE 1"); 
    $data['consommables']=$this->Model->getRequeteOne("SELECT SUM(`PC`) AS CONSOMMABLES FROM `services` WHERE 1"); 
    $data['stock_dispo']=$data['produits_achetes']['stocks']-$data['produits_vendus']['ventes']-$data['consommables']['CONSOMMABLES'];
    $data['total_vente']=$data['services']['somme3']+$data['produits_vendus']['ventes'];
    $this->load->view('Statistiques_view',$data);
  }
}
?>