<link rel="stylesheet" href="<?=base_url()?>assets/vendor/select2/css/select2.css">
<div class="row">
	<div class="col-md-6">
		<b>Nombre: </b><br/><?=$beneficiario->nombre?> <?=$beneficiario->apPaterno?> <?=$beneficiario->apMaterno?>
	</div>
	<div class="col-md-3">
		<b>Sección: </b><br/><?=$beneficiario->seccion?>
	</div>
	<div class="col-md-3">
		<b>Comunidad: </b><br/><?=$beneficiario->comunidad?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<b>Dirección: </b><br/><?=$beneficiario->direccion?>
	</div>
	<div class="col-md-2">
		<b>Número: </b><br/><?=$beneficiario->numero?>
	</div>
	<div class="col-md-2">
		<b>Teléfono: </b><br/><?=$beneficiario->telefono?>
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-md-12 text-center">	
	<?php if($totalApoyos>0){ ?>
		<h5>Total de apoyos: <?=$totalApoyos?></h5>
		<div class="row">
			<?php foreach($apoyos->result() as $apoyo){?>
			<div class="col-md-3 text-<?=$apoyo->color?>">
				<?=$apoyo->estatus?> : <?=$apoyo->total?>
			</div>
			<?php } ?>
		</div>
	<?php }else{ ?>
	<h5 class="text-center text-muted">Sin apoyos registrados</h5>
	<button class="btn btn-danger" data-toggle="modal" data-target="#eliminar">ELIMINAR BENEFICIARIO</button>
<?php } ?>
		<p class="text-danger" id="error"></p>
	</div>
</div>

<div class="modal fullscreen-modal fade" id="eliminar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Beneficiario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" id="registros">
        <p>¿Estas seguro(a) de eliminar el(la) beneficiario(a)?</p>
        <button class="btn btn-danger eliminado" onclick="eliminar();">Eliminar</button>
        <p id="resultadoEliminar"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fullscreen-modal fade" id="asignar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar Apoyos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" id="registros">
        <p>¿Estas seguro(a) de asignar los apoyos?</p>
        <button class="btn btn-danger eliminado" onclick="asignar();">Asignar</button>
        <p id="resultadoEliminar"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>