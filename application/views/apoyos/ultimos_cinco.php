<style type="text/css">
	td {
		font-size: .8em;
	}
	.btn-group-xs > .btn, .btn-xs {
  padding: .25rem .4rem;
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem;
}
</style>
<div class="table-responsive">
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
	<?php if($apoyos->num_rows()>0) {?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>Folio</td>
				<td>Fecha</td>
				<td>Apoyo</td>
				<td>Cantidad</td>
				<td>Unidad</td>
				<td>Estatus</td>
				<td>Registro</td>
				<td>Información</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($apoyos->result() as $apoyo){ ?>
				<tr>
					<td><?=str_pad($apoyo->id_solicitud, 10, "0", STR_PAD_LEFT);?></td>
					<td><?=$apoyo->fecha?></td>
					<td><?=$apoyo->apoyo?></td>
					<td><?=$apoyo->cantidad?></td>
					<td><?=$apoyo->unidad?></td>
					<td><?=$apoyo->estatus?></td>
					<td><?=$apoyo->nombre?></td>
					<td>
					<?php
						switch ($apoyo->id_estatus_solicitud) {
							case '1':
								?>
								<div id="formatoSolicitud">
						          <form action="<?=base_url()?>Apoyos/solicitud" method="post" target="_blank">
						            <input type="hidden" name="id_solicitud" id="id_solicitud2" value="<?=$apoyo->id_solicitud?>">
						            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" > 
						            <button type="submit" class="btn btn-info btn-xs" ><i class='fa fa-file-pdf-o'></i> Solicitud</button>
						          </form>
						        </div><?php
								break;
							case '2':
								echo "Rechazo: ".$apoyo->autorizo."<br/>Motivo : ".$apoyo->motivo_rechazo;
								break;
							case '3':
								echo "<label class='text-info'>Autorizo: ".$apoyo->autorizo.".</label> <label class='text-success'>Autorizado: ".$apoyo->cantidad_autorizada."</label><button id='entregado".$apoyo->id_solicitud."' class='btn btn-primary btn-xs' onclick='cambiarEstatus(".$apoyo->id_solicitud.",4)'>Entregado</button>";
								break;
							case '4':
								echo "<label class='text-info'>Autorizo : ".$apoyo->autorizo.".<label/>"."<label class='text-primary'>Entrego: ".$apoyo->entrego."</label><label class='text-success'>Autorizado: ".$apoyo->cantidad_autorizada.'</label>';
								?>
								<!-- <form action="<?=base_url()?>Apoyos/recibido" method="post" target="_blank">
						            <input type="hidden" name="id_solicitud" id="id_solicitud" value="<?=$apoyo->id_solicitud?>">
						            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" > 
						            <button type="submit" class="btn btn-info btn-xs" ><i class='fa fa-file-pdf-o'></i> Recibido</button>
						         </form> -->
								<?php
								break;
							default:
								# code...
								break;
						}
					?>

					</td>
				</tr>
			<?php } ?>
		</tbody>
	
	</table>
	<?php }else{ ?>
		<h1 class="text-center text-muted">Sin solicitudes registradas</h1>
	<?php } ?>
</div>
<script type="text/javascript">
	function cambiarEstatus(id_solicitud,estatus){
      var data = { 
          'id_solicitud' : id_solicitud,
          'estatus' : estatus,
          '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>',
          'motivoRechazo' : ''
      };
      $.ajax({
          url: '<?=base_url()?>Apoyos/cambiarEstatus',
          type: 'POST',
          data: data,
          success: function (xhr){
              if(xhr=='success'){
                  alert('Entregado correctamente');
                  $('#entregado'+id_solicitud).hide('slow');
              }else{
                  alert('Error consulte al administrador.');
              }
          }
      });
    }
</script>