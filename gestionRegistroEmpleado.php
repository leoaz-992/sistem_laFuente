<?php
require_once("config/conn.php");
session_start();

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$nombre_usuario = $_POST["nombre_usuario"];
$email = $_POST["email"];
$password = $_POST['contrasena'];
$rol = $_POST["rol"];

function validarCorreo($conn, $email, $nombre_usuario)
{
  $sqlValidate = "SELECT * FROM `empleados` WHERE `correo` = '$email' OR `nombre_usuario` = '$nombre_usuario';";
  $resultValidate = mysqli_query($conn, $sqlValidate);
  if (mysqli_num_rows($resultValidate) > 0) {
    //si el correo no se encuentra
    return false;
  } else {
    return true;
  }
}

// Crear una contraseña encriptada con bcrypt
function encriptarContraseña($contraseña)
{
  $passEncript = password_hash($contraseña, PASSWORD_BCRYPT);
  return $passEncript;
}

// Insertar un empleado en la base de datos
function insertarEmpleado($conn, $nombre, $apellido, $nombre_usuario, $email, $password, $rol)
{
  // Validar los datos de entrada
  if (empty($nombre) || empty($apellido) || empty($nombre_usuario) || empty($email) || empty($password) || empty($rol)) {
    echo "Faltan datos";
    return;
  }

  // Validar el correo electrónico y el nombre de usuario
  if (!validarCorreo($conn, $email, $nombre_usuario)) {
    echo "El correo o el usuario ya existe";
    return;
  }

  // Crear una contraseña encriptada con bcrypt
  $passEncript = encriptarContraseña($password);

  // Insertar los datos en la tabla empleados
  $sql = "INSERT INTO `empleados` (`nombre`, `apellido`, `nombre_usuario`, `correo`, `password`, `id_rol`) VALUES ('$nombre', '$apellido', '$nombre_usuario', '$email', '$passEncript', '$rol')";
  // Ejecutar la consulta y verificar si hubo éxito o error
  $resultInsert = mysqli_query($conn, $sql);
  if ($resultInsert) {
    echo "success";
    return;
  } else {
    echo "No se pudo crear el empleado.";
    return;
  }
}

insertarEmpleado($connection, $nombre, $apellido, $nombre_usuario, $email, $password, $rol);

mysqli_close($connection);
