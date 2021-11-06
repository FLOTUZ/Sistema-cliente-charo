    <link href="<?php echo base_url(); ?>assets/vendor/DataTables/datatables.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/DataTables/responsive.dataTables.min.css" rel="stylesheet" />
<!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Áreas y Usuarios</a>
    </li>
    <li class="breadcrumb-item active">Listado</li>
  </ol>
<div class="row">
    <div class="col-md-12 col-sm-12">
      <h5>Usuarios</h5>
      <table id="listado" class="table table-bordered table-hover">
        <thead>
          <tr>
            <td>Usuario</td>
            <td>Nombre</td>
            <td>Tipo</td>
            <td>Último_ingreso</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
</div>
<hr/>

<div class="modal fade" id="nuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form" data-parsley-validate="true" role="form" >
          <div class="row form-group">
            <div class="col-md-12">
              <label for="nombre">Nombre:</label>
              <input type="text" name="nombre" id="nombre" class="form-control" data-parsley-required="true">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-6" id="usuarioDiv">
              <label for="usuario">Nombre de Usuario:</label>
              <input type="text" name="usuario" id="usuario" class="form-control" data-parsley-required="true" placeholder="Con el que iniciará sesión">
            </div>
            <div class="col-md-6">
              <label for="password">Contraseña:</label>
              <input type="text" name="password" id="password" class="form-control" data-parsley-required="true">
            </div>
          </div>        
          <div class="row form-group">
            <div class="col-md-6">
              <label for="tipo_usuario">Tipo de usuario:</label>
              <select id="tipo_usuario" name="tipo_usuario" class="form-control" data-parsley-required="true">
                <?php foreach($tipo_usuarios->result() as $tipo_usuario){ ?>
                  <option value="<?=$tipo_usuario->id_tipo_usuario?>"><?=$tipo_usuario->tipo_usuario?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <input type="hidden" name="id_usuario" id="id_usuario" value=0>
          <input type="submit" name="" value="Guardar" class="btn btn-success text-center" id="guardar">
          <img  src="<?=base_url()?>assets/img/cargador.gif" class="img-fluid" alt="Responsive image" id="cargador" style="width: 10em;display: none;">
        </form>
        <div id="error"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->