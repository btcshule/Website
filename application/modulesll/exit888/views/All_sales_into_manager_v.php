
<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'templates/header.php' ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Navbar -->
		<?php include VIEWPATH.'templates/navbar.php' ?>
		<!-- /.navbar -->
		<!-- Sidebar Menu -->
		<?php include VIEWPATH.'templates/menu.php' ?>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h5 class="m-0"> <b>All Sales and  paid commands</b></h5>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">All bills</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body" style="overflow-x: auto;">
							<?= $this->session->flashdata('message'); ?>
							<br>
							<div class="col-lg-12 col-md-12" style=" font-size: 12px;font-display: bold;"> 
							</div>
							<div style="padding-top: 5px;" class="col-md-12">
								<table id='mytable' class="table table-bordered table-striped table-condensed" style="width: 100%;">
									<thead>
										<tr>
											<th>#</th>
											<th>Date&nbsp;action</th>
											<th>Invoice&nbsp;No</th>
											<th>Client&nbsp;Name</th>
											<th>Total&nbsp;Amount</th>
											<th>Amount&nbsp;debts</th>
											<th>Facture</th>
										</tr>
									</thead>

								</table>


							</div>


						</div>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include VIEWPATH.'templates/footer.php' ?>
</body>
</html>
<script type="text/javascript">
	$('#message').delay('slow').fadeOut(3000);
</script>
<script>
	var table;
	var save_method;
	$(document).ready(function() {

		var row_count = "1000000";
		table = $("#mytable").DataTable({
			"processing": true,
			"destroy": true,
			"serverSide": true,
			"oreder": [
				[0, 'desc']
				],
			"ajax": {
				url: "<?= base_url() ?>index.php/exit/All_sales_into_manager/listing",
				type: "POST"
			},
			lengthMenu: [
				[5,10, 50, 100, row_count],
				[5,10, 50, 100, "All"]
				],
			pageLength: 5,
			"columnDefs": [{
				"targets": [],
				"orderable": false
			}],

			dom: 'Bfrtlip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
				],
			language: {
				"sProcessing": "Traitement en cours...",
				"sSearch": "Rechercher&nbsp;:",
				"sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
				"sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				"sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
				"sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
				"sInfoPostFix": "",
				"sLoadingRecords": "Chargement en cours...",
				"sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
				"sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
				"oPaginate": {
					"sFirst": "Premier",
					"sPrevious": "Pr&eacute;c&eacute;dent",
					"sNext": "Suivant",
					"sLast": "Dernier"
				},
				"oAria": {
					"sSortAscending": ": activer pour trier la colonne par ordre croissant",
					"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
				}
			}

		});
	});
</script>
