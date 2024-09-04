<?php 
/**
* @author NSHIMIRIMANA Révérien/+25768051821/rnshimirimana48@gmail.com
 ---gestion des roles---
*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");


 class Role_Menus extends CI_Controller
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
 		$data['page_title']="Rôles";
 		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
 		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
 		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
 		<li class="breadcrumb-item"><a href="#">Library</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Data</li>
 		</ol>
 		</nav>';
 		$data['profil']=$this->Model->getRequete("SELECT `PROFILE_ID`, `DESC_PROFIL` FROM `profil` WHERE 1 ORDER BY DESC_PROFIL ASC");
 		$menus=$this->Model->getRequete("SELECT `MENU_ID`, `MENU_DESC`, `STATUT` FROM `menus` WHERE 1 AND STATUT=1");
 		$data['nbre_menu']=sizeof($menus);
 		

 		$this->load->view('Role_Menus_view',$data);
 	}

 	function get_menu_profile()
 	{
 		$PROFILE_ID=$this->input->post('PROFILE_ID');
 		$menus=$this->Model->getRequete("SELECT `MENU_ID`, `MENU_DESC`, `STATUT` FROM `menus` WHERE 1 AND STATUT=1");



 		$html='<label>Menu</label>
 		<ul class="list-group" id="ulMenuRole">';
 		foreach ($menus as $menu) {
 			# code...
 			$menu_attributed=$this->Model->getOne('role_menu',array('PROFIL_ID'=>$PROFILE_ID,'MENU_ID'=>$menu['MENU_ID'],"IS_DELETED"=>1));

 			$already_exist = ($menu_attributed) ? "checked" : "";

 			$html.='<li class="list-group-item">
 			<input class="form-check-input me-1" '.$already_exist.' value="'.$menu['MENU_ID'].'" name="MENU_ID'.$menu['MENU_ID'].'" id="MENU_ID'.$menu['MENU_ID'].'" type="checkbox">
 			'.$menu['MENU_DESC'].'
 			</li>';
 		}
 		$html.='</ul><br>
 		<button class="btn btn-success" onclick="save_menu_role_selected()" type="button" id="btnSaveRole">Enregistrer</button> <button class="btn btn-danger" onclick="remove_menu_role_selected()" type="button" id="btnSaveRoleRemove">Supprimer</button>';

 		echo $html;
 	}


 	function save_menu_role_selected()
 	{

 		// $this->_validate_role();

 		$PROFILE_ID=$this->input->post('PROFILE_ID');
 		$MENU_ID=$this->input->post('MENU_ID');

 		$rol_menu=explode(',', $MENU_ID);

 		for ($i=0; $i <=count($rol_menu)-1 ; $i++) { 
 		# save role menu
 			$menu_attributed_exist=$this->Model->getOne('role_menu',array('PROFIL_ID'=>$PROFILE_ID,'MENU_ID'=>$rol_menu[$i],'IS_DELETED'=>0));

 			if ($menu_attributed_exist) {
 				# code...
 				$this->Model->update('role_menu',array('MENU_ID'=>$rol_menu[$i],'PROFIL_ID'=>$PROFILE_ID,'IS_DELETED'=>0),array('IS_DELETED'=>1));
 			}else{

 			$get_role_menu=$this->Model->getOne('role_menu',array('PROFIL_ID'=>$PROFILE_ID,'MENU_ID'=>$rol_menu[$i],'IS_DELETED'=>1));
 			if (empty($get_role_menu)) {
 				# code...
 				$this->Model->create('role_menu',array('PROFIL_ID'=>$PROFILE_ID,'MENU_ID'=>$rol_menu[$i]));
 			}

 			}

 			
 		// echo "<pre>";
 		// print_r($menu_attributed_exist);
 		// echo "</pre>";

 		}
 		// die();
 		echo json_encode(array('status'=>true,'message'=>"Une opération a été faite avec succès."));
 	}


 	function remove_menu_role_selected()
 	{

 		// $this->_validate_role();

 		$PROFILE_ID=$this->input->post('PROFILE_ID');
 		$MENU_ID=$this->input->post('MENU_ID');

 		$rol_menu=explode(',', $MENU_ID);

 		for ($i=0; $i <=count($rol_menu)-1 ; $i++) { 
 		# update status
 		$this->Model->update('role_menu',array('MENU_ID'=>$rol_menu[$i],'PROFIL_ID'=>$PROFILE_ID,'IS_DELETED'=>1),array('IS_DELETED'=>0));
 		}
 		// die();
 		echo json_encode(array('status'=>true,'message'=>"Une opération a été faite avec succès."));
 	}


 }