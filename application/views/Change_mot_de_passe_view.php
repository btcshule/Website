<!DOCTYPE html>
<html lang="en">

<head>
    <?php include VIEWPATH . 'includes/head.php'; ?>
</head>

<body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <div class="card-body p-4">

                            <form method="POST" action="<?= base_url('index.php/Login/go_submit') ?>" id="ValidChangePwdForm">
                                <center>
                                    <div id="message_login"></div>
                                </center>

                                <input type="hidden" id="" name="" value="<?=$this->session->userdata('EMPLOYE_ID')?>">

                                <div class="mb-3">
                                    <label for="matricul" class="form-label">Matricule</label>
                                    <input class="form-control" readonly=""  value="<?=$this->session->userdata('MATRICULE')?>" type="text" id="MATRICULE" autofocus autocomplete="off" name="MATRICULE">
                                </div>

                                <div class="mb-3">
                                    <label for="Ancien mot de passe" class="form-label">Ancien mot de passe</label>
                                    <input class="form-control" placeholder="Ancien mot de passe" type="password" id="ANCIEN_PWD" autofocus autocomplete="off" name="ANCIEN_PWD">
                                </div>

                                <div class="mb-3">
                                    <label for="Nouveau mot de passe" class="form-label">Nouveau mot de passe</label>
                                    <input class="form-control" placeholder="Nouveau mot de passe" type="password" id="NEW_PWD" autofocus autocomplete="off" name="NEW_PWD">
                                </div>

                                <div class="mb-3">
                                    <label for="Confirmer le mot de passe" class="form-label">Confirmer le mot de passe</label>
                                    <input class="form-control" placeholder="Confirmer le mot de passe" type="password" id="CONFIRM_PWD" autofocus autocomplete="off" name="CONFIRM_PWD">
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" id="sign" onclick="valid_pwd_change()" type="button"> Changer le mot de passe </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Retour à la page de <a href="<?=base_url('Login/index')?>" class="text-muted ms-1"><b>connexion</b></a></p>
                        </div> <!-- end col -->
                    </div>

                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!--  -->

    <?php include VIEWPATH . 'includes/foot.php'; ?>

</body>

</html>


<script type="text/javascript">
    function valid_pwd_change()
    {
        $('button').text('Chargement ...');
        $('button').attr("disabled",true);

        var url;

        url="<?php echo base_url('Login/valid_pwd_change')?>";
        

        var formData = new FormData($('#ValidChangePwdForm')[0]);

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

                 alert_toast_validation('Réussie',data.message,'success');

                  setTimeout(function() {
                      $('#ValidChangePwdForm').submit();

                  }, 1000);
              }
              else
              {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 

                    alert_toast_validation('Erreur',data.error_string[i],'error');
                }
             }

            $('button').text('Changer le mot de passe');
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
       $('button').text('Changer le mot de passe');
       $('button').attr('disabled',false);

   }


});
    }
</script>

