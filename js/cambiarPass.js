function validatePassword() {
  let inputPass = document.getElementById("newContrasena");
  let msjHelp = document.getElementById("msjHelp");
  let msjValid = document.getElementById("passValid");
  let msjInvalid = document.getElementById("passInvalid");

  const REGEXPASS = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

  if (REGEXPASS.test(inputPass.value)) {
    /* se validaa la contrasena */
    msjHelp.classList.add("d-none");
    msjInvalid.classList.add("d-none");
    msjValid.classList.remove("d-none");
    inputPass.classList.remove("is-invalid");
    inputPass.classList.add("is-valid");
  } else {
    /* no se validaa la contrasena */
    if (inputPass.value === "") {
      msjHelp.classList.remove("d-none");
      msjInvalid.classList.add("d-none");
      msjValid.classList.add("d-none");
      inputPass.classList.remove("is-valid");
      inputPass.classList.remove("is-invalid");
    } else {
      msjHelp.classList.remove("d-none");
      msjInvalid.classList.remove("d-none");
      msjValid.classList.add("d-none");
      inputPass.classList.remove("is-valid");
      inputPass.classList.add("is-invalid");
    }
  }
  validaterepeatPassword();
  toggleSubmitButton();
}

function validaterepeatPassword() {
  let inputPass = document.getElementById("newContrasena");
  let inputPass2 = document.getElementById("repetirNewcontrasena");
  let msjPassNoMatch = document.getElementById("msjPassNoMatch");
  let msjPassMatch = document.getElementById("msjPassMatch");
  const REGEXPASS = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

  if (
    REGEXPASS.test(inputPass2.value) &&
    inputPass.value === inputPass2.value
  ) {
    /* se validaa la contrasena */

    msjPassNoMatch.classList.add("d-none");
    msjPassMatch.classList.remove("d-none");
    inputPass2.classList.remove("is-invalid");
    inputPass2.classList.add("is-valid");
  } else {
    /* no se validaa la contrasena */
    if (inputPass2.value === "") {
      msjPassNoMatch.classList.add("d-none");
      msjPassMatch.classList.add("d-none");
      inputPass2.classList.remove("is-valid");
      inputPass2.classList.remove("is-invalid");
    } else {
      msjPassNoMatch.classList.remove("d-none");
      msjPassMatch.classList.add("d-none");
      inputPass2.classList.remove("is-valid");
      inputPass2.classList.add("is-invalid");
    }
  }

  toggleSubmitButton();
}

function toggleSubmitButton() {
  let inputPass = document.getElementById("newContrasena");
  let inputPass2 = document.getElementById("repetirNewcontrasena");
  let btnsubmit = document.getElementById("btnSubmit");
  if (
    inputPass.classList.contains("is-valid") &&
    inputPass2.classList.contains("is-valid")
  ) {
    btnsubmit.classList.remove("disabled");
  } else {
    btnsubmit.classList.add("disabled");
  }
}

function changeView(view) {
  if (view == "cambioPass") {
    btnCambioPass.classList.add("active");
    btnCambioPass.classList.add("disabled");
    btnEmpleados.classList.remove("active");
    btnEmpleados.classList.remove("disabled");

    cambioPass.classList.remove("d-none");
    tablaEmpleado.classList.add("d-none");
  } else if (view == "empleados") {
    btnCambioPass.classList.remove("active");
    btnCambioPass.classList.remove("disabled");
    btnEmpleados.classList.add("active");
    btnEmpleados.classList.add("disabled");

    cambioPass.classList.add("d-none");
    tablaEmpleado.classList.remove("d-none");
  }
}

document.addEventListener("DOMContentLoaded", function () {
  let msjResponse = document.getElementById("msjResponse");
  /* captura los campos de formulario para cambiar la contrasena */
  let inputPass = document.getElementById("newContrasena");
  let inputPass2 = document.getElementById("repetirNewcontrasena");
  /* captura el formulario de cambio de contraseña */
  let cambioPassForm = document.getElementById("cambioPassForm");

  /* captura las seccion formulario de cambio de contraseña */
  let btnCambioPass = document.getElementById("btnCambioPass");
  /* captura la seccion de tabla de empleados */
  let btnEmpleados = document.getElementById("btnEmpleados");
  /* captura los botones para cambiar de seccion */

  /* captura el evento de click para cambiar de seccion */
  if (btnCambioPass) {
    btnCambioPass.addEventListener("click", function () {
      changeView("cambioPass");
    });
  }

  if (btnEmpleados) {
    btnEmpleados.addEventListener("click", function () {
      changeView("empleados");
    });
  }
  inputPass.addEventListener("input", validatePassword);
  inputPass2.addEventListener("input", validaterepeatPassword);
  /* captura el formulario de cambio de contraseña */
  cambioPassForm.addEventListener("submit", function (event) {
    event.preventDefault();

    // Solo envía el formulario si ambos campos son válidos
    if (
      inputPass.classList.contains("is-valid") &&
      inputPass2.classList.contains("is-valid")
    ) {
      let formData = new FormData(cambioPassForm);

      fetch("config/cambiarPass.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success === true) {
            // Inserta el HTML del mensaje de éxito
            msjResponse.innerHTML = `
<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>${data.message}</strong>
</div>`;

            // Limpia el formulario
            cambioPassForm.reset();
            validatePassword();
            // cerrar la sesion después de 800ms
            setTimeout(() => {
              window.location.href = "loginout.php";
            }, 800);
          } else {
            // Inserta el HTML del mensaje de error
            msjResponse.innerHTML = `<div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>${data.message}</strong>
          </div>`;

            // Limpia el formulario
            cambioPassForm.reset();
            validatePassword();
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          // Puedes agregar lógica para manejar un error, como mostrar un mensaje de error
        });
    } else {
      console.error("Formulario no válido");
      // Muestra un mensaje de error o toma otra acción si el formulario no es válido
    }
  });
});
