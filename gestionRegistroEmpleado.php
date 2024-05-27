<?php
require_once("config/conn.php");
require_once('config/registro.php');
session_start();

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$nombre_usuario = $_POST["nombre_usuario"];
$email = $_POST["email"];
$password = $_POST['contrasena'];
$rol = $_POST["rol"];

insertarEmpleado($connection, $nombre, $apellido, $nombre_usuario, $email, $password, $rol);

mysqli_close($connection);
