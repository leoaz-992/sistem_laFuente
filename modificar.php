<?php
include("includes/header.php");
require_once("config/conn.php");

if (isset($_GET['id_delete'])) {
    $id = $_GET['id_delete'];
    // Obtener los registros relacionados en detallespedidos
    $sqlDetalles = "DELETE FROM detallespedidos WHERE producto_id = $id";

    $deleteDetallesResult = mysqli_query($connection, $sqlDetalles);

    if ($deleteDetallesResult) {
        // Ahora puedes eliminar el producto
        $sqlEliminarProducto = "DELETE FROM productos WHERE id_productos = $id";

        $deleteResult = mysqli_query($connection, $sqlEliminarProducto);

        if ($deleteResult) {
            header("location:listaProductos.php");
        } else {
            echo "Error al eliminar el producto: " . mysqli_error($connection);
        }
    } else {
        echo "Error al eliminar los detalles de pedidos: " . mysqli_error($connection);
    }
}

$id_producto = $_POST['id'];
$nombre = $_POST['product-name'];
$descripcion = $_POST['product-description'];
$precio = $_POST['product-price'];
$stock = $_POST['product-quantity'];

// Actualizar detalles del producto
$sql = "UPDATE `productos` SET `nombre_producto` = '$nombre', `descripcion_producto` = '$descripcion', `precio_producto` = '$precio', `stock_poducto` = '$stock' WHERE `productos`.`id_productos` = $id_producto ";

$result = mysqli_query($connection, $sql);

if ($result) {
    header("location:listaProductos.php");
} else {
    echo "Error al actualizar el producto: " . mysqli_error($connection);
}



mysqli_close($connection);
include("includes/footer.php");
