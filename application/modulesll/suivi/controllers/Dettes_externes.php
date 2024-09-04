<?php 

/**
/**
* @author nadvaxe2023

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Dettes_externes extends CI_Controller
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
		$data['page_title']="Gestionnaire des Dettes Externes";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';
		
		 $data['client']=$this->Model->getRequete('SELECT `ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `TEL_CLIENT`, `LOC_CLIENT`, `STATUT`, `DATE_INSERTION` FROM `clients_sanya` WHERE 1 ORDER BY NOM_CLIENT ASC');		
		$this->load->view('Dettes_externe_view',$data);
	}

	function ajouter()
	{    
		$DATE_DETTE=$this->input->post('DATE_DETTE');
		$ID_CLIENT=$this->input->post('ID_CLIENT');
		$DESIGNATION=$this->input->post('DESIGNATION');
		$MONTANT=$this->input->post('MONTANT');
		$STATUT=0;
		$data=array('DATE_DETTE'=>trim($DATE_DETTE),'MONTANT'=>trim($MONTANT),'ID_CLIENT'=>trim($ID_CLIENT),'DESIGNATION'=>trim($DESIGNATION),'STATUT'=>trim($STATUT));
		$this->Model->create('dettes_externes',$data);
		echo json_encode(array('status'=>true));

	}
	function liste()
	{
		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `ID_DETTE_EXTERNE`,NOM_CLIENT,PRENOM_CLIENT, `DESIGNATION`, `MONTANT`, `DATE_DETTE`, dettes_externes.DATE_INSERTION, dettes_externes.STATUT FROM `dettes_externes` LEFT JOIN clients_sanya ON clients_sanya.ID_CLIENT=dettes_externes.ID_CLIENT WHERE 1";

		$order_column=array("DESIGNATION","MONTANT","DATE_DETTE","(CASE WHEN STATUT=1 THEN 'Non payé' ELSE 'Payé' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DESIGNATION  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (DESIGNATION LIKE '%$var_search%' OR DATE_DETTE LIKE '%$var_search%') ") : '';

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
				$STATUT='Payé';
			}else{
				$STATUT='Non Payé';
			}
			$sub_array = array();  

			$sub_array[] = $row->DATE_DETTE;
			$sub_array[] = $row->DESIGNATION;
			$sub_array[] = $row->MONTANT;
			$sub_array[] = $row->NOM_CLIENT.' '.$row->PRENOM_CLIENT;
			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->ID_DETTE_EXTERNE.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
			<a href="javascript:void(0);" onclick="supp_logic('.$row->ID_DETTE_EXTERNE.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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
		$this->Model->update('dettes_externes',array('ID_DETTE_EXTERNE'=>$id),array('STATUT'=>$value));
		echo json_encode(array('status'=>true));
	}
	function getOne($id)
	{
		$data=$this->Model->getRequeteOne('SELECT * FROM `dettes_externes` WHERE ID_DETTE_EXTERNE='.$id);
		echo json_encode($data);
	}
	// function update()
	// {
	// 	$DESCRIPTION_BRANCH=$this->input->post('DESCRIPTION_BRANCH');
	// 	$LOCALISATION=$this->input->post('LOCALISATION');
	// 	$this->Model->update('sanya_branches',array('ID_BRANCHE'=>$this->input->post('ID_BRANCHE')),array('DESCRIPTION_BRANCH'=>$DESCRIPTION_BRANCH,'LOCALISATION'=>$LOCALISATION));
	// 	echo json_encode(array('status'=>true));
	// }
}
?>