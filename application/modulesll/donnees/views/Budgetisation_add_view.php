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
    <!-- ============================================e================== -->

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
                  <?=$breadcrumbs?>
                <form id="fbudget">
                  <input type="hidden" id="CATEGORIE_ID" value="<?=$CATEGORIE_ID?>" name="CATEGORIE_ID">
                </form>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Coût total</label>
                        <input type="text" disabled="" class="form-control" name="COUT_TOTAL" id="COUT_TOTAL">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Fait par</label>
                        <input type="text" class="form-control" readonly="" value="<?=$this->session->userdata('EMPLOYE')?>" >
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-7">
                    <table id="mytable" class="table table-striped dt-responsive nowrap w-100">
                      <thead>
                        <tr>
                          <th>DESIGNATION</th>
                          <th>QTE</th>
                          <th>COUT UNITAIRE</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                  <div class="col-md-5" id="CONTENU_CART">
                    <div id="SHOW_CART"></div>
                  </div>
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


    var default_value=$('#COUT_TOTAL').val();

    if(default_value){
      $('#COUT_TOTAL').val(10);
    }else{
       $('#COUT_TOTAL').val(0);
    }

    liste();

   $("textarea").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });

   $("select").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });



 });



function liste()
{

  var CATEGORIE_ID=<?=$CATEGORIE_ID?>;

  var row_count ="1000000";   
   table=$("#mytable").DataTable({
    "processing":true,
    "serverSide":true,
    "destroy":true,
    "order":[],
    "ajax":{
      url:"<?php echo base_url('donnees/Budgetisation/detail/')?>"+CATEGORIE_ID,
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
}


</script>

<script>
 function add_cart_budgetisation(CAT_MAT_ID=null)
 {

  var url;
  
  var QTE_UNITE=parseFloat($('#QTE_UNITE'+CAT_MAT_ID).val());
  var COUT_UNITAIRE=$('#COUT_UNITAIRE'+CAT_MAT_ID).val();
  var CATEGORIE_ID=<?=$CATEGORIE_ID?>;

  var budget=new FormData();

  budget.append('QTE_UNITE'+CAT_MAT_ID,QTE_UNITE);
  budget.append('COUT_UNITAIRE'+CAT_MAT_ID,COUT_UNITAIRE);
  budget.append('CAT_MAT_ID',CAT_MAT_ID);
  budget.append('CATEGORIE_ID',CATEGORIE_ID);

  // alert(QTE_ENTREE+'/'+PU+'/'+FOURN_ID+'/'+DATE_APPROV);


  $('#btnAddCart'+CAT_MAT_ID).html('Chargement...');
  $('#btnAddCart'+CAT_MAT_ID).attr("disabled",true);
  url="<?php echo base_url('donnees/Budgetisation/add_cart_budgetisation/')?>"+CAT_MAT_ID;

  $.ajax({

    url:url,
    type:"POST",
    data:budget,
    contentType:false,
    processData:false,
    dataType:"JSON",
    success: function(data)
    {
     if(data.status) 
     {
      $('#btnAddCart'+CAT_MAT_ID).attr("disabled",true);
      // liste();

      $('#COUT_TOTAL').val(data.cout_total);

      alert_toast_validation('Opération',data.message,'success');

      $('#QTE_UNITE'+CAT_MAT_ID).val('');
      $('#COUT_UNITAIRE'+CAT_MAT_ID).val('');


      $('#CONTENU_CART').show();
      SHOW_CART.innerHTML=data.content;
      $('#SHOW_CART').html(data.content);

    }
    else
    {
      for (var i = 0; i < data.inputerror.length; i++) 
      {
        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
        // liste();


        alert_toast_validation('Opération',data.error_string[i],'error');
      }
    }

    $('#btnAddCart'+CAT_MAT_ID).html('<span class="mdi mdi-database-plus"></span>');
    $('#btnAddCart'+CAT_MAT_ID).attr('disabled',false); 


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

   $('#btnAddCart'+CAT_MAT_ID).html('<span class="mdi mdi-database-plus"></span>');
   $('#btnAddCart'+CAT_MAT_ID).attr('disabled',false);

 }


});

}
</script>


<script>

  function remove_ct(id)
  {
    var rowid=$('#rowid'+id).val();

    // alert(rowid)

    var cat_mat_del=new FormData();
    cat_mat_del.append('rowid',rowid);
    $.ajax(
    { 
      url:"<?=base_url('donnees/Budgetisation/remove_ct')?>",
      data:cat_mat_del,
      type:"POST",
      contentType:false,
      processData:false,
      dataType:"JSON",
      success:function(data)
      {

        // alert(data.nbre)
        $('#COUT_TOTAL').val(data.cout_total);
        alert_toast_validation('Opération',data.message,'success');
        if (data.nbre==0) {

          $('#CONTENU_CART').hide();
        }else{
          SHOW_CART.innerHTML=data.content;
          $('#SHOW_CART').html(data.content);
          
        }

        

        
      }

    })

  }
  


</script>


<script>
  function save()
  {
   $('#btnSave').html('<button class="btn btn-info" type="button"><span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>Chargement...</button>');
   $('#btnSave').attr("disabled",true);

   var formData = new FormData($('#fbudget')[0]);

   var url;
   url="<?php echo base_url('donnees/Budgetisation/save')?>";
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
      alert_toast_validation('Opération',data.message,'success');
      if (data.id) {
        window.location.href="<?=base_url('donnees/Budgetisation/index')?>";
      }


    }

    $('#btnSave').text('Enregistrer');
    $('#btnSave').attr('disabled',false); 


  },
  error: function (jqXHR, textStatus, errorThrown)
  {
    alert('Erreur s\'est produite');
    $('#btnSave').text('Valider');
    $('#btnSave').attr('disabled',false);

  }


});
 }
</script>
















