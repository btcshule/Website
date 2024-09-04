<?php 
/**
/**
* @author nadvaxe2023
* le 08/10/2023
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Liste_sorties_stock extends CI_Controller
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
 

 		$data['page_title']="Nos contenus en stock";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';
$group_by='group by date_format(gros_client_facture.DATE_ACTION,"%Y-%m-%d"),gros_stock.GROS_PRODUIT_ID';
    $gros_stock= $this->Model->getRequete('SELECT gros_stock.GROS_STOCK_ID,gros_produit.GROS_PRODUIT_ID,`ID_VENTES`,SUM(`QUANTITE`) AS QUANTITE,`PRIX_UNITAIRE`,`PRIX_TOTAL`,GROS_PRODUIT_DESCR,DATE_ACTION FROM `gros_ventes_produits` LEFT JOIN gros_stock ON gros_stock.GROS_STOCK_ID=gros_ventes_produits.GROS_STOCK_ID LEFT JOIN gros_produit ON gros_produit.GROS_PRODUIT_ID =gros_stock.GROS_PRODUIT_ID LEFT JOIN gros_client_facture ON gros_client_facture.GROS_CLIENT_FACT_ID=gros_ventes_produits.GROS_CLIENT_FACT_ID WHERE 1 '.$group_by);
    if (!empty($gros_stock)) {
    $i=0;

 foreach ($gros_stock as $key) {
      $i=$i+1;
      $gros=array();
      
      $gros[]=$i;
      $gros[]=date('d-m-Y',strtotime($key['DATE_ACTION']));
      $gros[]=$key['GROS_PRODUIT_DESCR'];
      $gros[]="<b>".$key['QUANTITE'].' '.'</b>Qty';
      $gros[]=$key['PRIX_UNITAIRE'].' '.'BIF';
      $gros[]="<b>".$key['PRIX_UNITAIRE']*$key['QUANTITE'].' '.'</b>BIF';
     

      $tabledata[]=$gros;
    }

  }
    else{
      $tabledata='';
    }

    $template = array(
      'table_open' => '<table id="AllExit" class="table table-bordered table-striped table-hover table-condensed table-responsive">',
      'table_close' => '</table>'
    );

    $this->table->set_heading('#','DATE&nbspINSERTION','DESIGNATION','QUANTITY','SALE&nbspPRICE','TOT.PRICE');
    $this->table->set_template($template);
    $data['AllExit']=$tabledata;
    // $data['breadcrumb'] = $this->make_bread->output();

    $this->load->view('Liste_sorties_stock_view',$data); 
  }
}
?>