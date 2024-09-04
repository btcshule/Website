<?php 

/**
/**
* @author nestorruhaya

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Unite_organisation extends CI_Controller
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
		$data['page_title']="Unité organisationnelle";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';
		
		$data['ministere']=$this->Model->getRequete('SELECT `MINISTERE_ID`, `DESC_MINISTERE`, `CODE_MINISTERE`, `STATUT_MIN` FROM `ou_ministere` WHERE STATUT_MIN=1');
		$this->load->view('Unite_organisation_view',$data);
	}

	function add()
	{    

		$OU_DESC=$this->input->post('OU_DESC');
		$CODE=$this->input->post('CODE');
		$STATUT_OU=1;
		$MINISTERE_ID=1;
		$data=array('OU_DESC'=>trim($OU_DESC),'OU_NUM'=>trim($CODE),'MINISTERE_ID'=>trim($MINISTERE_ID),'STATUT_OU'=>trim($STATUT_OU));
		$this->Model->create('ou',$data);
		echo json_encode(array('status'=>true));

	}

	function liste()
	{


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `ID_OU`, `OU_DESC`, `MINISTERE_ID`, `OU_NUM`, `STATUT_OU` FROM `ou` WHERE 1";

		$order_column=array("OU_DESC","OU_NUM","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY OU_DESC  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (OU_DESC LIKE '%$var_search%' OR OU_NUM LIKE '%$var_search%') ") : '';

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

			if ($row->STATUT_OU==1) {
				$STATUT='active';
			}else{
				$STATUT='Supprimé';
			}
			$sub_array = array();  


			$sub_array[] = $row->OU_DESC;
			$sub_array[] = $row->OU_NUM;
			$sub_array[] = ($row->STATUT_OU==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->ID_OU.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
			<a href="javascript:void(0);" onclick="supp_logic('.$row->ID_OU.','.$row->STATUT_OU.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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
		$this->Model->update('ou',array('ID_OU'=>$id),array('STATUT_OU'=>$value));
		echo json_encode(array('status'=>true));
	}
	function getOne($id)
	{
		$data=$this->Model->getRequeteOne('SELECT `ID_OU`, `OU_DESC`, `OU_NUM`,ou.MINISTERE_ID, `STATUT_OU` FROM `ou` WHERE ID_OU='.$id);
		echo json_encode($data);
	}
	function update()
	{
		$OU_DESC=$this->input->post('OU_DESC');
		$OU_NUM=$this->input->post('CODE');
		$this->Model->update('ou',array('ID_OU'=>$this->input->post('OU_ID')),array('OU_DESC'=>$OU_DESC,'OU_NUM'=>$OU_NUM));
		echo json_encode(array('status'=>true));
	}
}
?>