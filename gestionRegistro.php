<?php
require 'conn.php';
session_start();

$nombre= $_POST["nombre"];
$apellido= $_POST["apellido"];
$nombre_usuario= $_POST["nombre_usuario"];
$email= $_POST["email"];
$rol= $_POST["rol"];

if(!empty($_POST['email']) && !empty($_POST['contrasena'])){
  $passEncript =  password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
  $sql="INSERT INTO `empleados` (`nombre`, `apellido`, `nombre_usuario`, `correo`, `password`, `id_rol`) VALUES ('$nombre', '$apellido', '$nombre_usuario', '$email', '$passEncript', '$rol')";
  $result= mysqli_query($connection,$sql);
  if($connection->affected_rows>0){
    echo "success";
  }else{
    echo "No se pudo crear el empleado.";
  }
}
mysqli_close($connection);
?>