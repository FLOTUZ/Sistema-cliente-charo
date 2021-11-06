  <link rel="stylesheet" href="<?=base_url()?>assets/vendor/select2/css/select2.css">
<!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Apoyos</a>
    </li>
    <li class="breadcrumb-item active">Nuevo</li>
  </ol>

<div class="row">
  <div class="col-md-6 col-sm-12">
    <label for="persona">Seleccione un beneficiario</label>
    <select id="persona" class="form-control">
      <?php foreach($beneficiarios->result() as $beneficiario){ ?>
        <option value="<?=$beneficiario->id_beneficiario?>"><?=$beneficiario->nombre?> <?=$beneficiario->apPaterno?> <?=$beneficiario->apMaterno?> (<?=$beneficiario->codigo?>)</option>
      <?php } ?>
    </select>
  </div>
  <div class="col-md-3  col-sm-6 col-xs-6">
    <button class="btn btn-white btn-xs m-1" onclick="ultimosApoyos();"><i class="fa fa-eye text-primary"></i></button>
    <button class="btn  btn-white btn-xs m-1" onclick="editar();"><i class="fa fa-edit text-primary"></i></button>
  </div>
  <div class="col-md-3  col-sm-6 col-xs-6">
    <button class="btn btn-primary m-1" data-toggle="modal" data-target="#nuevoBeneficiario" onclick="nuevo();">Nuevo</button>
  </div>
