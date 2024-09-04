<!DOCTYPE html>
<html lang="en">

<head>
  <?php include VIEWPATH . 'includes/head.php'; ?>
  <style type="text/css">
    label {
      color: white;
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">

          <div id="mytable-container" style="border: 5px solid green; padding: 10px;">
            <center>
              <!-- <h1>
                Valeur du stock disponible: <span id="montant" style=" color: green; padding: 10px; display: inline-block;"><?= number_format($somme['montant'], 0, ',', ' ') ?> BIF</span>
              </h1> -->
            </center>
            <input type="hidden" id="article" name="article" value="<?php echo $article; ?>">
            <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">
            <table id="mytable" class="table table-striped dt-responsive nowrap w-100 table-responsive">
              <thead>
                <tr>
                  <th>Libellé</th>
                  <th>Type</th>
                  <th>Quantité entrée</th>
                  <th>Quantité sortie</th>
                  <th>Responsable</th>
                  <th>Date</th>
               
                </tr>
              </thead>
            </table>
          </div>
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
var save_method;
var table;

$(document).ready(function() {
  var row_count = "1000000";
  var article = "<?php echo $article; ?>";
  var type = "<?php echo $type; ?>";
  // alert(type);

  table = $("#mytable").DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      url: "<?php echo base_url('index.php/stock/Stock_global/info_fiche')?>",
      type: "POST",
      data: {
        article: article,
        type: type
      }
    },
    lengthMenu: [[10, 50, 100, row_count], [10, 50, 100, "All"]],
    pageLength: 10,
    "columnDefs": [
      {
        "targets": [-1],
        "orderable": false,
      },
      {
        "targets": [-1],
        "orderable": false,
      },
    ],
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

  $("input").change(function() {
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });

  $("select").change(function() {
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });
});
</script>

