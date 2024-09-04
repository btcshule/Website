<?php
/**
* 
*/
class Droits_utilisateurs extends CI_Controller
{
	


	function index()
	{
		// $data['title']="Gestion de droits";
		$data['page_title']="Gestion de droits";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';

		$data['profils']=$this->Model->getRequete("SELECT `PROFILE_ID`, `DESC_PROFIL` FROM `profil` WHERE 1 ORDER BY DESC_PROFIL ASC");

		$data['menus']=$this->Model->getRequete("SELECT `MENU_ID`, `MENU_DESC`, `STATUT` FROM `menus` WHERE 1 AND STATUT=1");
		$data['nbre_profil']=sizeof($data['profils']);
		$data['nbre_menu']=sizeof($data['menus']);

		$this->load->view('Droits_utilisateurs_view',$data);
	}

	function add()
	{

		$profils=$this->Model->getRequete("SELECT `PROFILE_ID`, `DESC_PROFIL` FROM `profil` WHERE 1 ORDER BY DESC_PROFIL ASC");

		$menus=$this->Model->getRequete("SELECT `MENU_ID`, `MENU_DESC`, `STATUT` FROM `menus` WHERE 1 AND STATUT=1");

		foreach ($profils as $key) {
			# code...
			$PROFILE_ID=$this->input->post('PROFILE_ID'.$key['PROFILE_ID']);

			echo "<pre>";
				print_r($PROFILE_ID);
				echo "</pre>";

			foreach ($menus as $value) {
				# code...
				// $MENU_ID=$this->input->post('MENU_ID'.$key['PROFILE_ID'].$key['MENU_ID']);

				
			}
		}
		die();
		
		echo json_encode(array('status'=>true));
	}

