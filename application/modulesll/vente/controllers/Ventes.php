<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Ventes extends CI_Controller
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
    $this->cart->destroy();


    $data['page_title']="";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>';
    $data['Measure']=$this->Model->getRequete('SELECT * FROM `gros_unite` WHERE 1');    
    $dateAujourdhui = date('Y-m-d');
    $data['somme'] = $this->Model->getRequeteOne("SELECT sum(`TOTAL_ACHAT`) as montant, DATE_INSERTION FROM `gros_entrees_stock` WHERE DATE(DATE_INSERTION) = '$dateAujourdhui'");  
    $data['client']=$this->Model->getRequete('SELECT `ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `TEL_CLIENT`, `LOC_CLIENT`, `STATUT`, `DATE_INSERTION` FROM `clients_sanya` WHERE 1 ORDER BY DATE_INSERTION DESC');  
    $data['produit']=$this->Model->getRequete('SELECT * FROM `gros_produit`JOIN gros_stock ON gros_stock.GROS_PRODUIT_ID=gros_produit.GROS_PRODUIT_ID WHERE QNTE!=0 ORDER by `GROS_PRODUIT_DESCR`ASC');
    $max=$this->Model->getRequeteOne("SELECT max(GROS_CLIENT_FACT_ID)as ID FROM `gros_client_facture` WHERE 1");
    $data['CLIENT']=$this->input->post('NOM_CLIENT'); 
    $caissier=$this->session->userdata('EMPLOYE_ID');
    $data['caisse']=$this->Model->getRequeteOne("SELECT * FROM `employes` WHERE EMPLOYE_ID=".$caissier);
      // print_r($caisse);die();
    $this->load->view('Ventes_view',$data);
  }


  function getdesignationsm($id)
  {
   $site = $this->Model->getList('gros_produit',array('GROS_UNIT_ID'=>$id));
   $html = '<option value="" disabled selected>Select</option>';
   foreach ($site as $value) {
    $html .= '<option value="'.$value['GROS_PRODUIT_ID'].'">'.$value['GROS_PRODUIT_DESCR'].'</option>';
  }
  echo $html;


}

public function add_in_cart()
{
  $QUANTITE =$this->input->post("QUANTITE");
  $GROS_PRODUIT_ID =$this->input->post("GROS_PRODUIT_ID");
  
  $PRIX_ACHAT=$this->input->post("PRIX_ACHAT");
  $PT=$PRIX_ACHAT*$QUANTITE;
  $PTT=0;
  $file_data=array(
    'GROS_PRODUIT_ID'=>$GROS_PRODUIT_ID,
    'QUANTITE'=>$QUANTITE,
    'PRIX_ACHAT'=>$PRIX_ACHAT,
    'PT'=>$PT,
    'typecartitem'=>'FILE'
  );
  $this->cart->insert($file_data);
  $html="";
  $j=1;
  $i=0;
  $html.='
  <table class="table">
  <thead class="table-dark">
  <tr>
  <th>#</th>

  <th>DESIGNATION</th>
  <th>QUANTITE</th>
  <th>PRIX UNITAIRE</th>
  <th>PRIX TOTAL</th>
  <th>OPTION</th>
  </tr>
  </thead>
  <tbody>';
        // $i=0;
  $val=count($this->cart->contents());
  $htmll='';
          // <td>'.trim($item['FOURNISSEUR']).'</td>

  foreach ($this->cart->contents() as $item):
    if (preg_match('/FILE/',$item['typecartitem'])) {


      $DES=$this->Model->getRequeteOne('SELECT * FROM gros_produit WHERE GROS_PRODUIT_ID='.$item['GROS_PRODUIT_ID']);
      $DESIGNATIONS=$DES['GROS_PRODUIT_DESCR'];
      $i++; 
      $html.='<tr>
      <td>'.$j.'</td>
      <td>'.$DESIGNATIONS.'</td>
      <td>'.$item['PRIX_ACHAT'].'</td>
      <td>'.$item['QUANTITE'].'</td>
      <td>'.$item['PT'].'</td>


      <td style="width: 5px;">
      <input type="hidden" id="rowid'.$j.'" value='.$item['rowid'].'>
      <button  class="btn btn-danger btn-xs" type="button" onclick="remove_cart('.$j.')">
      x
      </button></td>
      </tr>';
      $htmll.=$item['QUANTITE'];
    }
    $j++;
    $i++;
    $PTT=$PTT+$item['PT'];
  endforeach;
  $html.=' </tbody>
  </table>

  ';
  $span="<span id='ptttt' style='margin-left:700px;font-size:20px'><b>Total:</b><b style='color:#253E62'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$PTT."</b></span>";
  if ($i>0) {
    echo $html;
    echo $span;
  }
}
function remove_cart()
{
  $rowid=$this->input->post('rowid');      
  $this->cart->remove($rowid);      
  $html="";
  $j=1;
  $i=0;
  $html.='
  <table class="table">
  <thead class="table-dark">
  <tr>
  <th>#</th>
  <th>DESIGNATION</th>
  <th>QUANTITE</th>
  <th>PRIX UNITAIRE</th>
  <th>PRIX TOTAL</th>

  <th>OPTION</th>
  </tr>
  </thead>
  <tbody>';
  foreach ($this->cart->contents() as $item):
    if (preg_match('/FILE/',$item['typecartitem'])) {
      $html.='<tr>
      <td>'.$j.'</td>

      <td>'.$item['GROS_PRODUIT_ID'].'</td>
      <td>'.$item['QUANTITE'].'</td>
      <td>'.$item['PRIX_ACHAT'].'</td>
      <td>'.$item['PT'].'</td>
      <td style="width: 5px;">
      <input type="hidden" id="rowid'.$j.'" value='.$item['rowid'].'>
      <button  class="btn btn-danger btn-xs" type="button" onclick="remove_cart('.$j.')">
      x
      </button></td>
      </tr>' ;
    }
    $j++;
    $i++;
  endforeach;
  $html.=' </tbody>
  </table>';
  if ($i>0) {
    echo $html;
  }
}

