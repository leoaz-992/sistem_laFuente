<?php
include("includes/header.php");
include "conn.php";

// Recibir datos del formulario
$nombre_producto = $_POST['product-name'];
$precio_producto = $_POST['product-price'];
$stock_poducto = $_POST['product-quantity']; // Corregir la variable $stock_poducto a $stock_producto
$descripcion_producto = $_POST['product-description'];

$sql = "INSERT INTO `productos` (`nombre_producto`, `precio_producto`, `stock_poducto`, `descripcion_producto`, `imagen_producto`) VALUES ('$nombre_producto', '$precio_producto', '$stock_poducto', '$descripcion_producto', 'NULL');";

// Completa el código para ejecutar la inserción
// Debes enlazar los parámetros y ejecutar la consulta
$result = mysqli_query($connection, $sql);

if ($result) {
    // Verifica si la inserción fue exitosa
    if (mysqli_affected_rows($connection) > 0) { // Corregir a mysqli_affected_rows
        echo "Registro exitoso. Gracias por registrarte.";
    } else {
        echo "Error en el registro. Por favor, intenta de nuevo.";
    }
} else {
    echo "Error en la preparación de la consulta SQL: " . mysqli_error($connection); // Agregar mensaje de error específico
}

// Cierra la conexión a la base de datos
mysqli_close($connection);
include("includes/footer.php");
?>
