    <link href="<?php echo base_url(); ?>assets/vendor/DataTables/datatables.css" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/select2/css/select2.css">
<!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Información</a>
    </li>
    <li class="breadcrumb-item active">Personas</li>
  </ol>
  <div class="row">
    <div class="col-md-4">
      <label for="beneficiario">Seleccione un beneficiario</label>
    <select id="beneficiario" class="form-control multiple">
      <?php foreach($beneficiarios->result() as $beneficiario){ ?>
        <option value="<?=$beneficiario->id_beneficiario?>"><?=$beneficiario->nombre?> <?=$beneficiario->apPaterno?> <?=$beneficiario->apMaterno?> (<?=$beneficiario->codigo?>)</option>
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