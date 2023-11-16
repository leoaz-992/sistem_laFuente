<?php
  require "conn.php";

  $nombre =$_POST['nombre'];
  $telefono =$_POST['telefono'];
  $email  =$_POST['email'];
  $mensaje  =$_POST['mensaje'];
/* consulta sql */
  $sql="INSERT INTO `contactos` (`nombre_contacto`, `telefono_contacto`, `correo_contacto`, `mensaje`, `leido`) VALUES ('$nombre', '$telefono', '$email', '$mensaje', '0')";
  
  $result=mysqli_query($connection,$sql);

  if($connection->affected_rows>0){
    echo "success";
  }else{
    echo "error al guardar su mensaje.";
  }
 
?>