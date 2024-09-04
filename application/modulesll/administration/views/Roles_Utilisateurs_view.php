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
          <div class="col-md-7">
            <div class="card">
              <div class="card-body">

               <div class="row">
                <div class="col-md-5">
                  <div class="mb-3">
                    <label for="billing-first-name" class="form-label">Identification</label>
                    <input class="form-control" value="<?=$data_emp['IDENTIFICATION']?>"  readonly="" type="text">
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="mb-3">
                    <label for="billing-first-name" class="form-label">Affectation</label>
                    <input class="form-control" value="<?=$data_emp['AFFECTATION']?>" readonly="" type="text">
                  </div>
                </div>
                
              </div>

              <div class="row mb-2">
                <input type="hidden" id="PROFIL_ID" name="PROFIL_ID" value="<?=$data_emp['PROFILE_ID']?>">
                <input type="hidden" id="USER_ID" name="USER_ID" value="<?=$data_emp['EMPLOYE_ID']?>">
                <div class="col-md-12">
                  <label>Menus</label>
                  <select class="form-control" onchange="get_sous_menu_profile()" id="MENU_ID" name="MENU_ID">
                    <option value="0">--</option>
                    <?php 
                    foreach ($menu_profile as $key) {
                        # code...
                      echo "<option value='".$key['MENU_ID']."'>".$key['MENU_DESC']."</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <!-- <span class="help-block"></span> -->
              <div class="row mb-2" style="display: none;" id="SOUS_MENU_DIV">
                <div class="col-sm-12" id="SOUS_MENU">
                </div>
              </div>

            </div> <!-- end card-body -->
          </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-5">
          <div class="card">
            <div class="card-body">

              <div class="row">
                <div class="col-md-8">
                  <div class="mb-3">
                    <label for="billing-last-name" class="form-label">Rôle</label>
                    <select class="form-control" id="PROFILE_ID" name="PROFILE_ID">
                      <?php
                      foreach ($profil as $key) {
                         # code...
                        if ($key['PROFILE_ID']==$data_emp['PROFILE_ID']) {
                          # code...
                          echo "<option value='".$key['PROFILE_ID']."' selected=''>".$key['DESC_PROFIL']."</option>";
                        }else{
                          echo "<option value='".$key['PROFILE_ID']."'>".$key['DESC_PROFIL']."</option>";
                        }
                      } 
                      ?>
                      
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3">
                    <label for="billing-last-name" class="form-label">Matricule</label>
                    <input class="form-control" id="MATRICULE" name="MATRICULE" value="<?=$data_emp['MATRICULE']?>" readonly="" type="text">
                  </div>
                </div>
              </div>

              <div class="row">
                <input type="hidden" name="EMPLOYE_ID" id="EMPLOYE_ID" value="<?=$data_emp['EMPLOYE_ID']?>">
                <div class="col-md-12">
                  <div class="mb-3">
                    <div class="form-check form-check-inline">
                      <input type="checkbox" <?=($data_emp['IS_USER_SYSTEM']==1)? 'checked': ''?>  class="form-check-input" name="IS_USER_SYSTEM" id="IS_USER_SYSTEM">
                      <label class="form-check-label"  for="IS_USER_SYSTEM">Est utilisateur du système?</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="checkbox"  name="IS_ACTIF"  <?=($data_emp['IS_ACTIF']==1)? 'checked': ''?> class="form-check-input" id="IS_ACTIF">
                      <label class="form-check-label" for="IS_ACTIF">Est actif?</label>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="col-md-12" <?=($data_emp['IS_USER_SYSTEM']==0)? 'hidden': ''?>>
                  <div class="alert alert-success" role="alert">
                    <i class="dripicons-lock"></i> <a onclick="confirmation()" href="javascript:void(0)">Réunitialiser le mot de passe</a>
                  </div>
                  
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <button type="button" id="btnApplyChange" onclick="appliquer_save_change_user()" class="btn btn-info">Appliquer les modifications</button>
                </div>
              </div>


            </div>
          </div>

        </div>


      </div>
      <!-- end row -->

    </div> <!-- container -->

  </div> <!-- content -->

  <!-- Footer Start -->
</div>
</div>
<div class="rightbar-overlay"></div>
<!-- bundle -->
<?php include VIEWPATH . 'includes/foot.php'; ?>
</body>
</html>


<script>

  function confirmation()
  {

    if (window.confirm("Voulez-vous synchroniser le mot de passe?")) {
  window.location.href="<?=base_url('administration/Roles_Utilisateurs/sychroniser_pwd/'.$data_emp['EMPLOYE_ID'])?>";
   }

  }



  function get_sous_menu_profile()
  {
    var MENU_ID=$('#MENU_ID').val();
    var PROFIL_ID=$('#PROFIL_ID').val();
    var USER_ID=$('#USER_ID').val();

    $.post('<?=base_url('administration/Roles_Utilisateurs/get_sous_menu_profile')?>',{

      MENU_ID:MENU_ID,
      PROFIL_ID:PROFIL_ID,
      USER_ID:USER_ID

    },function(data){
      if (MENU_ID!=0) {
        $('#SOUS_MENU_DIV').show();
        $('#SOUS_MENU').html(data);
      }else{
        $('#SOUS_MENU_DIV').hide();
      }
    })
  }
</script>



<script>
  function save_user_role_selected()
  {

   $('#btnSaveRole').text('Enregistrement ...');
   $('#btnSaveRole').attr("disabled",true);

   var url;
   var formData = new FormData();

   var USER_ID=$('#USER_ID').val();
   var PROFIL_ID=$('#PROFIL_ID').val();

   //Create an Array.
   var selected = new Array();
  //Reference the Table.
  var ulRoleUser = document.getElementById("ulRoleUser");
  //Reference all the CheckBoxes in Table.
  var chks = ulRoleUser.getElementsByTagName("INPUT");

  // Loop and push the checked CheckBox value in Array.
  for (var i = 0; i < chks.length; i++) {
    if (chks[i].checked) {
      selected.push(chks[i].value);
    }
  }

  //Display the selected CheckBox values.
  // if (selected.length > 0) {
  //   alert("Selected values: " + selected.join(","));
  // }

  formData.append('PROFIL_ID',PROFIL_ID);
  formData.append('USER_ID',USER_ID);
  formData.append('SOUS_MENU_ID',selected.join(","));


  if (selected.length > 0) {
    url="<?php echo base_url('administration/Roles_Utilisateurs/save_user_role_selected')?>";

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
          $('#btnSaveRole').text('Enregistrer');
          $('#btnSaveRole').attr('disabled',false); 

          alert_toast_validation('Opération',data.message,'success');

          $('#MENU_ID').val('--');
          $('#SOUS_MENU_DIV').hide();

          window.reload();

        }
        else
        {
          for (var i = 0; i < data.inputerror.length; i++) 
          {
            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);

            alert_toast_validation('Opération',data.error_string[i],'error');
          }
        }



        $('#btnSaveRole').text('Enregistrer');
        $('#btnSaveRole').attr('disabled',false); 


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
       $('#btnSaveRole').text('Enregistrer');
       $('#btnSaveRole').attr('disabled',false);

     }


   });
  }


}