// function get_sum($value='')
// {
//   $qntun=$this->input->post('QUANTITEUN');
//   $QUANTITEUN =intval($qntun);
//   $prixuni=$this->input->post('PRIX_UNITAIRE');
//   $PRIX_UNITAIRE =intval($prixuni);

//   $pt = $PRIX_UNITAIRE*$QUANTITEUN;
//   echo json_encode(array('pt'=>$pt));
// }

function save_vente(){

  $idUser=$this->session->userdata('USER_ID');
  $id_clia=0;
  // $IDD=$this->input->post('GROS_CLIENT_FACT_ID');
  $QUANTITEUN = $this->input->post('QUANTITEUN');
  $DETTE = $this->input->post('DEBTS');
  $NOM_CLIENT = $this->input->post('NOM_CLIENT');
  $TELEPHONE = $this->input->post('TELEPHONE');
  // print_r( $NOM_CLIENT.'///'.$TELEPHONE);die();
  if (empty($DETTE)) {
   $ddebts=0;
   $havedbt=1;
 }else{ $ddebts=$DETTE;
   $havedbt=0;}

   $max=$this->Model->getRequeteOne("SELECT MAX(`GROS_CLIENT_FACT_ID`) AS ID FROM gros_client_facture WHERE 1");

   $idMAX=$max['ID']+1;

   if ($idMAX<10) {
    $maxid='00'.$idMAX;
  }elseif($idMAX>9 && $idMAX<99){
    $maxid='0'.$idMAX;
  }else{
    $maxid=$idMAX;
  }
  $dateaction=date('Y-m-d H:i:s');
  $CLIENT_INFO=array(
    'GROS_CLIENT_ID'=>$id_clia,
    'TYPE_VENTE_ID'=>1,
    'NOM_CUSTOMER'=>$NOM_CLIENT,
    'TEL_CUSTOMER'=>$TELEPHONE,
    'SELLER'=>$idUser,
    'NUM_FACTURE'=>$maxid,
    'AMOUNT_DETTE'=>$ddebts,
    'IS_DETTE_PAID'=>$havedbt,
    'STATUT'=>0,
    'DATE_ACTION'=>$dateaction
  );

  $GROS_CLIENT_FACT_ID=$this->Model->insert_last_id('gros_client_facture',$CLIENT_INFO);

  foreach ($this->cart->contents() as $value) 
  { 
    $DES=$this->Model->getRequeteOne('SELECT * FROM gros_stock WHERE GROS_PRODUIT_ID='.$value['DESIGNATION']);
    $gros_stok=$DES['GROS_STOCK_ID'];

    $P_ACHAT_TOTAL=$value['QUANTITEUN']*$DES['PA_U'];       
    $PRIX_TOTAL=$value['pt']; 
    $DEBTSEE=$this->input->post('DEBTS');

    $cart=array(
     'QUANTITE'=>$value['QUANTITEUN'],
     'GROS_STOCK_ID'=>$gros_stok,
     'PRIX_UNITAIRE'=>$value['PRIX_UNITAIRE'],
     'PRIX_TOTAL'=>$value['pt'],
     'NET_PAID'=>$value['pt'],
     'P_ACHAT_TOTAL'=>$P_ACHAT_TOTAL,
     'GROS_CLIENT_FACT_ID'=>$GROS_CLIENT_FACT_ID,
   );
      //print_r($cart);die();
    $this->Model->create('gros_ventes_produits',$cart);
    $OLD=$this->Model->getRequeteOne('SELECT * FROM gros_stock WHERE GROS_PRODUIT_ID='.$value['DESIGNATION']);

    $NEW_QNTE=$OLD['QNTE']-$value['QUANTITEUN'];
    $prix_a_tot=$NEW_QNTE*$OLD['PA_U'];
    $prix_V_tot=$NEW_QNTE*$OLD['PV_U'];

    $arrayds=array(
     'QNTE'=>$NEW_QNTE,
     'PA_T'=>$prix_a_tot,
     'PV_T'=>$prix_V_tot,
   );

      //print_r($arrayds);die();
    $success=$this->Model->update('gros_stock',array('GROS_PRODUIT_ID'=>$value['DESIGNATION']),$arrayds);
    $data['message']='<div class="alert alert-success text-center" id="message">Opération faite avec succès!</div>';

    
    $lien_sauvegarder = FCPATH.'uploads/doc_generer/';

    if(!is_dir($lien_sauvegarder)){
      mkdir($lien_sauvegarder,0777,TRUE); 
    }

    $facture=$this->Model->getRequete('SELECT * FROM gros_client_facture join gros_ventes_produits ON gros_ventes_produits.GROS_CLIENT_FACT_ID=gros_client_facture.GROS_CLIENT_FACT_ID JOIN gros_stock ON gros_stock.GROS_STOCK_ID=gros_ventes_produits.GROS_STOCK_ID join gros_produit ON gros_produit.GROS_PRODUIT_ID=gros_stock.GROS_PRODUIT_ID WHERE gros_client_facture.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

    $client=$this->Model->getRequeteOne('SELECT * FROM gros_client_facture  JOIN users ON users.USER_ID=gros_client_facture.SELLER WHERE gros_client_facture.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

    $clientId=$this->Model->getRequeteOne('SELECT * FROM gros_client_facture WHERE gros_client_facture.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

    $custID=$clientId['GROS_CLIENT_FACT_ID'];
    if ($custID<10) {
      $ourclientId='00'.$custID;
    }elseif($custID>9 || $custID<100){
      $ourclientId='0'.$custID;
    }else{
      $ourclientId=$custID; 
    }
    $nom_client=$client['NOM_CUSTOMER'];
    $tel=$client['TEL_CUSTOMER'];
    if ($nom_client==NULL) {
      $CUSTOMER='Customer';
    }else{
     $CUSTOMER=$nom_client;
   }
   if ($tel==NULL) {
    $TELCUSTOMER='-';
  }else{
   $TELCUSTOMER=$tel;
 }
 
 $pdf = new FPDF();
    //$pdf=new FPDF('L','cm',array(9.5,18.5));
 $pdf->SetMargins(20,20);
 $pdf->AddPage();
 $pdf->Image(FCPATH.'upload/FACT.png',10,1,95,28);
 $pdf->SetFont('Arial', 'B', 10);
 $pdf->Cell(50, 8, '', 0, 0);
 $pdf->Cell(50, 8, '', 0, 0);
 $pdf->Cell(50, 8, '', 0, 0);
 $pdf->SetFont('Arial','B',33);
 $pdf->SetFont('Arial', 'B', 11);
 $pdf->Cell(50 ,5,'',0,0);
 $pdf->SetFont('Arial', 'BI', 11);
 $pdf->Cell(59 ,10,'',0,1);
 $pdf->Cell(71 ,20,'',0,0);
 $pdf->SetFont('Arial', 'B', 11);
 $pdf->Line(10, 30, 200, 30);
 $pdf->SetFont('Arial', 'B', 11);
    //$pdf->Image(FCPATH.'upload/carton.jpg',10,2,50,30);
 $pdf->Cell(47, 5, '', 0, 1);
 $pdf->Cell(10, 5, 'NIF', 0, 0);
 $pdf->Cell(45, 5, ': 4000058214', 0, 0);
 $pdf->SetFont('Arial', 'B', 11);
 $pdf->SetFont('Arial', '', 11);
 $pdf->Cell(10, 5, 'Client', 0, 0);
 $pdf->SetFont('Arial', 'B', 11);
 $pdf->Cell(45, 5, ': '.$CUSTOMER.'', 0, 0);
 $pdf->SetFont('Arial', '', 11);
 $pdf->Cell(20, 5, 'Invoice no', 0, 0);
 $pdf->SetFont('Arial', 'B', 11);
 $pdf->Cell(45, 5, ': '.$ourclientId.'', 0, 1);
 $pdf->SetFont('Arial', 'B', 11);
 $pdf->Cell(10, 5, 'RC', 0, 0);
 $pdf->Cell(45, 5, ': 2514237/23', 0, 0);
 $pdf->SetFont('Arial', '', 11);
 $pdf->SetFont('Arial', '', 12);
 $pdf->Cell(10, 5, 'Tel', 0, 0);
 $pdf->SetFont('Arial', 'B', 12);
 $pdf->Cell(45, 5, ': '.$TELCUSTOMER.'', 0, 0);
 $pdf->SetFont('Arial', '', 12);
 $pdf->Cell(10, 5, 'Date', 0, 0);
 $pdf->SetFont('Arial', 'B', 12);
 $pdf->Cell(45, 5, ':'.date('d-m-Y',strtotime($client['DATE_ACTION'])).'', 0, 1);
 $pdf->Cell(10, 5, '', 0, 0);
 $pdf->SetFont('Arial', 'B', 12);
 $pdf->Cell(45, 5, '', 0, 0);
 $pdf->SetFont('Arial', '', 11);
 $pdf->Cell(15, 5, 'Server:', 0, 0);
 $pdf->SetFont('Arial', 'B', 12);
 $pdf->Cell(39, 5, ''.$client['USER_PRENOM'].'', 0, 0);
 $pdf->SetFont('Arial', '', 12);
 $pdf->Cell(10, 5, 'Time', 0, 0);
 $pdf->SetFont('Arial', 'B', 12);
 $pdf->Cell(45, 5, ': '.date('H:i:s',strtotime($client['DATE_ACTION'])).'', 0, 0);
 /*set font to arial, bold, 14pt*/
 $pdf->SetFont('Arial','B',16);
 $pdf->Line(10, 30, 200, 30);
 $pdf->Cell(59 ,6,'',0,1);
 $pdf->Ln(1);
 $pdf->Cell(71 ,7,'',0,0);
 $pdf->Cell(55 ,7,' INVOICE ',0,0);
 $pdf->Cell(50 ,7,'',0,1);
 $pdf->Ln(3);
 $pdf->SetFont('Arial','B',12);
 /*Heading Of the table*/
 $pdf->Cell(10 ,6,'Sl',1,0,'C');
 $pdf->Cell(87 ,6,'DESCRIPTION',1,0,'C');
 $pdf->Cell(12 ,6,'QTY',1,0,'C');
 $pdf->Cell(26 ,6,'U.PRICE',1,0,'C');
 $pdf->Cell(12 ,6,'TVA',1,0,'C');
 $pdf->Cell(25 ,6,'TOTAL',1,1,'C');/*end of line*/
 /*Heading Of the table end*/
 $pdf->SetFont('Arial','B',10);
 $i=0;
 $total=0;
 foreach ($facture as $key => $value) {
  $i++;
  $per=date('mY',strtotime($value['DATE_EXP']));
  $unitprix=number_format($value['PRIX_UNITAIRE'],0,',',' ');
  $TOT=$value['PRIX_UNITAIRE']*$value['QUANTITE'];
  $PT=number_format($TOT,0,',',' ');
  $total+=$TOT;
  $pdf->Cell(10 ,6,$i,1,0);
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(87 ,6,''.$value['GROS_PRODUIT_DESCR'].'',1,0);
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(12 ,6,''.$value['QUANTITE'].'',1,0,'R');
  $pdf->Cell(26 ,6,''.$unitprix.'',1,0,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(12 ,6,'0.00',1,0,'c');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(25 ,6,''.$PT.'',1,1,'R');
}
$pdf->SetFont('Arial','',11);
$pdf->Cell(122 ,6,'',0,0);
$pdf->Cell(25 ,6,'Subtotal',0,0);
$pdf->SetFont('Arial','B',11);

$pdf->Cell(25 ,6,''.number_format($total,0,',',' ').'',1,1,'R');

$pdf->SetFont('Arial','B',10);

$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10 ,6,'',0,0,'C');
$pdf->Cell(34,6,'',0,0,'C');
$pdf->Cell(25 ,6,'',0,0,'C');
$pdf->Cell(34,6,'TOT.AMOUNT',1,0,'C');
$pdf->Cell(34,6,'DEBTS',1,0,'C');
$pdf->Cell(34,6,'NET PAID',1,1,'C');
$pdf->Cell(10 ,6,'',0,0,'C');
$pdf->Cell(34,6,'',0,0,'C');
$pdf->Cell(25 ,6,'',0,0,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(34,6,''.number_format($total,2,',',' ').'',1,0,'C');
$pdf->Cell(34,6,''.number_format($client['AMOUNT_DETTE'],2,',',' ').'',1,0,'C');
$NETPAID=$total-$client['AMOUNT_DETTE'];
$pdf->Cell(34,6,''.number_format($NETPAID,2,',',' ').'',1,1,'C');
$pdf->SetFont('Arial','B',15);
$pdf->Cell(71 ,3,'',0,0);
$pdf->Cell(59 ,3,'',0,0);
$pdf->Cell(59 ,3,'',0,1);
$pdf->Cell(130 ,1,'',0,1);
$pdf->Ln(35);
$pdf->SetX(15);
$pdf->SetFont('Arial','BI',10);
$pdf->Cell(15,5, 'Transfer the amount through any business account below:', 0, 1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(20,4, 'Name:Klariza', 0, 1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(130,4, 'Bancobu', 0, 1);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,7, 'NO:14558820101', 0, 1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(130,4, 'Finbank', 0, 0);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,4, 'Seller\'s signature', 0, 1);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,4, 'NO:10136701011', 0, 1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(20,4, 'Lumicash', 0, 1);
$pdf->SetFont('Times','',10);
$pdf->Cell(33,4,'CODE MARCHAND:', 0, 0);
$pdf->SetFont('Times','B',10);
$pdf->Cell(20,4,'555333', 0, 1);
$code=date("YmdHis");
$PATH_FACTURE='FACTURE'.$code.uniqid();

$PATH_FACTURE=$PATH_FACTURE.'.pdf';

$this->Model->update('gros_client_facture',array('GROS_CLIENT_FACT_ID'=>$GROS_CLIENT_FACT_ID),array('PATH_FACTURE'=>$PATH_FACTURE));

$pdf->Output($lien_sauvegarder.$PATH_FACTURE,'F');


$this->session->set_flashdata($data);
}

echo json_encode(array('status' =>true));
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
  gros_produit.GROS_PRODUIT_DESCR,
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
  LEFT JOIN gros_stock ON gros_stock.GROS_STOCK_ID = gros_entrees_stock.GROS_STOCK_ID
  LEFT JOIN gros_produit ON gros_produit.GROS_PRODUIT_ID = gros_stock.GROS_PRODUIT_ID
  LEFT JOIN fournisseurs_sanya ON fournisseurs_sanya.ID_FOURNISSEUR = gros_entrees_stock.ID_FOURNISSEUR
  JOIN employes ON employes.EMPLOYE_ID = gros_entrees_stock.RESP_CAISSE
  WHERE
  DATE(gros_entrees_stock.DATE_INSERTION) = CURDATE()";

  $order_column=array("GROS_PRODUIT_DESCR","NOM_FOURNISSEUR","DATE_INSERTION");

  $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DATE_INSERTION  ASC';

  $search = !empty($_POST['search']['value']) ? (" AND  (GROS_PRODUIT_DESCR LIKE '%$var_search%' OR NOM_FOURNISSEUR LIKE '%$var_search%',OR DATE_INSERTION LIKE '%$var_search%') ") : '';

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
    $sub_array[] = $row->GROS_PRODUIT_DESCR;
    $sub_array[] = $row->QUANTITE_PRODUIT;
    $sub_array[] = $row->PRIX_ACHAT_UNITAIRE;
    $sub_array[] = $row->PRIX_VENTE_UNITAIRE;
    $sub_array[] = $row->TOTAL_ACHAT;
    $sub_array[] = $row->NOM_FOURNISSEUR.' '.$row->PRENOM_FOURNISSEUR.' ('.$row->LOC_FOURNISSEUR.')';
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
  $data_stock = $this->Model->getOne('gros_stock',array('GROS_PRODUIT_ID'=>$GROS_PRODUIT_ID));
  echo json_encode($data_stock);
}

}
?>