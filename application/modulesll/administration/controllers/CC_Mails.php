<?php 
/**
 * 
 */
class CC_Mails extends CI_Controller
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
		
		$data['page_title']="CC";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';

	
		$this->load->view('CC_Mails_view',$data);
	}

	function add()
	{
		$this->_validate();
		$data=array('CC_MAIL_DESC'=>trim($this->input->post('CC_MAIL_DESC')));
		$this->Model->create('cc_mails',$data);
		
		echo json_encode(array('status'=>true));
	}

	function update()
	{
		$this->_validate();
		$CC_MAIL_DESC=trim($this->input->post('CC_MAIL_DESC'));

		$this->Model->update('cc_mails',array('CC_MAIL_ID'=>$this->input->post('CC_MAIL_ID')),array('CC_MAIL_DESC'=>$CC_MAIL_DESC));
		echo json_encode(array('status'=>true));
	}

	function getOne($id)
	{
		$data=$this->Model->getOne('cc_mails',array('CC_MAIL_ID'=>$id));
		echo json_encode($data);
	}
	function supp_logic($id,$stat)
	{
		$value = ($stat==1) ? 0 : 1 ;
		$this->Model->update('cc_mails',array('CC_MAIL_ID'=>$id),array('STATUT'=>$value));
		echo json_encode(array('status'=>true));
	}


	function liste()
 	{


 		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 		$query_principal="SELECT CC_MAIL_ID,CC_MAIL_DESC,STATUT,(CASE WHEN STATUT=0 THEN 'Supprimé' ELSE 'Valide' END) STAT FROM cc_mails p WHERE 1";

 		$order_column=array("CC_MAIL_DESC","(CASE WHEN STATUT=1 THEN 'Supprimé' ELSE 'Valide' END)","");

 		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY CC_MAIL_DESC  ASC';

 		$search = !empty($_POST['search']['value']) ? (" AND  (CC_MAIL_DESC LIKE '%$var_search%' OR (CASE WHEN STATUT=1 THEN 'Supprimé' ELSE 'Valide' END) LIKE '%var_search%') ") : '';

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

 			$sub_array[] = $row->CC_MAIL_DESC;
 			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$row->STAT.'</span>' : '<span class="badge bg-danger">'.$row->STAT.'</span>';
 			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_cc('.$row->CC_MAIL_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
 			<a href="javascript:void(0);" onclick="supp_logic('.$row->CC_MAIL_ID.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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

		$check_doublo=$this->Model->getOne('cc_mails',array('CC_MAIL_ID<>'=>$this->input->post('CC_MAIL_ID'),'CC_MAIL_DESC'=>trim($this->input->post('CC_MAIL_DESC'))));
		$regex_email = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

		if (!empty($check_doublo)) {
			# code...
			$data['inputerror'][]="CC_MAIL_DESC";
			$data['error_string'][]="L'email existe déjà";
			$data['status']=false;
		}

		if($this->input->post('CC_MAIL_DESC')=="")
		{
			$data['inputerror'][]="CC_MAIL_DESC";
			$data['error_string'][]="Le champs est obligatoire";
			$data['status']=false;
		}

		if ((!preg_match($regex_email,trim($this->input->post('CC_MAIL_DESC')))) && !empty(trim($this->input->post('CC_MAIL_DESC')))) {
			$data['inputerror'][]='CC_MAIL_DESC';
			$data['error_string'][]='Le email est invalide';
			$data['status']=FALSE;
		}



		if ($data['status']==false) 
		{
			echo json_encode($data);
			exit();
		}
	}




	
}