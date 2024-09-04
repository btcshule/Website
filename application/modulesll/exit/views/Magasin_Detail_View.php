<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'templates/header.php' ?>
</head>
<style type="text/css">
  .jumbotron, #conta{
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    background-color: white;
  }
</style>
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
          <h5 class="m-0">Detail Commande of <?=$CLIENT['NOM_GROS_CLIENT']?></h5>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Detail</li>
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
           <div class="card-body" >
            <div class="col-md-12">
              <div class="float-right">
                <a href="<?= base_url("index.php/exit/Magasin_sales/listes")  ?>"
                  class="btn btn-dark"><i
                  class="fa fa-reply-all"></i>&nbsp&nbspRetour</a>
                </div>
              </div>
              <br>
              <div style="padding-top: 5px;" class="col-md-12">

                <input type="hidden" value="<?= $id ?>" id="ID">
                <br>
                <div >
                  <table id='mytable' class="table  table-bordered table-striped table-hover table-condensed" style="width: 100%;">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>SERVICE</th>
                        <th>QUANTITY</th>
                        <th>PRICE</th>
                        <th>SUBTOTAL</th>
                      </tr>
                    </thead>
                  </table>
                </div>
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
<!-- /.control-sidebar -->
<?php include VIEWPATH.'templates/footer.php' ?>

<!-- Main Footer -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

</body>
</html>
<script>

  $(document).ready(function(){
    detail()
  });

  function detail() {
   var id= $("#ID").val();
//  alert(id);
        // $(document).ready(function(){
   $('#message').delay('slow').fadeOut(7000);
   var row_count ="1000000";
   table=$("#mytable").DataTable({
    "processing":true,
    "destroy" : true,
    "serverSide":true,
    "oreder":[[ 0, 'desc' ]],
    "ajax":{
      url:"<?=base_url()?>index.php/exit/Magasin_sales/detail/"+id,
      type:"POST"
    },
    lengthMenu: [[5,10,50, 100, row_count], [5,10,50, 100, "All"]],
    pageLength: 5,
    "columnDefs":[{
      "targets":[],
      "orderable":false
    }],

    dom: 'Bfrtlip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
      ],
    language: {
      "sProcessing":     "<?=lang('datatable_label_traitement')?>",
      "sSearch":         "<?=lang('datatable_label_recherche')?>",
      "sLengthMenu":     "<?=lang('datatable_label_affichage_1')?> _MENU_ <?=lang('datatable_label_affichage_2')?>",
      "sInfo":           "<?=lang('datatable_label_affichage_start_start')?> _START_ <?=lang('datatable_label_affichage_start_end')?> _END_ <?=lang('datatable_label_affichage_sur')?> _TOTAL_ <?=lang('datatable_label_affichage_start_total')?>",
      "sInfoEmpty":      "<?=lang('datatable_label_affichage_empty_start')?> 0 <?=lang('datatable_label_affichage_empty_end')?> 0 <?=lang('datatable_label_affichage_empty_sur')?> 0 <?=lang('datatable_label_affichage_empty_total')?>",
      "sInfoFiltered":   "(<?=lang('datatable_label_filtrage_max')?> _MAX_ <?=lang('datatable_label_filtrage_total')?>)",
      "sInfoPostFix":    "",
      "sLoadingRecords": "<?=lang('datatable_label_chargement')?>",
      "sZeroRecords":    "<?=lang('datatable_label_aucun')?>",
      "sEmptyTable":     "<?=lang('datatable_label_tableau_disponible')?>",
      "oPaginate": {
        "sFirst":      "<?=lang('datatable_label_premier')?>",
        "sPrevious":   "<?=lang('datatable_label_precedent')?>",
        "sNext":       "<?=lang('datatable_label_suivant')?>",
        "sLast":       "<?=lang('datatable_label_dernier')?>"
      },
      "oAria": {
        "sSortAscending":  ": <?=lang('datatable_label_croissant')?>",
        "sSortDescending": ": <?=lang('datatable_label_decroissant')?>"
      }
    }

  });
   $('input').change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });

   $('select').change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });
//   });
 }

</script>