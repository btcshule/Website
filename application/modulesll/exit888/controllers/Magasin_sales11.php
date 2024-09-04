
<?php
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

class Magasin_sales extends CI_Controller
{
  function __construct()
  { 
    parent::__construct();
    $this->out_application(); 
    require('fpdf184/fpdf.php');
  }

  function out_application()
  {
    if (empty(
      $this->session->userdata('EMPLOYE_ID'))) {
      redirect(base_url(''));
    }
  }
  function index()
  {
    $data['page_title']="Espace vente";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">exit</a></li>
    <li class="breadcrumb-item active" aria-current="page">sell space</li>
    </ol>
    </nav>';
    $data['produit'] = $this->Model->getRequete('SELECT * FROM `cathegories` WHERE 1');
    $data['service'] = $this->Model->getRequete('SELECT * FROM `services` WHERE 1');

    $max = $this->Model->getRequeteOne("SELECT max(GROS_CLIENT_FACT_ID)as ID FROM `mag_client_facture` WHERE ID_BRANCHE=".$this->session->userdata('ID_BRANCHE'));

    $data['CLIENT'] = $this->Model->getRequete("SELECT GROS_CLIENT_ID,ADRESS_GROS_CLIENT,RS,RC,NIF,IS_CLIENT,ID_BRANCHE,NOM_GROS_CLIENT,TEL_GROS_CLIENT FROM `gros_client` WHERE IS_CLIENT=1 AND ID_BRANCHE=".$this->session->userdata('ID_BRANCHE')) ;
    $this->cart->destroy();
    $this->load->view('Magasin_sales_v', $data);
  }
  //fonction de decliner
  function Not_accept($id){
    $table='emsi_commande_client';
    $criteres['COMMANDE_ID']=$id;
    $data['rows']= $this->Model->getOne( $table,$criteres);
    $datad;

    $datad=array('STATUT_TRAITEMENT' => 0);
    $data['message'] = '<div class="alert alert-success text-center" id="message">' . " Annulation done" . '</div>';
    $this->session->set_flashdata($data);
    $mes = $this->Model->update('emsi_commande_client', array('COMMANDE_ID' => $id), $datad);
    redirect(base_url("index.php/exit/Magasin_sales/listes"));
  }

  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $query_principal = "SELECT * FROM gros_client WHERE 1";
    $limit = 'LIMIT 0,5';
    if ($_POST['length'] != -1) {
      $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }
    $order_by = '';

    if (!empty($order_by)) {
      # code...
      $order_by = isset($_POST['order']) ? ' ORDER BY ' . $_POST['order']['0']['column'] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY GROS_CLIENT_ID DESC';
    }
    $order_by = ' ORDER BY GROS_CLIENT_ID  DESC';
    $search = !empty($_POST['search']['value']) ? (" AND  (TEL_GROS_CLIENT  LIKE '%$var_search%' OR NOM_GROS_CLIENT  LIKE '%$var_search%' OR ADRESS_GROS_CLIENT LIKE '%$var_search%') ") : '';
    $critaire = "";
    $query_secondaire = $query_principal . '  ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;
    $query_filter = $query_principal . '  ' . $critaire . ' ' . $search;
    $fetch_data = $this->Model->datatable($query_secondaire);
    $u = 0;
    $data = array();
    foreach ($fetch_data as $row) {
      $u++;
      $sub_array = array();
      $sub_array[] = $u;
      $sub_array[] = $row->NOM_GROS_CLIENT;
      $sub_array[] = $row->ADRESS_GROS_CLIENT;

      if (!empty($row->TEL_GROS_CLIENT)) {
        $sub_array[] = $row->TEL_GROS_CLIENT;
      } else {
        $sub_array[] = 'N/A';
      }
      $sub_array[] =
      ' <center><div class="dropdown ">
      <a class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" style="font-size:12px;color:white">Options
      <span class="caret"></span></a>
      <ul class="dropdown-menu dropdown-menu-right">
      <li><a  href="' . base_url("index.php/exit/Magasin_sales/sale/" . $row->GROS_CLIENT_ID) . '"><i class="fa fa-cog btn text-success"> Create invoice</i> </a></li>
      <li><a  href="' . base_url("index.php/exit/Magasin_sales/commande/" . $row->GROS_CLIENT_ID) . '"><i class="fa fa-cog btn text-primary"> Commande</i> </a></li>
      </ul>
      </div></center>
      ';
      $data[] = $sub_array;
    }

    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" => $this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );

