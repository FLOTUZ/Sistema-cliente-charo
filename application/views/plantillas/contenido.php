<!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Inicio</a>
    </li>
    <li class="breadcrumb-item active"></li>
  </ol>
  <div class="row">
    <div class="col-sm-12 text-center">
      <a href="<?=base_url()?>Apoyos/nuevo" class="btn btn-primary btn-lg m-r-5">Registrar Nuevo Apoyo</a>
      <br/><br/><br/>
    </div>
<!--     <div class="alert alert-danger col-md-11 col-sm-12 m-4" role="alert">
      <p>Recuerda que solo se debe de registrar al beneficiaro solo una vez, no es necesario registrarlo cada que pide un apoyo.</p>
      <span class="close" data-dismiss="alert">×</span>
    </div> -->
   <!--  <div class="alert alert-warning col-md-11 col-sm-12 m-4" role="alert">
      <strong>Atención, cambios realizados:</strong>
      <ul>
        <li>Los administradores pueden registrar un apoyo y asignarlo al usuario del área correspondiente.</li>
        <li>Se puede cambiar la fecha de la autorización de un apoyo que fue entregado anteriormente.</li>
        <li>Los administradores pueden exportar la información</li>
      </ul>
      <span class="close" data-dismiss="alert">×</span>
    </div> -->
        <div class="col-xl-3 col-sm-6 mb-2">
          <div class="card bg-default o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-exclamation-circle"></i>
              </div>
              <div class="mr-5"><?=$pendientes?> Pendientes</div>
            </div>
            <a class="card-footer clearfix small z-1" href="<?=base_url()?>Apoyos/listado">
              <span class="float-left">Ver informe</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-2">
          <div class="card bg-default o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-times-circle"></i>
              </div>
              <div class="mr-5"><?=$rechazados?> Rechazados</div>
            </div>
            <a class="card-footer clearfix small z-1" href="<?=base_url()?>Apoyos/listado">
              <span class="float-left">Ver informes</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-2">
          <div class="card bg-default o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-check-circle"></i>
              </div>
              <div class="mr-5"><?=$rechazados?> Autorizados</div>
            </div>
            <a class="card-footer clearfix small z-1" href="<?=base_url()?>Apoyos/listado">
              <span class="float-left">Ver informes</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-2">
          <div class="card bg-default o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-share-square-o"></i>
              </div>
              <div class="mr-5"><?=$entregados?> Entregados</div>
            </div>
            <a class="card-footer clearfix small z-1" href="<?=base_url()?>Apoyos/listado">
              <span class="float-left">Ver informe</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>

        <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Estadísticas</div>
        <div class="card-body">
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>