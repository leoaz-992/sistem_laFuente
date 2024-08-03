<?php
require("conn.php");
 if ($_SERVER["REQUEST_METHOD"] ==="POST"){
    $data = json_decode(file_get_contents("php://input"), true);

   $idempleado= $data["idEmpleado"];
   $idpedido = $data["idPedido"];
   $observacion= $data["observaciones"];

    $sqlobservaciones="INSERT INTO `observaciones_distribucion` (`id_empleado`, `id_pedido`, `observacion`, `visible`, `create_at`, `update_at`) VALUES ('$idempleado', '$idpedido', '$observacion', '1', current_timestamp(), current_timestamp())";

    $query= mysqli_query($connection,$sqlobservaciones);
    if($query){
        echo json_encode(array('status' => 'success', 'message' => 'Observacion  recibidas correctamente'));

    }
 }



?>