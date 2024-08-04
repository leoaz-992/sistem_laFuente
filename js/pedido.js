$(document).ready(function () {
  $("#altaPedido").submit(function (event) {
    event.preventDefault();

    let nombre = $("#nombre").val();
    let apellido = $("#apellido").val();
    let telefono = $("#telefono").val();
    let correo = $("#correo").val();
    let direccion = $("#direccion").val();
    let nombre_barrio = $("#nombre_barrio").val();

    let productosConCantidad =
      $("#altaPedido input[name^='cantidad_']").filter(function () {
        return $(this).val() > 0;
      }).length > 0;
    let tipo_pago = $("#tipo_pago").val();

    // Separa la calle del número
    // Dividir la dirección en palabras
    direccionarray = direccion.split(/(\d+)/);

    // Inicializar variables para la calle y el número
    let calle = direccionarray[0].trim();
    let numero = direccionarray[1];

    // Verificar que los campos no estén vacíos
    if (
      nombre === "" ||
      apellido === "" ||
      telefono === "" ||
      correo === "" ||
      nombre_barrio === null ||
      calle === "" ||
      numero === "" ||
      !productosConCantidad ||
      tipo_pago === null
    ) {
      $("#mensaje").html(`<div class="alert alert-dismissible alert-danger">
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          <strong>Uno de los campos estan vacios.</strong>
          <p>Por favor, rellena todos los campos.</p>
        </div>`);
      // Vaciar los campos de entrada
      /* $("#nombre").val("");
      $("#apellido").val("");
      $("#telefono").val("");
      $("#telefono").val("");
      $("#direccion").val("");
      $("#nombre_barrio").val("");
      $("#productoslist").val("");
      $("#cantidad").val("");

      $("#tipo_pago").val("");*/
      return;
    }

    $.ajax({
      type: "POST",
      url: "gestion_pedido.php",

      data: $(this).serialize() + "&calle=" + calle + "&numero=" + numero,
      success: function (response) {
        if (response === "success") {
          //redirigir y crear datos de sesion
          $("#mensaje")
            .html(`<div class="position-absolute top-75 start-50 translate-middle alert alert-dismissible alert-success">
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          <strong>Pedido Realizado Correctamente!</strong>
        </div>`);
          // Vaciar los campos de entrada
          $("#nombre").val("");
          $("#apellido").val("");
          $("#telefono").val("");
          $("#telefono").removeClass("is-valid");
          $("#correo").val("");
          $("#correo").removeClass("is-valid");
          $("#direccion").val("");
          $("#nombre_barrio").val("");
          $("#productoslist").val("");
          $("#altaPedido input[name^='cantidad_']").val("0");
          $("#tipo_pago").val("");
        } else {
          $("#mensaje").html(`<div class="alert alert-dismissible alert-danger">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Error al hacer el pedido</strong>
              <p>intente nuevamente.</p>
            </div>`);
        }
      },
    });
  });
});
