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

  <body class="">
    <div class="container">
      <div class="row">
        <a href="<?=base_url()?>Sanitizar/cerrarSesion" class="btn btn-info">Cerrar sesión <i class="fa fa-share"></i></a>
        <div class="col-md-12"> 
          <h5 class="text-center">Programa de sanitización</h5>
          <form id="form" method="POST">
            <div class="row form-group">
              <div class="col-md-4">
                <label for="responsable">Dueño/Responsable</label>
                <input type="text" required name="responsable" id="responsable" class="form-control">
              </div>
              <div class="col-md-4">
                <label for="direccion">Dirección</label>
                <input type="text" required name="direccion" id="direccion" class="form-control" placeholder="dirección # localidad">
              </div>
              <div class="col-md-4">
                <label for="giro">Giro comercial</label>
                <input type="text" required name="giro" id="giro" class="form-control" placeholder="ferreteria,tienda de abarrotes,etc">
              </div>
              <div class="col-md-4">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control">
              </div>
              <div class="col-md-2">
                <label for="telefono">Teléfono</label>
                <input type="tel" name="telefono" id="telefono" class="form-control">
              </div>
              <div class="col-md-2">
                <label for="estatus">Estatus</label>
                <select id="estatus" name="estatus" class="form-control">
                  <option value="1">Pendiente</option>
                  <option value="2">Sanitizado</option>
                </select>
              </div>
              <div class="col-md-2">
                <input type="hidden" name="id_sanitizar" id="id_sanitizar" value="0">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>">
                <button class="btn btn-success" style="margin-top: 1em;" id="bGuardar">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php if($this->session->Sanitizar['id_usuario']==1){ ?>
          <a href="<?=base_url()?>Sanitizar/exportarPDF" target="_blank" class="btn btn-info"><i class="fa fa-file"></i> PDF</a>
          <?php } ?>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                  <th>#</th>
                  <th>Responsable</th>
                  <th>Dirección</th>
                  <th>Teléfono</th>
                  <th>Giro Comercial</th>
                  <th>Fecha</th>
                  <th>Estatus</th>
                  <th></th>
              </thead>
              <tbody id="listadoBody">
                <?php 
                  if($listado->num_rows() > 0){
                    $i = 1;
                    foreach($listado->result() as $row){
                      echo "<tr>";
                      echo "<td>".$i;
                      echo "</td>";
                      echo "<td>".$row->responsable."</td>";
                      echo "<td>".$row->direccion."</td>";
                      echo "<td>".$row->telefono."</td>";
                      echo "<td>".$row->giro."</td>";
                      echo "<td>".$row->fecha."</td>";
                      echo "<td>";
                      switch($row->estatus){
                        case 1:
                          echo "<b class='text-warning'>PENDIENTE</b> <button title='SANITIZADO' class='btn btn-success btn-sm m-1' id='sa".$row->id_sanitizar."' onclick='sanitizado(".$row->id_sanitizar.",2)'><i class='fa fa-check'></i></button>";
                        break;
                        case 2:
                          echo "<b class='text-success'>SANITIZADO</b>";
                          if($this->session->Sanitizar['id_usuario']==1){
                            echo "<button class='btn btn-warning btn-sm m-1' id='sa".$row->id_sanitizar."' onclick='sanitizado(".$row->id_sanitizar.",1)'><i class='fa fa-times'></i></button>";
                          }
                        break;
                        default:
                        
                        break;
                      }
                      echo "</td>";
                      echo "<td>";
                      if($this->session->Sanitizar['id_usuario']==1){
                        echo "<button class='btn btn-info btn-sm m-1' title='editar' onclick='editar(".$row->id_sanitizar.")'><i class='fa fa-edit'></i></button> <button class='btn btn-danger btn-sm m-1' title='eliminar' onclick='eliminar(".$row->id_sanitizar.")' id='el".$row->id_sanitizar."'><i class='fa fa-times'></i></button>";
                      }
                      echo "</td>";
                      echo "</tr>";
                      $i++;
                    }
                  } 
                ?>
              </tbody>
            </table>
          </div>
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
            $('#bGuardar').hide();
            var data = $('#form').serialize();
            $.ajax({
                url: '<?= base_url()?>Sanitizar/guardar',
                type: 'POST',
                data: data,
                success: function (xhr) {
                    if(isNaN(xhr)){
                      alert('Error al guardar');
                    }else{
                      switch($('#estatus').val()){
                        case "1":
                          var estatus = "<td class='text-warning'><b>PENDIENTE</b> <button class='btn btn-success btn-sm m-1' id='sa"+xhr+"' onclick='sanitizado("+xhr+",2)'><i class='fa fa-check'></i></button></td>";
                        break;
                        case "2":
                          var estatus = "<td class='text-success'><b>SANITIZADO</b></td>";
                        break;
                        default:
                          var estatus = $('#estatus').val();
                        break;
                      }
                      var acciones = '';
                      if(<?=$this->session->Sanitizar['id_usuario']?>==1){
                        acciones = "<button class='btn btn-info btn-sm m-1' title='editar' onclick='editar("+xhr+")'><i class='fa fa-edit'></i></button> <button class='btn btn-danger btn-sm m-1' title='eliminar' onclick='eliminar("+xhr+")' id='el"+xhr+"'><i class='fa fa-times'></i></button>";
                      }
                      var filas = parseInt($("#listadoBody tr").length)+1;
                     $('#listadoBody').append('<tr><td>'+filas+'</td><td>'+$('#responsable').val()+'</td><td>'+$('#direccion').val()+'</td><td>'+$('#telefono').val()+'</td><td>'+$('#giro').val()+'</td><td>'+$('#fecha').val()+'</td>'+estatus+'<td>'+acciones+'</td></tr>');
                     $('#form')[0].reset();
                     if($('#id_sanitizar').val()!=0)
                      $('#el'+xhr).parent().parent().hide('slow');
                     $('#id_sanitizar').val(0);
                   }
                }
            });
            $('#bGuardar').show();
            return false;
        });
      })

      function sanitizado(id_sanitizar,estatus){
        $.ajax({
            url: '<?= base_url()?>Sanitizar/sanitizado',
            type: 'POST',
            data: {
              'id_sanitizar' : id_sanitizar,
              'estatus' : estatus,
              '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>'
            },
            success: function (xhr) {
              if(xhr=='success'){
                switch(estatus){
                  case 1:
                    $('#sa'+id_sanitizar).parent().html('<b class="text-warning">PENDIENTE</b> <button class="btn btn-success btn-sm m-1" id="sa'+id_sanitizar+'"" onclick="sanitizado('+id_sanitizar+',2)""><i class="fa fa-check"></i></button>');
                  break;
                  case 2:
                    if(<?=$this->session->Sanitizar['id_usuario']?>==1){
                      console.log('yes');
                      $('#sa'+id_sanitizar).parent().html('<b class="text-success">SANITIZADO</b> <button class="btn btn-warning btn-sm m-1" id="sa'+id_sanitizar+'" onclick="sanitizado('+id_sanitizar+',1)"><i class="fa fa-times"></i></button>');
                    }else{
                      $('#sa'+id_sanitizar).parent().html('<b class="text-success">SANITIZADO</b>');
                    }
                  break;
                  default:
                    console.log(estatus)
                  break;
                }
              }else{
                alert('Error al guardar');
              }
            }
        });
      }

      function editar(id_sanitizar){
        $.ajax({
            url: '<?=base_url()?>Sanitizar/getSanitizar',
            type: 'POST',
            data : {
                'id_sanitizar' : id_sanitizar,
                '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>'
            },
            success: function (xhr){
              $('#form')[0].reset();
              xhr = jQuery.parseJSON(xhr);
              $('#responsable').val(xhr.responsable);
              $('#direccion').val(xhr.direccion);
              $('#giro').val(xhr.giro);
              console.log(xhr.fecha);
              if(xhr.fecha!='0001-01-01')
                $('#fecha').val(xhr.fecha);
              $('#telefono').val(xhr.telefono);
              $('#estatus').val(xhr.estatus);
              $('#id_sanitizar').val(xhr.id_sanitizar);
              $('html, body').animate({
                scrollTop: $("#form").offset().top
              }, 1000);
            }
          });
      }

      function eliminar(id_sanitizar){
        var r = confirm("¿Estas seguro(a) de eliminar?");
        if (r == true) {
          $.ajax({
            url: '<?=base_url()?>Sanitizar/eliminar',
            type: 'POST',
            data : {
                'id_sanitizar' : id_sanitizar,
                '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>'
            },
            success: function (xhr){
              if(xhr=="success"){
                $('#el'+id_sanitizar).parent().parent().hide('slow');
              } 
            }
          });
        } else {
          
        }
      }
    </script>
  </body>

</html>