	function update()
	{
		$this->_validate();
		$PROFIL_ID=$this->input->post('PROFIL_ID');
		$DESCRIPTION=$this->input->post('DESCRIPTION');
		$DASHBOARD = (!empty($this->input->post('DASHBOARD'))) ? 1 : 0 ;
		$VENTE = (!empty($this->input->post('VENTE'))) ? 1 : 0 ;
		$ADMINISTRATION = (!empty($this->input->post('ADMINISTRATION'))) ? 1 : 0 ;
		$CAISSE = (!empty($this->input->post('CAISSE'))) ? 1 : 0 ;
		$STOCK = (!empty($this->input->post('STOCK'))) ? 1 : 0 ;
		$DONNEES = (!empty($this->input->post('DONNEES'))) ? 1 : 0 ;
		$OPTIONS = (!empty($this->input->post('OPTIONS'))) ? 1 : 0 ;
		$DASHBOARD_STOCK = (!empty($this->input->post('DASHBOARD_STOCK'))) ? 1 : 0 ;
		$DASHBOARD_DEPENSE = (!empty($this->input->post('DASHBOARD_DEPENSE'))) ? 1 : 0 ;
		$DASHBOARD_VENTE = (!empty($this->input->post('DASHBOARD_VENTE'))) ? 1 : 0 ;
		$FAMILLE = (!empty($this->input->post('FAMILLE'))) ? 1 : 0 ;
		$DEPENSE = (!empty($this->input->post('DEPENSE'))) ? 1 : 0 ;
		$SALAIRE = (!empty($this->input->post('SALAIRE'))) ? 1 : 0 ;
		$COMPTABILITE = (!empty($this->input->post('COMPTABILITE'))) ? 1 : 0 ;
		$PARAMETRAGE = (!empty($this->input->post('PARAMETRAGE'))) ? 1 : 0 ;
		$EMPLOYE = (!empty($this->input->post('EMPLOYE'))) ? 1 : 0 ;
		$SUPPRESSION = (!empty($this->input->post('SUPPRESSION'))) ? 1 : 0 ;
		$MODIFIER = (!empty($this->input->post('MODIFIER'))) ? 1 : 0 ;
		$APPROBATION = (!empty($this->input->post('APPROBATION'))) ? 1 : 0 ;
		$PRIX_STOCK = (!empty($this->input->post('PRIX_STOCK'))) ? 1 : 0 ;
		$FINANCE = (!empty($this->input->post('FINANCE'))) ? 1 : 0 ;
		$STOCK_GLOBAL = (!empty($this->input->post('STOCK_GLOBAL'))) ? 1 : 0 ;
		$VALIDATION_VENTE = (!empty($this->input->post('VALIDATION_VENTE'))) ? 1 : 0 ;
		$NOUVEAU =(!empty($this->input->post('NOUVEAU'))) ? 1 : 0 ;
		$NOTIFIER =(!empty($this->input->post('NOTIFIER'))) ? 1 : 0 ;

		$VIREMENT = (!empty($this->input->post('VIREMENT'))) ? 1 : 0 ;
		$PROFORMA = (!empty($this->input->post('PROFORMA'))) ? 1 : 0 ;
		$DECAISSEMENT = (!empty($this->input->post('DECAISSEMENT'))) ? 1 : 0 ;
		$ALIMENTER_STOCK = (!empty($this->input->post('ALIMENTER_STOCK'))) ? 1 : 0 ;
		$INVENTAIRE_STOCK = (!empty($this->input->post('INVENTAIRE_STOCK'))) ? 1 : 0 ;
		$ANNULER_BURINFO = (!empty($this->input->post('ANNULER_BURINFO'))) ? 1 : 0 ;
		$ANNULER_OBR = (!empty($this->input->post('ANNULER_OBR'))) ? 1 : 0 ;
		$VALIDATION_VENTE_APRES_UNE_JOURNEE = (!empty($this->input->post('VALIDATION_VENTE_APRES_UNE_JOURNEE'))) ? 1 : 0 ;
		$DEMANDE_ALIMENTATION_CAISSE = (!empty($this->input->post('DEMANDE_ALIMENTATION_CAISSE'))) ? 1 : 0 ;
		$VALIDE_VENTE = (!empty($this->input->post('VALIDE_VENTE'))) ? 1 : 0 ;
		$ENVOI_OBR = (!empty($this->input->post('ENVOI_OBR'))) ? 1 : 0 ;
		$FAIRE_FACTURE = (!empty($this->input->post('FAIRE_FACTURE'))) ? 1 : 0 ;
		$REFAIRE_FACTURE = (!empty($this->input->post('REFAIRE_FACTURE'))) ? 1 : 0 ;
		$SUPPRIMER_HISTORIQUE = (!empty($this->input->post('SUPPRIMER_HISTORIQUE'))) ? 1 : 0 ;
		$MODIFIER_STOCK = (!empty($this->input->post('MODIFIER_STOCK'))) ? 1 : 0 ;
		$AUTORISE_FAIRE_INVENTAIRE = (!empty($this->input->post('AUTORISE_FAIRE_INVENTAIRE'))) ? 1 : 0 ;







		

		$data_a=array('DESCRIPTION'=>$DESCRIPTION,'DASHBOARD'=>$DASHBOARD,'ANNULER_BURINFO'=>$ANNULER_BURINFO,'ANNULER_OBR'=>$ANNULER_OBR,'VALIDATION_VENTE_APRES_UNE_JOURNEE'=>$VALIDATION_VENTE_APRES_UNE_JOURNEE,'ALIMENTER_STOCK'=>$ALIMENTER_STOCK,'INVENTAIRE_STOCK'=>$INVENTAIRE_STOCK,'VENTE'=>$VENTE,'ADMINISTRATION'=>$ADMINISTRATION,'STOCK'=>$STOCK,'CAISSE'=>$CAISSE,'DONNEES'=>$DONNEES,'OPTIONS'=>$OPTIONS,'DASHBOARD_STOCK'=>$DASHBOARD_STOCK,'DASHBOARD_VENTE'=>$DASHBOARD_VENTE,'DASHBOARD_DEPENSE'=>$DASHBOARD_DEPENSE,'FAMILLE'=>$FAMILLE,'DEPENSE'=>$DEPENSE,'SALAIRE'=>$SALAIRE,'COMPTABILITE'=>$COMPTABILITE,'PARAMETRAGE'=>$PARAMETRAGE,'EMPLOYE'=>$EMPLOYE,'APPROBATION'=>$APPROBATION,'SUPPRESSION'=>$SUPPRESSION,'MODIFIER'=>$MODIFIER,'DASHBOARD'=>$DASHBOARD,'PRIX_STOCK'=>$PRIX_STOCK,'FINANCE'=>$FINANCE,'STOCK_GLOBAL'=>$STOCK_GLOBAL,'VALIDATION_VENTE'=>$VALIDATION_VENTE,'NOUVEAU'=>$NOUVEAU,'NOTIFIER'=>$NOTIFIER,'VIREMENT'=>$VIREMENT,'DEMANDE_ALIMENTATION_CAISSE'=>$DEMANDE_ALIMENTATION_CAISSE,'PROFORMA'=>$PROFORMA,'DECAISSEMENT'=>$DECAISSEMENT,'VALIDE_VENTE'=>$VALIDE_VENTE,'ENVOI_OBR'=>$ENVOI_OBR,'FAIRE_FACTURE'=>$FAIRE_FACTURE,'REFAIRE_FACTURE'=>$REFAIRE_FACTURE,'SUPPRIMER_HISTORIQUE'=>$SUPPRIMER_HISTORIQUE,'MODIFIER_STOCK'=>$MODIFIER_STOCK,'AUTORISE_FAIRE_INVENTAIRE'=>$AUTORISE_FAIRE_INVENTAIRE);
		// print_r($data_a);die();

		// print_r($data_a);die();

		$this->Model->update('admin_profil',array('PROFIL_ID'=>$PROFIL_ID),$data_a);
		echo json_encode(array('status'=>true));
	}

