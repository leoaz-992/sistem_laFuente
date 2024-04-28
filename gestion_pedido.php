<?php
require 'conn.php';
session_start();

function buscarCliente($conn, $correo, $telefono) {

    $sql = "SELECT id_cliente FROM `clientes` WHERE `telefono` = ? AND `coreo` = ? ;";

    $stmt = mysqli_prepare($conn, $sql);
    
    mysqli_stmt_bind_param($stmt, "ss", $correo, $telefono);

    mysqli_stmt_execute($stmt);

    $resultBusqueda = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultBusqueda)==1) {
        $cliente = mysqli_fetch_array($resultBusqueda);
        $id_cliente = $cliente["id_cliente"];
        return $id_cliente;
    } else {
        return false;
    }
} 

function insertDireccion($connection, $calle, $numero, $nombre_barrio) {
    $sql = "INSERT INTO `direcciones` ( `calle`, `numeracion`,
                                        `calle_1`, `calle_2`, `barrio_id`) 
                                VALUES ( '$calle', '$numero',
                                NULL, NULL, '$nombre_barrio')";
    $resultDireccion = mysqli_query($connection, $sql);
    if ($resultDireccion === TRUE) {
        $id_direccion= mysqli_insert_id($connection);
        return $id_direccion;
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
        $id_cliente= mysqli_insert_id($connection);
        return $id_cliente;
    } else {
        throw new Exception("Error en la inserción Cliente: " . $connection->error);
    }
}
function insertPedido($connection,$clienteId,$tipo_pago){
    
    $sql = "INSERT INTO `pedidos` (`id_pedido`, `fecha_pedido`, `fecha_entrega`,
    `estado_pedido_id`, `metPago_id`, `statusPago_id`,
    `cliente_id`, `total`) 
            VALUES (NULL, current_timestamp(), NULL,
                    '2', '$tipo_pago', '1', 
                    '$clienteId', '0')";

    $resultPedido = mysqli_query($connection, $sql);
    if ($resultPedido === TRUE) {
        $id_pedido =mysqli_insert_id($connection);
        return $id_pedido;
    } else {
        throw new Exception("Error en la inserción Pedido: " . $connection->error);
    }
}

function insertDetalle($connection,$pedidoId,$id_producto,$cantidad){
    //busca el precio del producto por id_producto.
    $sqlPriceProduct="SELECT p.precio_producto AS precio FROM `productos` AS p WHERE p.id_productos = $id_producto";
    $resultPrecio = mysqli_query($connection, $sqlPriceProduct);
    if (mysqli_num_rows($resultPrecio) > 0) {
        while($row = mysqli_fetch_assoc($resultPrecio)) {
            $precio=$row["precio"];
        }
    } else {
        //si no encuentra envia un error
        throw new Exception("Error en la inserción Pedido. no se encontro el producto.: " . $connection->error);
    }

    //insert el pedido en la base de datos
    $sql = "INSERT INTO `detallespedidos` (`id_detalle_prod`, `pedido_id`, `producto_id`, `cantidad`, `precio`, `subTotal`) VALUES (NULL, '$pedidoId', '$id_producto', '$cantidad', '$precio', ($precio*$cantidad))";

        $resultDetalle = mysqli_query($connection, $sql);
  
    
        if ($resultDetalle === TRUE) {
    //actualiza el total  de la tabla pedidos en base a todos los detalles pedidos relacionados a ese pedido.
            $sqlactualizado = "UPDATE pedidos
            SET total = (
              SELECT SUM(productos.precio_producto * detallesPedidos.cantidad)
              FROM detallesPedidos
              INNER JOIN productos ON detallesPedidos.producto_id = productos.id_productos
              WHERE detallesPedidos.pedido_id = pedidos.id_pedido
            );";
            $resultadoactualizado = mysqli_query($connection, $sqlactualizado);

            if ($resultadoactualizado === true){
                $id_detalle_prod= mysqli_insert_id($connection);
                 return $id_detalle_prod;
            }
           
    } else {
        throw new Exception("Error en la inserción Pedido: " . $connection->error);
    }
}

try {
    
    $clienteId = buscarCliente($connection, $_POST['correo'], $_POST['telefono']);
    
    if (!$clienteId) {
        $direccionId = insertDireccion($connection, $_POST['calle'], $_POST['numero'], $_POST['nombre_barrio']);

        $clienteId = insertCliente($connection, $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['correo'], $direccionId); 
    }
    
    $pedidoId = insertPedido($connection, $clienteId, $_POST['tipo_pago']);
    
    foreach($_POST as $field => $value) {
        if (substr( $field, 0, 9 ) === "cantidad_" && $value > 0) {
            $productoId = explode("_", $field)[1];
            $detalleId = insertDetalle($connection, $pedidoId, $productoId, $value);
    
            //echo "Inserción exitosa. Detalle ID: " . $detalleId;
        }
    }

    echo "success";
} catch (Exception $e) {
    echo $e->getMessage();
}

$connection->close();
?>