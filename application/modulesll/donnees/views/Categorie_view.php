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
                <div class="row mb-2">
                  <div class="col-sm-5">
                    <a href="javascript:void(0);" onclick="new_record()" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Nouvelle</a>
                  </div>
                </div> 
                <table id="mytable" class="table table-striped dt-responsive nowrap w-100 table-responsive">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Description</th>
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
  function new_record(){
    $('#emp_form')[0].reset();
    $('#emp-modal').modal('show');
    $('.modal-title').text('Nouvelle catégorie');
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
      url:"<?php echo base_url('donnees/Categorie/liste')?>",
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


   $("input").change(function(){
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
  function enr()
  {
    var CATEGORIE=$('#CATEGORIE').val();
    var statut = true;
    if (CATEGORIE=="") {
      $("#errCATEGORIE").html("Le champ est obligatoire");
      statut=false;
    }else{
      $("#errCATEGORIE").html("");
    }
    if (statut==true) {
      $('button').text('Enregistrement ...');
      $('#button').attr("disabled",true);

      var url;
      var CATH_ID =$('#CATH_ID').val();
      if (CATH_ID=="") 
      {

        url="<?php echo base_url('donnees/Categorie/add')?>";
      }
      else
      {
        url="<?php echo base_url('donnees/Categorie/update')?>";
      }

      var formData = new FormData($('#emp_form')[0]);

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
          $('#emp-modal').modal('hide');
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
  }



function edit_emp(id)
{
  save_method = 'update';
 $('#emp_form')[0].reset();
    $('#emp-modal').modal('show');
  $.ajax({
    url : "<?php echo site_url('index.php/donnees/Categorie/getOne')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {


      $('[name="CATEGORIE"]').val(data.CATH_DESC); 
      $('[name="CATH_ID"]').val(data.CATH_ID); 
      $('.modal-title').text('Modifier'); 
      $('#btnSaved').text('Modifier');


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
        url : "<?php echo base_url('administration/Employes/supp_logic')?>/"+id+'/'+is_actif,
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







<div id="emp-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-colored-header text-dark">
        <h4 class="modal-title" id="info-header-modalLabel">Modal Heading</h4>
        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></a>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <form id="emp_form" method="POST">
              <div class="form-body">
                <input type="hidden" name="CATH_ID" id="CATH_ID">
                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Catégorie<span style="color: red;">*</span></label>
                        <input type="text" autocomplete="off" name="CATEGORIE" class="form-control" id="CATEGORIE" autofocus>
                        <span class="text-danger" id="errCATEGORIE"></span>
                      </div>
                    </div>
                  </div>


                  
                </div>
                <div class="modal-footer">
                  <button type="button" id="btnSave" onclick="enr()" class="btn btn-info">Enregistrer</button>
                </div>
              </div>
            </div>
          </div>
        </div>
 



































