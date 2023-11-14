<?php
include("includes/header.php");
require("conn.php");

$sql ="SELECT * FROM 'pedidos'"
?>
<section>
    <h1 class="text-center">Lista de distribucion
    
    </h1>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">id_pedido</th>
      <th scope="col">fecha_pedido</th>
      <th scope="col">fecha_entrega</th>
      <th scope="col">estado_pedido_id</th>
      <th scope="col">metPago_id</th>
      <th scope="col">statusPago_id</th>
      <th scope="col">cliente_id</th>
      <th scope="col">total</th>


    </tr>
  </thead>
  <tbody>
    <tr class="table-active">
      <th scope="row">Active</th>
      <td>hola</td>
      <td>Column content</td>
      <td>Column content</td>
    </tr>
  </tbody>
</table>
</section>

<?php
include("includes/footer.php");

?>