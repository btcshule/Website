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


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">


                <div class="row mb-2">
                  <?=$breadcrumbs?>
                </div>



                <div class="row">
                  <div class="col-lg-9">
                    <div class="table-responsive">
                      <table id="mytable" class="table table-striped dt-responsive nowrap w-100">
                        <thead class="table-light">
                          <tr>
                            <th>Produits</th>
                            <th>Qté demandée</th>
                            <th>Qté approuvée</th>
                            <th>Mon stock</th>
                            <!-- <th>Statut</th> -->
                            <th style="width:20px;"></th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div> <!-- end table-responsive-->
                  </div>
                  


                  <div class="col-lg-3">
                    <div class="border p-3 mt-4 mt-lg-0 rounded">
                      <h4 class="header-title mb-3">observation sur la budgétisation</h4>

                      <div class="table-responsive" style="font-size: 13px;">
                        <form id="frmValidBudget" action="<?=base_url('donnees/Budgetisation/index')?>" method="POST">
                         <div class="mt-3">
                          <input type="hidden" id="STATUT_BUDGET" name="STATUT_BUDGET">
                          <input type="hidden" value="<?=$BUDGETISATION_ID?>" id="BUDGETISATION_ID" name="BUDGETISATION_ID">

                          <label for="note-textarea" class="form-label">Note:</label>
                          <textarea class="form-control" name="OBSERVATION_TRAITEMENT" id="OBSERVATION_TRAITEMENT" <?=$status = ($info['STATUT_BUDGET']!=1) ? 'readonly=""' : ''?>  rows="6"><?=$info['OBSERVATION_TRAITEMENT']?></textarea>
                        </div>
                        <br>
                        <?php  
                        if ($info['STATUT_BUDGET']==1) {?>
                          <div class="col-md-12">
                            <?=$buttons?>
                          </div> <!-- end row-->
                          <?php 
                        }
                        ?>
                        
                      </form>
                    </div>
                    <!-- end table-responsive -->
                  </div>
                </div> <!-- end col -->

              </div> <!-- end row -->
            </div> <!-- end card-body-->
          </div> <!-- end card-->
        </div> <!-- end col -->
      </div>



      <!-- end row -->

    </div> <!-- container -->

  </div> <!-- content -->
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

   var row_count ="1000000";   
   table=$("#mytable").DataTable({
    "processing":true,
    "serverSide":true,
    "paging": true,
    "searching": true,
    "order":[],
    "ajax":{
      url:"<?php echo base_url('demande/Demande_Stock/get_list_stock_demand_validation/')?>"+<?=$STOCK_DEMANDE_ID?>,
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
      "targets": [ -2 ], 
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



   $("textarea").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });




 });


</script>

<script>
  function validateDemande(a,b)
  {
    // alert(a+'/'+b)

    $('#btnValidate'+a).text('Valider ...');
    $('#btnValidate'+a).attr("disabled",true);

    var url;

    var OBSERVATION_TRAITEMENT=$('#OBSERVATION_TRAITEMENT').val();
    var BUDGETISATION_ID=$('#BUDGETISATION_ID').val();
    var STATUT_BUDGET=$('#STATUT_BUDGET').val();
    

    url="<?php echo base_url('donnees/Budgetisation/do_valid')?>";
    
    var formData = new FormData();

    formData.append('STOCK_DEMANDE_ID',b);
    formData.append('STATUT',a);
    formData.append('OBSERVATION_TRAITEMENT',OBSERVATION_TRAITEMENT);


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

        alert_toast_validation('Réussie',data.message,'success');

        setTimeout(function() {
          $('#frmValidDemandeStock').submit();

        }, 1000);
      }
      else
      {
        for (var i = 0; i < data.inputerror.length; i++) 
        {
          $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
          $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 

          alert_toast_validation('Erreur',data.error_string[i],'error');
        }
      }

      $('#btnValidate'+a).text('Valider');
      $('#btnValidate'+a).attr('disabled',false); 


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
     $('#btnValidate'+a).text('Valider');
     $('#btnValidate'+a).attr('disabled',false);

   }


 });


  }
</script>


