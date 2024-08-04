<?php
require_once "conn.php";


if (isset($_GET['id_delete'])) {
  $id = $_GET['id_delete'];
  if ($id != 1) {
    $sql = "DELETE FROM empleados WHERE `empleados`.`id_usuario` =$id";
    $query = mysqli_query($connection, $sql);
    if ($query) {
      $msj = "Usuario eliminado.";
    } else {
      $msj = "Error al eliminar este usuario";
    }
    header("Location: ../miPerfil.php?msj=$msj");
    exit();
  } else {
    $msj = "No se puede eliminar este usuario";
    header("Location: ../miPerfil.php?msj=$msj");
    exit();
  }
}

// Comprueba si la solicitud es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtiene los datos JSON de la solicitud
  $data = json_decode(file_get_contents('php://input'), true);

  if (isset($data['id_edit'])) {

    $id = $data['id_edit'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $nombreUsuario = $data['nombreUsuario'];
    $email = $data['email'];
    $rol = $data['rol'];

    // Prepara la consulta SQL para actualizar los datos
    $sql = "UPDATE `empleados` SET `nombre` = ?, `apellido` = ?, `nombre_usuario` = ?, `correo` = ?, `id_rol` = ? WHERE `empleados`.`id_usuario` = ?";
    $stmt = mysqli_prepare($connection, $sql);

    // Asigna los valores a los marcadores de posición
    mysqli_stmt_bind_param($stmt, "ssssii", $nombre, $apellido, $nombreUsuario, $email, $rol, $id);

    // Ejecuta la consulta
    mysqli_stmt_execute($stmt);

    if ($stmt->execute()) {
      // La consulta se ejecutó correctamente
      echo json_encode(array('status' => 'success', 'message' => 'empleado editado'));
    } else {
      // Hubo un error en la consulta
      echo json_encode(array('status' => 'error', 'message' => 'empleado no editado'));
    }

    // Cierra el statement
    mysqli_stmt_close($stmt);
  }
}
