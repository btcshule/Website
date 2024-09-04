<?php
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Ventes_services extends CI_Controller
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
    $data['page_title']="Gestion des ventes des services";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Facturation</a></li>
    <li class="breadcrumb-item active" aria-current="page">Vente  des services</li>
    </ol>
    </nav>';
    $data['Measure'] = $this->Model->getRequete('SELECT * FROM `cathegories_services` WHERE 1');
    $max = $this->Model->getRequeteOne("SELECT max(GROS_CLIENT_FACT_ID)as ID FROM `mag_client_factur` WHERE ID_BRANCHE=".$this->session->userdata('ID_BRANCHE'));
    $data['CLIENT'] = $this->Model->getRequete("SELECT `GROS_CLIENT_ID`, `PRENOM_GROS_CLIENT`, `NOM_GROS_CLIENT`, `ADRESS_GROS_CLIENT`, `TEL_GROS_CLIENT`, `IS_CLIENT`, `STATUT`, `NIF`, `RS`, `RC`, `ID_BRANCHE`, `DATE_INSERTION` FROM `gros_client` WHERE IS_CLIENT=1 AND ID_BRANCHE=".$this->session->userdata('ID_BRANCHE')) ;
    $this->cart->destroy();
    $this->load->view('Ventes_services_view', $data);
  }

  function getdesignations($id=0)
  {
    $mes_services = $this->Model->getList('sanya_services', array('CATH_ID' => $id,'ID_BRANCHE'=>$this->session->userdata('ID_BRANCHE')));
    $html = '<option value="" disabled selected>Select</option>';
    foreach ($mes_services as $value) {
      $html .= '<option value="' . $value['PRODUCT_ID'] . '">' . $value['PRODUCT_DESC'] . '</option>';
    }
    echo $html;
  }


  function get_data($id = "",$typ_prod = "")
  {
    $data_stock = $this->Model->getOne('stock_secretariat', array('PRODUCT_ID' => $id,'TYPE_STOCK'=>$typ_prod));
    echo json_encode($data_stock);
  }
  function get_serv_price($id = "")
  {
    $data_stock = $this->Model->getOne('sanya_services', array('PRODUCT_ID' => $id));
    echo json_encode($data_stock);
  }
  function get_data_client($id = "")
  {
    $data_stock = $this->Model->getOne('gros_client', array('GROS_CLIENT_ID' => $id ));
    echo json_encode($data_stock);
  }
  public function add_in_cart()
  {
    $REDUCTION = $this->input->post("REDUCTION");
    $QUANTITE = $this->input->post("QUANTITEUN");
    $UNITE_MESURE = $this->input->post("UNITE_MESURE");
    $pt = $this->input->post("pt");
    $ptt = 0;
    $DESIGNATION = $this->input->post("DESIGNATION");
    $PRIX_UNITAIRE=$this->input->post("PRIX_UNITAIRE");
    $P_red=$pt*$REDUCTION/100;
    $netapayer=$pt-$P_red;
    $P_red=number_format($P_red,0,',',' ');


    // if ($UNITE_MESURE==0) {
      $secr=$this->Model->getRequeteOne('SELECT * FROM sanya_services WHERE PRODUCT_ID='.$DESIGNATION );
      $secr=$secr['PRODUCT_ID'];
      $code='S-'.$secr;
    // }else{
    //   $secr=$this->Model->getRequeteOne('SELECT * FROM products JOIN stock_secretariat ON stock_secretariat.PRODUCT_ID=products.PRODUCT_ID  WHERE TYPE_STOCK="'.$type_produit.'" and products.PRODUCT_ID=' . $DESIGNATION );
    //   $secr=$secr['SECR_STOCK_ID']; 
    //   $code='px-'.$secr;
    // }

    $file_data = array(
      'id' =>$code,
      'qty' => 1,
      'price' => 1,
      'name' => 'T',
      'QUANTITEUN' => $QUANTITE,
      'REDUCTION' => $REDUCTION,
      'netapayer' => $netapayer,
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
    <table class="table table-bordered col-md-10">
    <thead class="table-dark">
    <tr>
    <th>#</th>
    <th>Designation</th>
    <th>P.U</th>
    <th>Qnté</th>
    <th>Réduit</th>
    <th>Total</th>
    <th>A payer</th>
    <th>Option</th>
    </tr>
    </thead>
    <tbody>';
    $val = count($this->cart->contents());
    $htmll = '';
    foreach ($this->cart->contents() as $item) :
      if (preg_match('/FILE/', $item['typecartitem'])) {
        // if ($item['UNITE_MESURE']==0) {
          $DES = $this->Model->getRequeteOne('SELECT * FROM sanya_services  WHERE PRODUCT_ID=' . $item['DESIGNATION']);
          $DESIGNATIONS = $DES['PRODUCT_DESC'];
       //  }else{
       //    $DES = $this->Model->getRequeteOne('SELECT * FROM products JOIN stock_secretariat ON stock_secretariat.PRODUCT_ID=products.PRODUCT_ID  WHERE TYPE_STOCK="'.$item['type_produit'].'" and products.PRODUCT_ID=' . $item['DESIGNATION']);
       //    if ($DES['TYPE_STOCK']==1) {
       //     $typ='Pieces';
       //   }else{
       //     $typ='Pcs';
       //   }
       //   $DESIGNATIONS = $DES['PRODUCT_DESC'].'('.$typ.')';
       // }
       $i++;
       if (empty($item['REDUCTION'])) {
         $red=0;
       }
       $html .= '<tr>
       <td>' . $j . '</td>
       <td>' . $DESIGNATIONS.'</td>
       <td>' . $item['PRIX_UNITAIRE'] . '</td>
       <td>' . $item['QUANTITEUN'] . '</td>
       <td>' . $item['REDUCTION'] . '&nbsp%</td>
       <td>' .number_format( $item['pt'],'0',',',' '). '</td>
       <td>' .number_format( $item['netapayer'],'0',',',' '). '</td>
       <td style="width: 5px;">
       <input type="hidden" id="rowid' . $j . '" value=' . $item['rowid'] . '>
       <a  class="action-icon text-danger"> <i class="mdi mdi-delete" onclick="remove_ca(' . $j . ')">
       </a></td>
       </tr>';
       $htmll .= $item['QUANTITEUN'];
     }
     $j++;
     $i++;
     $ptt = $ptt + $item['netapayer'];
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
  <table class="table table-bordered col-md-10">
  <thead class="table-dark">
  <tr>
  <th>#</th>
  <th>Designation</th>
  <th>P.U</th>
  <th>Qnté</th>
  <th>Réduit</th>
  <th>Total</th>
  <th>A payer</th>
  <th>Option</th>
  </tr>
  </thead>
  <tbody>';
  foreach ($this->cart->contents() as $item) :
    if (preg_match('/FILE/', $item['typecartitem'])) {
        
          $DES = $this->Model->getRequeteOne('SELECT * FROM sanya_services  WHERE PRODUCT_ID=' . $item['DESIGNATION']);
          $DESIGNATIONS = $DES['PRODUCT_DESC'];
     
       $i++;
       if (empty($item['REDUCTION'])) {
         $red=0;
       }
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
  $table1='mag_client_factur';
  $table2='mag_ventes_services';
  $table3='gros_client';
  $idUser=$this->session->userdata('EMPLOYE_ID');
  $ID_BRANCHE=$this->session->userdata('ID_BRANCHE');
  $unite=$this->session->userdata('UNITE_MESURE');
  $id_clia=$this->input->post('GROS_CLIENT_ID');
  if ($id_clia=="clientpassager") {
    $max=$this->Model->getRequeteOne("SELECT COUNT(`GROS_CLIENT_ID`) AS ID FROM gros_client WHERE ID_BRANCHE=".$this->session->userdata('ID_BRANCHE'));
    $max=$max['ID']+1;
    $tel="00 000 000";
    $adress="inconue";
    $rs="Client".$max;
    $INFO=array(
      'PRENOM_GROS_CLIENT'=>$id_clia,
      'NOM_GROS_CLIENT'=>$max,
      'ADRESS_GROS_CLIENT'=>$adress,
      'TEL_GROS_CLIENT'=>$tel,
      'IS_CLIENT'=>0,
      'ID_BRANCHE'=>$this->session->userdata('ID_BRANCHE'),
      'STATUT'=>0,
      'RS'=>$rs,
      'DATE_INSERTION'=>date('Y-m-d H:i:s'),
    );
    $id_clia=$this->Model->insert_last_id('gros_client',$INFO);

  }else{
   $id_clia=$this->input->post('GROS_CLIENT_ID'); 
 }
 $QUANTITEUN = $this->input->post('QUANTITEUN');
 $ID_PAIE = $this->input->post('ID_PAIE');
 $MONTANT = $this->input->post('MONTANT');
 $DATE_ECHEANCE = $this->input->post('DATE_ECHEANCE');
 $TYPE_DETTE = $this->input->post('TYPE_DETTE');

 if ($ID_PAIE==2) {
   $ddebts=0;
   $havedbt=0;
 }
 else{
  $ddebts=$MONTANT;
  $havedbt=1;
}
$max=$this->Model->getRequeteOne("SELECT COUNT(`STATUT`) AS ID FROM mag_client_factur WHERE ID_BRANCHE=".$this->session->userdata('ID_BRANCHE'));
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

$GROS_CLIENT_FACT_ID=$this->Model->insert_last_id('mag_client_factur',$CLIENT_INFO);

foreach ($this->cart->contents() as $value) 
{ 
    $DES=$this->Model->getRequeteOne('SELECT * FROM sanya_services WHERE PRODUCT_ID='.$value['DESIGNATION']);
    $PRODUCT_ID=$DES['PRODUCT_ID'];
    $IS_SERVICE=1;
  $P_ACHAT_TOTAL=0;
  $PRIX_TOTAL=0;

  $cart=array(
   'QUANTITE'=>$value['QUANTITEUN'],
   'STOCK_ID'=>$PRODUCT_ID,
   'IS_SERVICE'=>$IS_SERVICE,
   'PRIX_UNITAIRE'=>$value['PRIX_UNITAIRE'],
   'PRIX_TOTAL'=>$value['pt'],
   'NET_PAID'=>$value['pt'],
   'P_ACHAT_TOTAL'=>$P_ACHAT_TOTAL,
   'GROS_CLIENT_FACT_ID'=>$GROS_CLIENT_FACT_ID,
   'POURC_REDUCTION'=>$value['REDUCTION'],
 );
  $this->Model->create('mag_ventes_services',$cart);
  $data['message']='<div class="alert alert-success text-center" id="message">Opération faite avec succès!</div>'; 
}
echo json_encode(array('status' =>true));
}

}

?>