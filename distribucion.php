<?php
include("includes/header.php");
require("conn.php");

$sql ="SELECT p.id_pedido AS idPedido, c.nombre AS Nombre_cliente, c.telefono AS telefono, d.calle AS Direccion, d.numeracion AS altura, b.nombre_barrio AS barrio, b.zona AS distrito, m.tipo_pago AS metodo_de_pago, w.nombre_estado AS estado_de_pago, p.fecha_entrega AS dia_entrega FROM pedidos p INNER JOIN clientes c ON p.cliente_id = c.id_cliente INNER JOIN direcciones d ON c.dirreccion_id = d.id_direccion INNER JOIN barrios b ON b.id_barrio = d.barrio_id INNER JOIN metodos_Pago m ON p.metPago_id = m.id_metodo_pago INNER JOIN pagos_stados w ON p.statusPago_id = w.id_estado WHERE p.fecha_entrega IS NULL ORDER BY `distrito` ASC";

$resultado=mysqli_query($connection ,$sql);
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
<?php
if(mysqli_num_rows($resultado)>0){
  while($pedido=mysqli_fetch_array($resultado)){
    echo"<tr>";
      
      echo"<td>". $pedido["idPedido"] ."</td>";
      echo"<td>". $pedido["Nombre_cliente"] ."</td>";
      echo"<td>". $pedido["telefono"] ."</td>";
      echo"<td>". $pedido["Direccion"] ."</td>";
      echo"<td>". $pedido["altura"] ."</td>";
      echo"<td>". $pedido["barrio"] ."</td>";
      echo"<td>". $pedido["distrito"] ."</td>";
      echo"<td>". $pedido["metodo_de_pago"] ."</td>";
      echo"<td>". $pedido["estado_de_pago"] ."</td>";
      echo"<td>". $pedido["dia_entrega"] ."</td>";
      
      
      
      
      
      
    echo"</tr>";
  }
}
?>
   
  </tbody>
</table>
</section>

<?php
include("includes/footer.php");

?>