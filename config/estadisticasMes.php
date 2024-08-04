<?php
require_once "conn.php";
require_once "redireccion.php";
// Comprueba si la solicitud es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtiene los datos JSON de la solicitud
  $data = json_decode(file_get_contents('php://input'), true);

  $anio = $data['anio'];

  $sql = "SELECT
    CASE
        WHEN MONTH(fecha_entrega) = 1 THEN 'Enero'
        WHEN MONTH(fecha_entrega) = 2 THEN 'Febrero'
        WHEN MONTH(fecha_entrega) = 3 THEN 'Marzo'
        WHEN MONTH(fecha_entrega) = 4 THEN 'Abril'
        WHEN MONTH(fecha_entrega) = 5 THEN 'Mayo'
        WHEN MONTH(fecha_entrega) = 6 THEN 'Junio'
        WHEN MONTH(fecha_entrega) = 7 THEN 'Julio'
        WHEN MONTH(fecha_entrega) = 8 THEN 'Agosto'
        WHEN MONTH(fecha_entrega) = 9 THEN 'Septiembre'
        WHEN MONTH(fecha_entrega) = 10 THEN 'Octubre'
        WHEN MONTH(fecha_entrega) = 11 THEN 'Noviembre'
        WHEN MONTH(fecha_entrega) = 12 THEN 'Diciembre'
    END AS Meses,
    COUNT(*) AS CantidadPedidos
    FROM pedidos
    WHERE fecha_entrega BETWEEN '$anio-01-01' AND '$anio-12-31'
    GROUP BY MONTH(fecha_entrega)
    ORDER BY Meses;";

  $response_consult = mysqli_query($connection, $sql);

  $sqlYear = "SELECT YEAR(fecha_entrega) AS years, COUNT(id_pedido) AS cantidadPedidos FROM pedidos WHERE fecha_entrega IS NOT NULL GROUP BY YEAR(fecha_entrega) ORDER BY years ASC;";
  $responseYear = mysqli_query($connection, $sqlYear);


  $data = array();
  while ($fileData =  mysqli_fetch_assoc($response_consult)) {
    $data[] = $fileData;
  }

  $dataYear = array();
  while ($fileDataYear =  mysqli_fetch_assoc($responseYear)) {
    $dataYear[] = $fileDataYear;
  }

  // Envía una respuesta al cliente
  echo json_encode(array(
    'status' => 'success', 'message' => 'Fechas recibidas correctamente', 'info' => $data, 'infoYear' => $dataYear
  ));
} else {
  echo json_encode(array('status' => 'error', 'message' => 'Solicitud no válida'));
}
