<!DOCTYPE html>
<html lang="en">

<head>
  <?php include VIEWPATH . 'includes/head.php'; ?>
  <style type="text/css">
    label {
      color: black;
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

              <div>
                <form method="POST" action="<?=base_url()?>index.php/stock/Entrees_stock/ajouter" id="fromm">
                 <div class="col-md-12 row">

                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="mb-3">
                        <label>Catégories</label>
                        <select name="GROS_UNIT_ID" id="GROS_UNIT_ID" class="form-control" 
                        onchange="getdesignations()">

                        <option value="">---Séléctionner---</option>
                        <?php
                        foreach($Measure as $pro)
                        {
                          if ($pro['CATH_ID']==set_value('CATH_ID'))
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
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="mb-3">
                      <label style="font-weight: 900;">Nom article<span style ="color: red;">*</span></label>
                      <select name="GROS_PRODUIT_ID" id="GROS_PRODUIT_ID" class="form-control"
                      onchange="getprix()">
                      <option value="">--Sélectionner--</option>

                    </select>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <label for="">Type de stock<font color="red">*</font></label>
                <select name="TYPE_STOCK" id="TYPE_STOCK" class="form-control select2">
                  <option value="1">Pièce(s)</option>
                  <option value="2">Paquet(s)</option>
                </select>
                <div class="text-danger" id="TYPE_STOCKEerror"></div>
              </div>
              <!-- <div class="col-md-4">
                <div class="form-group">
                  <div class="mb-3">
                    <label style="font-weight: 900; color:#ffffff">Quantité Disponible<span style ="color: red;">*</span></label>
                   
                 </div>
               </div>
             </div>  -->
             <input type="hidden" autocomplete="off" class="form-control" name="QUANT_DISPO" id="QUANT_DISPO" placeholder="" required max="6"  value="<?=set_value('QUANT_DISPO');?>" readonly>
             <div class="col-md-4">
              <div class="form-group">
                <div class="mb-3">
                  <label for="QUANTITE" style="font-weight: 900;">Quantité ajoutée<span style ="color: red;">*</span></label>
                  <input type="text" autocomplete="off" class="form-control" name="QUANTITE" id="QUANTITE" placeholder="" required value="<?=set_value('QUANTITE');?>">
                </div>
              </div>
            </div>   

            <div class="col-md-4">
              <div class="form-group">
                <div class="mb-3">
                  <label for="PRIX_ACHAT" style="font-weight: 900;">Prix Achat<span style ="color: red;">*</span></label>
                  <input type="text" autocomplete="off" class="form-control" name="PRIX_ACHAT" id="PRIX_ACHAT1" placeholder="" required max="6">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div class="mb-3">
                  <label style="font-weight: 900;">Prix Vente<span style ="color: red;">*</span></label>
                  <input type="text" autocomplete="off" class="form-control" name="PRIX_VENTE" id="PRIX_VENTE1" placeholder="" required max="6">
                </div>
              </div>
            </div>              
            
            <div class="col-md-4">
              <div class="form-group">
                <div class="mb-3">
                  <label>Fournisseur</label>
                  <select name="ID_FOURNISSEUR" id="ID_FOURNISSEUR" class="form-control" required>

                    <option value="">---Séléctionner---</option>
                    <?php
                    foreach($fournisseur as $value)
                    {
                      if ($value['ID_FOURNISSEUR']==set_value('ID_FOURNISSEUR'))
                      {
                        ?>
                        <option value="<?=$value['ID_FOURNISSEUR'] ?>" selected><?=$value['NOM_FOURNISSEUR'].' '.$value['PRENOM_FOURNISSEUR'];?></option>
                        <?php
                      }
                      else
                      {
                        ?>
                        <option value="<?= $value['ID_FOURNISSEUR'] ?>"><?=$value['NOM_FOURNISSEUR'].' '.$value['PRENOM_FOURNISSEUR'];?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="form-group">
                <div class="mb-3">
                  <label style="font-weight: 900;">Commentaires<span style ="color: red;">*</span></label>
                  <input type="text" autocomplete="off" class="form-control" name="COMMENTAIRE" id="COMMENTAIRE" placeholder="Note pour rappel" required="completez">
                </div>
              </div>
            </div>


            <button type="submit" style="float: right;background-color:#eda323;color:white;border-radius:15px" class="btn"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Sauvegarder</button>
          </div>
        </form>
      </div>
    </div>

<!--         <div id="mytable-container" style="border: 5px solid gray; padding: 10px;">
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
</div> <!-- content --> -->

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
    $('.modal-title').text('Nouveau');
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
        url:"<?php echo base_url('index.php/stock/Entrees_stock/liste')?>",
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
        url:"<?=base_url('index.php/stock/Entrees_stock/getdesignations/')?>"+$('#GROS_UNIT_ID').val(),
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
      url: "<?=base_url('index.php/stock/Entrees_stock/getprix/')?>"+$('#GROS_PRODUIT_ID').val(),
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

<script>
  // Récupérer les références des champs de saisie
  const prixInput = document.getElementById('PRIX_ACHAT');
  const qteInput = document.getElementById('QUANTITE');
  const fraisInput = document.getElementById('FRAIS_TRANSPORT');
  const totalInput = document.getElementById('TOTAL_DEPENSES');

  // Ajouter un gestionnaire d'événement pour détecter les modifications des champs de saisie
  prixInput.addEventListener('input', updatedepenses);
  qteInput.addEventListener('input', updatedepenses);
  fraisInput.addEventListener('input', updatedepenses);


  function updatedepenses() {
    // Récupérer les valeurs des deux premiers champs
    const prixValue = parseFloat(prixInput.value) || 0;
    const qteValue = parseFloat(qteInput.value) || 0;
    const fraisValue = parseFloat(fraisInput.value) || 0;


    // Calculer la somme
    const somme = (prixValue * qteValue)+fraisValue;

    // Afficher la somme dans le troisième champ
    totalInput.value = somme.toFixed(0);
  }
</script>
<script>
  $(document).ready(function () {
    $('#categid').change(function () {
      if ($(this).val() == '2') {
        $('#autresCategorie').show();
        $('#dettes').prop('required', true);
        $('#TYPE_DETTE').prop('required', true);
      } else {
        $('#autresCategorie').hide();
        $('#dettes').prop('required', false);
        $('#TYPE_DETTE').prop('required', false);
      }
    });
  });
</script>