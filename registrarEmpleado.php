<?php
include("includes/header.php");
require("conn.php");

/* esto verifica q solo los empleador con rol admin puedan añadir nuevos empleados. */
if (!isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != 1) {
  header('Location: index.php');
}

$sql="SELECT id_rol, nombre_rol FROM `roles_empleados`";
$resultRoles= mysqli_query($connection,$sql);
?>
<div class="row justify-content-center p-5">
  <div class="col-md-6">
    <div class="" id="mensaje">
    </div>
    <main class="form-signin w-100 m-auto">
      <form id="newEmployeeForm">
        <div class="row justify-content-center">
          <div class="col-2">
            <img class="mb-4" src="public/cascada.png" alt="logo" width="42" height="42">
          </div>
        </div>
        <h1 class="h3 mb-3 fw-normal text-center titleForm">Formulario de Registro</h1>
        <legend>Datos del nuevo Empleado</legend>
        <div class="row g-2 justify-content-around">
          <div class="col-md-6 mb-3">
            <label for="firstName" class="form-label">Nombre</label>
            <input type="text" class="form-control is-valid" id="firstName" placeholder="ingrese su nombre" require/>
            <div class="valid-feedback">Success! You've done it.</div>
            <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName" class="form-label">Apellido</label>
            <input type="text" class="form-control is-invalid" id="lastName" placeholder="ingrese su Apellido" require/>
            <div class="valid-feedback">Success! You've done it.</div>
            <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
          </div>
        </div>
        <div class="form-group">
          <label for="nombreUsuario" class="form-label mt-4">Nombre de usuario</label>
          <input type="text" class="form-control" id="nombreUsuario" aria-describedby="emailHelp" placeholder="Ingrese un nombre de usuario" require>
          <small id="emailHelp" class="form-text text-muted">El nombre de usuario debe tener minimo 8 caracteres.</small>
        </div>
        <div class="form-group">
          <label for="emailEmployee" class="form-label mt-4">Correo</label>
          <input type="email" class="form-control" id="emailEmployee" aria-describedby="emailHelp" placeholder="Enter email" require>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1" class="form-label mt-4">Contraseña</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="contraseña" autocomplete="off" require>
        </div>
        <div class="form-group">
          <label for="RepetirContraseña" class="form-label mt-4">Repita contraseña</label>
          <input type="password" class="form-control" id="RepetirContraseña" placeholder="Repetir contraseña" autocomplete="off" require>
        </div>
        <div class="form-group">
      <label for="rolUser" class="form-label mt-4">Rol</label>
      <select class="form-select" id="rolUser">
        <?php while($rol = mysqli_fetch_array($resultRoles)){
            echo "<option value='". $rol['id_rol'] ."'>".$rol['nombre_rol']."</option>";
        } ?>
      </select>
    </div>
        <button class="btn btn-primary w-100 mt-3 py-2" type="submit">Registrar Empleado</button>
      </form>
    </main>
  </div>
</div>
<!-- envia los datos del formulario -->
<?php
include("includes/footer.php");
?>