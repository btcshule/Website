<?php include VIEWPATH.'templates/header.php'; ?>
<style>
  .help-block{color: red;}
</style>
rel="stylesheet" />
<body class="hold-transition layout-top-nav layout-navbar-fixed">
  <div class="wrapper">

    <!-- Navbar -->

    <?php include VIEWPATH.'templates/menu.php'; ?>

    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5 class="m-0" ><?=$title?></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#" >Sales</a></li>
                <li class="breadcrumb-item active" >Exits</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- /.content-header -->

      <!-- Main content -->

      <div class="container" style="background-image:src='images/bg_all.jpg'">
        <!-- <div class="row"> -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" style="overflow-x: auto;" >
                <form method="post" enctype="multipart/form-data">
                  <div class="table-responsive" style="padding:10px">
                    <div class="table-bordered row">
                      <tr >
                        <div class="col-md-4">
                          <label><b>&nbsp&nbspCUSTOMER NAME</b></label>
                          <input  type="text" name="NAME" id="NAME" class="form-control" value="<?=set_value('')?>" >
                        </div>
                        <div class="col-md-4">
                          <label><b>&nbsp&nbspADRESS</b></label>
                          <input  type="text" name="ADRESS" id="ADRESS" class="form-control" value="<?=set_value('')?>"></div>
                          <div class="col-md-4">
                            <label><b>&nbsp&nbspCUSTOMER TEL</b></label>
                            <input  type="text" name="TEL" id="TEL" value="<?=set_value('')?>" class="form-control">
                          </div>
                          <div class="col-md-4">
                            <label><b>&nbsp&nbspOPERATOR</b></label>
                            <input  type="text" class="form-control" readonly value="EMSI -IMPRIMERIE"></div>
                            <div class="col-md-4">
                              <label><b>&nbsp&nbspSERVER</b></label>
                              <input  type="text" class="form-control" readonly value="NDAYISENGA Advaxe"></div>
                            </tr>
                          </div>

                          <div class="col-lg-12 row" >
                            <div class="form-group col-lg-2">
                              <label><b>&nbsp&nbspFilter</b></label>
                              <select  name="UNITE_MESURE" id="UNITE_MESURE" class="form-control" onchange="show_design_serv();hide_design_if_servequal_zero();getdesignations()" onkeyup="getdesignations();show_design_serv();hide_design_if_servequal_zero()();getdesignations()">

                               <option value="">---Select---</option>
                               <?php
                               foreach($Measure as $pro)
                               {

                                 ?>
                                 <option value="<?= $pro['CATH_ID'] ?>"><?=$pro['CATH_DESC']; ?></option>
                                 <?php
                               }
                               ?>
                             </select>
                           </div>
                           <div class="form-group col-lg-3" id="hide_design_if_servequal_zero">
                            <label><b>&nbsp&nbspDesignation</b></label>
                            <select  name="DESIGNATION" id="DESIGNATION" onchange="get_data();" class="form-control search_product" data-live-search="true">
                              <option>Select</option>
                              <?php
                              foreach($produit as $pro)
                              {

                                ?>
                                <option value="<?= $pro['PRODUCT_ID'] ?>"><?=$pro['PRODUCT_DESC']; ?></option>
                                <?php
                              }
                              ?>

                            </select>
                          </div>
                          <div class="form-group col-lg-5" id="show_design_serv" style="display:none">
                            <label><b>&nbsp&nbspDesignation</b></label>
                            <select  name="DESIGNATION_SERVICE" id="DESIGNATION_SERVICE" onchange="get_data_service()" class="form-control select2" data-live-search="true">
                              <option>Select</option>
                              <?php
                              $service=$this->Model->getRequete('SELECT `SECR_SERVICE_ID`, `SERVICE_DESCR`, `P_U_SERV`, `IS_AVAILABLE` FROM `services_secretariat` WHERE IS_AVAILABLE=1');
                              foreach($service as $pro)
                              {

                                ?>
                                <option value="<?= $pro['SECR_SERVICE_ID'] ?>"><?=$pro['SERVICE_DESCR']; ?></option>
                                <?php
                              }
                              ?>

                            </select>
                          </div>
                          <div class="form-group col-lg-2" id="hide_qnteavailable_if_servequal_zero">
                            <label><b>&nbsp&nbspQty Available</b></label>
                            <input   type="text" name="QUANTITE" required="true"
                            placeholder="QUANTITE" id="QUANTITE" class="form-control" disabled 
                            />
                          </div>
                          <div class="form-group col-lg-2">
                            <label><b>&nbsp&nbspQuantity</b></label>
                            <input  type="decimal" name="QUANTIT" required="true"
                            placeholder="QUANTITE" maxlength="4" id="QUANTITEUN" onkeydown="get_sum()" onkeyup="get_sum()" class="form-control"
                            />
                            <span style="color:red;font-family: bold;" id="erro_QUANTITEUN"></span>
                          </div>
                          <input type="hidden" name="" id="pt">
                          <div class="form-group col-lg-2">
                            <label><b>&nbsp&nbspUnit price</b></label>
                            <input type="decimal"  name="PRIX_UNITAIRE" required="true" onkeydown="get_tot()" onkeyup="get_tot()"
                            placeholder="UNIT PRICE" id="PRIX_UNITAIRE" class="form-control"
                            />
                          </div>
                          <div class="form-group col-lg-1" style ="padding:30px">
                            <a id="cartinfo" onclick="info_cart();" class=" btn btn-primary"><span class="nav-icon fas fa-plus" aria-hidden="true"></span></a>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12" id="conta" style="padding: 5px;">
                        <div id="CART_FILE" class="col-lg-12"></div>
                        <br>
                        <br>
                        <div id="show_btn" style="display: none;float: right;">
                          <a id="btn" class="btn btn-primary" style="float: right;" onclick="get_modal()"><span class="fa fa-check" aria-hidden="true"></span> 
                            Pay Invoice
                          </a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <br>
          <?php include VIEWPATH.'templates/footer.php'; ?>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog xl">
              <div class="modal-content">
                <!-- <form id="frmcost" method="POST"> -->

                  <div class="modal-body" style="margin-left: 50px;">
                    <h3 class="text-danger">Are you sure want to validate?</h3>
                    <br>
                    <div class="modal-footer">
                      <a type="button" id="idmodal" onclick="save_info()" class="btn btn-success" style="color:white">YES</a>
                      <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    <!-- </form> -->
                  </div>
                </div>

              </div>
            </body>
            </html>
            <script type="text/javascript">
             $("#QUANTITEUN,#PRIX_UNITAIRE,#TEL").on('input paste change keyup', function()      
             {
              $(this).val($(this).val().replace(/[^0-9]*$/gi, ''));
              $(this).val($(this).val().replace(' ', ''));
            });
          </script>
          <script type="text/javascript">

            $('#TEL').on('input change',function()
{                                                             //gestion des input telephone
  $(this).val($(this).val().replace(/[^0-9]*$/gi, ''));
  $(this).val($(this).val().replace(' ', ''));
  if ($(this).val().length == 12 || $(this).val().length == 8)
  {
    $('#error_tel').text('')
    $('[name = "TEL"]').removeClass('is-invalid').addClass('is-valid');
  }
  else
  {
    $('#error_tel').text('Incorrect number');
    $('[name = "TEL"]').removeClass('is-valid').addClass('is-invalid');
  }
// var lnch=$(this).val().length;
// alert(lnch);
});
</script>
<script type="text/javascript">
  function hide_design_if_servequal_zero() {

    var UNITE_MESURE = $("#UNITE_MESURE").val();

    if(UNITE_MESURE ==0){
      $("#hide_design_if_servequal_zero").hide();
      $("#hide_qnteavailable_if_servequal_zero").hide();
    }else{
      $("#hide_qnteavailable_if_servequal_zero").show()
      $("#hide_design_if_servequal_zero").show()
    }
    //alert(UNITE_MESURE)
  };

  function show_design_serv() {

    var UNITE_MESURE = $("#UNITE_MESURE").val();

    if(UNITE_MESURE ==0){
      $("#show_design_serv").show();
    }else{
      $("#show_design_serv").hide()
    }
  };


