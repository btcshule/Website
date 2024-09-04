<?php 
/**
/**
* @author nadvaxe
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");


class Ventes extends CI_Controller
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

    $data['page_title']="Gestionnaire des ventes";
    $data['breadcrumbs'] = '<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light-lighten p-2 mb-0">
    <li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Accueil</a></li>
    <li class="breadcrumb-item"><a href="#">Données</a></li>
    <li class="breadcrumb-item active" aria-current="page">Marchandises</li>
    </ol>
    </nav>';

 $data['client']=$this->Model->getRequete('SELECT `GROS_CLIENT_ID`, `PRENOM_GROS_CLIENT`, `NOM_GROS_CLIENT`, `ADRESS_GROS_CLIENT`, `TEL_GROS_CLIENT`, `IS_CLIENT`, `STATUT`, `NIF`, `RS`, `RC`, `ID_BRANCHE`, `DATE_INSERTION` FROM `gros_client` WHERE 1 ORDER BY NOM_GROS_CLIENT ASC');
  $data['produit'] = $this->Model->getRequete('SELECT * FROM `cathegories` WHERE 1');
  $data['service'] = $this->Model->getRequete('SELECT * FROM `services` WHERE 1');

    $this->load->view('Ventes_view',$data);
  }

  function ajouter()
  {
    // $this->_validate();
$dateVente = $this->input->post('DATE_VENTE');
$dateTime = new DateTime($dateVente);
$formattedDate = $dateTime->format('Y-m-d H:i:s');

  $DESIGNATION=$this->input->post('DESIGNATION');
    $ID_CLIENT=$this->input->post('ID_CLIENT');
    $QUANTITE=$this->input->post('QUANTITE');
    $PU=$this->input->post('PU');
    $OBSERVATION=$this->input->post('OBSERVATION');
    $FACTURE=$this->input->post('FACTURE');
    $RESP_VENTE=$this->session->userdata('EMPLOYE_ID');
    $STATUT=1;
    $PT=$QUANTITE*$PU;

    $data=array('DATE_VENTE'=>trim($formattedDate),'ID_CLIENT'=>trim($ID_CLIENT),'DESIGNATION'=>trim($DESIGNATION),'QUANTITE'=>trim($QUANTITE),'PU'=>trim($PU),'PT'=>trim($PT),'OBSERVATION'=>trim($OBSERVATION),'STATUT'=>trim($STATUT),'FACTURE'=>trim($FACTURE),'RESP_VENTE'=>trim($RESP_VENTE));
    // print_r($data);die();
    $this->Model->create('ventes_sanya',$data);
    echo json_encode(array('status'=>true));

  }


  function del($id, $stat)
  {
    if ($stat == 1) 
    {
      $value = ($stat == 1) ? 0 : 1;
      $this->Model->update('ventes_sanya', array('ID_VENTE' => $id), array('STATUT' => $value));
      echo json_encode(array('status' => true));
    } else 
    {
      echo json_encode(array('status' => false, 'message' => 'La réactivation n\'est pas autorisée. Crée plutôt une nouvelle!'));
    }
  }

  function liste()
  {
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
//  $data['client']=$this->Model->getRequete('SELECT `GROS_CLIENT_ID`, `PRENOM_GROS_CLIENT`, `NOM_GROS_CLIENT`, `ADRESS_GROS_CLIENT`, `TEL_GROS_CLIENT`, `IS_CLIENT`, `STATUT`, `NIF`, `RS`, `RC`, `ID_BRANCHE`, `DATE_INSERTION` FROM `gros_client` WHERE 1 ORDER BY NOM_GROS_CLIENT ASC');

       $query_principal="SELECT `ID_VENTE`, NOM_GROS_CLIENT,PRENOM_GROS_CLIENT, `PRODUCT_DESC`, `QUANTITE`, `PU`, `PT`, `OBSERVATION`, NOM_EMP,PRENOM_EMP, `DATE_VENTE`, ventes_sanya.DATE_CREATION, ventes_sanya.STATUT FROM `ventes_sanya` LEFT JOIN employes ON employes.EMPLOYE_ID=ventes_sanya.RESP_VENTE LEFT JOIN gros_client ON gros_client.GROS_CLIENT_ID=ventes_sanya.ID_CLIENT LEFT JOIN products ON products.PRODUCT_ID=ventes_sanya.DESIGNATION WHERE ventes_sanya.STATUT=1";

    $order_column=array('NOM_GROS_CLIENT','PRENOM_GROS_CLIENT','PRODUCT_DESC','QUANTITE','OBSERVATION','DATE_VENTE','NOM_EMP','PRENOM_EMP');

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY DATE_VENTE  DESC';
    $search = !empty($_POST['search']['value']) ? (" AND  (PRODUCT_DESC LIKE '%$var_search%' OR NOM_GROS_CLIENT LIKE '%$var_search%' OR PRENOM_GROS_CLIENT LIKE '%$var_search%' OR DATE_VENTE LIKE '%$var_search%' OR ventes_sanya.DATE_CREATION LIKE '%$var_search%' OR OBSERVATION LIKE '%$var_search%') ") : '';
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
      $sub_array[] = $row->ID_VENTE;
      $sub_array[] = date('d-m-y H:i', strtotime($row->DATE_VENTE));
      $sub_array[] = $row->PRODUCT_DESC;
      $sub_array[] = $row->QUANTITE;
      $sub_array[] = $row->PU;
      $sub_array[] = $row->PT;
      $sub_array[] = $row->NOM_GROS_CLIENT.' '.$row->PRENOM_GROS_CLIENT;
      $sub_array[] = ($row->STATUT==1) ? '<span class="badge bg-success">'.$STATUT.'</span>' : '<span class="badge bg-danger">'.$STATUT.'</span>';
      $sub_array[] = $row->NOM_EMP.' '.$row->PRENOM_EMP;

      $sub_array[] = '<a href="javascript:void(0);" onclick="supp_logic('.$row->ID_VENTE.','.$row->STATUT.')" style="color:red;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
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
  // function _validate()
  // {
  //   $data=array();
  //   $data['error_string']=array();
  //   $data['inputerror']=array();
  //   $data['status']=true;

  //   $check_livre_caisse=$this->Model->getOne('ventes_sanya',array('DESIGNATION'=>$this->input->post('DESIGNATION'),'ID_VENTE!='=>$this->input->post('ID_VENTE')));

  //   if ($this->input->post('DESIGNATION')=="") 
  //   {
  //     $data['error_string'][]="Le champs est obligatoire";
  //     $data['inputerror'][]="DESIGNATION";
  //     $data['status']=false;
  //   }
  //   if ($check_livre_caisse) {
  //     $data['error_string'][]="Vous l'avez déjà ajouté, actualisez!";
  //     $data['inputerror'][]="ID_VENTE";
  //     $data['status']=false;
  //   }
  //   if ($data['status']==FALSE) 
  //   {
  //     echo json_encode($data);
  //     exit();
  //   }
  // }

 function getdesignations($id)
  {
    $site = $this->Model->getList('products', array('CATH_ID' => $id,'ID_BRANCHE'=>$this->session->userdata('ID_BRANCHE')));
    $html = '<option value="" disabled selected>Select</option>';
    foreach ($site as $value) {
      $html .= '<option value="' . $value['PRODUCT_ID'] . '">' . $value['PRODUCT_DESC'] . '</option>';
    }
    echo $html;
  }

}
?>