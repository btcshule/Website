<!DOCTYPE html>
<html lang="en">

<head>
	<?php include VIEWPATH.'includes/header.php' ?>
</head>
<style type="text/css">
 <?php include VIEWPATH.'includes/styledash.css' ?>
</style>
<?php 
$add  ='';
$list ='active';
?>

<body style="font-size:16px">
	<div class="" style="background-color: white">
		<div id="">
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 5px" id="navp">
				<!-- /.navbar-top-links -->
				<?php include VIEWPATH.'includes/menu_principal.php' ?>
				<!-- /.navbar-static-side -->
			</nav>

			<!-- Page Content -->
			<div id="page-wrapper">
				<div class="">
					<div class="row">
						<div class="col-lg-12" style=" margin-bottom: 5px">
							<div class="row" style="" id="conta">
								<?= $breadcrumb ?> 
							</div>
							<div class="row" id="conta" style="margin-top: -10px">
								<div class="col-lg-8 col-md-8">
								<marquee><h4 class=""><b> Materials Inventory</b></h4></marquee>
								</div>
								<div class="col-lg-4 col-md-4" style="padding-bottom: 3px">
									<ul class="nav nav-pills pull-right">

								<li><a style="border:#eda323 solid;color:#eda323" href="<?php echo base_url() ?>index.php/suivi/Materiels"><i class="fa fa-plus"></i> Add Material</a></li>
									</ul>
								</div>
							</div>  
						</div>
						<div class="col-lg-12 jumbotron table-responsive" style="padding: 5px">

							<?=$this->session->flashdata('message')?>   
							
							<?php echo $this->table->generate($ourclient); ?> 
						</div>
						
					</div>
					<!-- /.row -->
					<?php include VIEWPATH.'includes/footer.php' ;?>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->

		</div>
	</div>

</body>

</html>
<script>
	$(document).ready(function () {
		$('#message').delay('slow').fadeOut(4000);
		$("#AllStock").DataTable({
			dom: 'Bfrtlip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
				],
			
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
		$(".dt-buttons").addClass("pull-left");
		$("#table_Cras_paginate").addClass("pull-right");
		$("#table_Cras_filter").addClass("pull-left");
	});

</script>