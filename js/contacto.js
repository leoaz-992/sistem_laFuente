$(document).ready(function () {
  $("#contactoForm").submit(function (event) {
    event.preventDefault();
    let nombre          = $("#nameContacto").val();
    let tel             = $("#telContacto").val();
    let email           = $("#emailContacto").val();
    let mensaje  = $("#msjContacto").val();

    //console.log(nombre,apellido,nombre_usuario,email,contrasena,copycontrasena,rol);


    // Verificar que los campos no estén vacíos
    if (email === "" ||nombre==="" || tel=="" ||mensaje==="") {
      $("#mensajeContact").html(`<div class="position-absolute top-50 start-50 translate-middle alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Error al enviar su consulta.</strong>
            <p>Por favor rellene todos los campos.</p>
          </div>`);
      return;
    }


    $.ajax({
      type: "POST",
      url: "gestionConsultas.php",
      data: {
        nombre,
        email
      },
      success: function (response) {
        //console.log(response);
        if (response === "success") {
          //redirigir y crear datos de sesion
          $("#mensajeContact")
            .html(`<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Consulta Enviada!</strong>
      </div>`);
        } else {
          $("#mensajeContact").html(`<div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Error</strong>
            <p>Los datos ingresados son incorrectos.</p>
          </div>`);
          // Vaciar los campos de entrada
          $("#email").val("");
          $("#contrasena").val("");
        }
      },
    });
  })
});
