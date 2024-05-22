<?php
session_start();
require 'conn.php';
require("config/consultas.php");

if (!empty($_POST['email']) && !empty($_POST['contrasena'])) {
  $email = $_POST['email'];
  $contrasena = $_POST['contrasena'];

  $sql = "SELECT nombre, apellido, password, nombre_usuario, id_rol FROM `empleados` WHERE `correo` = '$email' OR `nombre_usuario` = '$email'";
  $result = mysqli_query($connection, $sql);
  $user = mysqli_fetch_array($result);
  if (mysqli_num_rows($result) == 1  && password_verify($contrasena, $user['password'])) {
    $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
    $_SESSION['nombreCompleto'] = $user['nombre'] . " " . $user['apellido'];
    $_SESSION['id_rol'] = $user['id_rol'];
    obtenerConsultasSinLeer();
    echo "success";
  } else {
    echo "Inicio de sesión fallido. Verifica tus credenciales.";
  }
}

/* function obtenerConsultasSinLeer()
{
  global $connection;
  $sql = "SELECT COUNT(`leido`) AS consultasSinLeer FROM `contactos` WHERE `leido`=0;";
  $result = mysqli_query($connection, $sql);
  $data = mysqli_fetch_array($result);
  $_SESSION['consultasSinLeer'] = $data['consultasSinLeer'];
} */
mysqli_close($connection);
