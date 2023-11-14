<?php
require 'conn.php';
session_start();

if (!empty($_POST['email']) && !empty($_POST['contrasena'])) {
  $email=$_POST['email'];
  $contrasena= $_POST['contrasena'];

  $sql="SELECT nombre, apellido, nombre_usuario, id_rol FROM `empleados` WHERE `correo` = '$email' AND `password` = '$contrasena'";
  $result = mysqli_query($connection,$sql);
  if(mysqli_num_rows($result)==1){
    $user = mysqli_fetch_array($result); 
    $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
    $_SESSION['nombreCompleto'] = $user['nombre']." ".$user['apellido'] ;
    $_SESSION['id_rol'] = $user['id_rol'];

    echo"success";
  }else{
    echo "Inicio de sesión fallido. Verifica tus credenciales.";
  }

}



?>