<?php
include_once("includes/header.php");
require_once "config/conn.php";

if (!isset($_SESSION['id_rol'])) {
  header('Location: index.php');
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>
<h2> Hola <?= $_SESSION["nombreCompleto"] ?></h2>
<!-- //? menu lateral -->
<div class="row">
  <!-- // todo: donde se muestra la info -->
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
            <table class="charts-css column show-labels datasets-spacing-2 show-10-secondary-axes">
              <caption>grafico por meses</caption>
              <thead>
                <tr>
                  <th scope="col"> Meses </th>
                  <th scope="col"> Progress </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row fs-6">Ene</th>
                  <td style="--size: 0.2;">20</td>
                </tr>
                <tr>
                  <th scope="row fs-6">Feb</th>
                  <td style="--size: 0.4;">40</td>
                </tr>
                <tr>
                  <th scope="row fs-6">Mar</th>
                  <td style="--size: 0.6;">60</td>
                </tr>
                <tr>
                  <th scope="row fs-6">Abr</th>
                  <td style="--size: 0.8;">80</td>
                </tr>
                <tr>
                  <th scope="row fs-6">May</th>
                  <td style="--size: 1;">100</td>
                </tr>
                <tr>
                  <th scope="row fs-6">Jun</th>
                  <td style="--size: 0.5;">50</td>
                </tr>
                <tr>
                  <th scope="row fs-6">Jul</th>
                  <td style="--size: 0.3;">30</td>
                </tr>
                <tr>
                  <th scope="row fs-6">Ago</th>
                  <td style="--size: 0.2;">20</td>
                </tr>
                <tr>
                  <th scope="row fs-6">Sept</th>
                  <td style="--size: 0.5;">50</td>
                </tr>
                <tr>
                  <th scope="row fs-6">oct</th>
                  <td style="--size: 0.75;">75</td>
                </tr>
                <tr>
                  <th scope="row fs-6">Nov</th>
                  <td style="--size: 0.45;">45</td>
                </tr>
                <tr>
                  <th scope="row fs-6">dic</th>
                  <td style="--size: 0.6;">60</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div id="garficoBidonesVendidosPorAnio">
            <table class="charts-css column show-labels datasets-spacing-10 show-10-secondary-axes">
              <caption> grafico por año </caption>
              <thead>
                <tr>
                  <th scope="col"> Year </th>
                  <th scope="col"> Progress </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"> 2024 </th>
                  <td style="--size: 0.2;">20</td>
                </tr>
                <tr>
                  <th scope="row"> 2025 </th>
                  <td style="--size: 0.4;">40</td>
                </tr>
                <tr>
                  <th scope="row"> 2026 </th>
                  <td style="--size: 0.6;">60</td>
                </tr>
                <tr>
                  <th scope="row"> 2027 </th>
                  <td style="--size: 0.8;">80</td>
                </tr>
                <tr>
                  <th scope="row"> 2028 </th>
                  <td style="--size: 1;">100</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-2">
          <div class="row text-white bg-info p-3 ">
            Dispenser prendados
          </div>
          <div class="row text-white bg-success p-3 my-2">
            Bidones entregados
          </div>
          <div class="row text-white bg-dark p-3">
            pedidos recibidos
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  //divs grafico estadisticos
  let div1 = document.getElementById("garficoBidonesVendidosPorSemana");
  let div2 = document.getElementById("garficoBidonesVendidosPorMes");
  let div3 = document.getElementById("garficoBidonesVendidosPorAnio");

  /* div1.style.display = 'none'; */
  div2.style.display = "none";
  div3.style.display = "none";

  let boton1 = document.getElementById("semana");
  let boton2 = document.getElementById("mes");
  let boton3 = document.getElementById("anio");

  // Luego, agrega un evento 'click' a cada botón
  boton1.addEventListener("click", function() {
    // Verifica si boton1 tiene la clase .bg-secondary y, si es así, quítala
    if (boton1.classList.contains("bg-secondary")) {
      boton1.classList.remove("bg-secondary");
    }
    boton1.classList.add("bg-primary"); // Agrega la clase .bg-primary a boton1
    if (boton2.classList.contains("bg-primary")) {
      boton2.classList.remove("bg-primary");
    }
    boton2.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a boton2
    if (boton3.classList.contains("bg-primary")) {
      boton3.classList.remove("bg-primary");
    }
    boton3.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a boton3

    // Oculta div2 y div3
    div1.style.display = "block";

    div2.style.display = "none";
    div3.style.display = "none";
  });

  boton2.addEventListener("click", function() {
    // Verifica si boton2 tiene la clase .bg-secondary y, si es así, quítala
    if (boton2.classList.contains("bg-secondary")) {
      boton2.classList.remove("bg-secondary");
    }
    boton2.classList.add("bg-primary"); // Agrega la clase .bg-primary a boton2
    if (boton1.classList.contains("bg-primary")) {
      boton1.classList.remove("bg-primary");
    }
    boton1.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a boton1
    if (boton3.classList.contains("bg-primary")) {
      boton3.classList.remove("bg-primary");
    }
    boton3.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a boton3

    div1.style.display = "none"; // Oculta div1
    div2.style.display = "block"; // Muestra div2
    div3.style.display = "none"; // Oculta div3
  });

  boton3.addEventListener("click", function() {
    // Verifica si boton3 tiene la clase .bg-secondary y, si es así, quítala
    if (boton3.classList.contains("bg-secondary")) {
      boton3.classList.remove("bg-secondary");
    }
    boton3.classList.add("bg-primary"); // Agrega la clase .bg-primary a boton3
    if (boton2.classList.contains("bg-primary")) {
      boton2.classList.remove("bg-primary");
    }
    boton2.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a boton2
    if (boton1.classList.contains("bg-primary")) {
      boton1.classList.remove("bg-primary");
    }
    boton1.classList.add("bg-secondary"); // Agrega la clase .bg-secondary a boton1

    div1.style.display = "none"; // Oculta div1
    div2.style.display = "none"; // Oculta div2
    div3.style.display = "block"; // Muestra div3
  });
</script>
<script src="js/estadisticasSemana.js"></script>
<?php
include("includes/footer.php");
?>