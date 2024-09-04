<!DOCTYPE html>
<html lang="en">

<head>
  <?php include VIEWPATH . 'includes/head.php'; ?>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/highcharts-more.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>


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
         <div class="row column1">
          <div class="col-md-12">
           <div class="white_shd full margin_bottom_30">
            <div class="row" style="margin-top: 40px">
              <div class="col-md-6 col-sm-6">
                <div style="margin-left: 20px;" class="form-group">
                  <LABEL>Séléctionner année</LABEL>
                  <select class="form-control" onchange="get_rapport();" name="FILTRE" id="FILTRE" >
                    <?php
                    $anneeEnCours = date("Y");
                    for ($i = $anneeEnCours; $i >= $anneeEnCours - 2; $i--) {
                      echo "<option value='$i'>$i</option>";
                    }
                    ?>

                  </select>
                </div>
              </div>


            </div>

          </div>


          <div class="row">
            <div class="col-md-12" style="margin-bottom: 20px"></div>     
            <div id="container"  class="col-md-12" ></div> 
            <div class="col-md-12" style="margin-bottom: 20px"></div>
            <div id="container2"  class="col-md-6" ></div> 
            <div id="container1"  class="col-md-6" ></div> 
            <div class="col-md-12" style="margin-bottom: 20px"></div>
            <div id="container3"  class="col-md-12" ></div> 


          </div>
        </div>
      </div>
       </div>
    <!-- end row -->


    <div id="nouveau"></div>
    <div id="nouveau1"></div>
    <div id="nouveau2"></div>
    <div id="nouveau3"></div>
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
  $( document ).ready(function() {
    get_rapport();
  });

</script>

<script> 
 function get_rapport(){

  var FILTRE=$('#FILTRE').val();
    // alert(FILTRE);

  $.ajax({
    url : "<?=base_url()?>index.php/rapport/Dashboard/get_rapport/",
    type : "POST",
    dataType: "JSON",
    cache:false,
    data:{
      FILTRE: FILTRE
    },
    success:function(data){  

      $('#container1').html("");             
      $('#nouveau20').html(data.rapp);
      $('#container1').html("");             
      $('#nouveau1').html(data.rapp1);
      $('#container2').html("");             
      $('#nouveau2').html(data.rapp2);
      $('#container3').html("");             
      $('#nouveau3').html(data.rapp3);

    },            

  });  
}

</script> 