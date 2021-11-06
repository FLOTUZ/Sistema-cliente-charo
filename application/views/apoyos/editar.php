  <link rel="stylesheet" href="<?=base_url()?>assets/vendor/select2/css/select2.css">
<!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Apoyos</a>
    </li>
    <li class="breadcrumb-item active">Editar</li>
  </ol>
<hr/>
<div class="row">
  <div class="col-md-12"> 
    <div class="form-group">
      <div class="form-row">
        <div class="col-md-6">
          <label>Beneficiario: <b><?=$solicitud->beneficiario?></b></label>
          <label style="margin-left: 4em;">Folio: <b><?=str_pad($solicitud->id_solicitud, 10, "0", STR_PAD_LEFT);?></b></label>
        </div>
        <div class="col-md-6 text-right">
          <?php if($this->session->Charo2019['tipo_usuario']==3){ ?>
          <button class="btn btn-danger eliminado" data-toggle="modal" data-target="#eliminar">ELIMINAR</button>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12 eliminado">
  <form  data-parsley-validate="true" role="form" id="nuevaSolicitud">
    <div class="form-group">
      <div class="form-row">
        <div class="col-md-4">
          <label for="apoyo">Apoyo:</label>
          <select class="form-control" id="apoyo" data-parsley-required="true">
            <?php foreach($apoyos->result() as $apoyo){ ?>
              <option value="<?=$apoyo->id_apoyo?>"><?=$apoyo->apoyo?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-2">
          <label for="cantidad">Cantidad:</label>
          <input type="text" class="form-control" id="cantidad" name="cantidad" data-parsley-required="true" value="<?=$solicitud->cantidad?>">
        </div>
        <div class="col-md-3">
          <label for="fecha">Fecha:</label>
          <input type="date" class="form-control" name="fecha" id="fecha"  data-parsley-required="true"  value="<?=$solicitud->fecha?>" />
        </div>
        <div class="col-md-2">
          <input type="submit" class="btn btn-primary" name="" value="Guardar" id="guardarS">
          <img  src="<?=base_url()?>assets/img/cargador.gif" class="img-fluid" alt="Responsive image" id="cargadorS" style="width: 10em;height: 10em;display: none;">
        </div>
      </div>
    </div>
    <div class="form-group text-right">
      <div class="form-row">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4" id="resultado">
          
        </div>
    </div>
  </form>
</div>
</div>

<div class="modal fullscreen-modal fade" id="eliminar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar apoyo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" id="registros">
        <p>¿Estas seguro(a) de eliminar el apoyo?</p>
        <button class="btn btn-danger eliminado" onclick="eliminar();">Eliminar</button>
        <p id="resultadoEliminar"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
          