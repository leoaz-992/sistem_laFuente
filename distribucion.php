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
      <th scope="col">nombre_cliente</th>
      <th scope="col">telefono</th>
      <th scope="col">direccion</th>
      <th scope="col">numero</th>
      <th scope="col">barrio</th>
      <th scope="col">distrito</th>
      <th scope="col">metodo_pago</th>
      <th scope="col">estado_pago</th>
      <th scope="col">dia_entrega</th>
    </tr>
  </thead>
  <tbody>

    <tr class="table-active">
      <th scope="row">Active</th>
      <td>hola</td>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
    </tr>
  </tbody>
</table>
</section>

<?php
include("includes/footer.php");

?>