<?php 
/**
/**
* @author nadvaxe2023
* le 08/10/2023
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Entrees_stock extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// $this->is_auth();
	}

	function is_auth()
	{
		if (empty($this->session->userdata('EMPLOYE_ID'))) {
			redirect(base_url('index.php/'));
		}
	}

	function index()
	{
		$data['page_title']="Nos clients";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';
		$data['Measure']=$this->Model->getRequete('SELECT * FROM `gros_unite` WHERE 1');
		$data['produit']=$this->Model->getRequete('SELECT * FROM `gros_produit` WHERE 1 ORDER by `GROS_PRODUIT_DESCR`ASC');
		
		$this->load->view('Entrees_stock_view',$data);
	}

	function ajouter()
	{    
		$ID=$this->input->post('DESIGNATION');
		$old=$this->Model->getOne('gros_stock',array('GROS_PRODUIT_ID'=>$ID));
		$hourtime=date('Y-m-d H:i:s');

		$data=array(

			'GROS_STOCK_ID'=>$old['GROS_STOCK_ID'],
			'QUANTITE_PRODUIT'=>$this->input->post('quante_new'),
			'PRIX_ACHAT_UNITAIRE'=>$this->input->post('prix_achatUnit'),
			'PRIX_VENTE_UNITAIRE '=>$this->input->post('prix_vente'),
			'DATE_INSERTION'=>$hourtime,

		);

		// print_r($data);die();
		$quant=$this->input->post('quante_new')+$old['QNTE'];
		$prix_v_tot=$quant*$this->input->post('prix_vente');
		$prix_a_tot=$quant*$this->input->post('prix_achatUnit');

		$dataUp= array(

			'QNTE'=>$quant,
			'MUNI'=>$this->input->post('STOCK_MUNI'),
			'PA_U'=>$this->input->post('prix_achatUnit'),
			'PV_U'=>$this->input->post('prix_vente'),
			'PV_GROS'=>$this->input->post('prix_venteGROS'),
			'LOT'=>$this->input->post('LOT'),
			'PA_T'=>$prix_a_tot,
			'PV_T'=>$prix_v_tot,
			'STATUT'=>1,
			'DATE_EXP'=>$this->input->post('date_exp'),

		);

		$creation=$this->Model->create('gros_entrees_stock',$data);
		$update=$this->Model->update('gros_stock', array('GROS_STOCK_ID' =>$ID), $dataUp);

		if ($creation && $update)
		{

			$data['message']='<div class="alert alert-success alert-dismissible alert-alt solid fade show">
			<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
			</button>
			<center><strong>Opération effectuée avec succès</strong></center>
			</div>';
			$this->session->set_flashdata($data);
		}

		redirect(base_url('index.php/stock/Listes_stock/'));

	}

	function get_data($id=0)
	{

		$datas = $this->Model->getRequeteOne('SELECT * FROM gros_stock WHERE GROS_PRODUIT_ID='.$id);
		echo json_encode($datas);
	}
	function get_designations($GROS_UNIT_ID=0)
	{
		$designation=$this->Model->getRequete('SELECT `GROS_PRODUIT_ID`, `GROS_PRODUIT_DESCR`, `GROS_UNIT_ID` FROM `gros_produit` WHERE GROS_UNIT_ID='.$GROS_UNIT_ID.' ORDER BY GROS_PRODUIT_DESCR ASC');
		$html='<option value="">---Sélectionner---</option>';
		foreach ($designation as $key)
		{
			$html.='<option value="'.$key['GROS_PRODUIT_ID'].'">'.$key['GROS_PRODUIT_DESCR'].'</option>';
		}
		echo json_encode($html);
	}


	function liste()
	{


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT `ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `TEL_CLIENT`, `LOC_CLIENT`,STATUT FROM `clients_sanya` WHERE 1";

		$order_column=array("NOM_CLIENT","PRENOM_CLIENT","TEL_CLIENT","LOC_CLIENT","(CASE WHEN STATUT=1 THEN 'Inactif' ELSE 'Actif' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY LOC_CLIENT  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (NOM_CLIENT LIKE '%$var_search%' OR PRENOM_CLIENT LIKE '%$var_search%',OR TEL_CLIENT LIKE '%$var_search%'OR LOC_CLIENT LIKE '%$var_search%'OR STATUT LIKE '%$var_search%') ") : '';

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
				$STATUT='Actif';
			}else{
				$STATUT='Inactif';
			}
			$sub_array = array();  
			$sub_array[] = $row->NOM_CLIENT.' '.$row->PRENOM_CLIENT;
			$sub_array[] = $row->TEL_CLIENT;
			$sub_array[] = $row->LOC_CLIENT;
			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
			$sub_array[] = '<a href="javascript:void(0);" style="color:green;" onclick="edit_emp('.$row->ID_CLIENT.')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
			<a href="javascript:void(0);" onclick="supp_logic('.$row->ID_CLIENT.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';

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
		$this->Model->update('clients_sanya',array('ID_CLIENT'=>$id),array('STATUT'=>$value));
		echo json_encode(array('status'=>true));
	}
	function getOne($id)
	{
		$data=$this->Model->getRequeteOne('SELECT `ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `TEL_CLIENT`, `LOC_CLIENT`, `STATUT`, `DATE_INSERTION` FROM `clients_sanya` WHERE  ID_CLIENT='.$id);
		echo json_encode($data);
	}
	function update()
	{
		$nom=$this->input->post('NOM_CLIENT');
		$prenom=$this->input->post('PRENOM_CLIENT');
		$tel=$this->input->post('TEL_CLIENT');
		$localisation=$this->input->post('LOCALISATION');
		$this->Model->update('clients_sanya',array('ID_CLIENT'=>$this->input->post('ID_CLIENT')),array('NOM_CLIENT'=>$nom,'PRENOM_CLIENT'=>$prenom,'TEL_CLIENT'=>$tel,'LOC_CLIENT'=>$localisation));
		echo json_encode(array('status'=>true));
	}
}
?>