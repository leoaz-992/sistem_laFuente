$(document).ready(function () {
  $("#contactoForm").submit(function (event) {
    event.preventDefault();

    let nombre = $("#nameContacto").val();
    let telefono = $("#telContacto").val();
    let email = $("#emailContacto").val();
    let mensaje = $("#msjContacto").val();

    let numeroTelefono = Number(telefono);

    // Verificar que los campos no estén vacíos
    if (mensaje === "") {
      $("#mensajeContact")
        .html(`<div class="position-absolute top-50 start-50 translate-middle alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><i class="bi bi-exclamation-triangle text-danger"></i> Error al enviar su consulta.</strong>
            <p>Por favor Escriba su consulta en el campo mensaje.</p>
          </div>`);

      // Ocultar el mensaje después de 5 segundos
      setTimeout(function () {
        $("#mensajeContact").html("");
      }, 5000);

      return;
    }
    if (mensaje.length > 800) {
      $("#mensajeContact")
        .html(`<div class="position-absolute top-50 start-50 translate-middle alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><i class="bi bi-exclamation-triangle text-danger"></i>Error.<i class="bi bi-exclamation-triangle text-danger"></i></strong>
            <p>El mensaje es muy Largo.</p>
          </div>`);
      // Ocultar el mensaje después de 5 segundos
      setTimeout(function () {
        $("#mensajeContact").html("");
      }, 5000);
      return;
    }
    //busca que sea un telefono valido.
    if (telefono.length < 8 || isNaN(numeroTelefono)) {
      $("#mensajeContact")
        .html(`<div class="position-absolute top-50 start-50 translate-middle alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><i class="bi bi-exclamation-triangle text-danger"></i>Número de Teléfono no valido.<i class="bi bi-exclamation-triangle text-danger"></i></strong>
            <p>Por favor escriba un numero de telefono valido.</p>
          </div>`);
      // Ocultar el mensaje después de 5 segundos
      setTimeout(function () {
        $("#mensajeContact").html("");
      }, 5000);
      return;
    }
    $.ajax({
      type: "POST",
      url: "gestionConsultas.php",
      data: {
        nombre,
        telefono,
        email,
        mensaje,
      },
      success: function (response) {
        if (response === "success") {
          // consulta realizada satisfactoriamente
          $("#mensajeContact")
            .html(`<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong><i class="bi bi-envelope-check text-success"></i>Consulta Enviada!</strong>
      </div>`);

          // Vaciar los campos de entrada
          $("#nameContacto").val("");
          $("#telContacto").val("");
          $("#emailContacto").val("");
          $("#msjContacto").val("");

          // Ocultar el mensaje después de 5 segundos
          setTimeout(function () {
            $("#mensajeContact").html("");
          }, 5000);
          return;
        } else {
          $("#mensajeContact")
            .html(`<div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><i class="bi bi-exclamation-triangle text-danger"></i>Error!!!<i class="bi bi-exclamation-triangle text-danger"></i></strong>
            <p>Ocurrio un problema con tu mensaje. Intenta nuevamente mas tarde.</p>
          </div>`);
        }
        // Vaciar los campos de entrada
        $("#nameContacto").val("");
        $("#telContacto").val("");
        $("#emailContacto").val("");
        $("#msjContacto").val("");

        // Ocultar el mensaje después de 5 segundos
        setTimeout(function () {
          $("#mensajeContact").html("");
        }, 5000);
        return;
      },
    });
  });
});
