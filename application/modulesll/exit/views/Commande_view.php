<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH . 'templates/header.php' ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include VIEWPATH . 'templates/navbar.php' ?>
    <!-- /.navbar -->
    <!-- Sidebar Menu -->
    <?php include VIEWPATH . 'templates/menu.php' ?>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0"> Create a Commande </h5>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Magasin</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body" style="overflow-x: auto;">
              <div class="row" style="padding: 1px">
                <fieldset class="border p-2">
                  <div class="row">
                    <div class="col-md-3">
                      <label><b>&nbsp&nbspCustomer</b></label>
                      <input type="text" name="NAME" id="NAME" readonly class="form-control" value="<?= $CLIENT['NOM_GROS_CLIENT'] ?>">
                    </div>
                    <div class="col-md-2">
                      <label><b>&nbsp&nbspAdress</b></label>
                      <input type="text" name="ADRESS" id="ADRESS" readonly class="form-control" value="<?= $CLIENT['ADRESS_GROS_CLIENT'] ?>">
                    </div>
                    <div class="col-md-2">
                      <label><b>&nbsp&nbsp Contact</b></label>
                      <input type="text" name="TEL" id="TEL" readonly value="<?= $CLIENT['TEL_GROS_CLIENT'] ?>" class="form-control">
                    </div>
                    <div class="col-md-2">
                      <label><b>&nbsp&nbspOperator</b></label>
                      <input type="text" class="form-control" readonly value="EMSI-MAGASIN">
                    </div>
                    <div class="col-md-3">
                      <label><b>&nbsp&nbspCashier</b></label>
                      <input type="text" class="form-control" readonly value="<?=$this->session->userdata('FIRST_NAME')?> <?=$this->session->userdata('LAST_NAME')?>">
                    </div>
                  </div>
                </fieldset>
              </div>
              <!-- gegin -->
              <div class="col-md-12">
                <form method="post" enctype="multipart/form-data">
                  <div class="row" style="overflow-x: auto;">
                    <div class="col-md-2">
                      <label>Filter</label>
                      <select name="UNITE_MESURE" id="UNITE_MESURE" class="form-control" onchange="getdesignations()">

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
                  <div class="col-md-3">
                    <label>Designation</label>
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
                  <div class="form-group col-md-2">
                    <label>Qty Available</label>
                    <input type="text" name="QUANTITE" required="true"
                    placeholder="" id="QUANTITE" class="form-control" disabled 
                    />
                  </div>
                  <div class="form-group col-md-2">
                    <label>Quantity</label>
                    <input type="decimal" name="QUANTIT" required="true"
                    placeholder="" maxlength="4" id="QUANTITEUN" onkeydown="get_sum()" onkeyup="get_sum()" class="form-control"
                    />
                    <span style="color:red;font-family: bold;" id="erro_QUANTITEUN"></span>
                  </div>
                  <input type="hidden" name="" id="pt">
                  <div class="form-group col-md-2">
                    <label>Unit price</label>
                    <input type="decimal" name="PRIX_UNITAIRE" required="true" onkeydown="get_tot()" onkeyup="get_tot()"
                    placeholder="PRIX_UNITAIRE" id="PRIX_UNITAIRE" class="form-control"
                    />
                  </div>
                  <div class="form-group col-lg-1" style ="padding:30px">
                    <a id="cartinfo" onclick="info_cart();" class=" btn btn-primary"><span class="nav-icon fas fa-plus" aria-hidden="true"></span></a>
                  </div>
                </div>
              </form>
            </div>
            <!-- end -->

            <div class="col-lg-12" style="padding:2px;">
              <b>
                <div id="CART_FILE" class="col-md-12"></div>
                <br><br>
                <div id="show_btn" style="display: none;float: right;">
                  <a id="btn" class="btn btn-primary" style="float: right;" onclick="get_modal()"><span class="fa fa-check" aria-hidden="true"></span> 
                    command
                  </a>
                </div>

              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<?php include VIEWPATH . 'templates/footer.php' ?>

