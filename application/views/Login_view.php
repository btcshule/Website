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

            <!-- Logo -->
            <div class="card-header pt-12 pb-12 text-center">
              <img src="<?=base_url('upload/sanya.png')?>"  style="width: 100%;height:160px;" alt="">
            </div>

            <div class="card-body p-4">

              <form method="POST" action="<?= base_url('index.php/Login/go_submit') ?>" id="loginForm">
                <center>
                  <div id="message_login"></div>
                </center>

                <div class="mb-3">
                  <label for="EMAIL" class="form-label">E-mail</label>
                  <input class="form-control" placeholder="Email" type="text" id="EMAIL" autofocus autocomplete="off" name="EMAIL">
                </div>

                <div class="mb-3">
                  <a href="#" class="text-muted float-end" hidden=""><small>Mot de passe oublié</small></a>
                  <label for="password" class="form-label">Mot de passe</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Entrer le mot de passe">
                    <div class="input-group-text" data-password="false">
                      <span class="password-eye" onclick="show_password()"></span>
                    </div>
                  </div>
                </div>
                <div class="mb-3 mb-0 text-center">
                  <button class="btn btn-primary" id="sign" onclick="login()" type="submit"> Connexion </button>
                </div>

              </form>
              
            </div> <!-- end card-body -->
          </div>
          <!-- end card -->
  <!--<div class="text-center row" style="color:blue"><img src="<?=base_url('upload/sanya.png')?>"  style="width: 30%;height: 80px;" alt=""></div>-->
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




<script>
  function show_password() {
    var x = document.getElementById("inputPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  $(document).on('success', function() {
    $('#sign').hide();
    $('#auth').hide();
    $('#redirection').show();
  });

  function login() {
        $('#sign').html('Authentification...'); //change button text
        $('#sign').attr('disabled', true); //set button disable
        $('#message_login').html('')

        var data = $('#loginForm').serialize();

        $.ajax({
          url: "<?= base_url() ?>index.php/Login/check_login",
          type: "POST",
          data: data,
          dataType: "JSON",
          success: function(data) {
            if (data.status) {

              $('#message_login').html("<center><span class='text text-success'>" + data.message + "</span></center>");
              $('#sign').attr('disabled', true);
              setTimeout(function() {
                $('#loginForm').submit();

              }, 2000);



            } else {
              $('#message_login').html("<span class='text text-danger'>" + data.message + "</span>");
            }
                $('#sign').text('Se connecter'); //change button text
                $('#sign').attr('disabled', false); //Activer le bouton
              },
              error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 0) {
                  alert("Erreur de connexion internet,veuillez vérifier votre connexion");
                } else {
                  if (errorThrown.status) {
                    alert('Echec de connexion : ' + textStatus);
                  }
                }

                $('#sign').text('Se connecter'); //change button text
                $('#sign').attr('disabled', false); //Activer le bouton
              }
            });
      }
    // **** FIN LOGIN *****
    </script>