<?php
class All_sales_into_manager extends CI_Controller
{

/**
 * Développe par Nirema eloge
 * Email : niremaeloge@gmmail.com
 * Téléphone: 76888354/69462014
 * Github: https://github.com/eloge257
 * 
 * class pour Gérer les ventes
 * 
 */
function __construct()
{
    parent::__construct();
    $this->out_application();
}
function out_application()
{
    if(empty($this->session->userdata('USER_ID')))
    {
        redirect(base_url(''));
    }
}
function index()
{
    $data['title'] = " All Sales and commands";
    

    $this->load->view('All_sales_into_manager_v', $data);
}

function listing()
{
    $date = date("Y-m-d");
    //AND date_format(mag_client_facture.DATE_ACTION,"%Y")= "'.$date.'"
     $group_by= 'GROUP BY GROS_CLIENT_FACT_ID';
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $query_principal = 'SELECT NOM_GROS_CLIENT,`PATH_FACTURE`,`STATUT`,`AMOUNT_DETTE`,`IS_DETTE_PAID`,`SELLER`,`NUM_FACTURE`,`DATE_ACTION`,(SELECT SUM(PRIX_TOTAL) FROM mag_ventes_produits where GROS_CLIENT_FACT_ID=mag_client_facture.GROS_CLIENT_FACT_ID) AS PT FROM `mag_client_facture` JOIN gros_client ON gros_client.GROS_CLIENT_ID=mag_client_facture.GROS_CLIENT_ID WHERE STATUT=1';

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
        $sub_array[] = $row->NOM_GROS_CLIENT;
        $sub_array[] =  number_format($row->PT, 0, ',', ' ');
        if ($row->AMOUNT_DETTE==0) {
          $sub_array[] ='<span class="text-success"><b>No debts</b><span>';
        }else{
         $sub_array[] =  '<span class="text-danger"><b>'.number_format($row->AMOUNT_DETTE, 0, ',', ' ').'</b><span>';   
        }
        
        $sub_array[] = '<center>
      <a href="" style="border:none"data-toggle="modal" data-target="#exampleModal'.$u.'">&nbsp<i class="align-middle fa fa-print fa-2x" style="color:#05BD80"></i></a>
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

}
?>