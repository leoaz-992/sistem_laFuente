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
    <h1 class="text-center ">Modificar Barrio</h1>
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="metodopago.php" method="post">
                <input type="hidden" name="id" value="<?=$id?>">
                <div class="mb-8">
                    <label for="barrio-name" class="form-label">Nombre del Barrio:</label>
                    <input type="text" class="form-control" id="barrio-name" name="barrio_name" value="<?=$barrio['nombre_barrio']?>" required>
                 </div>
            
                <div class="mb-8">
                    <label for="barrio-zona" class="form-label">Zona del Barrio:</label>
                    <input type="number" class="form-control" id="barrio_zona" name="barrio_zona" value="<?=$barrio['zona']?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Modificar Barrio</button>
            </form>
        </div>
    </div>
<?php } else { ?>
    <h1 class="text-center ">Añadir metodo de pago</h1>
    <div class="row justify-content-center">
        <div class="col-8">
    <form action="config/guardarBarrio.php" method="post">
        <div class="mb-8">
            <label for="id_metodo_pago" class="form-label">Nombre del tipo de pago:</label>
            <input type="text" class="form-control" id="id_metodo_pago" name="id_metodo_pago" required>
        </div>

        
        <button type="submit" class="btn btn-primary my-2">guardar tipo de pago</button>
    </form>
    </div>
</div>
<?php }?>
<?php 
include("includes/footer.php");
?>