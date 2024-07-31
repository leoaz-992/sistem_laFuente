<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Pedidos Entregados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Listado de Pedidos Entregados</h1>
        <form id="filtroFechas" class="row g-3 mb-4" method="GET" action="listado_pedidos.php">
            <div class="col-md-5">
                <label for="fechaInicio" class="form-label">Fecha Inicio</label>
                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
            </div>
            <div class="col-md-5">
                <label for="fechaFin" class="form-label">Fecha Fin</label>
                <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
            </div>
            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Fecha Pedido</th>
                    <th>Fecha Entrega</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="listaPedidos">
                <!-- Los pedidos serán insertados aquí -->
                <?php
                if (isset($_GET['fechaInicio']) && isset($_GET['fechaFin'])) {
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "tu_base_de_datos";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    $fechaInicio = $_GET['fechaInicio'];
                    $fechaFin = $_GET['fechaFin'];

                    $sql = "SELECT id_pedido, fecha_pedido, fecha_entrega, total 
                            FROM pedidos 
                            WHERE fecha_entrega BETWEEN '$fechaInicio' AND '$fechaFin'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id_pedido']}</td>
                                    <td>{$row['fecha_pedido']}</td>
                                    <td>{$row['fecha_entrega']}</td>
                                    <td>{$row['total']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No se encontraron pedidos en el rango de fechas seleccionado.</td></tr>";
                    }

                    $conn->close();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>