<?php
include_once("includes/header.php");
require_once("config/conn.php");

if (!isset($_SESSION['rol'])) {
  redirigirA('index');
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<h2> Explotaciones <?= $_SESSION["nombreCompleto"] ?></h2>
<div id="informes">
  <h3 class="text-center">I N F O R M E S</h3>
  <ul>
    <li><a href="listado_pedidos.php">* LISTADO DE PEDIDOS CON FACTURACION ENTRE FECHAS *</a></li>
    <li><a href="3">* LISTADO DE PEDIDOS ENTRE FECHAS *</a></li>
    <li><a href="">* LISTADO DE PEDIDOS NO ENTREGADOS ENTRE FECHAS *</a></li>
  </ul>
</div>

<?php
include("includes/footer.php");
?>