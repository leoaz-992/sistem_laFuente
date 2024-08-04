const MENSAJES_ERROR_EDITAR = {
  CAMPO_VACIO: "Por favor, rellena todos los campos.",
  CORREO_INVALIDO: "El correo electrónico no es válido",
  CORREO_EXISTE: "El correo ingresado ya corresponde a un empleado.",
  NOMBRE_USUARIO_EXISTE: "El nombre de usuario no se encuentra disponible.",
};

const MENSAJE_EXITO_EDITAR = "¡Usuario Editado Correctamente!";

const validarFormularioEditar = (
  nombre,
  apellido,
  nombre_usuario,
  email,
  rol
) => {
  if (!nombre || !apellido || !nombre_usuario || !email || !rol) {
    return MENSAJES_ERROR_EDITAR.CAMPO_VACIO;
  }

  const regexCorreo = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
  if (!regexCorreo.test(email)) {
    return MENSAJES_ERROR_EDITAR.CORREO_INVALIDO;
  }

  return null;
};

function captureBtnEditar() {
  // Obtener todos los elementos con la clase btnEditar
  const botonesEditar = document.querySelectorAll(".btnEditar");

  // Agregar un event listener a cada botón
  botonesEditar.forEach(function (botonesEditar) {
    botonesEditar.addEventListener("click", function () {
      // Obtener el elemento tr padre y obtener el atributo idempleado
      const fila = this.closest("tr");
      const idEmpleado = fila.getAttribute("idempleado");

      // Hacer lo que necesites con el idEmpleado, como enviarlo a través de AJAX o mostrarlo en la consola
      let arrData = Array.from(getEmpleadoById(idEmpleado));

      updateinputValue(arrData, idEmpleado);
    });
  });
}

function sendFormEdit() {
  const btnSubmitEdit = document.getElementById("btnSubmitEdit");
  btnSubmitEdit.addEventListener("click", function () {
    const formEdit = document.getElementById("formEdit");
    const formData = new FormData(formEdit);
    const error = validarFormularioEditar(
      formData.get("nombreEdit"),
      formData.get("apellidoEdit"),
      formData.get("nombreUsuarioEdit"),
      formData.get("emailEdit"),
      formData.get("rolEdit")
    );
    if (error != null) {
      alert(error);
      return;
    }
    console.log("el id es: ", formData.get("id_edit"));

    fetch("config/user.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        id_edit: formData.get("id_edit"),
        nombre: formData.get("nombreEdit"),
        apellido: formData.get("apellidoEdit"),
        nombreUsuario: formData.get("nombreUsuarioEdit"),
        email: formData.get("emailEdit"),
        rol: formData.get("rolEdit"),
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status == "success") {
          alert(MENSAJE_EXITO_EDITAR);
          location.reload();
        } else {
          alert(data.message);
        }
      });
  });
}

function getEmpleadoById(idEmpleado) {
  const fila = document.querySelector(`tr[idempleado="${idEmpleado}"]`);
  if (fila) {
    const valores = Array.from(fila.querySelectorAll("td")).map((td) =>
      td.textContent.trim()
    );
    return valores;
  } else {
    return [];
  }
}

function updateinputValue(arrData, id) {
  if (arrData.length > 0) {
    document.getElementById("nombreEdit").value = arrData[0];
    document.getElementById("apellidoEdit").value = arrData[1];
    document.getElementById("nombreUsuarioEdit").value = arrData[2];
    document.getElementById("emailEdit").value = arrData[3];
    document.getElementById("id_edit").value = id;
  } else {
    return;
  }
}

document.addEventListener("DOMContentLoaded", function () {
  captureBtnEditar();
  sendFormEdit();
});
