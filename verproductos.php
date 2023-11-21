<?php
include("includes/header.php");
include "conn.php";
$sql = "SELECT * FROM productos";
$result = mysqli_query($connection, $sql);
if ($result){

?>
<div class="row">
    
<?php
while ($producto = mysqli_fetch_assoc($result)){



?>
<div class="col-md-3 mx-3">
<div class="card" style="width: 18rem;">
  <img src="public/<?=$producto['imagen_producto']?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?=$producto['nombre_producto']?></h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
</div>
<?php
}

}
?>
  
</div>
<?php
mysqli_close($connection);
include("includes/footer.php");
?>
