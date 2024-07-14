<?php
include("includes/header.php");
require ("config/conn.php");
?>

<?php 
if(isset($_GET['id'])){ 
    $id=$_GET['id'];
    $sql="SELECT * FROM `metodos_pago` WHERE id_metodo_pago=$id; ";
    $result=mysqli_query($connection,$sql);
    if($result){
        $metodo_pago= mysqli_fetch_assoc($result);
    }
    ?>

<?php
if (isset($_GET['msj'])) {
    $msj = htmlspecialchars($_GET['msj']); // Sanitizar el mensaje para evitar problemas de seguridad
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><?php echo $msj; ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
    <h1 class="text-center ">Modificar metodo de pago</h1>
    <div class="row justify-content-center">
        <div class="col-8">
        <form action="config/guardarMetodo.php" method="post">
        <input type="hidden" name="id_metodo_pago" value="<?php echo $id; ?>">
        <div class="mb-8">
            <label for="tipo_pago" class="form-label">Nombre del tipo de pago:</label>
            <input type="text" class="form-control" id="tipo_pago" name="tipo_pago" value=<?php echo $metodo_pago['tipo_pago']; ?> required>
        </div>

        
        <button type="submit" class="btn btn-primary my-2">guardar tipo de pago</button>
    </form>  
        </div>
    </div>
<?php } else { ?>
    <h1 class="text-center ">Añadir metodo de pago</h1>
    <div class="row justify-content-center">
        <div class="col-8">
    <form action="config/guardarMetodo.php" method="post">
        <div class="mb-8">
            <label for="tipo_pago" class="form-label">Nombre del tipo de pago:</label>
            <input type="text" class="form-control" id="tipo_pago" name="tipo_pago" required>
        </div>

        
        <button type="submit" class="btn btn-primary my-2">guardar tipo de pago</button>
    </form>
    </div>
</div>
<?php }?>
<?php 
include("includes/footer.php");
?>