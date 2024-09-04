<?php 

/**
/**
* @author nestorruhaya

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Categorie extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function is_auth()
	{
		if (empty($this->session->userdata('EMPLOYE_ID'))) {
			redirect(base_url('index.php/'));
		}
	}

	function index()
	{
		$data['page_title']="Catégorie";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';
		
		$this->load->view('Categorie_view',$data);
	}
 
	function add()
	{
		$DESCR_CAT=$this->input->post('CATEGORIE');
		$STATUT_CAT=1;
		$data=array('DESCR_CAT'=>trim($DESCR_CAT),'STATUT_CAT'=>trim($STATUT_CAT));
		$this->Model->create('cat_immobilier',$data);
		echo json_encode(array('status'=>true));

	}

	function liste()
	{


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `ID_CAT`, `DESCR_CAT`, `STATUT_CAT` FROM `cat_immobilier` WHERE 1";

		$order_column=array("DESCR_CAT");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DESCR_CAT  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (DESCR_CAT LIKE '%$var_search%')") : '';

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
			$u++;   
			$sub_array[] = $u;
			$sub_array[] = $row->DESCR_CAT;
			if ($row->STATUT_CAT==1) {
			$STATUT='active';
		}else{
			$STATUT='Inactive';
		}
			$sub_array[] = ($row->STATUT_CAT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
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
	function getOne($id)
	{
		$data=$this->Model->getRequeteOne('SELECT `CATH_ID`, `CATH_DESC`, `STATUT` FROM `cathegories` WHERE 1 CATH_ID='.$id);
		echo json_encode($data);
	}
	function update()
	{
		$CATH_DESC=$this->input->post('CATEGORIE');
		$this->Model->update('cathegories',array('CATH_ID'=>$this->input->post('CATH_ID')),array('CATH_DESC'=>$CATH_DESC));
		echo json_encode(array('status'=>true));
	}
}
?>