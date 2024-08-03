<?php
session_start();
require("config/conn.php");
require("config/consultas.php");

if (!empty($_POST['email']) && !empty($_POST['contrasena'])) {
  $email = $_POST['email'];
  $contrasena = $_POST['contrasena'];

  $sql = "SELECT
  e.id_usuario as id,
    nombre,
    apellido,
    password,
    correo,
    nombre_usuario,
    r.nombre_rol as rol
FROM
    empleados e
INNER JOIN roles_empleados r ON r.id_rol= e.id_rol
WHERE
    correo = ? OR nombre_usuario = ?;";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param("ss", $email, $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    if (password_verify($contrasena, $user['password'])) {
      $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
      $_SESSION['nombreCompleto'] = $user['nombre'] . " " . $user['apellido'];
      $_SESSION['rol'] = $user['rol'];
      $_SESSION['correo'] = $user['correo'];
      $_SESSION["idEmpleado"]= $user["id"];
      obtenerConsultasSinLeer();
      echo "success";
    } else {
      echo "Inicio de sesión fallido. Verifica tus credenciales.";
    }
  } else {
    echo "Usuario no encontrado.";
  }
}
mysqli_close($connection);
