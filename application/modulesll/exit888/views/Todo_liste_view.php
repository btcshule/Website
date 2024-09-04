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
          <h5 class="m-0">Activities report</h5>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Report/liste</li>
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
              <div  style="float: right;">
                <a href="<?=base_url()?>index.php/exit/Todo" style="float: right;margin: 10px" class="btn btn-primary"><i class="fa fa-list" aria-hidden="true"></i> Add new activity</a>  

              </div>
              <?= $this->session->flashdata('message'); ?>
              <BR>
              <div style="padding-top: 5px;" class="col-md-12">
                <table id='mytable' class="table table-bordered table-striped table-condensed text-center" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Date action</th>
                      <th>Activities</th>
                      <th>Client/Entreprise</th>
                      <th>Quantity</th>
                      <th>Delivery date</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $i=0;
                    if (!empty($todo)) {
                      foreach($todo as $key) { 
                        $i++;

                        ?>
                        <tr>
                          <td><?= $i;?></td>
                          <td><?=date('d-m-Y H:i',strtotime($key['DATE_ACTION']))?></td>
                          <td><?=$key['LIBELLE_TODO']?></td>
                          <td><?=$key['CLIENT']?></td>
                          <td><?=$key['QNTY']?></td>
                          <td><?=date('d-m-Y',strtotime($key['DATE_PREV_LIVRAIS']))?></td>
                        </tr>
                        <?php 
                      }
                      // code...
                    }else{

                      ?>

                      <!-- <div class="alert alert-warning alert-dismissible alert-alt solid fade show text-white">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close text-white" style="color:white"></i></span>
                        </button>
                        <strong><i class="fa fa-bell-slash"> You have declared any work today</i></strong>
                      </div> -->
                    <?php } ?>
                  </tbody>
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
<?php include VIEWPATH.'templates/footer.php'; ?>

 <script>
  $(document).ready(function () {
    $("#mytable").DataTable({
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