<script>
  function valider_demande_item(STOCK_DEMANDE_DEP_HISTORIQUE_ID,STATUT_DEM_HISTO)
  {

    

    $('#btnValideItem'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).text('Valider...');
    $('#btnValideItem'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).attr("disabled",true);

    var url;

    
    var QTE_STOCK_DISPO=$('#QTE_STOCK_DISPO'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).val();
    var QTE_DEMANDEE=$('#QTE_DEMANDEE'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).val();
    var QTE_DEMANDEE_COMPARE=$('#QTE_DEMANDEE_COMPARE'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).val();

    // alert(QTE_DEMANDEE);

    
    

    url="<?php echo base_url('demande/Demande_Stock/valider_demande_item')?>";
    
    var formDataV = new FormData();

    formDataV.append('STOCK_DEMANDE_DEP_HISTORIQUE_ID',STOCK_DEMANDE_DEP_HISTORIQUE_ID);
    formDataV.append('STATUT_DEM_HISTO',STATUT_DEM_HISTO);
    formDataV.append('QTE_STOCK_DISPO'+STOCK_DEMANDE_DEP_HISTORIQUE_ID,QTE_STOCK_DISPO);
    formDataV.append('QTE_DEMANDEE'+STOCK_DEMANDE_DEP_HISTORIQUE_ID,QTE_DEMANDEE);
    formDataV.append('QTE_DEMANDEE_COMPARE'+STOCK_DEMANDE_DEP_HISTORIQUE_ID,QTE_DEMANDEE_COMPARE);


    // alert(QTE_DEMANDEE)


    $.ajax({

      url:url,
      type:"POST",
      data:formDataV,
      contentType:false,
      processData:false,
      dataType:"JSON",
      success: function(data)
      {
       if(data.status) 
       {

        table.ajax.reload(null,false);
        $('#btnValideItem'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).text('Valider');
        $('#btnValideItem'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).attr("disabled",false);
        alert_toast_validation('Réussie',data.message,'success'); 
      }
      else
      {
        for (var i = 0; i < data.inputerror.length; i++) 
        {
          $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
          $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 

          alert_toast_validation('Erreur',data.error_string[i],'error');
        }
      }

      
      $('#btnValideItem'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).text('Valider');
      $('#btnValideItem'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).attr("disabled",false);


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
     $('#btnValideItem'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).text('Valider');
     $('#btnValideItem'+STOCK_DEMANDE_DEP_HISTORIQUE_ID).attr("disabled",false);

   }
 })


  }



</script>

<script>
  function get_products_items(STOCK_DEMANDE_DEP_HISTORIQUE_ID)
  {

   $('#frm_prdcts')[0].reset();
   $.ajax({
    url : "<?php echo site_url('demande/Demande_Stock/getOne')?>/" +STOCK_DEMANDE_DEP_HISTORIQUE_ID,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

      $('[name="STOCK_DEMANDE_DEP_HISTORIQUE_ID"]').val(data.STOCK_DEMANDE_DEP_HISTORIQUE_ID);
      $('[name="STOCK_DEMANDE_ID"]').val(data.STOCK_DEMANDE_ID);
      $('[name="CAT_MAT_ID"]').val(data.CAT_MAT_ID);
      $('[name="QTE_DEMANDEE"]').val(data.QTE_DEMANDEE);
      $('[name="QTE_APPROUVEE"]').val(data.QTE_APPROUVEE);
      $('[name="STATUT_DEM_HISTO"]').val(data.STATUT_DEM_HISTO);

      $('#products-modal').modal('show'); 
      $('.modal-title').text('Modifier'); 
      $('#btnChangeProducts').text('Modifier');


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
</script>

<script>
 function apply()
 {

   $('button').text('Appliquer ...');
   $('button').attr("disabled",true);

   var url;

   url="<?php echo base_url('demande/Demande_Stock/update_histo_stock')?>";

   var formData = new FormData($('#frm_prdcts')[0]);

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
      $('#products-modal').modal('hide');
      table.ajax.reload(null,false);
      alert_toast_validation('Réussie',data.message,'success');

      // setTimeout(function() {
      //   $('#frmValidDemandeStock').submit();

      // }, 1000);

      $('.form-group').removeClass('has-error');
      $('.help-block').empty(); 
    }
    else
    {
      for (var i = 0; i < data.inputerror.length; i++) 
      {
        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 


        alert_toast_validation('Erreur',data.error_string[i],'error');
      }


    }

    $('button').text('Appliquer');
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
   $('button').text('Appliquer');
   $('button').attr('disabled',false);

 }


});



 }
</script>

<script>
  function cancel_item(id,statut)
  {

    let message;

    if (statut==1) {message="Voulez-vous annuler cet élément?"} else {message="Voulez-vous activer cet élément?"}
     if (confirm(message)) {
      $.ajax({
        url : "<?php echo base_url('demande/Demande_Stock/cancel_item')?>/"+id+'/'+statut,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          table.ajax.reload(null,false);

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

  }

</script>









<div id="products-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-colored-header bg-info">
        <h4 class="modal-title" id="info-header-modalLabel">Modal Heading</h4>
        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></a>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <form id="frm_prdcts" method="POST">
              <div class="form-body">
                <input type="hidden" name="STOCK_DEMANDE_DEP_HISTORIQUE_ID" id="STOCK_DEMANDE_DEP_HISTORIQUE_ID">
                <input type="hidden" name="QTE_DEMANDEE" id="QTE_DEMANDEE">
                <div class="row">


                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Produits <span style="color: red;">*</span></label>
                        <select class="form-control" id="CAT_MAT_ID" name="CAT_MAT_ID">
                          <option value="0">Choisir</option>
                          <?php
                          foreach ($produits as $prod) {
                                                // code...
                            echo "<option value=".$prod['CAT_MAT_ID'].">".$prod['DESC_CAT_MAT']."</option>";
                          }
                          ?>

                        </select>
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>


                  <!--  -->

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Qté approuvée <span style="color: red;"></span></label>
                        <input type="number" autocomplete="off" name="QTE_APPROUVEE" class="form-control" id="QTE_APPROUVEE" autofocus>
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>

        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> -->
          <button type="button" id="btnChangeProducts" onclick="apply()" class="btn btn-info">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>
</div>




















