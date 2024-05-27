<?php
//redirecciona al archivo con nombre pasado como parametro.
function redirigirA($direction)
{
  header("location:$direction.php");
  exit;
}
