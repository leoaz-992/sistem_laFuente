$(document).ready(function () {
  $("#loginForm").submit(function (event) {
    event.preventDefault();
    let email = $("#email").val();
    let contrasena = $("#contrasena").val();

    $.ajax({
        type: "POST",
        url: "gestionLogin.php",
      data: {
        email,
        contrasena,
      },
      success: function (response) {
        if (response === "success") {
        //redirigir y crear datos de sesion
        $("#mensaje").html(`<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Datos Correctos!</strong>
      </div>`);
          setTimeout(()=>{window.location.href= "index.php";},500);
        } else {
            $("#mensaje").html(`<div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Error al iniciar Sesión.</strong>
            <p>Los datos ingresados son incorrectos.</p>
          </div>`);
        }
      },
    });
  });
});