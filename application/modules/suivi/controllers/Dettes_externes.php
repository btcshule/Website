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
		$data['page_title']="Gestionnaire des créances";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Dettes & Créances</a></li>
		<li class="breadcrumb-item active" aria-current="page">Créances</li>
		</ol>
		</nav>';
		    $data['CLIENT'] = $this->Model->getRequete("SELECT `GROS_CLIENT_ID`, `PRENOM_GROS_CLIENT`, `NOM_GROS_CLIENT`, `ADRESS_GROS_CLIENT`, `TEL_GROS_CLIENT`, `IS_CLIENT`, `STATUT`, `NIF`, `RS`, `RC`, `ID_BRANCHE`, `DATE_INSERTION` FROM `gros_client` WHERE IS_CLIENT=1 AND ID_BRANCHE=".$this->session->userdata('ID_BRANCHE')) ;

		
// 		 $data['client']=$this->Model->getRequete('SELECT `ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `TEL_CLIENT`, `LOC_CLIENT`, `STATUT`, `DATE_INSERTION` FROM `clients_sanya` WHERE 1 ORDER BY NOM_CLIENT ASC');		
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

		$query_principal="SELECT dettes_externes.ID_CLIENT, `ID_DETTE_EXTERNE`,`NOM_GROS_CLIENT`,`PRENOM_GROS_CLIENT`, `DESIGNATION`, `MONTANT`, `DATE_DETTE`, dettes_externes.DATE_INSERTION, dettes_externes.STATUT FROM `dettes_externes` LEFT JOIN gros_client ON gros_client.GROS_CLIENT_ID=dettes_externes.ID_CLIENT WHERE dettes_externes.STATUT=0";

		$order_column=array("DESIGNATION","MONTANT","DATE_DETTE","(CASE WHEN STATUT=1 THEN 'Non payé' ELSE 'Payé' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DATE_DETTE  DESC';

		$search = !empty($_POST['search']['value']) ? (" AND  (DESIGNATION LIKE '%$var_search%' OR MONTANT LIKE '%$var_search%' OR NOM_GROS_CLIENT LIKE '%$var_search%' OR PRENOM_GROS_CLIENT LIKE '%$var_search%' OR dettes_externes.STATUT LIKE '%$var_search%' OR DATE_DETTE LIKE '%$var_search%') ") : '';

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
			$sub_array[] = $row->PRENOM_GROS_CLIENT.' '.$row->NOM_GROS_CLIENT;
     

			$sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
      $sub_array[] = '<div class="dropdown">
  <button class="btn btn-link action-icon dropdown-toggle" type="button" id="dropdownMenuButton'.$row->ID_DETTE_EXTERNE.'" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Choisir
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton'.$row->ID_DETTE_EXTERNE.'">
    <a class="dropdown-item" href="'.base_url('index.php/suivi/Dettes_externes/recouvrement/'.$row->ID_DETTE_EXTERNE).'">Partiel</a>
    <a class="dropdown-item" href="javascript:void(0);" onclick="supp_logic('.$row->ID_DETTE_EXTERNE.','.$row->DATE_DETTE.','.$row->MONTANT.','.$row->ID_CLIENT.')">Total</a>
  </div>
</div>';
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

	function getOne($id)
	{
		$data=$this->Model->getRequeteOne('SELECT * FROM `dettes_externes` WHERE ID_DETTE_EXTERNE='.$id);
		echo json_encode($data);
	}

public function recouvrement($ID_DETTE_EXTERNE){
    $data['page_title']="Gestionnaire des créances";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Dettes & Créances</a></li>
    <li class="breadcrumb-item active" aria-current="page">Créances</li>
    </ol>
    </nav>';
        $data['CLIENT'] = $this->Model->getRequete("SELECT `GROS_CLIENT_ID`, `PRENOM_GROS_CLIENT`, `NOM_GROS_CLIENT`, `ADRESS_GROS_CLIENT`, `TEL_GROS_CLIENT`, `IS_CLIENT`, `STATUT`, `NIF`, `RS`, `RC`, `ID_BRANCHE`, `DATE_INSERTION` FROM `gros_client` WHERE IS_CLIENT=1 AND ID_BRANCHE=".$this->session->userdata('ID_BRANCHE')) ;
  
    $data['infos_dette']=$this->Model->getRequeteOne('SELECT `ID_DETTE_EXTERNE`,dettes_externes.ID_CLIENT,`NOM_GROS_CLIENT`,`PRENOM_GROS_CLIENT`,GROS_CLIENT_ID, `DESIGNATION`, `MONTANT`,NIF,RS,TEL_GROS_CLIENT, `DATE_DETTE`, dettes_externes.DATE_INSERTION, dettes_externes.STATUT FROM `dettes_externes` LEFT JOIN gros_client ON gros_client.GROS_CLIENT_ID=dettes_externes.ID_CLIENT WHERE 1 AND   ID_DETTE_EXTERNE='.$ID_DETTE_EXTERNE);
    $this->load->view('Recouvrement_view',$data);
  }

  function liste_paiement()
  {


    $ID_DETTE_EXTERNE=$this->input->post('GROS_CLIENT_ID');
    // print_r($ID_DETTE_EXTERNE);die();
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal='SELECT recouvrement.ID_CLIENT, `ID_RECOUVREMENT`, gros_client.PRENOM_GROS_CLIENT, gros_client.NOM_GROS_CLIENT,gros_client.RS,gros_client.ADRESS_GROS_CLIENT,gros_client.TEL_GROS_CLIENT, `DATE_DETTE`, `MONTANT_PAYE`,employes.NOM_EMP,employes.PRENOM_EMP,employes.TEL_EMP,recouvrement.DATE_INSERTION FROM `recouvrement` LEFT JOIN gros_client ON  gros_client.GROS_CLIENT_ID=recouvrement.ID_CLIENT LEFT JOIN employes ON employes.EMPLOYE_ID=recouvrement.ID_EMPLOYE WHERE 1 AND recouvrement.ID_CLIENT='.$ID_DETTE_EXTERNE;

    $order_column=array("PRENOM_GROS_CLIENT","NOM_GROS_CLIENT","ADRESS_GROS_CLIENT","TEL_GROS_CLIENT","DATE_DETTE","MONTANT_PAYE","NOM_EMP","PRENOM_EMP","TEL_EMP","DATE_INSERTION");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY recouvrement.DATE_INSERTION  DESC';

    $search = !empty($_POST['search']['value']) ? (" AND  (PRENOM_GROS_CLIENT LIKE '%$var_search%' OR NOM_GROS_CLIENT LIKE '%$var_search%' OR ADRESS_GROS_CLIENT LIKE '%$var_search%' OR TEL_GROS_CLIENT LIKE '%$var_search%' OR DATE_DETTE LIKE '%$var_search%' OR MONTANT_PAYE LIKE '%$var_search%' OR NOM_EMP LIKE '%$var_search%' OR PRENOM_EMP LIKE '%$var_search%' OR TEL_EMP LIKE '%$var_search%' OR DATE_INSERTION LIKE '%$var_search%') ") : '';

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
      $sub_array[] = $row->DATE_DETTE;
      $sub_array[] = $row->MONTANT_PAYE;
      $sub_array[] = $row->PRENOM_GROS_CLIENT.' '.$row->NOM_GROS_CLIENT;
      $sub_array[] = $row->TEL_GROS_CLIENT;
      $sub_array[] = $row->PRENOM_EMP.' '.$row->NOM_EMP;
      $sub_array[] = $row->DATE_INSERTION;
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
  function payer()
  {    
    $ID_DETTE=$this->input->post('ID_DETTE_EXTERNE');
    $DATE_DETTE=$this->input->post('DATE_DETTE1');
    $ID_CLIENT=$this->input->post('GROS_CLIENT_ID');
    $MONTANT_PAYE=$this->input->post('MONTANT_PAYE');
    $EMPLOYE=$this->session->userdata('EMPLOYE_ID');
    $hourtime=date('Y-m-d H:i:s');
    $data=array('ID_CLIENT '=>trim($ID_CLIENT ),'DATE_DETTE'=>trim($DATE_DETTE),'MONTANT_PAYE'=>trim($MONTANT_PAYE),'ID_EMPLOYE '=>trim($EMPLOYE),'DATE_INSERTION '=>trim($hourtime));
        $MONTANT_EX= $this->Model->getRequeteOne("SELECT `MONTANT`FROM `dettes_externes` WHERE `ID_DETTE_EXTERNE`=".$ID_DETTE); 
        $NV_MONTANT=$MONTANT_EX['MONTANT']-$MONTANT_PAYE;
        if ($NV_MONTANT>0) 
        {
         $STATUT=0;
         $data_update=array('MONTANT'=>$NV_MONTANT,'STATUT'=>$STATUT);
        }else{
         $STATUT=1; 
          $data_update=array('MONTANT'=>$NV_MONTANT,'STATUT'=>$STATUT);
        }
    $insertion=$this->Model->create('recouvrement',$data);
    $update = $this->Model->update('dettes_externes', array('ID_DETTE_EXTERNE' => $ID_DETTE, 'ID_CLIENT' => $ID_CLIENT), $data_update); 
    redirect(base_url('index.php/suivi/Recouvrement/'));
  }
    function del($id)
  {
    $value =1 ;
    $ID_EMPLOYE=$this->session->userdata('EMPLOYE_ID');
    $hourtime=date('Y-m-d H:i:s');
    $datas= $this->Model->getRequeteOne("SELECT * FROM `dettes_externes` WHERE `ID_DETTE_EXTERNE`=".$id); 
    $ID_CLIENT=$datas['ID_CLIENT'];
    $MONTANT=$datas['MONTANT'];
    $MONTANT_RESTANT=$datas['MONTANT']-$MONTANT;
    $DATE_DETTE=$datas['DATE_DETTE'];

    $payement=array('MONTANT'=>$MONTANT_RESTANT,'STATUT'=>$value);
    $data=array('ID_CLIENT '=>trim($ID_CLIENT ),'DATE_DETTE'=>trim($DATE_DETTE),'MONTANT_PAYE'=>trim($MONTANT),'ID_EMPLOYE '=>trim($ID_EMPLOYE ));
    $insertion=$this->Model->create('recouvrement',$data);
    $this->Model->update('dettes_externes',array('ID_DETTE_EXTERNE'=>$id),$payement);
    echo json_encode(array('status'=>true));
  }
}
?>