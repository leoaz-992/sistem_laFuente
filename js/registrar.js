const MENSAJES_ERROR = {
    CAMPO_VACIO: 'Por favor, rellena todos los campos.',
    CONTRASEÑA_NO_VALIDA:'La contraseña no es valida, Debe tener al menos 8 caracteres de longitud y contener letras mayúsculas, letras minúsculas y al menos un número.',
    CONTRASEÑAS_NO_COINCIDEN: 'Las contraseñas no coinciden',
    CORREO_INVALIDO: 'El correo electrónico no es válido',
    CORREO_EXISTE:'El correo ingresado ya corresponde a un empleado.',
    NOMBRE_USUARIO_EXISTE:'El nombre de usuario no se encuentra disponible.'
  };

const MENSAJE_EXITO = '¡Usuario Creado Correctamente!';

const validarFormulario = (nombre, apellido, nombre_usuario, email, contrasena, copycontrasena, rol) => {
    if (!nombre || !apellido || !nombre_usuario || !email || !contrasena || !copycontrasena || !rol) {
      return MENSAJES_ERROR.CAMPO_VACIO;
    }
  
    if (contrasena !== copycontrasena) {
      return MENSAJES_ERROR.CONTRASEÑAS_NO_COINCIDEN;
    }
  
    const regexCorreo = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    if (!regexCorreo.test(email)) {
      return MENSAJES_ERROR.CORREO_INVALIDO;
    }

    const regexPass=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/
    if (!regexPass.test(contrasena)) {
      return MENSAJES_ERROR.CONTRASEÑA_NO_VALIDA;
    }
  
    return null;
  }

$(document).ready(function () {
  $("#newEmployeeForm").submit(function (event) {
    event.preventDefault();

    let nombre          = $("#nombreEmp").val().trim();
    let apellido        = $("#apellidoEmp").val().trim();
    let nombre_usuario  = $("#nombreUsuario").val().trim();
    let email           = $("#emailEmployee").val().trim();
    let contrasena      = $("#contrasena").val().trim();
    let copycontrasena  = $("#repetirContrasena").val().trim();
    let rol             = $("#rolUser").val();

    
    const mensajeError = validarFormulario(nombre, apellido, nombre_usuario, email, contrasena, copycontrasena, rol);

    if (mensajeError) {
      if(mensajeError == MENSAJES_ERROR.CAMPO_VACIO){
        $("#nombreEmp").addClass("is-invalid").val("");
        $("#apellidoEmp").addClass("is-invalid").val("");
        $("#nombreUsuario").addClass("is-invalid").val("");
        $("#emailEmployee").addClass("is-invalid").val("");
        $("#contrasena").addClass("is-invalid").val("");
        $("#repetirContrasena").addClass("is-invalid").val("");
        $("#rolUser").addClass("is-invalid");
      }
      if(mensajeError == MENSAJES_ERROR.CONTRASEÑAS_NO_COINCIDEN){
        $("#contrasena").removeClass("is-valid");
        $("#invalid_contrasena").text(mensajeError);       
        $("#repetirContrasena").removeClass("is-valid");
        $("#invalid_repetirContrasena").text(mensajeError); 
        $("#contrasena").addClass("is-invalid");
        $("#repetirContrasena").addClass("is-invalid");
      }
      if(mensajeError == MENSAJES_ERROR.CONTRASEÑA_NO_VALIDA){
        $("#contrasena").removeClass("is-valid");
        $("#invalid_contrasena").text(mensajeError);       
        $("#repetirContrasena").removeClass("is-valid");
        $("#invalid_repetirContrasena").text(mensajeError); 
        $("#contrasena").addClass("is-invalid");
        $("#repetirContrasena").addClass("is-invalid");
      }
      $("#mensaje").html(`<div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Error al cargar los datos.</strong>
        <p>${mensajeError}</p>
      </div>`);
      
      return;
    }else{
      $("#nombreEmp").removeClass("is-invalid");
      $("#apellidoEmp").removeClass("is-invalid");
      $("#nombreUsuario").removeClass("is-invalid");
      $("#emailEmployee").removeClass("is-invalid");
      $("#contrasena").removeClass("is-invalid");
      $("#repetirContrasena").removeClass("is-invalid");
      $("#rolUser").removeClass("is-invalid");
      $("#newEmployeeForm").removeClass('was-validated')
    }

    $.ajax({
      type: "POST",
      url: "gestionRegistroEmpleado.php",
      data: {
        nombre,
        apellido,
        nombre_usuario, 
        email,
        contrasena,
        copycontrasena,
        rol
      },
      success: function (response) {
        //console.log(response);
        if (response === "success") {
          //redirigir y crear datos de sesion
          $("#mensaje").html(`<div class="alert alert-dismissible alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>${MENSAJE_EXITO}</strong>
              </div>`);
          setTimeout(() => {
            window.location.href = "index.php";
          }, 500);
        }if(response === "El correo o el usuario ya existe"){
          $("#mensaje").html(`<div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Error al Crear un Registro.</strong>
            <p>El usuario o el correo ya existen.</p>
          </div>`);
          $("#nombreUsuario").addClass("is-invalid");
          $("#emailEmployee").addClass("is-invalid");
          $("#nombreUsuario").val("");
          $("#emailEmployee").val("");

        }
        if(response === "No se pudo crear el empleado."){
          $("#mensaje").html(`<div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Error al Crear un Registro.</strong>
            <p>Los datos ingresados son incorrectos.</p>
          </div>`);
          // Vaciar los campos de entrada
          $("#nombreEmp").val("");
          $("#apellidoEmp").val("");
          $("#nombreUsuario").val("");
          $("#emailEmployee").val("");
          $("#contrasena").val("");
          $("#repetirContrasena").val("");
          $("#rolUser").val("");
        }
      },
    });
  })
});
