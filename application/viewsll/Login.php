<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  public function __construct()
  {
    parent::__construct();

  }

  public function index()
  {
    // $data['logo']=$this->Model->getRequeteOne('SELECT `LOGO_DESC` FROM logo WHERE TYPE_LOGO=1 LIMIT 1');
    $data['logo']="";
    $this->load->view('Login_view',$data);

  }



  public function check_login(){
    $this->_validate();
    $matricule = trim($this->input->post('matricule'));
    $pwd =  trim(md5($this->input->post('pwd')));
    
    $auth=array();

    $get=$this->Model->getRequeteOne("SELECT
      em.EMPLOYE_ID,
      CONCAT(em.NOM_EMP, ' ', em.PRENOM_EMP) EMPLOYE,
      em.OU_DEP_ID,
      em.PROFILE_ID,
      em.IS_USER_SYSTEM,
      em.MATRICULE,
      em.MOT_DE_PASSE,
      em.DATE_CREATION,
      ou.DEP_DESC,
      p.DESC_PROFIL,
      em.IS_MUST_CHANGE_PWD
      FROM
      employes em
      LEFT JOIN ou_departement ou  ON
      ou.OU_DEP_ID = em.OU_DEP_ID
      LEFT JOIN profil p ON
      p.PROFILE_ID = em.PROFILE_ID
      WHERE 
      em.MATRICULE='".$matricule."'
      AND em.IS_ACTIF = 1 
      AND em.IS_USER_SYSTEM = 1");


    $output = null;
    if (!empty($get)) {

      $get=$this->Model->getRequeteOne("SELECT
      em.EMPLOYE_ID,
      CONCAT(em.NOM_EMP, ' ', em.PRENOM_EMP) EMPLOYE,
      em.OU_DEP_ID,
      em.PROFILE_ID,
      em.IS_USER_SYSTEM,
      em.MATRICULE,
      em.MOT_DE_PASSE,
      em.DATE_CREATION,
      ou.DEP_DESC,
      p.DESC_PROFIL,
      em.IS_MUST_CHANGE_PWD
      FROM
      employes em
      LEFT JOIN ou_departement ou  ON
      ou.OU_DEP_ID = em.OU_DEP_ID
      LEFT JOIN profil p ON
      p.PROFILE_ID = em.PROFILE_ID
      WHERE 
      em.MATRICULE='".$matricule."'
      AND em.MOT_DE_PASSE='".trim($pwd)."'
      AND em.IS_ACTIF = 1 
      AND em.IS_USER_SYSTEM = 1");
      
     


      if (!empty($get)) {
        $sess_data =array();
        
        // if (!empty($this->Model->getOne('menu_users',array('USER_ID'=>$get['EMPLOYE_ID'])))) {
          # code...
          $sess_data = array('EMPLOYE_ID'=>$get['EMPLOYE_ID'],'MATRICULE'=>$get['MATRICULE'],'EMPLOYE'=>$get['EMPLOYE'],'PROFILE_ID'=>$get['PROFILE_ID'],'OU_DEP_ID'=>$get['OU_DEP_ID'],'DESC_PROFIL'=>$get['DESC_PROFIL'],'IS_USER_SYSTEM'=>$get['IS_USER_SYSTEM'],'DEP_DESC'=>$get['DEP_DESC'],'IS_MUST_CHANGE_PWD'=>$get['IS_MUST_CHANGE_PWD']
        );


          $this->session->set_userdata($sess_data);
        // }
        
        // if ($get['IS_MUST_CHANGE_PWD']==0) {
        //   # code...
        //   $this->session->set_userdata($sess_data);
        // }else{


        //   $headers = array('alg'=>'HS256','typ'=>'JWT');
        //   $payload = array('sub'=>$get['MATRICULE'],'name'=>$get['EMPLOYE'], 'admin'=>true, 'exp'=>(time() + 60));
        //   //generer un token
        //   $token=$this->gc_lib->generate_jwt($headers, $payload);
        //   // print_r($token);die();
        //   $this->session->set_userdata(array('MATRICULE'=>$matricule));
        //   $this->Model->update('employes',array('MATRICULE'=>trim($matricule)),array('TOKEN'=>$token));

        // }
        
        

        $output = array("status"=>TRUE,'message'=>'Authentification en cours...');
      }else{
        $output = array("status"=>FALSE,'message'=>'Le mot de passe ou la matricule ne sont pas correctes.');
      }
    }else{
      $output = array("status"=>FALSE,'message'=>'Cet utilisateur n\'existe pas dans notre système ou a été désactivé');
    }

    echo json_encode($output);


  }






  function go_submit()
  {

      // redirect(base_url('administration/Utilisateurs/index'));

    if ($this->session->userdata('PROFILE_ID')==3) {
      # code...
      redirect(base_url('inventaire/Collecte_Data/index'));
    }else{
      redirect(base_url('dashboard/TB_Inventaire/index'));
    }
      
    
  }

  function change_mot_de_passe($token)
  {

    $data['title']="";
    $data['logo']=$this->Model->getRequeteOne('SELECT `LOGO_DESC` FROM logo WHERE TYPE_LOGO=2 LIMIT 1');
    $this->load->view('Change_mot_de_passe_view',$data);
  }

  function valid_pwd_change()
  {

    $this->__valide_change_pwd();

    $NEW_PWD=trim($this->input->post('NEW_PWD'));
    $ANCIEN_PWD=trim($this->input->post('ANCIEN_PWD'));
    $CONFIRM_PWD=trim($this->input->post('CONFIRM_PWD'));
    $MATRICULE=$this->input->post('MATRICULE');
    $auth=array();

    $this->Model->update('employes',array('MATRICULE'=>trim($MATRICULE)),array('IS_MUST_CHANGE_PWD'=>0,'MOT_DE_PASSE'=>md5($CONFIRM_PWD)));


    $get=$this->Model->getRequeteOne("SELECT
        em.EMPLOYE_ID,
        CONCAT(em.NOM_EMP, ' ', em.PRENOM_EMP) EMPLOYE,
        em.DEPARTEMENT_ID,
        em.PROFILE_ID,
        em.IS_USER_SYSTEM,
        em.MATRICULE,
        em.MOT_DE_PASSE,
        em.DATE_CREATION,
        d.DESC_DEPARTEMENT,
        a.AGENCE_NOM,
        a.AGENCE_ID,
        p.DESC_PROFIL,
        em.IS_MUST_CHANGE_PWD
        FROM
        employes em
        LEFT JOIN departement d ON
        d.DEPARTEMENT_ID = em.DEPARTEMENT_ID
        LEFT JOIN profil p ON
        p.PROFILE_ID = em.PROFILE_ID
        LEFT JOIN agences a ON a.AGENCE_ID=em.AGENCE_ID
        WHERE 
        em.MATRICULE='".trim($MATRICULE)."'
        AND em.IS_ACTIF = 1 
        AND em.IS_USER_SYSTEM = 1 
        AND d.STATUT = 1");

    if (!empty($this->Model->getOne('menu_users',array('USER_ID'=>$get['EMPLOYE_ID'])))) {
        # code...
        $auth=$this->Model->getRequeteOne("SELECT MENU_USER_ID, PROFIL_ID, TB_ST_PRINCIPAL, TB_DISTRIBU, TB_CONSOMMATION_ENCOURS_PRINCIPAL, TB_CONSOMMATION_ENCOURS_AGENCE, TB_AGENCE, TB_EXPORT_RAPPORT_GLO, TB_EXPORT_RAPPORT_AGENCE, TB_EXPORT_RAPPORT_DISTRIBUTION, TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL, TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE, LIST_STOCK_AGENCE, DEMANDE_STOCK_VERIFICATEUR, DEMANDE_STOCK_APPROBATEUR, DEMANDE_STOCK_DEMANDEUR, STOCK_DEMANDE_ACCUSER_RECEPTION, LIST_STOCK_PRINCIPAL, DEMANDE_STOCK_CONSULTATION, APPROV_CREATEUR, APPROV_VALIDEUR, APPROV_CONSULTATION, DISTR_CREATION, DISTR_VALIDEUR, DISTR_CONSULTATION, PROD_CREATION, PROD_VALIDEUR, PROD_CONSULTATION, UNITE_CREATION, UNITE_VALIDEUR, UNITE_CONSULTATION, CAT_CREATION, CAT_VALIDEUR, CAT_CONSULTATION, UNITE_PAR_QTE_CREATION, UNITE_PAR_QTE_VALIDEUR, UNITE_PAR_QTE_CONSULTATION, FOURN_CREATION, FOURN_VALIDEUR, FOURN_CONSULTATION, EMPLOYE_CREATION, EMPLOYE_PROFIL, EMPLOYE_VALIDEUR, EMPLOYE_CONSULTATION, STR_AGENCE_CREATION, STR_AGENCE_VALIDEUR, STR_AGENCE_CONSULTATION, STR_DEPARTEMENT_CREATION, STR_DEPARTEMENT_VALIDEUR, STR_DEPARTEMENT_CONSULTATION, PARAM_GEU, PARAM_R_MENU, PARAM_PARAMETRAGE,RETOUR_DECLASSEMENT_AGENCE,DECLASSEMENT_LOGISTIQUE,CONSULTATION_LOGISTIQUE,CONSULTATION_AGENCE,FORM_INVENTAIRE, USER_ID, IS_DELETE FROM menu_users WHERE  USER_ID=".$get['EMPLOYE_ID']." AND IS_DELETE=0");
      }

    $sess_data = array('EMPLOYE_ID'=>$get['EMPLOYE_ID'],'MATRICULE'=>$get['MATRICULE'],'EMPLOYE'=>$get['EMPLOYE'],'PROFILE_ID'=>$get['PROFILE_ID'],'DEPARTEMENT_ID'=>$get['DEPARTEMENT_ID'],'DESC_PROFIL'=>$get['DESC_PROFIL'],'IS_USER_SYSTEM'=>$get['IS_USER_SYSTEM'],'AGENCE_ID'=>$get['AGENCE_ID'],'AGENCE_NOM'=>$get['AGENCE_NOM'],'DESC_DEPARTEMENT'=>$get['DESC_DEPARTEMENT'],'IS_MUST_CHANGE_PWD'=>$get['IS_MUST_CHANGE_PWD'],'TB_ST_PRINCIPAL'=>$auth['TB_ST_PRINCIPAL'], 'TB_DISTRIBU'=>$auth['TB_DISTRIBU'], 'TB_CONSOMMATION_ENCOURS_PRINCIPAL'=>$auth['TB_CONSOMMATION_ENCOURS_PRINCIPAL'], 'TB_CONSOMMATION_ENCOURS_AGENCE'=>$auth['TB_CONSOMMATION_ENCOURS_AGENCE'], 'TB_AGENCE'=>$auth['TB_AGENCE'], 'TB_EXPORT_RAPPORT_GLO'=>$auth['TB_EXPORT_RAPPORT_GLO'], 'TB_EXPORT_RAPPORT_AGENCE'=>$auth['TB_EXPORT_RAPPORT_AGENCE'], 'TB_EXPORT_RAPPORT_DISTRIBUTION'=>$auth['TB_EXPORT_RAPPORT_DISTRIBUTION'], 'TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL'=>$auth['TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_PRINCIPAL'], 'TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE'=>$auth['TB_EXPORT_RAPPORT_ENCOURS_CONSOMMATION_AGENCE'], 'LIST_STOCK_AGENCE'=>$auth['LIST_STOCK_AGENCE'], 'DEMANDE_STOCK_VERIFICATEUR'=>$auth['DEMANDE_STOCK_VERIFICATEUR'], 'DEMANDE_STOCK_APPROBATEUR'=>$auth['DEMANDE_STOCK_APPROBATEUR'], 'DEMANDE_STOCK_DEMANDEUR'=>$auth['DEMANDE_STOCK_DEMANDEUR'], 'STOCK_DEMANDE_ACCUSER_RECEPTION'=>$auth['STOCK_DEMANDE_ACCUSER_RECEPTION'], 'LIST_STOCK_PRINCIPAL'=>$auth['LIST_STOCK_PRINCIPAL'], 'DEMANDE_STOCK_CONSULTATION'=>$auth['DEMANDE_STOCK_CONSULTATION'], 'APPROV_CREATEUR'=>$auth['APPROV_CREATEUR'], 'APPROV_VALIDEUR'=>$auth['APPROV_VALIDEUR'], 'APPROV_CONSULTATION'=>$auth['APPROV_CONSULTATION'], 'DISTR_CREATION'=>$auth['DISTR_CREATION'], 'DISTR_VALIDEUR'=>$auth['DISTR_VALIDEUR'], 'DISTR_CONSULTATION'=>$auth['DISTR_CONSULTATION'], 'PROD_CREATION'=>$auth['PROD_CREATION'], 'PROD_VALIDEUR'=>$auth['PROD_VALIDEUR'], 'PROD_CONSULTATION'=>$auth['PROD_CONSULTATION'], 'UNITE_CREATION'=>$auth['UNITE_CREATION'], 'UNITE_VALIDEUR'=>$auth['UNITE_VALIDEUR'], 'UNITE_CONSULTATION'=>$auth['UNITE_CONSULTATION'], 'CAT_CREATION'=>$auth['CAT_CREATION'], 'CAT_VALIDEUR'=>$auth['CAT_VALIDEUR'], 'CAT_CONSULTATION'=>$auth['CAT_CONSULTATION'], 'UNITE_PAR_QTE_CREATION'=>$auth['UNITE_PAR_QTE_CREATION'], 'UNITE_PAR_QTE_VALIDEUR'=>$auth['UNITE_PAR_QTE_VALIDEUR'], 'UNITE_PAR_QTE_CONSULTATION'=>$auth['UNITE_PAR_QTE_CONSULTATION'], 'FOURN_CREATION'=>$auth['FOURN_CREATION'], 'FOURN_VALIDEUR'=>$auth['FOURN_VALIDEUR'], 'FOURN_CONSULTATION'=>$auth['FOURN_CONSULTATION'], 'EMPLOYE_CREATION'=>$auth['EMPLOYE_CREATION'], 'EMPLOYE_PROFIL'=>$auth['EMPLOYE_PROFIL'], 'EMPLOYE_VALIDEUR'=>$auth['EMPLOYE_VALIDEUR'], 'EMPLOYE_CONSULTATION'=>$auth['EMPLOYE_CONSULTATION'], 'STR_AGENCE_CREATION'=>$auth['STR_AGENCE_CREATION'], 'STR_AGENCE_VALIDEUR'=>$auth['STR_AGENCE_VALIDEUR'], 'STR_AGENCE_CONSULTATION'=>$auth['STR_AGENCE_CONSULTATION'], 'STR_DEPARTEMENT_CREATION'=>$auth['STR_DEPARTEMENT_CREATION'], 'STR_DEPARTEMENT_VALIDEUR'=>$auth['STR_DEPARTEMENT_VALIDEUR'], 'STR_DEPARTEMENT_CONSULTATION'=>$auth['STR_DEPARTEMENT_CONSULTATION'], 'PARAM_PARAMETRAGE'=>$auth['PARAM_PARAMETRAGE'],'USER_ID'=>$auth['USER_ID'],'RETOUR_DECLASSEMENT_AGENCE'=>$auth['RETOUR_DECLASSEMENT_AGENCE'],'DECLASSEMENT_LOGISTIQUE'=>$auth['DECLASSEMENT_LOGISTIQUE'],'CONSULTATION_LOGISTIQUE'=>$auth['CONSULTATION_LOGISTIQUE'],'CONSULTATION_AGENCE'=>$auth['CONSULTATION_AGENCE'],'FORM_INVENTAIRE'=>$auth['FORM_INVENTAIRE']);



    $this->session->set_userdata($sess_data);
    
    echo json_encode(array('status'=>true,'message'=>"Une opération a été faite avec succès."));

  }


  public function change_pwd($value='')
  {
     # code...
    $this->__valide_change_pwd_2();

    $NOUVEAU_PWD=$this->input->post('NOUVEAU_PWD');
    $ANCIEN_PWD=$this->input->post('ANCIEN_PWD');
    $CONFIRM_PWD=$this->input->post('CONFIRM_PWD');

    $this->Model->update('employes',array('MATRICULE'=>$this->session->userdata('MATRICULE')),array('MOT_DE_PASSE'=>md5($NOUVEAU_PWD)));


    $sess_data = array('EMPLOYE_ID'=>NULL,'MATRICULE'=>NULL,'OU_DEP_ID'=>NULL,'DEP_DESC'=>NULL,'EMPLOYE'=>NULL,'PROFILE_ID'=>NULL,'IS_MUST_CHANGE_PWD'=>NULL,'DESC_PROFIL'=>NULL,'IS_USER_SYSTEM'=>NULL);

    // $this->session->unset_userdata($sess_data);
    $this->session->sess_destroy($sess_data);


    echo json_encode(array('status'=>true));



  }




  public function __valide_change_pwd()
  {
     # code...

    $getinfo=$this->Model->getOne('employes',array('MATRICULE'=>$this->input->post('MATRICULE')));

    // print_r($getinfo);die();

    $data['error_string']=array();
    $data['inputerror']=array();
    $data['status']=true;

    if (empty($this->input->post('MATRICULE'))) {
      // code...
      $data['error_string'][]="Votre session est déjà expirée.Veuillez se connecter encore";
      $data['inputerror'][]="MATRICULE";
      $data['status']=false;
    }

    if ($this->input->post('ANCIEN_PWD')=="") {
      // code...
      $data['error_string'][]="L'ancien mot de passe est obligatoire";
      $data['inputerror'][]="ANCIEN_PWD";
      $data['status']=false;
    }

    if ($this->input->post('NEW_PWD')=="") {
      // code...
      $data['error_string'][]="Le nouveau mot de passe est obligatoire";
      $data['inputerror'][]="NEW_PWD";
      $data['status']=false;
    }


    if ($this->input->post('NEW_PWD')) {
      # code...
      if (strlen($this->input->post('NEW_PWD'))<6) 
      {
        $data['inputerror'][]="NEW_PWD";
        $data['error_string'][]="Le mot de passe doit contenir au moins 6 caractères";
        $data['status']=FALSE;
      }

      if (md5(trim($this->input->post('NEW_PWD')))===$getinfo['MOT_DE_PASSE']) {
        # code...

        $data['error_string'][]="Le mot de passe est déjà utilisé";
        $data['inputerror'][]="NEW_PWD";
        $data['status']=false;
      }

    }

    if ($getinfo['MOT_DE_PASSE']!=md5($this->input->post('ANCIEN_PWD'))) {
      // code...
      $data['error_string'][]="Le mot de passe est incorecte";
      $data['inputerror'][]="ANCIEN_PWD";
      $data['status']=false;
    }

    if ($getinfo['MOT_DE_PASSE']!=md5($this->input->post('ANCIEN_PWD')) && $this->input->post('NEW_PWD')) {
      # code...
      $data['error_string'][]="Le mot de passe est incorecte";
      $data['inputerror'][]="ANCIEN_PWD";
      $data['status']=false;
    } 

    if ($this->input->post('CONFIRM_PWD')=='') {
      // code...
      $data['error_string'][]="La confirmation de mot de passe est obligatoire";
      $data['inputerror'][]="CONFIRM_PWD";
      $data['status']=false;
    }

    if ($this->input->post('CONFIRM_PWD')!=$this->input->post('NEW_PWD')) {
      // code...
      $data['error_string'][]="Le mot de passe ne correspond pas";
      $data['inputerror'][]="CONFIRM_PWD";
      $data['status']=false;
    }



    if ($data['status']==FALSE) 
    {
      // code...

      echo json_encode($data);
      exit();
    }

    
  }


  public function __valide_change_pwd_2()
  {
     # code...

    $getinfo=$this->Model->getOne('employes',array('MATRICULE'=>$this->input->post('MATRICULE')));

    // print_r($getinfo);die();

    $data['error_string']=array();
    $data['inputerror']=array();
    $data['status']=true;


    if ($this->input->post('ANCIEN_PWD')=="") {
      // code...
      $data['error_string'][]="L'ancien mot de passe est obligatoire";
      $data['inputerror'][]="ANCIEN_PWD";
      $data['status']=false;
    }

    if ($this->input->post('NOUVEAU_PWD')=="") {
      // code...
      $data['error_string'][]="Le nouveau mot de passe est obligatoire";
      $data['inputerror'][]="NOUVEAU_PWD";
      $data['status']=false;
    }


    if ($this->input->post('NOUVEAU_PWD')) {
      # code...
      if (strlen($this->input->post('NOUVEAU_PWD'))<6) 
      {
        $data['inputerror'][]="NOUVEAU_PWD";
        $data['error_string'][]="Le mot de passe doit contenir au moins 6 caractères";
        $data['status']=FALSE;
      }

      if (md5(trim($this->input->post('NOUVEAU_PWD')))===$getinfo['MOT_DE_PASSE']) {
        # code...

        $data['error_string'][]="Le mot de passe est déjà utilisé";
        $data['inputerror'][]="NOUVEAU_PWD";
        $data['status']=false;
      }

    }

    if ($getinfo['MOT_DE_PASSE']!=md5($this->input->post('ANCIEN_PWD'))) {
      // code...
      $data['error_string'][]="Le mot de passe est incorecte";
      $data['inputerror'][]="ANCIEN_PWD";
      $data['status']=false;
    }

    if ($getinfo['MOT_DE_PASSE']!=md5($this->input->post('ANCIEN_PWD')) && $this->input->post('NEW_PWD')) {
      # code...
      $data['error_string'][]="Le mot de passe est incorecte";
      $data['inputerror'][]="ANCIEN_PWD";
      $data['status']=false;
    } 

    if ($this->input->post('CONFIRM_PWD')=='') {
      // code...
      $data['error_string'][]="La confirmation de mot de passe est obligatoire";
      $data['inputerror'][]="CONFIRM_PWD";
      $data['status']=false;
    }

    if ($this->input->post('CONFIRM_PWD')!=$this->input->post('NEW_PWD')) {
      // code...
      $data['error_string'][]="Le mot de passe ne correspond pas";
      $data['inputerror'][]="CONFIRM_PWD";
      $data['status']=false;
    }



    if ($data['status']==FALSE) 
    {
      // code...

      echo json_encode($data);
      exit();
    }

    
  }






  public function _validate()
  {
    $data = null;
    $stat = true;

    $pseudo = $this->input->post('matricule');
    $pwd =  $this->input->post('pwd');

    if($pseudo == '')
    {
      $data = array('status'=>FALSE,'message'=>'La matricule est obligatoire');
      $stat = false;
    }else{
      if($pwd == '')
      {
        $data = array('status'=>FALSE,'message'=>'Le mot de passe est obligatoire');
        $stat = false;
      }else{
        $get = $this->Model->getOne('employes',array('MATRICULE'=>$this->input->post('matricule')));

        if (empty($get)) {
          $data = array('status'=>FALSE,'message'=>'Cet utilisateur n\'existe pas dans notre system ou a été effacé');
          $stat = false;
        }
      }


    }

    if($stat === FALSE)
    {
      echo json_encode($data);
      exit();
    }
  }


  public function deconnexion(){


    $sess_data = array('EMPLOYE_ID'=>NULL,'MATRICULE'=>NULL,'OU_DEP_ID'=>NULL,'DEP_DESC'=>NULL,'EMPLOYE'=>NULL,'PROFILE_ID'=>NULL,'IS_MUST_CHANGE_PWD'=>NULL,'DESC_PROFIL'=>NULL,'IS_USER_SYSTEM'=>NULL);


    // $this->session->unset_userdata($sess_data);
    $this->session->sess_destroy($sess_data);
    echo json_encode(array("status"=>TRUE));
  }





}
