<?php
function obtenerConsultasSinLeer()
{
  global $connection;
  $sql = "SELECT COUNT(`leido`) AS consultasSinLeer FROM `contactos` WHERE `leido`=0;";
  $result = mysqli_query($connection, $sql);
  $data = mysqli_fetch_array($result);
  $_SESSION['consultasSinLeer'] = $data['consultasSinLeer'];
}
