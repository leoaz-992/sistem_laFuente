<?php
include("includes/header.php");
require "conn.php"
?>

<?php if(isset($_GET['id'])){ 
    $id=$_GET['id'];
    $sql="SELECT * FROM `productos` WHERE productos.id_productos=$id; ";
    $result=mysqli_query($connection,$sql);
    if($result){
        $producto= mysqli_fetch_assoc($result);
    }
    ?>
    <h1 class="text-center ">Modificar Producto</h1>
<?php } else { ?>
    <h1 class="text-center ">Añadir Producto</h1>
<?php }?>

<!-- Formulario para Agregar/Modificar Producto -->
<?php if(isset($_GET['id'])){
    
?>
    
    <form action="modificar.php" method="post">
        <input type="hidden" name="id" value="<?=$id?>">

        <div class="mb-8">
            <label for="product-name" class="form-label">Nombre del Producto:</label>
            <input type="text" class="form-control" id="product-name" name="product-name" value="<?=$producto['nombre_producto']?>" required>
        </div>

        <div class="mb-8">
            <label for="product-price" class="form-label">Precio del Producto:</label>
            <input type="number" class="form-control" id="product-price" name="product-price" step="0.01" value="<?=$producto['precio_producto']?>" required>
        </div>

        <div class="mb-8">
            <label for="product-quantity" class="form-label">Stock:</label>
            <input type="number" class="form-control" id="product-quantity" name="product-quantity"
            value="<?=$producto['stock_poducto']?>"required>
        </div>
        <div class="mb-8">
            <label for="product-description" class="form-label">Descripción:</label>
            <textarea class="form-control" id="product-description" name="product-description" rows="4" cols="50"><?=$producto['descripcion_producto']?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Modificar Producto</button>
    </form>
<?php } else { ?>   
    <form action="enviar.php" enctype="multipart/form-data" method="post">
        <div class="mb-8">
            <label for="product-name" class="form-label">Nombre del Producto:</label>
            <input type="text" class="form-control" id="product-name" name="product-name" required>
        </div>
        
        <div class="mb-8">
            <label for="product-price" class="form-label">Precio del Producto:</label>
            <input type="number" class="form-control" id="product-price" name="product-price" step="0.01" required>
        </div>
        
        <div class="mb-8">
            <label for="product-quantity" class="form-label">Stock:</label>
            <input type="number" class="form-control" id="product-quantity" name="product-quantity" required>
        </div>

        <div class="mb-8">
            <label for="formFile" class="form-label">Archivos permitidos JPG - JPEG - PNG:</label>
            <input class="form-control" type="file" id="imagen_producto" name="imagen_producto" accept=".jpg, .jpeg, .png">
        </div>
        
        <div class="mb-8">
            <label for="product-description" class="form-label">Descripción:</label>
            <textarea class="form-control" id="product-description" name="product-description" rows="4" cols="50"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Agregar Producto</button>
    </form>
<?php } ?>

<?php 
include("includes/footer.php");
?>
