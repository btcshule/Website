<!DOCTYPE html>
<html lang="en">

<head>
	<?php include VIEWPATH . 'includes/head.php'; ?>

</head>


<body class="show" data-layout-config="{&quot;leftSideBarTheme&quot;:&quot;dark&quot;,&quot;layoutBoxed&quot;:false, &quot;leftSidebarCondensed&quot;:false, &quot;leftSidebarScrollable&quot;:false,&quot;darkMode&quot;:false, &quot;showRightSidebarOnStart&quot;: true}" data-leftbar-theme="dark" style="visibility: visible;">
	<!-- Begin page -->
	<div class="wrapper">
		<!-- ========== Left Sidebar Start ========== -->
		<?php include VIEWPATH . 'includes/menu.php'; ?>
		<!-- Left Sidebar End -->

		<!-- ============================================================== -->
		<!-- Start Page Content here -->
		<!-- ============================================================== -->

		<div class="content-page">
			<div class="content">
				<!-- Topbar Start -->
				<?php include VIEWPATH . 'includes/topbar.php'; ?>
				<!-- end Topbar -->
				<!-- Start Content-->
				<div class="container-fluid">
					<!-- start page title -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<div class="page-title-right">
									<!-- <?=$breadcrumbs?> -->
								</div>
								<h4 class="page-title"><?=$page_title?></h4>
							</div>
						</div>
					</div>  
				</div>
				<!-- Inline Form -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="row mb-2">
									<div class="col-sm-5">
										<a href="javascript:void(0);" onclick="new_record()" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Nouveau</a>
									</div>
								</div> 
								<table id="mytable" class="table table-striped dt-responsive nowrap w-100 table-responsive">
									<thead>
										<tr>
											<th>No</th>
											<th>Date</th>
											<th>Libellé</th>
											<th>Quantité</th>
											<th>Prix&nbsp;Unitaire</th>
											<th>Prix&nbsp;Total</th>
											<th>Client</th>
											<th>Statut</th>
											<th>Responsable</th>
											<th>Action</th>
										</tr>
									</thead>
								</table>
							</div> <!-- end card-body -->
						</div> <!-- end card -->
					</div> <!-- end col -->
				</div>
				<!-- end row -->
			</div> <!-- container -->
		</div> <!-- content -->

		<!-- Footer Start -->
		<footer class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<script>
							document.write(new Date().getFullYear())
						</script>
						<!-- 2021 © Hyper - Coderthemes.com -->
					</div>

				</div>
			</div>
		</footer>
		<!-- end Footer -->

	</div>

	<!-- ============================================================== -->
	<!-- End Page content -->
	<!-- ============================================================== -->


</div>
<!-- END wrapper -->


<div class="rightbar-overlay"></div>
<!-- /End-bar -->


<!-- bundle -->
<?php include VIEWPATH . 'includes/foot.php'; ?>

</body>

</html>


<script>
	function new_record(){
		save_method=="add"
		$('#emp_form')[0].reset();
		$('#emp-modal').modal('show');
		$('.modal-title').text('Nouveau');
	}
</script>


<script>
	var save_method;
	var table;
	$(document).ready(function() {
		var row_count ="1000000";   
		table=$("#mytable").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"<?php echo base_url('index.php/donnees/Ventes/liste')?>",
				type:"POST"
			},
			lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
			pageLength: 10,
			"columnDefs": [
			{ 
				"targets": [-1],
				"orderable": false,
			},
			{ 
				"targets": [ -1 ], 
				"orderable": false, 
			},
			]

			,

			dom: 'Bfrtlip',
			buttons: [],
			language: {
				"sProcessing":     "Traitement en cours...",
				"sSearch":         "Rechercher&nbsp;:",
				"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
				"sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				"sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
				"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
				"sInfoPostFix":    "",
				"sLoadingRecords": "Chargement en cours...",
				"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
				"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
				"oPaginate": {
					"sFirst":      "Premier",
					"sPrevious":   "Pr&eacute;c&eacute;dent",
					"sNext":       "Suivant",
					"sLast":       "Dernier"
				},
				"oAria": {
					"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
					"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
				}
			}

		});


		$("input").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("select").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
	});
</script>

<script>
	function enr()
	{
		var DATE_VENTE=$('#DATE_VENTE').val();
		var ID_CLIENT=$('#ID_CLIENT').val();
		var DESIGNATION=$('#DESIGNATION').val();
		var QUANTITE=$('#QUANTITE').val();
		var PU=$('#PU').val();

		var statut = true;
		if (DATE_VENTE=="") {
			$("#errDATE_VENTE").html("Le champ est obligatoire");
			statut=false;
		}else{
			$("#errDATE_VENTE").html("");
		}

		if (ID_CLIENT=="") {
			$("#errID_CLIENT").html("Le champ est obligatoire");
			statut=false;
		}else{
			$("#errID_CLIENT").html("");
		}
		if (DESIGNATION=="") {
			$("#errDESIGNATION").html("Le champ est obligatoire");
			statut=false;
		}else{
			$("#errDESIGNATION").html("");
		}
		if (QUANTITE=="") {
			$("#errQUANTITE").html("Le champ est obligatoire");
			statut=false;
		}else{
			$("#errQUANTITE").html("");
		}
		if (PU=="") {
			$("#errPU").html("Le champ est obligatoire");
			statut=false;
		}else{
			$("#errPU").html("");
		}
		if (statut==true) {
			$('button').text('Enregistrement ...');
			$('#button').attr("disabled",true);

			var url;
			var ID_VENTE=$('#ID_VENTE').val();
			// alert (ID_VENTE);


				url="<?php echo base_url('index.php/donnees/Ventes/ajouter')?>";
			
		
			var formData = new FormData($('#emp_form')[0]);

			$.ajax({

				url:url,
				type:"POST",
				data:formData,
				contentType:false,
				processData:false,
				dataType:"JSON",
				success: function(data)
				{
					if(data.status) 
					{
						$('#emp-modal').modal('hide');
						table.ajax.reload(null,false);
					}
					else
					{
						for (var i = 0; i < data.inputerror.length; i++) 
						{
							$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
							$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
						}
					}

					$('button').text('Enregistrer');
					$('button').attr('disabled',false); 


				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					if (jqXHR.status==0) 
					{
						alert('Vous n\'êtes pas connecté à l\'internet,vérifier votre connexion! ');
					}else{
						if (errorThrown.status)
						{
							alert('Erreur s\'est produite');
						}
					}
					$('#btnSaved').attr('disabled',false);
				}
			});
		}
	}




	function edit_emp(id)
	{
		save_method = 'update';
		$('#emp_form')[0].reset();
		$('#emp-modal').modal('show');
		$.ajax({
			url : "<?php echo site_url('index.php/donnees/Ventes/getOne')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{


				$('[name="DATE_VENTE"]').val(data.DATE_VENTE);
				$('[name="ID_CLIENT"]').val(data.ID_CLIENT); 
				$('[name="DESIGNATION"]').val(data.DESIGNATION); 
				$('[name="QUANTITE"]').val(data.QUANTITE); 
				$('[name="PU"]').val(data.PU); 
				$('[name="ID_VENTE"]').val(data.ID_VENTE); 
				$('.modal-title').text('Modifier'); 
				$('#btnSaved').text('Modifier');


			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				if (jqXHR.status==0) 
				{
					alert('Vous n\'êtes pas connecté à l\'internet,vérifier votre connexion! ');
				}else{
					if (errorThrown.status)
					{
						alert('Erreur s\'est produite');
					}
				}
			}
		});



	}



	function supp_logic(id, is_actif) {
		let message;

		if (is_actif == 1) {
			message = "Voulez-vous désactiver ?";
		} else {
			message = "Voulez-vous activer ?";
		}

		if (confirm(message)) {
			$.ajax({
				url: "<?php echo base_url('index.php/donnees/Ventes/del')?>/" + id + '/' + is_actif,
				type: "POST",
				dataType: "JSON",
				success: function(data) {
					if (data.status) {
						alert("Opération réussie");
					} else {
						alert("Erreur : " + data.message);
					}
					table.ajax.reload(null, false);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					if (jqXHR.status == 0) {
						alert("Vous n'êtes pas connecté à l'internet, vérifiez votre connexion !");
					} else {
						if (errorThrown.status) {
							alert("Une erreur s'est produite");
						}
					}
				}
			});
		}
	}
</script>







