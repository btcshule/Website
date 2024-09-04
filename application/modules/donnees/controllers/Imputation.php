<?php 

/**
/**
* @author nadvaxe2023

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Imputation extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		 $this->is_auth();
	}

	function is_auth()
	{
		if (empty($this->session->userdata('EMPLOYE_ID'))) {
			redirect(base_url('index.php/'));
		}
	}

	function index()
	{
		$data['page_title']="Imputation";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Données</a></li>
		<li class="breadcrumb-item active" aria-current="page">Imputations</li>
		</ol>
		</nav>';
		
		$this->load->view('Imputation_view',$data);
	}

	function ajouter()
	{    
		$CODE_IMPUTATION=$this->input->post('CODE_IMPUTATION');
		$DESC_IMPUTATION=$this->input->post('DESC_IMPUTATION');
		$STATUT=1;
		$data=array('CODE_IMPUTATION'=>trim($CODE_IMPUTATION),'DESC_IMPUTATION'=>trim($DESC_IMPUTATION),'STATUT'=>trim($STATUT));
		$this->Model->create('imputations',$data);
		echo json_encode(array('status'=>true));

	}
	function liste()
	{


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `ID_IMPUTATION`, `CODE_IMPUTATION`,DESC_IMPUTATION,`STATUT` FROM `imputations` WHERE 1";

		$order_column=array("CODE_IMPUTATION","DESC_IMPUTATION","(CASE WHEN STATUT=1 THEN 'Inactive' ELSE 'Valide' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DESC_IMPUTATION  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (DESC_IMPUTATION LIKE '%$var_search%' OR CODE_IMPUTATION LIKE '%$var_search%') ") : '';

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
				$STATUT='Inactive';
			}
			$sub_array = array();  

			$sub_array[] = $row->CODE_IMPUTATION;
			$sub_array[] = $row->DESC_IMPUTATION;
			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->ID_IMPUTATION.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
			<a href="javascript:void(0);" onclick="supp_logic('.$row->ID_IMPUTATION.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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
		$this->Model->update('imputations',array('ID_IMPUTATION'=>$id),array('STATUT'=>$value));
		echo json_encode(array('status'=>true));
	}
	function getOne($id)
	{
		$data=$this->Model->getRequeteOne('SELECT `ID_IMPUTATION`, `CODE_IMPUTATION`,DESC_IMPUTATION, `STATUT` FROM `imputations` WHERE ID_IMPUTATION='.$id);
		echo json_encode($data);
	}
	function update()
	{
		$DESC_IMPUTATION=$this->input->post('DESC_IMPUTATION');
		$CODE_IMPUTATION=$this->input->post('CODE_IMPUTATION');
		$this->Model->update('imputations',array('ID_IMPUTATION'=>$this->input->post('ID_IMPUTATION')),array('CODE_IMPUTATION'=>$CODE_IMPUTATION,'DESC_IMPUTATION'=>$DESC_IMPUTATION));
		echo json_encode(array('status'=>true));
	}
}
?>