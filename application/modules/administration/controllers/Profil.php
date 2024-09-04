<?php 
/**
 * 
 */
class Profil extends CI_Controller
{
	
	function __construct()
 	{
 		parent::__construct();
 		//$this->is_auth();
 	}

 	function is_auth()
 	{
 		if (empty($this->session->userdata('EMPLOYE_ID'))) {
 			redirect(base_url(''));
 		}
 	}

 	function index()
	{
		
		$data['page_title']="Profils";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';

	
		$this->load->view('Profil_view',$data);
	}

	function add()
	{
		$this->_validate();
		$data=array('DESC_PROFIL'=>$this->input->post('DESC_PROFIL'));
		$this->Model->create('profil',$data);
		
		echo json_encode(array('status'=>true));
	}

	function update()
	{
		$this->_validate();
		$DESC_PROFIL=$this->input->post('DESC_PROFIL');

		$this->Model->update('profil',array('PROFILE_ID'=>$this->input->post('PROFILE_ID')),array('DESC_PROFIL'=>$DESC_PROFIL));
		echo json_encode(array('status'=>true));
	}

	function getOne($id)
	{
		$data=$this->Model->getOne('profil',array('PROFILE_ID'=>$id));
		echo json_encode($data);
	}
	function del($id,$stat)
	{
		$value = ($stat==1) ? 0 : 1 ;
		$this->Model->update('profil',array('PROFILE_ID'=>$id),array('IS_DELETED'=>$value));
		echo json_encode(array('status'=>true));
	}


	function liste()
 	{


 		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 		$query_principal="SELECT p.PROFILE_ID,p.DESC_PROFIL,p.IS_DELETED,(CASE WHEN p.IS_DELETED=1 THEN 'Supprimé' ELSE 'Valide' END) PROF_STAT FROM profil p WHERE 1";

 		$order_column=array("p.DESC_PROFIL","(CASE WHEN p.IS_DELETED=1 THEN 'Supprimé' ELSE 'Valide' END)","");

 		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY p.DESC_PROFIL  ASC';

 		$search = !empty($_POST['search']['value']) ? (" AND  (p.DESC_PROFIL LIKE '%$var_search%' OR (CASE WHEN p.IS_DELETED=1 THEN 'Supprimé' ELSE 'Valide' END) LIKE '%var_search%') ") : '';

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

 			$sub_array[] = $row->DESC_PROFIL;
 			$sub_array[] = ($row->IS_DELETED==0) ? '<span class="badge bg-success">'.$row->PROF_STAT.'</span>' : '<span class="badge bg-danger">'.$row->PROF_STAT.'</span>';
 			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_profil('.$row->PROFILE_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 			<a href="javascript:void(0);" onclick="supp_logic('.$row->PROFILE_ID.','.$row->IS_DELETED.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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




	function _validate()
	{
		$data=array();
		$data['inputerror']=array();
		$data['error_string']=array();
		$data['status']=true;

		$check_doublo=$this->Model->getOne('profil',array('PROFILE_ID<>'=>$this->input->post('PROFILE_ID'),'DESC_PROFIL'=>$this->input->post('DESC_PROFIL')));

		if (!empty($check_doublo)) {
			# code...
			$data['inputerror'][]="DESC_PROFIL";
			$data['error_string'][]="L'élément existe déjà";
			$data['status']=false;
		}

		if($this->input->post('DESC_PROFIL')=="")
		{
			$data['inputerror'][]="DESC_PROFIL";
			$data['error_string'][]="Le champs est obligatoire";
			$data['status']=false;
		}
		if ($data['status']==false) 
		{
			echo json_encode($data);
			exit();
		}
	}




	
}