</div>
<hr/>
<div class="row">
  <div class="col-md-12">
  <form  data-parsley-validate="true" role="form" id="nuevaSolicitud">
    <div class="form-group">
      <div class="form-row">
        <div class="col-md-12">
          <label for="limpiar" class="limpiar">Limpiar formulario después de guardar:</label>
          <input type="checkbox" name="" id="limpiar">
        </div>
        <div class="col-md-7">
          <label for="apoyo">Apoyo:</label>
          <select class="form-control" id="apoyo" data-parsley-required="true">
            <?php foreach($apoyos->result() as $apoyo){ ?>
              <option id="apoyo<?=$apoyo->id_apoyo?>" costo="<?=$apoyo->costo?>" value="<?=$apoyo->id_apoyo?>"><?=$apoyo->apoyo?> (Costo: $<?=number_format($apoyo->costo, 2, '.', ',')?> - Unidad: <?=$apoyo->unidad?>)</option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-2">
          <label for="cantidad">Cantidad:</label>
          <input type="number" class="form-control costo" id="cantidad" name="cantidad" min="0.1" data-parsley-required="true" step="any">
        </div>
        <div class="col-md-3">
          <label for="fecha">Fecha:</label>
          <input type="date" class="form-control" name="fecha" id="fecha"  data-parsley-required="true"  value="<?= date("Y-m-d")?>" />  
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="form-row">
        <div class="col-md-2">
          <label for="descuento">Descuento:</label>
          <input class="form-control costo" data-parsley-required="true" type="number" name="descuento" id="descuento" value="0" min="0" step="any">
        </div>
        <div class="col-md-2">
          <label for="total">Total $:</label>
          <input class="form-control" data-parsley-required="true" type="text" name="total" id="total" value="0" readonly>
        </div>
        <div class="col-md-2 ">
          <label for="autorizado" class="autorizado">Autorizado:</label>
          <input type="checkbox" name="" id="autorizado" class="autorizado">
          <input type="date" class="autorizado form-control" name="fecha_autorizado" id="fecha_autorizado" value="<?= date("Y-m-d")?>" />
        </div>
        <div class="col-md-2 ">
          <label for="entregado" class="autorizado">Entregado:</label>
          <input type="checkbox" name="" id="entregado" class="autorizado">
          <input type="date" class="form-control autorizado" name="fecha_entregado" id="fecha_entregado" value="<?= date("Y-m-d")?>" />
        </div>
        <div class="col-md-2 text-right">
          <input type="submit" class="btn btn-primary" name="" value="Guardar" id="guardarS">
          <img  src="<?=base_url()?>assets/img/cargador.gif" class="img-fluid" alt="Responsive image" id="cargadorS" style="width: 10em;height: 10em;display: none;">
        </div>
      </div>
    </div>
    <div class="form-group text-center">
      <div class="form-row">
        <div class="col-md-12" id="resultado">
          
        </div>
      </div>
    </div>    
  </form>
</div>
</div>
          

<!-- Modal -->
<div class="modal fade" id="nuevoBeneficiario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo">Beneficiario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="FnuevoBeneficiario" data-parsley-validate="true" role="form" >
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="nombre">Nombre(s):</label>
                <input class="form-control" id="nombre" name="nombre" type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" data-parsley-required="true">
              </div>
              <div class="col-md-6">
                <label for="appPaterno">Apellido paterno:</label>
                <input class="form-control" id="apPaterno" name="apPaterno" type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" data-parsley-required="true">
              </div>
              <div class="col-md-6">
                <label for="appMaterno">Apellido materno:</label>
                <input class="form-control" id="apMaterno" name="apMaterno" type="text" onkeyup="javascript:this.value=this.value.toUpperCase();">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="comunidad">Comunidad:</label>
                <select class="form-control" id="comunidad" name="comunidad">
                  <?php foreach($comunidades->result() as $comunidad){ ?>
                    <option value="<?=$comunidad->id_comunidad?>"><?=$comunidad->comunidad?></option>
                  <?php } ?> 
                </select>
              </div>
              <div class="col-md-6">
                <label for="seccion">Sección:</label>
                <select class="form-control" id="seccion" name="seccion">
                  <?php foreach($secciones->result() as $seccion){ ?>
                    <option class="seccion comunidad<?=$seccion->id_comunidad?>" style="display: none;" value="<?=$seccion->id_seccion?>"><?=$seccion->seccion?></option>
                  <?php } ?> 
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input class="form-control" id="direccion" name="direccion" type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" data-parsley-required="true">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="numero">Número:</label>
                <input class="form-control" id="numero" name="numero" type="text" data-parsley-required="true">
              </div>
              <div class="col-md-6">
                <label for="telefono">Teléfono:</label>
                <input class="form-control" id="telefono" name="telefono" type="text">
              </div>
            </div>
          </div>
          <input type="hidden" name="id_beneficiario" id="id_beneficiario" value="0">
          <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>">
          <input type="submit" class="btn btn-primary" value="Guardar" id="guardar">
          <img  src="<?=base_url()?>assets/img/cargador.gif" class="img-fluid" alt="Responsive image" id="cargador" style="width: 10em;display: none;">
          <div id="error"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fullscreen-modal fade" id="ultimosRegistros">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Últimos registros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="registros">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fullscreen-modal fade" id="info">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">IMPORTANTE LEER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="form-row">
            <p>No es necesario registrar al beneficiario cada vez que solicite un apoyo, sin importar si alguien más ya lo registro.</p>
            <div class="col-md-5 alert alert-info ">
              <strong>Ejemplo de un beneficiario no registrado:</strong>
              <p>1.- Buscamos por nombre ya sea deslizando la lista o escribiendo su nombre, nos aparecerá la leyenda 'No se encontraron resultados.</p>
              <img  src="<?=base_url()?>assets/img/no_registrado.PNG" class="img-fluid" alt="Responsive image" id="cargadorS" style="">
              <p>2.- Daremos click en el botón nuevo para registrar sus datos.</p>
              <img  src="<?=base_url()?>assets/img/nuevo.PNG" class="img-fluid" alt="Responsive image" id="cargadorS" style="">
            </div>
            <div class="col-md-5 offset-md-1 alert alert-warning">
              <strong>Ejemplo de un beneficiario ya registrado:</strong>
              <p>1.- Buscamos por nombre ya sea deslizando la lista o escribiendo su nombre, nos aparecerá iluminado de color azul el beneficiario.</p>
              <img  src="<?=base_url()?>assets/img/registrado.PNG" class="img-fluid" alt="Responsive image" id="cargadorS" style="">
              <p>2.- Damos clic sobre el beneficiario iluminado y continuamos con el proceso normal de registrar el apoyo.</p>
              <img  src="<?=base_url()?>assets/img/seleccionado.PNG" class="img-fluid" alt="Responsive image" id="cargadorS" style="">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Entendido</button>
      </div>
    </div>
  </div>
</div>