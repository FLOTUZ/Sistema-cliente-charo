    <link href="<?php echo base_url(); ?>assets/vendor/DataTables/datatables.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/DataTables/responsive.dataTables.min.css" rel="stylesheet" />
<!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Mi información</a>
    </li>
    <li class="breadcrumb-item active">Información</li>
  </ol>
<div class="row">
    <div class="col-md-12 col-sm-12">
      <h5>Usuario</h5>
      <div class="row form-group">
            <div class="col-md-4">
              <label for="nombre">Nombre: <b><?=$informacion->nombre?></b></label>
            </div>
            <div class="col-md-4" id="usuarioDiv">
              <label for="usuario">Nombre de Usuario: <b><?=$informacion->usuario?></b></label>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-4">
              <label for="tipo_usuario">Tipo de usuario: <b><?=$informacion->tipo_usuario?></b></label>
            </div>
            <div class="col-md-4">
              <label for="password">Cambiar contraseña:</label>
              <input type="text" name="password" id="password" class=" " data-parsley-required="true">
              <button class="btn btn-success text-center" onclick="cambiarPass();" >Guardar</button>
              <div id="resultado"></div>
            </div>
          </div>        
    </div>
</div>

