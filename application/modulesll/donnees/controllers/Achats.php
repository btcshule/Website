<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");


class Achats extends CI_Controller
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

    $data['page_title']="Listes des achants";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
    </nav>';

 $data['fournisseur']=$this->Model->getRequete('SELECT `ID_FOURNISSEUR`, `NOM_FOURNISSEUR`, `PRENOM_FOURNISSEUR`, `TEL_FOURNISSEUR`, `LOC_FOURNISSEUR`, `STATUT` FROM `fournisseurs_sanya` WHERE 1 ORDER BY NOM_FOURNISSEUR ASC');

    $this->load->view('Achats_view',$data);
  }

  function ajouter()
  {
    $this->_validate();
    $DATE_ACHAT=$this->input->post('DATE_ACHAT');
    $DESIGNATION=$this->input->post('DESIGNATION');
    $ID_FOURNISSEUR=$this->input->post('ID_FOURNISSEUR');
    $QUANTITE=$this->input->post('QUANTITE');
    $PU=$this->input->post('PU');
    $OBSERVATION=$this->input->post('OBSERVATION');
    $RESP_ACHAT=$this->session->userdata('EMPLOYE_ID');
    $STATUT=1;
    $PT=$QUANTITE*$PU;

    $data=array('DATE_ACHAT'=>trim($DATE_ACHAT),'ID_FOURNISSEUR'=>trim($ID_FOURNISSEUR),'DESIGNATION'=>trim($DESIGNATION),'QUANTITE'=>trim($QUANTITE),'PU'=>trim($PU),'PT'=>trim($PT),'OBSERVATION'=>trim($OBSERVATION),'STATUT'=>trim($STATUT),'RESP_ACHAT'=>trim($RESP_ACHAT));
    // print_r($data);die();
    $this->Model->create('achats_sanya',$data);
    echo json_encode(array('status'=>true));

  }

  function del($id, $stat)
  {
    if ($stat == 1) 
    {
      $value = ($stat == 1) ? 0 : 1;
      $this->Model->update('achats_sanya', array('ID_ACHAT' => $id), array('STATUT' => $value));
      echo json_encode(array('status' => true));
    } else 
    {
      echo json_encode(array('status' => false, 'message' => 'La réactivation n\'est pas autorisée. Crée plutôt une nouvelle!'));
    }
  }

  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $query_principal="SELECT `ID_ACHAT`, NOM_FOURNISSEUR,PRENOM_FOURNISSEUR, `DESIGNATION`, `QUANTITE`, `PU`, `PT`, `OBSERVATION`, NOM_EMP,PRENOM_EMP, `DATE_ACHAT`, achats_sanya.DATE_CREATION, achats_sanya.STATUT FROM `achats_sanya` LEFT JOIN employes ON employes.EMPLOYE_ID=achats_sanya.RESP_ACHAT LEFT JOIN fournisseurs_sanya ON fournisseurs_sanya.ID_FOURNISSEUR=achats_sanya.ID_FOURNISSEUR WHERE achats_sanya.STATUT=1";
    $order_column=array('NOM_FOURNISSEUR','PRENOM_FOURNISSEUR','DESIGNATION','QUANTITE','OBSERVATION','DATE_ACHAT','NOM_EMP','PRENOM_EMP');

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DATE_ACHAT  DESC';
    $search = !empty($_POST['search']['value']) ? (" AND  (DESIGNATION LIKE '%$var_search%' OR NOM_FOURNISSEUR LIKE '%$var_search%' OR DATE_ACHAT LIKE '%$var_search%' OR DATE_CREATION LIKE '%$var_search%' OR OBSERVATION LIKE '%$var_search%') ") : '';
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

    foreach ($fetch_data as $row) 
    {
      if ($row->STATUT==1) 
      {
        $STATUT='Enregistrée';
      }else
      {
        $STATUT='Erronée';
      }

      $sub_array = array();  
      $option='';
      $sub_array[] = $row->ID_ACHAT;
      $sub_array[] = $row->DATE_ACHAT;
      $sub_array[] = $row->DESIGNATION;
      $sub_array[] = $row->QUANTITE;
      $sub_array[] = $row->PU;
      $sub_array[] = $row->PT;
      $sub_array[] = $row->NOM_FOURNISSEUR.' '.$row->PRENOM_FOURNISSEUR;
      $sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
      $sub_array[] = $row->NOM_EMP.' '.$row->PRENOM_EMP;

      $sub_array[] = '<a href="javascript:void(0);" onclick="supp_logic('.$row->ID_ACHAT.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
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
  function _validate()
  {
    $data=array();
    $data['error_string']=array();
    $data['inputerror']=array();
    $data['status']=true;

    $check_livre_caisse=$this->Model->getOne('achats_sanya',array('DESIGNATION'=>$this->input->post('DESIGNATION'),'ID_ACHAT!='=>$this->input->post('ID_ACHAT')));

    if ($this->input->post('DESIGNATION')=="") 
    {
      $data['error_string'][]="Le champs est obligatoire";
      $data['inputerror'][]="DESIGNATION";
      $data['status']=false;
    }
    if ($check_livre_caisse) {
      $data['error_string'][]="Vous l'avez déjà tapé";
      $data['inputerror'][]="ID_ACHAT";
      $data['status']=false;
    }
    if ($data['status']==FALSE) 
    {
      echo json_encode($data);
      exit();
    }
  }
}
?>