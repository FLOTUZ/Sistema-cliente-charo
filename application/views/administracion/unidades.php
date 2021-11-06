    <link href="<?php echo base_url(); ?>assets/vendor/DataTables/datatables.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/DataTables/responsive.dataTables.min.css" rel="stylesheet" />
<!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Apoyos y Unidades</a>
    </li>
    <li class="breadcrumb-item active">Listado</li>
  </ol>
<div class="row">
    <div class="col-md-4 col-sm-12">
      <h5>Unidades</h5>
      <table id="tUnidades" class="table table-bordered table-hover">
        <thead>
          <tr>
            <td>Unidad</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
    <div class="col-md-8 col-sm-12">
      <h5>Apoyos</h5>
      <table id="tApoyos" class="table table-bordered table-hover">
        <thead>
          <tr>
            <td>Apoyos</td>
            <td>Unidad</td>
            <td>Costo</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
</div>

<div class="modal fade" id="mUnidades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Unidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUnidades" data-parsley-validate="true" role="form" >
          <div class="row form-group">
            <div class="col-md-12">
              <label for="nombreUnidad">Nombre de Unidad:</label>
              <input type="text" name="nombreUnidad" id="nombreUnidad" class="form-control" data-parsley-required="true">
            </div>
          </div>
          <label class="text-danger text-center form-control" id="errorUnidad"></label>
          <input type="hidden" name="id_unidad" id="id_unidad" value=0>
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

<div class="modal fade" id="mApoyos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apoyos(Programas)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formApoyo" data-parsley-validate="true" role="form" >
          <div class="row form-group">
            <div class="col-md-12">
              <label for="nombreApoyo">Nombre del Apoyo(Programa):</label>
              <input type="text" name="nombreApoyo" id="nombreApoyo" class="form-control" data-parsley-required="true">
            </div>
            <div class="col-md-12">
              <label for="nombreApoyo">Unidad:</label>
              <select id="id_unidadA" class="form-control">
              <?php foreach($unidades->result() as $unidad){ ?>
                <option value="<?=$unidad->id_unidad?>"><?=$unidad->unidad?></option>
              <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <label for="costo">Costo:</label>
              <input type="number" name="costo" id="costo" class="form-control" step="any" value="0" data-parsley-required="true">
            </div>
            <div class="col-md-12">
              <label for="descripcion">Descripción:</label>
              <textarea id="descripcion" class="form-control" placeholder="No es necesario agregar descipción"></textarea>
            </div>
          </div>
          <label class="text-danger text-center form-control" id="errorApoyo"></label>
          <input type="hidden" name="id_apoyo" id="id_apoyo" value=0>
          <input type="submit" name="" value="Guardar" class="btn btn-success text-center" id="guardarA">
          <img  src="<?=base_url()?>assets/img/cargador.gif" class="img-fluid" alt="Responsive image" id="cargadorA" style="width: 10em;display: none;">
        </form>
        <div id="errorA"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid -->