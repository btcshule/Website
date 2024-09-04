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
              
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Filtre <span style="color: red;"></span></label>
                        <select class="form-control" onchange="manager_filter()" id="categorie" name="categorie">
                          <option value="0">Choisir</option>
                          <option value="1">Faire la budgétisation</option>
                          <option value="2">Consultation</option>
                        </select>
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>


            
                        <div class="col-md-5" style="display: none;" id="DIV_CAT">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label">Catégories</label>
                              <select class="form-control" name="CATEGORIE_ID" id="CATEGORIE_ID" onchange="send_request();">
                                <option value="0">--</option>
                                <?php 

                                foreach ($categories as $key) {

                                  echo "<option value='".$key['CATEGORIE_ID']."'>".$key['CATEGORIE_DESC']."</option>";
                                }
                                ?>
                              </select>
                              <span class="help-block"></span>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-2" style="display: none;" id="DIV_YEAR">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label">Année <span style="color: red;"></span></label>
                              <input onchange="get_dash()" type="text" value="<?=date('Y')?>" class="form-control" name="YEAR" id="YEAR" />
                            </div>
                          </div>
                        </div>


                      
                  <!--  <div class="col-md-2" style="display: none;" id="DIV_DU">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Du <span style="color: red;"></span></label>
                        <input type="date" name="datedu" onchange="liste()" id="datedu" class="form-control" autofocus="">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2" style="display: none;" id="DIV_AU">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Au <span style="color: red;"></span></label>
                        <input type="date" name="dateau" onchange="liste()" id="dateau" class="form-control" autofocus="">
                      </div>
                    </div>
                  </div> -->





                </div>

                <table id="mytable" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                    <tr>
                      <th>REFERENCE</th>
                      <th>CATEGORIE</th>
                      <th>COUT TOTAL</th>
                      <th>DATE FAITE</th>
                      <th>FAIT PAR</th>
                      <th>STATUT</th>
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

  function send_request() {
    // body...
    var categorie=$('#categorie').val();
    var CATEGORIE_ID=$('#CATEGORIE_ID').val();

    
    if (categorie==1 && CATEGORIE_ID!=0) 
    {
      window.location.href="<?=base_url('donnees/Budgetisation/add/')?>"+CATEGORIE_ID;
    }


  }


  function manager_filter()
  {
    var categorie=$('#categorie').val();

    if (categorie==1) 
    {
      $('#DIV_CAT').show();
      $('#DIV_YEAR').hide();
      $('#YEAR').val('');

    }else if(categorie==2){
      $('#DIV_CAT,#DIV_YEAR').show();
    }else{
      $('#DIV_CAT,#DIV_YEAR').hide();
       $('#CATEGORIE_ID,#YEAR').val('');
    }


  }
  
</script>



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
      url:"<?php echo base_url('donnees/Budgetisation/liste')?>",
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



 });


</script>
<script>

  function new_supplier(){

    save_method = 'add';
    $('#u_form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
    $('#u-modal').modal('show');
    $('.modal-title').text('Nouvelle');
  }



  function enr()
  {

   $('button').text('Enregistrement ...');
   $('button').attr("disabled",true);

   var url;

   if (save_method=="add") 
   {
    url="<?php echo base_url('saisie/Agences/add')?>";
  }
  else
  {
    url="<?php echo base_url('saisie/Agences/update')?>";
  }

  var formData = new FormData($('#u_form')[0]);

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
      $('#u-modal').modal('hide');
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




function edit_agence(id)
{


  save_method = 'update';
  $('#u_form')[0].reset();
  $.ajax({
    url : "<?php echo site_url('saisie/Agences/getOne')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

      $('[name="AGENCE_ID"]').val(data.AGENCE_ID);
      $('[name="AGENCE_NOM"]').val(data.AGENCE_NOM);
      $('#u-modal').modal('show'); 
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
      url : "<?php echo base_url('saisie/Agences/supp_logic')?>/"+id+'/'+is_actif,
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

<script>
    $(document).ready(function(){
      $("#YEAR").datepicker({
         format: "yyyy",
         viewMode: "years", 
         minViewMode: "years",
         autoclose:true
     });   
  })


</script>







<div id="u-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header modal-colored-header bg-info">
        <h4 class="modal-title" id="info-header-modalLabel">Modal Heading</h4>
        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></a>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <form id="u_form" method="POST">
              <div class="form-body">
                <input type="hidden" name="AGENCE_ID" id="AGENCE_ID">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label"> Agence<span style="color:red;">*</span></label>
                        <textarea class="form-control" name="AGENCE_NOM" id="AGENCE_NOM" rows="2" autofocus data-provide="typeahead"  autocomplete="off" autofocus></textarea>
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
          <button type="button" id="btnSave" onclick="enr()" class="btn btn-info">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>
</div>



