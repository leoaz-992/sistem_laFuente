$(document).ready(function () {
  $("#loginForm").submit(function (event) {
    event.preventDefault();
    let email = $("#email").val();
    let contrasena = $("#contrasena").val();

    $.ajax({
        type: "POST",
        url: "login.php",
      data: {
        email,
        contrasena,
      },
      success: function (response) {
        if (response === "success") {
        //redirigir y crear datos de sesion
        } else {
            $("#message").html("Error en el registro. Por favor, intenta de nuevo.");
        }
      },
    });
  });
});