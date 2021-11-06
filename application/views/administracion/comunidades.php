    <link href="<?php echo base_url(); ?>assets/vendor/DataTables/datatables.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/DataTables/responsive.dataTables.min.css" rel="stylesheet" />
<!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Localidades y Secciones</a>
    </li>
    <li class="breadcrumb-item active">Listado</li>
  </ol>
<div class="row">
    <div class="col-md-6 col-sm-12">
      <h5>Localidades</h5>
      <table id="tComunidades" class="table table-bordered table-hover">
        <thead>
          <tr>
            <td>Localidad</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
    <div class="col-md-6 col-sm-12">
      <h5>Secciones</h5>
      <table id="tSecciones" class="table table-bordered table-hover">
        <thead>
          <tr>
            <td>Seccion</td>
            <td>Comunidad</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
</div>

<div class="modal fade" id="mSeccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sección</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formSeccion" data-parsley-validate="true" role="form" >
          <div class="row form-group">
            <div class="col-md-12">
              <label for="nombreSeccion">Sección:</label>
              <input type="text" name="nombreSeccion" id="nombreSeccion" class="form-control" data-parsley-required="true">
            </div>
            <div class="col-md-12">
              <label for="comunidadPertenece">Localidad a la que pertenece:</label>
              <select id="comunidadPertenece" name="comunidadPertenece" class="form-control" data-parsley-required="true">
                <?php foreach($comunidades->result() as $comunidad){ ?>
                  <option value="<?=$comunidad->id_comunidad?>"><?=$comunidad->comunidad?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <label class="text-danger text-center form-control" id="errorSeccion"></label>
          <input type="hidden" name="id_seccion" id="id_seccion" value=0>
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

<div class="modal fade" id="mComunidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comunidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formComunidad" data-parsley-validate="true" role="form" >
          <div class="row form-group">
            <div class="col-md-12">
              <label for="nombreComunidad">Nombre de la comunidad:</label>
              <input type="text" name="nombreComunidad" id="nombreComunidad" class="form-control" data-parsley-required="true">
            </div>
          </div>
          <label class="text-danger text-center form-control" id="errorComunidad"></label>
          <input type="hidden" name="id_comunidad" id="id_comunidad" value=0>
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