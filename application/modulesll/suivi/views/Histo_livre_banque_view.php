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
					<div class="row" style="background-color: white">
						<div class="col-12">
							<div class="page-title-box">
								<div class="page-title-right">
									 <?=$breadcrumbs?> 
								</div>
								<h4 class="page-title"><?=$page_title?></h4>
							</div>
						</div>
					</div>  
				</div>
				<!-- Inline Form -->
				<div class="row">
					<div class="col-md-12" style="background-color: white">
						<div class="card">
							<div class="card-body">
								<!-- <div class="row mb-2">
									<div class="col-sm-5">
										<a href="javascript:void(0);" onclick="new_record()" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Nouvelle</a>
									</div>
								</div>  -->
								<div class="col-md-12 row">
								<div class="col-md-8"><h3>Mois de: <?= date('m-Y') ?></h3>
								</div></div>
								<table id="mytable" class="table table-striped dt-responsive nowrap w-100 table-responsive">
									<thead>
										<tr>
											<th>No</th>
											<th>Date</th>
											<th>Libellé</th>
											<th>Imputation</th>
											<th>Débit</th>
											<th>Crédit</th>
											<th>Solde</th>
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



<div class="rightbar-overlay"></div>

<?php include VIEWPATH . 'includes/foot.php'; ?>

</body>

</html>


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
				url:"<?php echo base_url('index.php/suivi/Histo_livre_banque/liste')?>",
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

	function supp_logic(id, is_actif) {
		let message;

		if (is_actif == 1) {
			message = "Voulez-vous désactiver ?";
		} else {
			message = "Voulez-vous activer ?";
		}

		if (confirm(message)) {
			$.ajax({
				url: "<?php echo base_url('index.php/suivi/Histo_livre_banque/del')?>/" + id + '/' + is_actif,
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
