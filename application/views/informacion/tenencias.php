    <link href="<?php echo base_url(); ?>assets/vendor/DataTables/datatables.css" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/select2/css/select2.css">
<!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Información</a>
    </li>
    <li class="breadcrumb-item active">Secciones y Localidades</li>
  </ol>
  <div class="row">
    <div class="col-md-3">
      <label for="comunidad">Localidad:</label>
      <select class="form-control" id="comunidad" name="comunidad">
        <?php foreach($comunidades->result() as $comunidad){ ?>
          <option value="<?=$comunidad->id_comunidad?>"><?=$comunidad->comunidad?></option>
        <?php } ?> 
      </select>
    </div>
    <div class="col-md-3">
      <label for="seccion">Sección:</label>
      <select class="form-control" id="seccion" name="seccion">
        <option class="" value="0">Todas</option>
        <?php foreach($secciones->result() as $seccion){ ?>
          <option class="seccion comunidad<?=$seccion->id_comunidad?>" style="display: none;" value="<?=$seccion->id_seccion?>"><?=$seccion->seccion?></option>
        <?php } ?> 
      </select>
    </div>
    <div class="col-md-3">
      <label for="fecha_inicio">Fecha inicio:</label>
      <input type="date" id="fecha_inicio" class="form-control">
    </div>
    <div class="col-md-3">
      <label for="fecha_fin">Fecha final:</label>
      <input type="date" id="fecha_fin" class="form-control">
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary" style="margin-top: 2em;" onclick="consultar()">Consultar</button>
    </div>
  </div>
  <hr/>
  <div class="row">
    <div class="col-md-12 text-center" id="listadoLoad">
    </div>
  </div>
  

<!-- /.container-fluid -->