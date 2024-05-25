<?php
include("includes/header.php");
include ("config/conn.php");

if(isset($_POST['id'])){ 
    $id=$_POST['id'];
    $msj = 'el barrio ya existe.'; // Ejemplo de mensaje

    // Asegúrate de que los parámetros estén correctamente codificados para la URL
    $msj_encoded = urlencode($msj);
    $nombre_barrio=$_POST['barrio_name'];
    $barrio_zona=$_POST['barrio_zona'];
    $barrio_buscado="SELECT * FROM `barrios` WHERE `nombre_barrio` LIKE '$nombre_barrio'";
    
    $result_busqueda=mysqli_query($connection,$barrio_buscado);
    if(mysqli_num_rows($result_busqueda) > 0){
        header("location:formularioBarrio.php?id=$id&msj=$msj_encoded");
    }
    $sql= "UPDATE `barrios` SET `nombre_barrio` = '$nombre_barrio', `zona` = '$barrio_zona' WHERE `barrios`.`id_barrio` = '$id';";
    $result=mysqli_query($connection,$sql);
    if($result){
        header("location:ListadoBarrios.php");
    }
}

?>

<div class="row justify-content-center">
<h2 class="text-center" style="text-decoration: underline;">Lista de Barrios</h2>
<div class="col-6">
    <?php
    // Obtener la lista de productos
    $sql = "SELECT * FROM barrios ORDER BY id_barrio ASC";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo "<div class='table-responsive'>";
        echo "<table clNass='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='text-center'>Nombre</th>"; // Centrando el encabezado de la columna 'Nombre'
        echo "<th class='text-center'>Acciones</th>"; // Columna para los botones centrada
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nombre_barrio'] . "</td>";
            echo "<td>" . $row['zona'] . "</td>";

            // Botones en la última columna
            echo "<td>";
            echo "<a href='formularioBarrio.php?id=" . $row['id_barrio'] . "' class='btn btn-warning btn-sm me-2'>Modificar</a>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error en la consulta SQL: " . mysqli_error($connection) . "</div>";
    }

    // Cierra la conexión a la base de datos
    mysqli_close($connection);
    ?>

    <!-- Botón para agregar más productos -->
    <div class="d-flex justify-content-center">
        <a href='formularioBarrio.php' class='btn btn-primary mt-3'>Agregar Barrio</a>
    </div>
    </div>
</div>

<?php
include("includes/footer.php");
?>