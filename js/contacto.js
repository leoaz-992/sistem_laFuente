$(document).ready(function () {
  $("#contactoForm").submit(function (event) {
    event.preventDefault();
    let nombre   = $("#nameContacto").val();
    let telefono = $("#telContacto").val();
    let email    = $("#emailContacto").val();
    let mensaje  = $("#msjContacto").val();

    console.log(mensaje.length);


    // Verificar que los campos no estén vacíos
    if (mensaje==="") {
      $("#mensajeContact").html(`<div class="position-absolute top-50 start-50 translate-middle alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><i class="bi bi-exclamation-triangle text-danger"></i> Error al enviar su consulta.</strong>
            <p>Por favor Escriba su consulta en el campo mensaje.</p>
          </div>`);
      return;
    }
    if (mensaje.length>800) {
      $("#mensajeContact").html(`<div class="position-absolute top-50 start-50 translate-middle alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><i class="bi bi-exclamation-triangle text-danger"></i>Error.<i class="bi bi-exclamation-triangle text-danger"></i></strong>
            <p>El mensaje es muy Largo.</p>
          </div>`);
      return;
    }
    if(telefono.length <8){
      $("#mensajeContact").html(`<div class="position-absolute top-50 start-50 translate-middle alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><i class="bi bi-exclamation-triangle text-danger"></i>Número de Teléfono no valido.<i class="bi bi-exclamation-triangle text-danger"></i></strong>
            <p>Por favor escriba un numero de telefono valido.</p>
          </div>`);
          return;
    }
    $.ajax({
      type: "POST",
      url: "gestionConsultas.php",
      data: {
        nombre,
        telefono,
        email,
        mensaje
      },
      success: function (response) {
        //console.log(response);
        if (response === "success") {
          //redirigir y crear datos de sesion
          $("#mensajeContact")
            .html(`<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong><i class="bi bi-envelope-check text-success"></i>Consulta Enviada!</strong>
      </div>`);
      } else {
        $("#mensajeContact").html(`<div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><i class="bi bi-exclamation-triangle text-danger"></i>Error!!!<i class="bi bi-exclamation-triangle text-danger"></i></strong>
            <p>Ocurrio un problema con tu mensaje. Intenta nuevamente mas tarde.</p>
          </div>`);
          // Vaciar los campos de entrada
          $("#nameContacto").val("");
          $("#telContacto").val("");
          $("#emailContacto").val("");
          $("#msjContacto").val("");
        }
      },
    });
  })
});
