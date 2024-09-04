<?php 
/**
 * 
 */
class Notification extends CI_Controller
{
	
	function __construct()
 	{
 		parent::__construct();
 		$this->is_auth();
 	}

 	function is_auth()
 	{
 		if (empty($this->session->userdata('EMPLOYE_ID'))) {
 			redirect(base_url(''));
 		}
 	}

 	function index()
	{
		
		$data['page_title']="Notifications";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';
		$this->load->view('Notifications_view',$data);
	}

	

	function liste()
 	{


 		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 		$query_principal="SELECT `NOTIFICATION_ID`, `MESSAGE`, `DESTINATAIRE`, `DATE_ENVOI`, `STATUT` FROM `notifications_stock` WHERE 1";

 		$order_column=array("DESTINATAIRE","DATE_ENVOI","MESSAGE");

 		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY NOTIFICATION_ID DESC';

 		$search = !empty($_POST['search']['value']) ? (" AND  (DATE_ENVOI LIKE '%$var_search%' OR DESTINATAIRE LIKE '%var_search%') ") : '';

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

 			$sub_array[] = $row->DESTINATAIRE;
 			$sub_array[] = date('d-m-Y H:i:s',strtotime($row->DATE_ENVOI));
 			$sub_array[] = '<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#standard-modal'.$row->NOTIFICATION_ID.'"><span class="mdi mdi-email-receive-outline"></span></button>
 			<div id="standard-modal'.$row->NOTIFICATION_ID.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
 			<div class="modal-dialog modal-lg">
 			<div class="modal-content">
 			<div class="modal-header">
 			<h4 class="modal-title" id="standard-modalLabel'.$row->NOTIFICATION_ID.'">'.date('d-m-Y H:i:s',strtotime($row->DATE_ENVOI)).'</h4>
 			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
 			</div>
 			<div class="modal-body">
 			<div>'.$row->MESSAGE.'</div>
 			</div>
 			<div class="modal-footer">
 			<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
 			</div>
 			</div><!-- /.modal-content -->
 			</div><!-- /.modal-dialog -->
 			</div><!-- /.modal -->';

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




	
}