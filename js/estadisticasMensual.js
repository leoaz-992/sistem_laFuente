function getDataMeses(fecha) {
  let anioSelected = fecha.getFullYear();
  console.log(anioSelected);

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
    .then((data) => graficoMes(data.info))
    .catch((error) => console.log("Error: ", error));
}

function graficoMes(data) {
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

  let contador = 0;

  if (data.length == 0) {
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
    return;
  }
  for (let i = 0; i < data.length; i++) {
    const pedido = data[i];
    contador = contador + parseInt(pedido.cantidad_pedidos);
  }

  for (let i = 0; i < data.length; i++) {
    // Acceder a cada objeto
    const pedido = data[i];

    // Obtener el valor de mes y cantidad_pedidos
    const mes = pedido.Meses;
    const cantidadStyle = parseInt(pedido.cantidad_pedidos) / contador;
    const cantidad = pedido.cantidad_pedidos;
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
