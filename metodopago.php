<?php
include("includes/header.php");
include "config/conn.php";
?>

<div class="container mt-4">
<h2 class="text-center" style="text-decoration: underline;">Metodos de Pagos</h2>

    <?php
    // Obtener la lista de productos
    $sql = "SELECT * FROM metodos_pago;";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo "<div class='row justify-content-center'>";
        echo "<div class='col-8'>";
            
           
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Tipos de  pagos</th>";
        /* echo "<th>Precio</th>";
        echo "<th>Stock</th>";
        echo "<th class='text-center'>Descripcion</th>"; */
        echo "<th class=''>Acciones</th>"; // Columna para los botones
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['tipo_pago'] . "</td>";
          
            // Botones en la última columna
            echo "<td>";
            echo "<a href='formulariometodo_pago.php?id=" . $row['id_metodo_pago'] . "' class='btn btn-warning btn-sm me-2'>Modificar</a>";
            echo "<a href='config/guardarMetodo.php?id_delete=" . $row['id_metodo_pago'] . "' class='btn btn-danger btn-sm'>Eliminar</a>";
        }

        echo "</tbody>";
        echo "</table>";
        echo"</div>";
        echo"</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error en la consulta SQL: " . mysqli_error($connection) . "</div>";
    }

    // Cierra la conexión a la base de datos
    mysqli_close($connection);
    ?>

    <!-- Botón para agregar más productos -->
    <div class="d-flex justify-content-center">
        <a href='formulariometodo_pago.php' class='btn btn-primary mt-3'>Agregar mas metodo de pagos</a>
    </div>
</div>

<?php
include("includes/footer.php");
?>