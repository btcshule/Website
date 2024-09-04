<!DOCTYPE html>
<html lang="en">
<head>
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
  </div>
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0">List of current orders</h5>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Service</li>
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
            <div style="padding-top: 5px;" class="col-md-12">
              <br>
              <div style="padding:3px">
              <table id='mytable' class="table table-responsive table-bordered table-condensed" >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Date&nbsp;action</th>
                    <th>Customer</th>
                    <th>&nbsp;Order</th>
                    <th>Tot.Amount</th>
                    <th>Advance</th>
                    <th>Delivery&nbsp;Date</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Option</th>
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

<?php include VIEWPATH.'templates/footer.php' ?>
</body>
</html>
<script>
  $(document).ready(function(){
    $('#message').delay('slow').fadeOut(7000);
    var row_count ="1000000";
    table=$("#mytable").DataTable({
      "processing":true,
      "destroy" : true,
      "serverSide":true,
      "oreder":[[ 0, 'desc' ]],
      "ajax":{
        url:"<?=base_url()?>exit/Magasin_sales/listes_client/",
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
  });
</script>
<script>
  function get_modal(id)
  {
    $('#ID_FOR_CMD').val(id);
    $('#staticBackdrop').modal('show');
  }
</script>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog xl">
    <div class="modal-content">
      <form id="frmcost" method="POST">

        <div class="modal-body" style="margin-left: 50px;">
          <h3 class="text-primary">Are you sure want to validate?</h3>
          <br>
          <input type="hidden" name="ID_FOR_CMD" id="ID_FOR_CMD" >
          
          <div class="col-lg-12 row"><label>PAY CASH?<span style="color: red;">*</span></label><br>
            <input type="radio" name="colab_etr" id="colab_etr" value="2" onclick="check(value)" checked> &nbsp;YES
            <input type="radio" name="colab_etr" id="colab_etr" value="1" onclick="check(value)">&nbsp;&nbsp;&nbsp;NO
          </div>

          <BR>
          <div class="row" id="div_colab_etr" style="display:none">
            <div class="col-lg-4">
              <label> Specify  debts</label></div>
              <div class="col-lg-6">
                <input type="text" class="form-control" name="DEBTS" id="DEBTS">
              </div>
            </div>
            <br>
            <div class="modal-footer">
              <a  id="idsave" onclick="save_info()" class="btn btn-primary">YES</a>
              <button type="reset" class="btn btn-dark" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>

    </div>
   <script >
      function check(value)
      {
        if(value == 2)
        {
          $('#DEBTS').val('');
          $("#div_colab_etr").hide(); 

        }
        else if (value == 1)
        {
          $("#div_colab_etr").show();
        }
      }

    </script>

<script type="text/javascript">
  $("#DEBTS").on('input paste change keyup', function() {

    $(this).val($(this).val().replace(/[^0-9]*$/gi, ''));
    $(this).val($(this).val().replace(' ', ''));
  });
</script><script >
    function save_info()
    { 
    $('#idsave').attr('disabled',true);  
      var form_data = new FormData($("#frmcost")[0]);
      url = "<?= base_url('index.php/exit/Magasin_sales/affect') ?>";
      $.ajax(
      {
        url: url,
        type: 'POST',
        dataType:'JSON',
        data: form_data ,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data)
        {
          window.location.href='<?=base_url('')?>index.php/exit/Magasin_sales/listes';
        }
      });
    }

  </script>
  