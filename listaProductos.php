<?php
include("includes/header.php");
include "conn.php";
?>

<div class="container mt-4">
<h2 class="text-center">Lista de Productos</h2>

    <?php
    // Obtener la lista de productos
    $sql = "SELECT * FROM productos";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Precio</th>";
        echo "<th>Stock</th>";
        echo "<th>Descripcion</th>";
        echo "<th>Acciones</th>"; // Columna para los botones
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nombre_producto'] . "</td>";
            echo "<td>$" . $row['precio_producto'] . "</td>";
            echo "<td>" . $row['stock_poducto'] . "</td>";
            echo "<td>" . $row['descripcion_producto'] . "</td>";

            // Botones en la última columna
           // Botones en la última columna
            echo "<td>";
            echo "<a href='agregoproducto.php?id=" . $row['id_productos'] . "' class='btn btn-warning btn-sm me-2'>Modificar</a>";
            echo "<a href='modificar.php?id_delete=" . $row['id_productos'] . "' class='btn btn-danger btn-sm'>Eliminar</a>";



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
    <a href='agregoproducto.php' class='btn btn-primary mt-3'>Agregar más productos</a>
</div>

<?php
include("includes/footer.php");
?>
