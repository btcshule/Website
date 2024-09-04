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

            <div class="row col-12">
              <form  method="POST" id="frmdr">
              <?php 
              foreach ($profils as $key) 
                {?>
                  <div class="col-md-12">
                   <div class="mt-2">
                    <a class="text-dark" href="javascript:void(0)">
                      <input type="checkbox" onclick=" get_info()" class="form-check-input"  name="PROFILE_ID<?=$key['PROFILE_ID']?>" id="PROFILE_ID<?=$key['PROFILE_ID']?>">
                      <label class="form-check-label" for="task<?=$key['PROFILE_ID']?>">
                        <?=$key['DESC_PROFIL']?>
                      </label> 
                      <br><br>
                    </a>
                    <div class="collapse show" id="menu-content<?=$key['PROFILE_ID']?>">
                      <div class="card mb-0">
                        <div class="card-body">

                          <div class="row justify-content-sm-between">
                            <div class="col-sm-6 mb-2 mb-sm-0">
                              <?php 
                              foreach ($menus as $value) {
                                ?>
                                <div class="form-check">
                                  <input type="checkbox" onclick="get_info(this.value)" class="form-check-input" name="MENU_ID<?=$key['PROFILE_ID']?><?=$value['MENU_ID']?>"   id="MENU_ID<?=$key['PROFILE_ID']?><?=$value['MENU_ID']?>">
                                  <label class="form-check-label" for="MENU_ID<?=$key['PROFILE_ID']?><?=$value['MENU_ID']?>">
                                    <?=$value['MENU_DESC']?>
                                  </label>
                                </div> 
                                
                                <?php 
                              }
                              ?>
                            </div> 

                          </div>

                        </div> 
                      </div> 
                    </div> 
                    <br>
                  </div> 
                </div>

                <?php 
              }
              ?>
              <button type="button" id="push-data" onclick="push_data()">send</button>
            </form>

            </div>
          </div> <!-- end col -->
        </div>

      </div> <!-- container -->

    </div> <!-- content -->

  </div>


</div>
<!-- END wrapper -->


<div class="rightbar-overlay"></div>
<!-- /End-bar -->


<!-- bundle -->
<?php include VIEWPATH . 'includes/foot.php'; ?>

</body>

</html>

<script>
  $(document).ready(function()
  {
    // get_info();
  });
</script>

<script>
  function get_info()
  {
    var profil=<?=$nbre_profil?>;
    var menus=<?=$nbre_menu?>;

    for (var i=1;i<=profil;i++) {

          var profil_id=$('[name="PROFILE_ID'+i+'"]');

          if (profil_id.is(":checked")) {
            document.getElementById('PROFILE_ID'+i).value=i;
            var PROFILE_ID=i;
          }

          for (var j =1; j <= menus; j++) {

            var menu_id=$('[name="MENU_ID'+i+''+j+'"]');
            if (menu_id.is(":checked")) {
              // alert(i+''+j)
              document.getElementById(menu_id).value=1;
            }else{
              document.getElementById(menu_id).value=0;
            }
            
          }
     

    }

  }
</script>

<script>
  function push_data()
  {
    $('#push-data').text('Send');
     $('#push-data').attr("disabled",true);

     var url;

     url="<?php echo base_url('administration/Droits_utilisateurs/add')?>";
   

    var formData = new FormData($('#frmdr')[0]);

    $.ajax({

        url:url,
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        dataType:"JSON",
        success: function(data)
        {
         

        $('#push-data').text('Send');
        $('#push-data').attr('disabled',false); 


    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      alert('Erreur s\'est produite');
      $('#push-data').text('Send');
      $('#push-data').attr('disabled',false);

  }


});
  }
</script>



