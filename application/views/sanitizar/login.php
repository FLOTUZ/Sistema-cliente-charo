<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=nombreProyecto?></title>

    <!-- Bootstrap core CSS-->
    <link href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>assets/css/sb-admin.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/img/icono.png" />
  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Iniciar Sesión</div>
        <div class="card-body tex">
          <form id="form">
            <div class="form-group text-center">
              <img  src="<?=base_url()?>assets/img/logo.png" class="img-fluid center-block" alt="Responsive image" style="width: 7em;">
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="usuario" class="form-control" placeholder="Nombre de usuario" required="required" autofocus="autofocus">
                <label for="usuario">Usuario</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="password" class="form-control" placeholder="Contraseña" required="required">
                <label for="password">Contraseña</label>
              </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" class="btn btn-primary btn-block" value="Ingresar" id="ingresar">
              <img  src="<?=base_url()?>assets/img/cargador.gif" class="img-fluid center" alt="Responsive image" id="cargador" style="width: 10em;display: none;">
            </div>
            <div id="error">
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        $('#form').on('submit', function (e) {
            $('#ingresar').hide();
            $('#cargador').show();
            $('#error').html('');
            var data = {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
                'usuario' : $('#usuario').val(),
                'password' : $('#password').val()
            }
            $.ajax({
                url: '<?= base_url()?>Sanitizar/iniciarSesion',
                type: 'POST',
                data: data,
                success: function (xhr) {
                  console.log(xhr);
                    if(xhr=="success"){
                        location.reload();
                    }else{
                      switch(xhr) {
                        case 'error1':
                          $('#error').append("<p class='text-danger'>Contraseña incorrecta.</p>");
                          break;
                        case 'error2':
                          $('#error').append("<p class='text-danger'>El usuario no existe.</p>");
                          break;
                        case 'error4':
                          $('#error').append("<p class='text-danger'>Usuario desactivado.</p>");
                          break
                        default:
                          $('#error').append("<p class='text-danger'>Error en el servidor, consulte con el adminitrador.</p>");
                      }
                      $('#cargador').hide();
                      $('#ingresar').show();
                   }
                }
            });
            return false;
        });
      })
    </script>
  </body>

</html>
