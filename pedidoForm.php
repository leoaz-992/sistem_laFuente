<?php
include("includes/header.php");
require("conn.php");

/* esto verifica q solo los empleador con rol admin puedan añadir nuevos empleados. */
if (!isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != 1 ||$_SESSION['id_rol'] != 3 ) {
  header('Location: index.php');
}

$sql = "SELECT id_barrio, nombre_barrio FROM `barrios`";
$resultBarrios = mysqli_query($connection, $sql);

$sql = "SELECT id_metodo_pago, tipo_pago FROM `metodos_pago`";
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
                    <label for="barrioslist">Barrios:</label>
                    <select class="form-select" id="barrioslist" aria-label="Default select example">
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
        <div class=row>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="producto">Producto:</label>
                    <select class="form-select" id="productoslist" aria-label="Default select example">
                        <option selected disabled>seleccione un producto</option>
                        <?php
                        while ($producto = mysqli_fetch_array($resultProductos)) {
                            echo '<option value="' . $producto['id_productos'] . '">' . $producto["nombre_producto"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Columna 3: Cantidad y Método de Pago -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" class="form-control" id="cantidadpedido" name="cantidad" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="metodoPago">Método de Pago:</label>
                    <select class="form-select" id="metodoPago" name="metodoPago">
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
</div>

<!-- Botón de Enviar -->
<button type="submit" class="btn btn-primary">Enviar</button>

</form>
<div id="mensaje"></div>
</div>

<?php
include("includes/footer.php");
?>