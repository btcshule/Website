<?php
class Factures_and_sales extends CI_Controller
{

/**
 * Développe par nestorruhaya
 * Email : nestorngabirano@gmail.com
 * Téléphone: 61490363/77484815
 * Github: https://github.com/nestorruhaya
 * 
 * class pour les listes des ventes
 * 
 */
function __construct()
{
    parent::__construct();
    $this->out_application();
}
function out_application()
{
    if(empty($this->session->userdata('EMPLOYE_ID')))
    {
        redirect(base_url(''));
    }
}
function index()
{
    $data['title'] = " Liste de toutes les factures";
     $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Facturation</a></li>
    <li class="breadcrumb-item active" aria-current="page">Toutes les factures</li>
    </ol>
    </nav>';
    $data['tot']=$this->Model->getRequeteOne('SELECT SUM(PRIX_TOTAL) AS PT FROM `mag_ventes_produits` JOIN mag_client_facture ON mag_client_facture.GROS_CLIENT_FACT_ID=mag_ventes_produits.GROS_CLIENT_FACT_ID WHERE STATUT=0');
    
    $this->load->view('Factures_and_sales_v', $data);
}

function listing($date1=null,$date2=null)
{
    $clause="";
      if (!empty($date1) && empty($date2)) {
      # code...
        $clause=" AND DATE_FORMAT(DATE_ACTION,'%Y-%m-%d') LIKE '%".date('Y-m-d',strtotime($date1))."%'";
      }elseif (empty($date1) && !empty($date2)) {
      # code...
        $clause=" AND DATE_FORMAT(DATE_ACTION,'%Y-%m-%d') LIKE '%".date('Y-m-d',strtotime($date2))."%'";
      }elseif (!empty($date1) && !empty($date2)) {
      # code...
        $clause=" AND DATE_ACTION BETWEEN  '".$date1."' AND '".$date2."'";
      }

    $group_by= 'GROUP BY GROS_CLIENT_FACT_ID';
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $query_principal = 'SELECT RS,GROS_CLIENT_FACT_ID,NOM_GROS_CLIENT,`PATH_FACTURE`,mag_client_facture.`STATUT`,`AMOUNT_DETTE`,`IS_DETTE_PAID`,`SELLER`,`NUM_FACTURE`,`DATE_ACTION`,(SELECT SUM(PRIX_TOTAL) FROM mag_ventes_produits where GROS_CLIENT_FACT_ID=mag_client_facture.GROS_CLIENT_FACT_ID) AS PT FROM `mag_client_facture` JOIN gros_client ON gros_client.GROS_CLIENT_ID=mag_client_facture.GROS_CLIENT_ID WHERE mag_client_facture.STATUT=1 '.$clause;

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
    $query_secondaire = $query_principal . " ". $critaire . ' ' . $search . ' ' . $order_by . '  ' . $limit;
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
        $sub_array[] = date("d-m-Y H:i", strtotime($row->DATE_ACTION));
        $sub_array[] = $row->NUM_FACTURE;
        $sub_array[] = $row->RS;
        $sub_array[] =  number_format($row->PT, 2, ',', ' ');
        if ($row->AMOUNT_DETTE==0) {
        $sub_array[] ='<span class="badge bg-success">'.number_format($row->AMOUNT_DETTE, 2, ',', ' ').'<span>';
        }else{
         $sub_array[] ='<span class="badge bg-danger">'.number_format($row->AMOUNT_DETTE, 2, ',', ' ').'<span>';   
        }
        
        $sub_array[] ='
    <center>
        <a type="button" data-toggle="modal"  onclick="get_report_inventaire11('. $row->GROS_CLIENT_FACT_ID .')">
            <i class="mdi mdi-printer-eye"></i>
        </a>
    </center>';
        
        $sub_array[] = ' <center><i class="mdi mdi-checkbox-marked-circle text-success"></i></center>';


        
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
function update()
{
    
    $ID_CLIENT_FAC=$this->input->post('ID_CLIENT_FAC');
    $STATUT_ID=$this->input->post('STATUT_ID');
    if ($STATUT_ID==1) {
        $this->Model->update('mag_client_facture',array('GROS_CLIENT_FACT_ID'=>$ID_CLIENT_FAC),array('STATUT'=>$STATUT_ID));

    }else{
        $array = $this->Model->getRequete("SELECT * FROM mag_ventes_produits where IS_SERVICE=0 AND  GROS_CLIENT_FACT_ID=" . $ID_CLIENT_FAC);
        foreach ($array as $key) {
            $getsto = $this->Model->getRequeteOne('SELECT * FROM stock_secretariat WHERE SECR_STOCK_ID=' . $key['STOCK_ID']);
            $qnte = $getsto['QNTE'] + $key['QUANTITE'];
            $PA_T = $qnte * $getsto['PA_U'];
            $PV_T = $qnte * $getsto['PV_U'];
            $DONN = array('QNTE' => $qnte, 'PA_T' => $PA_T);
            $tabled = 'stock_secretariat';
            $this->Model->update($tabled, array('SECR_STOCK_ID' => $key['STOCK_ID']), $DONN);
            $this->Model->delete('mag_ventes_produits', array('GROS_CLIENT_FACT_ID' => $ID_CLIENT_FAC));
        }
        $this->Model->delete('mag_client_facture', array('GROS_CLIENT_FACT_ID' => $ID_CLIENT_FAC));
    }
    echo json_encode(array('status'=>true));
}
}
