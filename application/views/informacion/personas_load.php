<link href="<?php echo base_url(); ?>assets/vendor/DataTables/responsive.dataTables.min.css" rel="stylesheet" />
<style type="text/css">
  td {
    font-size: .8em;
  }
</style>
<div class="row">
    <div class="col-md-12">
      <table id="tabla" class="table table-striped display" style="width:100%">
        <thead>
          <tr>
            <td>Folio</td>
            <td>Fecha</td>
            <td>Beneficiario</td>
            <td>Apoyo</td>
            <td>Cantidad</td>
            <td>Unidad</td>
            <td>Estatus</td>
            <td>Registro</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
         
        </tbody>
      </table>
    </div>
</div>

<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apoyo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 text-center" id="divcargador">
          <img  src="<?=base_url()?>assets/img/cargador.gif" class="img-fluid" alt="Responsive image"><p class="text-muted">Cargando...</p>
        </div>
        <div class="col-md-12 text-center" id="divdatos" style="display: none">
          <table class="table">
            <tr>
              <td colspan="2">Nombre: <b id="nombre"></b></td>
            </tr> 
            <tr>
              <td>seccion: <b id="seccion"></b></td>
              <td>Comunidad: <b id="comunidad"></b></td>
            </tr>
            <tr>
              <td>Cantidad solicitada: <b id="cantidad"></b> <b id="unidad"></b></td>
              <td>Apoyo: <b id="apoyo"></b></td>
            </tr>
            <tr>
              <td>Costo: <b id="costo"></b></td>
              <td>Descuento: <b id="descuento"></b></td>
            </tr>
            <tr>
              <td>Total: <b id="total"></b></td>
              <td>Folio: <b id="folio"></b></td>
            </tr>
            <tr>
              <td>Fecha de solicitud:<b id="fecha"></b></td>
              <td>Estatus: <b id="estatusB"></b></td>
            </tr>
          </table>
          <label>Descripción</label>
          <b><p id="descripcion"></p></b>
            <input type="hidden" id="solicitud_id" value="0">
            <div class="form-group" id="divEntregado">
              <table class="table"> 
                <tr>
                  <td>Fecha de autorización: <b id="fechaAu"></b></td>
                  <td>Autorizo: <b id="autorizo"></b></td>
                  <td>Cantidad Autorizada: <b id="cautorizada"></b></td>
                  <td>Entrego: <br><b id="entrego"></b></td>
                </tr>
              </table>
            </div>
           <div class="form-group" id="divAutorizar">
             <div class="form-row">
                <div class="col-md-6">
                  <textarea id="motivoRechazo" class="form-control" placeholder="Motivo de rechazo"></textarea><br/>
                  <button class="btn btn-danger" onclick="cambiarEstatus(2,'Rechazado')">Rechazar</button>
                </div>
                <div class="col-md-6 text-center">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label for="cantidad_autorizar">Cantidad autorizar</label>
                      <input type="text" name="" id="cantidad_autorizar" class="form-control">
                      <label for="total_autorizo">Total $:</label>
                      <input type="text" name="" id="total_autorizo" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label for="fecha_autorizo">Fecha:</label>
                      <input type="date" class="form-control" name="fecha_autorizo" id="fecha_autorizo"  data-parsley-required="true"  value="<?= date("Y-m-d")?>" /> 
                    </div>
                  </div>
                  <button class="btn btn-primary" style="margin-top: 1em;" onclick="autorizar()">Autorizar</button>
                </div>
              </div>
            </div>
            <div class="form-group" id="divEntregar">
              <div class="form-row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 text-center">
                  <button class="btn btn-primary" onclick="cambiarEstatus(4,'Entregado')">Entregado</button>
                </div>
              </div>
            </div>
            <div class="form-group" id="divRechazado">
              <div class="form-row">
                <div class="col-md-12 text-center">
                  <label> Rechazo : <b id="rechazo"></b></label><br>
                  Motivo: <b id="mmotiovoRechazo"></b>
                </div>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <div id="formatoRecibido">
          <!-- <form action="<?=base_url()?>Apoyos/recibido" method="post" target="_blank">
            <input type="hidden" name="id_solicitud" id="id_solicitud" value="0">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" > 
            <button type="submit" class="btn btn-info" ><i class='fa fa-1x fa-file-pdf-o'></i> Recibido</button>
          </form> -->
        </div>
        <div id="formatoSolicitud">
          <!-- <form action="<?=base_url()?>Apoyos/solicitud" method="post" target="_blank">
            <input type="hidden" name="id_solicitud" id="id_solicitud2" value="0">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" > 
            <button type="submit" class="btn btn-info" ><i class='fa fa-1x fa-file-pdf-o'></i> Solicitud</button>
          </form> -->
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables2/extensions/Buttons/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() { 
        var data= null;
        $.ajax({
            type: "POST",
            data: {
                "<?=$this->security->get_csrf_token_name()?>":"<?=$this->security->get_csrf_hash()?>",
                "beneficiario" : <?=$beneficiario?>,
                "fecha_inicio" : '<?=$fecha_inicio?>',
                "fecha_final" : '<?=$fecha_final?>',
            },
            url: "<?=base_url()?>Informacion/loadPersonasJson",
            success: function(result){           
                if(result!=0){               
                  data = JSON.parse(result);
                }
                tabla(data);
            }
      });
    });

    function tabla(data){
        var table = $('#tabla').DataTable({
            responsive: true,
            <?php if($this->session->Charo2019['tipo_usuario']==3){?>
            dom: 'lBfrtip',
            buttons: [
                { extend: 'excel', className: 'btn-sm' },
                { extend: 'pdf', className: 'btn-sm' },
            ],
            <?php } ?>
            iDisplayLength: -1,                        
            'data' : data,
            "order": [[ 0, "desc" ]],
            "columns": [
                { "data": "folio" },
                { "data": "fecha" },
                { "data": "beneficiario" },
                { "data": "apoyo" },
                { "data": "cantidad" },
                { "data": "unidad" },
                { "data": "estatus" },
                { "data": "registro" },
                { "data": "accion" }
            ],
            "language": {
                "sProcessing": "Procesando..."
            },
            pageLength: 50
        });

        $('#listado_filter').append('<a href="#" class="btn btn-sm btn-success agregar" style="float: right; margin-left: 10px;" onclick="nuevo()">Nuevo <i class="fa fa-user"></i></a>');
    }

    function informacion(id_solicitud){
      $('#divcargador').show();
      $('#divAutorizar').hide();
      $('#formatoRecibido').hide();
      $('#formatoSolicitud').hide();
      $('#divdatos').hide();
      $('#divEntregado').hide();
      $('#divRechazado').hide();
      $('#divEntregar').hide();
      $('#informacion').modal('toggle'); 
      var data = { 
          'id_solicitud' : id_solicitud,
          '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>' 
      };
      $.ajax({
          url: '<?=base_url()?>Apoyos/dataSolicitud',
          type: 'POST',
          data: data,
          success: function (xhr){
              if(xhr){
var data = JSON.parse(xhr);
                  $('#nombre').text(data.nombre);
                  $('#seccion').text(data.seccion);
                  $('#comunidad').text(data.comunidad);
                  $('#cantidad').text(data.cantidad);
                  $('#unidad').text(data.unidad);
                  $('#apoyo').text(data.apoyo);
                  $('#fecha').text(data.fecha);
                  $('#estatusB').html(data.estatus);
                  $('#descripcion').text(data.descripcion);
                  $('#cantidad_autorizar').val(data.cantidad);
                  $('#solicitud_id').val(id_solicitud);
                  $('#fechaAu').text(data.fecha_autorizo);
                  $('#autorizo').text(data.autorizo);
                  $('#rechazo').text(data.autorizo);
                  $('#cautorizada').text(data.cautorizada);
                  $('#costo').text(data.costo);
                  $('#folio').text(data.folio);
                  $('#entrego').text(data.entrego);
                  $('#mmotiovoRechazo').text(data.motivo_rechazo);
                  $('#id_solicitud').val(id_solicitud);
                  $('#id_solicitud2').val(id_solicitud);
                  $('#costo').text(data.costo);
                  $('#total').text(data.total);
                  $('#total_autorizo').val(data.total2);
                  $('#descuento').text(data.descuento);
                  $('#divcargador').hide();
                  $('#divdatos').show();  
                  switch(data.id_estatus) {
                    case '1':
                      $('#divAutorizar').show();
                      $('#formatoSolicitud').show();
                      break;
                    case '2':
                      $('#divRechazado').show();
                      break;
                    case '3':
                      $('#divEntregado').show();
                      $('#divEntregar').show();
                      break;
                    case '4':
                      $('#divEntregado').show();
                      $('#formatoRecibido').show();
                      break;
                    default:
                      break;
                  }   
              }else{

              }
          }
      });
    }

    function autorizar(){
      var data = { 
          'id_solicitud' : $('#solicitud_id').val(),
          'cantidad_autorizar' : $('#cantidad_autorizar').val(),
          '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>',
          'fecha_autorizo' : $('#fecha_autorizo').val(),
          'fecha_autorizo' : $('#fecha_autorizo').val(),
          'total_autorizo' : $('#total_autorizo').val() 
      };
      $.ajax({
          url: '<?=base_url()?>Apoyos/autorizar',
          type: 'POST',
          data: data,
          success: function (xhr){
              if(xhr=='success'){
                  alert('Autorizado correctamente');
                  $('#informacion').modal('toggle');
              }else{
                  alert('Error al autorizar');
              }
          }
      });
    }

    function cambiarEstatus(estatus,leyenda){
      var data = { 
          'id_solicitud' : $('#solicitud_id').val(),
          'estatus' : estatus,
          '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>',
          'motivoRechazo' : $('#motivoRechazo').val()
      };
      $.ajax({
          url: '<?=base_url()?>Apoyos/cambiarEstatus',
          type: 'POST',
          data: data,
          success: function (xhr){
              if(xhr=='success'){
                  alert(leyenda+' correctamente');
                  $('#informacion').modal('toggle');
              }else{
                  alert('Error consulte al administrador.');
              }
          }
      });
    }
</script>