<?php
/**
 * @author NSHIMIRIMANA Reverien
   @date :le 13-11-2022
 */
class Services extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}


	function index()
	{
		
		$data['page_title']="Services";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';
		$this->load->view('Services_view',$data);
	}

	function add()
	{
		$this->_validate();
		$NOM_SERVICE=$this->input->post('NOM_SERVICE');
		
		$datas=array('NOM_SERVICE'=>$NOM_SERVICE);
		$this->Model->create('service',$datas);
		echo json_encode(array('status'=>true));

	}

	function update()
	{
		$this->_validate();
		$SERVICE_ID=$this->input->post('SERVICE_ID');
		$NOM_SERVICE=$this->input->post('NOM_SERVICE');
		$datas=array('NOM_SERVICE'=>$NOM_SERVICE);

		$this->Model->update('service',array('SERVICE_ID'=>$SERVICE_ID),$datas);
		echo json_encode(array('status'=>true));

	}

	function getOne($id)
	{
		$data=$this->Model->getOne('service',array('SERVICE_ID'=>$id));
		echo json_encode($data);
	}

	function del($id)
	{
		$this->Model->delete('service',array('SERVICE_ID'=>$id));
		echo json_encode(array('status'=>true));
	}

	function liste()
	{
		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
		$query_principal="SELECT `SERVICE_ID`, `NOM_SERVICE` FROM `service` WHERE 1";

		$limit='LIMIT 0,10';
		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY SERVICE_ID   DESC';

		$search = !empty($_POST['search']['value']) ? (" AND  (NOM_SERVICE LIKE '%$var_search%')") : '';
		$critaire ="";

		$query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter=$query_principal.'  '.$critaire.' '.$search;
		$fetch_data = $this->Model->datatable($query_secondaire); 
		$u=0; 
		$data = array();

		foreach ($fetch_data as $row) {

			$sub_array = array();  
			$sub_array[] = $row->NOM_SERVICE;
			$options="";
			// if ($this->session->userdata('OPTIONS')==1 && ($this->session->userdata('PROFILE_CODE')=='GESTIONNAIRE' || $this->session->userdata('PROFILE_CODE')=='ADMIN' || $this->session->userdata('PROFILE_CODE')=='DIRECTION')) 
			// {
				// code...
				// if ($this->session->userdata('SUPPRESSION') && $this->session->userdata('MODIFIER')) {
					// code...
					$sub_array[]='<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Modifier" onclick="edit_service('."'".$row->SERVICE_ID."'".')"><i class="dripicons-pencil"></i></a> <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Supprimer" onclick="delete_service('."'".$row->SERVICE_ID."'".')"><i class="dripicons-trash"></i></a>';
			// 	}else{
			// 		$sub_array[]='<a class="btn btn-sm btn-secondary" title="No access"><i class="dripicons-wrong"></i></a>';
			// 	}
			// }else{
			// 	$sub_array[]='<a class="btn btn-sm btn-secondary" title="No access"><i class="dripicons-wrong"></i></a>';
			// }
			
			

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
		$data['error_string']=array();
		$data['inputerror']=array();
		$data['status']=true;

		$get_serv=$this->Model->getOne('service',array('NOM_SERVICE'=>$this->input->post('NOM_SERVICE'),'SERVICE_ID!='=>$this->input->post('SERVICE_ID')));

		if ($get_serv>0) {
			# code...
			$data['error_string'][]="Le service existe déjà";
			$data['inputerror'][]="NOM_SERVICE";
			$data['status']=FALSE;
		}

		if (empty($this->input->post('NOM_SERVICE'))) 
		{
			# code...
			$data['error_string'][]="Le champs est obligatoire";
			$data['inputerror'][]="NOM_SERVICE";
			$data['status']=FALSE;
		}

		if ($data['status']==FALSE) 
		{
			# code...
			echo json_encode($data);
			exit();
		}
	}
}