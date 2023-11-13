<?php
   // Todo: vatiable con conexion a la base de datos
   $usuario = 'root';
   $contrasena = '';
   $servidor = 'localhost';
   $database = 'db_lafuente';
 
   session_start();
 
   // Mostrar el valor obtenido
 
   $connection = mysqli_connect($servidor, $usuario, $contrasena, $database);
   // ! verifica que exista conexión con la base de datos
   if (!$connection) {
     die('Conexion fallida: ' . mysqli_connect_error());
   }
?>