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
             <h4>INFORMATIONS DU CLIENT</h4> 
                <div class="row border p-2" >
                  <div class="row">
                    <tr >

                      <div class="col-md-3">
                        <label><b>&nbsp;&nbsp;Client</b></label>
                        <select class="form-control select2" name="GROS_CLIENT_ID" id="GROS_CLIENT_ID" onchange="get_data_client()">
                          <option value="">--choisir--</option>
                          <option value="clientpassager"><b>Passager</b></option>
                          <?php
                          foreach($CLIENT as $pro)
                          {
                            ?>
                            <option value="<?=$pro['GROS_CLIENT_ID'] ?>"><?=$pro['RS']."(".$pro['PRENOM_GROS_CLIENT'].")"?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-md-3">
                        <label><b>&nbsp;&nbsp;Adresse du client</b></label>
                        <input  type="text" name="ADRESS" id="ADRESS" readonly class="form-control" value=""></div>
                        <div class="col-md-3">
                          <label><b>&nbsp;&nbsp;Contacts</b></label>
                          <input  type="text" name="TEL" id="TEL" readonly value="" class="form-control">
                        </div>
                        <div class="col-md-3">
                          <label><b>&nbsp;&nbsp;NIF</b></label>
                          <input  type="text" name="NIF" id="NIF" readonly value="" class="form-control">
                        </div>
                      
                        </tr>
                      </div>
                    </div>
                  </form>
                  <!-- gegin -->

                  <h4>INFORMATIONS LIEES A LA FACTURE</h4> 
                  <div class="col-md-12">
                    <form method="post" enctype="multipart/form-data">
                      <div class="row border p-2">
                        <div class="col-md-6">
                          <label>Catégorie</label>
                          <select name="UNITE_MESURE" id="UNITE_MESURE" class="form-control select2" onchange="getdesignations();desable_able()">

                           <option value="">---Select---</option>
                           <?php
                           foreach($Measure as $pro)
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

                      <div class="col-md-6">
                        <label>Désignation</label>
                        <select name="DESIGNATION" id="DESIGNATION" onchange="get_serv_price()" class="form-control select2">

                          <option>Choisir</option>
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
                       <div class="form-group col-md-4">
                      <label>Prix Unitaire</label>
                      <input type="decimal" name="PRIX_UNITAIRE" required="true" onkeydown="get_tot()" onkeyup="get_tot()"
                      placeholder="PRIX_UNITAIRE" id="PRIX_UNITAIRE" class="form-control"
                      />
                    </div>
                
                    <div class="form-group col-md-3">
                      <label>Quantité Vendue</label>
                      <input type="decimal" name="QUANTIT" required="true"
                      placeholder="" maxlength="4" id="QUANTITEUN" onkeydown="get_sum()" onkeyup="get_sum()" class="form-control"
                      />
                      <span style="color:red;font-family: bold;" id="erro_QUANTITEUN"></span>
                    </div>
                    <input type="hidden" name="" id="pt">
                   
                    <div class="form-group col-md-3">
                      <label>Réduction</label>
                      <select name="REDUCTION" id="REDUCTION" class="form-control">
                       <option value="0" selected>---Select---</option>
                       <option value="1">1%</option>
                       <option value="2">2%</option>
                       <option value="5">5%</option>
                       <option value="8">8%</option>
                       <option value="10">10%</option>
                       <option value="15">15%</option>
                     </select>
                   </div>
                   <div class="form-group col-lg-2" style="padding-top:20px">
                    <a id="cartinfo" onclick="info_cart();" class=" btn btn-primary"><span class="mdi mdi-plus-circle me-2">Ajouter</span></a>
                  </div>
                  <div class="row"><br></div>
                  <div class="col-lg-12" style="padding-top:5px;">
                    <div id="CART_FILE" class="col-md-12"></div>
                    <br>
                    <br>
                    <div id="show_btn" class="col-md-12" style="display: none;float: right;">
                      <a id="btn" class="btn btn-primary" style="float: right;" onclick="get_modal()"><span class="fa fa-check" aria-hidden="true"></span> 
                        Facturer
                      </a>
                    </div>
                  </div>
                </div>

              </form>

            </div>
            <!-- end -->
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
          <h3 class="text-primary">Voulez-vous valider?</h3>
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
                  <label class="form-label">Montant de la dette<span style="color: red;">*</span></label>
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
                  <label class="form-label">Date Echéance<span style="color: red;">*</span></label>
                  <input type="date" autocomplete="off" name="DATE_ECHEANCE" class="form-control" id="DATE_ECHEANCE" autofocus>
                  <span class="text-danger" id="errDATE_ECHEANCE"></span>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="mb-3">
                  <label class="form-label">Type de dette<span style="color: red;">*</span></label>
                  <select class="form-control" name="TYPE_DETTE" id="TYPE_DETTE">
                    <option value="1">Court terme</option>
                    <option value="2">Moyen terme</option>
                    <option value="3">Long terme</option>
                    <option value="4">Autres</option>
                  </select>
                  <span class="text-danger" id="errDATE_DETTE"></span>
                </div>
              </div>
            </div>

          </div>
          <br>
          <div class="modal-footer">
            <button type="button" id="idsave" onclick="save_info()" class="btn btn-primary" style="">Valider</button>
            <button type="reset" class="btn btn-dark" data-dismiss="modal">Annuler</button>
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

<script>
  function desable_able() {
    var x = $("#UNITE_MESURE").val();
    if (x == 0) {
     var targetElement = document.getElementById('type_produit');
     targetElement.disabled = true;
     targetElement.value = "";
   } else {
    var targetElement = document.getElementById('type_produit');
    targetElement.disabled = false;
  }
}
 function get_modal(){
  $('#staticBackdrop').modal('show');
 }

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
      url: "<?php echo base_url('index.php/exit/Ventes_services/getdesignations/');?>"+UNITE_MESURE,
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
  function get_data_client(){
    var GROS_CLIENT_ID=$('#GROS_CLIENT_ID').val();
    $.ajax(
    {
      url:"<?=base_url()?>index.php/exit/Ventes_services/get_data_client/"+GROS_CLIENT_ID,
      type:"GET",
      dataType:"JSON",
      success: function(data)
      {
        $('#ADRESS').val(data.ADRESS_GROS_CLIENT);
        $('#TEL').val(data.TEL_GROS_CLIENT);
        $('#NIF').val(data.NIF);
      }
    });
  }
  
   function get_serv_price()
  {
    var DESIGNATION=$('#DESIGNATION').val();
    $.ajax(
    {                            
      url:"<?=base_url()?>index.php/exit/Ventes_services/get_serv_price/"+DESIGNATION,
      type:"GET",
      dataType:"JSON",
      success: function(data)
      {
        $('#QUANTITEUN').val('');
        $('#PRIX_UNITAIRE').val(data.PRIX);
      }
    });
  }
  function get_data()
  {
    var DESIGNATION=$('#DESIGNATION').val();
    var type_produit=$('#type_produit').val();
    $.ajax(
    {                            
      url:"<?=base_url()?>index.php/exit/Ventes_services/get_data/"+DESIGNATION+'/'+type_produit,
      type:"GET",
      dataType:"JSON",
      success: function(data)
      {
        $('#QUANTITEUN').val('');
        $('#QUANTITE').val(data.QNTE);
        $('#PRIX_UNITAIRE').val(data.PV_U);
      }
    });
  }
</script>

<script>
  function info_cart() {
    // alert();
    var file = new FormData();
    var GROS_CLIENT_ID = $('#GROS_CLIENT_ID').val();
    var REDUCTION = $('#REDUCTION').val();
    var UNITE_MESURE = $('#UNITE_MESURE').val();
    var QUANTITEUN = $('#QUANTITEUN').val();
    var DESIGNATION = $('#DESIGNATION').val();
    var pt = $('#pt').val();
    var PRIX_UNITAIRE = $('#PRIX_UNITAIRE').val();
    const QUANTITE=$('#QUANTITE').val();
    var QUANTITEUN1=Number(QUANTITEUN);
    var QUANTITE1=Number(QUANTITE);

    if (GROS_CLIENT_ID=="") {
     alert_toast_validation('Opération invalide','Merci de préciser le client','error');
    }else{
      if (QUANTITEUN1==0) {
        $("#erro_QUANTITEUN").html("Ce champs est obligatoire");
      }
      else{
        $("#erro_QUANTITEUN").html(" ");

        if (QUANTITEUN != "" &&  DESIGNATION != "" && PRIX_UNITAIRE != "") {

          $.post("<?=base_url('index.php/exit/Ventes_services/add_in_cart/')?>", {
            QUANTITEUN: QUANTITEUN,
            DESIGNATION: DESIGNATION,
            pt: pt,
            PRIX_UNITAIRE: PRIX_UNITAIRE,
            UNITE_MESURE: UNITE_MESURE,
            REDUCTION: REDUCTION
          }, function(response) {
            if (response) {
              $('#CART_FILE').html(response);

              $('#show_btn').show();

              $('#QUANTITEUN').val('');
              $('#DESIGNATION').val('');
              $('#PRIX_UNITAIRE').val('');
              $('#QUANTITE').val('');
              $('#REDUCTION').val('');
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
    $.post('<?=base_url('index.php/exit/Ventes_services/remove_cart/')?>', {
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
    var ID_PAIE =$('#ID_PAIE').val();
    var TYPE_DETTE =$('#TYPE_DETTE').val();
    var GROS_CLIENT_ID =$('#GROS_CLIENT_ID').val();
    var MONTANT =$('#MONTANT').val();
    var DATE_ECHEANCE =$('#DATE_ECHEANCE').val();
    if (ID_PAIE==1) {
    if (MONTANT=="") {
      $('#errMONTANT').html('Le montant est obligatoire');
      statut=2;
    }else{
     $('#errMONTANT').html(''); 
   }
   if (DATE_ECHEANCE=="") {
    $('#errDATE_ECHEANCE').html('Le champ est obligatoire');
    statut=2;
  }else{
   $('#errDATE_ECHEANCE').html(''); 
 }
 }
 if (statut==1) {
  $('#idsave').attr('disabled',true);
  $('#staticBackdrop').modal('hide');
  $.post("<?=base_url('index.php/exit/Ventes_services/save_sale_manager/')?>", 
  {
    ID_PAIE:ID_PAIE,
    TYPE_DETTE: TYPE_DETTE,
    GROS_CLIENT_ID: GROS_CLIENT_ID,
    MONTANT: MONTANT,
    DATE_ECHEANCE: DATE_ECHEANCE
  }, function(response) {
    alert_toast_validation('sucess','Opération effectuée avec succès','success');
   window.location.href='<?=base_url('')?>index.php/exit/Pending_s';
 }) 
}
}
</script>