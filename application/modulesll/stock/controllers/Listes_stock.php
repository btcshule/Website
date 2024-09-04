<?php 
/**
/**
* @author nadvaxe2023
* le 08/10/2023
*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");
class Listes_stock extends CI_Controller
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
    $gros_stock = $this->Model->getRequete('SELECT `ID_ENTREE`,gros_entrees_stock.GROS_STOCK_ID,`QUANTITE_PRODUIT`,`PRIX_ACHAT_UNITAIRE`,`PRIX_VENTE_UNITAIRE`,`DATE_INSERTION`,GROS_PRODUIT_DESCR FROM `gros_entrees_stock` JOIN gros_stock on gros_stock.GROS_STOCK_ID = gros_entrees_stock.GROS_STOCK_ID JOIN gros_produit ON gros_produit.GROS_PRODUIT_ID=gros_stock.GROS_PRODUIT_ID WHERE 1 ORDER BY DATE_INSERTION DESC');
    $i=0;
    foreach ($gros_stock as $key) {
      $i=$i+1;
      $gros=array();
      
      $gros[]=$i;
      $gros[]=date('d-m-Y',strtotime($key['DATE_INSERTION']));
      $gros[]=$key['GROS_PRODUIT_DESCR'];
      $gros[]="<b>".$key['QUANTITE_PRODUIT'].' '.'</b>Qty';
      $gros[]="<b>".number_format($key['PRIX_VENTE_UNITAIRE'],0,',',',').'</b> BIF';
      $gros[]="<b>".number_format($key['PRIX_VENTE_UNITAIRE']*$key['QUANTITE_PRODUIT'],0,',',',').'</b> BIF';
      $tabledata[]=$gros;
  }

  $template = array(
      'table_open' => '<table id="AllEntries" class="table table-bordered table-striped table-hover table-condensed table-responsive">',
      'table_close' => '</table>'
  );

  $this->table->set_heading('#','DATE INSERTION','DESIGNATION','QUANTITY','SALE PRICE','TOT.PRICE');
  $this->table->set_template($template);
  $data['AllEntries']=$tabledata;
  // $data['breadcrumb'] = $this->make_bread->output();

  $this->load->view('Listes_stock_view',$data); 
}
}
?>