<?php
require_once "config/conn.php";

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$email  = isset($_POST['email']) ? $_POST['email'] : null;
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

function crearMjsContacto($nameContact, $telContact, $emailContact, $mensajeContact)
{
  global $connection;

  if (!isset($nameContact)) {
    echo "Nombre no válido.";
    return;
  }

  if (!is_numeric($telContact)) {
    echo "El teléfono no es un número válido.";
    return;
  }

  if (!filter_var($emailContact, FILTER_VALIDATE_EMAIL)) {
    echo "El correo electrónico no es válido.";
    return;
  }

  $mensajeLength = strlen($mensajeContact);
  if ($mensajeLength > 6 && $mensajeLength < 700) {
    $sql = "INSERT INTO `contactos` (`nombre_contacto`, `telefono_contacto`, `correo_contacto`, `mensaje`, `leido`, `fecha_mensaje`)
                VALUES ('$nameContact', '$telContact', '$emailContact', '$mensajeContact', '0', current_timestamp())";

    $result = mysqli_query($connection, $sql);

    if ($connection->affected_rows > 0) {
      echo "success";
    } else {
      echo "Error al guardar su mensaje.";
    }
  } else {
    echo "El mensaje debe tener entre 6 y 700 caracteres.";
  }
}

crearMjsContacto($nombre, $telefono, $email, $mensaje);
