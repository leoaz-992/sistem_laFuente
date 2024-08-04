<?php
include_once("conn.php");

function getRoles()
{
  global $connection;
  $sql = "SELECT id_rol, nombre_rol FROM `roles_empleados`";
  $resultRoles = mysqli_query($connection, $sql);
  $roles = array();

  while ($row = mysqli_fetch_assoc($resultRoles)) {
    $roles[] = $row;
  }
  return $roles;

  mysqli_close($connection);
  exit();
}
