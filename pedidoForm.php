<?php
include("includes/header.php");
require("conn.php");

/* esto verifica q solo los empleador con rol admin puedan añadir nuevos empleados. */
if (!isset($_SESSION['id_rol']) && ($_SESSION['id_rol'] != 1 || $_SESSION['id_rol'] != 3)) {
    header('Location: index.php');
}

$sql = "SELECT id_barrio, nombre_barrio FROM `barrios`";
$resultBarrios = mysqli_query($connection, $sql);

$sql = "SELECT id_metodo_pago, tipo_pago FROM `metodos_pago` ORDER BY id_metodo_pago ASC";
$resultMetodos = mysqli_query($connection, $sql);

$sql = "SELECT id_productos, nombre_producto FROM `productos`";
$resultProductos = mysqli_query($connection, $sql);

?>

<div class="container mt-5">
    <h2 class="text-center">Alta de Pedido</h2>
    <form id="altaPedido">
        <div class="row">
            <!-- Columna 1: Nombre y Apellido -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                </div>
            </div>

            <!-- Columna 2: Teléfono -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" required>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Columna 3: Correo y Dirección -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
            </div>

            <!-- Columna 1: Barrio -->
            <!-- <div class="row py-2"> -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre_barrio">Barrios:</label>
                    <select class="form-select" name="nombre_barrio" id="nombre_barrio" aria-label="Default select example">
                        <option selected disabled>seleccione un barrio</option>
                        <?php
                        while ($barrio = mysqli_fetch_array($resultBarrios)) {
                            echo '<option value="' . $barrio['id_barrio'] . '">' . $barrio["nombre_barrio"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Columna 2: Producto -->
        <div class="row">
            <!-- Columna 3: Método de Pago -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tipo_pago">Método de Pago:</label>
                    <select class="form-select" id="tipo_pago" name="tipo_pago">
                        <option selected disabled>seleccione un producto</option>
                        <?php
                        while ($metpago = mysqli_fetch_array($resultMetodos)) {
                            echo '<option value="' . $metpago['id_metodo_pago'] . '">' . $metpago["tipo_pago"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <h2 class="text-center mt-5">Productos</h2>

        <div class="row">
            <?php
            while ($producto = mysqli_fetch_array($resultProductos)) {
                echo '<div class="col-md-4">';
                echo '<div class="form-group">';
                echo '<label for="cantidad_' . $producto['id_productos'] . '">' . $producto["nombre_producto"] . '</label>';
                echo '<input type="number" min="0" class="form-control" id="cantidad_' . $producto['id_productos'] . '" name="cantidad_' . $producto['id_productos'] . '" value="' . ($producto['id_productos'] == 7 ? 1 : 0) . '" required>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <!-- Botón de Enviar -->
        <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
    <div id="mensaje"></div>
</div>

<?php
include("includes/footer.php");
?>