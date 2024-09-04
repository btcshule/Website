<?php 

/**
/**
* @author nestorruhaya

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Services extends CI_Controller
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
		$data['page_title']="Liste des services disponibles";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Services</li>
		</ol>
		</nav>';
		
		$this->load->view('Services_view',$data);
	}

	function add()
	{   
		$ID_BRANCHE=$this->session->userdata('ID_BRANCHE');
		$OCCUPATION_DESC=$this->input->post('OCCUPATION_DESC');
		$MONTANT_SERVICE=$this->input->post('MONTANT_SERVICE');
		$STATUT=1;
		$date=date('Y-m-d H:i:s');
		$cath=0;
		$data=array('PRODUCT_DESC'=>trim($OCCUPATION_DESC),'CATH_ID'=>$cath,'CODE'=>0,'PIECES'=>0,'ID_BRANCHE'=>trim($ID_BRANCHE),'SERVICE_COST'=>$MONTANT_SERVICE,'DATE_INSERTION'=>$date);
		$prod=$this->Model->insert_last_id('products',$data);

		$data22=array('PRODUCT_ID'=>trim($prod),'TYPE_STOCK'=>0,'QNTE'=>NULL,'PA_U'=>NULL,'PV_U'=>NULL,'DATE_INSERTION'=>$date);
		$this->Model->create('stock_secretariat',$data22);

		echo json_encode(array('status'=>true));

	}

	function liste()
	{


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
		$ID_BRANCHE=$this->session->userdata('ID_BRANCHE');
        
		$query_principal="SELECT products.`PRODUCT_ID`, `PRODUCT_DESC`, `CATH_ID`, `CODE`, `PIECES`, `SERVICE_COST`, `ID_BRANCHE`,STATUT FROM `products` Join stock_secretariat ON stock_secretariat.PRODUCT_ID=products.PRODUCT_ID WHERE CATH_ID=0 AND ID_BRANCHE=".$ID_BRANCHE;

		$order_column=array("PRODUCT_DESC","(CASE WHEN STATUT=1 THEN 'Supprimé' ELSE 'Valide' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY PRODUCT_DESC  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (PRODUCT_DESC LIKE '%$var_search%') ") : '';

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
            

			$sub_array[] = $row->PRODUCT_DESC;
			$sub_array[] = $row->SERVICE_COST;
			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->PRODUCT_ID.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
			<a href="javascript:void(0);" onclick="supp_logic('.$row->PRODUCT_ID.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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
		$this->Model->update('stock_secretariat',array('PRODUCT_ID'=>$id),array('STATUT'=>$value));
		echo json_encode(array('status'=>true));
	}
	function getOne($id)
	{
		$data=$this->Model->getOne('products',array('PRODUCT_ID'=>$id));
		echo json_encode($data);
	}
	function update()
	{
		$OCCUPATION_DESC=$this->input->post('OCCUPATION_DESC');
		$MONTANT_SERVICE=$this->input->post('MONTANT_SERVICE');
		$this->Model->update('products',array('PRODUCT_ID'=>$this->input->post('SERVICE_ID')),array('PRODUCT_DESC'=>$OCCUPATION_DESC,'SERVICE_COST'=>$MONTANT_SERVICE));
		echo json_encode(array('status'=>true));
	}
}
?>