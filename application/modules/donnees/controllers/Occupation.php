<?php 

/**
/**
* @author nestorruhaya

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Occupation extends CI_Controller
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
		$data['page_title']="Catégorie du personnel";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Données</a></li>
		<li class="breadcrumb-item active" aria-current="page">Postes de services</li>
		</ol>
		</nav>';
		
		$this->load->view('Occupation_view',$data);
	}

	function add()
	{
		$OCCUPATION_DESC=$this->input->post('OCCUPATION_DESC');
		$STATUT=1;
		$data=array('OCCUPATION_DESC'=>trim($OCCUPATION_DESC),'STATUT'=>trim($STATUT));
		$this->Model->create('occupations',$data);
		echo json_encode(array('status'=>true));

	}

	function liste()
	{


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `OCCUPATION_ID`, `OCCUPATION_DESC`, `STATUT` FROM `occupations` WHERE 1";

		$order_column=array("OCCUPATION_DESC","(CASE WHEN STATUT=1 THEN 'Supprimé' ELSE 'Valide' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY STATUT  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (OCCUPATION_DESC LIKE '%$var_search%') ") : '';

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

			$sub_array[] = $row->OCCUPATION_DESC;
			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->OCCUPATION_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
			<a href="javascript:void(0);" onclick="supp_logic('.$row->OCCUPATION_ID.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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
		$this->Model->update('occupations',array('OCCUPATION_ID'=>$id),array('STATUT'=>$value));
		echo json_encode(array('status'=>true));
	}
	function getOne($id)
	{
		$data=$this->Model->getOne('occupations',array('OCCUPATION_ID'=>$id));
		echo json_encode($data);
	}
	function update()
	{
		$OCCUPATION_DESC=$this->input->post('OCCUPATION_DESC');
		$this->Model->update('occupations',array('OCCUPATION_ID'=>$this->input->post('OCCUPATION_ID')),array('OCCUPATION_DESC'=>$OCCUPATION_DESC));
		echo json_encode(array('status'=>true));
	}
}
?>