</script>


<script>
  function remove_user_role_selected()
  {

   $('#btnSaveRoleRemove').text('Retirer ...');
   $('#btnSaveRoleRemove').attr("disabled",true);

   var url;
   var formData = new FormData();

   var USER_ID=$('#USER_ID').val();
   var PROFIL_ID=$('#PROFIL_ID').val();

   //Create an Array.
   var selected = new Array();
  //Reference the Table.
  var ulRoleUser = document.getElementById("ulRoleUser");
  //Reference all the CheckBoxes in Table.
  var chks = ulRoleUser.getElementsByTagName("INPUT");

  // Loop and push the checked CheckBox value in Array.
  for (var i = 0; i < chks.length; i++) {
    if (chks[i].checked) {
      selected.push(chks[i].value);
    }
  }

  //Display the selected CheckBox values.
  // if (selected.length > 0) {
  //   alert("Selected values: " + selected.join(","));
  // }

  formData.append('PROFIL_ID',PROFIL_ID);
  formData.append('USER_ID',USER_ID);
  formData.append('SOUS_MENU_ID',selected.join(","));


  if (selected.length > 0) {
    url="<?php echo base_url('administration/Roles_Utilisateurs/remove_user_role_selected')?>";

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
          $('#btnSaveRoleRemove').text('Retirer');
          $('#btnSaveRoleRemove').attr('disabled',false); 

          alert_toast_validation('Opération',data.message,'success');

          $('#MENU_ID').val('--');
          $('#SOUS_MENU_DIV').hide();

          window.reload();

        }
        else
        {
          alert_toast_validation('Opération',data.message,'error');
        }



        $('#btnSaveRoleRemove').text('Retirer');
        $('#btnSaveRoleRemove').attr('disabled',false); 


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
       $('#btnSaveRoleRemove').text('Retirer');
       $('#btnSaveRoleRemove').attr('disabled',false);

     }


   });
  }


}


