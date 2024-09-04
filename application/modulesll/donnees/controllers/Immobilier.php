<?php 

/**
/**
* @author nestorruhaya

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Immobilier extends CI_Controller
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
		$data['page_title']="Occupation";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';
		
		$data['type']=$this->Model->getRequete('SELECT `TYPE_IMMO_ID`, `TYPE_IMMO_DESC`, `STATUT_TYPE` FROM `type_immobiler` WHERE  STATUT_TYPE=1');
		$this->load->view('Immobilier_view',$data);
	}

	function add()
	{    

		$IMMOB_DESC=$this->input->post('IMMOB_DESC');
		$TYPE_IMMO_ID=$this->input->post('TYPE_IMMO_ID');
		$STATUT=1;
		$data=array('IMMOB_DESC'=>trim($IMMOB_DESC),'TYPE_IMMO_ID'=>trim($TYPE_IMMO_ID),'STATUT'=>trim($STATUT));
		$this->Model->create('immo_immobilier',$data);
		echo json_encode(array('status'=>true));

	}

	function liste()
	{


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `ID_IMMOBILIER`, `IMMOB_DESC`, `TYPE_IMMO_DESC`, `STATUT` FROM `immo_immobilier`JOIN type_immobiler ON type_immobiler.TYPE_IMMO_ID=immo_immobilier.TYPE_IMMO_ID WHERE 1";

		$order_column=array("IMMOB_DESC","TYPE_IMMO_DESC","(CASE WHEN STATUT=1 THEN 'Supprimé' ELSE 'Valide' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY IMMOB_DESC  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (IMMOB_DESC LIKE '%$var_search%' OR TYPE_IMMO_DESC LIKE '%$var_search%') ") : '';

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

			if ($row->STATUT==1) {
				$STATUT='active';
			}else{
				$STATUT='Supprimé';
			}
			$sub_array = array();  

			$sub_array[] = $row->IMMOB_DESC;
			$sub_array[] = $row->TYPE_IMMO_DESC;
			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->ID_IMMOBILIER.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
			<a href="javascript:void(0);" onclick="supp_logic('.$row->ID_IMMOBILIER.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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


	function del($id,$stat)
	{
		$value = ($stat==1) ? 0 : 1 ;
		$this->Model->update('immo_immobilier',array('ID_IMMOBILIER'=>$id),array('STATUT'=>$value));
		echo json_encode(array('status'=>true));
	}
	function getOne($id)
	{
		$data=$this->Model->getRequeteOne('SELECT `ID_IMMOBILIER`, `IMMOB_DESC`, `TYPE_IMMO_DESC`, `STATUT` FROM `immo_immobilier`JOIN type_immobiler ON type_immobiler.TYPE_IMMO_ID=immo_immobilier.TYPE_IMMO_ID WHERE ID_IMMOBILIER='.$id);
		echo json_encode($data);
	}
	function update()
	{
		$IMMOB_DESC=$this->input->post('IMMOB_DESC');
		$TYPE_IMMO_ID=$this->input->post('TYPE_IMMO_ID');
		$this->Model->update('immo_immobilier',array('ID_IMMOBILIER'=>$this->input->post('ID_IMMOBILIER')),array('IMMOB_DESC'=>$IMMOB_DESC,'TYPE_IMMO_ID'=>$TYPE_IMMO_ID));
		echo json_encode(array('status'=>true));
	}
}
?>