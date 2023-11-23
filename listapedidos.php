<?php
include("includes/header.php");
require("conn.php");

if (isset($_GET['id_pedido'])) {
  $id_recibido = $_GET['id_pedido'];
  //cambia el estado del pedido a distribucion.
  $sqlUpdate = "UPDATE `pedidos` SET `estado_pedido_id` = '3' WHERE `pedidos`.`id_pedido` = $id_recibido";
  $resultUpdate = mysqli_query($connection, $sqlUpdate);
  if ($resultUpdate) {
    header("location:listapedidos.php");
  }
}
if (isset($_GET['id_pedido_quitar'])) {
  $id_recibido = $_GET['id_pedido_quitar'];
  $sqlDeleteDetalle = "DELETE FROM `detallespedidos` WHERE `pedido_id` = $id_recibido;";
  $sqlDelete = "DELETE FROM `pedidos` WHERE `id_pedido` = $id_recibido;";
  $resultDeleteDetalle = mysqli_query($connection, $sqlDeleteDetalle);
  if ($resultDeleteDetalle) {
    $resultDelete = mysqli_query($connection, $sqlDelete);
    if ($resultDelete) {
      header("location:listapedidos.php");
    }
  }
}

$sql = "SELECT p.id_pedido AS idPedido, c.nombre AS Nombre_cliente, b.nombre_barrio AS barrio, b.zona AS distrito, m.tipo_pago AS metodo_de_pago, w.nombre_estado AS estado_de_pago, q.nombre_estado AS estado_pedido, p.fecha_entrega AS dia_entrega FROM pedidos p INNER JOIN clientes c ON p.cliente_id = c.id_cliente INNER JOIN direcciones d ON c.dirreccion_id = d.id_direccion INNER JOIN barrios b ON b.id_barrio = d.barrio_id INNER JOIN metodos_Pago m ON p.metPago_id = m.id_metodo_pago INNER JOIN pagos_stados w ON p.statusPago_id = w.id_estado inner join pedidos_estados q ON p.estado_pedido_id= q.id_estado WHERE p.estado_pedido_id!=3 ORDER BY  p.statusPago_id ASC";

$resultado = mysqli_query($connection, $sql);
?>
<h1 class="text-center">Lista de pedidos

</h1>
<table class="table table-info ">
  <thead>
    <tr>

      <th scope="col">nombre_cliente</th>
      <th scope="col">barrio</th>
      <th scope="col">metodo_pago</th>
      <th scope="col">estado_pago</th>
      <th scope="col">estado pedido</th>
      <th scope="col">dia_entrega</th>
      <th>accion</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (mysqli_num_rows($resultado) > 0) {
      while ($pedido = mysqli_fetch_array($resultado)) {
        if ($pedido["estado_pedido"] == "ENTREGADO") {
          echo "<tr class='table-active'>";

          echo "<td>" . $pedido["Nombre_cliente"] . "</td>";
          echo "<td>" . $pedido["barrio"] . "</td>";
          echo "<td>" . $pedido["metodo_de_pago"] . "</td>";
          echo "<td>" . $pedido["estado_de_pago"] . "</td>";
          echo "<td>" . $pedido["estado_pedido"] . "</td>";

          if ($pedido["dia_entrega"] == null) {
            echo "<td>pendiente</td>";
          } else {
            echo "<td>" . $pedido["dia_entrega"] . "</td>";
          }
          echo "<td><a class='btn btn-danger btn-sm m-1' href='listapedidos.php?id_pedido_quitar=" . $pedido['idPedido'] . "'>quitar pedido</a></td>";
          echo "</tr>";
        } else {
          echo "<tr>";

          echo "<td>" . $pedido["Nombre_cliente"] . "</td>";
          echo "<td>" . $pedido["barrio"] . "</td>";
          echo "<td>" . $pedido["metodo_de_pago"] . "</td>";
          echo "<td>" . $pedido["estado_de_pago"] . "</td>";
          echo "<td>" . $pedido["estado_pedido"] . "</td>";

          if ($pedido["dia_entrega"] == null) {
            echo "<td>pendiente</td>";
          } else {
            echo "<td>" . $pedido["dia_entrega"] . "</td>";
          }
          echo "<td><a class='btn btn-info btn-sm m-1' href='listapedidos.php?id_pedido=" . $pedido['idPedido'] . "'>añadir a distribucion</a><a class='btn btn-danger btn-sm m-1' href='listapedidos.php?id_pedido_quitar=" . $pedido['idPedido'] . "'>quitar pedido</a></td>";
          echo "</tr>";
        }
      }
    } else {
      echo "<tr class='text-center'><th colspan='7'>No hay pedidos disponibles.</th></tr>";
    }
    ?>

  </tbody>
</table>

<?php
include("includes/footer.php");

?>