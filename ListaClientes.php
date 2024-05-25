<?php
include("includes/header.php");
include "conn.php";
?>

<div class="container mt-4">
<h2 class="text-center" style="text-decoration: underline;">Lista de Clientes</h2>

    <?php
    // Obtener la lista de Clientes
    $sql = "SELECT * FROM clientes ORDER BY nombre ASC, apellido ASC";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Apellido</th>";
        echo "<th>Teléfono</th>";
        echo "<th>Correo</th>";
        echo "<th class='text-center'>Acciones</th>"; // Columna para los botones
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>$" . $row['apellido'] . "</td>";
            echo "<td>" . $row['telefono'] . "</td>";
            echo "<td>" . $row['correo'] . "</td>";

            // Botones en la última columna
            echo "<td>";
            echo "<a href='modificarcliente.php?id_delete=" . $row['id_cliente'] . "' class='btn btn-danger btn-sm'>Eliminar</a>";
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
        <a href='pedidoForm.php' class='btn btn-primary mt-3'>Agregar cliente</a>
    </div>
</div>

<?php
include("includes/footer.php");
?>