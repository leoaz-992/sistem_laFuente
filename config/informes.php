<?php
include_once("conn.php");
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $cliente = $data["cliente"];
    $fechainicio = $data["fechainicio"];
    $fechafin = $data["fechafin"];

    $sql= "SELECT 
        clientes.id_cliente as cliente_id, 
        clientes.nombre as nombre, 
        clientes.apellido as apellido,
        pedidos.id_pedido as id_pedido,
        pedidos.fecha_pedido AS fecha_pedido,
        productos.nombre_producto as producto,
        detallespedidos.cantidad as cant,
        detallespedidos.precio as precio,
        (detallespedidos.cantidad * detallespedidos.precio) AS total
    FROM 
        clientes
    INNER JOIN 
        pedidos ON clientes.id_cliente = pedidos.cliente_id 
    INNER JOIN 
        detallespedidos ON pedidos.id_pedido = detallespedidos.pedido_id
    INNER JOIN 
        productos ON productos.id_productos= detallespedidos.producto_id 
         WHERE clientes.id_cliente =$cliente AND fecha_pedido BETWEEN '$fechainicio' AND '$fechafin'
    ORDER BY 
        clientes.id_cliente, pedidos.id_pedido, detallespedidos.id_detalle_prod;";


    /* $sql = "SELECT p.id_pedido as id_pedido, p.fecha_pedido as fechasolicitada, c.nombre, total  FROM pedidos p INNER JOIN clientes c ON p.cliente_id = c.id_cliente WHERE cliente_id = $cliente AND fecha_pedido BETWEEN '$fechainicio' AND '$fechafin'"; */

    $query = mysqli_query($connection, $sql);
    $pedidos = array();
    while ($row = mysqli_fetch_array($query)) {
        $pedidos[] =[
         "cliente_id" => $row["cliente_id"], 
         "id_pedido" => $row["id_pedido"],
         "apellido" => $row["apellido"], 
         "fecha_solicitada" => $row["fecha_pedido"], 
         "nombre" => $row["nombre"],
         "producto" => $row["producto"],
         "cant" => $row["cant"],
         "precio" => $row["precio"],
         "total" => $row["total"]];
    }
    echo json_encode(array('status' => 'success', 'message' => 'Pedidos encontrados', 'info' => $pedidos));
}else{
    echo json_encode(array('status' => 'error', 'message' => 'Solicitud no válida'));
}
?>