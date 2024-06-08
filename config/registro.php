<?php
require_once "conn.php";
function validarCorreo($email, $nombre_usuario)
{
  global $connection;
  $sqlValidate = "SELECT * FROM `empleados` WHERE `correo` = '$email' OR `nombre_usuario` = '$nombre_usuario';";
  $resultValidate = mysqli_query($connection, $sqlValidate);
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
// Cambiar la contraseña de un usuario
/* function changePass($email, $old_password, $new_password)
{
  global $connection;
  $sqlValidate = "SELECT password FROM `empleados` WHERE `correo` = '$email';";
  $resultValidate = mysqli_query($connection, $sqlValidate);
  if (mysqli_num_rows($resultValidate) > 0) {
    $row = mysqli_fetch_assoc($resultValidate);
    $passEncript = $row['password'];
    if (password_verify($old_password, $passEncript)) {
      $passEncript = encriptarContraseña($new_password);
      $sql = "UPDATE `empleados` SET `password` = '$passEncript' WHERE `empleados`.`correo` = '$email';";
      $resultUpdate = mysqli_query($connection, $sql);
      if ($resultUpdate) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  } else {
    return false;
  }
} */

function changePass($email, $old_password, $new_password)
{
  global $connection;

  // Preparar la consulta para validar el correo
  $sqlValidate = "SELECT password FROM empleados WHERE correo = ?";
  $stmtValidate = mysqli_prepare($connection, $sqlValidate);
  mysqli_stmt_bind_param($stmtValidate, 's', $email);
  mysqli_stmt_execute($stmtValidate);
  $resultValidate = mysqli_stmt_get_result($stmtValidate);

  if (mysqli_num_rows($resultValidate) > 0) {
    $row = mysqli_fetch_assoc($resultValidate);
    $passEncript = $row['password'];

    if (password_verify($old_password, $passEncript)) {
      // Encriptar la nueva contraseña
      $newPassEncript = encriptarContraseña($new_password);

      // Preparar la consulta para actualizar la contraseña
      $sqlUpdate = "UPDATE empleados SET password = ? WHERE correo = ?";
      $stmtUpdate = mysqli_prepare($connection, $sqlUpdate);
      mysqli_stmt_bind_param($stmtUpdate, 'ss', $newPassEncript, $email);
      $resultUpdate = mysqli_stmt_execute($stmtUpdate);

      if ($resultUpdate) {
        return [true, "La contraseña ha sido actualizada exitosamente."];
      } else {
        return [false, "Hubo un error al actualizar la contraseña."];
      }
    } else {
      return [false, "La contraseña antigua no es válida."];
    }
  } else {
    return [false, "El correo no existe en el sistema."];
  }
}

// Insertar un empleado en la base de datos
function insertarEmpleado($nombre, $apellido, $nombre_usuario, $email, $password, $rol)
{
  global $connection;
  // Validar los datos de entrada
  if (empty($nombre) || empty($apellido) || empty($nombre_usuario) || empty($email) || empty($password) || empty($rol)) {
    echo "Faltan datos";
    return;
  }

  // Validar el correo electrónico y el nombre de usuario
  if (!validarCorreo($email, $nombre_usuario)) {
    echo "El correo o el usuario ya existe";
    return;
  }

  // Crear una contraseña encriptada con bcrypt
  $passEncript = encriptarContraseña($password);

  // Insertar los datos en la tabla empleados
  $sql = "INSERT INTO `empleados` (`nombre`, `apellido`, `nombre_usuario`, `correo`, `password`, `id_rol`) VALUES ('$nombre', '$apellido', '$nombre_usuario', '$email', '$passEncript', '$rol')";
  // Ejecutar la consulta y verificar si hubo éxito o error
  $resultInsert = mysqli_query($connection, $sql);
  if ($resultInsert) {
    echo "success";
    return;
  } else {
    echo "No se pudo crear el empleado.";
    return;
  }
}
