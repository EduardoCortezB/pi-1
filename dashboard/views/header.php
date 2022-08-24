<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pishy Bake's Panel</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo __DOM__; ?>img/logo-01.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
  <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <!-- Font Awesome Icons JS -->
  <script src="https://kit.fontawesome.com/3393d4e7a9.js" crossorigin="anonymous"></script>

 </head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      </li>

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">1 Notificaciones.</span>
          <div class="dropdown-divider"></div>
          
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 1 nuevo reporte
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver notificaciones</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <div>
      <a href="/" class="brand-link">
        <div class="image d-flex justify-content-center">
          <img src="<?php echo __DOM__; ?>/img/loggg.png" style="width: 80px" alt="logo">
        </div>
      </a>      
    </div>
    <div class="sidebar">
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><span class="text-center"><?php echo $userName; ?></span></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
        <li class="nav-item">
            <a href="<?php echo __DOM__; ?>panel/inicio" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo __DOM__; ?>page/inicio" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
              <p>
                Langing Page
              </p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-align-justify"></i>
              <p>
                Opciones de productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> 
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <!-- add class active to tag a -->
                <a href="<?php echo __DOM__; ?>dashboard/index.php?page=list" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>Listado de productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo __DOM__; ?>dashboard/index.php?page=uploadFile" class="nav-link">
                  <i class="fas fa-upload"></i>
                  <p>Subir Producto</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo __DOM__; ?>dashboard/index.php?page=list_normalOrders" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>Listado Ordenes</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-align-justify"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> 
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo __DOM__; ?>dashboard/index.php?page=users" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>Listado Usuarios</p>
                </a>
              </li>
            </ul>
          </li> -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
              
              </p>
            </a>
          </li> -->
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column">
        <li class="nav-item">
            <a href="#" id="closeSesion"  class="nav-link">
            <i class="nav-icon fas fa-times-circle"></i>
              <p>Cerrar Sesión</p>
            </a>
        </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>