<?php 
/**
/**
* @author NSHIMIRIMANA Révérien/+25768051821/rnshimirimana48@gmail.com

*/
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');
date_default_timezone_set("africa/Bujumbura");


class Budgetisation extends CI_Controller
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

		$data['page_title']="Budgétisation";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="#"><i class="uil-home-alt"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
		</ol>
		</nav>';

		$data['categories']=$this->Model->getRequete("SELECT `CATEGORIE_ID`, `CATEGORIE_DESC`, `STATUT` FROM `categories` WHERE STATUT=1 ORDER BY CATEGORIE_DESC ASC");

		$this->load->view('Budgetisation_view',$data);
	}

	function add($CATEGORIE_ID)
	{

		$this->cart->destroy();

		
		$data['one_cat']=$this->Model->getOne('categories',array('CATEGORIE_ID'=>$CATEGORIE_ID));
		$data['page_title']="";
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="'.base_url('donnees/Budgetisation/index').'"><i class="mdi mdi-weight"></i> Budgétisation</a></li>
		<li class="breadcrumb-item"><a href="#">Catégorie</a></li>
		<li class="breadcrumb-item">'.$data['one_cat']['CATEGORIE_DESC'].'</li>
		</ol>
		</nav>';

		$data['categories']=$this->Model->getRequete("SELECT `CATEGORIE_ID`, `CATEGORIE_DESC`, `STATUT` FROM `categories` WHERE STATUT=1 ORDER BY CATEGORIE_DESC ASC");
		$data['CATEGORIE_ID']=$CATEGORIE_ID;


		$this->load->view('Budgetisation_add_view',$data);

	}

	function update()
	{
		$this->_validate();
		$AGENCE_ID=$this->input->post('AGENCE_ID');
		$AGENCE_NOM=$this->input->post('AGENCE_NOM');

		$data=array('AGENCE_NOM'=>$AGENCE_NOM);

		$this->Model->update('agences',array('AGENCE_ID'=>$AGENCE_ID),$data);
		echo json_encode(array('status'=>true));

	}

	function getOne($id)
	{
		$data=$this->Model->getOne('agences',array('AGENCE_ID'=>$id));
		echo json_encode($data);
	}

	function supp_logic($id,$is_actif)
	{
		$STATUT_AG = ($is_actif==1) ? 0 : 1 ;
		$this->Model->update('agences',array('AGENCE_ID'=>$id),array('STATUT_AG'=>$STATUT_AG));
		echo json_encode(array('status'=>true));
	}


	function liste()
	{


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT b.CODE_BUDGETISATION,b.BUDGETISATION_ID,(CASE  WHEN b.STATUT_BUDGET=1 THEN 'En attente de validation' WHEN b.STATUT_BUDGET=2 THEN 'Validée' WHEN b.STATUT_BUDGET=3 THEN 'Clôturée' WHEN b.STATUT_BUDGET=4 THEN 'Annulée' END) LIGNE_STAT,b.STATUT_BUDGET,b.COUT_TOTAL,b.DATE_BUDGET,CONCAT(e.NOM_EMP,' ',e.PRENOM_EMP)EMPLOYE,c.CATEGORIE_DESC FROM budgetisation b JOIN  categories c ON c.CATEGORIE_ID=b.CATEGORIE_ID JOIN employes e ON e.EMPLOYE_ID=b.USER_ID WHERE 1";

		$order_column=array("b.CODE_BUDGETISATION","c.CATEGORIE_DESC","b.COUT_TOTAL","b.DATE_BUDGET","CONCAT(e.NOM_EMP,' ',e.PRENOM_EMP)","(CASE  WHEN b.STATUT_BUDGET=1 THEN 'En attente de validation' WHEN b.STATUT_BUDGET=2 THEN 'Validée' WHEN b.STATUT_BUDGET=3 THEN 'Clôturée' WHEN b.STATUT_BUDGET=4 THEN 'Annulée' END)","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY b.BUDGETISATION_ID  DESC';


		$search = !empty($_POST['search']['value']) ? (" AND  (c.CATEGORIE_DESC LIKE '%$var_search%' OR b.COUT_TOTAL LIKE '%var_search%' OR b.DATE_BUDGET LIKE '%$var_search%' OR CONCAT(e.NOM_EMP,' ',e.PRENOM_EMP) LIKE '%$var_search%' OR (CASE  WHEN b.STATUT_BUDGET=1 THEN 'En attente de validation' WHEN b.STATUT_BUDGET=2 THEN 'Validée' WHEN b.STATUT_BUDGET=3 THEN 'Clôturée' WHEN b.STATUT_BUDGET=4 THEN 'Annulée' END) LIKE '%$var_search%' OR b.CODE_BUDGETISATION LIKE '%$var_search%' ) ") : '';


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

			$statut='';

			if ($row->STATUT_BUDGET==1) {
				# code...
				$statut='<span class="badge bg-primary">'.$row->LIGNE_STAT.'</span>';
			}elseif ($row->STATUT_ID==2) {
				# code...
				$statut='<span class="badge bg-success">'.$row->LIGNE_STAT.'</span>';
			}elseif ($row->STATUT_BUDGET==3){

				$statut='<span class="badge bg-info">'.$row->LIGNE_STAT.'</span>';
			}elseif ($row->STATUT_BUDGET==4) {
				# code...
				$statut='<span class="badge bg-danger">'.$row->LIGNE_STAT.'</span>';
			}




			$sub_array[] = $row->CODE_BUDGETISATION;
			$sub_array[] = $row->CATEGORIE_DESC;
			$sub_array[] = number_format($row->COUT_TOTAL,0,' ',' ');
			$sub_array[] = date('d-m-Y H:i:s',strtotime($row->DATE_BUDGET));
			$sub_array[] = $row->EMPLOYE;
			$sub_array[] = $statut;

			$sub_array[]='<a href="'.base_url('donnees/Budgetisation/detail_view/'.$row->STATUT_BUDGET.'/'.$row->BUDGETISATION_ID).'" class="action-icon" title="Voir"> <i class="mdi mdi-eye"></i></a>';

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





	function add_cart_budgetisation($CAT_MAT_ID)
	{
		
		
		$this->_validate();

		$QTE_UNITE=$this->input->post('QTE_UNITE'.$CAT_MAT_ID);
		$COUT_UNITAIRE=$this->input->post('COUT_UNITAIRE'.$CAT_MAT_ID);
		$CATEGORIE_ID=$this->input->post('CATEGORIE_ID'.$CAT_MAT_ID);

		$cout_total=0;


		$data_cat=array(
			'id'=>$CAT_MAT_ID,
			'qty'=>1,
			'price'=>1,
			'name'=>'T',
			'COUT_UNITAIRE'=>$COUT_UNITAIRE,
			'CATEGORIE_ID'=>$CATEGORIE_ID,
			'CAT_MAT_ID'=>$CAT_MAT_ID,
			'QTE_UNITE'=>$QTE_UNITE,
			'typecartitem'=>'CAT_BUDGET'
		);



		$this->cart->insert($data_cat);

		// $content="";
		$j=1;
		$i=0;

		$content='
		<div class="border p-3 mt-4 mt-lg-0 rounded">
		<h4 class="header-title mb-3">Résumé de la budgétisation</h4>

		<div class="table-responsive">
		<table class="table mb-0">
		<tbody>
		<tr>
		<th>DESIGNATION</th>
		<th>QTE</th>
		<th>COUT UNITAIRE</th>
		<th></th>
		</tr>
		</thead>
		<tbody>';
		foreach ($this->cart->contents() as $items):



			$cat_mat=$this->Model->getRequeteOne("SELECT
				mat.CAT_MAT_ID,
				CONCAT(mat.DESC_CAT_MAT,'<br>Unité:<b>',u.UNITE_DESC,'</b>')DESC_CAT_MAT
				FROM
				cat_materiel mat
				JOIN unites u ON u.UNITE_ID=mat.UNITE_ID
				WHERE
				mat.IS_ACTIF=1 AND mat.CAT_MAT_ID=".$items['CAT_MAT_ID']);



			if (preg_match('/CAT_BUDGET/',$items['typecartitem'])) 
			{

				$content.='<tr>
				<td>'.$cat_mat['DESC_CAT_MAT'].'</td>
				<td>'.$items['QTE_UNITE'].'</td>
				<td>'.$items['COUT_UNITAIRE'].'</td>
				<td style="width: 5px;">
				<input type="hidden" id="rowid'.$j.'" value='.$items['rowid'].'>
				<a href="javascript:void(0);" class="action-icon" style="color:red;" onclick="remove_ct('.$j.')"><i class="mdi mdi-delete"></i></a>
				</tr>';


			}

			$cout_total+=$items['COUT_UNITAIRE']*$items['QTE_UNITE'];


			$j++;
			$i++;

		endforeach;
		$content.=' </tbody>
		</table>
		</div>
		<!-- end table-responsive -->
		<br><br>
		<a href="'.base_url('donnees/Budgetisation/index').'" class="btn btn-danger">Annuler</a>
		<button type="button" id="btnValideCart" onclick ="save()" class="btn btn-info">Enregistrer</button>
		</div>
		</div>';

		$nbre=sizeof($this->cart->contents());
		
		if (!empty($content)) {
			# code...
			echo json_encode(array('status'=>true,'cout_total'=>number_format($cout_total,0,' ',' '),'nbre'=>$nbre,'message'=>"Un élément a été bien ajouté",'content'=>$content));
		}
		

	}



	function remove_ct()
	{
		$rowid=$this->input->post('rowid');
		$this->cart->remove($rowid);
		$cout_total=0;
			// $content="";
		$j=1;
		$i=0;

		$content='
		<div class="border p-3 mt-4 mt-lg-0 rounded">
		<h4 class="header-title mb-3">Résumé de la budgétisation</h4>

		<div class="table-responsive">
		<table class="table mb-0">
		<tbody>
		<tr>
		<th>DESIGNATION</th>
		<th>QTE</th>
		<th>COUT UNITAIRE</th>
		<th></th>
		</tr>
		</thead>
		<tbody>';
		foreach ($this->cart->contents() as $items):



			$cat_mat=$this->Model->getRequeteOne("SELECT
				mat.CAT_MAT_ID,
				CONCAT(mat.DESC_CAT_MAT,'<br>Unité:<b>',u.UNITE_DESC,'</b>')DESC_CAT_MAT
				FROM
				cat_materiel mat
				JOIN unites u ON u.UNITE_ID=mat.UNITE_ID
				WHERE
				mat.IS_ACTIF=1 AND mat.CAT_MAT_ID=".$items['CAT_MAT_ID']);



			if (preg_match('/CAT_BUDGET/',$items['typecartitem'])) 
			{

				$content.='<tr>
				<td>'.$cat_mat['DESC_CAT_MAT'].'</td>
				<td>'.$items['QTE_UNITE'].'</td>
				<td>'.$items['COUT_UNITAIRE'].'</td>
				<td style="width: 5px;">
				<input type="hidden" id="rowid'.$j.'" value='.$items['rowid'].'>
				<a href="javascript:void(0);" class="action-icon" style="color:red;" onclick="remove_ct('.$j.')"><i class="mdi mdi-delete"></i></a>
				</tr>';


			}
			$cout_total+=$items['COUT_UNITAIRE']*$items['QTE_UNITE'];

			$j++;
			$i++;

		endforeach;
		$content.=' </tbody>
		</table>
		</div>
		<!-- end table-responsive -->
		<br><br>
		<a href="'.base_url('donnees/Budgetisation/index').'" class="btn btn-danger">Annuler</a>
		<button type="button" id="btnValideCart" onclick ="save()" class="btn btn-info">Enregistrer</button>
		</div>
		</div>';
		

		$nbre=sizeof($this->cart->contents());


		if (!empty($content)) {
			# code...
			echo json_encode(array('status'=>true,'cout_total'=>number_format($cout_total,0,' ',' '),'nbre'=>$nbre,'message'=>"Un élément a été bien ajouté",'content'=>$content));
		}
		

	}




	function save()
	{

		$indicator = ($this->cart->contents()) ? 1 : 0 ;

		
		$CATEGORIE_ID=$this->input->post('CATEGORIE_ID');
		$DATE_BUDGET=date('Y-m-d H:i:s');
		

		$CODE_BUDGETISATION='BUDG-'.date('Y')/*(sizeof($get_rows)<2)? sizeof($get_rows)+1 : sizeof($get_rows)*/;
		#create code number
		$CODE_REF='';
		if ($indicator>0) {
			# code...
			$BUDGETISATION_ID=$this->Model->insert_last_id('budgetisation',array('DATE_BUDGET'=>$DATE_BUDGET,'USER_ID'=>$this->session->userdata('EMPLOYE_ID'),'CATEGORIE_ID'=>$CATEGORIE_ID,'DATE_BUDGET'=>$DATE_BUDGET,'CODE_BUDGETISATION'=>$CODE_BUDGETISATION));

			$CODE_REF=$CODE_BUDGETISATION.$BUDGETISATION_ID;

			

		} else {
			# code...
			$BUDGETISATION_ID='';
		}
		


		$COUT_TOTAL=0;


		foreach ($this->cart->contents() as $value) {
			# code...

			$cat_mat=$this->Model->getOne('cat_materiel',array('CAT_MAT_ID'=>$value['CAT_MAT_ID']));

			$data_detail=array(
				'CAT_MAT_ID'=>$value['CAT_MAT_ID'],
				'QTE_UNITE'=>$value['QTE_UNITE'],
				'COUT_UNITAIRE'=>$value['COUT_UNITAIRE'],
				'BUDGETISATION_ID'=>$BUDGETISATION_ID
			);

			if ($data_detail) {
				# code...
				$this->Model->create('budgetisation_detail',$data_detail);
			}

			$COUT_TOTAL+=$value['QTE_UNITE']*$value['COUT_UNITAIRE'];



			
		}

		if ($indicator>0) {
			# code...
			$this->Model->update('budgetisation',array('BUDGETISATION_ID'=>$BUDGETISATION_ID),array('CODE_BUDGETISATION'=>$CODE_REF,'COUT_TOTAL'=>$COUT_TOTAL));
		}
		


		echo json_encode(array('status'=>true,'id'=>$BUDGETISATION_ID,'message'=>"Vous venez d'effectuer une opération ".$CODE_REF." avec succès."));

	}



	function detail($CATEGORIE_ID)
	{


		$unit="";
		$query_unit=$this->Model->getRequete("SELECT `UNITE_ID`, `UNITE_DESC` FROM `unites` WHERE 1 ORDER by UNITE_DESC ASC");

		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$query_principal="SELECT
		mat.CAT_MAT_ID,
		CONCAT(mat.DESC_CAT_MAT,'<br>Unité:<b>',u.UNITE_DESC,'</b>') DESC_CAT_MAT
		FROM
		cat_materiel mat
		JOIN categories c ON
		c.CATEGORIE_ID = mat.CATEGORIE_ID
		JOIN unites u ON
		u.UNITE_ID = mat.UNITE_ID
		WHERE
		c.STATUT = 1 AND mat.IS_ACTIF = 1 and c.CATEGORIE_ID=".$CATEGORIE_ID;

		$order_column=array("CONCAT(mat.DESC_CAT_MAT,'<br>Unité:<b>[',u.UNITE_DESC,']</b>')","mat.CAT_MAT_ID","mat.CAT_MAT_ID","mat.CAT_MAT_ID");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : 'ORDER  BY mat.DESC_CAT_MAT  DESC';

		$search = !empty($_POST['search']['value']) ? (" AND  (CONCAT(mat.DESC_CAT_MAT,'<br>Unité:<b>[',u.UNITE_DESC,']</b>') LIKE '%$var_search%') ") : '';

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

			$sub_array[] = "<input type='hidden' name='CAT_MAT_ID".$row->CAT_MAT_ID."' value='".$row->CAT_MAT_ID."' id='CAT_MAT_ID".$row->CAT_MAT_ID."'>".$row->DESC_CAT_MAT;
			$sub_array[] = '<input type="number" min="1" name="QTE_UNITE'.$row->CAT_MAT_ID.'" id="QTE_UNITE'.$row->CAT_MAT_ID.'" class="form-control"
			placeholder="Qté" style="width: 90px;">';
			$sub_array[] = '<input type="number" min="1" name="COUT_UNITAIRE'.$row->CAT_MAT_ID.'" id="COUT_UNITAIRE'.$row->CAT_MAT_ID.'" class="form-control"
			placeholder="Coût unitaire" style="width: 110px;">';
			$sub_array[] = '
			<button class="btn btn-info" id="btnAddCart'.$row->CAT_MAT_ID.'" onclick="add_cart_budgetisation('.$row->CAT_MAT_ID.')" type="button"><span class="mdi mdi-database-plus" title="Ajouter"></span></button>
			';

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

	function detail_view($STATUT_BUDGET,$BUDGETISATION_ID)
	{
		$buttons='';
		for($i=1;$i<=2;$i++)
		{
			$class = ($i==1) ? 'btn btn-danger' : 'btn btn-success' ;
			$class_i = ($i==1) ? '<i class="mdi mdi-window-close"></i>' : '<i class="dripicons-checkmark"></i>' ;
			$label = ($i==1) ? 'Annuler' : 'Valider' ;
			$buttons.='<button class="'.$class.'" id="btnValidate'.$i.'" onclick="validateBudgetisatio('.$i.','.$BUDGETISATION_ID.')" type="button">'.$class_i.' '.$label.'</button>	';

		}

		$info=$this->Model->getRequeteOne("SELECT
			`BUDGETISATION_ID`,
			`CODE_BUDGETISATION`,
			`CATEGORIE_ID`,
			`COUT_TOTAL`,
			`DATE_BUDGET`,
			`USER_ID`,
			`STATUT_BUDGET`,
			OBSERVATION_TRAITEMENT
			FROM
			`budgetisation`
			WHERE
			BUDGETISATION_ID =".$BUDGETISATION_ID);

		$data['page_title']=($info['STATUT_BUDGET']==1) ? 'Validation de la budgétisation' : 'Consultation';
		$data['breadcrumbs'] = '<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light-lighten p-2 mb-0">
		<li class="breadcrumb-item"><a href="'.base_url('donnees/Budgetisation/index').'"><i class="dripicons-view-apps"></i>'.$info['CODE_BUDGETISATION'].'</a></li>
		<li class="breadcrumb-item"><a href="#">'.date('d-m-Y H:i:s',strtotime($info['DATE_BUDGET'])).'</a></li>
		</ol>
		</nav>';

		$data['info']=$info;
		$data['buttons']=$buttons;

		$data['BUDGETISATION_ID']=$BUDGETISATION_ID;

		$this->load->view('Budgetisation_detail_view',$data);



	}




	function _validate()
	{
		$data=array();
		$data['error_string']=array();
		$data['inputerror']=array();
		$data['status']=true;

		$CAT_MAT_ID=$this->input->post('CAT_MAT_ID');
		$QTE_UNITE=$this->input->post('QTE_UNITE'.$CAT_MAT_ID);
		$COUT_UNITAIRE=$this->input->post('COUT_UNITAIRE'.$CAT_MAT_ID);


		if ($QTE_UNITE==null) {
			# code...
			$data['error_string'][]="Veuillez saisir la quantité";
			$data['inputerror'][]=$QTE_UNITE;
			$data['status']=false;
		}

		if (empty($COUT_UNITAIRE)) {
			# code...
			$data['error_string'][]="Veuillez saisir le coût unitaire";
			$data['inputerror'][]=$COUT_UNITAIRE;
			$data['status']=false;
		}



		if ($QTE_UNITE<1) {
			# code...
			$data['error_string'][]="La valeur invalide!";
			$data['inputerror'][]="QTE_UNITE".$CAT_MAT_ID;
			$data['status']=false;
		}



		if ($data['status']==false) 
		{
 			# code...
			echo json_encode($data);
			exit();
		}

	}









}

?>