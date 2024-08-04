<?php
require_once("conn.php");

$nombre_barrio= $_POST["barrio_name"];
$zona= $_POST["barrio-zona"];
$sql="insert into barrios (nombre_barrio,zona) values('$nombre_barrio','$zona')";

$result= mysqli_query($connection,$sql);

if($result){
    header("Location: ../listadoBarrios.php");
}else{
    header("Location: ../formularioBarrio.php");
}

?>