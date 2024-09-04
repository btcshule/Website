<?php 

/**
/**
* @author nadvaxe2023

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Branches extends CI_Controller
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
		$data['page_title']="Branches";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';
		
		//$data['type']=$this->Model->getRequete('SELECT `TYPE_IMMO_ID`, `TYPE_IMMO_DESC`, `STATUT_TYPE` FROM `type_immobiler` WHERE  STATUT_TYPE=1');
		$this->load->view('Branches_view',$data);
	}

	function ajouter()
	{    
		$titre=$this->input->post('DESCRIPTION_BRANCH');
		$localisation=$this->input->post('LOCALISATION');
		$STATUT=1;
		$data=array('DESCRIPTION_BRANCH'=>trim($titre),'LOCALISATION'=>trim($localisation),'STATUT'=>trim($STATUT));
		$this->Model->create('sanya_branches',$data);
		echo json_encode(array('status'=>true));

	}
	function liste()
	{


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `ID_BRANCHE`, `DESCRIPTION_BRANCH`,LOCALISATION,`STATUT` FROM `sanya_branches` WHERE 1";

		$order_column=array("DESCRIPTION_BRANCH","LOCALISATION","(CASE WHEN STATUT=1 THEN 'Inactive' ELSE 'Valide' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DESCRIPTION_BRANCH  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (DESCRIPTION_BRANCH LIKE '%$var_search%' OR LOCALISATION LIKE '%$var_search%') ") : '';

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

			$sub_array[] = $row->DESCRIPTION_BRANCH;
			$sub_array[] = $row->LOCALISATION;
			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->ID_BRANCHE.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
			<a href="javascript:void(0);" onclick="supp_logic('.$row->ID_BRANCHE.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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
		$this->Model->update('sanya_branches',array('ID_BRANCHE'=>$id),array('STATUT'=>$value));
		echo json_encode(array('status'=>true));
	}
	function getOne($id)
	{
		$data=$this->Model->getRequeteOne('SELECT `ID_BRANCHE`, `DESCRIPTION_BRANCH`,LOCALISATION, `STATUT` FROM `sanya_branches` WHERE ID_BRANCHE='.$id);
		echo json_encode($data);
	}
	function update()
	{
		$DESCRIPTION_BRANCH=$this->input->post('DESCRIPTION_BRANCH');
		$LOCALISATION=$this->input->post('LOCALISATION');
		$this->Model->update('sanya_branches',array('ID_BRANCHE'=>$this->input->post('ID_BRANCHE')),array('DESCRIPTION_BRANCH'=>$DESCRIPTION_BRANCH,'LOCALISATION'=>$LOCALISATION));
		echo json_encode(array('status'=>true));
	}
}
?>