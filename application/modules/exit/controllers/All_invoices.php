<?php
class All_invoices extends CI_Controller
{

	//appelation d'une view
	function index()
	{
        $data['title']="All invoices";
		$this->load->view('All_invoices_v',$data);
	}

	function vente_to_day()
	{
        $date=date("Y-m-d");  
    
        // print_r($date);die();
		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal='SELECT `NOM_CUSTOMER`,SELLER,`GROS_CLIENT_FACT_ID`,`TEL_CUSTOMER`,
        `ADRESS_GROS_CLIENT`,`STATUT`,`NUM_FACTURE`,LAST_NAME,`DATE_ACTION`,(SELECT SUM(PRIX_TOTAL) FROM secr_ventes_produits where GROS_CLIENT_FACT_ID=secret_client_facture.GROS_CLIENT_FACT_ID) AS SOMME FROM `secret_client_facture` JOIN users ON users.USER_ID=secret_client_facture.SELLER WHERE STATUT= 1';
		$limit='LIMIT 0,10';
		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';
		if (!empty($order_by)) {
			# code...
			$order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY GROS_CLIENT_FACT_ID DESC';
		}
		$order_by='ORDER BY GROS_CLIENT_FACT_ID DESC';
		$search = !empty($_POST['search']['value']) ? (" AND  (NOM_CUSTOMER LIKE '%$var_search%' OR TEL_CUSTOMER LIKE '%$var_search%' OR NUM_FACTURE LIKE '%$var_search%' OR ADRESS_GROS_CLIENT LIKE '%$var_search%') ") : '';
		$critaire ="";
		$query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter=$query_principal.'  '.$critaire.' '.$search;
		$fetch_data = $this->Model->datatable($query_secondaire); 
        // print_r($fetch_data); die();
		$u=0; 
		$data = array();

		foreach ($fetch_data as $row) {

			$u++;
			$sub_array = array(); 
			$sub_array[] =$u;
			$sub_array[] = date("d-m-Y",strtotime($row->DATE_ACTION));
			$sub_array[] = $row->NUM_FACTURE;
			if (empty($row->NOM_CUSTOMER)) {
			$sub_array[] = 'Passenger';
			}else{
				$sub_array[] = $row->NOM_CUSTOMER;
			}
			if (empty($row->TEL_CUSTOMER)) {
			$sub_array[] = 'N/A';
			}else{
				$sub_array[] = $row->TEL_CUSTOMER;
			}
            $sub_array[] =  number_format($row->SOMME, 2, ',', ' ');
			
			$sub_array[] =$row->LAST_NAME;
			$sub_array[]='<center>
      <a href="" style="border:none"data-toggle="modal" data-target="#exampleModal'.$u.'">&nbsp<i class="align-middle fa fa-print fa-2x text-success"></i></a>
      </center>';
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

    public function validate($id) {
        // print_r($id); die();

        $statut= 1;
        $array = array('STATUT' => $statut);

      $message = $this->Model->update('secret_client_facture', array('GROS_CLIENT_FACT_ID' => $id), $array);
      redirect(base_url("index.php/exit/Vente_Today/index"));
    }
}
