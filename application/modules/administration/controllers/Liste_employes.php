<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Liste_employes extends CI_Controller
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

    $data['page_title']="Liste des employés";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Le personnel</a></li>
    <li class="breadcrumb-item active" aria-current="page">Liste des employés</li>
    </ol>
    </nav>';
    $data['somme']=$this->Model->getRequeteOne('SELECT sum(`PA_T`) as montant FROM `stock_secretariat` WHERE 1');

    $this->load->view('Liste_employes_view',$data);
  }

  
  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal="SELECT `ID_INFO_PERSONNEL`, sexe.SEXE, `NOM`, `PRENOM`,handicap. `HANDICAP`, P.PROVINCE_NAME AS PROVINCE, C.COMMUNE_NAME AS COMMUNE, Z.ZONE_NAME AS ZONE,CO.COLLINE_NAME AS COLLINE, `DATE_NAISSANCE`,matrimonial.MATRIMONIAL, `TELEPHONE1`, `TELEPHONE2`, `EMAIL`, `EMAIL_PRO`, `CNI`,P1.PROVINCE_NAME AS PROINCE1, C1.COMMUNE_NAME AS COMMUNE1, Z1.ZONE_NAME AS ZONE1,CO1.COLLINE_NAME AS COLLINE1,niveaux.DESC_NIVEAU, `METIER`, `DATE_EMBAUCHE`, `LIEU_EMBAUCHE`, dossier_embauche.EMBAUCHE, `POSITION`, `COMPETENCE`, empl_presta.EMPL_PRESTA, `NUM_CARTE`, `NOM_REF`, `PRENOM_REF`, `TEL_REF`, `MAIL_REF`, `DIVERTISSEMENT`, spdp.SPDP, mnrs.MNRS, saso.SASO,nace.NACE, `DATE_CREATION` FROM `infos_personnel`  LEFT JOIN sexe ON sexe.ID_SEXE=infos_personnel.ID_INFO_PERSONNEL LEFT JOIN handicap ON handicap.ID_HANDICAP=infos_personnel.ID_HANDICAP LEFT JOIN syst_provinces P ON P.PROVINCE_ID=infos_personnel.PROVINCE_ID LEFT JOIN syst_provinces P1 ON P1.PROVINCE_ID=infos_personnel.PROVINCE1 LEFT JOIN syst_communes C ON C.COMMUNE_ID=infos_personnel.COMMUNE_ID LEFT JOIN syst_communes C1 ON C1.COMMUNE_ID=infos_personnel.COMMUNE1 LEFT JOIN syst_zones Z ON Z.ZONE_ID=infos_personnel.ZONE_ID LEFT JOIN syst_zones Z1 ON Z1.ZONE_ID=infos_personnel.ZONE1 LEFT JOIN syst_collines CO ON CO.COLLINE_ID=infos_personnel.COLLINE_ID LEFT JOIN syst_collines CO1 ON CO1.COLLINE_ID=infos_personnel.COLLINE1 LEFT JOIN matrimonial ON matrimonial.ID_MATRIMONIAL=infos_personnel.ID_MATRIMONIAL LEFT JOIN niveaux ON niveaux.ID_NIVEAU=infos_personnel.ID_DIPLOME LEFT JOIN dossier_embauche ON dossier_embauche.ID_EMBAUCHE=infos_personnel.ID_EMBAUCHE LEFT JOIN empl_presta ON empl_presta.ID_EMPLACEMENT=infos_personnel.ID_EMPL_PRESTA LEFT JOIN spdp ON spdp.ID_SPDP=infos_personnel.ID_SPDP LEFT JOIN mnrs ON mnrs.ID_MNRS=infos_personnel.ID_MNRS LEFT JOIN saso ON saso.ID_SASO=infos_personnel.ID_SASO LEFT JOIN nace ON nace.ID_NACE=infos_personnel.ID_NACE  WHERE 1";

    $order_column=array("NOM","PRENOM","TELEPHONE1","EMAIL","EMBAUCHE");

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY NOM  ASC';
    $search = !empty($_POST['search']['value']) ? (" AND  (NOM LIKE '%$var_search%' OR PRENOM LIKE '%$var_search%' OR EMAIL LIKE '%$var_search%' OR EMBAUCHE LIKE '%$var_search%' OR TELEPHONE1 LIKE '%$var_search%') ") : '';

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
    $sub_array[] = $row->NOM;
    $sub_array[] = $row->PRENOM;
    $sub_array[] = $row->TELEPHONE1;
    $sub_array[] = $row->EMAIL;
    // $sub_array[] = $row->PROVINCE;
    // $sub_array[] = $row->DATE_EMBAUCHE;
    $sub_array[] = $row->EMBAUCHE;

     $sub_array[] = '<a href="'.base_url('index.php/administration/Liste_employes/details/'.$row->ID_INFO_PERSONNEL).'" style="color:green;" class="action-icon">Détails</a>';
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
  public function details($ID_INFO_PERSONNEL){
    $data['page_title'] = "Espace Personnel";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="' . base_url() . 'index.php/rapport/Statistiques"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Utilisateurs</a></li>
    <li class="breadcrumb-item active" aria-current="page">Espace Personnel</li>
    </ol>
    </nav>';
    $data['infos_perso']=$this->Model->getRequeteOne('SELECT `ID_INFO_PERSONNEL`, sexe.SEXE, `NOM`, `PRENOM`,handicap. `HANDICAP`, P.PROVINCE_NAME AS PROVINCE, C.COMMUNE_NAME AS COMMUNE, Z.ZONE_NAME AS ZONE,CO.COLLINE_NAME AS COLLINE, `DATE_NAISSANCE`,matrimonial.MATRIMONIAL, `TELEPHONE1`, `TELEPHONE2`, `EMAIL`, `EMAIL_PRO`, `CNI`,P1.PROVINCE_NAME AS PROINCE1, C1.COMMUNE_NAME AS COMMUNE1, Z1.ZONE_NAME AS ZONE1,CO1.COLLINE_NAME AS COLLINE1,niveaux.DESC_NIVEAU, `METIER`, `DATE_EMBAUCHE`, `LIEU_EMBAUCHE`, dossier_embauche.EMBAUCHE, `POSITION`, `COMPETENCE`, empl_presta.EMPL_PRESTA, `NUM_CARTE`, `NOM_REF`, `PRENOM_REF`, `TEL_REF`, `MAIL_REF`, `DIVERTISSEMENT`, spdp.SPDP, mnrs.MNRS, saso.SASO,nace.NACE, `DATE_CREATION` FROM `infos_personnel`  LEFT JOIN sexe ON sexe.ID_SEXE=infos_personnel.ID_INFO_PERSONNEL LEFT JOIN handicap ON handicap.ID_HANDICAP=infos_personnel.ID_HANDICAP LEFT JOIN syst_provinces P ON P.PROVINCE_ID=infos_personnel.PROVINCE_ID LEFT JOIN syst_provinces P1 ON P1.PROVINCE_ID=infos_personnel.PROVINCE1 LEFT JOIN syst_communes C ON C.COMMUNE_ID=infos_personnel.COMMUNE_ID LEFT JOIN syst_communes C1 ON C1.COMMUNE_ID=infos_personnel.COMMUNE1 LEFT JOIN syst_zones Z ON Z.ZONE_ID=infos_personnel.ZONE_ID LEFT JOIN syst_zones Z1 ON Z1.ZONE_ID=infos_personnel.ZONE1 LEFT JOIN syst_collines CO ON CO.COLLINE_ID=infos_personnel.COLLINE_ID LEFT JOIN syst_collines CO1 ON CO1.COLLINE_ID=infos_personnel.COLLINE1 LEFT JOIN matrimonial ON matrimonial.ID_MATRIMONIAL=infos_personnel.ID_MATRIMONIAL LEFT JOIN niveaux ON niveaux.ID_NIVEAU=infos_personnel.ID_DIPLOME LEFT JOIN dossier_embauche ON dossier_embauche.ID_EMBAUCHE=infos_personnel.ID_EMBAUCHE LEFT JOIN empl_presta ON empl_presta.ID_EMPLACEMENT=infos_personnel.ID_EMPL_PRESTA LEFT JOIN spdp ON spdp.ID_SPDP=infos_personnel.ID_SPDP LEFT JOIN mnrs ON mnrs.ID_MNRS=infos_personnel.ID_MNRS LEFT JOIN saso ON saso.ID_SASO=infos_personnel.ID_SASO LEFT JOIN nace ON nace.ID_NACE=infos_personnel.ID_NACE  WHERE  ID_INFO_PERSONNEL='.$ID_INFO_PERSONNEL);
    $this->load->view('Espace_personnel_view',$data);
  }
}
?>