<!DOCTYPE html>
<html lang="en">

<head>
  <?php include VIEWPATH . 'includes/head.php'; ?>

<style type="text/css">
  
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
                  <?=$breadcrumbs?>
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
                    <a href="javascript:void(0);" onclick="new_record()" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Nouveau</a>
                  </div>
                </div> 
                <table id="mytable" class="table table-striped dt-responsive nowrap w-100 table-responsive">
                  <thead>
                    <tr>

                      <th>Identification</th>
                      <th>Contact</th>
                      <th>Adresse Electronique</th>
                      <th>Profil</th>
                      <th>Derneir Diplôme</th>
                      <th>Branche</th>
                      <th>Statut</th>
                      <th>Action</th>
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
    save_method=="add"
    $('#emp_form')[0].reset();
    $('#emp-modal').modal('show');
    $('.modal-title').text('Nouveau Utilisateur♪');
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
      url:"<?php echo base_url('index.php/administration/Utilisateurs/liste')?>",
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
    var NOM=$('#NOM').val();
    var PRENOM=$('#PRENOM').val();
    var TELEPHONE=$('#TELEPHONE').val();
    var PROFILE_ID=$('#PROFILE_ID').val();
    var ID_BRANCHE=$('#ID_BRANCHE').val();
    var ID_NIVEAU=$('#ID_NIVEAU').val();

    var statut = true;

    if (NOM=="") {
      $("#errNOM").html("Le champ est obligatoire");
      statut=false;
    }else{
      $("#errNOM").html("");
    }
    if (PRENOM=="") {
      $("#errPRENOM").html("Le champ est obligatoire");
      statut=false;
    }else{
      $("#errPRENOM").html("");
    }
    if (TELEPHONE=="") {
      $("#errTELEPHONE").html("Le champ est obligatoire");
      statut=false;
    }else{
      $("#errTELEPHONE").html("");
    }

    if (PROFILE_ID=="") {
      $("#errPROFILE_ID").html("Le champ est obligatoire");
      statut=false;
    }else{
      $("#errPROFILE_ID").html("");
    }
    if (statut==true) {
      $('button').text('Enregistrement ...');
      $('#button').attr("disabled",true);

      var url;
      var EMPLOYE_ID=$('#EMPLOYE_ID').val();
      
      if (EMPLOYE_ID=="") 
      {

        url="<?php echo base_url('index.php/administration/Utilisateurs/ajouter')?>";
      }
      else
      {
        url="<?php echo base_url('index.php/administration/Utilisateurs/update')?>";
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
       $('#btnSaved').text('Modifier');
       $('#btnSaved').attr('disabled',false);
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
      url : "<?php echo site_url('administration/Utilisateurs/getOne')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
// SELECT `EMPLOYE_ID`, `NOM_EMP`, `PRENOM_EMP`, `EMAIL_EMP`, `TEL_EMP`, `PROFILE_ID`, `IS_USER_SYSTEM`, `MOT_DE_PASSE`, `USER_ID`, `DATE_CREATION`, `IS_ACTIF`, `IS_MUST_CHANGE_PWD`, `ID_BRANCHE` FROM `employes` WHERE 1

        $('[name="TELEPHONE"]').val(data.TEL_EMP);
        $('[name="NOM"]').val(data.NOM_EMP);
        $('[name="PRENOM"]').val(data.PRENOM_EMP);
        $('[name="EMAIL"]').val(data.EMAIL_EMP);
        $('[name="PROFILE_ID"]').val(data.PROFILE_ID);
        $('[name="ID_BRANCHE"]').val(data.ID_BRANCHE);

        $('[name="ID_NIVEAU"]').val(data.ID_NIVEAU);
        // $('[name="GROS_CLIENT_ID"]').val(data.GROS_CLIENT_ID); 
        $('.modal-title').text('Modification des utilisateurs'); 
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
        url : "<?php echo base_url('index.php/administration/Utilisateurs/del')?>/"+id+'/'+is_actif,
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
    $(document).ready(function() {
        $('.select2').select2();
    });
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
                <input type="hidden" name="EMPLOYE_ID" id="EMPLOYE_ID">
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Nom<span style="color: red;">*</span></label>
                        <input type="text" autocomplete="off" name="NOM" class="form-control" id="NOM" autofocus>
                        <span class="text-danger" id="errNOM"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Prénom<span style="color: red;">*</span></label>
                        <input type="text" autocomplete="off" name="PRENOM" class="form-control" id="PRENOM" autofocus>
                        <span class="text-danger" id="errPRENOM"></span>
                      </div>
                    </div>
                  </div>                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Téléphone<span style="color: red;">*</span></label>
                        <input type="number" autocomplete="off" name="TELEPHONE" class="form-control" id="TELEPHONE" autofocus>
                        <span class="text-danger" id="errTELEPHONE"></span>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">E-mail<span style="color: red;">*</span></label>
                        <input type="email" autocomplete="off" name="EMAIL" class="form-control" id="EMAIL">
                        <span class="text-danger" id="errEMAIL"></span>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="mb-3">
                        <label>Niveau d'Etudes</label>
                        <select name="ID_NIVEAU" id="ID_NIVEAU" class="form-control" 
                        onchange="getdesignations()">

                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($niveaux as $niveau)
                        {
                          if ($niveau['ID_NIVEAU']==set_value('ID_NIVEAU'))
                          {
                            ?>
                            <option value="<?=$niveau['ID_NIVEAU'] ?>" selected><?=$niveau['DESC_NIVEAU']; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?= $niveau['ID_NIVEAU'] ?>"><?=$niveau['DESC_NIVEAU']; ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                     <label>Point de vente</label>
                     <select name="ID_BRANCHE" id="ID_BRANCHE" class="form-control" onchange="getdesignations()">
                      <option value="">---Sélectionner---</option>
                      <?php
                      foreach($branche as $bra)
                      {
                        if ($bra['ID_BRANCHE'] == set_value('ID_BRANCHE'))
                        {
                          ?>
                          <option value="<?= $bra['ID_BRANCHE'] ?>" selected><?= $bra['DESCRIPTION_BRANCH'] . ' ' . $bra['LOCALISATION'] ?></option>
                          <?php
                        }
                        else
                        {
                          ?>
                          <option value="<?= $bra['ID_BRANCHE'] ?>"><?= $bra['DESCRIPTION_BRANCH'] . ' ' . $bra['LOCALISATION'] ?></option>
                          <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <div class="mb-3">
                   <label>Profile</label>
                   <select name="PROFILE_ID" id="PROFILE_ID" class="form-control" 
                   onchange="getdesignations()">

                   <option value="">---Séléctionner---</option>
                   <?php
                   foreach($profil as $pro)
                   {
                    if ($pro['ID_USER_PROFIL']==set_value('PROFILE_ID'))
                    {
                      ?>
                      <option value="<?=$pro['ID_USER_PROFIL'] ?>" selected><?=$pro['DESC_USER_PROFIL']; ?></option>
                      <?php
                    }
                    else
                    {
                      ?>
                      <option value="<?= $pro['ID_USER_PROFIL'] ?>"><?=$pro['DESC_USER_PROFIL']; ?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" id="btnSaved" onclick="enr()" class="btn btn-info">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>
</div>
