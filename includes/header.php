<?php session_start()?>
<!DOCTYPE html>
<html lang="es-Ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <!-- iconos de bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="shortcut icon" href="public/cascada.png" type="image/x-icon">
  <title>La fuente</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img class="px-2" src="public/cascada.png" alt="logo" srcset="">La Fuente</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link" href="#productos">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pedidos.php">hace tu pedido</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="pedidos.php">Contactos</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="pedidos.php">sobre nosotros</a>
        </li>
        <?php if(isset($_SESSION['nombre_usuario'])){ /* esto solo se tiene q ver si el empleado esta logueado */ ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Para Empleados
          </a>
          <ul class="dropdown-menu">
            <?php if($_SESSION['id_rol']==1){?>
              <li><a class="dropdown-item" href="registrarEmpleado.php">Añadir Empleado</a></li>
            <?php } ?>
            <li><a class="dropdown-item" href="#">Ver pedidos</a></li>
            <li><a class="dropdown-item" href="#">Ver Productos</a></li>
            <li><a class="dropdown-item" href="#">Ver consultas</a></li>
            <li><a class="dropdown-item" href="#">Ver Distribucion</a></li>
          </ul>
        </li>
          <?php }?>
      </ul>
      <?php if(isset($_SESSION['nombre_usuario'])){ ?>
        <a class="btn btn-danger d-flex" href="loginout.php">cerrar Sesión</a>
        <?php }else{?>
      <a class="btn btn-primary d-flex" href="loginForm.php">Login</a>
      <?php }?>
    </div>
  </div>
</nav>

<section class="container py-3">
