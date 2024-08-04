<?php
include_once("includes/header.php");
require_once("config/conn.php");
require_once("config/redireccion.php");
include_once("config/roles.php");

if (!isset($_SESSION['rol'])) {
  redirigirA('index');
}

//$nombre_usuario = $_SESSION['nombre_usuario'];
$nombreCompleto = $_SESSION["nombreCompleto"];
$partes = explode(" ", $nombreCompleto);
$msj = "";
$nombre = $partes[0];
$apellido = $partes[1];
if (isset($_GET['msj'])) {
  $msj = $_GET['msj'];
}
?>
<div id="msjNotify">
  <?php
  if ($msj == "Usuario eliminado") {
    echo '<div class="position-absolute top-25 start-50 translate-middle alert alert-dismissible alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong><i class="bi bi-trash text-success"></i>' . $msj . '</strong>
    </div>';

    echo '<script>
    setTimeout(function () {
      $("#msjNotify").html("");
      }, 5000);
      </script>';
  }
  ?>
</div>
<h2> Hola <?= $nombre ?></h2>
<div class="row justify-content-between">

  <!-- lista de opciones -->
  <?php if ($_SESSION['rol'] == "ADMIN") { ?>
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
    <h3 class="text-center">Lista de Empleados</h3>
    <table class="table table-info">
      <thead>
        <tr>
          <th class="ps-2" scope="col">nombre</th>
          <th scope="col">apellido</th>
          <th scope="col">nombre de usuario</th>
          <th scope="col">correo</th>
          <th scope="col">Rol</th>
          <th class="text-center" scope="col">actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //mostrar todos los empleados
        $sql = "SELECT e.id_usuario as 'id', e.nombre as nombre, e.apellido as apellido, e.correo as correo, e.nombre_usuario as nombre_usuario, r.nombre_rol AS Rol FROM empleados e JOIN roles_empleados r ON e.id_rol = r.id_rol;";

        $query = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($query)) {
          echo "<tr  idempleado='" . $row['id'] . "'>";
          echo "<td class='ps-3'>" . $row['nombre'] . "</td>";
          echo "<td>" . $row['apellido'] . "</td>";
          echo "<td>" . $row['nombre_usuario'] . "</td>";
          echo "<td>" . $row['correo'] . "</td>";
          echo "<td>" . $row['Rol'] . "</td>";
          echo "<td class='text-center'>";
          /* echo "<a href='config/user.php?id_edit=" . $row['id'] . "' class='btn btn-info btn-sm m-2'>Editar</a>"; */
          echo "<button type='button' class='btn btn-info btn-sm m-2 btnEditar' data-bs-toggle='modal' data-bs-target='#formEditar'>Editar</button>";
          echo " <a href='config/user.php?id_delete=" . $row['id'] . "' class='btn btn-danger btn-sm'>Eliminar</button> ";
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="formEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Datos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEdit">
          <div class="form-group">
            <label class="form-label" for="nombreEdit">nombre</label>
            <input class="form-control form-control-sm" type="text" name="nombreEdit" id="nombreEdit">
          </div>
          <div class="form-group">
            <label class="form-label" for="apellidoEdit">apellido</label>
            <input class="form-control form-control-sm" type="text" name="apellidoEdit" id="apellidoEdit">
          </div>
          <div class="form-group">
            <label class="form-label" for="nombreUsuarioEdit">nombre de usuario</label>
            <input class="form-control form-control-sm" type="text" name="nombreUsuarioEdit" id="nombreUsuarioEdit">
          </div>
          <div class="form-group">
            <label class="form-label" for="emailEdit">email</label>
            <input class="form-control form-control-sm" type="email" name="emailEdit" id="emailEdit">
          </div>
          <div class="form-group">
            <label class="form-label" for="rolEdit">Rol</label>
            <select class="form-select form-select-sm" name="rolEdit" id="rolEdit">
              <option selected disabled value="">Seleccionar</option>
              <?php
              $roles = getRoles();
              foreach ($roles as $rol) {
                echo "<option value='" . $rol['id_rol'] . "'>" . $rol['nombre_rol'] . "</option>";
              }
              ?>
            </select>
          </div>
          <input type="hidden" name="id_edit" id="id_edit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="btnSubmitEdit" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
<script src="js/user.js"></script>
<script src="js/cambiarPass.js"></script>
<?php
include_once("includes/footer.php");
?>