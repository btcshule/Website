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


                <div class="row mb-2">
                  <div class="col-sm-5">
                    <a href="javascript:void(0);" onclick="new_record()" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Nouveau</a>
                  </div>

                </div>


                <table id="mytable" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                    <tr>
                      <th>IDENTIFICATION</th>
                      <th>MATRICULE</th>
                      <th>PROFIL</th>
                      <th>DEPARTEMENT</th>
                      <th>DATE CREATION</th>
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







