<div id="emp-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-colored-header text-dark">
				<h4 class="modal-title" id="info-header-modalLabel">Modal Heading</h4>
				<a type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></a>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<form id="emp_form" method="POST">
							<div class="form-body">
								<input type="hidden" name="ID_ACHAT" id="ID_ACHAT">
								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<div class="mb-3">
												<label class="form-label">Date<span style="color: red;">*</span></label>
												
												<input type="date" autocomplete="off" name="DATE_ACHAT" class="form-control" id="DATE_ACHAT" autofocus>
												<span class="text-danger" id="errDATE_ACHAT"></span>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<div class="mb-3">
												<label class="form-label">Client<span style="color: red;">*</span></label>
												<select class="form-control select2" name="ID_CLIENT" id="ID_CLIENT"
												onchange="changemode()">
												<option value="">--Sélectionner--</option>
												<?php 
												foreach ($client as  $value) {?>
													<option value="<?=$value['ID_CLIENT'] ?>" selected><?=$value['NOM_CLIENT'].' '.$value['PRENOM_CLIENT'];?></option>
												<?php  }  ?>
												<!-- <option value="0">Autres</option> -->

											</select>
											<span class="text-danger" id="errID_CLIENT"></span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<label>Cathégorie</label>
									<select name="UNITE_MESURE" id="UNITE_MESURE" class="form-control select2" onchange="getdesignations()">

										<option value="">---Séléctionner---</option>
										<?php
										foreach($produit as $pro)
										{
											if ($pro['CATH_ID']==set_value('UNITE_MESURE'))
											{
												?>
												<option value="<?=$pro['CATH_ID'] ?>" selected><?=$pro['CATH_DESC']; ?></option>
												<?php
											}
											else
											{
												?>
												<option value="<?= $pro['CATH_ID'] ?>"><?=$pro['CATH_DESC']; ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
								<div class="col-md-6">
									<label>Designation du produit</label>
									<select name="DESIGNATION" id="DESIGNATION" onchange="get_data()" class="form-control select2">

										<option>Select</option>
										<?php
										foreach($produit as $pro)
										{
											if ($pro['PRODUCT_ID']==set_value('DESIGNATION'))
											{
												?>
												<option value="<?=$pro['PRODUCT_ID'] ?>" selected><?=$pro['PRODUCT_DESC']; ?></option>
												<?php
											}
											else
											{
												?>
												<option value="<?= $pro['PRODUCT_ID'] ?>"><?=$pro['PRODUCT_DESC']; ?></option>
												<?php
											}
										}
										?>

									</select>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<div class="mb-3">
											<label class="form-label">Quantité<span style="color: red;">*</span></label>
											<input type="number" autocomplete="off" name="QUANTITE" class="form-control" id="QUANTITE">
											<span class="text-danger" id="errQUANTITE"></span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<div class="mb-3">
											<label class="form-label">Prix Unitaire<span style="color: red;">*</span></label>
											<input type="number" autocomplete="off" name="PU" class="form-control" id="PU">
											<span class="text-danger" id="errPU"></span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<div class="mb-3">
											<label class="form-label">Observation<span style="color: red;">*</span></label>
											<input type="text" autocomplete="off" name="OBSERVATION" class="form-control" id="OBSERVATION">
											<span class="text-danger" id="errOBSERVATION"></span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<div class="mb-3">
											<label class="form-label">Numéro Facture<span style="color: red;">*</span></label>
											<input type="text" autocomplete="off" name="FACTURE" class="form-control" id="FACTURE">
											<span class="text-danger" id="errFACTURE"></span>
										</div>
									</div>
								</div>


							</div>
							<div class="col-md-12">
								<button type="button" id="btnSaved" onclick="enr()" class="btn btn-info">Enregistrer</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				function getdesignations()
				{
					$('#QUANTITEUN').val('');
					$('#QUANTITE').val('');
					$('#PRIX_UNITAIRE').val('');
					var UNITE_MESURE=$('#UNITE_MESURE').val();
					$.ajax(
					{
						url: "<?php echo base_url('index.php/donnees/Ventes/getdesignations/');?>"+UNITE_MESURE,
						type: "POST",
						data: {},
						processData: false,  
						contentType: false,
						success: function(data)
						{
							$('#DESIGNATION').html(data);
						}
					});
				}
			</script>
		</script>