$(function() {
   
    $('.search_product').select2();
});
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
<script >
  function getdesignations()
  {
    var UNITE_MESURE=$('#UNITE_MESURE').val();
    $.ajax(
    {
      url: "<?php echo base_url('index.php/exit/Sale/getdesignations/');?>"+UNITE_MESURE,
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
  function get_data(){

    var DESIGNATION=$('#DESIGNATION').val();
    $.ajax(
    {
      url:"<?=base_url()?>index.php/exit/Sale/get_data/"+DESIGNATION,
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
<script type="text/javascript">
  function get_data_service()
  {

    var DESIGNATION_SERVICE=$('#DESIGNATION_SERVICE').val();
    $.ajax(
    {
      url:"<?=base_url()?>index.php/exit/Sale/get_data_service/"+DESIGNATION_SERVICE,
      type:"GET",
      dataType:"JSON",
      success: function(data)
      {
        $('#PRIX_UNITAIRE').val(data.P_U_SERV);
      }
    });
  }
</script>


<script>
  function info_cart() {
    // alert();
    var statut= true;
    var file = new FormData();
    const QUANTITEUN = $('#QUANTITEUN').val();
    const QUANTITE=$('#QUANTITE').val();

    var UNITE_MESURE = $('#UNITE_MESURE').val();
      // alert(UNITE_MESURE); 
    if (UNITE_MESURE!=0) { 
      var DESIGNATION = $('#DESIGNATION').val();

      var QUANTITEUN1=Number(QUANTITEUN);
      var QUANTITE1=Number(QUANTITE);

      if (QUANTITE1 < QUANTITEUN1 || QUANTITEUN1==0) {
        $("#erro_QUANTITEUN").html("Not valide");
        statut=false;
        
      }else{
        statut=true;
        
      } 
    }

    if (UNITE_MESURE==0) { 
     var DESIGNATION = $('#DESIGNATION_SERVICE').val();
     var QUANTITE1=Number(QUANTITE);
     statut=true;

   }

   var pt = $('#pt').val();
   var PRIX_UNITAIRE = $('#PRIX_UNITAIRE').val();

   if ( statut==true) {

    $("#erro_QUANTITEUN").html(" ");

    if (QUANTITEUN != "" &&  DESIGNATION != "" && PRIX_UNITAIRE != "") {

      $.post("<?=base_url('index.php/exit/Sale/add_in_cart/')?>", {
        QUANTITEUN: QUANTITEUN,
        DESIGNATION: DESIGNATION,
        pt: pt,
        PRIX_UNITAIRE: PRIX_UNITAIRE,
        UNITE_MESURE: UNITE_MESURE
      }, function(response) {
        if (response) {
          $('#CART_FILE').html(response);
          // $('#CART_FILE').html(response);

          $('#show_btn').show();
          $('#QUANTITEUN').val('');
              // $('#DESIGNATION').val('');
          $('#PRIX_UNITAIRE').val('');
          $('#pt').val('');
          $('#QUANTITEUN').css('border-color', '#4169E1');
              // $('#DESIGNATION').css('border-color', '#4169E1');
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


function remove_cart(id) {

  var rowid = $('#rowid' + id).val();
  console.log('id' + rowid);
  $.post('<?=base_url('index.php/exit/Sale/remove_cart/')?>', {
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
    $('#idsave').attr('disabled',true);
    var NAME=$('#NAME').val();
    var TEL=$('#TEL').val();
    var ADRESS=$('#ADRESS').val();

    $.post("<?=base_url('exit/Sale/register')?>", {
      NAME: NAME,
      TEL: TEL,
      ADRESS: ADRESS
    }, function(data) {

      $('#staticBackdrop').modal('hide');
      window.location.reload('<?=base_url('index.php/exit/Sale/index')?>');

    })


  }

</script>