<!-- Main Footer -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="frmcost" method="POST">

        <div class="modal-body">
          <h3 class="text-primary">Validate after fill required field.</h3>
          <hr>
          <br>
          <input type="hidden" name="GROS_CLIENT_ID" value="<?= $custumer['GROS_CLIENT_ID'] ?>">
          <div class="row">
            <div class="col-md-6">
              <label>Delivery date<span style="color:red">*</span></label>
              <input type="date" class="form-control" min="<?= date('Y-m-d') ?>" id="DATE_LIVRAISON" name="DATE_LIVRAISON">
              <span class="text-danger" id="DATE_LIVRAISON_error"></span>
            </div>
            <div class="col-lg-6 row"><label>PAY ADVANCE?<span style="color: red;">*</span></label><br>
              <input type="radio" name="colab_etr" id="colab" value="1" onclick="check(value)" checked> YES
              <input type="radio" name="colab_etr" id="colab_etr" value="2" onclick="check(value)"> NO
            </div>

            <div class="col-md-6" id="div_colab_etr">
              <label> Specify Advance Amount</label>
              <div class="col-md-12">
                <input type="text" class="form-control" name="ADVANCE" id="ADVANCE">
              </div>
              <span class="text-danger" id="ADVANCE_error"></span>

            </div>
            <div class="col-md-6" id="div_moy_etr">
              <label>Moyen de paiement</label>
              <select class="form-control" name="MOYEN_PAIE" id="MOYEN_PAIE">
                <option value="">-Select-</option>
                <option value="1">Cash</option>
                <option value="2">Bank deposit</option>
              </select>
              <span class="text-danger" id="MOYEN_PAIE_error"></span>

            </div>
          </div>
          <br>
          <div class="modal-footer">
            <button type="button" id="idsave" onclick="save_info()"  class="btn btn-primary">YES</button>
            <button type="reset" class="btn btn-dark" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>

  </div>

</body>

</html>
<script>
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });

  $("#QUANTITEUN,#DEBTS,#ADVANCE").on('input paste change keyup', function() {

    $(this).val($(this).val().replace(/[^0-9]*$/gi, ''));
    $(this).val($(this).val().replace(' ', ''));
  });
</script>
<script type="text/javascript">
  function check(value) {
    if (value == 2) {
      $("#div_colab_etr").hide();
      $("#div_moy_etr").hide();
      $('#MOYEN_PAIE').val('');
      $('#ADVANCE').val('');
    } else if (value == 1) {
      $("#div_colab_etr").show();
      $("#div_moy_etr").show();
    }
  }
</script>
<script>
  function get_modal() {
    $('#btnSave').attr('disabled', false);
    $('#staticBackdrop').modal('show');
  }
</script>
<script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
  $(document).ready(function() {
    liste();

  });
  function getdesignations()
  {
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
        $('#PRIX_UNITAIRE').val(data.PV_GROS);

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
        $("#erro_QUANTITEUN").html("Invalide");
      }
      else{
        $("#erro_QUANTITEUN").html(" ");

        if (QUANTITEUN != "" &&  DESIGNATION != "" && PRIX_UNITAIRE != "") {
          $('#show_btn').show();
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
        $('#show_btn').prop('hidden',true);
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
    statut = 1;
    if ($("#DATE_LIVRAISON").val() == "") {
      statut = 2;
      $("#DATE_LIVRAISON_error").html("Field is Required");
    } else {
      $("#DATE_LIVRAISON_error").html("");
    }

   // if (value==1) {
   //  if ($("#ADVANCE").val() == "") {
   //    statut = 2;
   //    $("#ADVANCE_error").html("Field is Required");
   //  } else {
   //      // alert(statut);
   //    $("#ADVANCE_error").html("");

   //  }
   
   //  if ($("#MOYEN_PAIE").val() == "") {
   //    statut = 2;
   //    $("#MOYEN_PAIE_error").html("Field is Required");
   //  } else {
   //      // alert(statut);
   //    $("#MOYEN_PAIE_error").html("");
   //  }
  
    if (statut==1) {
    $('#idsave').attr('disabled',true);
    var form_data = new FormData($("#frmcost")[0]);
    url = "<?= base_url('index.php/exit/Magasin_sales/savedata') ?>";
    $.ajax(
    {
      url: url,
      type: 'POST',
      dataType:'JSON',
      data: form_data ,
      contentType: false,
      cache: false,
      processData: false,
      success: function(data)
      {

        window.location.href='<?=base_url('')?>index.php/exit/Magasin_sales//listes';
        alert_notify('success','bill','Enregistrement est fait avec succès','1'); 
      }
    });
  }
  }

</script>

