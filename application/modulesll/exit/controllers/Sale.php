<?php
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');
class Sale extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->out_application();
		require('fpdf184/fpdf.php');

	}
	function out_application()
	{
		if(empty($this->session->userdata('USER_ID')))
		{
			redirect(base_url(''));
		}
	}
	//appelation d'une view
	function index()
	{
		$data['title']="Sale space";
		$this->cart->destroy();
		$data['produit']=$this->Model->getRequete('SELECT * FROM `products`JOIN stock_secretariat ON stock_secretariat.PRODUCT_ID=products.PRODUCT_ID WHERE QNTE!=0 ORDER by `PRODUCT_DESC`ASC');

		$data['Measure']=$this->Model->getRequete('SELECT * FROM `cathegories` WHERE 1');
		$this->load->view('Sales_v',$data);
	}

	function getdesignations($id)
	{
		$site = $this->Model->getList('products',array('CATH_ID'=>$id));
		$html = '<option value="" disabled selected>Select</option>';
		foreach ($site as $value) {
			$html .= '<option value="'.$value['PRODUCT_ID'].'">'.$value['PRODUCT_DESC'].'</option>';
		}
		echo $html;


	}
	function get_data($id=0)
	{
		$data_stock = $this->Model->getOne('stock_secretariat',array('PRODUCT_ID'=>$id));
		echo json_encode($data_stock);
	}
	function get_data_service($id=0)
	{
		$data_service = $this->Model->getRequeteOne('SELECT * FROM `products`JOIN mag_stock ON mag_stock.PRODUCT_ID=products.PRODUCT_ID WHERE mag_stock.PRODUCT_ID='.$id);
		echo json_encode($data_service);
	}

	public function add_in_cart()
	{
		$Design =$this->input->post("UNITE_MESURE");
		$DESIGNATION =$this->input->post("DESIGNATION");
		$pt =$this->input->post("pt");
		$ptt=0;
		$QUANTITE =$this->input->post("QUANTITEUN");
		$PRIX_UNITAIRE =$this->input->post("PRIX_UNITAIRE");
		$DES=$this->Model->getRequeteOne('SELECT * FROM products WHERE PRODUCT_ID='.$DESIGNATION);
		$DESIGNATIONS=$DES['PRODUCT_DESC'];	
		$file_data=array(
			'id'=>$DESIGNATION,
			'qty'=>1,
			'price'=>1,
			'name'=>'T',
			'QUANTITEUN'=>$QUANTITE,
			'UNITE_MESURE'=>$Design,
			'pt'=>$pt,
			'DESIGNATIONS'=>$DESIGNATIONS,
			'DESIGNATION'=>$DESIGNATION,
			'PRIX_UNITAIRE'=>$PRIX_UNITAIRE,
			'typecartitem'=>'FILE'
		);
		$this->cart->insert($file_data);
		$html="";
		$j=1;
		$i=0;
		$html.='
		<table class="table table-bordered">
		<thead class="table-dark">
		<tr>
		<th>#</th>

		<th>DESIGNATION</th>
		<th>UNIT PRICE</th>
		<th>QUANTITE</th>
		<th>PRIX TOTAL</th>
		<th>OPTION</th>
		</tr>
		</thead>
		<tbody>';
        // $i=0;
			// $DESIGNATIONS="";
		$val=count($this->cart->contents());
		$htmll='';
		foreach ($this->cart->contents() as $item):
			if (preg_match('/FILE/',$item['typecartitem'])) {
				$i++; 
				$html.='<tr>
				<td>'.$j.'</td>
				<td>'.$item['DESIGNATIONS'].'</td>
				<td>'.$item['PRIX_UNITAIRE'].'</td>
				<td>'.$item['QUANTITEUN'].'</td>
				<td>'.$item['pt'].'</td>
				<td style="width: 5px;">
				<input type="hidden" id="rowid'.$j.'" value='.$item['rowid'].'>
				<button  class="btn btn-danger btn-xs" type="button" onclick="remove_cart('.$j.')">
				x
				</button></td>
				</tr>';
				$htmll.=$item['QUANTITEUN'];
			}

			$j++;
			$i++;
			$ptt=$ptt+$item['pt'];
		endforeach;
		$html.=' </tbody>
		</table>

		';
		$span="<span id='ptttt' style='float:right;font-size:20px'><b>Total:</b><b style='color:#253E62'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".number_format($ptt,0,',',' ')."</b></span>";
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
		foreach ($this->cart->contents() as $item):
			if (preg_match('/FILE/',$item['typecartitem'])) {
				$DES=$this->Model->getRequeteOne('SELECT * FROM products WHERE PRODUCT_ID='.$item['DESIGNATION']);
				$DESIGNATIONS=$DES['PRODUCT_DESC'];
				$html.='<tr>
				<td>'.$j.'</td>

				<td>'.$DESIGNATIONS.'</td>
				<td>'.$item['QUANTITEUN'].'</td>
				<td>'.$item['PRIX_UNITAIRE'].'</td>
				<td>'.$item['pt'].'</td>
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

	//save

	function register(){

   $idUser=$this->session->userdata('USER_ID');
		$id_clia=0;
		$NOM_CUSTOMER = $this->input->post('NAME');
		if (empty($NOM_CUSTOMER)) {
		$NOM_CUSTOMER = 'client';
		$IS_POTENTIEL=0;
		}else{
		$NOM_CUSTOMER = $this->input->post('NAME');
		$IS_POTENTIEL=0;
		}
		$ADRESS ="";
		$TEL ="";
		$ADRESS = $this->input->post('ADRESS');
		$TEL = $this->input->post('TEL');
        $arrayName = array('NOM_GROS_CLIENT' =>$NOM_CUSTOMER ,'ADRESS_GROS_CLIENT' =>$ADRESS ,'TEL_GROS_CLIENT' =>$TEL);

        $insrt = $this->Model->insert_last_id('gros_client', $arrayName);

		 $max=$this->Model->getRequeteOne("SELECT COUNT(`STATUT`) AS ID FROM mag_client_facture WHERE IS_COMMANDE=0");
   $idMAX=$max['ID']+1;
   if ($idMAX<10) {
    $maxid='SA-00'.$idMAX;
  }elseif($idMAX>9 && $idMAX<99){
    $maxid='SA-0'.$idMAX;
  }else{
    $maxid='SA-'.$idMAX;
  }
  $dateaction=date('Y-m-d H:i:s');
  $CLIENT_INFO=array(
    'GROS_CLIENT_ID'=>$insrt,
    'SELLER'=>$this->session->userdata('USER_ID'),
    'NUM_FACTURE'=>$maxid,
    'AMOUNT_DETTE'=>0,
    'IS_DETTE_PAID'=>1,
    'STATUT'=>0,
    'IS_COMMANDE'=>0,
    'DATE_ACTION'=>$dateaction
  );

  $GROS_CLIENT_FACT_ID=$this->Model->insert_last_id('mag_client_facture',$CLIENT_INFO);

  foreach ($this->cart->contents() as $value) 
  { 
    $DES=$this->Model->getRequeteOne('SELECT * FROM stock_secretariat WHERE PRODUCT_ID='.$value['DESIGNATION']);
    $gros_stok=$DES['PRODUCT_ID'];
    $P_ACHAT_TOTAL=0;
      $PRIX_TOTAL=0;
    if ($value['UNITE_MESURE']!=0) {
      $P_ACHAT_TOTAL=$value['QUANTITEUN']*$DES['PA_U'];        
    }
    $PRIX_TOTAL=$value['PRIX_UNITAIRE']*$value['QUANTITEUN']; 
    $DEBTSEE=0;
    $cart=array(
     'QUANTITE'=>$value['QUANTITEUN'],
     'GROS_STOCK_ID'=>$gros_stok,
     'PRIX_UNITAIRE'=>$value['PRIX_UNITAIRE'],
     'PRIX_TOTAL'=>$PRIX_TOTAL,
     'NET_PAID'=>$PRIX_TOTAL,
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
       'PV_T'=>$prix_V_tot,
     );

      $success=$this->Model->update('stock_secretariat',array('PRODUCT_ID'=>$value['DESIGNATION']),$arrayds);
    }
    $data['message']='<div class="alert alert-success text-center" id="message">Opération faite avec succès!</div>';

    $lien_sauvegarder = FCPATH.'uploads/doc_generer/';

    if(!is_dir($lien_sauvegarder)){
      mkdir($lien_sauvegarder,0777,TRUE); 
    }

    $facture=$this->Model->getRequete('SELECT * FROM mag_client_facture join mag_ventes_produits ON mag_ventes_produits.GROS_CLIENT_FACT_ID=mag_client_facture.GROS_CLIENT_FACT_ID JOIN mag_stock ON mag_stock.MAG_STOCK_ID=mag_ventes_produits.GROS_STOCK_ID join products ON products.PRODUCT_ID=mag_stock.PRODUCT_ID WHERE mag_client_facture.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

    $client=$this->Model->getRequeteOne('SELECT * FROM mag_client_facture join gros_client ON gros_client.GROS_CLIENT_ID=mag_client_facture.GROS_CLIENT_ID JOIN users ON users.USER_ID=mag_client_facture.SELLER WHERE mag_client_facture.GROS_CLIENT_FACT_ID='.$GROS_CLIENT_FACT_ID);

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
  // $pdf->SetMargins(25,20);
  $pdf->Image(FCPATH.'images/emsilogo.jpg',8,2,40,25);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(50, 8, '', 0, 0);
  $pdf->SetFont('Arial','B',25);
  $pdf->Cell(30,6, 'E M S I  B U R U N D I ', 0, 1);
  $pdf->Cell(45 ,3,'',0,1);
  $pdf->SetFont('times', 'BI', 10);
  $pdf->Cell(70, 5, 'E  l  e  c  t  r  o  M  u  l  t  i  -  s  e r  v  i  c  e  s   i  n  n  o  v  a  t  i  o  n', 0, 1);
  $pdf->Cell(48 ,5,'',0,0);
  $pdf->SetFont('Arial', 'BI', 11);
  $pdf->Cell(70, 5, 'ADRESSE PHYSIQUE: MUYINGA-Q.KIBOGOYE', 0, 1);
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
  $pdf->Cell(40 ,6,''.number_format(0,2,',',' ').'',1,0,'C');
  $pdf->Cell(40 ,6,''.number_format($total,2,',',' ').'',1,1,'C');
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
    $DES=$this->Model->getRequeteOne('SELECT * FROM mag_stock WHERE PRODUCT_ID='.$value['DESIGNATION']);
    $gros_stok=$DES['MAG_STOCK_ID'];
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
    $OLD=$this->Model->getRequeteOne('SELECT * FROM mag_stock WHERE PRODUCT_ID='.$value['DESIGNATION']);

    if ($value['UNITE_MESURE']!=0){

      $NEW_QNTE=$OLD['QNTE']-$value['QUANTITEUN'];
      $prix_a_tot=$NEW_QNTE*$OLD['PA_U'];
      $prix_V_tot=$NEW_QNTE*$OLD['PV_U'];
      
      $arrayds=array(
       'QNTE'=>$NEW_QNTE,
       'PA_T'=>$prix_a_tot,
       'PV_T'=>$prix_V_tot,
     );

      $success=$this->Model->update('mag_stock',array('PRODUCT_ID'=>$value['DESIGNATION']),$arrayds);
    }
}
echo json_encode(array('status' =>true));
}
}
?>