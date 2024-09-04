<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Infos_personnelles extends CI_Controller
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

    $data['page_title']="Gestion des informations personnelles";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Staff</a></li>
    <li class="breadcrumb-item active" aria-current="page">Infos_personnelles</li>
    </ol>
    </nav>';
    $data['handicap']=$this->Model->getRequete('SELECT `ID_HANDICAP`, `HANDICAP` FROM `handicap` WHERE 1'); 
    $data['provinces']=$this->Model->getRequete("SELECT `PROVINCE_ID`, `PROVINCE_NAME` FROM `syst_provinces` WHERE 1 ORDER BY PROVINCE_NAME ASC");
    $data['sexe']=$this->Model->getRequete('SELECT `ID_SEXE`, `SEXE` FROM `sexe` WHERE 1');
    $data['matrimonial']=$this->Model->getRequete('SELECT `ID_MATRIMONIAL`, `MATRIMONIAL` FROM `matrimonial` WHERE 1');
    $data['embauche']=$this->Model->getRequete('SELECT `ID_EMBAUCHE`, `EMBAUCHE` FROM `dossier_embauche` WHERE 1');
    $data['emplacement']=$this->Model->getRequete('SELECT `ID_EMPLACEMENT`, `EMPL_PRESTA` FROM `empl_presta` WHERE 1');
    $data['spdp']=$this->Model->getRequete('SELECT `ID_SPDP`, `SPDP` FROM `spdp` WHERE 1');
    $data['mnrs']=$this->Model->getRequete('SELECT `ID_MNRS`, `MNRS` FROM `mnrs` WHERE 1');
    $data['saso']=$this->Model->getRequete('SELECT `ID_SASO`, `SASO` FROM `saso` WHERE 1');
    $data['nace']=$this->Model->getRequete('SELECT `ID_NACE`, `NACE` FROM `nace` WHERE 1');
    $data['niveau']=$this->Model->getRequete('SELECT `ID_NIVEAU`, `DESC_NIVEAU` FROM `niveaux` WHERE 1');
    $data['profil']=$this->Model->getRequete('SELECT `PROFILE_ID`, `DESC_PROFIL`, `IS_DELETED` FROM `profil` WHERE 1');
    $data['branche']=$this->Model->getRequete('SELECT `ID_BRANCHE`, `DESCRIPTION_BRANCH`, `LOCALISATION`, `STATUT` FROM `sanya_branches` WHERE 1');
    $this->load->view('Infos_personnelles_view',$data);
  }

  function ajouter()
  {  
    $ID_SEXE=$this->input->post('ID_SEXE');
    $NOM=$this->input->post('NOM');
    $PRENOM=$this->input->post('PRENOM');
    $ID_HANDICAP=$this->input->post('ID_HANDICAP');
    $PROVINCE_ID=$this->input->post('PROVINCE_ID');
    $COMMUNE_ID=$this->input->post('COMMUNE_ID');
    $ZONE_ID=$this->input->post('ZONE_ID');
    $COLLINE_ID=$this->input->post('COLLINE_ID');
    $DATE_NAISSANCE=$this->input->post('DATE_NAISSANCE');
    $ID_MATRIMONIAL=$this->input->post('ID_MATRIMONIAL');
    $TELEPHONE1=$this->input->post('TEL1');
    $TELEPHONE2=$this->input->post('TEL2');
    $EMAIL=$this->input->post('EMAIL1');
    $EMAIL_PRO=$this->input->post('EMAIL2');
    $MAIL_REF=$this->input->post('EMAIL3');
    $CNI=$this->input->post('CNI');
    $PROVINCE1=$this->input->post('PROVINCE_ID1');
    $COMMUNE1=$this->input->post('COMMUNE_ID1');
    $ZONE1=$this->input->post('ZONE_ID1');
    $COLLINE1=$this->input->post('COLLINE_ID1');
    $ID_DIPLOME=$this->input->post('ID_NIVEAU');
    $METIER=$this->input->post('METIER');
    $DATE_EMBAUCHE=$this->input->post('DATE_EMBAUCHE');
    $LIEU_EMBAUCHE=$this->input->post('LIEU_EMBAUCHE');
    $ID_EMBAUCHE=$this->input->post('ID_EMBAUCHE');
    $POSITION=$this->input->post('POSITION');
    $COMPETENCE=$this->input->post('COMPETENCE');
    $ID_EMPL_PRESTA=$this->input->post('ID_EMPLACEMENT');
    $NUM_CARTE=$this->input->post('NUM_CARTE');
    $NOM_REF=$this->input->post('NOM2');
    $PRENOM_REF=$this->input->post('PRENOM2');
    $TEL_REF=$this->input->post('TEL3');
    $DIVERTISSEMENT=$this->input->post('DIVERTISSEMENT');
    $ID_SPDP=$this->input->post('ID_SPDP');
    $ID_MNRS=$this->input->post('ID_MNRS');
    $ID_SASO=$this->input->post('ID_SASO');
    $ID_NACE=$this->input->post('ID_NACE');
    $PROFILE_ID=$this->input->post('PROFILE_ID');
    $ID_BRANCHE=$this->input->post('ID_BRANCHE');
    $DATE_CREATION= date("Y-m-d H:i:s");
    $STATUT=1;
    $IS_ACTIF=1;
    $IS_USER_SYSTEM=1;
    $MOT_DE_PASSE=md5(123456);
    $IS_MUST_CHANGE_PWD=1;
    $data_inserer=array(
      'ID_SEXE'=>$ID_SEXE,'NOM'=>$NOM,'PRENOM'=>$PRENOM,'ID_HANDICAP'=>$ID_HANDICAP,'PROVINCE_ID'=>$PROVINCE_ID,'COMMUNE_ID'=>$COMMUNE_ID,'ZONE_ID'=>$ZONE_ID,'COLLINE_ID'=>$COLLINE_ID,'DATE_NAISSANCE'=>$DATE_NAISSANCE,'ID_MATRIMONIAL'=>$ID_MATRIMONIAL,'TELEPHONE1'=>$TELEPHONE1,'TELEPHONE2'=>$TELEPHONE2,'EMAIL'=>$EMAIL,'EMAIL_PRO'=>$EMAIL_PRO,'CNI'=>$CNI,'PROVINCE1'=>$PROVINCE1,'COMMUNE1'=>$COMMUNE1,'ZONE1'=>$ZONE1,'COLLINE1'=>$COLLINE1,'ID_DIPLOME'=>$ID_DIPLOME,'METIER'=>$METIER,'DATE_EMBAUCHE'=>$DATE_EMBAUCHE,'LIEU_EMBAUCHE'=>$LIEU_EMBAUCHE,'ID_EMBAUCHE'=>$ID_EMBAUCHE,'POSITION'=>$POSITION,'COMPETENCE'=>$COMPETENCE,'ID_EMPL_PRESTA'=>$ID_EMPL_PRESTA,'NUM_CARTE'=>$NUM_CARTE,'NOM_REF'=>$NOM_REF,'PRENOM_REF'=>$PRENOM_REF,'TEL_REF'=>$TEL_REF,'DIVERTISSEMENT'=>$DIVERTISSEMENT,'ID_SPDP'=>$ID_SPDP,'ID_MNRS'=>$ID_MNRS,'ID_SASO'=>$ID_SASO,'ID_NACE'=>$ID_NACE,'DATE_CREATION'=>$DATE_CREATION
    );
    $data_user=array('NOM_EMP'=>trim($NOM),'PRENOM_EMP'=>trim($PRENOM),'EMAIL_EMP'=>trim($EMAIL),'DIPLOME'=>trim($ID_DIPLOME),'STATUT'=>trim($STATUT),'TEL_EMP'=>trim($TELEPHONE1),'IS_ACTIF'=>trim($IS_ACTIF),'PROFILE_ID'=>trim($PROFILE_ID),'IS_USER_SYSTEM'=>trim($IS_USER_SYSTEM),'MOT_DE_PASSE'=>trim($MOT_DE_PASSE),'IS_MUST_CHANGE_PWD'=>trim($IS_MUST_CHANGE_PWD),'ID_BRANCHE'=>trim($ID_BRANCHE));

    $create=$this->Model->create('infos_personnel',$data_inserer);
    $create1=$this->Model->create('employes',$data_user);
    
    if ($create)
    {
      $data['message']='<div class="alert alert-success alert-dismissible alert-alt solid fade show">
      <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
      </button>
      <center><strong>Opération effectuée avec succès</strong></center>
      </div>';
      $this->session->set_flashdata($data);
    }
    redirect(base_url('index.php/stock/Stock_detail/'));
  }
   //recupération des communes
