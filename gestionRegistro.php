<?php
require 'conn.php';
session_start();

$nombre= $_POST["nombre"];
$apellido= $_POST["apellido"];
$nombre_usuario= $_POST["nombre_usuario"];
$email= $_POST["email"];
$contrasena= $_POST["contrasena"];
$rol= $_POST["rol"];

if(!empty($_POST['email']) && !empty($_POST['contrasena'])){
  
  $sql="INSERT INTO `empleados` (`nombre`, `apellido`, `nombre_usuario`, `correo`, `password`, `id_rol`) VALUES ('$nombre', '$apellido', '$nombre_usuario', '$email', '$contrasena', '$rol')";
  $result= mysqli_query($connection,$sql);
  if($connection->affected_rows>0){
    echo "success";
  }else{
    echo "No se pudo crear el empleado.";
  }
}
mysqli_close($connection);
?>