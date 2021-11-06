<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?=nombreProyecto?></title>
  <!-- Bootstrap core CSS-->
  <link rel="icon" type="image/png" href="<?=base_url()?>assets/img/icono.png" />
  <link href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?=base_url()?>assets/vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?=base_url()?>assets/vendor/parsley/src/parsley.css" rel="stylesheet" type="text/css" />>
  <link href="<?=base_url()?>assets/css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?=base_url()?>"><?=nombreProyecto?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Inicio">
          <a class="nav-link" href="<?=base_url()?>Home">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Inicio</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Apoyos">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cubes"></i>
            <span class="nav-link-text">Apoyos</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="<?=base_url()?>Apoyos/nuevo"><i class="fa fa-fw fa-plus-circle"></i>Nuevo</a>
            </li>
            <hr>
            <li>
              <a href="<?=base_url()?>Apoyos/listado/"><i class="fa fa-fw fa-list"></i>Listado</a>
            </li>
          </ul>
        </li>
        <?php if($this->session->Charo2019['tipo_usuario']>1){?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Información">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Información</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="<?=base_url()?>Informacion/personas">Personas</a>
            </li>
            <li>
              <a href="<?=base_url()?>Informacion/tenencias">Comunidades y Tenencias</a>
            </li>
            <li>
              <a href="<?=base_url()?>Informacion/apoyos">Apoyos(Programas)</a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Administración">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cog"></i>
            <span class="nav-link-text">Administración</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <?php if($this->session->Charo2019['tipo_usuario']==3){ ?>
            <li>
              <a href="<?=base_url()?>Usuarios">Usuarios</a>
            </li>
            <li>
              <a href="<?=base_url()?>Administracion/beneficiarios">Beneficiarios</a>
            </li>
            <li>
              <a href="<?=base_url()?>Administracion/comunidades">Localidades y Secciones</a>
            </li>
          <?php } ?>
            <li>
              <a href="<?=base_url()?>Administracion/unidadesApoyos">Unidades y Apoyos</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mi información">
          <a class="nav-link" href="<?=base_url()?>Usuarios/miInformacion">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Mi información</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url()?>Login/logOut">
            <?=$this->session->Charo2019['usuario']?> - <i class="fa fa-fw fa-sign-out"></i>Salir</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">