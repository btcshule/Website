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
                  <?=$breadcrumbs?>
                  
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
                <div class="row" style="padding: 1px" >
                  <fieldset class ="border p-2">
                    <form method="post" id="client">
                      <div class="row">
                        <tr >

                          <div class="col-md-3">
                            <label><b>&nbsp;&nbsp;Client</b></label>
                            <select class="form-control select2" name="GROS_CLIENT_ID" id="GROS_CLIENT_ID" onchange="get_value()">
                              <option value="">--choisir--</option>
                              <option value="nouveau"><b>Ajouter un client</b></option>
                              <?php
                              foreach($CLIENT as $pro)
                              {
                                ?>
                                <option value="<?=$pro['GROS_CLIENT_ID'] ?>"><?=$pro['RS']?></option>
                                <?php
                              }
                              ?>
                            </select>
                          </div>
                          
                          <div class="col-md-2">
                            <label><b>&nbsp;&nbsp;Adresse</b></label>
                            <input  type="text" name="ADRESS" id="ADRESS" readonly class="form-control" value=""></div>
                            <div class="col-md-2">
                              <label><b>&nbsp;&nbsp;Téléphone</b></label>
                              <input  type="text" name="TEL" id="TEL" readonly value="" class="form-control">
                            </div>
                            <div class="col-md-3">
                              <label><b>&nbsp;&nbsp;NIF</b></label>
                              <input  type="text" class="form-control" name="NIF" id="NIF" readonly ></div>
                              <div class="col-md-2">
                                <label><b>&nbsp;&nbsp;RC</b></label>
                                <input  type="text" name="RC" id="RC" class="form-control" readonly></div>
                              </tr>
                            </div>
                          </fieldset>

                        </div>
                      </form>

                      <!-- formulaire formant le cart -->

                        <form method="post" enctype="multipart/form-data" id="formulaire-produits">
                          <div class="row">
                            <div class="col-md-4">
                              <label>Cathégorie</label>
                              <select name="UNITE_MESURE" id="UNITE_MESURE" class="form-control select2" onchange="getdesignations()">

                               <option value="">---Séléctionner---</option>
                               <?php
                               foreach($produit as $pro)
                               {
                                if ($pro['CATH_ID']==set_value('UNITE_MESURE'))
                                {
                                  ?>
                                  <option value="<?=$pro['CATH_ID'] ?>" selected><?=$pro['CATH_DESC']; ?></option>
                                  <?php
                                }
                                else
                                {
                                  ?>
                                  <option value="<?= $pro['CATH_ID'] ?>"><?=$pro['CATH_DESC']; ?></option>
                                  <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <label>Désignation</label>
                            <select name="DESIGNATION" id="DESIGNATION" onchange="get_data()" class="form-control select2">

                              <option>Select</option>
                              <?php
                              foreach($produit as $pro)
                              {
                                if ($pro['PRODUCT_ID']==set_value('DESIGNATION'))
                                {
                                  ?>
                                  <option value="<?=$pro['PRODUCT_ID'] ?>" selected><?=$pro['PRODUCT_DESC']; ?></option>
                                  <?php
                                }
                                else
                                {
                                  ?>
                                  <option value="<?= $pro['PRODUCT_ID'] ?>"><?=$pro['PRODUCT_DESC']; ?></option>
                                  <?php
                                }
                              }
                              ?>

                            </select>
                          </div>


                          <div class="form-group col-md-3">
                            <label>Quantité en stock</label>
                            <input type="text" name="QUANTITE" required="true"
                            placeholder="" id="QUANTITE" class="form-control" disabled 
                            />
                          </div>
                          <div class="form-group col-md-3">
                            <label>Prix provisoire</label>
                            <input type="text" name="PRIX" required="true"
                            placeholder="" id="PRIX" class="form-control" disabled 
                            />
                          </div>
                          <div class="form-group col-md-3">
                            <label>Quantité vendue</label>
                            <input type="decimal" name="QUANTIT" required="true"
                            placeholder="" maxlength="4" id="QUANTITEUN" onkeydown="get_sum()" onkeyup="get_sum()" class="form-control"
                            />
                            <span style="color:red;font-family: bold;" id="erro_QUANTITEUN"></span>
                          </div>
                          <input type="hidden" name="" id="pt">
                          <div class="form-group col-md-3">
                            <label>Prix Unitaire</label>
                            <input type="decimal" name="PRIX_UNITAIRE" required="true" onkeydown="get_tot()" onkeyup="get_tot()"
                            placeholder="PRIX_UNITAIRE" id="PRIX_UNITAIRE" class="form-control"
                            />
                          </div>

                          <div class="form-group col-lg-1" style ="padding:20px">
                            <a id="cartinfo" onclick="info_cart();" class=" btn btn-primary"><span class="mdi mdi-plus-circle me-2"></span></a>
                          </div>
                        </div>
                      </form>

                    <div class="col-lg-12" style="padding:2px;">
                      <div id="CART_FILE" class="col-md-12"></div>
                      <br>
                      <br>
                      <div id="show_btn" style="display: none;float: right;">
                        <a id="btn" class="btn btn-primary" style="float: right;" onclick="get_modal()"><span class="fa fa-check" aria-hidden="true"></span> 
                          Valider
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.row -->
          </div> <!-- end card-body-->
        </div> <!-- end card-->
      </div> <!-- end col -->



      <!-- end row -->

    </div> <!-- container -->

  </div> <!-- content -->
</div>
<!-- REQUIRED SCRIPTS -->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="frmcost" method="POST">

        <div class="modal-body">
          <h3 class="text-primary">Cette action est irréversible!</h3>
          <br>
          <input type="hidden" name="">
          <div class="col-lg-12 row">
            <div class="col-lg-6"><label>Paiement<span style="color: red;">*</span></label>
              <select onchange="check(value)" class="form-control col-lg-4" id="ID_PAIE">
                <option value="2">Cash</option>
                <option value="1">Dette</option>
              </select>
            </div>
            <div class="col-lg-6" id="div_colab_etr111" style="display:none;">
              <div class="form-group">
                <div class="mb-3">
                  <label class="form-label">Montant de la dette</label>
                  <input type="number" autocomplete="off" name="MONTANT" class="form-control" id="MONTANT">
                  <span class="text-danger" id="errMONTANT"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="div_colab_etr" style="display: none;">

            <div class="col-md-6">
              <div class="form-group">
                <div class="mb-3">
                  <label class="form-label">Date Echéance</label>
                  <input type="date" autocomplete="off" name="DATE_ECHEANCE" class="form-control" id="DATE_ECHEANCE" autofocus>
                  <span class="text-danger" id="errDATE_ECHEANCE"></span>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="mb-3">
                  <label class="form-label">Type de dette</label>
                  <select class="form-control" name="TYPE_DETTE" id="TYPE_DETTE">
                    <option value="1">Court terme</option>
                    <option value="2">Moyen terme</option>
                    <option value="3">Long terme</option>
                    <option value="4">Autres</option>
                  </select>
                </div>
              </div>
            </div>

          </div>
          <br>
          <div class="modal-footer">
            <button type="button" id="idsave" onclick="save_info()" class="btn btn-primary" style="">D'accord!</button>
            <button type="reset" class="btn btn-dark" data-dismiss="modal">Abandonner</button>
          </div>
        </form>
      </div>
    </div>

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
<script type="text/javascript">
 $("#QUANTITEUN,#DEBTS,#MONTANT").on('input paste change keyup', function()      
 {
  $(this).val($(this).val().replace(/[^0-9]*$/gi, ''));
  $(this).val($(this).val().replace(' ', ''));
});
</script>
<script type="text/javascript">
  function check(value)
  {
    if(value == 2)
    {
      $("#div_colab_etr").hide();
      $("#div_colab_etr111").hide();

      $("#DEBTS").val('');      
    }
    else if (value == 1)
    {
      $("#div_colab_etr").show();
      $("#div_colab_etr111").show(); 
    }
  }
</script>
<script>
  function get_modal()
  { 
    let statut=1;

    if(statut==1){
      $('#btnSave').attr('disabled',false);
      $('#staticBackdrop').modal('show');
    }}
  </script>
  <script type="text/javascript">
    $('#message').delay('slow').fadeOut(3000);
    $(document).ready(function() {
      liste();
    });
    function getdesignations()
    {
     $('#QUANTITEUN').val('');
     $('#QUANTITE').val('');
     $('#PRIX_UNITAIRE').val('');
     var UNITE_MESURE=$('#UNITE_MESURE').val();
     $.ajax(
     {
      url: "<?php echo base_url('index.php/exit/Magasin_sales/getdesignations/');?>"+UNITE_MESURE,
      type: "POST",
      data: {},
      processData: false,  
      contentType: false,
      success: function(data)
      {
        $('#DESIGNATION').html(data);
      }
    });
   }
 </script>
 <script type="text/javascript">
  function get_data()
  {
    var DESIGNATION=$('#DESIGNATION').val();
    $.ajax(
    {
      url:"<?=base_url()?>index.php/exit/Magasin_sales/get_data/"+DESIGNATION,
      type:"GET",
      dataType:"JSON",
      success: function(data)
      {
        $('#QUANTITEUN').val('');
        $('#QUANTITE').val(data.QNTE);
        $('#PRIX').val(data.PV_U);
      }
    });
  }
</script>

<script type="text/javascript">
  function get_value()
  {
    var CLIENT=$('#GROS_CLIENT_ID').val();
    $.ajax(
    {
      url:"<?=base_url()?>index.php/exit/Magasin_sales/get_value/"+CLIENT,
      type:"GET",
      dataType:"JSON",
      success: function(data)
      {
        $('#ADRESS').val(data.ADRESS_GROS_CLIENT);
        $('#TEL').val(data.TEL_GROS_CLIENT);
       $('#NIF').val(data.NIF);
       $('#RC').val(data.RC);
      }
    });
  }
  

</script>

<script>
  function info_cart() {
    // alert();
    var file = new FormData();
    var UNITE_MESURE = $('#UNITE_MESURE').val();
    var QUANTITEUN = $('#QUANTITEUN').val();
    var DESIGNATION = $('#DESIGNATION').val();
    var pt = $('#pt').val();
    var PRIX_UNITAIRE = $('#PRIX_UNITAIRE').val();
    const QUANTITE=$('#QUANTITE').val();
    var QUANTITEUN1=Number(QUANTITEUN);
    var QUANTITE1=Number(QUANTITE);
    if (UNITE_MESURE!=0) {
      if (QUANTITE1 < QUANTITEUN1 || QUANTITEUN1==0) {
        $("#erro_QUANTITEUN").html("Indisponible");
      }
      else{
        $("#erro_QUANTITEUN").html(" ");

        if (QUANTITEUN != "" &&  DESIGNATION != "" && PRIX_UNITAIRE != "") {

          $.post("<?=base_url('index.php/exit/Magasin_sales/add_in_cart/')?>", {
            QUANTITEUN: QUANTITEUN,
            DESIGNATION: DESIGNATION,
            pt: pt,
            PRIX_UNITAIRE: PRIX_UNITAIRE,
            UNITE_MESURE: UNITE_MESURE
          }, function(response) {
            if (response) {
              $('#CART_FILE').html(response);
              $('#show_btn').show();
              $('#QUANTITEUN').val('');
              $('#DESIGNATION').val('');
              $('#PRIX_UNITAIRE').val('');
              $('#QUANTITE').val('');
              $('#pt').val('');
              $('#QUANTITEUN').css('border-color', '#4169E1');
              $('#DESIGNATION').css('border-color', '#4169E1');
              $('#PRIX_UNITAIRE').css('border-color', '#4169E1');
            }
          })

        } else {
          var valid = true;

          if (!$('#QUANTITEUN').val()) {

            $('#QUANTITEUN').css('border-color', 'red');
            valid = false;
          } else {

            $('#QUANTITEUN').css('border-color', '#4169E1');
            valid = true;
          }
          if (!$('#DESIGNATION').val()) {

            $('#DESIGNATION').css('border-color', 'red');
            valid = false;
          } else {

            $('#DESIGNATION').css('border-color', '#4169E1');
            valid = true;
          }
          if (!$('#PRIX_UNITAIRE').val()) {

            $('#PRIX_UNITAIRE').css('border-color', 'red');
            valid = false;
          } else {

            $('#PRIX_UNITAIRE').css('border-color', '#4169E1');
            valid = true;
          }

          return valid;
        }
      }
    }
    else{
      if (QUANTITEUN1==0) {
        $("#erro_QUANTITEUN").html("Not valide");
      }
      else{
        $("#erro_QUANTITEUN").html(" ");

        if (QUANTITEUN != "" &&  DESIGNATION != "" && PRIX_UNITAIRE != "") {

          $.post("<?=base_url('index.php/exit/Magasin_sales/add_in_cart/')?>", {
            QUANTITEUN: QUANTITEUN,
            DESIGNATION: DESIGNATION,
            pt: pt,
            PRIX_UNITAIRE: PRIX_UNITAIRE,
            UNITE_MESURE: UNITE_MESURE
          }, function(response) {
            if (response) {
              $('#CART_FILE').html(response);

              $('#show_btn').show();

              $('#QUANTITEUN').val('');
              $('#DESIGNATION').val('');
              $('#PRIX_UNITAIRE').val('');
              $('#QUANTITE').val('');
              $('#pt').val('');
              $('#QUANTITEUN').css('border-color', '#4169E1');
              $('#DESIGNATION').css('border-color', '#4169E1');
              $('#PRIX_UNITAIRE').css('border-color', '#4169E1');
            }
          })

        } else {
          var valid = true;

          if (!$('#QUANTITEUN').val()) {

            $('#QUANTITEUN').css('border-color', 'red');
            valid = false;
          } else {

            $('#QUANTITEUN').css('border-color', '#4169E1');
            valid = true;
          }
          if (!$('#DESIGNATION').val()) {

            $('#DESIGNATION').css('border-color', 'red');
            valid = false;
          } else {

            $('#DESIGNATION').css('border-color', '#4169E1');
            valid = true;
          }
          if (!$('#PRIX_UNITAIRE').val()) {

            $('#PRIX_UNITAIRE').css('border-color', 'red');
            valid = false;
          } else {

            $('#PRIX_UNITAIRE').css('border-color', '#4169E1');
            valid = true;
          }

          return valid;
        }
      }
    }
  }


  function remove_cart(id) {

    var rowid = $('#rowid' + id).val();
    console.log('id' + rowid);
    $.post('<?=base_url('index.php/exit/Magasin_sales/remove_cart/')?>', {
      rowid: rowid
    }, function(data) {
      if (data) {
        CART_FILE.innerHTML = data;
        $('#CART_FILE').html(data);
        $('#show_btn').prop('hidden',false);
      }

    })
  }
</script>
<script type="text/javascript">
  function get_sum() {
    var QUANTITEUN=$('#QUANTITEUN').val();
    var PRIX_UNITAIRE=$('#PRIX_UNITAIRE').val();
    var SUM=Number(QUANTITEUN)*Number(PRIX_UNITAIRE);
    $('#pt').val(SUM);
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


<script type="text/javascript">
  function save_info()
  {
    let statut=1;

 if (statut==1) {
  $('#idsave').attr('disabled',true);
  $('#staticBackdrop').modal('hide');
  $.post("<?=base_url('index.php/exit/Magasin_sales/save_sale_manager/')?>", 
  {
    ID_PAIE:ID_PAIE,
    TYPE_DETTE: TYPE_DETTE,
    GROS_CLIENT_ID: GROS_CLIENT_ID,
    MONTANT: MONTANT,
    DATE_ECHEANCE: DATE_ECHEANCE
  }, function(response) {
   window.location.href='<?=base_url('')?>index.php/exit/Magasin_sales/save_sale_manager_list';
 }) 
}
}

</script>

<script>
  function afficherFormulaireProduits() {
    var formulaireProduits = document.getElementById("formulaire-produits");
    var formulaireServices = document.getElementById("formulaire-services");

    formulaireProduits.style.display = "block";
    formulaireServices.style.display = "none";
  }

  function afficherFormulaireServices() {
    var formulaireProduits = document.getElementById("formulaire-produits");
    var formulaireServices = document.getElementById("formulaire-services");

    formulaireProduits.style.display = "none";
    formulaireServices.style.display = "block";
  }
</script>