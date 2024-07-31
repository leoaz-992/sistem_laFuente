<?php
include("includes/header.php");
require_once("config/redireccion.php");

if (isset($_SESSION['rol'])) {
  redirigirA('index');
}
?>
<div class="row justify-content-center p-5">
  <div class="col-sm-10 col-md-9 col-lg-5 main py-4">
    <div id="mensaje">
    </div>
    <main class="form-signin w-100 m-auto">
      <form id="loginForm">
        <div class="row justify-content-center">
          <div class="col-2">
            <img class="mb-4" src="public/cascada.png" alt="logo" width="42" height="42">
          </div>
        </div>
        <h1 class="h3 mb-3 fw-normal text-center">Inicia Sesión</h1>
        <div class="form-floating m-3">
          <input type="text" id="email" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Correo o Nombre de usuario</label>
        </div>
        <div class="form-floating m-3">
          <input type="password" id="contrasena" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Contraseña</label>
        </div>
        <button class="btn btn-primary w-100 mt-3 py-2" type="submit">Iniciar Sesión</button>
      </form>
    </main>
  </div>
</div>
<!-- envia los datos del formulario -->
<?php
include("includes/footer.php");
?>