<?php 
/**
* @author NSHIMIRIMANA Révérien/+25768051821/rnshimirimana48@gmail.com
 ---gestion des roles---
*/
 ini_set('max_execution_time', '0');
 ini_set('memory_limit','-1');
 date_default_timezone_set("africa/Bujumbura");


 class Roles_Utilisateurs extends CI_Controller
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

 	function index($EMPLOYE_ID)
 	{
 		$data['page_title']="Rôles-Utilisateur";
 		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
 		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
 		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
 		<li class="breadcrumb-item"><a href="#">Library</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Data</li>
 		</ol>
 		</nav>';
 		
 		$data['data_emp']=$this->Model->getRequeteOne("SELECT `EMPLOYE_ID`,e.PROFILE_ID, CONCAT(NOM_EMP,' ',PRENOM_EMP)IDENTIFICATION,CONCAT(a.AGENCE_NOM,'/',d.DESC_DEPARTEMENT)AFFECTATION,p.DESC_PROFIL, `MATRICULE`, `DATE_CREATION`, `IS_ACTIF`,IS_USER_SYSTEM FROM employes e JOIN agences a ON a.AGENCE_ID=e.AGENCE_ID JOIN departement d ON d.DEPARTEMENT_ID=e.DEPARTEMENT_ID JOIN profil p ON p.PROFILE_ID=e.PROFILE_ID  WHERE 1  AND EMPLOYE_ID=".$EMPLOYE_ID);


 		// print_r($data['data_emp']);die();

 		$data['menu_profile']=$this->Model->getRequete("SELECT r.ROLE_MENU_ID,m.MENU_DESC,r.MENU_ID FROM role_menu r  LEFT JOIN menus m ON m.MENU_ID=r.MENU_ID WHERE r.IS_DELETED=1 AND r.PROFIL_ID=".$data['data_emp']['PROFILE_ID']);

 		$data['profil']=$this->Model->getRequete("SELECT `PROFILE_ID`, `DESC_PROFIL` FROM `profil` WHERE 1 ORDER BY DESC_PROFIL ASC");

 		
 		

 		$this->load->view('Roles_Utilisateurs_view',$data);
 	}

 	function get_sous_menu_profile()
 	{
 		$MENU_ID=$this->input->post('MENU_ID');
 		$PROFIL_ID=$this->input->post('PROFIL_ID');
 		$USER_ID=$this->input->post('USER_ID');

 		$sous_menus=$this->Model->getRequete("SELECT `SOUS_MENU_ID`, `SOUS_MENU_DESC`, `MENU_ID`, `IS_DELETE` FROM `sous_menu_menu_rel` WHERE 1 AND IS_DELETE=1 AND MENU_ID=".$MENU_ID);


 		$html='<label>Responsabilités</label>
 		<ul class="list-group" id="ulRoleUser">';
 		foreach ($sous_menus as $sm) {
 			# code...
 		
 		$auth=$this->Model->getOne('menu_users',array('PROFIL_ID'=>$PROFIL_ID,'USER_ID'=>$USER_ID));


 		$selecte_checkbox="";

 		if ($sm['SOUS_MENU_ID']==1) {
 			# TB
 			$selecte_checkbox=($auth['TB_ST_PRINCIPAL']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==2) {
 			# code...
 		
 		$selecte_checkbox=($auth['TB_DISTRIBU']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==3) {
 			
 		 $selecte_checkbox=($auth['TB_CONSOMMATION_ENCOURS_PRINCIPAL']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==4) {
 			# code...
 		$selecte_checkbox=($auth['TB_CONSOMMATION_ENCOURS_AGENCE']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==5) {
 			# code...
 		$selecte_checkbox=($auth['TB_AGENCE']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==6) {
 			# code...
 		$selecte_checkbox=($auth['TB_EXPORT_RAPPORT_GLO']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==7) {
 		 # STOCK
 			$selecte_checkbox=($auth['TB_EXPORT_RAPPORT_AGENCE']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==8) {
 		 # 

 			$selecte_checkbox=($auth['TB_EXPORT_RAPPORT_DISTRIBUTION']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==9) {
 		 # 
 			$selecte_checkbox=($auth['TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==10) {
 		 # 
 			$selecte_checkbox=($auth['TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==11) {
 		 
 			$selecte_checkbox=($auth['DEMANDE_STOCK_DEMANDEUR']==1)? "checked":"";

 		}
 		elseif ($sm['SOUS_MENU_ID']==12) {
 		 # STOCK
 			$selecte_checkbox=($auth['LIST_STOCK_AGENCE']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==13) {
 		 # 
 			$selecte_checkbox=($auth['DEMANDE_STOCK_VERIFICATEUR']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==14) {
 		 # 

 			$selecte_checkbox=($auth['DEMANDE_STOCK_APPROBATEUR']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==15) {
 		 # 
 			$selecte_checkbox=($auth['STOCK_DEMANDE_ACCUSER_RECEPTION']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==16) {
 		 # STRUCTRURES
 			$selecte_checkbox=($auth['LIST_STOCK_PRINCIPAL']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==17) {
 		 # 
 			$selecte_checkbox=($auth['DEMANDE_STOCK_CONSULTATION']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==18) {
 		 # PARAMETRAGES
 			$selecte_checkbox=($auth['APPROV_CREATEUR']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==19) {
 		 # 

 			$selecte_checkbox=($auth['APPROV_VALIDEUR']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==20) {
 		 # 
 			$selecte_checkbox=($auth['APPROV_CONSULTATION']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==21) {
 		 # 

 			$selecte_checkbox=($auth['DISTR_CREATION']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==22) {
 		 # 
 			$selecte_checkbox=($auth['DISTR_VALIDEUR']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==23) {
 		 # 
 			$selecte_checkbox=($auth['DISTR_CONSULTATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==24) {
 			# code...
 			$selecte_checkbox=($auth['PROD_CREATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==25) {
 			# code...
 			$selecte_checkbox=($auth['PROD_VALIDEUR']==1)? "checked":"";
 		}
 		elseif ($sm['SOUS_MENU_ID']==26) {
 			# code...
 			$selecte_checkbox=($auth['CAT_CREATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==27) {
 			# code...
 			$selecte_checkbox=($auth['PROD_CONSULTATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==28) {
 			# code...
 			$selecte_checkbox=($auth['UNITE_CREATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==29) {
 			# code...
 			$selecte_checkbox=($auth['UNITE_VALIDEUR']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==30) {
 		 # 
 			$selecte_checkbox=($auth['UNITE_CONSULTATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==31) {
 			# code...
 			$selecte_checkbox=($auth['CAT_VALIDEUR']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==32) {
 			# code...
 			$selecte_checkbox=($auth['CAT_CONSULTATION']==1)? "checked":"";
 		}
 		elseif ($sm['SOUS_MENU_ID']==33) {
 			# code...
 			$selecte_checkbox=($auth['UNITE_PAR_QTE_CREATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==34) {
 			# code...
 			$selecte_checkbox=($auth['UNITE_PAR_QTE_VALIDEUR']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==35) {
 			# code...
 			$selecte_checkbox=($auth['UNITE_PAR_QTE_CONSULTATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==36) {
 			# code...
 			$selecte_checkbox=($auth['FOURN_CREATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==37) {
 			# code...
 			$selecte_checkbox=($auth['FOURN_CONSULTATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==38) {
 			# code...
 			$selecte_checkbox=($auth['FOURN_VALIDEUR']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==39) {
 			# code...
 			$selecte_checkbox=($auth['EMPLOYE_VALIDEUR']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==40) {
 			# code...
 			$selecte_checkbox=($auth['EMPLOYE_CONSULTATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==41) {
 			# code...
 			$selecte_checkbox=($auth['EMPLOYE_PROFIL']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==42) {
 			# code...
 			$selecte_checkbox=($auth['EMPLOYE_CREATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==43) {
 			# code...
 			$selecte_checkbox=($auth['STR_AGENCE_VALIDEUR']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==44) {
 			# code...
 			$selecte_checkbox=($auth['STR_AGENCE_CONSULTATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==45) {
 			# code...
 			$selecte_checkbox=($auth['STR_AGENCE_CREATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==46) {
 			# code...
 			$selecte_checkbox=($auth['STR_DEPARTEMENT_CREATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==47) {
 			# code...
 			$selecte_checkbox=($auth['STR_DEPARTEMENT_VALIDEUR']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==48) {
 			# code...
 			$selecte_checkbox=($auth['STR_DEPARTEMENT_CONSULTATION']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==49) {
 			# code...
 			$selecte_checkbox=($auth['PARAM_PARAMETRAGE']==1)? "checked":"";
 		}elseif ($sm['SOUS_MENU_ID']==50) {
 			# code...
 			$selecte_checkbox=($auth['RETOUR_DECLASSEMENT_AGENCE']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==51) {
 			# code...
 			$selecte_checkbox=($auth['DECLASSEMENT_LOGISTIQUE']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==52) {
 			# code...
 			$selecte_checkbox=($auth['CONSULTATION_LOGISTIQUE']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==53) {
 			# code...
 			$selecte_checkbox=($auth['CONSULTATION_AGENCE']==1)? "checked":"";

 		}elseif ($sm['SOUS_MENU_ID']==54) {
 			# code...
 			$selecte_checkbox=($auth['FORM_INVENTAIRE']==1)? "checked":"";
 		}
 		
 	


 		$html.='<li class="list-group-item">
 			<input class="form-check-input me-1"  value="'.$sm['SOUS_MENU_ID'].'" name="SOUS_MENU_ID'.$sm['SOUS_MENU_ID'].'" id="SOUS_MENU_ID'.$sm['SOUS_MENU_ID'].'" '.$selecte_checkbox.' type="checkbox">
 			'.$sm['SOUS_MENU_DESC'].'
 			</li>';
 		}
 		$html.='</ul><br>
 		<button class="btn btn-success" onclick="save_user_role_selected()" type="button" id="btnSaveRole">Valider</button> <button class="btn btn-danger" onclick="remove_user_role_selected()" type="button" id="btnSaveRoleRemove" onclick="remove_user_role_selected()">Retirer</button>';

 		echo $html;
 	}


 	function save_user_role_selected()
 	{

 		

 		$PROFIL_ID=$this->input->post('PROFIL_ID');
 		$USER_ID=$this->input->post('USER_ID');
 		$SOUS_MENU_ID=$this->input->post('SOUS_MENU_ID');

 		$rol_sous_menu=explode(',', $SOUS_MENU_ID);


 		#TB
 		$TB_ST_PRINCIPAL=0;
 		$TB_DISTRIBU=0;
 		$TB_CONSOMMATION_ENCOURS_PRINCIPAL=0;
 		$TB_CONSOMMATION_ENCOURS_AGENCE=0;
 		$TB_AGENCE=0;
 		$TB_EXPORT_RAPPORT_GLO=0;
 		$TB_EXPORT_RAPPORT_AGENCE=0;
 		$TB_EXPORT_RAPPORT_DISTRIBUTION=0;
 		$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL=0;
 		$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE=0;
 		#STOCK
 		$DEMANDE_STOCK_DEMANDEUR=0;
 		$LIST_STOCK_AGENCE=0;
 		$DEMANDE_STOCK_VERIFICATEUR=0;
 		$DEMANDE_STOCK_APPROBATEUR=0;
 		$STOCK_DEMANDE_ACCUSER_RECEPTION=0;
 		$LIST_STOCK_PRINCIPAL=0;
 		$DEMANDE_STOCK_CONSULTATION=0;
 		#APPROVISIONNEMENT
 		$APPROV_CREATEUR=0;
 		$APPROV_VALIDEUR=0;
 		$APPROV_CONSULTATION=0;
 		#DISTRIBUTION
 		$DISTR_CREATION=0;
 		$DISTR_VALIDEUR=0;
 		$DISTR_CONSULTATION=0;
 		#PRODUITS
 		$PROD_CREATION=0;
 		$PROD_VALIDEUR=0;
 		$CAT_CREATION=0;
 		$PROD_CONSULTATION=0;
 		$UNITE_CREATION=0;
 		$UNITE_VALIDEUR=0;
 		$UNITE_CONSULTATION=0;
 		$CAT_VALIDEUR=0;
 		$CAT_CREATION=0;
 		$CAT_CONSULTATION=0;
 		$UNITE_PAR_QTE_CREATION=0;
 		$UNITE_PAR_QTE_VALIDEUR=0;
 		$UNITE_PAR_QTE_CONSULTATION=0;
 		$FOURN_CREATION=0;
 		$FOURN_VALIDEUR=0;
 		$FOURN_CONSULTATION=0;
 		$EMPLOYE_VALIDEUR=0;
 		$EMPLOYE_CONSULTATION=0;
 		$EMPLOYE_PROFIL=0;
 		$EMPLOYE_CREATION=0;
 		$STR_AGENCE_VALIDEUR=0;
 		$STR_AGENCE_CONSULTATION=0;
 		$STR_AGENCE_CREATION=0;
 		$STR_DEPARTEMENT_CREATION=0;
 		$STR_DEPARTEMENT_VALIDEUR=0;
 		$STR_DEPARTEMENT_CONSULTATION=0;
 		$PARAM_PARAMETRAGE=0;

 		$RETOUR_DECLASSEMENT_AGENCE=0;
 		$DECLASSEMENT_LOGISTIQUE=0;
 		$CONSULTATION_LOGISTIQUE=0;
 		$CONSULTATION_AGENCE=0;
 		$FORM_INVENTAIRE=0;



 		for ($i=0; $i <=count($rol_sous_menu)-1 ; $i++) { 
 		# save role menu

 			
 		// echo "<pre>";
 		// print_r($rol_sous_menu[$i]);
 		// echo "</pre>";

 		if ($rol_sous_menu[$i]==1) {
 			# TB
 		$TB_ST_PRINCIPAL=1;
 		}elseif ($rol_sous_menu[$i]==2) {
 			# code...
 		$TB_DISTRIBU=1;
 		}elseif ($rol_sous_menu[$i]==3) {
 			# code...
 		$TB_CONSOMMATION_ENCOURS_PRINCIPAL=1;
 		}elseif ($rol_sous_menu[$i]==4) {
 			# code...
 		$TB_CONSOMMATION_ENCOURS_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==5) {
 			# code...
 		$TB_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==6) {
 		 # 
 			$TB_EXPORT_RAPPORT_GLO=1;
 		}elseif ($rol_sous_menu[$i]==7) {
 		 # 
 			$TB_EXPORT_RAPPORT_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==8) {
 		 # 
 			$TB_EXPORT_RAPPORT_DISTRIBUTION=1;
 		}elseif ($rol_sous_menu[$i]==9) {
 		 
 			$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL=1;
 		}elseif ($rol_sous_menu[$i]==10) {
 		 # 
 			$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==11) {
 		 # STOCK ET DEMANDE
 			$DEMANDE_STOCK_DEMANDEUR=1;
 		}elseif ($rol_sous_menu[$i]==12) {
 		 # 
 			$LIST_STOCK_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==13) {
 		 
 			$DEMANDE_STOCK_VERIFICATEUR=1;
 		}elseif ($rol_sous_menu[$i]==14) {
 		 
 			$DEMANDE_STOCK_APPROBATEUR=1;
 		}elseif ($rol_sous_menu[$i]==15) {
 		 
 			$STOCK_DEMANDE_ACCUSER_RECEPTION=1;
 		}elseif ($rol_sous_menu[$i]==16) {
 		 
 			$LIST_STOCK_PRINCIPAL=1;
 		}elseif ($rol_sous_menu[$i]==17) {
 		 # 
 			$DEMANDE_STOCK_CONSULTATION=1;
 		}
 		elseif ($rol_sous_menu[$i]==18) {
 		 # APPROVISIONNEMENT
 			$APPROV_CREATEUR=1;
 		}elseif ($rol_sous_menu[$i]==19) {
 		 # 
 			$APPROV_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==20) {
 		 # 
 			$APPROV_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==21) {
 		 # DISTRIBUTION
 			$DISTR_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==22) {
 			# code...
 			$DISTR_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==23) {
 			# code...
 			$DISTR_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==24) {
 			# PRODUIT - UNITE -CATEGORIE - UNITE PAR QTE
 			$PROD_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==25) {
 			# code...
 			$PROD_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==26) {
 			# code
 			$CAT_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==27) {
 			# code...
 			$PROD_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==28) {
 			# code...
 			$UNITE_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==29) {
 			# code...
 			$UNITE_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==30) {
 			# code...
 			$UNITE_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==31) {
 			# code...
 			$CAT_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==32) {
 			# code...
 			$CAT_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==33) {
 			# code...
 			$UNITE_PAR_QTE_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==34) {
 			# code...
 			$UNITE_PAR_QTE_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==35) {
 			# code...
 			$UNITE_PAR_QTE_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==36) {
 			# FOURNISSEUR
 			$FOURN_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==37) {
 			# code...
 			$FOURN_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==38) {
 			# code...
 			$FOURN_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==39) {
 			# EMPLOYE
 			$EMPLOYE_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==40) {
 			# code...
 			$EMPLOYE_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==41) {
 			# code...
 			$EMPLOYE_PROFIL=1;
 		}elseif ($rol_sous_menu[$i]==42) {
 			# code...
 			$EMPLOYE_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==43) {
 			# AGENCE
 			$STR_AGENCE_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==44) {
 			# code...
 			$STR_AGENCE_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==45) {
 			# code...
 			$STR_AGENCE_CREATION=1;

 		}elseif ($rol_sous_menu[$i]==46) {
 			# UNITE D'ORGANISATION
 			$STR_DEPARTEMENT_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==47) {
 			# code...
 			$STR_DEPARTEMENT_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==48) {
 			# code...
 			$STR_DEPARTEMENT_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==49) {
 			# code...
 			$PARAM_PARAMETRAGE=1;
 		}elseif ($rol_sous_menu[$i]==50) {
 			# code...
 			$RETOUR_DECLASSEMENT_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==51) {
 			# code...
 			$DECLASSEMENT_LOGISTIQUE=1;
 		}elseif ($rol_sous_menu[$i]==52) {
 			# code...
 			$CONSULTATION_LOGISTIQUE=1;
 		}elseif ($rol_sous_menu[$i]==53) {
 			# code...
 			$CONSULTATION_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==54) {
 			# code...
 			$FORM_INVENTAIRE=1;
 		}




 		}
 		// die();

 		$data=array('PROFIL_ID'=>$PROFIL_ID,'USER_ID'=>$USER_ID,'TB_ST_PRINCIPAL'=>$TB_ST_PRINCIPAL, 'TB_DISTRIBU'=>$TB_DISTRIBU, 'TB_CONSOMMATION_ENCOURS_PRINCIPAL'=>$TB_CONSOMMATION_ENCOURS_PRINCIPAL, 'TB_CONSOMMATION_ENCOURS_AGENCE'=>$TB_CONSOMMATION_ENCOURS_AGENCE, 'TB_AGENCE'=>$TB_AGENCE, 'TB_EXPORT_RAPPORT_GLO'=>$TB_EXPORT_RAPPORT_GLO, 'TB_EXPORT_RAPPORT_AGENCE'=>$TB_EXPORT_RAPPORT_AGENCE, 'TB_EXPORT_RAPPORT_DISTRIBUTION'=>$TB_EXPORT_RAPPORT_DISTRIBUTION, 'TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL'=>$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL, 'TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE'=>$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE, 'LIST_STOCK_AGENCE'=>$LIST_STOCK_AGENCE, 'DEMANDE_STOCK_VERIFICATEUR'=>$DEMANDE_STOCK_VERIFICATEUR, 'DEMANDE_STOCK_APPROBATEUR'=>$DEMANDE_STOCK_APPROBATEUR, 'DEMANDE_STOCK_DEMANDEUR'=>$DEMANDE_STOCK_DEMANDEUR, 'STOCK_DEMANDE_ACCUSER_RECEPTION'=>$STOCK_DEMANDE_ACCUSER_RECEPTION, 'LIST_STOCK_PRINCIPAL'=>$LIST_STOCK_PRINCIPAL, 'DEMANDE_STOCK_CONSULTATION'=>$DEMANDE_STOCK_CONSULTATION, 'APPROV_CREATEUR'=>$APPROV_CREATEUR, 'APPROV_VALIDEUR'=>$APPROV_VALIDEUR, 'APPROV_CONSULTATION'=>$APPROV_CONSULTATION, 'DISTR_CREATION'=>$DISTR_CREATION, 'DISTR_VALIDEUR'=>$DISTR_VALIDEUR, 'DISTR_CONSULTATION'=>$DISTR_CONSULTATION, 'PROD_CREATION'=>$PROD_CREATION, 'PROD_VALIDEUR'=>$PROD_VALIDEUR, 'PROD_CONSULTATION'=>$PROD_CONSULTATION, 'UNITE_CREATION'=>$UNITE_CREATION, 'UNITE_VALIDEUR'=>$UNITE_VALIDEUR, 'UNITE_CONSULTATION'=>$UNITE_CONSULTATION, 'CAT_CREATION'=>$CAT_CREATION, 'CAT_VALIDEUR'=>$CAT_VALIDEUR, 'CAT_CONSULTATION'=>$CAT_CONSULTATION, 'UNITE_PAR_QTE_CREATION'=>$UNITE_PAR_QTE_CREATION, 'UNITE_PAR_QTE_VALIDEUR'=>$UNITE_PAR_QTE_VALIDEUR, 'UNITE_PAR_QTE_CONSULTATION'=>$UNITE_PAR_QTE_CONSULTATION, 'FOURN_CREATION'=>$FOURN_CREATION, 'FOURN_VALIDEUR'=>$FOURN_VALIDEUR, 'FOURN_CONSULTATION'=>$FOURN_CONSULTATION, 'EMPLOYE_CREATION'=>$EMPLOYE_CREATION, 'EMPLOYE_PROFIL'=>$EMPLOYE_PROFIL, 'EMPLOYE_VALIDEUR'=>$EMPLOYE_VALIDEUR, 'EMPLOYE_CONSULTATION'=>$EMPLOYE_CONSULTATION, 'STR_AGENCE_CREATION'=>$STR_AGENCE_CREATION, 'STR_AGENCE_VALIDEUR'=>$STR_AGENCE_VALIDEUR, 'STR_AGENCE_CONSULTATION'=>$STR_AGENCE_CONSULTATION, 'STR_DEPARTEMENT_CREATION'=>$STR_DEPARTEMENT_CREATION, 'STR_DEPARTEMENT_VALIDEUR'=>$STR_DEPARTEMENT_VALIDEUR, 'STR_DEPARTEMENT_CONSULTATION'=>$STR_DEPARTEMENT_CONSULTATION, 'PARAM_PARAMETRAGE'=>$PARAM_PARAMETRAGE,'RETOUR_DECLASSEMENT_AGENCE'=>$RETOUR_DECLASSEMENT_AGENCE,'DECLASSEMENT_LOGISTIQUE'=>$DECLASSEMENT_LOGISTIQUE,'CONSULTATION_LOGISTIQUE'=>$CONSULTATION_LOGISTIQUE,'CONSULTATION_AGENCE'=>$CONSULTATION_AGENCE,'FORM_INVENTAIRE'=>$FORM_INVENTAIRE);



 		

 		$check_user_exist=$this->Model->getOne('menu_users',array('PROFIL_ID'=>$PROFIL_ID,"USER_ID"=>$USER_ID));

 		// print_r($STOCK_STOCK);
 		// die();


 		if ($check_user_exist) {
 			# code...

 			$TB_ST_PRINCIPAL = ($check_user_exist['TB_ST_PRINCIPAL']>0) ? $check_user_exist['TB_ST_PRINCIPAL'] : $TB_ST_PRINCIPAL;
 			$TB_DISTRIBU = ($check_user_exist['TB_DISTRIBU']>0) ? $check_user_exist['TB_DISTRIBU'] : $TB_DISTRIBU;
 			$TB_CONSOMMATION_ENCOURS_PRINCIPAL = ($check_user_exist['TB_CONSOMMATION_ENCOURS_PRINCIPAL']>0) ? $check_user_exist['TB_CONSOMMATION_ENCOURS_PRINCIPAL'] : $TB_CONSOMMATION_ENCOURS_PRINCIPAL;
 			$TB_CONSOMMATION_ENCOURS_AGENCE = ($check_user_exist['TB_CONSOMMATION_ENCOURS_AGENCE']>0) ? $check_user_exist['TB_CONSOMMATION_ENCOURS_AGENCE'] : $TB_CONSOMMATION_ENCOURS_AGENCE;
 			$TB_AGENCE = ($check_user_exist['TB_AGENCE']>0) ? $check_user_exist['TB_AGENCE'] : $TB_AGENCE;
 			$TB_EXPORT_RAPPORT_GLO = ($check_user_exist['TB_EXPORT_RAPPORT_GLO']>0) ? $check_user_exist['TB_EXPORT_RAPPORT_GLO'] : $TB_EXPORT_RAPPORT_GLO;
 			$TB_EXPORT_RAPPORT_AGENCE = ($check_user_exist['TB_EXPORT_RAPPORT_AGENCE']>0) ? $check_user_exist['TB_EXPORT_RAPPORT_AGENCE'] : $TB_EXPORT_RAPPORT_AGENCE;
 			$TB_EXPORT_RAPPORT_DISTRIBUTION = ($check_user_exist['TB_EXPORT_RAPPORT_DISTRIBUTION']>0) ? $check_user_exist['TB_EXPORT_RAPPORT_DISTRIBUTION'] : $TB_EXPORT_RAPPORT_DISTRIBUTION;
 			$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL = ($check_user_exist['TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL']>0) ? $check_user_exist['TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL'] : $TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL;
 			$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE = ($check_user_exist['TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE']>0) ? $check_user_exist['TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE'] : $TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE;


 			$LIST_STOCK_AGENCE = ($check_user_exist['LIST_STOCK_AGENCE']>0) ? $check_user_exist['LIST_STOCK_AGENCE'] : $LIST_STOCK_AGENCE;
 			$DEMANDE_STOCK_VERIFICATEUR = ($check_user_exist['DEMANDE_STOCK_VERIFICATEUR']>0) ? $check_user_exist['DEMANDE_STOCK_VERIFICATEUR'] : $DEMANDE_STOCK_VERIFICATEUR;
 			$DEMANDE_STOCK_APPROBATEUR = ($check_user_exist['DEMANDE_STOCK_APPROBATEUR']>0) ? $check_user_exist['DEMANDE_STOCK_APPROBATEUR'] : $DEMANDE_STOCK_APPROBATEUR;
 			$STOCK_DEMANDE_ACCUSER_RECEPTION = ($check_user_exist['STOCK_DEMANDE_ACCUSER_RECEPTION']>0) ? $check_user_exist['STOCK_DEMANDE_ACCUSER_RECEPTION'] : $STOCK_DEMANDE_ACCUSER_RECEPTION;
 			$LIST_STOCK_PRINCIPAL = ($check_user_exist['LIST_STOCK_PRINCIPAL']>0) ? $check_user_exist['LIST_STOCK_PRINCIPAL'] : $LIST_STOCK_PRINCIPAL;
 			$DEMANDE_STOCK_CONSULTATION = ($check_user_exist['DEMANDE_STOCK_CONSULTATION']>0) ? $check_user_exist['DEMANDE_STOCK_CONSULTATION'] : $DEMANDE_STOCK_CONSULTATION;

 			$APPROV_CREATEUR = ($check_user_exist['APPROV_CREATEUR']>0) ? $check_user_exist['APPROV_CREATEUR'] : $APPROV_CREATEUR;
 			$APPROV_VALIDEUR = ($check_user_exist['APPROV_VALIDEUR']>0) ? $check_user_exist['APPROV_VALIDEUR'] : $APPROV_VALIDEUR;
 			$APPROV_CONSULTATION = ($check_user_exist['APPROV_CONSULTATION']>0) ? $check_user_exist['APPROV_CONSULTATION'] : $APPROV_CONSULTATION;
 			$DISTR_CREATION = ($check_user_exist['DISTR_CREATION']>0) ? $check_user_exist['DISTR_CREATION'] : $DISTR_CREATION;
 			$DISTR_VALIDEUR = ($check_user_exist['DISTR_VALIDEUR']>0) ? $check_user_exist['DISTR_VALIDEUR'] : $DISTR_VALIDEUR;
 			$DISTR_CONSULTATION = ($check_user_exist['DISTR_CONSULTATION']>0) ? $check_user_exist['DISTR_CONSULTATION'] : $DISTR_CONSULTATION;
 			$PROD_CREATION = ($check_user_exist['PROD_CREATION']>0) ? $check_user_exist['PROD_CREATION'] : $PROD_CREATION;
 			$PROD_VALIDEUR = ($check_user_exist['PROD_VALIDEUR']>0) ? $check_user_exist['PROD_VALIDEUR'] : $PROD_VALIDEUR;
 			$PROD_CONSULTATION = ($check_user_exist['PROD_CONSULTATION']>0) ? $check_user_exist['PROD_CONSULTATION'] : $PROD_CONSULTATION;
 			$UNITE_CREATION = ($check_user_exist['UNITE_CREATION']>0) ? $check_user_exist['UNITE_CREATION'] : $UNITE_CREATION;

 			$UNITE_VALIDEUR = ($check_user_exist['UNITE_VALIDEUR']>0) ? $check_user_exist['UNITE_VALIDEUR'] : $UNITE_VALIDEUR;
 			$UNITE_CONSULTATION = ($check_user_exist['UNITE_CONSULTATION']>0) ? $check_user_exist['UNITE_CONSULTATION'] : $UNITE_CONSULTATION;
 			$CAT_CREATION = ($check_user_exist['CAT_CREATION']>0) ? $check_user_exist['CAT_CREATION'] : $CAT_CREATION;
 			$CAT_VALIDEUR = ($check_user_exist['CAT_VALIDEUR']>0) ? $check_user_exist['CAT_VALIDEUR'] : $CAT_VALIDEUR;
 			$CAT_CONSULTATION = ($check_user_exist['CAT_CONSULTATION']>0) ? $check_user_exist['CAT_CONSULTATION'] : $CAT_CONSULTATION;
 			$UNITE_PAR_QTE_CREATION = ($check_user_exist['UNITE_PAR_QTE_CREATION']>0) ? $check_user_exist['UNITE_PAR_QTE_CREATION'] : $UNITE_PAR_QTE_CREATION;

 			$UNITE_PAR_QTE_VALIDEUR = ($check_user_exist['UNITE_PAR_QTE_VALIDEUR']>0) ? $check_user_exist['UNITE_PAR_QTE_VALIDEUR'] : $UNITE_PAR_QTE_VALIDEUR;
 			$UNITE_PAR_QTE_CONSULTATION = ($check_user_exist['UNITE_PAR_QTE_CONSULTATION']>0) ? $check_user_exist['UNITE_PAR_QTE_CONSULTATION'] : $UNITE_PAR_QTE_CONSULTATION;
 			$FOURN_CREATION = ($check_user_exist['FOURN_CREATION']>0) ? $check_user_exist['FOURN_CREATION'] : $FOURN_CREATION;
 			$FOURN_VALIDEUR = ($check_user_exist['FOURN_VALIDEUR']>0) ? $check_user_exist['FOURN_VALIDEUR'] : $FOURN_VALIDEUR;
 			$FOURN_CONSULTATION = ($check_user_exist['FOURN_CONSULTATION']>0) ? $check_user_exist['FOURN_CONSULTATION'] : $FOURN_CONSULTATION;
 			$EMPLOYE_CREATION = ($check_user_exist['EMPLOYE_CREATION']>0) ? $check_user_exist['EMPLOYE_CREATION'] : $EMPLOYE_CREATION;
 			$EMPLOYE_PROFIL = ($check_user_exist['EMPLOYE_PROFIL']>0) ? $check_user_exist['EMPLOYE_PROFIL'] : $EMPLOYE_PROFIL;
 			$EMPLOYE_VALIDEUR = ($check_user_exist['EMPLOYE_VALIDEUR']>0) ? $check_user_exist['EMPLOYE_VALIDEUR'] : $EMPLOYE_VALIDEUR;

 			$EMPLOYE_CONSULTATION = ($check_user_exist['EMPLOYE_CONSULTATION']>0) ? $check_user_exist['EMPLOYE_CONSULTATION'] : $EMPLOYE_CONSULTATION;
 			$STR_AGENCE_CREATION = ($check_user_exist['STR_AGENCE_CREATION']>0) ? $check_user_exist['STR_AGENCE_CREATION'] : $STR_AGENCE_CREATION;
 			$STR_AGENCE_VALIDEUR = ($check_user_exist['STR_AGENCE_VALIDEUR']>0) ? $check_user_exist['STR_AGENCE_VALIDEUR'] : $STR_AGENCE_VALIDEUR;

 			$STR_AGENCE_CONSULTATION = ($check_user_exist['STR_AGENCE_CONSULTATION']>0) ? $check_user_exist['STR_AGENCE_CONSULTATION'] : $STR_AGENCE_CONSULTATION;
 			$STR_DEPARTEMENT_CREATION = ($check_user_exist['STR_DEPARTEMENT_CREATION']>0) ? $check_user_exist['STR_DEPARTEMENT_CREATION'] : $STR_DEPARTEMENT_CREATION;
 			$STR_DEPARTEMENT_VALIDEUR = ($check_user_exist['STR_DEPARTEMENT_VALIDEUR']>0) ? $check_user_exist['STR_DEPARTEMENT_VALIDEUR'] : $STR_DEPARTEMENT_VALIDEUR;
 			$STR_DEPARTEMENT_CONSULTATION = ($check_user_exist['STR_DEPARTEMENT_CONSULTATION']>0) ? $check_user_exist['STR_DEPARTEMENT_CONSULTATION'] : $STR_DEPARTEMENT_CONSULTATION;
 			$PARAM_PARAMETRAGE = ($check_user_exist['PARAM_PARAMETRAGE']>0) ? $check_user_exist['PARAM_PARAMETRAGE'] : $PARAM_PARAMETRAGE;

 			$RETOUR_DECLASSEMENT_AGENCE = ($check_user_exist['RETOUR_DECLASSEMENT_AGENCE']>0) ? $check_user_exist['RETOUR_DECLASSEMENT_AGENCE'] : $RETOUR_DECLASSEMENT_AGENCE;
 			$DECLASSEMENT_LOGISTIQUE = ($check_user_exist['DECLASSEMENT_LOGISTIQUE']>0) ? $check_user_exist['DECLASSEMENT_LOGISTIQUE'] : $DECLASSEMENT_LOGISTIQUE;
 			$CONSULTATION_LOGISTIQUE = ($check_user_exist['CONSULTATION_LOGISTIQUE']>0) ? $check_user_exist['CONSULTATION_LOGISTIQUE'] : $CONSULTATION_LOGISTIQUE;
 			$CONSULTATION_AGENCE = ($check_user_exist['CONSULTATION_AGENCE']>0) ? $check_user_exist['CONSULTATION_AGENCE'] : $CONSULTATION_AGENCE;
 			$FORM_INVENTAIRE = ($check_user_exist['FORM_INVENTAIRE']>0) ? $check_user_exist['FORM_INVENTAIRE'] : $FORM_INVENTAIRE;

 		// 	print_r($STOCK_STOCK);
 		// die();


 			$data_update=array('TB_ST_PRINCIPAL'=>$TB_ST_PRINCIPAL, 'TB_DISTRIBU'=>$TB_DISTRIBU, 'TB_CONSOMMATION_ENCOURS_PRINCIPAL'=>$TB_CONSOMMATION_ENCOURS_PRINCIPAL, 'TB_CONSOMMATION_ENCOURS_AGENCE'=>$TB_CONSOMMATION_ENCOURS_AGENCE, 'TB_AGENCE'=>$TB_AGENCE, 'TB_EXPORT_RAPPORT_GLO'=>$TB_EXPORT_RAPPORT_GLO, 'TB_EXPORT_RAPPORT_AGENCE'=>$TB_EXPORT_RAPPORT_AGENCE, 'TB_EXPORT_RAPPORT_DISTRIBUTION'=>$TB_EXPORT_RAPPORT_DISTRIBUTION, 'TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL'=>$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL, 'TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE'=>$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE, 'LIST_STOCK_AGENCE'=>$LIST_STOCK_AGENCE, 'DEMANDE_STOCK_VERIFICATEUR'=>$DEMANDE_STOCK_VERIFICATEUR, 'DEMANDE_STOCK_APPROBATEUR'=>$DEMANDE_STOCK_APPROBATEUR, 'DEMANDE_STOCK_DEMANDEUR'=>$DEMANDE_STOCK_DEMANDEUR, 'STOCK_DEMANDE_ACCUSER_RECEPTION'=>$STOCK_DEMANDE_ACCUSER_RECEPTION, 'LIST_STOCK_PRINCIPAL'=>$LIST_STOCK_PRINCIPAL, 'DEMANDE_STOCK_CONSULTATION'=>$DEMANDE_STOCK_CONSULTATION, 'APPROV_CREATEUR'=>$APPROV_CREATEUR, 'APPROV_VALIDEUR'=>$APPROV_VALIDEUR, 'APPROV_CONSULTATION'=>$APPROV_CONSULTATION, 'DISTR_CREATION'=>$DISTR_CREATION, 'DISTR_VALIDEUR'=>$DISTR_VALIDEUR, 'DISTR_CONSULTATION'=>$DISTR_CONSULTATION, 'PROD_CREATION'=>$PROD_CREATION, 'PROD_VALIDEUR'=>$PROD_VALIDEUR, 'PROD_CONSULTATION'=>$PROD_CONSULTATION, 'UNITE_CREATION'=>$UNITE_CREATION, 'UNITE_VALIDEUR'=>$UNITE_VALIDEUR, 'UNITE_CONSULTATION'=>$UNITE_CONSULTATION, 'CAT_CREATION'=>$CAT_CREATION, 'CAT_VALIDEUR'=>$CAT_VALIDEUR, 'CAT_CONSULTATION'=>$CAT_CONSULTATION, 'UNITE_PAR_QTE_CREATION'=>$UNITE_PAR_QTE_CREATION, 'UNITE_PAR_QTE_VALIDEUR'=>$UNITE_PAR_QTE_VALIDEUR, 'UNITE_PAR_QTE_CONSULTATION'=>$UNITE_PAR_QTE_CONSULTATION, 'FOURN_CREATION'=>$FOURN_CREATION, 'FOURN_VALIDEUR'=>$FOURN_VALIDEUR, 'FOURN_CONSULTATION'=>$FOURN_CONSULTATION, 'EMPLOYE_CREATION'=>$EMPLOYE_CREATION, 'EMPLOYE_PROFIL'=>$EMPLOYE_PROFIL, 'EMPLOYE_VALIDEUR'=>$EMPLOYE_VALIDEUR, 'EMPLOYE_CONSULTATION'=>$EMPLOYE_CONSULTATION, 'STR_AGENCE_CREATION'=>$STR_AGENCE_CREATION, 'STR_AGENCE_VALIDEUR'=>$STR_AGENCE_VALIDEUR, 'STR_AGENCE_CONSULTATION'=>$STR_AGENCE_CONSULTATION, 'STR_DEPARTEMENT_CREATION'=>$STR_DEPARTEMENT_CREATION, 'STR_DEPARTEMENT_VALIDEUR'=>$STR_DEPARTEMENT_VALIDEUR, 'STR_DEPARTEMENT_CONSULTATION'=>$STR_DEPARTEMENT_CONSULTATION, 'PARAM_PARAMETRAGE'=>$PARAM_PARAMETRAGE,'RETOUR_DECLASSEMENT_AGENCE'=>$RETOUR_DECLASSEMENT_AGENCE,'DECLASSEMENT_LOGISTIQUE'=>$DECLASSEMENT_LOGISTIQUE,'CONSULTATION_LOGISTIQUE'=>$CONSULTATION_LOGISTIQUE,'CONSULTATION_AGENCE'=>$CONSULTATION_AGENCE,'FORM_INVENTAIRE'=>$FORM_INVENTAIRE);

 			// print_r($data_update);die();

 			$this->Model->update('menu_users',array('MENU_USER_ID'=>$check_user_exist['MENU_USER_ID']),$data_update);

 		}else{

 			$this->Model->create('menu_users',$data);
 		}

 		echo json_encode(array('status'=>true,'message'=>"Une opération a été faite avec succès."));
 	}


 	function remove_user_role_selected()
 	{


 		$PROFIL_ID=$this->input->post('PROFIL_ID');
 		$USER_ID=$this->input->post('USER_ID');
 		$SOUS_MENU_ID=$this->input->post('SOUS_MENU_ID');

 		$rol_sous_menu=explode(',', $SOUS_MENU_ID);

 		#TB
 		$TB_ST_PRINCIPAL=0;
 		$TB_DISTRIBU=0;
 		$TB_CONSOMMATION_ENCOURS_PRINCIPAL=0;
 		$TB_CONSOMMATION_ENCOURS_AGENCE=0;
 		$TB_AGENCE=0;
 		$TB_EXPORT_RAPPORT_GLO=0;
 		$TB_EXPORT_RAPPORT_AGENCE=0;
 		$TB_EXPORT_RAPPORT_DISTRIBUTION=0;
 		$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL=0;
 		$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE=0;
 		#STOCK
 		$DEMANDE_STOCK_DEMANDEUR=0;
 		$LIST_STOCK_AGENCE=0;
 		$DEMANDE_STOCK_VERIFICATEUR=0;
 		$DEMANDE_STOCK_APPROBATEUR=0;
 		$STOCK_DEMANDE_ACCUSER_RECEPTION=0;
 		$LIST_STOCK_PRINCIPAL=0;
 		$DEMANDE_STOCK_CONSULTATION=0;
 		#APPROVISIONNEMENT
 		$APPROV_CREATEUR=0;
 		$APPROV_VALIDEUR=0;
 		$APPROV_CONSULTATION=0;
 		#DISTRIBUTION
 		$DISTR_CREATION=0;
 		$DISTR_VALIDEUR=0;
 		$DISTR_CONSULTATION=0;
 		#PRODUITS
 		$PROD_CREATION=0;
 		$PROD_VALIDEUR=0;
 		$CAT_CREATION=0;
 		$PROD_CONSULTATION=0;
 		$UNITE_CREATION=0;
 		$UNITE_VALIDEUR=0;
 		$UNITE_CONSULTATION=0;
 		$CAT_VALIDEUR=0;
 		$CAT_CREATION=0;
 		$CAT_CONSULTATION=0;
 		$UNITE_PAR_QTE_CREATION=0;
 		$UNITE_PAR_QTE_VALIDEUR=0;
 		$UNITE_PAR_QTE_CONSULTATION=0;
 		$FOURN_CREATION=0;
 		$FOURN_VALIDEUR=0;
 		$FOURN_CONSULTATION=0;
 		$EMPLOYE_VALIDEUR=0;
 		$EMPLOYE_CONSULTATION=0;
 		$EMPLOYE_PROFIL=0;
 		$EMPLOYE_CREATION=0;
 		$STR_AGENCE_VALIDEUR=0;
 		$STR_AGENCE_CONSULTATION=0;
 		$STR_AGENCE_CREATION=0;
 		$STR_DEPARTEMENT_CREATION=0;
 		$STR_DEPARTEMENT_VALIDEUR=0;
 		$STR_DEPARTEMENT_CONSULTATION=0;
 		$PARAM_PARAMETRAGE=0;
 		$RETOUR_DECLASSEMENT_AGENCE=0;
 		$DECLASSEMENT_LOGISTIQUE=0;
 		$CONSULTATION_LOGISTIQUE=0;
 		$CONSULTATION_AGENCE=0;
 		$FORM_INVENTAIRE=0;

 		for ($i=0; $i <=count($rol_sous_menu)-1 ; $i++) { 
 		# save role menu

 			
 		if ($rol_sous_menu[$i]==1) {
 			# TB
 		$TB_ST_PRINCIPAL=1;
 		}elseif ($rol_sous_menu[$i]==2) {
 			# code...
 		$TB_DISTRIBU=1;
 		}elseif ($rol_sous_menu[$i]==3) {
 			# code...
 		$TB_CONSOMMATION_ENCOURS_PRINCIPAL=1;
 		}elseif ($rol_sous_menu[$i]==4) {
 			# code...
 		$TB_CONSOMMATION_ENCOURS_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==5) {
 			# code...
 		$TB_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==6) {
 		 # 
 			$TB_EXPORT_RAPPORT_GLO=1;
 		}elseif ($rol_sous_menu[$i]==7) {
 		 # 
 			$TB_EXPORT_RAPPORT_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==8) {
 		 # 
 			$TB_EXPORT_RAPPORT_DISTRIBUTION=1;
 		}elseif ($rol_sous_menu[$i]==9) {
 		 
 			$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL=1;
 		}elseif ($rol_sous_menu[$i]==10) {
 		 # 
 			$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==11) {
 		 # STOCK ET DEMANDE
 			$DEMANDE_STOCK_DEMANDEUR=1;
 		}elseif ($rol_sous_menu[$i]==12) {
 		 # 
 			$LIST_STOCK_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==13) {
 		 
 			$DEMANDE_STOCK_VERIFICATEUR=1;
 		}elseif ($rol_sous_menu[$i]==14) {
 		 
 			$DEMANDE_STOCK_APPROBATEUR=1;
 		}elseif ($rol_sous_menu[$i]==15) {
 		 
 			$STOCK_DEMANDE_ACCUSER_RECEPTION=1;
 		}elseif ($rol_sous_menu[$i]==16) {
 		 
 			$LIST_STOCK_PRINCIPAL=1;
 		}elseif ($rol_sous_menu[$i]==17) {
 		 # 
 			$DEMANDE_STOCK_CONSULTATION=1;
 		}
 		elseif ($rol_sous_menu[$i]==18) {
 		 # APPROVISIONNEMENT
 			$APPROV_CREATEUR=1;
 		}elseif ($rol_sous_menu[$i]==19) {
 		 # 
 			$APPROV_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==20) {
 		 # 
 			$APPROV_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==21) {
 		 # DISTRIBUTION
 			$DISTR_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==22) {
 			# code...
 			$DISTR_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==23) {
 			# code...
 			$DISTR_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==24) {
 			# PRODUIT - UNITE -CATEGORIE - UNITE PAR QTE
 			$PROD_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==25) {
 			# code...
 			$PROD_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==26) {
 			# code
 			$CAT_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==27) {
 			# code...
 			$PROD_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==28) {
 			# code...
 			$UNITE_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==29) {
 			# code...
 			$UNITE_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==30) {
 			# code...
 			$UNITE_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==31) {
 			# code...
 			$CAT_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==32) {
 			# code...
 			$CAT_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==33) {
 			# code...
 			$UNITE_PAR_QTE_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==34) {
 			# code...
 			$UNITE_PAR_QTE_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==35) {
 			# code...
 			$UNITE_PAR_QTE_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==36) {
 			# FOURNISSEUR
 			$FOURN_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==37) {
 			# code...
 			$FOURN_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==38) {
 			# code...
 			$FOURN_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==39) {
 			# EMPLOYE
 			$EMPLOYE_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==40) {
 			# code...
 			$EMPLOYE_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==41) {
 			# code...
 			$EMPLOYE_PROFIL=1;
 		}elseif ($rol_sous_menu[$i]==42) {
 			# code...
 			$EMPLOYE_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==43) {
 			# AGENCE
 			$STR_AGENCE_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==44) {
 			# code...
 			$STR_AGENCE_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==45) {
 			# code...
 			$STR_AGENCE_CREATION=1;

 		}elseif ($rol_sous_menu[$i]==46) {
 			# UNITE D'ORGANISATION
 			$STR_DEPARTEMENT_CREATION=1;
 		}elseif ($rol_sous_menu[$i]==47) {
 			# code...
 			$STR_DEPARTEMENT_VALIDEUR=1;
 		}elseif ($rol_sous_menu[$i]==48) {
 			# code...
 			$STR_DEPARTEMENT_CONSULTATION=1;
 		}elseif ($rol_sous_menu[$i]==49) {
 			# code...
 			$PARAM_PARAMETRAGE=1;
 		}elseif ($rol_sous_menu[$i]==50) {
 			# code...
 			$RETOUR_DECLASSEMENT_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==51) {
 			# code...
 			$DECLASSEMENT_LOGISTIQUE=1;
 		}elseif ($rol_sous_menu[$i]==52) {
 			# code...
 			$CONSULTATION_LOGISTIQUE=1;
 		}elseif ($rol_sous_menu[$i]==53) {
 			# code...
 			$CONSULTATION_AGENCE=1;
 		}elseif ($rol_sous_menu[$i]==54) {
 			# code...
 			$FORM_INVENTAIRE=1;
 		}




 		}

 		// die();




 		$check_user_exist=$this->Model->getOne('menu_users',array('PROFIL_ID'=>$PROFIL_ID,"USER_ID"=>$USER_ID));

 		if ($check_user_exist) {


 			$TB_ST_PRINCIPAL = ($TB_ST_PRINCIPAL>0) ? 0 : $check_user_exist['TB_ST_PRINCIPAL'];
 			$TB_DISTRIBU = ($TB_DISTRIBU>0) ? 0 : $check_user_exist['TB_DISTRIBU'];
 			$TB_CONSOMMATION_ENCOURS_PRINCIPAL = ($TB_CONSOMMATION_ENCOURS_PRINCIPAL>0) ? 0 : $TB_CONSOMMATION_ENCOURS_PRINCIPAL;
 			$TB_CONSOMMATION_ENCOURS_AGENCE = ($TB_CONSOMMATION_ENCOURS_AGENCE>0) ? 0 : $TB_CONSOMMATION_ENCOURS_AGENCE;
 			$TB_AGENCE = ($TB_AGENCE>0) ? 0 : $TB_AGENCE;
 			$TB_EXPORT_RAPPORT_GLO = ($TB_EXPORT_RAPPORT_GLO>0) ? $check_user_exist['TB_EXPORT_RAPPORT_GLO'] : $TB_EXPORT_RAPPORT_GLO;
 			$TB_EXPORT_RAPPORT_AGENCE = ($TB_EXPORT_RAPPORT_AGENCE>0) ? $check_user_exist['TB_EXPORT_RAPPORT_AGENCE'] : $TB_EXPORT_RAPPORT_AGENCE;
 			$TB_EXPORT_RAPPORT_DISTRIBUTION = ($TB_EXPORT_RAPPORT_DISTRIBUTION>0) ? 0 : $check_user_exist['TB_EXPORT_RAPPORT_DISTRIBUTION'];
 			$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL = ($TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL>0) ? 0 : $check_user_exist['TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL'];
 			$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE = ($TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE>0) ? 0 : $check_user_exist['TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE'];
 			$LIST_STOCK_AGENCE = ($LIST_STOCK_AGENCE>0) ? 0 : $check_user_exist['LIST_STOCK_AGENCE'];
 			$DEMANDE_STOCK_VERIFICATEUR = ($DEMANDE_STOCK_VERIFICATEUR>0) ? 0 : $check_user_exist['DEMANDE_STOCK_VERIFICATEUR'];
 			$DEMANDE_STOCK_DEMANDEUR = ($DEMANDE_STOCK_DEMANDEUR>0) ? 0 : $check_user_exist['DEMANDE_STOCK_DEMANDEUR'];
 			$DEMANDE_STOCK_APPROBATEUR = ($DEMANDE_STOCK_APPROBATEUR>0) ? 0 : $check_user_exist['DEMANDE_STOCK_APPROBATEUR'];
 			$STOCK_DEMANDE_ACCUSER_RECEPTION = ($STOCK_DEMANDE_ACCUSER_RECEPTION>0) ? 0 : $check_user_exist['STOCK_DEMANDE_ACCUSER_RECEPTION'];
 			$LIST_STOCK_PRINCIPAL = ($LIST_STOCK_PRINCIPAL>0) ? 0 : $check_user_exist['LIST_STOCK_PRINCIPAL'];
 			$DEMANDE_STOCK_CONSULTATION = ($DEMANDE_STOCK_CONSULTATION>0) ? 0 : $check_user_exist['DEMANDE_STOCK_CONSULTATION'];
 			$APPROV_CREATEUR = ($APPROV_CREATEUR>0) ? 0 : $check_user_exist['APPROV_CREATEUR'];
 			$APPROV_VALIDEUR = ($APPROV_VALIDEUR>0) ? 0 : $check_user_exist['APPROV_VALIDEUR'];
 			$APPROV_CONSULTATION = ($APPROV_CONSULTATION>0) ? 0 : $check_user_exist['APPROV_CONSULTATION'];
 			$DISTR_CREATION = ($DISTR_CREATION>0) ? 0 : $check_user_exist['DISTR_CREATION'];
 			$DISTR_VALIDEUR = ($DISTR_VALIDEUR>0) ? 0 : $check_user_exist['DISTR_VALIDEUR'];
 			$DISTR_CONSULTATION = ($DISTR_CONSULTATION>0) ? 0 : $check_user_exist['DISTR_CONSULTATION'];
 			$PROD_CREATION = ($PROD_CREATION>0) ? 0 : $check_user_exist['PROD_CREATION'];
 			$PROD_VALIDEUR = ($PROD_VALIDEUR>0) ? 0 : $check_user_exist['PROD_VALIDEUR'];
 			$PROD_CONSULTATION = ($PROD_CONSULTATION>0) ? 0 : $check_user_exist['PROD_CONSULTATION'];
 			$UNITE_CREATION = ($UNITE_CREATION>0) ? 0 : $check_user_exist['UNITE_CREATION'];
 			$UNITE_VALIDEUR = ($UNITE_VALIDEUR>0) ? 0 : $check_user_exist['UNITE_VALIDEUR'];
 			$UNITE_CONSULTATION = ($UNITE_CONSULTATION>0) ? 0 : $check_user_exist['UNITE_CONSULTATION'];
 			$CAT_CREATION = ($CAT_CREATION>0) ? 0 : $check_user_exist['CAT_CREATION'];
 			$CAT_VALIDEUR = ($CAT_VALIDEUR>0) ? 0 : $check_user_exist['CAT_VALIDEUR'];
 			$CAT_CONSULTATION = ($CAT_CONSULTATION>0) ? 0 : $check_user_exist['CAT_CONSULTATION'];
 			$UNITE_PAR_QTE_CREATION = ($UNITE_PAR_QTE_CREATION>0) ? 0 : $check_user_exist['UNITE_PAR_QTE_CREATION'];
 			$UNITE_PAR_QTE_VALIDEUR = ($UNITE_PAR_QTE_VALIDEUR>0) ? 0 : $check_user_exist['UNITE_PAR_QTE_VALIDEUR'];
 			$UNITE_PAR_QTE_CONSULTATION = ($UNITE_PAR_QTE_CONSULTATION>0) ? 0 : $check_user_exist['UNITE_PAR_QTE_CONSULTATION'];
 			$FOURN_CREATION = ($FOURN_CREATION>0) ? 0 : $check_user_exist['FOURN_CREATION'];
 			$FOURN_VALIDEUR = ($FOURN_VALIDEUR>0) ? 0 : $check_user_exist['FOURN_VALIDEUR'];
 			$FOURN_CONSULTATION = ($FOURN_CONSULTATION>0) ?0 : $check_user_exist['FOURN_CONSULTATION'];
 			$EMPLOYE_CREATION = ($EMPLOYE_CREATION>0) ? 0 : $check_user_exist['EMPLOYE_CREATION'];
 			$EMPLOYE_PROFIL = ($EMPLOYE_PROFIL>0) ? 0 : $check_user_exist['EMPLOYE_PROFIL'];
 			$EMPLOYE_VALIDEUR = ($EMPLOYE_VALIDEUR>0) ? 0 : $check_user_exist['EMPLOYE_VALIDEUR'];
 			$EMPLOYE_CONSULTATION = ($EMPLOYE_CONSULTATION>0) ? 0 : $check_user_exist['EMPLOYE_CONSULTATION'];
 			$STR_AGENCE_CREATION = ($STR_AGENCE_CREATION>0) ? 0 : $check_user_exist['STR_AGENCE_CREATION'];
 			$STR_AGENCE_VALIDEUR = ($STR_AGENCE_VALIDEUR>0) ? 0 : $check_user_exist['STR_AGENCE_VALIDEUR'];
 			$STR_AGENCE_CONSULTATION = ($STR_AGENCE_CONSULTATION>0) ? 0 : $check_user_exist['STR_AGENCE_CONSULTATION'];
 			$STR_DEPARTEMENT_CREATION = ($STR_DEPARTEMENT_CREATION>0) ? 0 : $check_user_exist['STR_DEPARTEMENT_CREATION'];
 			$STR_DEPARTEMENT_VALIDEUR = ($STR_DEPARTEMENT_VALIDEUR>0) ? 0 : $check_user_exist['STR_DEPARTEMENT_VALIDEUR'];
 			$STR_DEPARTEMENT_CONSULTATION = ($STR_DEPARTEMENT_CONSULTATION>0) ? 0 : $check_user_exist['STR_DEPARTEMENT_CONSULTATION'];
 			$PARAM_PARAMETRAGE = ($PARAM_PARAMETRAGE>0) ? 0 : $check_user_exist['PARAM_PARAMETRAGE'];

 			$RETOUR_DECLASSEMENT_AGENCE = ($RETOUR_DECLASSEMENT_AGENCE>0) ? 0 : $check_user_exist['RETOUR_DECLASSEMENT_AGENCE'];
 			$DECLASSEMENT_LOGISTIQUE = ($DECLASSEMENT_LOGISTIQUE>0) ? 0 : $check_user_exist['DECLASSEMENT_LOGISTIQUE'];
 			$CONSULTATION_LOGISTIQUE = ($CONSULTATION_LOGISTIQUE>0) ? 0 : $check_user_exist['CONSULTATION_LOGISTIQUE'];
 			$CONSULTATION_AGENCE = ($CONSULTATION_AGENCE>0) ? 0 : $check_user_exist['CONSULTATION_AGENCE'];
 			$FORM_INVENTAIRE = ($FORM_INVENTAIRE>0) ? 0 : $check_user_exist['FORM_INVENTAIRE'];






 			$data_update=array('TB_ST_PRINCIPAL'=>$TB_ST_PRINCIPAL, 'TB_DISTRIBU'=>$TB_DISTRIBU, 'TB_CONSOMMATION_ENCOURS_PRINCIPAL'=>$TB_CONSOMMATION_ENCOURS_PRINCIPAL, 'TB_CONSOMMATION_ENCOURS_AGENCE'=>$TB_CONSOMMATION_ENCOURS_AGENCE, 'TB_AGENCE'=>$TB_AGENCE, 'TB_EXPORT_RAPPORT_GLO'=>$TB_EXPORT_RAPPORT_GLO, 'TB_EXPORT_RAPPORT_AGENCE'=>$TB_EXPORT_RAPPORT_AGENCE, 'TB_EXPORT_RAPPORT_DISTRIBUTION'=>$TB_EXPORT_RAPPORT_DISTRIBUTION, 'TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL'=>$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL, 'TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE'=>$TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE, 'LIST_STOCK_AGENCE'=>$LIST_STOCK_AGENCE, 'DEMANDE_STOCK_VERIFICATEUR'=>$DEMANDE_STOCK_VERIFICATEUR, 'DEMANDE_STOCK_APPROBATEUR'=>$DEMANDE_STOCK_APPROBATEUR, 'DEMANDE_STOCK_DEMANDEUR'=>$DEMANDE_STOCK_DEMANDEUR, 'STOCK_DEMANDE_ACCUSER_RECEPTION'=>$STOCK_DEMANDE_ACCUSER_RECEPTION, 'LIST_STOCK_PRINCIPAL'=>$LIST_STOCK_PRINCIPAL, 'DEMANDE_STOCK_CONSULTATION'=>$DEMANDE_STOCK_CONSULTATION, 'APPROV_CREATEUR'=>$APPROV_CREATEUR, 'APPROV_VALIDEUR'=>$APPROV_VALIDEUR, 'APPROV_CONSULTATION'=>$APPROV_CONSULTATION, 'DISTR_CREATION'=>$DISTR_CREATION, 'DISTR_VALIDEUR'=>$DISTR_VALIDEUR, 'DISTR_CONSULTATION'=>$DISTR_CONSULTATION, 'PROD_CREATION'=>$PROD_CREATION, 'PROD_VALIDEUR'=>$PROD_VALIDEUR, 'PROD_CONSULTATION'=>$PROD_CONSULTATION, 'UNITE_CREATION'=>$UNITE_CREATION, 'UNITE_VALIDEUR'=>$UNITE_VALIDEUR, 'UNITE_CONSULTATION'=>$UNITE_CONSULTATION, 'CAT_CREATION'=>$CAT_CREATION, 'CAT_VALIDEUR'=>$CAT_VALIDEUR, 'CAT_CONSULTATION'=>$CAT_CONSULTATION, 'UNITE_PAR_QTE_CREATION'=>$UNITE_PAR_QTE_CREATION, 'UNITE_PAR_QTE_VALIDEUR'=>$UNITE_PAR_QTE_VALIDEUR, 'UNITE_PAR_QTE_CONSULTATION'=>$UNITE_PAR_QTE_CONSULTATION, 'FOURN_CREATION'=>$FOURN_CREATION, 'FOURN_VALIDEUR'=>$FOURN_VALIDEUR, 'FOURN_CONSULTATION'=>$FOURN_CONSULTATION, 'EMPLOYE_CREATION'=>$EMPLOYE_CREATION, 'EMPLOYE_PROFIL'=>$EMPLOYE_PROFIL, 'EMPLOYE_VALIDEUR'=>$EMPLOYE_VALIDEUR, 'EMPLOYE_CONSULTATION'=>$EMPLOYE_CONSULTATION, 'STR_AGENCE_CREATION'=>$STR_AGENCE_CREATION, 'STR_AGENCE_VALIDEUR'=>$STR_AGENCE_VALIDEUR, 'STR_AGENCE_CONSULTATION'=>$STR_AGENCE_CONSULTATION, 'STR_DEPARTEMENT_CREATION'=>$STR_DEPARTEMENT_CREATION, 'STR_DEPARTEMENT_VALIDEUR'=>$STR_DEPARTEMENT_VALIDEUR, 'STR_DEPARTEMENT_CONSULTATION'=>$STR_DEPARTEMENT_CONSULTATION, 'PARAM_PARAMETRAGE'=>$PARAM_PARAMETRAGE,'RETOUR_DECLASSEMENT_AGENCE'=>$RETOUR_DECLASSEMENT_AGENCE,'DECLASSEMENT_LOGISTIQUE'=>$DECLASSEMENT_LOGISTIQUE,'CONSULTATION_LOGISTIQUE'=>$CONSULTATION_LOGISTIQUE,'CONSULTATION_AGENCE'=>$CONSULTATION_AGENCE,'FORM_INVENTAIRE'=>$FORM_INVENTAIRE);

 			// print_r($data_update);die();

 			$this->Model->update('menu_users',array('MENU_USER_ID'=>$check_user_exist['MENU_USER_ID']),$data_update);

 		}


 		if ($check_user_exist) {
 			# code...
 			echo json_encode(array('status'=>true,'message'=>"Une opération a été faite avec succès."));
 		}else{
 			echo json_encode(array('status'=>false,'message'=>"Le rôle d'utilisateur n'existe pas dorénavant."));
 		}



 		
 	}


 	function sychroniser_pwd($EMPLOYE_ID)
 	{
 		
 		$emp=$this->Model->getOne('employes',array('EMPLOYE_ID'=>$EMPLOYE_ID));

 		$this->Model->update('employes',array('EMPLOYE_ID'=>$EMPLOYE_ID),array('MOT_DE_PASSE'=>md5(trim($emp['MATRICULE'])),'IS_MUST_CHANGE_PWD'=>1));

 		$this->Model->create('sychronisation_pwd',array('EMPLOYE_ID'=>$EMPLOYE_ID,'USER_ID'=>$this->session->userdata('EMPLOYE_ID'),'DATE_SYNCHONISER'=>date('Y-m-d H:i:s')));

 		redirect(base_url('administration/Roles_Utilisateurs/index/'.$EMPLOYE_ID));




 	}


 	function appliquer_save_change_user()
 	{
 		$this->_validate_appliquer_save_change_user();

 		$PROFILE_ID=$this->input->post('PROFILE_ID');
 		$EMPLOYE_ID=$this->input->post('EMPLOYE_ID');
 		$IS_USER_SYSTEM=$this->input->post('IS_USER_SYSTEM');
 		$IS_ACTIF=$this->input->post('IS_ACTIF');
 		$MATRICULE=$this->input->post('MATRICULE');

 		$chck_change=$this->Model->getOne('employes',array('EMPLOYE_ID'=>$EMPLOYE_ID));

 		// print_r($chck_change['PROFILE_ID'].'/'.$PROFILE_ID);die();

 		$data=array('PROFILE_ID'=>$PROFILE_ID,
 					'IS_USER_SYSTEM'=>$IS_USER_SYSTEM,
 					'IS_ACTIF'=>$IS_ACTIF
 				  );

 		if (($chck_change['IS_USER_SYSTEM']!=$IS_USER_SYSTEM) && $IS_USER_SYSTEM!=0) {
 			# sychroniser le mot de passe
 			$this->Model->update('employes',array('EMPLOYE_ID'=>$EMPLOYE_ID),array('MOT_DE_PASSE'=>md5(trim($MATRICULE)),'IS_MUST_CHANGE_PWD'=>1));
 		}

 		if ($IS_USER_SYSTEM==0 && $PROFILE_ID!=1) {
 			# désactiver l'utilisateur sur la plateforme
 			$this->Model->update('menu_users',array('USER_ID'=>$EMPLOYE_ID),array('IS_DELETE'=>1));
 		}elseif ($IS_USER_SYSTEM==1 && $PROFILE_ID!=1) {
 			# activation de l'utilisateur sur la plateforme...
 			$this->Model->update('menu_users',array('USER_ID'=>$EMPLOYE_ID),array('IS_DELETE'=>0));
 		}

 		if (($chck_change['PROFILE_ID']!=$PROFILE_ID) || ($chck_change['IS_USER_SYSTEM']!=$IS_USER_SYSTEM) || ($chck_change['IS_ACTIF']!=$IS_ACTIF)) {
 			# code...

 			$this->Model->update('employes',array('EMPLOYE_ID'=>$EMPLOYE_ID),$data);
 			$this->Model->update('menu_users',array('USER_ID'=>$EMPLOYE_ID),array('PROFIL_ID'=>$PROFILE_ID));

 		    echo json_encode(array('status'=>true,'indicator'=>1,'message'=>"Votre modification a été enregistrée"));

 		}else{

 		  echo json_encode(array('status'=>true,'indicator'=>0,'message'=>"Aucune modification appliquée"));
 		}


 	}


 	function _validate_appliquer_save_change_user()
 	{
 		$data=array();
 		$data['error_string']=array();
 		$data['inputerror']=array();
 		$data['status']=true;

 		

 		if ($this->input->post('PROFILE_ID')=="") 
 		{

 			$data['error_string'][]="Le champs est obligatoire";
 			$data['inputerror'][]="PROFILE_ID";
 			$data['status']=false;
 		}

 		if ($this->input->post('IS_USER_SYSTEM')==1) {
 			# code...

 			if ($this->input->post('PROFILE_ID')==1) {
 				# code...
 				$data['error_string'][]="Ce profil ne doit pas être un utilisateur du système";
 				$data['inputerror'][]="PROFILE_ID";
 				$data['status']=false;
 			}


 		}


 		if ($data['status']==FALSE) 
 		{
			# code...
 			echo json_encode($data);
 			exit();
 		}
 	}


 	

 }

 ?>