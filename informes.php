<?php
include("includes/header.php");
require "conn.php";

if (!isset($_SESSION['id_rol'])) {
  header('Location: index.php');
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>
<h2> Hola <?= $_SESSION["nombreCompleto"] ?></h2>
<div id="informes">
  <h3 class="text-center">informes</h3>
  <ul>
    <li><a href="3">Lorem ipsum dolor sit amet consectetur.</a></li>
    <li><a href="3">Maxime possimus saepe amet nobis dolorem!</a></li>
    <li><a href="">Nesciunt pariatur recusandae nulla vero commodi.</a></li>
    <li><a href="">Assumenda temporibus adipisci inventore nisi expedita.</a></li>
    <li><a href="">Rem laudantium ex voluptatum dolores fuga.</a></li>
    <li><a href="">Ab id nulla quaerat quo iusto!</a></li>
    <li><a href="">Eaque quae nesciunt beatae dolore harum?</a></li>
    <li><a href="">Amet dolor eaque vero quod laboriosam!</a></li>
    <li><a href="">Nihil magni dignissimos corrupti iure nisi!</a></li>
    <li><a href="">Eveniet perferendis ipsum corrupti impedit ullam.</a></li>
  </ul>
</div>
<?php
include("includes/footer.php");
?>