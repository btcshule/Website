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
                    <div class="col-sm-5">
                      <a href="javascript:void(0);" onclick="new_supplier()" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Nouveau</a>
                    </div>
                  </div>        
                <table id="mytable" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                    <tr>
                      <th>NOM</th>
                      <th>PRENOM</th>
                      <th>XXX</th>
                      <th>XXX</th>
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
  </div>
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
      url:"<?php echo base_url('administration/Users/liste')?>",
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
    $('.modal-title').text('Nouveau');
  }



  function enr()
  {

   $('button').text('Enregistrement ...');
   $('button').attr("disabled",true);

   var url;

   if (save_method=="add") 
   {
    url="<?php echo base_url('saisie/Categorie/add')?>";
  }
  else
  {
    url="<?php echo base_url('saisie/Categorie/update')?>";
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

function edit_groupe(id)
{


  save_method = 'update';
  $('#u_form')[0].reset();
  $.ajax({
    url : "<?php echo site_url('saisie/Categorie/getOne')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

      $('[name="CATEGORIE_ID"]').val(data.CATEGORIE_ID);
      $('[name="CATEGORIE_DESC"]').val(data.CATEGORIE_DESC);
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

  message="Voulez-vous exécuté cette opération?";
  
   if (confirm(message)) {
    $.ajax({
      url : "<?php echo base_url('saisie/Categorie/supp_logic')?>/"+id+'/'+is_actif,
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
      url : "<?php echo base_url('saisie/Categorie/confirm_item')?>/"+id+'/'+statut,
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







<div id="u-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog ">
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
                <input type="hidden" name="CATEGORIE_ID" id="CATEGORIE_ID">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label"> Ministère<span style="color:red;">*</span></label>
                      <div class="mb-3">
                        <textarea class="form-control" name="CATEGORIE_DESC" id="CATEGORIE_DESC" rows="2" autofocus data-provide="typeahead"  autocomplete="off" autofocus></textarea>
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





































