<!DOCTYPE html>
<html lang="en">

<head>
  <?php include VIEWPATH . 'includes/head.php'; ?>
  <style type="text/css">
    label {
      color: white;
    }
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

                <div style="background-color: gray; padding: 50px">
                  <form method="POST" action="<?=base_url()?>vente/Ventes/ajouter" id="fromm">
                   <div class="col-md-12 row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="mb-3">
                          <label>Catégories</label>
                          <select name="GROS_UNIT_ID" id="GROS_UNIT_ID" class="form-control" 
                          onchange="getdesignations()">

                          <option value="">---Séléctionner---</option>
                          <?php
                          foreach($Measure as $pro)
                          {
                            if ($pro['GROS_UNIT_ID']==set_value('GROS_UNIT_ID'))
                            {
                              ?>
                              <option value="<?=$pro['GROS_UNIT_ID'] ?>" selected><?=$pro['UNITE_DESCR']; ?></option>
                              <?php
                            }
                            else
                            {
                              ?>
                              <option value="<?= $pro['GROS_UNIT_ID'] ?>"><?=$pro['UNITE_DESCR']; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="mb-3">
                        <label style="font-weight: 900; color:#ffffff">Nom article<span style ="color: red;">*</span></label>
                        <select name="GROS_PRODUIT_ID" id="GROS_PRODUIT_ID" class="form-control"
                        onchange="getprix()">
                        <option value="">--Sélectionner--</option>

                      </select>

                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900; color:#ffffff">Quantité Disponible<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="QUANT_DISPO" id="QUANT_DISPO" placeholder="" required max="6"  value="<?=set_value('QUANT_DISPO');?>" readonly>
                    </div>
                  </div>
                </div>   
                <input type="hidden" autocomplete="off" class="form-control" name="PRIX_ACHAT" id="PRIX_ACHAT" placeholder="" required max="6"  value="<?=set_value('PRIX_ACHAT');?>"> 


                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900; color:#ffffff">Prix Unitaire<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="PRIX_VENTE" id="PRIX_VENTE" placeholder="" required max="6"  value="<?=set_value('PRIX_VENTE');?>">
                    </div>
                  </div>
                </div>              
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900; color:#ffffff">Quantité<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="QUANTITE" id="QUANTITE" placeholder="" required max="6"  value="<?=set_value('QUANTITE');?>">
                    </div>
                  </div>
                </div>  
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label>Client</label>
                      <select name="ID_CLIENT" id="ID_CLIENT" class="form-control">

                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($client as $value)
                        {
                          if ($value['ID_CLIENT']==set_value('ID_CLIENT'))
                          {
                            ?>
                            <option value="<?=$value['ID_CLIENT'] ?>" selected><?=$value['NOM_CLIENT'].' '.$value['PRENOM_CLIENT'];?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?= $value['ID_CLIENT'] ?>"><?=$value['NOM_CLIENT'].' '.$value['PRENOM_CLIENT'];?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900; color:#ffffff">Caissier<span style ="color: red;">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="COMMENTAIRE" id="COMMENTAIRE" readonly value="<?= $caisse['PRENOM_EMP'].' '.$caisse['NOM_EMP']?>">
                    </div>
                  </div>
                </div>

                <div style ="padding:25px">
                  <a id="cartinfo" onclick="info_cart();" class=" btn btn-info" style="background-color:#7EB154"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Ajouter</a>
                </div>

              <!--   <button type="submit" style="float: right;background-color:#eda323;color:white;border-radius:15px" class="btn"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Sauvegarder</button>
              </div> -->
            </form>

            <div class="col-lg-12" id="conta" style="padding: 5px;">
              <div id="CART_FILE" class="col-lg-12"></div>
              <div id="show_btn" style="display: none;">
                <a id="btn" class="btn btn-info" style="float: right;background-color: #7EB154;" onclick="get_modal()"><span class="fa fa-check" aria-hidden="true"></span>Sauvegarder</a>
              </div>
            </div>

          </div>
        </div>

        <div id="mytable-container" style="border: 5px solid gray; padding: 10px;">
          <center>
            <h3>
              Situation journalière, approvisionnement de: <span id="montant" style=" color: green; padding: 10px; display: inline-block;"><?= number_format($somme['montant'], 0, ',', ' ') ?> BIF</span>
            </h3>
          </center>
          <table id="mytable" class="table table-striped dt-responsive nowrap w-100 table-responsive">
            <thead>
              <tr>
                <th>Libellé</th>
                <th>Quantité</th>
                <th>Prix Achat</th>
                <th>Prix Vente</th>
                <th>Achat Total</th>
                <th>Fournisseur</th>
                <th>Responsable</th>
                <th>Observation</th>
                <th>Date</th>
              </tr>
            </thead>
          </table>
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
  var save_method;
  var table;
  $(document).ready(function() {
    var row_count ="1000000";   
    table=$("#mytable").DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?php echo base_url('index.php/vente/Entrees_stock/liste')?>",
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

  function getdesignations()
  {
    if($('#GROS_UNIT_ID').val()=='')
    {
      $('#GROS_PRODUIT_ID').html('<option value="">-- Séléctionner --</option>');
    }
    else
    {
      $.ajax(
      {
        url:"<?=base_url('index.php/vente/Ventes/getdesignations/')?>"+$('#GROS_UNIT_ID').val(),
        type: "GET",
        dataType:"JSON",
        success: function(data)
        {
          $('#GROS_PRODUIT_ID').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Erreur');
        }
      });
    }
  }
  function getprix() {
    var GROS_PRODUIT_ID = $('#GROS_PRODUIT_ID').val();
    $.ajax({
      url: "<?=base_url('index.php/vente/Ventes/getprix/')?>"+$('#GROS_PRODUIT_ID').val(),
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        if (data && data.QNTE && data.PA_U && data.PV_U) {
          $('#QUANT_DISPO').val(data.QNTE);
          $('#PRIX_ACHAT').val(data.PA_U);
          $('#PRIX_VENTE').val(data.PV_U);
        } else {
          $('#QUANT_DISPO').val(0);
          $('#PRIX_ACHAT').val(0);
          $('#PRIX_VENTE').val(0);
        }
      },
      error: function() {
        $('#QUANT_DISPO').val(0);
        $('#PRIX_ACHAT').val(0);
        $('#PRIX_VENTE').val(0);
      }
    });
  }

</script>
<script type="text/javascript">
  $(document).ready(function() {
    var prixVenteInitial = parseFloat($('#PRIX_VENTE').val());

    $('#PRIX_VENTE').on('change', function() {
      var nouveauPrixVente = parseFloat($(this).val());

      if (nouveauPrixVente < prixVenteInitial) {
        $('#prix-vente-error').text('Vous avez dépassé le minimum.');
      } else {
        $('#prix-vente-error').text('');
      }
    });
  });
</script>
<script type="text/javascript">
  // Lorsque le formulaire est soumis
  $('form').submit(function() {
    var prixAchat = parseFloat($('#PRIX_ACHAT').val());
    var prixVente = parseFloat($('#PRIX_VENTE').val());

    if (prixVente < prixAchat) {
      alert("Le prix de vente ne peut pas être inférieur au prix d'achat !");
    return false; // Empêche l'envoi du formulaire
  }

  return true; // Permet l'envoi du formulaire si la condition est satisfaite
});
</script>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog xl">
    <div class="modal-content">
      <form id="frmcost" method="POST">

        <div class="modal-body" style="margin-left: 50px;">
          <h3 class="text-danger">Are you sure want to validate?</h3>
          <br>
          <!-- <input type="hidden" name="NOM_CLI" value="<?=$CLIENT?>" >  -->
          <div class="col-lg-12 row" style="display:none"><label>PAY CASH?<span style="color: red;">*</span></label><br>
            <input type="radio" name="colab_etr" id="colab_etr" value="2" onclick="check(value)" checked> YES
            <input type="radio" name="colab_etr" id="colab_etr" value="1" onclick="check(value)"> NO
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
              <button type="button" id="idsave" onclick="save_info()" class="btn btn" style="background-color:#eda323;color:white">YES</button>
              <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>

    </div>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    </html>
    <script type="text/javascript">
      $(".myselect").select2();
    </script>
    <script type="text/javascript">

      function check(value)
      {
        if(value == 2)
        {
          $("#div_colab_etr").hide();
          $('#DEBTS').val(''); 

        }
        else if (value == 1)
        {
          $("#div_colab_etr").show();
        }
      }

    </script>



  <script type="text/javascript">


    function save_info()
    {

      $('#idsave').attr('disabled',true);

      var GROS_CLIENT_FACT_ID=$('#GROS_CLIENT_FACT_ID').val();
      var QUANTITEUN=$('#QUANTITEUN').val();
      var DEBTS=$('#DEBTS').val();
      var NOM_CLIENT=$('#NOM_CLIENT').val();
      var TELEPHONE=$('#TELEPHONE').val();

      $.post("<?=base_url('vente/Ventes/save_vente')?>", {
        GROS_CLIENT_FACT_ID: GROS_CLIENT_FACT_ID,
        QUANTITEUN: QUANTITEUN,
        DEBTS: DEBTS,
        NOM_CLIENT: NOM_CLIENT,
        TELEPHONE: TELEPHONE
      }, function(response) {
       window.location.href='<?=base_url('')?>ventes/Unvalidate_facture';
     })

      
    }

  </script>
  <script>
    $(document).ready( function () {
      $('#mytable').DataTable({
     /*dom: 'lBfrtip',
   buttons: ['copy', 'print']*/ });  
      } );

    function get_modal()
    {

      $('#btnSave').attr('disabled',false);
      $('#staticBackdrop').modal('show');
    }


  </script>

  <script>
    function info_cart() {
    // alert();
      var file = new FormData();
      var QUANTITE = $('#QUANTITE').val();
      var GROS_PRODUIT_ID = $('#GROS_PRODUIT_ID').val();
      var PT = $('#PT').val();
      var PRIX_ACHAT = $('#PRIX_ACHAT').val();
      const QUANT_DISPO=$('#QUANT_DISPO').val();

      var QUANT=Number(QUANTITE);
      var QUANT1=Number(QUANT_DISPO);

      if (QUANT1 < QUANT || QUANT==0) {
        $("#erro_QUANTITE").html("Réessayez!");
      } 
      else{
        $("#erro_QUANTITE").html(" ");

        if (QUANTITE != "" &&  GROS_PRODUIT_ID != "" && PRIX_ACHAT != "") {

          $.post("<?=base_url('vente/Ventes/add_in_cart/')?>", {
            QUANTITE: QUANTITE,
            GROS_PRODUIT_ID: GROS_PRODUIT_ID,
            PT: PT,
            PRIX_ACHAT: PRIX_ACHAT
          }, function(response) {
            if (response) {
              $('#CART_FILE').html(response);
          // $('#CART_FILE').html(response);

              $('#show_btn').show();

              $('#QUANTITE').val('');
              $('#GROS_PRODUIT_ID').val('');
              $('#PRIX_ACHAT').val('');
              $('#PT').val('');
              $('#QUANTITE').css('border-color', '#4169E1');
              $('#GROS_PRODUIT_ID').css('border-color', '#4169E1');
              $('#PRIX_ACHAT').css('border-color', '#4169E1');
            }
          })

        } else {
          var valid = true;

          if (!$('#QUANTITE').val()) {

            $('#QUANTITE').css('border-color', 'red');
            valid = false;
          } else {

            $('#QUANTITE').css('border-color', '#4169E1');
            valid = true;
          }
          if (!$('#GROS_PRODUIT_ID').val()) {

            $('#GROS_PRODUIT_ID').css('border-color', 'red');
            valid = false;
          } else {

            $('#GROS_PRODUIT_ID').css('border-color', '#4169E1');
            valid = true;
          }
          if (!$('#PRIX_ACHAT').val()) {

            $('#PRIX_ACHAT').css('border-color', 'red');
            valid = false;
          } else {

            $('#PRIX_ACHAT').css('border-color', '#4169E1');
            valid = true;
          }

          return valid;
        }
      }


    }


    function remove_cart(id) {

      var rowid = $('#rowid' + id).val();
      console.log('id' + rowid);
      $.post('<?=base_url('vente/Ventes/remove_cart/')?>', {
        rowid: rowid
      }, function(data) {
        if (data) {
          CART_FILE.innerHTML = data;
          $('#CART_FILE').html(data);
          $('#show_btn').prop('hidden',true);
        }

      })
    }
  </script>

  <script type="text/javascript">

    function get_sum() {

      var QUANTITE=$('#QUANTITE').val();
      var PRIX_ACHAT=$('#PRIX_ACHAT').val();
      var SUM=Number(QUANTITE)*Number(PRIX_ACHAT);
      $('#PT').val(SUM);

    }
  </script>
  <script type="text/javascript">

    function get_tot() {

      var QUANTITEUN=$('#QUANTITEUN').val();
      var PRIX_UNITAIRE=$('#PRIX_UNITAIRE').val();
      var SUM=Number(QUANTITEUN)*Number(PRIX_UNITAIRE);
      $('#pt').val(SUM);

    }
  </script>