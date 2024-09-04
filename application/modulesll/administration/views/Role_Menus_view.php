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

                <form id="frmrolmenu" method="POST">
                  <div class="row mb-2">
                    <div class="col-sm-5">
                      <label>Rôles</label>
                      <select class="form-control" onchange="get_menu_profile()" id="PROFILE_ID" name="PROFILE_ID">
                        <option value="0">--</option>
                        <?php 
                        foreach ($profil as $key) {
                        # code...
                          echo "<option value='".$key['PROFILE_ID']."'>".$key['DESC_PROFIL']."</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <!-- <span class="help-block"></span> -->
                  <div class="row mb-2" style="display: none;" id="MENU_DIV">
                    <div class="col-sm-12" id="MENU">
                    </div>
                  </div>
                </form>

              </div> <!-- end card-body -->
            </div> <!-- end card -->
          </div> <!-- end col -->
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
  function get_menu_profile()
  {
    var PROFILE_ID=$('#PROFILE_ID').val();
    $.post('<?=base_url('administration/Role_Menus/get_menu_profile')?>',{
      PROFILE_ID:PROFILE_ID
    },function(data){
      if (PROFILE_ID!=0) {
        $('#MENU_DIV').show();
        $('#MENU').html(data);
      }else{
        $('#MENU_DIV').hide();
      }
    })
  }
</script>

<script type="text/javascript">
  function GetSelected() {
        //Create an Array.
        var selected = new Array();
        //Reference the Table.
        var ulMenuRole = document.getElementById("ulMenuRole");
        //Reference all the CheckBoxes in Table.
        var chks = ulMenuRole.getElementsByTagName("INPUT");

        // Loop and push the checked CheckBox value in Array.
        for (var i = 0; i < chks.length; i++) {
          if (chks[i].checked) {
            selected.push(chks[i].value);
          }
        }

        //Display the selected CheckBox values.
        if (selected.length > 0) {
          alert("Selected values: " + selected.join(","));
        }
      };
    </script>

<script>
      function save_menu_role_selected()
      {

       $('#btnSaveRole').text('Enregistrement ...');
       $('#btnSaveRole').attr("disabled",true);

       var url;
       var formData = new FormData();

       var PROFILE_ID=$('#PROFILE_ID').val();
   // const nbre_menu=$('#nbre_menu').val();

   //Create an Array.
   var selected = new Array();
  //Reference the Table.
  var ulMenuRole = document.getElementById("ulMenuRole");
  //Reference all the CheckBoxes in Table.
  var chks = ulMenuRole.getElementsByTagName("INPUT");

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

  formData.append('PROFILE_ID',PROFILE_ID);
  formData.append('MENU_ID',selected.join(","));


  if (selected.length > 0) {
    url="<?php echo base_url('administration/Role_Menus/save_menu_role_selected')?>";

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

          $('#PROFILE_ID').val('--');
          $('#MENU_DIV').hide();

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
  function remove_menu_role_selected()
  {

   $('#btnSaveRoleRemove').text('Enregistrement ...');
   $('#btnSaveRoleRemove').attr("disabled",true);

   var url;
   var formData = new FormData();

   var PROFILE_ID=$('#PROFILE_ID').val();
   // const nbre_menu=$('#nbre_menu').val();

   //Create an Array.
   var selected = new Array();
  //Reference the Table.
  var ulMenuRole = document.getElementById("ulMenuRole");
  //Reference all the CheckBoxes in Table.
  var chks = ulMenuRole.getElementsByTagName("INPUT");

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

  formData.append('PROFILE_ID',PROFILE_ID);
  formData.append('MENU_ID',selected.join(","));


  if (selected.length > 0) {
    url="<?php echo base_url('administration/Role_Menus/remove_menu_role_selected')?>";

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
          $('#btnSaveRoleRemove').text('Enregistrer');
          $('#btnSaveRoleRemove').attr('disabled',false); 

          alert_toast_validation('Opération',data.message,'success');

          $('#PROFILE_ID').val('--');
          $('#MENU_DIV').hide();

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



        $('#btnSaveRoleRemove').text('Enregistrer');
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
       $('#btnSaveRoleRemove').text('Enregistrer');
       $('#btnSaveRoleRemove').attr('disabled',false);

     }


   });
  }


}


</script>