</script>


<script>
  function appliquer_save_change_user()
  {

   $('#btnApplyChange').text('Appliquer ...');
   $('#btnApplyChange').attr("disabled",true);

   var url;
   var formDataApply = new FormData();


   if($('[name="IS_USER_SYSTEM"]').is(":checked"))
   {
    document.getElementById('IS_USER_SYSTEM').value=1;
  }else{
    document.getElementById('IS_USER_SYSTEM').value=0;
  }

  if($('[name="IS_ACTIF"]').is(":checked"))
  {
    document.getElementById('IS_ACTIF').value=1;
  }else{
    document.getElementById('IS_ACTIF').value=0;
  }



  var EMPLOYE_ID=$('#EMPLOYE_ID').val();
  var PROFILE_ID=$('#PROFILE_ID').val();
  var IS_ACTIF=$('#IS_ACTIF').val();
  var IS_USER_SYSTEM=$('#IS_USER_SYSTEM').val();
  var MATRICULE=$('#MATRICULE').val();



  formDataApply.append('PROFILE_ID',PROFILE_ID);
  formDataApply.append('EMPLOYE_ID',EMPLOYE_ID);
  formDataApply.append('IS_ACTIF',IS_ACTIF);
  formDataApply.append('IS_USER_SYSTEM',IS_USER_SYSTEM);
  formDataApply.append('MATRICULE',MATRICULE);




  url="<?php echo base_url('administration/Roles_Utilisateurs/appliquer_save_change_user')?>";

  $.ajax({

    url:url,
    type:"POST",
    data:formDataApply,
    contentType:false,
    processData:false,
    dataType:"JSON",
    success: function(data)
    {


      if(data.status) 
      {
        $('#btnApplyChange').text('Appliquer les modifications');
        $('#btnApplyChange').attr('disabled',false); 

        if (data.indicator==1) {

          alert_toast_validation('Opération',data.message,'success');

          setTimeout(() => {
            // console.log("Delayed for 1 second.");
            location.reload();
          }, 1000);

        } else {
          alert_toast_validation('Opération',data.message,'info');
        }

        }
        else
        {
          for (var i = 0; i < data.inputerror.length; i++) 
          {
            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);

            alert_toast_validation('Opération',data.error_string[i],'error');
          }
        }



        $('#btnApplyChange').text('Appliquer les modifications');
        $('#btnApplyChange').attr('disabled',false); 


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
       $('#btnApplyChange').text('Appliquer les modifications');
       $('#btnApplyChange').attr('disabled',false);

     }


   });
}



</script>