<?php
include_once("includes/header.php");
require_once("config/conn.php");
require_once("config/redireccion.php");

if (!isset($_SESSION['id_rol'])) {
  redirigirA('index');
}

//$nombre_usuario = $_SESSION['nombre_usuario'];
$nombreCompleto = $_SESSION["nombreCompleto"];
$partes = explode(" ", $nombreCompleto);

$nombre = $partes[0];
$apellido = $partes[1];
?>
<h2> Hola <?= $nombre ?></h2>
<div class="row justify-content-between">
  <!-- lista de opciones -->
  <?php if ($_SESSION['id_rol'] == '1') { ?>
    <div class="col-3 pt-2">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item m-0">
          <button id="btnCambioPass" class="nav-link optionNav active disabled">Cambiar mi contraseña</button>
        </li>
        <li class="nav-item optionNav m-0">
          <button id="btnEmpleados" class="nav-link">Lista de empleados</button>
        </li>
      </ul>
    </div>
  <?php } ?>
  <div id="cambioPass" class="col-lg-8 offset-lg-0 col-sm-8 offset-sm-2 position-relative">
    <h3 class="text-center">Cambiar Contraseña</h3>
    <div class="row py-4 justify-content-center">
      <div class="col-sm-10 col-md-8 col-lg-6">
        <div class="my-2" id="msjResponse">
        </div>
        <form id="cambioPassForm" class="row g-3 align-items-center" method="post">
          <input type="hidden" name="email_user" id="email_user" value='<?= $_SESSION['correo'] ?>'>
          <!-- contraseña actual -->
          <div class="form-group">
            <label class="form-label" for="contrasena">contraseña actual</label>
            <input class="form-control form-control-sm" type="password" name="contrasena" id="contrasena" autofocus>
          </div>
          <!-- nueva contraseña -->
          <div class="form-group">
            <label class="form-label" for="newContrasena"> nueva contraseña</label>
            <input class="form-control form-control-sm" type="password" name="newContrasena" id="newContrasena">
            <small id="msjHelp" class="form-text text-muted ps-2">La contraseña debe tener al menos 8 dígitos, mayúsculas, minúsculas y números.</small>
            <div id="passValid" class="text-success py-2 ps-3 d-none">
              Contraseña valida.
            </div>
            <div id="passInvalid" class="text-danger py-2 ps3 d-none">
              Por favor ingresa una contraseña valida.
            </div>
          </div>
          <!-- repetir nueva contraseña -->
          <div class="form-group">
            <label class="form-label" for="repetirNewcontrasena">repetir nueva contraseña</label>
            <input class="form-control form-control-sm" type="password" name="repetirNewcontrasena" id="repetirNewcontrasena">
            <div id="msjPassNoMatch" class="text-danger py-2 ps-3 d-none">
              la contraseña no coinciden.
            </div>
            <div id="msjPassMatch" class="text-success py-2 ps-3 d-none">
              la contraseña coincide.
            </div>
          </div>
          <button id="btnSubmit" class="btn btn-outline-dark btn-sm disabled" type="submit">cambiar contraseña</button>
        </form>
      </div>
    </div>
  </div>
  <div id="tablaEmpleado" class="col-lg-12 offset-lg-0 offset-sm-0 position-relative mt-3 d-none">
    <table class="table table-info">
      <thead>
        <tr>
          <th scope="col">nombre</th>
          <th scope="col">apellido</th>
          <th scope="col">nombre de usuario</th>
          <th scope="col">correo</th>
          <th scope="col">Rol</th>
          <th scope="col">actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //mostrar todos los empleados
        $sql = "SELECT e.nombre as nombre, e.apellido as apellido, e.correo as correo, e.nombre_usuario as nombre_usuario, r.nombre_rol AS Rol FROM empleados e JOIN roles_empleados r ON e.id_rol = r.id_rol;";

        $query = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($query)) {
          echo "<tr>";
          echo "<td>" . $row['nombre'] . "</td>";
          echo "<td>" . $row['apellido'] . "</td>";
          echo "<td>" . $row['nombre_usuario'] . "</td>";
          echo "<td>" . $row['correo'] . "</td>";
          echo "<td>" . $row['Rol'] . "</td>";
          echo "<td>";
          echo "<button class='btn btn-info btn-sm m-2'>Editar</button>";
          echo "<button class='btn btn-danger btn-sm'>Eliminar</button>";
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script src="js/cambiarPass.js"></script>
<?php
include_once("includes/footer.php");
?>