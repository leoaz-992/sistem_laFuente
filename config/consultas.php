<?php
function obtenerConsultasSinLeer()
{
  global $connection;
  $sql = "SELECT COUNT(`leido`) AS consultasSinLeer FROM `contactos` WHERE `leido`=0;";
  $result = mysqli_query($connection, $sql);
  $data = mysqli_fetch_array($result);
  $_SESSION['consultasSinLeer'] = $data['consultasSinLeer'];
}


function obtenerBidonesVendidos()
{
  global $connection;
  $sql = "SELECT p.id_productos as id, p.nombre_producto as 'producto', COUNT(d.cantidad) as 'cantidad_vendidas' FROM `detallespedidos` d INNER JOIN productos p ON p.id_productos=d.producto_id GROUP BY producto ORDER BY id ASC;";
  $result = mysqli_query($connection, $sql);
  $data = array();
  while ($row = mysqli_fetch_array($result)) {
    $data[$row['id']] = ['producto' => $row['producto'], 'cantidad_vendidas' => $row['cantidad_vendidas']];
  }
  return $data;
}
