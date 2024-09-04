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
          <h5 class="m-0">Report</h5>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Report</li>
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
            
                <div class="card-body" style="overflow-x: auto;position: relative;">
                  <form action="<?= base_url("index.php/exit/Todo/save") ?>" method="POST">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Specify a task<span style="color:red">*</span></label>
                      <textarea type="text" class="form-control" name="ID_SERV_COMMANDE" id="ID_SERV_COMMANDE"></textarea>

                      <?php echo form_error('ID_SERV_COMMANDE', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="col-md-4">
                      <label>Quantity<span style="color:red">*</span></label>
                       <input type="text" maxlength="4" class="form-control" name="QNTY" id="QNTY">
                       <?php echo form_error('QNTY', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="col-md-4">
                      <label>Client it belong<span style="color:red">*</span></label>
                      <input type="text" class="form-control" name="CLIENT" id="CLIENT">
                      <?php echo form_error('CLIENT', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="col-md-4">
                      <label>Date prevue de livraison<span style="color:red">*</span></label>
                      <input type="date" min="<?=date('Y-m-d')?>" class="form-control" name="DATE_LIVR" id="DATE_LIVR">
                      <?php echo form_error('DATE_LIVR', '<div class="text-danger">', '</div>'); ?>
                    </div>
                  </div>
                  <div class="col-lg-12" style="padding-top:15px">
                    <div style="float:right;">
                      <button type="reset" class="btn btn-dark"><i class="fa fa-window-restore"></i>&nbspResert</button>
                      <button class="btn btn-primary"><i class="fa fa-save"></i>&nbspRegister</button>
                    </div>
                  </div>
                  </div>
            </form>
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
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include VIEWPATH.'templates/footer.php'; ?>

