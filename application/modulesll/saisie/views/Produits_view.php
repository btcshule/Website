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

                <?php 
                if ($this->session->userdata('PROD_CREATION')==1) {?>
                <div class="row mb-2">
                  <div class="col-sm-5">
                    <a href="javascript:void(0);" onclick="new_supplier()" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Nouvelle</a>
                  </div>

                </div>
                 <?php 
                }
                ?>

                <table id="mytable" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                    <tr>
                      <th>CATEGORIE</th>
                      <th>DESIGNATION</th>
                      <th>STOCK MIN LOGISTIQUE</th>
                      <th>STOCK MIN AGENCE</th>
                      <th>QTE/UNITE</th>
                      <!-- <th>STATUT</th> -->
                      <th>ACTION</th>
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

   var row_count ="1000000";   
   table=$("#mytable").DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"<?php echo base_url('saisie/Produits/liste')?>",
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



   $("textarea").change(function(){
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

  function new_supplier(){

    save_method = 'add';
    $('#catm_form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
    $('#catm-modal').modal('show');
    $('.modal-title').text('Nouveau');
  }



  function enr()
  {

   $('button').text('Enregistrement ...');
   $('button').attr("disabled",true);

   var url;

   if (save_method=="add") 
   {
    url="<?php echo base_url('saisie/Produits/add')?>";
  }
  else
  {
    url="<?php echo base_url('saisie/Produits/update')?>";
  }

  var formData = new FormData($('#catm_form')[0]);

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
      $('#catm-modal').modal('hide');
      table.ajax.reload(null,false);
    }
    else
    {
      for (var i = 0; i < data.inputerror.length; i++) 
      {
        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
      }
    }

    $('button').text('Enregistrer');
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
   $('button').text('Enregistrer');
   $('button').attr('disabled',false);

 }


});



}




function edit_mat(id)
{


  save_method = 'update';
  $('#catm_form')[0].reset();
  $.ajax({
    url : "<?php echo site_url('saisie/Produits/getOne')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

      $('[name="CAT_MAT_ID"]').val(data.CAT_MAT_ID);
      $('[name="CATEGORIE_ID"]').val(data.CATEGORIE_ID);
      $('[name="UNITE_QTE_ID"]').val(data.UNITE_QTE_ID);
      $('[name="DESC_CAT_MAT"]').val(data.DESC_CAT_MAT);
      $('[name="SEUIL_N1"]').val(data.SEUIL_N1);
      $('[name="SEUIL_N2"]').val(data.SEUIL_N2);
      $('[name="UNITE_ID"]').val(data.UNITE_ID);
      $('[name="QTE_PAR_UNITE"]').val(data.QTE_PAR_UNITE);
      $('#catm-modal').modal('show'); 
      $('.modal-title').text('Modifier'); 
      $('#btnSave').text('Modifier');


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




function supp_logic(id,is_actif)
{

  let message;

  if (is_actif==1) {message="Voulez-vous désactiver?"} else {message="Voulez-vous activer?"}
   if (confirm(message)) {
    $.ajax({
      url : "<?php echo base_url('saisie/Produits/supp_logic')?>/"+id+'/'+is_actif,
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




function confirm_item(id,statut)
{

  let message;
  message="Voulez-vous exécuté cette opération?";

   if (confirm(message)) {
    $.ajax({
      url : "<?php echo base_url('saisie/Produits/confirm_item')?>/"+id+'/'+statut,
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






<div id="catm-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-colored-header bg-info">
        <h4 class="modal-title" id="info-header-modalLabel">Modal Heading</h4>
        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></a>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <form id="catm_form" method="POST">
              <div class="form-body">
                <input type="hidden" name="CAT_MAT_ID" id="CAT_MAT_ID">
                <div class="row">


                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Catégories <span style="color: red;">*</span></label>
                        <select class="form-control" id="CATEGORIE_ID" name="CATEGORIE_ID">
                          <option value="0">Choisir...</option>
                          <?php
                          foreach ($categories as $c) {

                                # code...
                            echo "<option value='".$c['CATEGORIE_ID']."'>".$c['CATEGORIE_DESC']."</option>";


                          } 

                          ?>
                          

                        </select>

                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>



                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Stock minimum logistique <span style="color: red;"></span></label>
                        <input type="number" autocomplete="off" name="SEUIL_N1" class="form-control" id="SEUIL_N1" autofocus>
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Stock minimum agence <span style="color: red;"></span></label>
                        <input type="number" autocomplete="off" name="SEUIL_N2" class="form-control" id="SEUIL_N2" autofocus>
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>

                  

                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Désignation <span style="color: red;">*</span></label>
                        <textarea class="form-control" rows="2" autocomplete="off" autofocus id="DESC_CAT_MAT" name="DESC_CAT_MAT"></textarea>
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Unité <span style="color: red;">*</span></label>
                        <select class="form-control" id="UNITE_ID" name="UNITE_ID">
                          <option value="0">Choisir</option>
                          <?php
                          foreach ($unites as $u) {
                                                // code...
                            echo "<option value=".$u['UNITE_ID'].">".$u['UNITE_DESC']."</option>";
                          }
                          ?>

                        </select>
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Quantité/unité <span style="color: red;">*</span></label>
                        <input type="number" autocomplete="off" name="QTE_PAR_UNITE" class="form-control" id="QTE_PAR_UNITE" autofocus>
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Unité/quantité <span style="color: red;">*</span></label>
                        <select class="form-control" id="UNITE_QTE_ID" name="UNITE_QTE_ID">
                          <option value="0">Choisir</option>
                          <?php
                          foreach ($unite_qte as $key) {
                              # code...
                            echo "<option value='".$key['UNITE_QTE_ID']."'>".$key['UNITE_QTE_DESC']."</option>";
                            }  
                          ?>
                        </select>
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
          <button type="button" id="btnSave" onclick="enr()" class="btn btn-info">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>
</div>

