	function getOne($id)
	{
		$data=$this->Model->getOne('admin_profil',array('PROFIL_ID'=>$id));
		echo json_encode($data);
	}
	function del($id)
	{
		$this->Model->delete('admin_profil',array('PROFIL_ID'=>$id));
		echo json_encode(array('status'=>true));
	}

	function _validate()
	{
		$data=array();
		$data['inputerror']=array();
		$data['error_string']=array();
		$data['status']=true;

		if($this->input->post('DESCRIPTION')=="")
		{
			$data['inputerror'][]="DESCRIPTION";
			$data['error_string'][]="Le champs est obligatoire";
			$data['status']=false;
		}
		if ($data['status']==false) 
		{
			echo json_encode($data);
			exit();
		}
	}


	function liste()
	{
		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
		$query_principal="SELECT a.PROFIL_ID,a.DESCRIPTION,a.ADMINISTRATION,a.STOCK,a.VENTE,a.CAISSE,a.DASHBOARD,a.DONNEES,OPTIONS,DASHBOARD_STOCK,DASHBOARD_DEPENSE,DASHBOARD_VENTE,FAMILLE,DEPENSE,SALAIRE,COMPTABILITE,PARAMETRAGE,EMPLOYE,SUPPRESSION,MODIFIER,FINANCE,STOCK_GLOBAL,APPROBATION,PRIX_STOCK,INVENTAIRE_STOCK,ALIMENTER_STOCK,VALIDATION_VENTE,NOUVEAU,NOTIFIER,VIREMENT,PROFORMA,DECAISSEMENT FROM admin_profil a WHERE 1";

		$limit='LIMIT 0,10';
		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY a.DESCRIPTION   ASC';

		$search = !empty($_POST['search']['value']) ? (" AND  (DESCRIPTION LIKE '%$var_search$%') ") : '';
		$critaire ="";

		$query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter=$query_principal.'  '.$critaire.' '.$search;
		$fetch_data = $this->Model->datatable($query_secondaire); 
		$u=0; 
		$data = array();

		foreach ($fetch_data as $row) {

			$sub_array = array(); 
			
			$sub_array[] = $row->DESCRIPTION;
			$sub_array[] = ($row->DASHBOARD==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			$sub_array[] = ($row->STOCK==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			$sub_array[] = ($row->VENTE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			$sub_array[] = ($row->ADMINISTRATION==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->CAISSE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->DONNEES==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;

			// $sub_array[] = ($row->OPTIONS==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->DASHBOARD_STOCK==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->DASHBOARD_DEPENSE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->DASHBOARD_VENTE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->FAMILLE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->DEPENSE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->SALAIRE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->COMPTABILITE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->PARAMETRAGE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->EMPLOYE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->SUPPRESSION==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->MODIFIER==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->APPROBATION==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->PRIX_STOCK==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->FINANCE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->STOCK_GLOBAL==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->VALIDATION_VENTE==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->NOUVEAU==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->NOTIFIER==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->VIREMENT==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->PROFORMA==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;
			// $sub_array[] = ($row->DECAISSEMENT==1) ? '<center><span class="dripicons-checkmark"></span></center>' : '<center><span class=" dripicons-cross"></span></center>' ;

			$sub_array[]='<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Modifier" onclick="editer_profil('."'".$row->PROFIL_ID."'".')"><i class="dripicons-pencil"></i></a>';

			// <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Supprimer" onclick="del_p('."'".$row->PROFIL_ID."'".')"><i class="dripicons-trash"></i></a>
		


			


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

	
}