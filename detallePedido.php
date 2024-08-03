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
      <form class="" id="Formulariodetalledistribuidor">
        <div class="mb-3 col-auto">
          <label for="nameContacto" class="form-label lb-Footer text-primary">Observaciones al entregar el pedido</label>
          <input type="text" class="form-control form-control-sm " id="observaciones" required />
          </div>
          <input type="hidden" name="idPedido" id="idPedido" value="<?php echo $_GET["id_pedido"];?>">
          <input type="hidden" name="idEmpleado" id="idEmpleado" value="<?php echo $_SESSION["idEmpleado"];?>">
        <button type="submit" class="btn btn-primary">Enviar comentario</button>
      </form>
      <div class="" id="mensajeObservacion"></div>

      <script>
        let formularioobservaciones= document.getElementById("Formulariodetalledistribuidor");
        formularioobservaciones.addEventListener("submit",function(event){
          event.preventDefault();
          let campoobservaciones= document.getElementById("observaciones").value;
          let idPedido= document.getElementById("idPedido").value;
          let idEmpleado= document.getElementById("idEmpleado").value;
          fetch('config/gestionObservaciones.php', {
               method: 'POST',
               headers: {
                   'Content-Type': 'application/json',
               },
               body: JSON.stringify({
                   idEmpleado: idEmpleado,
                   idPedido: idPedido,
                   observaciones: campoobservaciones
               }),
           }).then(response=> response.json())
           .then(data=>{
            console.log(data);
           })
        })
      </script>
<?php
include("includes/footer.php");

?>