<?php
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");

class Fact_services extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    require('fpdf184/fpdf.php');
  }
  ///my functions
 
  public function index()
  {   
    $GROS_CLIENT_FACT_ID=$this->uri->segment(4);
   $branch=$this->session->userdata('ID_BRANCHE');
  $facture=$this->Model->getRequete('SELECT sanya_services.PRODUCT_DESC,mag_ventes_services.QUANTITE,mag_ventes_services.PRIX_UNITAIRE,mag_ventes_services.PRIX_TOTAL FROM mag_client_factur join mag_ventes_services ON mag_ventes_services.GROS_CLIENT_FACT_ID=mag_client_factur.GROS_CLIENT_FACT_ID JOIN sanya_services ON sanya_services.PRODUCT_ID=mag_ventes_services.STOCK_ID WHERE 1 AND mag_client_factur.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);
     // print_r($facture);die();

  $client=$this->Model->getRequeteOne('SELECT * FROM mag_client_factur join gros_client ON gros_client.GROS_CLIENT_ID=mag_client_factur.GROS_CLIENT_ID JOIN employes ON employes.EMPLOYE_ID=mag_client_factur.SELLER WHERE mag_client_factur.ID_BRANCHE="'.$branch.'" AND  mag_client_factur.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

  $clientId=$this->Model->getRequeteOne('SELECT * FROM mag_client_factur WHERE mag_client_factur.ID_BRANCHE="'.$branch.'" AND mag_client_factur.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

  $custID=$clientId['GROS_CLIENT_ID'];
  if ($custID<10) {
    $ourclientId='00'.$custID;
  }elseif($custID>9 || $custID<99){
    $ourclientId='0'.$custID;
  }else{
   $ourclientId=$custID; 
 }
 if (empty($client['TEL_GROS_CLIENT'])) {
  $TEL='N/A';
}else{
  $TEL=$client['TEL_GROS_CLIENT'];}

  if (empty($client['ADRESS_GROS_CLIENT'])) {
    $NIF='N/A';
  }else{$NIF=$client['ADRESS_GROS_CLIENT'];}

  $pdf=new FPDF('P','mm','A4');
  $pdf->AddPage();
  $pdf->SetMargins(25,20);
  $pdf->SetFont('times', 'B', 20);
  $pdf->Cell(15, 5, '', 0, 0);
$pdf->Cell(160,10,'FACTURE NO '.$client['NUM_FACTURE'].'',1,1,'C');
  $pdf->SetFont('times', 'B', 10);

  $pdf->Cell(59, 8, 'A.IDENTIFICATION DU VENDEUR', 0, 1);
  $pdf->SetFont('times', '', 11);
  $pdf->Cell(30, 5, 'Reseau social', 0, 0);
  $pdf->SetFont('times', 'BI', 14);
  $pdf->Cell(42, 5, ': SANYA SHOP', 0, 0);
    $pdf->SetFont('times', '', 11);
  $pdf->Cell(12, 5, 'NIF', 0, 0);
  $pdf->SetFont('times', 'B', 12);
  $pdf->Cell(30, 5, ': 4000008987', 0, 0);
  $pdf->SetFont('times', '', 11);
    $pdf->Cell(15, 5, 'R.C NO', 0, 0);
  $pdf->SetFont('times', 'B', 12);
  $pdf->Cell(30, 5, ': 67578', 0, 1);
  $pdf->SetFont('times', 'I', 11);
  $pdf->Cell(30, 5, 'Secteur d\'activite', 0, 0);
  $pdf->SetFont('times', 'BI', 11);
  $pdf->Cell(86, 5, ': INFORMATIQUE ET COMMERCE GENERAL', 0, 1);
  
  $pdf->SetFont('times', '', 11);
  $pdf->Cell(27, 5, 'Adresse fiscal', 0, 0);
  $pdf->SetFont('times', 'BI', 11);
  $pdf->Cell(30, 5, ': MUYINGA', 0, 0);
  $pdf->SetFont('times', '', 11);
  $pdf->Cell(30, 5, 'Forme juridique', 0, 0);
  $pdf->SetFont('times', 'B', 11);
  $pdf->Cell(15, 5, ': SPRL', 0, 0);
    $pdf->SetFont('times', '', 11);
  $pdf->Cell(10, 5, 'TEL', 0, 0);
  $pdf->SetFont('times', 'B', 11);
  $pdf->Cell(52, 5, ': (+257) 79 505 127', 0, 1);
  $pdf->SetFont('times', '', 11);
    $pdf->Cell(10, 5, 'B.P', 0, 0);
  $pdf->SetFont('times', 'B', 11);
  $pdf->Cell(23, 5, ': 1967', 0, 0);
  $pdf->SetFont('times', '', 11);
  $pdf->Cell(18, 5, 'Commune', 0, 0);
  $pdf->SetFont('times', 'B', 11);
  $pdf->Cell(38, 5, ': MUYINGA', 0, 0);
  $pdf->SetFont('times', '', 11);
    $pdf->Cell(15, 5, 'Quartier', 0, 0);
  $pdf->SetFont('times', 'B', 11);
  $pdf->Cell(30, 5, ': Swahili avenue.no 5', 0, 1);
  /*set font to times, bold, 14pt*/
  $pdf->Cell(59, 8, 'B.CLIENT', 0, 1);
  $pdf->SetFont('times', 'I', 11);
  $pdf->Cell(22, 5, 'Client ou R.S', 0, 0);
  $pdf->SetFont('times', 'BI', 11);
  $pdf->Cell(57, 5, ': '.$client['RS'].'', 0, 1);
  $pdf->SetFont('times', 'I', 11);
  $pdf->Cell(25, 5, 'Contact', 0, 0);
  $pdf->SetFont('times', 'BI', 11);
  $pdf->Cell(52, 5, ': '.$TEL.'', 0, 1);
  $pdf->SetFont('times', 'I', 11);
  $pdf->Cell(20, 5, 'Residant a', 0, 0);
  $pdf->SetFont('times', 'BI', 11);
  $pdf->Cell(57, 5, ': '.$NIF.'', 0, 1);
  $pdf->SetFont('times', 'I', 11);

  /*set font to times, bold, 14pt*/
  $pdf->SetFont('times', 'B', 11);
  $pdf->Cell(59 ,10,'Doit ce qui suit:',0,0);
  $pdf->Cell(50 ,10,'',0,1);
  $pdf->SetFont('times','B',11);
  /*Heading Of the table*/
  $pdf->Cell(10 ,6,'#',1,0,'C');
  $pdf->Cell(87 ,6,'LIBELLE',1,0,'C');
  $pdf->Cell(12 ,6,'QTE',1,0,'C');
  $pdf->Cell(26 ,6,'PU',1,0,'C');
  $pdf->Cell(25 ,6,'PVHTVA',1,1,'C');/*end of line*/
  /*Heading Of the table end*/
  $pdf->SetFont('times','B',10);
$i = 0;
$total = 0;
$previousProductDesc = null; // Variable pour stocker la valeur de PRODUCT_DESC de l'itération précédente

foreach ($facture as $key => $value) {
  $pdf->Cell(10, 6, $i + 1, 1, 0); // Affiche la valeur de $i + 1 dans la première cellule
  if ($value['PRODUCT_DESC'] !== $previousProductDesc) {
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(87, 6, utf8_encode($value['PRODUCT_DESC']), 1, 0);
  } else {
    $pdf->Cell(87, 6, '', 1, 0); // Cellule vide si la valeur de PRODUCT_DESC se répète
  }

  $pdf->SetFont('times', '', 10);
  $pdf->Cell(12, 6, $value['QUANTITE'], 1, 0, 'R');
  $unitprix = number_format($value['PRIX_UNITAIRE'], 0, ',', ' ');
  $pdf->Cell(26, 6, $unitprix, 1, 0, 'C');
  $TOT = $value['PRIX_UNITAIRE'] * $value['QUANTITE'];
  $PT = number_format($TOT, 0, ',', ' ');
  $total += $TOT;
  $pdf->Cell(25, 6, $PT, 1, 1, 'R');
  $i++; // Incrémente $i après avoir affiché sa valeur
  $previousProductDesc = utf8_encode($value['PRODUCT_DESC']); // Stocke la valeur de PRODUCT_DESC pour la prochaine itération
}

  $pdf->SetFont('times','',11);
  $pdf->Cell(85 ,6,'',0,0);
  $pdf->Cell(24 ,6,'Total',0,0);
  $pdf->SetFont('times','B',11);
  $pdf->Cell(51 ,6,''.number_format($total,0,',',' ').'',1,1,'R');
  $pdf->SetFont('times','B',10);
  $pdf->Ln(5);
  $pdf->SetFont('times','',10);
  $pdf->Cell(40 ,6,'',0,0,'C');
  $pdf->Cell(40 ,6,'TOTAL',1,0,'C');
  $pdf->Cell(40 ,6,'DETTE',1,0,'C');
  $pdf->Cell(40 ,6,'SOMME PAYE',1,1,'C');
  $pdf->Cell(40 ,6,'',0,0,'C');
  $pdf->SetFont('times','B',12);
  $pdf->Cell(40 ,6,''.number_format($total,2,',',' ').'',1,0,'C');
  $pdf->Cell(40 ,6,''.number_format($client['AMOUNT_DETTE'],2,',',' ').'',1,0,'C');
  $NETPAID=$total-$client['AMOUNT_DETTE'];
  $pdf->Cell(40 ,6,''.number_format($NETPAID,2,',',' ').'',1,1,'C');
  $pdf->SetFont('times','B',15);
  $pdf->Cell(71 ,5,'',0,0);
  $pdf->Cell(59 ,5,'',0,0);
  $pdf->Cell(59 ,5,'',0,1);
  $pdf->Cell(110 ,5,'',0,0);

$pdf->SetFont('times','B',10);
$pdf->Cell(130, 5, 'Date et signature', 0, 0);
$pdf->SetFont('times', '', 10);
$pdf->Cell(25, 5, '', 0, 0);
$pdf->Cell(34, 5, '', 0, 1);

// Ajout de la date du jour
$pdf->Cell(110, 5, '', 0, 0);
$pdf->Cell(30, 5, ''.date('d-m-Y H:i',strtotime($client['DATE_ACTION'])).'', 0, 1);
$pdf->Ln();
$pdf->SetX(125); // Définit la position X vers le côté droit de la feuille
$pdf->Cell(30, 5, ''.$client['NOM_EMP'].' '.$client['PRENOM_EMP'].'', 0, 1);

  $pdf->Ln(1);
    $pdf->Output();
  }

}?>