<?php
require_once('config/registro.php');
session_start();

$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
$apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : null;
$nombre_usuario = isset($_POST["nombre_usuario"]) ? $_POST["nombre_usuario"] : null;
$email = isset($_POST["email"]) ? $_POST["email"] : null;
$password = isset($_POST["contrasena"]) ? $_POST['contrasena'] : null;
$rol = isset($_POST["rol"]) ? $_POST["rol"] : null;

insertarEmpleado($nombre, $apellido, $nombre_usuario, $email, $password, $rol);

mysqli_close($connection);
