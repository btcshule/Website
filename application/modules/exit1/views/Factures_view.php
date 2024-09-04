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
                <h4 class="page-title"><?=$title?></h4>
              </div>
            </div>
          </div>  
        </div>
        <!-- Inline Form -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div style="padding-top: 5px;" class="col-md-12">
                  <table id='mytable' class="table table-bordered table-striped table-condensed" style="width: 100%;">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Date&nbsp;Payement</th>
                        <th>No&nbsp;Facture</th>
                        <th>Client&nbsp;</th>
                        <th>Total</th>
                        <th>Dette</th>
                        <th>Facture</th>
<!--                         <th>Action</th>
 -->                      </tr>
                    </thead>

                  </table>


                </div>
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
                    <!-- <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-md-block">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>
                            <a href="javascript: void(0);">Contact Us</a>
                        </div>
                      </div> -->
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
                url:"<?php echo base_url('index.php/exit/Pending/listing')?>",
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

            function supp_logic(id)
            {
              $('#u-modal').modal('show');

              $('#ID_CLIENT_FAC').val(id);

            }
            function enr()
            {
              var stat=true;
              var status=$('#STATUT_ID').val()
              // alert(status)
              if (status=="") {
                $('#error_stat').text('Champs requis');
                stat=false;
              }else{
                $('#error_stat').text('');

              }
              if (stat==true) {
                $('button').text('Enregistrement ...');
              $('button').attr("disabled",true);
               var url;
               url="<?php echo base_url('index.php/exit/Pending/update')?>";
               var formData = new FormData($('#u_form')[0]);

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
                  $('#u-modal').modal('hide');
                  table.ajax.reload(null,false);
                   alert_toast_validation('Réussite','Operation effectuée avec succès','success');
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

         </script>
<script type="text/javascript">
  function get_report_inventaire11(conn) {
    
    var url = '<?= base_url("index.php/rapport/Facturation/index/") ?>'+conn;
    var windowObjectReference = window.open(
      url,
      "DescriptiveWindowName",
      "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=900,width=500,height=1200"
    );
  }
</script>

         <div id="u-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header modal-colored-header">
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></a>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <form id="u_form" method="POST">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="mb-3">
                                <input type="hidden" name="ID_CLIENT_FAC" id="ID_CLIENT_FAC">
                                <label class="form-label"> Valider ou supprimer?<span style="color:red;">*</span></label>
                                <select class="form-control" name="STATUT_ID" id="STATUT_ID">
                                  <option value="">--Choisir l'action--</option>
                                  <option value="1"> Valider</option>
                                  <option value="22">Supprimer</option>
                                </select>
                                <div><span class="text-danger" id="error_stat"></span></div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </form>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" id="btnSave" onclick="enr()" class="btn btn-info">Valider</button>
                </div>
              </div>
            </div>
          </div>
        </div>














