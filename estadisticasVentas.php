<?php
include_once("includes/header.php");
include_once("config/consultas.php");
require_once "config/conn.php";

if (!isset($_SESSION['rol'])) {
  redirigirA('index');
}

#$nombre_usuario = $_SESSION['nombre_usuario'];
?>
<h2> Hola <?= $_SESSION["nombreCompleto"] ?></h2>
<!-- //? menu lateral -->
<div class="row">
  <!-- // todo: gráfico donde se muestra la info -->
  <div class="col-12 ps-3 pt-3 border border-bottom-0">
    <div id="estadisticas">
      <h3 class="text-center">estadisticas de ventas</h3>
      <div class="row">
        <div class="col-9">
          <!-- botones -->
          <div class="row">
            <div class="col-8">
              <button id="semana" class="border border-0 badge rounded-pill bg-primary">semana</button>
              <button id="mes" class="border border-0 badge rounded-pill bg-secondary">mes</button>
              <button id="anio" class="border border-0 badge rounded-pill bg-secondary">año</button>
            </div>
            <div class="col-4">
              <!-- input para buscar por fecha -->
              <input class="form-control form-control-sm border border-secondary" type="date" name="fecha_semana" id="fecha_semana">
              <!-- input para seleccionar un año de la lista -->
              <select title="Lista de años" class="form-select form-select-sm border border-secondary" id="yearSelect">
                <option selected disabled>Selecciona un año:</option>
              </select>
            </div>
          </div>
          <!-- gafico por semana -->
          <div id="garficoBidonesVendidosPorSemana">
            <table class="charts-css column show-labels datasets-spacing-2 show-10-secondary-axes">
              <caption> grafico por dia </caption>
              <thead>
                <tr>
                  <th scope="col"> Dias </th>
                  <th scope="col"> Progress </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Lunes</th>
                  <td id="data_Lunes" style="--size: 0;"></td>
                </tr>
                <tr>
                  <th scope="row">Martes</th>
                  <td id="data_Martes" style="--size: 0;"></td>
                </tr>
                <tr>
                  <th scope="row">Miércoles</th>
                  <td id="data_Miércoles" style="--size: 0;"></td>
                </tr>
                <tr>
                  <th scope="row">Jueves</th>
                  <td id="data_Jueves" style="--size: 0;"></td>
                </tr>
                <tr>
                  <th scope="row">Viernes</th>
                  <td id="data_Viernes" style="--size: 0;"></td>
                </tr>
                <tr>
                  <th scope="row">Sabado</th>
                  <td id="data_Sabado" style="--size: 0;"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div id="garficoBidonesVendidosPorMes">
            <table class="charts-css bar show-labels datasets-spacing-2 show-primary-axis show-data-axes">
              <caption>grafico por meses</caption>
              <thead>
                <tr>
                  <th scope="col"> Meses </th>
                  <th scope="col"> cantidad de ventas </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row fs-6">Ene</th>
                  <td id="data_enero" style="--size: 0"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">Feb</th>
                  <td id="data_febrero" style="--size: 0"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">Mar</th>
                  <td id="data_marzo" style="--size: 0"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">Abr</th>
                  <td id="data_abril" style="--size: 0"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">May</th>
                  <td id="data_mayo" style="--size: 0;"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">Jun</th>
                  <td id="data_junio" style="--size: 0"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">Jul</th>
                  <td id="data_julio" style="--size: 0"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">Ago</th>
                  <td id="data_agosto" style="--size: 0"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">Sept</th>
                  <td id="data_septiembre" style="--size: 0"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">oct</th>
                  <td id="data_octubre" style="--size: 0;"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">Nov</th>
                  <td id="data_noviembre" style="--size: 0;"></td>
                </tr>
                <tr>
                  <th scope="row fs-6">dic</th>
                  <td id="data_diciembre" style="--size: 0"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="horizontal-scrollable" id="garficoBidonesVendidosPorAnio">
            <table class="charts-css column show-labels datasets-spacing-10 show-10-secondary-axes">
              <caption> grafico por año </caption>
              <thead>
                <tr>
                  <th scope="col"> Year </th>
                  <th scope="col"> Progress </th>
                </tr>
              </thead>
              <tbody id="body_grafico_anio">
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-2">
          <?php
          $info = obtenerBidonesVendidos();
          ?>
          <div class="row text-white bg-info p-3 text-center">
            <h6>Dispenser Frio - Calor:</h6>
            <p><?= $info[4]['cantidad_vendidas'] ?></p>
          </div>
          <div class="row text-white bg-success p-3 my-2 text-center">
            <h6>Bidones entregados</h6>
            <p><?= $info[1]['cantidad_vendidas'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="js/estadisticasMensual.js"></script>
<script src="js/estadisticasSemana.js"></script>
<script>
  //divs grafico estadisticos
  let div1 = document.getElementById("garficoBidonesVendidosPorSemana");
  let div2 = document.getElementById("garficoBidonesVendidosPorMes");
  let div3 = document.getElementById("garficoBidonesVendidosPorAnio");
  let inputFecha = document.getElementById("fecha_semana");
  let selectYear = document.getElementById("yearSelect");


  selectYear.addEventListener("change", function() {
    let yearSelected = selectYear.value;
    getDataMeses(yearSelected);
  });

  /* div1.style.display = 'none'; */
  div2.style.display = "none";
  div3.style.display = "none";
  selectYear.style.display = "none";

  let btnSemana = document.getElementById("semana");
  let btnMes = document.getElementById("mes");
  let btnAnio = document.getElementById("anio");

  // Luego, agrega un evento 'click' a cada botón
  btnSemana.addEventListener("click", function() {
    // Verifica si btnSemana tiene la clase .bg-secondary y, si es así, quítala
    if (btnSemana.classList.contains("bg-secondary")) {
      btnSemana.classList.remove("bg-secondary");
    }
    btnSemana.classList.add("bg-primary"); // Agrega la clase .bg-primary a btnSemana
    if (btnMes.classList.contains("bg-primary")) {
      btnMes.classList.remove("bg-primary");
    }
    btnMes.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a btnMes
    if (btnAnio.classList.contains("bg-primary")) {
      btnAnio.classList.remove("bg-primary");
    }
    btnAnio.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a btnAnio

    // Oculta div2 y div3
    selectYear.style.display = "none";
    div1.style.display = "block";
    inputFecha.style.display = "block";

    div2.style.display = "none";
    div3.style.display = "none";
  });

  btnMes.addEventListener("click", function() {
    // Verifica si btnMes tiene la clase .bg-secondary y, si es así, quítala
    if (btnMes.classList.contains("bg-secondary")) {
      btnMes.classList.remove("bg-secondary");
    }
    btnMes.classList.add("bg-primary"); // Agrega la clase .bg-primary a btnMes
    if (btnSemana.classList.contains("bg-primary")) {
      btnSemana.classList.remove("bg-primary");
    }
    btnSemana.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a btnSemana
    if (btnAnio.classList.contains("bg-primary")) {
      btnAnio.classList.remove("bg-primary");
    }
    btnAnio.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a btnAnio

    div1.style.display = "none"; // Oculta div1
    inputFecha.style.display = "none";
    div2.style.display = "block"; // Muestra div2
    selectYear.style.display = "block";
    div3.style.display = "none"; // Oculta div3

    let fechaSeleccionada = new Date().getFullYear();
    getDataMeses(fechaSeleccionada);
  });

  btnAnio.addEventListener("click", function() {
    // Verifica si btnAnio tiene la clase .bg-secondary y, si es así, quítala
    getDataMeses(new Date().getFullYear());
    if (btnAnio.classList.contains("bg-secondary")) {
      btnAnio.classList.remove("bg-secondary");
    }
    btnAnio.classList.add("bg-primary"); // Agrega la clase .bg-primary a btnAnio
    if (btnMes.classList.contains("bg-primary")) {
      btnMes.classList.remove("bg-primary");
    }
    btnMes.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a btnMes
    if (btnSemana.classList.contains("bg-primary")) {
      btnSemana.classList.remove("bg-primary");
    }
    btnSemana.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a btnSemana

    div1.style.display = "none"; // Oculta div1
    inputFecha.style.display = "none";
    selectYear.style.display = "none";
    div2.style.display = "none"; // Oculta div2
    div3.style.display = "block"; // Muestra div3
  });
</script>
<?php
include("includes/footer.php");
?>