    echo json_encode($output);
  }


  function sale($id = 0)
  {
    $this->cart->destroy();

    $data['Measure'] = $this->Model->getRequete('SELECT * FROM `cathegories` WHERE 1');
    $data['custumer'] = $this->Model->getRequeteOne("SELECT * FROM `gros_client` WHERE GROS_CLIENT_ID='" . $id . "'");
    $max = $this->Model->getRequeteOne("SELECT max(GROS_CLIENT_FACT_ID)as ID FROM `mag_client_facture` WHERE 1");

    $data['CLIENT'] = $this->Model->getRequeteOne("SELECT * FROM `gros_client` WHERE GROS_CLIENT_ID='" . $id . "'");
    $this->session->set_flashdata($data);
    $this->load->view('Magasin_sales_v', $data);
  }

  function getdesignations($id)
  {
    $site = $this->Model->getList('products', array('CATH_ID' => $id,'ID_BRANCHE'=>$this->session->userdata('ID_BRANCHE')));
    $html = '<option value="" disabled selected>Select</option>';
    foreach ($site as $value) {
      $html .= '<option value="' . $value['PRODUCT_ID'] . '">' . $value['PRODUCT_DESC'] . '</option>';
    }
    echo $html;
  }


  function get_data($id = 0)
  {
    $data_stock = $this->Model->getOne('stock_secretariat', array('PRODUCT_ID' => $id,'TYPE_STOCK'=>1));
    echo json_encode($data_stock);
  }
  function get_value($id = 0)
  {
    $data_client = $this->Model->getOne('gros_client', array('GROS_CLIENT_ID' => $id));
    echo json_encode($data_client);
  }
  public function add_in_cart()
  {
    $QUANTITE = $this->input->post("QUANTITEUN");
    $UNITE_MESURE = $this->input->post("UNITE_MESURE");
    $pt = $this->input->post("pt");
    $ptt = 0;
    $DESIGNATION = $this->input->post("DESIGNATION");
    $PRIX_UNITAIRE = $this->input->post("PRIX_UNITAIRE");

    $file_data = array(
      'id' => $DESIGNATION,
      'qty' => 1,
      'price' => 1,
      'name' => 'T',
      'QUANTITEUN' => $QUANTITE,
      'UNITE_MESURE' => $UNITE_MESURE,
      'pt' => $pt,
      'DESIGNATION' => $DESIGNATION,
      'PRIX_UNITAIRE' => $PRIX_UNITAIRE,
      'typecartitem' => 'FILE'
    );
    $this->cart->insert($file_data);
    $html = "";
    $j = 1;

    $i = 0;
    $html .= '
    <table class="table table-bordered">
    <thead class="table-dark">
    <tr>
    <th>#</th>

    <th>DESIGNATION</th>
    <th>PRIX UNITAIRE</th>
    <th>QUANTITE</th>
    <th>PRIX TOTAL</th>
    <th>OPTION</th>
    </tr>
    </thead>
    <tbody>';
    // $i=0;
    $val = count($this->cart->contents());
    $htmll = '';
    // <td>'.trim($item['FOURNISSEUR']).'</td>

    foreach ($this->cart->contents() as $item) :
      if (preg_match('/FILE/', $item['typecartitem'])) {


        $DES = $this->Model->getRequeteOne('SELECT * FROM products WHERE PRODUCT_ID=' . $item['DESIGNATION']);
        $DESIGNATIONS = $DES['PRODUCT_DESC'];
        $i++;
        $html .= '<tr>
        <td>' . $j . '</td>
        <td>' . $DESIGNATIONS . '</td>
        <td>' . $item['PRIX_UNITAIRE'] . '</td>
        <td>' . $item['QUANTITEUN'] . '</td>
        <td>' .number_format( $item['pt'],'0',',',' '). '</td>


        <td style="width: 5px;">
        <input type="hidden" id="rowid' . $j . '" value=' . $item['rowid'] . '>
        <a  class="action-icon text-danger"> <i class="mdi mdi-delete" onclick="remove_cart(' . $j . ')">
        </a></td>
        </tr>';
        $htmll .= $item['QUANTITEUN'];
      }


      $j++;
      $i++;
      $ptt = $ptt + $item['pt'];
    endforeach;
    $html .= ' </tbody>
    </table>

    ';
    $span = "<span id='ptttt' style='float:right;font-size:20px'><b>Total:</b><b style='color:#253E62'>&nbsp&nbsp&nbsp&nbsp" .number_format($ptt,'0',',',' ' ). "</b></span>";
    if ($i > 0) {
      echo $html;
      echo $span;
    }
  }
  function remove_cart()
  {
    $rowid = $this->input->post('rowid');
    $this->cart->remove($rowid);
    $html = "";
    $j = 1;
    $i = 0;
    $html .= '
    <table class="table table-bordered">
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
    foreach ($this->cart->contents() as $item) :
      if (preg_match('/FILE/', $item['typecartitem'])) {
        $DES = $this->Model->getRequeteOne('SELECT * FROM products WHERE PRODUCT_ID=' . $item['DESIGNATION']);
        $DESIGNATIONS = $DES['PRODUCT_DESC'];
        $html .= '<tr>
        <td>' . $j . '</td>

        <td>' . $DESIGNATIONS . '</td>
        <td>' . $item['QUANTITEUN'] . '</td>
        <td>' . $item['PRIX_UNITAIRE'] . '</td>
        <td>' . $item['pt'] . '</td>
        <td style="width: 5px;">
        <input type="hidden" id="rowid' . $j . '" value=' . $item['rowid'] . '>
        <button  class="btn btn-danger btn-xs" type="button" onclick="remove_cart(' . $j . ')">
        x
        </button></td>
        </tr>';
      }
      $j++;
      $i++;
    endforeach;
    $html .= ' </tbody>
    </table>';
    if ($i > 0) {
      echo $html;
    }
  }


  function save_sale_manager(){
    $idUser=$this->session->userdata('EMPLOYE_ID');
    $ID_BRANCHE=$this->session->userdata('ID_BRANCHE');
    $unite=$this->session->userdata('UNITE_MESURE');
    $id_clia=$this->input->post('GROS_CLIENT_ID');
    $QUANTITEUN = $this->input->post('QUANTITEUN');
    $ID_PAIE = $this->input->post('ID_PAIE');
    $MONTANT = $this->input->post('MONTANT');
    $DATE_ECHEANCE = $this->input->post('DATE_ECHEANCE');
    $TYPE_DETTE = $this->input->post('TYPE_DETTE');

    if ($ID_PAIE==2) 
    {
     $ddebts=0;
     $havedbt=0;
   }
   
   else
   {
    $ddebts=$MONTANT;
    $havedbt=1;
   }
  $max=$this->Model->getRequeteOne("SELECT COUNT(`STATUT`) AS ID FROM mag_client_facture WHERE ID_BRANCHE=".$this->session->userdata('ID_BRANCHE'));
  $idMAX=$max['ID']+1;
  if ($idMAX<10) {
    $maxid='00'.$idMAX.'-'.date('Y');
  }elseif($idMAX>9 && $idMAX<99){
    $maxid='0'.$idMAX.'-'.date('Y');
  }else{
    $maxid=$idMAX.'-'.date('Y');
  }
  $dateaction=date('Y-m-d H:i:s');

  $CLIENT_INFO=array(
    'GROS_CLIENT_ID'=>$id_clia,
    'SELLER'=>$this->session->userdata('EMPLOYE_ID'),
    'NUM_FACTURE'=>$maxid,
    'AMOUNT_DETTE'=>$ddebts,
    'IS_DETTE_PAID'=>$havedbt,
    'STATUT'=>0,
    'ID_BRANCHE'=>$this->session->userdata('ID_BRANCHE'),
    'ECHEANCE'=>$DATE_ECHEANCE,
    'TYPE_DETTE'=>$TYPE_DETTE,
    'DATE_ACTION'=>$dateaction
  );
print_r($CLIENT_INFO);die();
  $GROS_CLIENT_FACT_ID=$this->Model->insert_last_id('mag_client_facture',$CLIENT_INFO);

  foreach ($this->cart->contents() as $value) 
  { 
    $DES=$this->Model->getRequeteOne('SELECT * FROM stock_secretariat WHERE PRODUCT_ID='.$value['DESIGNATION']);
    $PRODUCT_ID=$DES['PRODUCT_ID'];
    $P_ACHAT_TOTAL=0;
    $PRIX_TOTAL=0;
    if ($value['UNITE_MESURE']!=0) {
      $P_ACHAT_TOTAL=$value['QUANTITEUN']*$DES['PA_U'];       
      $PRIX_TOTAL=$value['pt']; 
    }
    $cart=array(
     'QUANTITE'=>$value['QUANTITEUN'],
     'PRODUCT_ID'=>$PRODUCT_ID,
     'PRIX_UNITAIRE'=>$value['PRIX_UNITAIRE'],
     'PRIX_TOTAL'=>$value['pt'],
     'NET_PAID'=>$value['pt'],
     'P_ACHAT_TOTAL'=>$P_ACHAT_TOTAL,
     'GROS_CLIENT_FACT_ID'=>$GROS_CLIENT_FACT_ID,
   );

    $this->Model->create('mag_ventes_produits',$cart);
    $OLD=$this->Model->getRequeteOne('SELECT * FROM stock_secretariat WHERE PRODUCT_ID='.$value['DESIGNATION']);

    if ($value['UNITE_MESURE']!=0){

      $NEW_QNTE=$OLD['QNTE']-$value['QUANTITEUN'];
      $prix_a_tot=$NEW_QNTE*$OLD['PA_U'];
      $prix_V_tot=$NEW_QNTE*$OLD['PV_U'];
      
      $arrayds=array(
       'QNTE'=>$NEW_QNTE,
       'PA_T'=>$prix_a_tot,
     );

      $success=$this->Model->update('stock_secretariat',array('PRODUCT_ID'=>$value['DESIGNATION']),$arrayds);
    }
    $data['message']='<div class="alert alert-success text-center" id="message">Opération faite avec succès!</div>';






    $lien_sauvegarder = FCPATH.'uploads/doc_generer/';

    if(!is_dir($lien_sauvegarder)){
      mkdir($lien_sauvegarder,0777,TRUE); 
    }

    $facture=$this->Model->getRequete('SELECT * FROM mag_client_facture join mag_ventes_produits ON mag_ventes_produits.GROS_CLIENT_FACT_ID=mag_client_facture.GROS_CLIENT_FACT_ID JOIN stock_secretariat ON stock_secretariat.PRODUCT_ID=mag_ventes_produits.PRODUCT_ID join products ON products.PRODUCT_ID=stock_secretariat.PRODUCT_ID WHERE mag_client_facture.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

    $client=$this->Model->getRequeteOne('SELECT * FROM mag_client_facture join gros_client ON gros_client.GROS_CLIENT_ID=mag_client_facture.GROS_CLIENT_ID JOIN employes ON employes.EMPLOYE_ID=mag_client_facture.SELLER WHERE mag_client_facture.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

    $clientId=$this->Model->getRequeteOne('SELECT * FROM mag_client_facture WHERE mag_client_facture.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

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

    $pdf=new FPDF('P','mm','A5');
    $pdf->AddPage();
    $pdf->SetMargins(25,20);
  //$pdf->Image(FCPATH.'images/emsilogo.jpg',20,2,50,30);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 8, '', 0, 0);
    $pdf->SetFont('Arial','B',28);
    $pdf->Cell(40,6, 'E M S I  B U R U N D I ', 0, 1);
    $pdf->Cell(45 ,3,'',0,0);
    $pdf->SetFont('times', 'BI', 10);
    $pdf->Cell(100, 5, 'E  l  e  c  t  r  o  M  u  l  t  i  -  s  e r  v  i  c  e  s   i  n  n  o  v  a  t  i  o  n', 0, 1);
    $pdf->Cell(48 ,5,'',0,0);
    $pdf->SetFont('Arial', 'BI', 11);
    $pdf->Cell(100, 5, 'ADRESSE PHYSIQUE: MUYINGA-Q.KIBOGOYE', 0, 1);
    $pdf->Cell(40 ,5,'',0,0);
    $pdf->SetFont('Arial', 'BI', 11);
    $pdf->Cell(35, 5, 'NIF: 4001190000', 0, 0);
    $pdf->Cell(45, 5, 'CONTACT :79 842 414', 0, 0);
    $pdf->Cell(54, 5, 'RC :14767/19', 0, 0);
    $pdf->Cell(59 ,10,'',0,1);
    $pdf->Cell(60 ,10,'',0,0);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(59, 8, 'CLIENT\'S IDENTIFICATION', 0, 1);
    $pdf->Line(10, 33, 203,33);
    $pdf->SetFont('Arial', 'I', 11);
    $pdf->Cell(15, 5, '', 0, 0);
    $pdf->Cell(20, 5, 'CLIENT', 0, 0);
    $pdf->SetFont('times', 'BI', 11);
    $pdf->Cell(57, 5, ': '.$client['NOM_GROS_CLIENT'].'', 0, 0);
    $pdf->SetFont('Arial', 'I', 11);
    $pdf->Cell(25, 5, 'TEL.NUMBER', 0, 0);
    $pdf->SetFont('times', 'BI', 11);
    $pdf->Cell(52, 5, ': '.$TEL.'', 0, 1);
    $pdf->SetFont('Arial', 'I', 11);
    $pdf->Cell(15, 5, '', 0, 0);
    $pdf->Cell(20, 5, 'ADRESS', 0, 0);
    $pdf->SetFont('times', 'BI', 11);
    $pdf->Cell(57, 5, ': '.$NIF.'', 0, 0);
    $pdf->SetFont('Arial', 'I', 11);
    $pdf->Cell(25, 5, 'INVOICE NO', 0, 0);
    $pdf->SetFont('times', 'BI', 11);
    $pdf->Cell(52, 5, ': '.$client['NUM_FACTURE'].'', 0, 1);
    $pdf->SetFont('Arial', 'I', 11);
    $pdf->Cell(15, 5, '', 0, 0);
    $pdf->Cell(20, 5, 'SERVER', 0, 0);
    $pdf->SetFont('times', 'BI', 11);
    $pdf->Cell(57, 5, ': '.$client['FIRST_NAME'].' '.$client['LAST_NAME'].'', 0, 0);
    $pdf->SetFont('Arial', 'I', 11);
    $pdf->Cell(22, 5, 'DATETIME', 0, 0);
    $pdf->SetFont('times', 'Bi', 11);
    $pdf->Cell(52, 5, ': '.date('d-m-Y H:i',strtotime($client['DATE_ACTION'])).'', 0, 1);
    /*set font to arial, bold, 14pt*/
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Line(10, 33, 205, 33);
    $pdf->Cell(60 ,10,'',0,0);
    $pdf->Cell(59 ,10,'INVOICE DETAILS',0,0);
    $pdf->Cell(50 ,10,'',0,1);
    $pdf->SetFont('Arial','B',12);
    /*Heading Of the table*/
    $pdf->Cell(10 ,6,'#',1,0,'C');
    $pdf->Cell(87 ,6,'DESCRIPTION',1,0,'C');
    $pdf->Cell(12 ,6,'QTY',1,0,'C');
    $pdf->Cell(26 ,6,'U.PRICE',1,0,'C');
    $pdf->Cell(25 ,6,'TOTAL',1,1,'C');/*end of line*/
    /*Heading Of the table end*/
    $pdf->SetFont('Arial','B',10);
    $i=0;
    $total=0;
    foreach ($facture as $key => $value) {
      $i++;
      $unitprix=number_format($value['PRIX_UNITAIRE'],0,',',' ');
      $TOT=$value['PRIX_UNITAIRE']*$value['QUANTITE'];
      $PT=number_format($TOT,0,',',' ');
      $total+=$TOT;
      $pdf->Cell(10 ,6,$i,1,0);
      $pdf->SetFont('Arial','',11);
      $pdf->Cell(87 ,6,''.$value['PRODUCT_DESC'].'',1,0);
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(12 ,6,''.$value['QUANTITE'].'',1,0,'R');
      $pdf->Cell(26 ,6,''.$unitprix.'',1,0,'C');
      $pdf->SetFont('Arial','',10);
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(25 ,6,''.$PT.'',1,1,'R');
    }
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(85 ,6,'',0,0);
    $pdf->Cell(24 ,6,'Subtotal',0,0);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(51 ,6,''.number_format($total,0,',',' ').'',1,1,'R');
    $pdf->SetFont('Arial','B',10);
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40 ,6,'',0,0,'C');
    $pdf->Cell(40 ,6,'TOT.AMOUNT',1,0,'C');
    $pdf->Cell(40 ,6,'DEBTS',1,0,'C');
    $pdf->Cell(40 ,6,'NET PAID',1,1,'C');
    $pdf->Cell(40 ,6,'',0,0,'C');
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40 ,6,''.number_format($total,2,',',' ').'',1,0,'C');
    $pdf->Cell(40 ,6,''.number_format($client['AMOUNT_DETTE'],2,',',' ').'',1,0,'C');
    $NETPAID=$total-$client['AMOUNT_DETTE'];
    $pdf->Cell(40 ,6,''.number_format($NETPAID,2,',',' ').'',1,1,'C');
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(71 ,5,'',0,0);
    $pdf->Cell(59 ,5,'',0,0);
    $pdf->Cell(59 ,5,'',0,1);
    $pdf->Cell(110 ,5,'',0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(130 ,5,'MC INFORMATION',0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(25 ,5,'',0,0);
    $pdf->Cell(34 ,5,'',0,1);
    $pdf->Cell(110 ,5,'',0,0);
    $pdf->Cell(27 ,5,'CUSTOMER ID:',0,0);
    $pdf->Cell(34 ,5,''.$ourclientId.'',0,1);
    $pdf->Cell(110 ,5,'',0,0);
    $pdf->Cell(29,5,'ITEMS NUMBER:',0,0);
    $pdf->Cell(34 ,5,''.number_format($i,0,',',' ').'',0,1);
    $pdf->Ln(1);
    $code=date("YmdHis");
    $PATH_FACTURE='FACTURE'.$code.uniqid();
    $PATH_FACTURE=$PATH_FACTURE.'.pdf';
    $this->Model->update('mag_client_facture',array('GROS_CLIENT_FACT_ID'=>$GROS_CLIENT_FACT_ID),array('PATH_FACTURE'=>$PATH_FACTURE));
    $pdf->Output($lien_sauvegarder.$PATH_FACTURE,'F');
    $this->session->set_flashdata($data);
  }
  echo json_encode(array('status' =>true));
}

function savedata()
{
  $USER_ID = $this->session->userdata('USER_ID');
  $ID_CLIENT = $this->input->post('GROS_CLIENT_ID');
  $AVANCE_FBU = $this->input->post('ADVANCE');
  $DATE_LIVRAISON = $this->input->post('DATE_LIVRAISON');
  $MOYEN_PAIE = $this->input->post('MOYEN_PAIE');
  $STATUT_TRAITEMENT = 1;
  $data = array(
    'CLIENT_ID' => $ID_CLIENT,
    'AVANCE_FBU' => $AVANCE_FBU,
    'DATE_LIVRAISON' => $DATE_LIVRAISON,
    'MOYEN_PAIE' => $MOYEN_PAIE,
    'STATUT_TRAITEMENT' => $STATUT_TRAITEMENT,
    'USER_ID' => $USER_ID
  );

  $insert_id = $this->Model->insert_last_id("emsi_commande_client", $data);

  foreach ($this->cart->contents() as $value) 
  { 
    $DES=$this->Model->getRequeteOne('SELECT * FROM stock_secretariat WHERE PRODUCT_ID='.$value['DESIGNATION']);
    $gros_stok=$DES['stock_secretariat_ID'];
    $P_ACHAT_TOTAL=0;
    $PRIX_TOTAL=0;
    if ($value['UNITE_MESURE']!=0) {
      $P_ACHAT_TOTAL=$value['QUANTITEUN']*$DES['PA_U'];       
      $PRIX_TOTAL=$value['pt']; 
    }
    $cart=array(
     'QUANTITY'=>$value['QUANTITEUN'],
     'SERV_COMMAD_ID'=>$gros_stok,
     'PRIX_SERV'=>$value['PRIX_UNITAIRE'],
     'ID_COMMANDE'=>$insert_id,
   );

    $this->Model->create('emsi_commande_services',$cart);
    $OLD=$this->Model->getRequeteOne('SELECT * FROM stock_secretariat WHERE PRODUCT_ID='.$value['DESIGNATION']);

    if ($value['UNITE_MESURE']!=0){

      $NEW_QNTE=$OLD['QNTE']-$value['QUANTITEUN'];
      $prix_a_tot=$NEW_QNTE*$OLD['PA_U'];
      $prix_V_tot=$NEW_QNTE*$OLD['PV_U'];
      
      $arrayds=array(
       'QNTE'=>$NEW_QNTE,
       'PA_T'=>$prix_a_tot,
       'PV_T'=>$prix_V_tot,
     );

      $success=$this->Model->update('stock_secretariat',array('PRODUCT_ID'=>$value['DESIGNATION']),$arrayds);
    }
  }
  echo json_encode(array('status' =>true));
}

  //function commande
function commande($id = 0)
{
  $data['title'] = "commande";

  $data['Measure'] = $this->Model->getRequete('SELECT * FROM `cathegories` WHERE 1');
  $data['custumer'] = $this->Model->getRequeteOne("SELECT * FROM `gros_client` WHERE GROS_CLIENT_ID='" . $id . "'");
  $max = $this->Model->getRequeteOne("SELECT max(GROS_CLIENT_FACT_ID)as ID FROM `mag_client_facture` WHERE 1");

  $data['CLIENT'] = $this->Model->getRequeteOne("SELECT * FROM `gros_client` WHERE GROS_CLIENT_ID='" . $id . "'");
  $this->session->set_flashdata($data);
  $this->load->view('Commande_view', $data);
}


public function listes()
{

  $this->load->view("Liste_Service_View");
}

public function listes_client()
{
  $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
  $group_by="GROUP BY COMMANDE_ID";
  $query_principal = "SELECT emsi_commande_services.ID_COMMANDE,LAST_NAME,PRIX_SERV,STATUT_TRAITEMENT,DATE_ACTION,MOYEN_PAIE,COMMANDE_ID,gros_client.GROS_CLIENT_ID,gros_client.NOM_GROS_CLIENT,PRODUCT_DESC,emsi_commande_services.QUANTITY,emsi_commande_client.AVANCE_FBU,emsi_commande_client.DATE_LIVRAISON FROM emsi_commande_services JOIN emsi_commande_client on emsi_commande_client.COMMANDE_ID=emsi_commande_services.ID_COMMANDE JOIN gros_client on gros_client.GROS_CLIENT_ID=emsi_commande_client.CLIENT_ID  JOIN products on products.PRODUCT_ID=emsi_commande_services.SERV_COMMAD_ID Join employes ON employes.USER_ID=emsi_commande_client.USER_ID WHERE STATUT_TRAITEMENT=1";
  $limit = 'LIMIT 0,5';
  if ($_POST['length'] != -1) {
    $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
  }
  $order_by = '';
  if (!empty($order_by)) {
      # code...
    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $_POST['order']['0']['column'] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY GROS_CLIENT_ID DESC';
  }
  $order_by = ' ORDER BY ID_COMMAND_SERV  DESC';
  $search = !empty($_POST['search']['value']) ? (" AND  (AVANCE_FBU  LIKE '%$var_search%' OR NOM_GROS_CLIENT  LIKE '%$var_search%' OR PRODUCT_DESC  LIKE '%$var_search%' OR QUANTITY LIKE '%$var_search%') ") : '';
  $critaire = "";
  $query_secondaire = $query_principal . '  ' . $critaire . ' ' . $search . ' '.$group_by.' ' . $order_by . '   ' . $limit;
  $query_filter = $query_principal . '  ' . $critaire . ' ' . $search;
  $fetch_data = $this->Model->datatable($query_secondaire);
  $u = 0;
  $data = array();
  foreach ($fetch_data as $row) {
    $MOYEN_PAIE = ($row->MOYEN_PAIE == 1) ? " FBU  <span class='text-primary'><b>Cash</b></span>" : " FBU <span class='text-primary'><b>Bank</b></span>";
    if ($row->COMMANDE_ID < 10) {
      $NUMBER_COMMANDE = "000" . $row->COMMANDE_ID;
    } elseif ($row->COMMANDE_ID > 10 && $row->COMMANDE_ID < 100) {
      $NUMBER_COMMANDE = "00" . $row->COMMANDE_ID;
    } elseif ($row->COMMANDE_ID > 100 && $row->COMMANDE_ID < 1000) {
      $NUMBER_COMMANDE = "0" . $row->COMMANDE_ID;
    } else {
      $NUMBER_COMMANDE = $row->COMMANDE_ID;
    }

    $class=($row->STATUT_TRAITEMENT==1) ? "primary" : "danger" ;


    $COUNT = $this->Model->getRequeteOne("SELECT SUM(`QUANTITY`*`PRIX_SERV`) AS TOTAL FROM `emsi_commande_services` WHERE `ID_COMMANDE`=" . $row->COMMANDE_ID);

    $u++;
    $sub_array = array();
    $sub_array[] = $u;
    $sub_array[] = date('d-m-Y H:i', strtotime($row->DATE_ACTION));
    $sub_array[] = $row->NOM_GROS_CLIENT;
    $sub_array[] =  $NUMBER_COMMANDE;
    $sub_array[] = $COUNT['TOTAL'];
    $sub_array[] = ($row->AVANCE_FBU != 0) ? $row->AVANCE_FBU . $MOYEN_PAIE :  $row->AVANCE_FBU;

    $sub_array[] = date('d-m-Y', strtotime($row->DATE_LIVRAISON));
    $sub_array[] = $row->LAST_NAME;
    $sub_array[] = '<div class="spinner  row text-'.$class.'" role="status"><span class="'.$class.'"><i class="fa fa-cog fa-spin"></i> Load...</span>
    </div>';
    if ($row->STATUT_TRAITEMENT==1) {

      $sub_array[] = ' <center><div class="dropdown ">
      <a class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" style="font-size:12px;color:white">Options
      <span class="caret"></span></a>
      <ul class="dropdown-menu dropdown-menu-right">
      <li><a href="' . base_url("index.php/exit/Magasin_sales/detail_view/" . $row->COMMANDE_ID)  . '"><i class="fa fa-cog btn"> <b>Details</b></i> </a></li> 
      <li><a   data-toggle="modal" onclick="get_modal('.$row->COMMANDE_ID.')"><i class="fa fa-cog btn text-success"><b>Finish and pay</b></i> </a></li>
      <li><a   data-toggle="modal" data-target="#exampleModalother'.$row->COMMANDE_ID.'"><i class="fa fa-cog btn text-danger"><b>Decline</b></i> </a></li>
      </ul>
      </div></center> 


      <div class="modal fade" id="exampleModalother'.$row->COMMANDE_ID.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog static" role="document">
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
      <span class="text-danger"><h4>Are you sure decline this command?Be sure,the action has no return.</h4></span>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <a  class="btn btn-primary"  href="' . base_url("index.php/exit/Magasin_sales/Not_accept/" . $row->COMMANDE_ID)  . '">Accept</a>
      </div>
      </div>
      </div>
      </div>
      ';
    }
    
    $data[] = $sub_array;
  }

  $output = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $this->Model->all_data($query_principal),
    "recordsFiltered" => $this->Model->filtrer($query_filter),
    "data" => $data
  );

  echo json_encode($output);
}
public function listesCommande()
{

  $this->load->view("Liste_Commande_View");
}

public function listingCommande()
{

  $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
  $group_by="GROUP BY COMMANDE_ID";
  $query_principal = "SELECT emsi_commande_services.ID_COMMANDE,PRIX_SERV,STATUT_TRAITEMENT,DATE_ACTION,MOYEN_PAIE,COMMANDE_ID,
  gros_client.GROS_CLIENT_ID,gros_client.NOM_GROS_CLIENT,service_commande.DESCR_COMMANDE,emsi_commande_services.QUANTITY,emsi_commande_client.AVANCE_FBU,emsi_commande_client.DATE_LIVRAISON FROM emsi_commande_services JOIN   emsi_commande_client on emsi_commande_client.COMMANDE_ID=emsi_commande_services.ID_COMMANDE JOIN gros_client on gros_client.GROS_CLIENT_ID=emsi_commande_client.CLIENT_ID 
  JOIN products on products.PRODUCT_ID=emsi_commande_services.SERV_COMMAD_ID WHERE  STATUT_TRAITEMENT=1";
  $limit = 'LIMIT 0,5';
  if ($_POST['length'] != -1) {
    $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
  }
  $order_by = '';
  if (!empty($order_by)) {
      # code...
    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $_POST['order']['0']['column'] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY GROS_CLIENT_ID DESC';
  }
  $order_by = ' ORDER BY ID_COMMAND_SERV  DESC';
  $search = !empty($_POST['search']['value']) ? (" AND  (AVANCE_FBU  LIKE '%$var_search%' OR NOM_GROS_CLIENT  LIKE '%$var_search%' OR  (emsi_commande_services.QUANTITY*emsi_commande_services.PRIX_SERV)  LIKE '%$var_search%' OR DESCR_COMMANDE  LIKE '%$var_search%' OR QUANTITY LIKE '%$var_search%') ") : '';
  $critaire = "";
  $query_secondaire = $query_principal . '  ' . $critaire . ' ' . $search . ' '.$group_by.' ' . $order_by . '   ' . $limit;
  $query_filter = $query_principal . '  ' . $critaire . ' ' . $search;
  $fetch_data = $this->Model->datatable($query_secondaire);
  $u = 0;
  $data = array();
  foreach ($fetch_data as $row) {
    $MOYEN_PAIE = ($row->MOYEN_PAIE == 1) ? " FBU  <span class='text-primary'><b>Cash</b></span>" : " FBU <span class='text-primary'><b>Bank</b></span>";
    if ($row->COMMANDE_ID < 10) {
      $NUMBER_COMMANDE = "000" . $row->COMMANDE_ID;
    } elseif ($row->COMMANDE_ID > 10 && $row->COMMANDE_ID < 100) {
      $NUMBER_COMMANDE = "00" . $row->COMMANDE_ID;
    } elseif ($row->COMMANDE_ID > 100 && $row->COMMANDE_ID < 1000) {
      $NUMBER_COMMANDE = "0" . $row->COMMANDE_ID;
    } else {
      $NUMBER_COMMANDE = $row->COMMANDE_ID;
    }

    $class=($row->STATUT_TRAITEMENT==1) ? "primary" : "danger" ;


    $COUNT = $this->Model->getRequeteOne("SELECT SUM(emsi_commande_services.QUANTITY*emsi_commande_services.PRIX_SERV) AS TOTAL  FROM emsi_commande_services WHERE emsi_commande_services.ID_COMMANDE=" . $row->ID_COMMANDE);

    $u++;
    $sub_array = array();
    $sub_array[] = $u;
    $sub_array[] = $row->DATE_ACTION;
    $sub_array[] = $row->NOM_GROS_CLIENT;
    $sub_array[] =  $NUMBER_COMMANDE;
    $sub_array[] = $COUNT['TOTAL'];
    $sub_array[] = ($row->AVANCE_FBU != 0) ? $row->AVANCE_FBU . $MOYEN_PAIE :  $row->AVANCE_FBU;
      // $sub_array[] = $row->AVANCE_FBU.$MOYEN_PAIE;
    $sub_array[] = date('d-m-Y', strtotime($row->DATE_LIVRAISON));

    $data[] = $sub_array;
  }

  $output = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $this->Model->all_data($query_principal),
    "recordsFiltered" => $this->Model->filtrer($query_filter),
    "data" => $data
  );

  echo json_encode($output);
}


public function affect()
{
  $id=$this->input->post('ID_FOR_CMD');
  $dette=$this->input->post('DEBTS');
  $query_principal = "SELECT * FROM emsi_commande_client  WHERE COMMANDE_ID=" . $id;
  $query_principal = $this->Model->getRequeteone($query_principal);
  if ($dette=='') {
    $STATUT = 1;
    $AMOUNT_DETTE = 0;
    $IS_DETTE_PAID = 1;
  }else{
    $STATUT = 1;
    $IS_DETTE_PAID = 0;
    $AMOUNT_DETTE = $dette; 
  }

  $SELLER = $this->session->userdata('USER_ID');
  $get_max = $this->Model->getRequeteOne("SELECT COUNT(COMMANDE_ID) AS MAX_ID FROM emsi_commande_client WHERE STATUT_TRAITEMENT=2");

  $inc_id_max = $id;

  if ($inc_id_max < 10) {
    $inc_id_max = 'CMD-00' . $inc_id_max;
  } elseif ($inc_id_max > 10 && $inc_id_max < 100) {
    $inc_id_max = 'CMD-0' . $inc_id_max;
  } elseif ($inc_id_max > 100 && $inc_id_max < 1000) {
    $inc_id_max = 'CMD-' . $inc_id_max;
  } else {
    $inc_id_max = $inc_id_max;
  }
  $array_data = array(
    'GROS_CLIENT_ID' => $query_principal['CLIENT_ID'],
    'STATUT' => $STATUT,
    'AMOUNT_DETTE' => $AMOUNT_DETTE,
    'IS_DETTE_PAID' => $IS_DETTE_PAID,
    'SELLER' => $SELLER,
    'NUM_FACTURE' => $inc_id_max,
    'DATE_ACTION' => date('Y-m-d H:i:s'),
    'IS_COMMANDE' => 1
  );

  $GROS_CLIENT_FACT_ID=$this->Model->insert_last_id('mag_client_facture', $array_data);

  $variable=$this->Model->getRequete("SELECT * FROM emsi_commande_services WHERE ID_COMMANDE=".$id);
//print_r($variable);die();
  foreach ($variable as $key ) {

    $array_data = array(
      'GROS_CLIENT_FACT_ID' => $GROS_CLIENT_FACT_ID,
      'QUANTITE' => $key['QUANTITY'],
      'PRODUCT_ID'=>$key['SERV_COMMAD_ID'],
      'PRIX_UNITAIRE' => $key['PRIX_SERV'],
      'PRIX_TOTAL' => $key['QUANTITY']*$key['PRIX_SERV'],
      'NET_PAID' => $key['QUANTITY']*$key['PRIX_SERV'],

    );

    $this->Model->create('mag_ventes_produits',$array_data);
  }

  $lien_sauvegarder = FCPATH.'uploads/doc_generer/';

  if(!is_dir($lien_sauvegarder)){
    mkdir($lien_sauvegarder,0777,TRUE); 
  }

  $facture=$this->Model->getRequete('SELECT * FROM mag_ventes_produits  join products ON products.PRODUCT_ID=mag_ventes_produits.PRODUCT_ID WHERE mag_ventes_produits.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

  $client=$this->Model->getRequeteOne('SELECT * FROM mag_client_facture join gros_client ON gros_client.GROS_CLIENT_ID=mag_client_facture.GROS_CLIENT_ID JOIN employes ON employes.USER_ID=mag_client_facture.SELLER WHERE mag_client_facture.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

  $clientId=$this->Model->getRequeteOne('SELECT * FROM mag_client_facture WHERE mag_client_facture.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

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
}else{$TEL=$client['TEL_GROS_CLIENT'];}

if (empty($client['ADRESS_GROS_CLIENT'])) {
  $NIF='N/A';
}else{$NIF=$client['ADRESS_GROS_CLIENT'];}

        //$pdf=new FPDF('L','mm',array(148,210));
$pdf=new FPDF();

$pdf->AddPage();
$pdf->SetMargins(25,20);
$pdf->Image(FCPATH.'images/emsilogo.jpg',20,2,50,30);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 8, '', 0, 0);
$pdf->SetFont('Arial','B',28);
$pdf->Cell(40,6, 'E M S I  B U R U N D I ', 0, 1);
$pdf->Cell(45 ,3,'',0,0);
$pdf->SetFont('times', 'BI', 10);
$pdf->Cell(100, 5, 'E  l  e  c  t  r  o  M  u  l  t  i  -  s  e r  v  i  c  e  s   i  n  n  o  v  a  t  i  o  n', 0, 1);
$pdf->Cell(48 ,5,'',0,0);
$pdf->SetFont('Arial', 'BI', 11);
$pdf->Cell(100, 5, 'ADRESSE PHYSIQUE: MUYINGA-Q.KIBOGOYE', 0, 1);
$pdf->Cell(40 ,5,'',0,0);
$pdf->SetFont('Arial', 'BI', 11);
$pdf->Cell(35, 5, 'NIF: 4001190000', 0, 0);
$pdf->Cell(45, 5, 'CONTACT :78 842 414', 0, 0);
$pdf->Cell(54, 5, 'RC :14767/19', 0, 0);
$pdf->Cell(59 ,10,'',0,1);
$pdf->Cell(60 ,10,'',0,0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(59, 8, 'CLIENT\'S IDENTIFICATION', 0, 1);
$pdf->Line(10, 33, 203,33);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(15, 5, '', 0, 0);
$pdf->Cell(20, 5, 'CLIENT', 0, 0);
$pdf->SetFont('times', 'BI', 11);
$pdf->Cell(57, 5, ': '.$client['NOM_GROS_CLIENT'].'', 0, 0);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(25, 5, 'TEL.NUMBER', 0, 0);
$pdf->SetFont('times', 'BI', 11);
$pdf->Cell(52, 5, ': '.number_format($TEL,0,',',' ').'', 0, 1);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(15, 5, '', 0, 0);
$pdf->Cell(20, 5, 'ADRESS', 0, 0);
$pdf->SetFont('times', 'BI', 11);
$pdf->Cell(57, 5, ': '.$NIF.'', 0, 0);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(25, 5, 'INVOICE NO', 0, 0);
$pdf->SetFont('times', 'BI', 11);
$pdf->Cell(52, 5, ': '.$client['NUM_FACTURE'].'', 0, 1);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(15, 5, '', 0, 0);
$pdf->Cell(20, 5, 'SERVER', 0, 0);
$pdf->SetFont('times', 'BI', 11);
$pdf->Cell(57, 5, ': '.$client['FIRST_NAME'].' '.$client['LAST_NAME'].'', 0, 0);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(22, 5, 'DATETIME', 0, 0);
$pdf->SetFont('times', 'Bi', 11);
$pdf->Cell(52, 5, ': '.date('d-m-Y H:i',strtotime($client['DATE_ACTION'])).'', 0, 1);
/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial', 'B', 11);
$pdf->Line(10, 33, 205, 33);
$pdf->Cell(60 ,10,'',0,0);
$pdf->Cell(59 ,10,'INVOICE DETAILS',0,0);
$pdf->Cell(50 ,10,'',0,1);

$pdf->SetFont('Arial','B',12);
/*Heading Of the table*/
$pdf->Cell(10 ,6,'#',1,0,'C');
$pdf->Cell(87 ,6,'DESCRIPTION',1,0,'C');
$pdf->Cell(12 ,6,'QTY',1,0,'C');
$pdf->Cell(26 ,6,'U.PRICE',1,0,'C');
$pdf->Cell(25 ,6,'TOTAL',1,1,'C');/*end of line*/
/*Heading Of the table end*/
$pdf->SetFont('Arial','B',10);
$i=0;
$total=0;
foreach ($facture as $key => $value) {
  $i++;
  $unitprix=number_format($value['PRIX_UNITAIRE'],0,',',' ');
  $TOT=$value['PRIX_UNITAIRE']*$value['QUANTITE'];
  $PT=number_format($TOT,0,',',' ');
  $total+=$TOT;
  $pdf->Cell(10 ,6,$i,1,0);
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(87 ,6,''.$value['PRODUCT_DESC'].'',1,0);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(12 ,6,''.$value['QUANTITE'].'',1,0,'R');
  $pdf->Cell(26 ,6,''.$unitprix.'',1,0,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25 ,6,''.$PT.'',1,1,'R');
}
$pdf->SetFont('Arial','',11);
$pdf->Cell(85 ,6,'',0,0);
$pdf->Cell(24 ,6,'Subtotal',0,0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(51 ,6,''.number_format($total,0,',',' ').'',1,1,'R');
$pdf->SetFont('Arial','B',10);
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(40 ,6,'',0,0,'C');
$pdf->Cell(40 ,6,'TOT.AMOUNT',1,0,'C');
$pdf->Cell(40 ,6,'DEBTS',1,0,'C');
$pdf->Cell(40 ,6,'NET PAID',1,1,'C');
$pdf->Cell(40 ,6,'',0,0,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40 ,6,''.number_format($total,2,',',' ').'',1,0,'C');
$pdf->Cell(40 ,6,''.number_format($client['AMOUNT_DETTE'],2,',',' ').'',1,0,'C');
$NETPAID=$total-$client['AMOUNT_DETTE'];
$pdf->Cell(40 ,6,''.number_format($NETPAID,2,',',' ').'',1,1,'C');
$pdf->SetFont('Arial','B',15);
$pdf->Cell(71 ,5,'',0,0);
$pdf->Cell(59 ,5,'',0,0);
$pdf->Cell(59 ,5,'',0,1);
$pdf->Cell(110 ,5,'',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(130 ,5,'MC INFORMATION',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25 ,5,'',0,0);
$pdf->Cell(34 ,5,'',0,1);
$pdf->Cell(110 ,5,'',0,0);
$pdf->Cell(27 ,5,'CUSTOMER ID:',0,0);
$pdf->Cell(34 ,5,''.$ourclientId.'',0,1);
$pdf->Cell(110 ,5,'',0,0);
$pdf->Cell(29,5,'ITEMS NUMBER:',0,0);
$pdf->Cell(34 ,5,''.number_format($i,0,',',' ').'',0,1);
$pdf->Ln(1);
$code=date("YmdHis");
$PATH_FACTURE='FACTURE'.$code.uniqid();
$PATH_FACTURE=$PATH_FACTURE.'.pdf';
$this->Model->update('mag_client_facture',array('GROS_CLIENT_FACT_ID'=>$GROS_CLIENT_FACT_ID),array('PATH_FACTURE'=>$PATH_FACTURE));
$pdf->Output($lien_sauvegarder.$PATH_FACTURE,'F');


$this->Model->update("emsi_commande_client", array('COMMANDE_ID' => $id), array('STATUT_TRAITEMENT' => 2));

echo json_encode(array('status' =>true));
}

function detail_view($id){

 $data['id'] =$id;
 $X=$this->Model->getRequeteOne('SELECT * FROM emsi_commande_client WHERE COMMANDE_ID='.$id);
 $data['CLIENT']=$this->Model->getRequeteOne('SELECT * FROM gros_client WHERE GROS_CLIENT_ID='.$X['CLIENT_ID']);
 $this->load->view("Magasin_Detail_View",$data);

}
public function detail($id)
{

  $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
  $group_by="";
  $query_principal = "SELECT PRODUCT_DESC,`QUANTITY`,`PRIX_SERV` FROM `emsi_commande_services` LEFT JOIN products on products.PRODUCT_ID=emsi_commande_services.SERV_COMMAD_ID WHERE `ID_COMMANDE`=".$id;
  $limit = 'LIMIT 0,5';
  if ($_POST['length'] != -1) {
    $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
  }
  $order_by = '';
  if (!empty($order_by)) {
      # code...
    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $_POST['order']['0']['column'] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY GROS_CLIENT_ID DESC';
  }
  $order_by = ' ORDER BY `ID_COMMAND_SERV`  DESC';
  $search = !empty($_POST['search']['value']) ? (" AND  (AVANCE_FBU  LIKE '%$var_search%' OR NOM_GROS_CLIENT  LIKE '%$var_search%'or PRODUCT_DESC  LIKE '%$var_search%' OR QUANTITY LIKE '%$var_search%') ") : '';
  $critaire = "";
  $query_secondaire = $query_principal . '  ' . $critaire . ' ' . $search . ' '.$group_by.' ' . $order_by . '   ' . $limit;
  $query_filter = $query_principal . '  ' . $critaire . ' ' . $search;
  $fetch_data = $this->Model->datatable($query_secondaire);
  $u = 0;
  $data = array();
  foreach ($fetch_data as $row) {

    $u++;
    $sub_array = array();
    $sub_array[] = $u;
    $sub_array[] = $row->PRODUCT_DESC;
    $sub_array[] = $row->QUANTITY;
    $sub_array[] =  $row->PRIX_SERV;
    $sub_array[] = number_format($row->QUANTITY*$row->PRIX_SERV,0,',',' ');
    $data[] = $sub_array;
  }

  $output = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $this->Model->all_data($query_principal),
    "recordsFiltered" => $this->Model->filtrer($query_filter),
    "data" => $data
  );

  echo json_encode($output);
}

//ventes non valides

function pending(){

  $data['nb']=$this->Model->getRequeteOne('SELECT COUNT(STATUT) AS nombre FROM mag_client_facture  where STATUT=0 AND IS_COMMANDE=0');
  $this->load->view('Pending_sales_manager_view',$data);
}
//listing
function liste_pending(){
  $date = date("Y-m-d");
  $group_by = 'GROUP BY GROS_CLIENT_FACT_ID';
  $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
  $query_principal = "SELECT mag_ventes_produits.GROS_CLIENT_FACT_ID,NOM_GROS_CLIENT,`PATH_FACTURE`,`STATUT`,`AMOUNT_DETTE`,`IS_DETTE_PAID`,`SELLER`,`NUM_FACTURE`,`DATE_ACTION`,(SELECT SUM(QUANTITE*PRIX_UNITAIRE) FROM mag_ventes_produits where GROS_CLIENT_FACT_ID=mag_client_facture.GROS_CLIENT_FACT_ID) AS PT FROM `mag_client_facture` JOIN gros_client ON gros_client.GROS_CLIENT_ID=mag_client_facture.GROS_CLIENT_ID JOIN mag_ventes_produits ON mag_ventes_produits.GROS_CLIENT_FACT_ID=mag_client_facture.GROS_CLIENT_FACT_ID WHERE 1 AND STATUT=0 AND IS_COMMANDE=0";
  $limit = 'LIMIT 0,10';
  if ($_POST['length'] != -1) {
    $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
  }
  $order_by = '';
  if (!empty($order_by)) {
    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $_POST['order']['0']['column'] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY DATE_ACTION ASC';
  }
  $order_by = "ORDER BY DATE_ACTION DESC";
  $search = !empty($_POST['search']['value']) ? (" AND  (NOM_GROS_CLIENT LIKE '%$var_search%'  OR date_format(mag_client_facture.DATE_ACTION,'%d-%m-%Y') LIKE '%$var_search%' OR NUM_FACTURE LIKE '%$var_search%') ") : '';
  $critaire = "";
  $query_secondaire = $query_principal . " ". $critaire . ' '.$group_by.' ' . $search . ' ' . $order_by . '  ' . $limit;
  $query_filter = $query_principal ;
  $fetch_data = $this->Model->datatable($query_secondaire);
    //print_r($fetch_data);die();
  $u = 0;
  $data = array();
  $ptt=0;
  foreach ($fetch_data as $row) {
    $u++;
    $sub_array = array();
    $sub_array[] = $u;
    $sub_array[] = date("d-m-Y H:i:s", strtotime($row->DATE_ACTION));
    $sub_array[] = $row->NUM_FACTURE.'<span class="fa fa-cog fa-spin text-danger"></span>';
    $sub_array[] = $row->NOM_GROS_CLIENT;
    $sub_array[] =  number_format($row->PT, 2, ',', ' ');
    if($row->AMOUNT_DETTE==0){
     $sub_array[] = '<span class="text-success">No debt</span>';   
   }else{
    $sub_array[] =  '<span class="text-danger"><b>'.number_format($row->AMOUNT_DETTE,0, ',', ' ').'</b></span>';
  }
  $sub_array[] = '<center>
  <a href="" style="border:none"data-toggle="modal" data-target="#exampleModal'.$u.'">&nbsp<i class="align-middle fa fa-print text-danger" style="width:70px"></i></a>
  </center>
  <div class="modal fade" id="exampleModal'.$u.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>

  </div>
  <div class="modal-body">
  <embed  style="width:100% ;height:600px" src="'.base_url('uploads/doc_generer/').$row->PATH_FACTURE.'" type="">
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

  </div>
  </div>
  </div>
  </div>';
  $sub_array[] = '<div class="dropdown show">
  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Action
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <a class="dropdown-item"  data-toggle="modal" data-target="#exampleModal' . $row->GROS_CLIENT_FACT_ID . '" class="text-success"><b style="color:navy">Validate</b></a>
  <a class="dropdown-item"  data-toggle="modal" data-target="#example' . $row->GROS_CLIENT_FACT_ID . '" class="text-danger"><b style="color:red">Refuse</b></a>
  </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal' . $row->GROS_CLIENT_FACT_ID . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">
  Do you Want to validate ?
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
  <a type="button" class="btn btn-primary" href="' . base_url('index.php/exit/Magasin_sales/validate/' . $row->GROS_CLIENT_FACT_ID) . '">Yes</a>
  </div>
  </div>
  </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="example' . $row->GROS_CLIENT_FACT_ID . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">
  Do you Want to Refuse ?
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
  <a type="button" class="btn btn-primary" href="' . base_url('index.php/exit/Magasin_sales/refuse_bill/' . $row->GROS_CLIENT_FACT_ID) . '">Yes</a>
  </div>
  </div>
  </div>
  </div>';
  $data[] = $sub_array;
}

$output = array(
  "draw" => intval($_POST['draw']),
  "recordsTotal" => $this->Model->all_data($query_principal),
  "recordsFiltered" => $this->Model->filtrer($query_filter),
  "data" => $data
);

echo json_encode($output);
}




public function validate($id)
{
  $statut = 1;
  $array = array('STATUT' => $statut);
  $message = $this->Model->update('mag_client_facture', array('GROS_CLIENT_FACT_ID' => $id), $array);
  redirect(base_url("index.php/exit/Magasin_sales/pending"));
}
public function refuse_bill($id)
{
  $array = $this->Model->getRequete("SELECT * FROM mag_ventes_produits where GROS_CLIENT_FACT_ID=".$id);
  foreach ($array as $key) {
    $getsto = $this->Model->getRequeteOne('SELECT * FROM stock_secretariat WHERE PRODUCT_ID=' . $key['PRODUCT_ID']);

    $qnte = $getsto['QNTE'] + $key['QUANTITE'];
    $PA_T = $qnte * $getsto['PA_U'];
    $PV_T = $qnte * $getsto['PV_U'];
    $DONN = array('QNTE' => $qnte, 'PA_T' => $PA_T, 'PV_T' => $PV_T);
    //print_r($DONN);die();
    $tabled = 'stock_secretariat';
    $this->Model->update($tabled, array('PRODUCT_ID' => $key['PRODUCT_ID']), $DONN);
    $this->Model->delete('mag_ventes_produits', array('GROS_CLIENT_FACT_ID' => $key['GROS_CLIENT_FACT_ID']));
  }
  $this->Model->delete('mag_client_facture', array('GROS_CLIENT_FACT_ID' => $id));
  $data['message'] = '<div class="alert alert-danger" role="alert" 
  id="message">' . "Your cancellation of the invoice is done successfully" . '
  </div>';
  $this->session->set_flashdata($data);
  redirect(base_url("index.php/exit/Magasin_sales/pending"));
}

}

?>