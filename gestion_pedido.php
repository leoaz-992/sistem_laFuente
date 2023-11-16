<?php
require 'conn.php';
session_start();

function insertDireccion($connection, $calle, $numero, $nombre_barrio) {
    $sql = "INSERT INTO `direcciones` (`id_direccion`, `calle`, `numeracion`,
                                        `calle_1`, `calle_2`, `barrio_id`) 
                                VALUES (NULL, '$calle', '$numero',
                                NULL, NULL, '$nombre_barrio')";
    $resultDireccion = mysqli_query($connection, $sql);
    if ($resultDireccion === TRUE) {
        return $connection->id_direccion;
    } else {
        throw new Exception("Error en la inserción Direccion: " . $connection->error);
    }
}
function insertCliente($connection, $nombre, $apellido, $telefono,$correo,$direccionId){
    $sql = "INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`,
    `telefono`, `coreo`, `dirreccion_id`) 
    VALUES (NULL, '$nombre', '$apellido', '$telefono', 
    '$correo', '$direccionId')";

    $resultCliente = mysqli_query($connection, $sql);
    if ($resultCliente === TRUE) {
        return $connection->id_direccion;
    } else {
        throw new Exception("Error en la inserción Cliente: " . $connection->error);
    }
}
function insertPedido($connection,$clienteId,$tipo_pago){
    $sql = "INSERT INTO `pedidos` (`id_pedido`, `fecha_pedido`, `fecha_entrega`,
    `estado_pedido_id`, `metPago_id`, `statusPago_id`,
    `cliente_id`, `total`) 
            VALUES (NULL, current_timestamp(), NULL,
                    NULL, '$tipo_pago', NULL, 
                    '$clienteId', NULL)";

    $resultPedido = mysqli_query($connection, $sql);
    if ($resultPedido === TRUE) {
        return $connection->id_pedido;
    } else {
        throw new Exception("Error en la inserción Pedido: " . $connection->error);
    }
}

function insertDetalle($connection,$pedidoId,$nombre_producto,$cantidad){
    $sql = "INSERT INTO `detallespedidos` (`id_detalle_prod`, `pedido_id`, `producto_id`, `cantidad`, `precio`, `subTotal`) VALUES (NULL, '$pedidoId', '$nombre_producto', '$cantidad', '650', '5200')";

        $resultDetalle = mysqli_query($connection, $sql);
        if ($resultDetalle === TRUE) {
            return $connection->id_pedido;
    } else {
        throw new Exception("Error en la inserción Pedido: " . $connection->error);
    }


}
// Similar functions for insertCliente, insertPedido, insertDetalle

try {
    $direccionId = insertDireccion($connection, $_POST['calle'], $_POST['numero'], $_POST['nombre_barrio']);
    $clienteId = insertCliente($connection, $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['correo'], $direccionId);
    $pedidoId = insertPedido($connection, $clienteId, $_POST['tipo_pago']);
    $detalleId = insertDetalle($connection, $pedidoId, $_POST['nombre_producto'], $_POST['cantidad']);
    //echo "Inserción exitosa. Detalle ID: " . $detalleId;
    echo "success";
} catch (Exception $e) {
    echo $e->getMessage();
}

$connection->close();
?>