function get_communes($PROVINCE_ID=0)
{
  $communes=$this->Model->getRequete('SELECT COMMUNE_ID,COMMUNE_NAME FROM syst_communes WHERE PROVINCE_ID='.$PROVINCE_ID.' ORDER BY COMMUNE_NAME ASC');
  $html='<option value="">---Sélectionner---</option>';
  foreach ($communes as $key)
  {
    $html.='<option value="'.$key['COMMUNE_ID'].'">'.$key['COMMUNE_NAME'].'</option>';
  }
  echo json_encode($html);
}
     //recupération des zones
function get_zones($COMMUNE_ID=0)
{
  $zones=$this->Model->getRequete('SELECT ZONE_ID,ZONE_NAME FROM syst_zones WHERE COMMUNE_ID='.$COMMUNE_ID.' ORDER BY ZONE_NAME ASC');

  $html='<option value="">---Sélectionner---</option>';
  foreach ($zones as $key)
  {
    $html.='<option value="'.$key['ZONE_ID'].'">'.$key['ZONE_NAME'].'</option>';
  }
  echo json_encode($html);
}

    //recupération des collines
function get_collines($ZONE_ID=0)
{
  $collines=$this->Model->getRequete('SELECT COLLINE_ID,COLLINE_NAME FROM syst_collines WHERE ZONE_ID='.$ZONE_ID.' ORDER BY COLLINE_NAME ASC');
  $html='<option value="">---Sélectionner---</option>';
  foreach ($collines as $key)
  {
    $html.='<option value="'.$key['COLLINE_ID'].'">'.$key['COLLINE_NAME'].'</option>';
  }
  echo json_encode($html);
}

}
?>