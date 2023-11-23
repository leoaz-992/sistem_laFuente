<?php
include("includes/header.php");
require "conn.php";

$nombre_usuario = $_GET["username"];
?>
<h2> hola <?= $_SESSION["nombreCompleto"] ?></h2>
<h3 class="text-center">Cambiar Contraseña</h3>
<div class="row py-4">
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
<?php
include("includes/footer.php");
?>