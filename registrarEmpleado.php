<?php
include("includes/header.php");
require("conn.php");
/* esto verifica q solo los empleador con rol admin puedan añadir nuevos empleados. */
if (!isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != 1) {
  header('Location: index.php');
}

$sql = "SELECT id_rol, nombre_rol FROM `roles_empleados`";
$resultRoles = mysqli_query($connection, $sql);
?>
<div class="row justify-content-center p-5">
  <div class="col-md-6">
    <main class="form-signin w-100 m-auto main p-4">
      <form id="newEmployeeForm">
        <div class="row justify-content-center">
          <div class="col-2">
            <img class="mb-4" src="public/cascada.png" alt="logo" width="42" height="42">
          </div>
        </div>
        <h1 class="h3 mb-3 fw-normal text-center titleForm">Formulario de Registro</h1>
        <legend>Datos del nuevo Empleado</legend>
        <div class="row justify-content-around">
          <div class="col-lg-6 col-sm-12">
            <label for="nombreEmp" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreEmp" autofocus placeholder="ingrese su nombre" require />
            <div class="invalid-feedback">Por favor ingrese un nombre</div>
          </div>
          <div class="col-lg-6 col-sm-12">
            <label for="apellidoEmp" class="form-label">Apellido</label>
            <input type="text" class="form-control " id="apellidoEmp" placeholder="ingrese su Apellido" require />
            <div id="invalidApellido" class="invalid-feedback">Por favor, ingresa un apellido.</div>
          </div>
        </div>
        <div class="form-group">
          <label for="nombreUsuario" class="form-label mt-4">Nombre de usuario</label>
          <input type="text" class="form-control" id="nombreUsuario" aria-describedby="nombreUser" placeholder="Ingrese un nombre de usuario" require>
          <small id="nombreUser" class="form-text text-muted">El nombre de usuario debe tener minimo 8 caracteres.</small>
          <div class="invalid-feedback">por favor, ingrese un nombre de usuario.</div>
        </div>
        <div class="form-group">
          <label for="emailEmployee" class="form-label mt-4">Correo</label>
          <input type="email" class="form-control" id="emailEmployee" aria-describedby="emailHelp" placeholder="Enter email" require>
          <div class="invalid-feedback">por favor, ingrese un correo.</div>
        </div>
        <div class="form-group">
          <label for="contrasena" class="form-label mt-4">Contraseña</label>
          <input type="password" class="form-control" id="contrasena" placeholder="contraseña" autocomplete="off" require>
          <div class="valid-feedback">Las contraseña es valida.</div>
            <div id="invalid_contrasena" class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="repetirContrasena" class="form-label mt-4">Repita contraseña</label>
          <input type="password" class="form-control" id="repetirContrasena" placeholder="Repetir contraseña" autocomplete="off" require>
          <div class="valid-feedback">Las contraseñas coinciden</div>
            <div id="invalid_repetirContrasena" class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="rolUser" class="form-label mt-4">Rol</label>
          <select class="form-select" id="rolUser">
            <option value="null" selected disabled>Elegir Rol para el Empleado</option>
            <?php while ($rol = mysqli_fetch_array($resultRoles)) {
              echo "<option value='" . $rol['id_rol'] . "'>" . $rol['nombre_rol'] . "</option>";
            }
            mysqli_close($connection);
            ?>
          </select>
        </div>
        <button class="btn btn-primary w-100 mt-3 py-2" type="submit">Registrar Empleado</button>
      </form>
    </main>
    <div class="mt-2" id="mensaje">
    </div>
  </div>
</div>
<!-- envia los datos del formulario -->
<?php
include("includes/footer.php");
?>