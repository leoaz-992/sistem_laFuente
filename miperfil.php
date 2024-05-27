<?php
include_once("includes/header.php");
require_once("config/conn.php");

if (!isset($_SESSION['id_rol'])) {
  redirigirA('index');
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>
<h2> Hola <?= $_SESSION["nombreCompleto"] ?></h2>
<div class="row">
  <!-- lista de opciones -->
  <div class="col-3 border border-bottom-0 border-end-0 pt-2">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item m-0">
        <button class="nav-link active">Cambiar mi contraseña</button>
      </li>
      <li class="nav-item m-0">
        <button class="nav-link">Lista de empleados</button>
      </li>
    </ul>
  </div>
  <div class="col-lg-8 offset-lg-0 col-sm-8 offset-sm-2 position-relative">
    <h3 class="text-center">Cambiar Contraseña</h3>
    <div class="row py-4 justify-content-center">
      <div class="col-sm-10 col-md-8 col-lg-6">
        <form class="row g-3 align-items-center" method="post">
          <div class="form-group">
            <label class="form-label" for="contrasena">contraseña actual</label>
            <input class="form-control form-control-sm" type="password" name="contrasena" id="contrasena" autofocus>
          </div>
          <div class="form-group">
            <label class="form-label" for="newContrasena"> nueva contraseña</label>
            <input class="form-control form-control-sm" type="password" name="newContrasena" id="newContrasena">
          </div>
          <div class="form-group">
            <label class="form-label" for="repetirNewcontrasena">repetir nueva contraseña</label>
            <input class="form-control form-control-sm" type="password" name="repetirNewcontrasena" id="repetirNewcontrasena">
          </div>
          <button class="btn btn-outline-dark btn-sm" type="submit">cambiar contraseña</button>

        </form>
      </div>
    </div>
  </div>
</div>
<?php
include_once("includes/footer.php");
?>