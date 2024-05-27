<?php
include_once("includes/header.php");
require_once("config/conn.php");

if (!isset($_SESSION['id_rol'])) {
  redirigirA('index');
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>
<h2> Hola <?= $_SESSION["nombreCompleto"] ?></h2>

<div class="">
  <h3 class="text-center">Cambiar Contraseña</h3>
  <div class="row py-4 justify-content-center">
    <div class="col-md-4">
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
<?php
include_once("includes/footer.php");
?>