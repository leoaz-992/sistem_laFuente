$(document).ready(function () {
  $("#newEmployeeForm").submit(function (event) {
    event.preventDefault();
    let nombre          = $("#nombreEmp").val();
    let apellido        = $("#apellidoEmp").val();
    let nombre_usuario   = $("#nombreUsuario").val();
    let email           = $("#emailEmployee").val();
    let contrasena      = $("#contrasena").val();
    let copycontrasena  = $("#repetirContrasena").val();
    let rol             = $("#rolUser").val();

    //console.log(nombre,apellido,nombre_usuario,email,contrasena,copycontrasena,rol);


    // Verificar que los campos no estén vacíos
    if (email === "" || contrasena === ""||nombre===""||apellido === "" || copycontrasena === ""||nombre_usuario===""|| rol==null) {
      $("#mensaje").html(`<div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Error al cargar los datos.</strong>
        <p>Por favor, rellena todos los campos.</p>
      </div>`);
      // Vaciar los campos de entrada
      $("#email").val("");
      $("#contrasena").val("");
      return;
    }


    $.ajax({
      type: "POST",
      url: "gestionRegistro.php",
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
          $("#mensaje")
            .html(`<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Datos Correctos!</strong>
      </div>`);
          setTimeout(() => {
            window.location.href = "index.php";
          }, 500);
        } else {
          $("#mensaje").html(`<div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Error al iniciar Sesión.</strong>
            <p>Los datos ingresados son incorrectos.</p>
          </div>`);
          // Vaciar los campos de entrada
          $("#email").val("");
          $("#contrasena").val("");
        }
      },
    });
  })
  //valida que los campos no se envien vacios
  $("#newEmployeeForm").submit(function (event) {
    $('input').each(function() {
      if($(this).val()==""){
        $(this).addClass("is-invalid");
        $(this).removeClass("is-valid");
        return;
      }else{
        $(this).addClass("is-valid");
        $(this).removeClass("is-invalid");
      }
  });
  });
});
