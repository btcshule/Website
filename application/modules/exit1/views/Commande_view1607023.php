<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'templates/header.php' ?>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include VIEWPATH.'templates/navbar.php' ?>
    <!-- /.navbar -->
    <!-- Sidebar Menu -->
    <?php include VIEWPATH.'templates/menu.php' ?>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
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
            <div class="card-body" style="overflow-x: auto;" >
              <div class="row" style="padding: 1px" >
                <fieldset class ="border p-2">
                  <div class="row">
                    <div class="col-md-3">
                      <label><b>&nbsp&nbspCUSTOMER</b></label>
                      <input  type="text" name="NAME" id="NAME" readonly class="form-control" value="<?=$customer['NOM_GROS_CLIENT']?>" >
                    </div>
                    <div class="col-md-2">
                      <label><b>&nbsp&nbspADRESS</b></label>
                      <input  type="text" name="ADRESS" id="ADRESS" readonly class="form-control" value="<?=$customer['ADRESS_GROS_CLIENT']?>"></div>
                      <div class="col-md-2">
                        <label><b>&nbsp&nbsp CONTACT</b></label>
                        <input  type="text" name="TEL" id="TEL" readonly value="<?=$customer['TEL_GROS_CLIENT']?>" class="form-control">
                      </div>
                      <div class="col-md-2">
                        <label><b>&nbsp&nbspOPERATOR</b></label>
                        <input  type="text" class="form-control" readonly value="EMSI-MAGASIN"></div>
                        <div class="col-md-3">
                          <label><b>&nbsp&nbspSERVER</b></label>
                          <input  type="text" class="form-control" readonly value="NDAYISENGA Advaxe"></div>
                        </div>
                      </fieldset>
                    </div>
                    <!-- gegin -->
                    <form method="post">
                      <div class="row">
                        <input type="hidden" name="CLIENT_ID" id="CLIENT_ID" value="<?=$customer['GROS_CLIENT_ID']?>">
                        <div class="col-md-6">
                          <label>DESIGNATION</label>
                          <select name="ID_SERV_COMMANDE" id="ID_SERV_COMMANDE" onchange="get_prix()" class="form-control">

                            <option>Select</option>
                            <?php
                            foreach($service_commande as $pro)
                            {
                              if ($pro['ID_SERV_COMMANDE']==set_value('ID_SERV_COMMANDE'))
                              {
                                ?>
                                <option value="<?=$pro['ID_SERV_COMMANDE'] ?>" selected><?=$pro['DESCR_COMMANDE']; ?></option>
                                <?php
                              }
                              else
                              {
                                ?>
                                <option value="<?= $pro['ID_SERV_COMMANDE'] ?>"><?=$pro['DESCR_COMMANDE']; ?></option>
                                <?php
                              }
                            }
                            ?>

                          </select>

                        </div>
                        <div class="col-md-2">
                          <label><b>&nbsp&nbspUNIT PRICE</b></label>
                          <input  type="text" name="UNIT_PRICE" id="UNIT_PRICE" value="" class="form-control">
                        </div>
                        <div class="col-md-2">
                          <label><b>&nbsp&nbspQUANTITY</b></label>
                          <input  type="text" name="QUANTITY" id="QUANTITY" class="form-control"  value="">
                        </div>
                        <div class="col-md-2" style="padding:30px">
                          <a id="cartinfo" onclick="info_cart();" class=" btn btn-primary"><span class="nav-icon fas fa-plus" aria-hidden="true"></span> Check</a></div>
                        </div>
                      </form>
                      <!-- end -->
                      <div class="col-lg-12">
                        <?php
                        if ($showbtn!=0) {?>

                          <div class="col-md-12">
                            <table id='mytable' class="table table-bordered table-striped table-hover">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>DESIGNATION</th>
                                  <th>QUANTITY</th>
                                  <th>UNIT PRICE</th>
                                  <th>TOT.PRICE</th>
                                  <th>ACTION</th>
                                </tr>
                              </thead>

                              <tbody>

                                <?php 
                                $i=0;
                                foreach($gros_panier as $key) { 
                                  $i++;
                                  $service=$this->Model->getRequeteOne('SELECT `ID_SERV_COMMANDE`, `DESCR_COMMANDE`, `PRIX_PROP_U` FROM `service_commande` WHERE ID_SERV_COMMANDE='.$key['ID_SERV_COMMANDE']);

                                  ?>
                                  <tr>
                                    <td><?= $i;?></td>
                                    <td><?=$service['DESCR_COMMANDE']?></td>
                                    <td><?=$key['QNTE']?></td>
                                    <td><?=$key['PRIX_U']?></td>
                                    <td><?=$key['PRIX_U']*$key['QNTE']?></td>
                                    
                                    
                                    <td>
                                      <a><i></i></a>
                                    </td>
                                  </tr>
                                  <?php 

                                }

                                ?>

                              </tbody>
                            </table>

                            <div class="col-md-12">
                              <h5 style="float:right"> TOT.AMOUNT:&nbsp&nbsp<b><?=$PT?></b></h5>
                            </div><br><br>
                          </div>
                          <div id="show_btn">
                            <a id="btn" class="btn btn-primary" style="float:right" onclick="get_modal()"><span class="fa fa-check" aria-hidden="true"></span> 
                              Pay Invoice
                            </a>
                          </div>
                          <?php
                        }
                        ?>
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
        <?php include VIEWPATH.'templates/footer.php' ?>

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
                <input type="hidden" name="GROS_CLIENT_ID" value="<?=$customer['GROS_CLIENT_ID']?>" >
                <div class="row">
                  <div class="col-md-6">
                    <label>Delivery date<span style="color:red">*</span></label>
                    <input type="date" class="form-control" min="<?=date('Y-m-d')?>" name="">
                  </div>
                  
                  <div class="col-lg-6 row"><label>PAY ADVANCE?<span style="color: red;">*</span></label><br>
                    <input type="radio" name="colab_etr" id="colab_etr" value="1" onclick="check(value)" checked> YES
                    <input type="radio" name="colab_etr" id="colab_etr" value="2" onclick="check(value)"> NO
                  </div>
                  
                  <div class="col-md-6" id="div_colab_etr">
                    <label> Specify  Advance Amount</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" name="ADVANCE" id="ADVANCE">
                    </div>
                  </div>
                  <div class="col-md-6" id="div_moy_etr">
                    <label>Moyen de paiement</label>
                    <select class="form-control" name="MOYEN_PAIE" id="MOYEN_PAIE">
                      <option value="">-Select-</option>
                      <option value="1">Cash</option>
                      <option value="2">Bank deposit</option>
                    </select>
                  </div>
                </div>
                <br>
                <div class="modal-footer">
                  <button type="button" id="idsave" onclick="save_info()" class="btn btn-primary">YES</button>
                  <button type="reset" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>

        </div>

      </body>
      </html>
      <script type="text/javascript">
       $("#QUANTITEUN,#DEBTS").on('input paste change keyup', function()      
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
          $("#div_moy_etr").hide(); 
          $('#MOYEN_PAIE').val('');
          $('#ADVANCE').val('');
        }
        else if (value == 1)
        {
          $("#div_colab_etr").show();
          $("#div_moy_etr").show(); 

        }
      }

    </script>
    <script>
      function get_modal()
      {
        $('#btnSave').attr('disabled',false);
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
      function get_prix()
      {
       var QUANTITY=$('#QUANTITY').val('');
       var ID_SERV_COMMANDE=$('#ID_SERV_COMMANDE').val();
       $.ajax(
       {
        url:"<?=base_url()?>index.php/exit/Magasin_sales/get_prix/"+ID_SERV_COMMANDE,
        type:"GET",
        dataType:"JSON",
        success: function(data)
        {
          $('#QUANTITY').val('');
          $('#UNIT_PRICE').val(data.PRIX_PROP_U);

        }
      });
     }
   </script>
   <script>
    function info_cart() {
      var QUANTITY = $('#QUANTITY').val();
      var ID_SERV_COMMANDE = $('#ID_SERV_COMMANDE').val();
      var CLIENT_ID = $('#CLIENT_ID').val();
      var UNIT_PRICE = $('#UNIT_PRICE').val();

      if (QUANTITY != "" &&  ID_SERV_COMMANDE != "" && UNIT_PRICE != "") {
       $.ajax({
        type:"POST",
        data:{ID_SERV_COMMANDE:ID_SERV_COMMANDE,QUANTITY:QUANTITY,UNIT_PRICE:UNIT_PRICE,CLIENT_ID:CLIENT_ID},

        url: "<?php echo base_url('exit/Magasin_sales/add_in_panier/')?>",
        dataType:"JSON",
        success: function(data)
        {
         if(data.status) 
         {
          window.location.href= '<?=base_url('exit/Magasin_sales/commande/')?>'+data.CLIENT_ID;
        }else{
          for (var i = 0; i < data.inputerror.length; i++) 
          {
            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
          }
        }
        $('#btnSave').text('Enregistrer');
        $('#btnSave').attr('disabled',false); 
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        if (jqXHR.status==0) {
          alert("Vérifier votre connexion internet!");
        }else{
          if (errorThrown.status) 
          {
            alert('Une erreur s\'est produite');
          }
        }
        $('#btnSave').text('Enregistrer');
        $('#btnSave').attr('disabled',false);
      }
    });
     } else {
      var valid = true;

      if (!$('#QUANTITY').val()) {

        $('#QUANTITY').css('border-color', 'red');
        valid = false;
      } else {

        $('#QUANTITY').css('border-color', '#4169E1');
        valid = true;
      }
      if (!$('#ID_SERV_COMMANDE').val()) {

        $('#ID_SERV_COMMANDE').css('border-color', 'red');
        valid = false;
      } else {

        $('#ID_SERV_COMMANDE').css('border-color', '#4169E1');
        valid = true;
      }
      if (!$('#UNIT_PRICE').val()) {

        $('#UNIT_PRICE').css('border-color', 'red');
        valid = false;
      } else {

        $('#UNIT_PRICE').css('border-color', '#4169E1');
        valid = true;
      }
      return valid;
    }
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
        window.location.href='<?=base_url('')?>index.php/exit/Magasin_sales/pending';
      }
    });
  }

</script>