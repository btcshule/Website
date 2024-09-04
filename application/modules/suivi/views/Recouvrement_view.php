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

                <form method="POST" action="<?=base_url()?>index.php/suivi/Dettes_externes/payer" id="fromm">
                 <input type="hidden" autocomplete="off" class="form-control" name="GROS_CLIENT_ID" id="GROS_CLIENT_ID" placeholder="" value="<?= $infos_dette['GROS_CLIENT_ID'] ?>" readonly required>
                 <input type="hidden" autocomplete="off" class="form-control" name="ID_DETTE_EXTERNE" id="ID_DETTE_EXTERNE" placeholder="" value="<?= $infos_dette['ID_DETTE_EXTERNE'] ?>" readonly required>

                 <div class="col-md-12 row">
                  <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <input type="text" autocomplete="off" class="form-control" name="PRENOM_GROS_CLIENT" id="PRENOM_GROS_CLIENT" placeholder="" value="<?= $infos_dette['PRENOM_GROS_CLIENT'] ?>" readonly required>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <input type="text" autocomplete="off" class="form-control" name="NOM_GROS_CLIENT" id="NOM_GROS_CLIENT" placeholder="" value="<?= $infos_dette['NOM_GROS_CLIENT'] ?>" readonly required>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <input type="text" autocomplete="off" class="form-control" name="TEL_GROS_CLIENT" id="TEL_GROS_CLIENT" placeholder="" value="<?= $infos_dette['TEL_GROS_CLIENT'] ?>" readonly required>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <input type="text" autocomplete="off" class="form-control" name="RS" id="RS" placeholder="" value="<?= $infos_dette['RS'] ?>" readonly required>
                    </div>
                  </div>
                </div>
                  

                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900; color:#454545">Date dette<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="DATE_DETTE1" id="DATE_DETTE1" placeholder="" value="<?= $infos_dette['DATE_DETTE'] ?>" readonly required>
                    </div>
                  </div>
                </div>
                  <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900; color:#454545">Libellé<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="DESIGNATION" id="DESIGNATION" placeholder="" value="<?= $infos_dette['DESIGNATION'] ?>" readonly required>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900; color:#454545">Créance<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="MONTANT" id="MONTANT" placeholder="" value="<?= $infos_dette['MONTANT'] ?>" readonly required>
                    </div>
                  </div>
                </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="mb-3">
                        <label style="font-weight: 900; color:#454545">Montant Payé<span style ="color: red;">*</span></label>
                        <input type="number" autocomplete="off" class="form-control" name="MONTANT_PAYE" id="MONTANT_PAYE" placeholder="">
                      </div>
                      <div id="error-message" style="color: red; font-weight: bold; display: none;"></div>
                    </div>
                  </div>
                 <button type="submit" style="float: right;background-color:#eda323;color:white;border-radius:15px" class="btn"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Sauvegarder</button>
            </div>
          </form>
          <br><br><br>
          <h3>Derniers payements de: <span style="color: blue"> <?= $infos_dette['NOM_GROS_CLIENT'] ?> <?= $infos_dette['PRENOM_GROS_CLIENT'] ?></span></h3>
          <table id="mytable" class="table table-striped dt-responsive nowrap w-100 table-responsive">
            <thead>
              <tr>
                <th>Date dette</th>
                <th>Montant</th>
                <th>Client</th>
                <th>Contacts</th>
                <th>Recepteur</th>
                <th>Date de création</th>
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

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
  function new_record(){
    save_method=="add"
    $('#emp_form')[0].reset();
    $('#emp-modal').modal('show');
    $('.modal-title').text('Nouveau');
  }
</script>


