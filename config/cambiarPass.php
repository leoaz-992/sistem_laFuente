<?php
require_once "conn.php";
require_once "registro.php";
// Inicia la sesión si no está ya iniciada
session_start();

// Verifica si la solicitud es un POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Recibe los datos del formulario
  $email = isset($_POST['email_user']) ? $_POST['email_user'] : '';
  $currentPassword = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
  $newPassword = isset($_POST['newContrasena']) ? $_POST['newContrasena'] : '';
  $repeatNewPassword = isset($_POST['repetirNewcontrasena']) ? $_POST['repetirNewcontrasena'] : '';

  // Validación básica (puedes agregar más validaciones según sea necesario)
  if (empty($email) || empty($currentPassword) || empty($newPassword) || empty($repeatNewPassword)) {
    echo json_encode(['success' => false, 'message' => 'Por favor completa todos los campos.']);
    exit;
  }

  if ($newPassword !== $repeatNewPassword) {
    echo json_encode(['success' => false, 'message' => 'Las nuevas contraseñas no coinciden.']);
    exit;
  }

  $validate = changePass($email, $currentPassword, $newPassword);

  // Verifica la contraseña actual del usuario
  /* $stmt = $mysqli->prepare('SELECT contrasena FROM usuarios WHERE email = ?');
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if (!$user || !password_verify($currentPassword, $user['contrasena'])) {
    echo json_encode(['success' => false, 'message' => 'La contraseña actual es incorrecta.']);
    $stmt->close();
    $mysqli->close();
    exit;
  }

  // Hasheado de la nueva contraseña
  $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);

  // Actualiza la contraseña en la base de datos
  $stmt = $mysqli->prepare('UPDATE usuarios SET contrasena = ? WHERE email = ?');
  $stmt->bind_param('ss', $newPasswordHash, $email); */

  if ($validate[0]) {
    echo json_encode(['success' => true, 'message' => $validate[1]]);
  } else {
    echo json_encode(['success' => false, 'message' => $validate[1]]);
  }
} else {
  echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
