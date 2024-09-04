

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include VIEWPATH.'includes/header.php' ?>

</head>
<style type="text/css">
 <?php include VIEWPATH.'includes/style.css' ?>
</style>
<?php 
$add  ='active';
$list ='';
?>

<body style="font-size:16px">
  <div class="container-fluid" style="background-color: white">
    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 5px" id="navp">
        <!-- /.navbar-top-links -->
        <?php include VIEWPATH.'includes/menu_principal.php' ?>
        <!-- /.navbar-static-side -->
      </nav>

      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-12" style=" margin-bottom: 5px;">
              <div class="row" style="" id="conta">
                <?= $breadcrumb ?> 
              </div>
              <div class="row" id="conta" style="margin-top: -10px">
                <div class="col-lg-6 col-md-6">

                  <h4 class=""><b>Adding a lost material</b></h4> 
                </div>
                <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                  <ul class="nav nav-pills pull-right">
                    <li ><a style="border:#0843ca solid;color:#eda323 " href="<?php echo base_url() ?>index.php/suivi/Lost/listing"><i class="fa fa-list"></i> All lost materials</a></li>
                  </ul>
                </div>
              </div>  
            </div>
            <div class="col-lg-12 jumbotron" style="padding: 5px">
              <div class="basic-form" >
                <form method="post" action="<?=base_url()?>index.php/suivi/Lost/ajouter">
                  <div class="form-row">

                    <div class="form-group col-md-6">
                      <label style="color:#454545">Quantity <span class="text-danger" style="color:red">*</span></label>
                      <input type="number" autocomplete="off" class="form-control" name="QTE_MATERIEL" id="QTE_MATERIEL" placeholder="" value="">
                      <?php echo form_error('QTE_MATERIEL', '<div class="text-danger" style="color:red">', '</div>'); ?>
                    </div>
                  

                    <div class="form-group col-md-6">
                      <label style="color:#454545">Description <span class="text-danger"  style="color:red">*</span></label>
                      <input type="text" autocomplete="off" class="form-control" name="COMMENTS" id="COMMENTS">
                      <?php echo form_error('COMMENTS', '<div class="text-danger" style="color:red">', '</div>'); ?>
                    </div>

                  </div>
                  <div class="form-group col-md-12">
                    <button type="submit" style="float: right;color:white;background-color:#0843ca;border-radius: 15px;" class="btn "><span class="fa fa-save"></span> Save and move</button>
                  </div>
                </form>
              </div>
            </div>

          </div>
          <!-- /.row -->
          <?php include VIEWPATH.'includes/footer.php' ;?>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->

    </div>
  </div>

</body>

</html>