<script>
  var save_method;
  var table;
  $(document).ready(function() {
    var row_count ="1000000"; 
    var GROS_CLIENT_ID = $("#GROS_CLIENT_ID").val();  
    table=$("#mytable").DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?php echo base_url('index.php/suivi/Dettes_externes/liste_paiement')?>",
        type:"POST",
         data: {
        GROS_CLIENT_ID: GROS_CLIENT_ID
      }
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
    var IMPUTATION=$('#IMPUTATION').val();
    var LIBELLE=$('#LIBELLE').val();
    var MONTANT=$('#MONTANT').val();
    var DATE_ENTREE=$('#DATE_ENTREE').val();

    var statut = true;
    if (IMPUTATION=="") {
      $("#errIMPUTATION").html("Le champ est obligatoire");
      statut=false;
    }else{
      $("#errIMPUTATION").html("");
    }

    if (LIBELLE=="") {
      $("#errLIBELLE").html("Le champ est obligatoire");
      statut=false;
    }else{
      $("#errLIBELLE").html("");
    }
    if (MONTANT=="") {
      $("#errMONTANT").html("Le champ est obligatoire");
      statut=false;
    }else{
      $("#errMONTANT").html("");
    }
    if (DATE_ENTREE=="") {
      $("#errDATE_ENTREE").html("Le champ est obligatoire");
      statut=false;
    }else{
      $("#errDATE_ENTREE").html("");
    }
    if (statut==true) {
      $('button').text('Enregistrement ...');
      $('#button').attr("disabled",true);

      var url;
      var ID_LIVRE_CAISSE=$('#ID_LIVRE_CAISSE').val();

      if (ID_LIVRE_CAISSE=="") 
      {

        url="<?php echo base_url('index.php/suivi/Entrees/ajouter')?>";
      }
      else
      {
        url="<?php echo base_url('index.php/suivi/Entrees/update')?>";
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
      url : "<?php echo site_url('index.php/suivi/Entrees/getOne')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="LIBELLE"]').val(data.LIBELLE);
        $('[name="DATE_ENTREE"]').val(data.DATE_ENTREE); 
        $('[name="IMPUTATION"]').val(data.IMPUTATION); 
        $('[name="MONTANT"]').val(data.MONTANT); 
        $('[name="ID_LIVRE_CAISSE"]').val(data.ID_LIVRE_CAISSE); 
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



  function supp_logic(id, is_actif) {
    let message;

    if (is_actif == 1) {
      message = "Voulez-vous désactiver ?";
    } else {
      message = "Voulez-vous activer ?";
    }

    if (confirm(message)) {
      $.ajax({
        url: "<?php echo base_url('index.php/suivi/Entrees/del')?>/" + id + '/' + is_actif,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          if (data.status) {
            alert("Opération réussie");
          } else {
            alert("Erreur : " + data.message);
          }
          table.ajax.reload(null, false);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          if (jqXHR.status == 0) {
            alert("Vous n'êtes pas connecté à l'internet, vérifiez votre connexion !");
          } else {
            if (errorThrown.status) {
              alert("Une erreur s'est produite");
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
                <input type="hidden" name="ID_LIVRE_CAISSE" id="ID_LIVRE_CAISSE">
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Date<span style="color: red;">*</span></label>
                        <?php
                        $today = date('Y-m-d');
                        $firstDayOfMonth = date('Y-m-01');
                        ?>
                        <input type="date" autocomplete="off" name="DATE_ENTREE" class="form-control" id="DATE_ENTREE" autofocus max="<?php echo $today; ?>" min="<?php echo $firstDayOfMonth; ?>">
                        <span class="text-danger" id="errDATE_ENTREE"></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Article<span style="color: red;">*</span></label>
                        <input type="text" autocomplete="off" name="LIBELLE" class="form-control" id="LIBELLE">
                        <span class="text-danger" id="errLIBELLE"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Compte<span style="color: red;">*</span></label>
                        <select class="form-control select2" name="IMPUTATION" id="IMPUTATION"
                        onchange="changemode()">
                        <option value="">--Sélectionner--</option>
                        <?php 
                        foreach ($imputation as  $value) {?>
                          <option value="<?=  $value['ID_IMPUTATION'] ?>">
                            <?= $value['DESC_IMPUTATION'] ?></option>
                          <?php  }  ?>
                        </select>
                        <span class="text-danger" id="errIMPUTATION"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Montant<span style="color: red;">*</span></label>
                        <input type="number" autocomplete="off" name="MONTANT" class="form-control" id="MONTANT">
                        <span class="text-danger" id="errMONTANT"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <button type="button" id="btnSaved" onclick="enr()" class="btn btn-info">Enregistrer</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script>
         $(document).ready(function() {
          $("#MONTANT_PAYE").on("keyup", function() {
            var montantCreance = parseFloat($("#MONTANT").val());
            var montantPaye = parseFloat($(this).val());
            if (montantPaye > montantCreance) {
              $("#error-message").text("Vérifiez le montant s'il vous plait.");
              $("#error-message").show();
            } else {
              $("#error-message").hide();
            }
          });
        });
      </script>

