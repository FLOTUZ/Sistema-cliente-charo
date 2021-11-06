<!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Apoyos</a>
    </li>
    <li class="breadcrumb-item active">Listado</li>
  </ol>
  <div class="row">
    <div class="col-md-3">
      <label for="estatus">Estatus solicitud:</label>
      <select id="estatus" class="form-control">
        <option value="0">Todos</option>
        <?php foreach($estatus->result() as $estado){?>
          <option value="<?=$estado->id_estatus_solicitud?>"><?=$estado->estatus?></option>
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
    <div class="col-md-3">
      <button class="btn btn-primary" style="margin-top: 2em;" onclick="consultar()">Consultar</button>
    </div>
  </div>
  <hr/>
  <div class="row">
    <div class="col-md-12 text-center" id="listadoLoad">
    </div>
  </div>
  

<!-- /.container-fluid -->