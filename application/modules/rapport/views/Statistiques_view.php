<!DOCTYPE html>
<html lang="en">

<head>
	<?php include VIEWPATH . 'includes/head.php'; ?>

	<style type="text/css">
		.stat {
			border: 2px solid white;
			border-radius: 10px;
			background: linear-gradient(to bottom, #f0f0f0, #d9d9d9);
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			padding: 10px;
			width: calc(25% - 20px); /* Pour avoir 4 cartes sur une ligne */
			margin: 10px;
			display: inline-block;
			transition: transform 0.2s;
		}

		.stat {
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
		}

		.stat:hover {
			transform: scale(1.05); /* Effet de vibration au survol */
			opacity: 0.8; /* Transparence au survol */
		}

		.card-title {
			color: #333; /* Couleur du texte du titre */
			font-weight: bold; /* Gras pour mettre en évidence */
			margin-bottom: 10px; /* Espacement en bas du titre */
		}

		.card-text {
			color: #666; /* Couleur du texte du contenu */
			line-height: 1.4; /* Hauteur de ligne pour une meilleure lisibilité */
		}




		.bar-container {
			display: flex;
			align-items: center;
			margin-bottom: 10px;
		}

		.bar-label {
			width: 100px;
			text-align: right;
			margin-right: 10px;
		}

		.bar {
			height: 20px;
			background-color: #ccc;
			border-radius: 10px;
			overflow: hidden;
		}

		.bar-fill {
			height: 100%;
			background-color: #6c9;
		}

		.stat {
  counter-reset: stat-counter;
}

.stat .card-title::before {
  counter-increment: stat-counter;
  margin-right: 5px;
}

.stat .card-text::before {
  counter-increment: stat-counter;
  margin-right: 5px;
}
	</style>
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
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Cash disponibles</h5>
							<p class="card-text"><?= number_format($soldes['CASH'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Electroniques  disponibles</h5>
							<p class="card-text"><?= number_format($soldee['ELECTRONIQUE'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Caisse Vente</h5>
							<p class="card-text"><?= number_format($ventes['SOLDE'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Caisse Banque</h5>
						<p class="card-text"><?= number_format($banque['SOLDE'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Caisse Approvisionnement</h5>
						<p class="card-text"><?= number_format($appro['SOLDE'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Dettes</h5>
							<p class="card-text"><?= number_format($dettes['somme2'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Créances</h5>
						<p class="card-text"><?= number_format($creances['creance'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Produit en stock</h5>
					<p class="card-text"><?= number_format($stock['produits'], 0, ',', ' ') ?></p>

						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Nos Achats</h5>
					<p class="card-text"><?= number_format($produits_achetes['stocks'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Ventes Marchandises</h5>
						<p class="card-text"><?= number_format($produits_vendus['ventes'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Services vendues</h5>
						<p class="card-text"><?= number_format($services['somme3'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Ventes globalisées</h5>
						<p class="card-text"><?= number_format($total_vente, 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Consommables</h5>
						<p class="card-text"><?= number_format($consommables['CONSOMMABLES'], 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Valeur du stock</h5>
						<p class="card-text"><?= number_format($stock_dispo, 0, ',', ' ') ?></p>
						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Clients actifs</h5>
						<p class="card-text"><?= number_format($clients['somme4'], 0, ',', ' ') ?></p>

						</div>
					</div>
					<div class="stat">
						<div class="card-body">
							<h5 class="card-title">Nos Fournisseurs</h5>
						<p class="card-text"><?= number_format($frss['frss'], 0, ',', ' ') ?></p>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								
					<!-- Ajoutez d'autres contenus ici! -->


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

<script type="text/javascript">
  $( document ).ready(function() {
  get_rapport();
  });

  </script>
 
  <script> 
   function get_rapport(){
    
    var FILTRE=$('#FILTRE').val();
    // alert(FILTRE);

    $.ajax({
      url : "<?=base_url()?>index.php/rapport/Statistiques/index/",
      type : "POST",
      dataType: "JSON",
      cache:false,
        data:{
          FILTRE: FILTRE
         },
     success:function(data){  
  
    $('#container').html("");             
    $('#nouveau').html(data.rapp);
    $('#container1').html("");             
    $('#nouveau1').html(data.rapp1);
    $('#container2').html("");             
    $('#nouveau2').html(data.rapp2);
    $('#container3').html("");             
    $('#nouveau3').html(data.rapp3);

        },            

      });  
    }

  </script> 