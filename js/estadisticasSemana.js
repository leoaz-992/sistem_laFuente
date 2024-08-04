//funcion encatgada de traer los datos de la tabla
function getDatafecha(fecha) {
  let diaDeLaSemana = fecha.getDay();

  // Calcula la diferencia entre el día seleccionado y el domingo anterior
  let diferenciaDomingo = diaDeLaSemana;

  // Calcula la diferencia entre el sábado siguiente y el día seleccionado
  let diferenciaProximoDomingo = 7 - diaDeLaSemana;

  // Crea nuevas fechas para el domingo y el sábado
  let domingoAnterior = new Date(fecha);
  domingoAnterior.setDate(domingoAnterior.getDate() - diferenciaDomingo);

  let domingoSiguiente = new Date(fecha);
  domingoSiguiente.setDate(
    domingoSiguiente.getDate() + diferenciaProximoDomingo
  );

  // Formatea las fechas como 'YYYY-MM-DD' para enviarlas
  var domingoAnteriorStr = domingoAnterior.toISOString().split("T")[0];
  var domingoSiguienteStr = domingoSiguiente.toISOString().split("T")[0];

  // Realiza la solicitud fetch a config.php
  fetch("config/estadisticaSemana.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      domingoAnterior: domingoAnteriorStr,
      domingoSiguiente: domingoSiguienteStr,
    }),
  })
    .then((response) => response.json())
    .then((data) => graficoSemana(data.info))
    .catch((error) => console.log("Error: ", error));
}

function graficoSemana(data) {
  const lunes = document.getElementById("data_Lunes");
  const martes = document.getElementById("data_Martes");
  const miercoles = document.getElementById("data_Miércoles");
  const jueves = document.getElementById("data_Jueves");
  const viernes = document.getElementById("data_Viernes");
  const sabado = document.getElementById("data_Sabado");

  let contador = 0;

  clearSemanaDate();
  if (data.length == 0) {
    return;
  }

  for (let i = 0; i < data.length; i++) {
    const pedido = data[i];
    contador = contador + parseInt(pedido.cantidad_pedidos);
  }

  for (let i = 0; i < data.length; i++) {
    // Acceder a cada objeto
    const pedido = data[i];

    // Obtener el valor de dia_semana y cantidad_pedidos
    const dia = pedido.dia_semana;
    const cantidadStyle = parseInt(pedido.cantidad_pedidos) / contador;
    const cantidad = pedido.cantidad_pedidos;
    switch (dia) {
      case "Lunes":
        lunes.textContent = cantidad;
        lunes.style.setProperty("--size", cantidadStyle);
        break;
      case "Martes":
        martes.textContent = cantidad;
        martes.style.setProperty("--size", cantidadStyle);
        break;
      case "Miércoles":
        miercoles.textContent = cantidad;
        miercoles.style.setProperty("--size", cantidadStyle);
        break;
      case "Jueves":
        jueves.textContent = cantidad;
        jueves.style.setProperty("--size", cantidadStyle);
        break;
      case "Viernes":
        viernes.textContent = cantidad;
        viernes.style.setProperty("--size", cantidadStyle);
        break;
      case "Sábado":
        sabado.textContent = cantidad;
        sabado.style.setProperty("--size", cantidadStyle);
        break;
      default:
        break;
    }
  }
}

document.addEventListener("DOMContentLoaded", function () {
  //captura el input
  getDatafecha(new Date());
  let inputDate = document.getElementById("fecha_semana");
  inputDate.addEventListener("change", function () {
    let fechaSeleccionada = new Date(this.value + "T03:00:00Z");
    getDatafecha(fechaSeleccionada);
  });
});

function clearSemanaDate() {
  const lunes = document.getElementById("data_Lunes");
  const martes = document.getElementById("data_Martes");
  const miercoles = document.getElementById("data_Miércoles");
  const jueves = document.getElementById("data_Jueves");
  const viernes = document.getElementById("data_Viernes");
  const sabado = document.getElementById("data_Sabado");

  // Reemplaza los valores
  lunes.textContent = "";
  martes.textContent = "";
  miercoles.textContent = "";
  jueves.textContent = "";
  viernes.textContent = "";
  sabado.textContent = "";

  // cambiar el color y el valor del grafico
  lunes.style.setProperty("--size", "0");
  martes.style.setProperty("--size", "0");
  miercoles.style.setProperty("--size", "0");
  jueves.style.setProperty("--size", "0");
  viernes.style.setProperty("--size", "0");
  sabado.style.setProperty("--size", "0");
}
