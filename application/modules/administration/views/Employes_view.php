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


                <?php 
                if ($this->session->userdata('EMPLOYE_CREATION')==1) {?>
                 <div class="row mb-2">
                  <div class="col-sm-5">
                    <a href="javascript:void(0);" onclick="new_record()" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Nouvel</a>
                  </div>

                </div>
                <?php 
                }
                ?>


                <table id="mytable" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                    <tr>
                      <th>IDENTIFICATION</th>
                      <th>MATRICULE</th>
                      <!-- <th>EMAIL</th> -->
                      <th>PROFIL</th>
                      <th>ORGANISATION</th>
                      <th>STATUT</th>
                      <th>ACTION</th>
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

          <script type="text/javascript">
            function manager_check_button()
            {
              var PROFILE_ID=$('#PROFILE_ID').val();

              if (PROFILE_ID==1) {
                $('#IS_BACKEND_USER').hide();
              }else{
                $('#IS_BACKEND_USER').show();
              }
            }
          </script>


          <script>
            function new_record(){

              save_method = 'add';
              $('#emp_form')[0].reset();
              $('.form-group').removeClass('has-error');
              $('.help-block').empty(); 
              $('#emp-modal').modal('show');
              $('#IS_BACKEND_USER').prop('hidden',false);
              $('#PWD').prop('hidden',false);
              $('.modal-title').text('Nouvel employé');
            }
          </script>

          <script>
            function show_switch_button()
            {

              if ($('#IS_USER_SYSTEM').is(':checked')) 
              {
                $('#PWD').show();
                document.getElementById('IS_USER_SYSTEM').value=1;
                
              }else{

                $('#PWD').hide();
                $('#MOT_DE_PASSE').val('');
                document.getElementById('IS_USER_SYSTEM').value=0;
              }

              
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
                url:"<?php echo base_url('administration/Employes/liste')?>",
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

           $('button').text('Enregistrement ...');
           $('#button').attr("disabled",true);

           var url;

           if (save_method=="add") 
           {
            url="<?php echo base_url('administration/Employes/add')?>";
          }
          else
          {
            url="<?php echo base_url('administration/Employes/update')?>";
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
           $('button').text('Enregistrer');
           $('button').attr('disabled',false);

         }


       });



        }




        function edit_emp(id)
        {
          save_method = 'update';
          $('#emp_form')[0].reset();
          $.ajax({
            url : "<?php echo site_url('administration/Employes/getOne')?>/"+ id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

              // if (data.EMPLOYE_ID) {
              //   $('#PWD').prop('hidden',true);
              //   $('#IS_BACKEND_USER').prop('hidden',true);
              // }else{
              //   $('#IS_BACKEND_USER').prop('hidden',false);
              // }

              // alert(data.IS_USER_SYSTEM)

              if (data.IS_USER_SYSTEM==1) 
              {
                $('#IS_USER_SYSTEM').prop('checked',true);

              }else{
                $('#IS_USER_SYSTEM').prop('checked',false);
                $('#IS_BACKEND_USER').prop('hidden',true);
              }

              


              $('[name="EMPLOYE_ID"]').val(data.EMPLOYE_ID);
              $('[name="NOM_EMP"]').val(data.NOM_EMP);
              $('[name="PRENOM_EMP"]').val(data.PRENOM_EMP);
              $('[name="PROFILE_ID"]').val(data.PROFILE_ID);
              $('[name="AGENCE_ID"]').val(data.AGENCE_ID);
              $('[name="MATRICULE"]').val(data.MATRICULE);
              $('[name="DEPARTEMENT_ID"]').val(data.DEPARTEMENT_ID);
              $('[name="EMAIL_EMP"]').val(data.EMAIL_EMP);

              $('#emp-modal').modal('show'); 
              $('.modal-title').text('Modifier un employé'); 
              $('#btnSave').text('Modifier');


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
              url : "<?php echo base_url('administration/Employes/supp_logic')?>/"+id+'/'+is_actif,
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






        function confirm_item(id,statut)
        {

          let message;
          message="Voulez-vous exécuté cette opération?";

          if (confirm(message)) {
            $.ajax({
              url : "<?php echo base_url('administration/Employes/confirm_item')?>/"+id+'/'+statut,
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







      <div id="emp-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
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
                              <label class="form-label">Nom <span style="color: red;">*</span></label>
                              <input type="text" autocomplete="off" name="NOM_EMP" class="form-control" id="NOM_EMP" autofocus>
                              <span class="help-block"></span>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label">Prénom <span style="color: red;">*</span></label>
                              <input type="text" autocomplete="off" name="PRENOM_EMP" class="form-control" id="PRENOM_EMP" autofocus>
                              <span class="help-block"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label">Email<span style="color: red;"></span></label>
                              <input type="text" autocomplete="off" name="EMAIL_EMP" class="form-control" id="EMAIL_EMP" autofocus>
                              <span class="help-block"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label">Agence <span style="color: red;">*</span></label>
                              <select class="form-control" id="AGENCE_ID" name="AGENCE_ID">
                                <option value="0">Sélectionner</option>
                                <?php
                                foreach ($agences as $a) {
                                                // code...
                                  echo "<option value=".$a['AGENCE_ID'].">".$a['AGENCE_NOM']."</option>";
                                }
                                ?>

                              </select>
                              <span class="help-block"></span>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label">Unité d'organisation <span style="color: red;">*</span></label>
                              <select class="form-control" id="DEPARTEMENT_ID" name="DEPARTEMENT_ID">
                                <option value="0">Sélectionner</option>
                                <?php
                                foreach ($depts as $d) {
                                                // code...
                                  echo "<option value=".$d['DEPARTEMENT_ID'].">".$d['DESC_DEPARTEMENT']."</option>";
                                }
                                ?>

                              </select>
                              <span class="help-block"></span>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label">Profil <span style="color: red;">*</span></label>
                              <select class="form-control" onchange="manager_check_button()" id="PROFILE_ID" name="PROFILE_ID">
                                <option value="0">Sélectionner</option>
                                <?php
                                foreach ($profil as $p) {
                                                // code...
                                  echo "<option value=".$p['PROFILE_ID'].">".$p['DESC_PROFIL']."</option>";
                                }
                                ?>

                              </select>
                              <span class="help-block"></span>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label">Matricule <span style="color: red;">*</span></label>
                              <input type="text" autocomplete="off" name="MATRICULE" class="form-control" id="MATRICULE" autofocus>
                              <span class="help-block"></span>
                            </div>
                          </div>
                        </div>



                        <div class="col-md-6" id="IS_BACKEND_USER">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label">Est-t-il utilisateur du système? <span style="color: red;"></span></label><br>
                              <input type="checkbox" id="IS_USER_SYSTEM" onclick="show_switch_button()" name="IS_USER_SYSTEM">
                            </div>
                          </div>
                        </div>



                      <!--   <div class="col-md-6" style="display: none;" id="PWD">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label">Mot de passe <span style="color: red;"></span></label>
                              <input type="password" class="form-control" autocomplete="off" data-provide="typeahead" id="MOT_DE_PASSE" name="MOT_DE_PASSE">
                              <span class="help-block"></span>
                            </div>
                          </div>
                        </div> -->




                      </div>
                    </div>
                  </form>
                </div>

              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> -->
                <button type="button" id="btnSave" onclick="enr()" class="btn btn-info">Enregistrer</button>
              </div>
            </div>
          </div>
        </div>
      </div>





































