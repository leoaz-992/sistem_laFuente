<?php
include("includes/header.php");
require "conn.php";

if (!isset($_SESSION['id_rol'])) {
  header('Location: index.php');
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>
<h2> Hola <?= $_SESSION["nombreCompleto"] ?></h2>
<!-- //? menu lateral -->
<div class="row">
  <div class="col-2 pt-2 bg-dark text-light">
    <button id="info" class="btn btn-link text-light btn-sm p-1 m-1" type="button">ver informes</button>
    <button id="esta" class="btn btn-link text-light btn-sm p-1 m-1" type="button">ver estadisticas</button>
    <button id="pass" class="btn btn-link text-light btn-sm p-1 m-1" type="button">Cambiar contraseña</button>
  </div>
  <!-- // todo: donde se muestra la info -->
  <div class="col-10 ps-3 pt-3 border border-bottom-0">
    <div id="estadisticas">
      <h3 class="text-center">estadisticas</h3>
      <div class="row">
        <div class="col-9">
          <span class="badge rounded-pill bg-secondary">semana</span>
          <span class="badge rounded-pill bg-secondary">mes</span>
          <span class="badge rounded-pill bg-primary">año</span>
          <div id="garficoBidonesVendidosPorAño">
            <table class="charts-css column show-labels">
              <caption> Column Example #6 </caption>
              <thead>
                <tr>
                  <th scope="col"> Year </th>
                  <th scope="col"> Progress </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"> 2016 </th>
                  <td style="--size: 0.2;"></td>
                </tr>
                <tr>
                  <th scope="row"> 2017 </th>
                  <td style="--size: 0.4;"></td>
                </tr>
                <tr>
                  <th scope="row"> 2018 </th>
                  <td style="--size: 0.6;"></td>
                </tr>
                <tr>
                  <th scope="row"> 2019 </th>
                  <td style="--size: 0.8;"></td>
                </tr>
                <tr>
                  <th scope="row"> 2020 </th>
                  <td style="--size: 1;"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-2">
          <div class="row text-white bg-info p-3 ">
            vendidos
          </div>
          <div class="row text-white bg-success p-3 my-2">
            cantidad bidones
          </div>
          <div class="row text-white bg-dark p-3">
            pedidos
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include("includes/footer.php");
?>

<script>
  let div1 = document.getElementById('informes');
  let div2 = document.getElementById('estadisticas');
  let div3 = document.getElementById('cambiarContra');

  div1.style.display = 'none';
  div2.style.display = 'none';
  div3.style.display = 'none';

  let boton1 = document.getElementById('info');
  let boton2 = document.getElementById('esta');
  let boton3 = document.getElementById('pass');

  // Luego, agrega un evento 'click' a cada botón
  boton1.addEventListener('click', function() {
    div1.style.display = 'block'; // Muestra div1
    div2.style.display = 'none'; // Oculta div2
    div3.style.display = 'none'; // Oculta div3
  });

  boton2.addEventListener('click', function() {
    div1.style.display = 'none'; // Oculta div1
    div2.style.display = 'block'; // Muestra div2
    div3.style.display = 'none'; // Oculta div3
  });

  boton3.addEventListener('click', function() {
    div1.style.display = 'none'; // Oculta div1
    div2.style.display = 'none'; // Oculta div2
    div3.style.display = 'block'; // Muestra div3
  });
</script>