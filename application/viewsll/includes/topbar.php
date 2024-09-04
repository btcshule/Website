<div class="navbar-custom" style="background-color: #9EFD38;">
    <ul class="list-unstyled topbar-menu float-end mb-0">
     <li> <center><h1>Sanya Day to Day</h1></center></li>
        
        <li class="dropdown notification-list topbar-dropdown">


            <nav aria-label="breadcrumb" hidden="">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="<?php echo base_url("Language/index/english"); ?>" style="color:<?=($this->session->userdata('site_lang')=='english')?'blue':'black'?>"><img src="<?=base_url()?>assets/images/flags/us.jpg" alt="user-image" class="me-0 me-sm-1" height="12"><?=$this->lang->line('option_eng')?></a></li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url("Language/index/french"); ?>" style="color:<?=($this->session->userdata('site_lang')=='french')?'blue':'black'?>"><img src="<?=base_url()?>assets/images/flags/fr.jpg" alt="user-image" class="me-1" height="12"><?=$this->lang->line('option_fr')?></a></li>
                </ol>
            </nav>
            
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" style="background-color:#FF8D33;color:white" data-bs-toggle="dropdown" href="file:///home/nice/Bureau/website/coderthemes.com/hyper_2/saas/form-elements.html#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="<?= base_url() ?>uploads/logo/avatar.PNG" alt="user-image" class="rounded-circle">
                   
                </span>
                <span>
                    <b>
                    <span class="account-user-name"><?=$this->session->userdata('MATRICULE')?></span>
                    <span class="account-position"><?=$this->session->userdata('EMPLOYE')?></span>
                    <span class="account-position"><?=$this->session->userdata('AGENCE_NOM')?></span>
                    <span class="account-position"><?=$this->session->userdata('DESC_PROFIL')?></span>
                    

                   
</b>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <a href="javascript:void(0);" onclick="show_modal()" class="dropdown-item notify-item">
                    <i class="mdi mdi-lock-outline me-1"></i>
                    <span>Modifier le mot de passe</span>
                </a>
                <a href="javascript:void(0);" onclick="deconexion()" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Déconnexion</span>
                </a>
            </div>
        </li>

    </ul>
    <a class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </a>
    <div class="app-search dropdown d-none d-lg-block">
        <!-- <form>
            <div class="input-group">
                <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                <span class="mdi mdi-magnify search-icon"></span>
                <button class="input-group-text btn-primary" type="submit">Search</button>
            </div>
        </form> -->

        <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
            <!-- item-->
            <div class="dropdown-header noti-title">
                <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
            </div>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-notes font-16 me-1"></i>
                <span>Analytics Report</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-life-ring font-16 me-1"></i>
                <span>How can I help you?</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-cog font-16 me-1"></i>
                <span>User profile settings</span>
            </a>

            <!-- item-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
            </div>

            <div class="notification-list">
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="d-flex">
                        <img class="d-flex me-2 rounded-circle" src="<?= base_url() ?>assets/images/users/avatar-2.jpg" alt="Generic placeholder image" height="32">
                        <div class="w-100">
                            <h5 class="m-0 font-14"><?=$this->session->userdata('NOM_PRENOM_USER')?></h5>
                            <span class="font-12 mb-0"><?=$this->session->userdata('EMAIL_USER')?></span>
                        </div>
                    </div>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="d-flex">
                        <img class="d-flex me-2 rounded-circle" src="<?= base_url() ?>assets/images/users/avatar-5.jpg" alt="Generic placeholder image" height="32">
                        <div class="w-100">
                            <h5 class="m-0 font-14">Jacob Deo</h5>
                            <span class="font-12 mb-0">Developer</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>



<script>
  function deconexion()
  {
    var url_ = "<?=base_url()?>Login/deconnexion";
    
    $.ajax({
      url : url_,
              // type: "GET",
              dataType: "JSON",
              success: function(data){
                if (data.status) {
                  window.location.replace('<?=base_url()?>');
                }
              },
              error: function (jqXHR, textStatus, errorThrown){
                alert("Erreur : Impossible de se déconnecter : "+textStatus+' '+jqXHR+' '+errorThrown);
              }
            });
  }
</script>




<script>

function show_modal(){

        // save_method = 'add';
        $('#pwd_form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty(); 
        $('#pwd-modal').modal('show');
        $('.modal-title').text('Changer le mot de passe');

        


    }



    function change_pwd()
    {

     $('#btnSave').html('<button class="btn btn-info" type="button" disabled><span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>Chargement...</button>');
     $('#btnSave').attr("disabled",true);

     var url;

     url="<?php echo base_url('Login/change_pwd')?>";

     var formData = new FormData($('#pwd_form')[0]);

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
            $('#pwd-modal').modal('hide');
            setTimeout(function(){ 
                $('#pwd_form').submit();

            },100);
        }
        else
        {
            for (var i = 0; i < data.inputerror.length; i++) 
            {
                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
            }
        }

        $('#btnSave').text('Changer');
        $('#btnSave').attr('disabled',false); 


    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      if (jqXHR.status==0) {
            alert("Erreur de connexion internet,veuillez vérifier votre connexion");
      }else{
        if (errorThrown.status) 
        {
          alert('Une erreur s\'est produite');
        }
      }
      
      $('#btnSave').text('Changer');
      $('#btnSave').attr('disabled',false);

  }


});



 }
</script>





<div id="pwd-modal" class="modal fade"data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h4 class="modal-title" id="info-header-modalLabel">Modal Heading</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="pwd_form" action="<?=base_url('Login') ?>"  method="POST">
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="mb-3">
                                              <input type="hidden" id="MATRICULE" name="MATRICULE" value="<?=$this->session->userdata('MATRICULE')?>">
                                             <!--  -->
                                             <label class="form-label">Nouveau mot de passe<span style="color: red;">*</span></label>
                                             <input type="password" class="form-control" autocomplete="off" data-provide="typeahead" id="NOUVEAU_PWD" name="NOUVEAU_PWD">
                                             <span class="help-block"></span>
                                         </div>
                                     </div>
                                 </div>

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="mb-3">
                                         <!--  -->
                                         <label class="form-label">Confirmer nouveau mot de passe<span style="color: red;">*</span></label>
                                         <input type="password" class="form-control" autocomplete="off" data-provide="typeahead" id="CONFIRM_PWD" name="CONFIRM_PWD">
                                         <span class="help-block"></span>
                                     </div>
                                 </div>
                             </div>

                             <div class="col-md-4">
                                <div class="form-group">
                                    <div class="mb-3">
                                     <!--  -->
                                     <label class="form-label">Ancien mot de passe<span style="color: red;">*</span></label>
                                     <input type="password" class="form-control" autocomplete="off" data-provide="typeahead" id="ANCIEN_PWD" name="ANCIEN_PWD">
                                     <span class="help-block"></span>
                                 </div>
                             </div>
                         </div>

                         



                     </div>
                 </div>
             </form>
         </div>

     </div>

 </div>
 <div class="modal-footer">
    <button type="button" id="btnSave" onclick="change_pwd()" class="btn btn-info">Changer</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->