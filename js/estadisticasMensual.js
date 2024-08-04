// obtener los datos de los meses de un año
function getDataMeses(fecha) {
  let anioSelected = fecha;

  fetch("config/estadisticasMes.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      anio: anioSelected,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      graficoMes(data);
      graficoYears(data.infoYear);
      addOptionsYear(data.infoYear);
    })
    .catch((error) => console.log("Error: ", error));
}
//crea el grfico con los datos de los meses de un año seleccionado
function graficoMes(info) {
  const data = info.info;
  const enero = document.getElementById("data_enero");
  const febrero = document.getElementById("data_febrero");
  const marzo = document.getElementById("data_marzo");
  const abril = document.getElementById("data_abril");
  const mayo = document.getElementById("data_mayo");
  const junio = document.getElementById("data_junio");
  const julio = document.getElementById("data_julio");
  const agosto = document.getElementById("data_agosto");
  const septiembre = document.getElementById("data_septiembre");
  const octubre = document.getElementById("data_octubre");
  const noviembre = document.getElementById("data_noviembre");
  const diciembre = document.getElementById("data_diciembre");

  let max_cantidad_pedidos =
    Math.max(...data.map((pedido) => parseInt(pedido.CantidadPedidos))) + 1;

  clearDate();
  if (data.length == 0) {
    return;
  }
  /* for (let i = 0; i < data.length; i++) {
    const pedido = data[i];
    contador_cantidad_pedidos =
      contador_cantidad_pedidos + parseInt(pedido.CantidadPedidos);
  } */

  for (let i = 0; i < data.length; i++) {
    // Acceder a cada objeto
    const pedido = data[i];

    // Obtener el valor de mes y cantidad_pedidos
    const mes = pedido.Meses;
    const cantidadStyle =
      parseInt(pedido.CantidadPedidos) / max_cantidad_pedidos;
    const cantidad = pedido.CantidadPedidos;
    switch (mes) {
      case "Enero":
        enero.textContent = cantidad;
        enero.style.setProperty("--size", cantidadStyle);
        break;
      case "Febrero":
        febrero.textContent = cantidad;
        febrero.style.setProperty("--size", cantidadStyle);
        break;
      case "Marzo":
        marzo.textContent = cantidad;
        marzo.style.setProperty("--size", cantidadStyle);
        break;
      case "Abril":
        abril.textContent = cantidad;
        abril.style.setProperty("--size", cantidadStyle);
        break;
      case "Mayo":
        mayo.textContent = cantidad;
        mayo.style.setProperty("--size", cantidadStyle);
        break;
      case "Junio":
        junio.textContent = cantidad;
        junio.style.setProperty("--size", cantidadStyle);
        break;
      case "Junio":
        junio.textContent = cantidad;
        junio.style.setProperty("--size", cantidadStyle);
        break;
      case "Julio":
        julio.textContent = cantidad;
        julio.style.setProperty("--size", cantidadStyle);
        break;
      case "Agosto":
        agosto.textContent = cantidad;
        agosto.style.setProperty("--size", cantidadStyle);
        break;
      case "Septiembre":
        septiembre.textContent = cantidad;
        septiembre.style.setProperty("--size", cantidadStyle);
        break;
      case "Octubre":
        octubre.textContent = cantidad;
        octubre.style.setProperty("--size", cantidadStyle);
        break;
      case "Noviembre":
        noviembre.textContent = cantidad;
        noviembre.style.setProperty("--size", cantidadStyle);
        break;
      case "Diciembre":
        diciembre.textContent = cantidad;
        diciembre.style.setProperty("--size", cantidadStyle);
        break;
      default:
        break;
    }
  }
}

function clearDate() {
  const enero = document.getElementById("data_enero");
  const febrero = document.getElementById("data_febrero");
  const marzo = document.getElementById("data_marzo");
  const abril = document.getElementById("data_abril");
  const mayo = document.getElementById("data_mayo");
  const junio = document.getElementById("data_junio");
  const julio = document.getElementById("data_julio");
  const agosto = document.getElementById("data_agosto");
  const septiembre = document.getElementById("data_septiembre");
  const octubre = document.getElementById("data_octubre");
  const noviembre = document.getElementById("data_noviembre");
  const diciembre = document.getElementById("data_diciembre");

  // Reemplaza los valores
  enero.textContent = "";
  febrero.textContent = "";
  marzo.textContent = "";
  abril.textContent = "";
  mayo.textContent = "";
  junio.textContent = "";
  julio.textContent = "";
  agosto.textContent = "";
  septiembre.textContent = "";
  octubre.textContent = "";
  noviembre.textContent = "";
  diciembre.textContent = "";

  // cambiar el color y el valor del grafico
  enero.style.setProperty("--size", "0");
  febrero.style.setProperty("--size", "0");
  marzo.style.setProperty("--size", "0");
  abril.style.setProperty("--size", "0");
  mayo.style.setProperty("--size", "0");
  junio.style.setProperty("--size", "0");
  julio.style.setProperty("--size", "0");
  agosto.style.setProperty("--size", "0");
  septiembre.style.setProperty("--size", "0");
  octubre.style.setProperty("--size", "0");
  noviembre.style.setProperty("--size", "0");
  diciembre.style.setProperty("--size", "0");
}
// Añade las opciones al select de años
function addOptionsYear(listYears) {
  const yearSelect = document.getElementById("yearSelect");
  while (yearSelect.firstChild) {
    yearSelect.removeChild(yearSelect.lastChild);
  }
  const optionSelect = document.createElement("option");
  optionSelect.textContent = "Elegir el año:";
  optionSelect.setAttribute("disabled", "disabled");
  optionSelect.setAttribute("selected", "selected");
  yearSelect.appendChild(optionSelect);
  listYears.forEach((yearselect) => {
    const option = document.createElement("option");
    option.value = yearselect.years;
    option.textContent = yearselect.years;
    yearSelect.appendChild(option);
  });
}
function graficoYears(info) {
  const data = info;
  const tbody = document.getElementById("body_grafico_anio");

  let numerMax =
    Math.max(...data.map((yearObj) => yearObj.cantidadPedidos)) + 1;

  clearTableYear();
  data.forEach((yearObj) => {
    // Crea una nueva fila (tr)
    const fila = document.createElement("tr");

    // Crea una celda de encabezado (th) para el año 2024
    const th2024 = document.createElement("th");
    th2024.setAttribute("scope", "row");
    th2024.textContent = yearObj.years; // Aquí usamos el primer elemento del array (2024)

    // Crea una celda de datos (td) para el número 20
    const td20 = document.createElement("td");
    td20.style.setProperty("--size", yearObj.cantidadPedidos / numerMax);
    td20.textContent = yearObj.cantidadPedidos; // Aquí usamos el segundo elemento del array (20)

    // Agrega las celdas a la fila
    fila.appendChild(th2024);
    fila.appendChild(td20);

    // Agrega la fila al tbody
    tbody.appendChild(fila);
  });
}
function clearTableYear() {
  const tbody = document.getElementById("body_grafico_anio");
  while (tbody.firstChild) {
    tbody.removeChild(tbody.firstChild);
  }
}
