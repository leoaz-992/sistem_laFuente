<?php
include("includes/header.php");
require("config/conn.php");

$id_detallePedido = $_GET['id_pedido'];
$sql = "SELECT p.nombre_producto AS producto, cantidad , subTotal FROM `detallespedidos` INNER JOIN productos p ON detallespedidos.producto_id = p.id_productos WHERE pedido_id = $id_detallePedido";
$result = mysqli_query($connection, $sql);
?>
<?php if ($result) {
    while ($product = mysqli_fetch_array($result)) {
?>
        <p>producto: <?= $product['producto'] ?></p>
        <p>cantidad: <?= $product['cantidad'] ?></p>
        <p>total a pagar: <strong><?= $product['subTotal'] ?></strong></p>

<?php
    }
} ?>
<a class="btn btn-warning" href="distribucion.php">volver a lista de distribucion</a>
<?php
include("includes/footer.php");

?>