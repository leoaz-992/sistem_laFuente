<?php
include("includes/header.php");
require ("config/conn.php");
?>

<?php 
if(isset($_GET['id'])){ 
    $id=$_GET['id'];
    $sql="SELECT * FROM `barrios` WHERE barrios.id_barrio=$id; ";
    $result=mysqli_query($connection,$sql);
    if($result){
        $barrio= mysqli_fetch_assoc($result);
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
            <form action="listadoBarrios.php" method="post">
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
    <h1 class="text-center ">Añadir Barrio</h1>
    <div class="row justify-content-center">
        <div class="col-8">
    <form action="config/guardarBarrio.php" method="post">
        <div class="mb-8">
            <label for="barrio-name" class="form-label">Nombre del Barrio:</label>
            <input type="text" class="form-control" id="barrio-name" name="barrio_name" required>
        </div>

        <div class="mb-8">
            <label for="barrio-zona" class="form-label">Zona del Barrio:</label>
            <input type="number" class="form-control" id="barrio-zona" name="barrio-zona"required>
        </div>
        <button type="submit" class="btn btn-primary">guardar Barrio</button>
    </form>
    </div>
</div>
<?php }?>
<?php 
include("includes/footer.php");
?>