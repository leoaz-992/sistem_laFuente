<?php
require_once "conn.php";
// Comprueba si la solicitud es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtiene los datos JSON de la solicitud
  $data = json_decode(file_get_contents('php://input'), true);

  // Obtiene las fechas del domingo anterior y el sábado siguiente
  $domingoAnterior = $data['domingoAnterior'];
  $domingoSiguiente = $data['domingoSiguiente'];

  $sql = "SELECT 
  CASE
      WHEN DAYOFWEEK(`fecha_entrega`) = 1 THEN 'Domingo'
      WHEN DAYOFWEEK(`fecha_entrega`) = 2 THEN 'Lunes'
      WHEN DAYOFWEEK(`fecha_entrega`) = 3 THEN 'Martes'
      WHEN DAYOFWEEK(`fecha_entrega`) = 4 THEN 'Miércoles'
      WHEN DAYOFWEEK(`fecha_entrega`) = 5 THEN 'Jueves'
      WHEN DAYOFWEEK(`fecha_entrega`) = 6 THEN 'Viernes'
      WHEN DAYOFWEEK(`fecha_entrega`) = 7 THEN 'Sábado'
  END as `dia_semana`,
  COUNT(`fecha_entrega`) as `cantidad_pedidos`
FROM `pedidos`
WHERE `fecha_entrega` BETWEEN '$domingoAnterior' AND '$domingoSiguiente'
GROUP BY `dia_semana`;";

  $response_consult = mysqli_query($connection, $sql);

  $data = array();
  while ($fileData =  mysqli_fetch_assoc($response_consult)) {
    $data[] = $fileData;
  }



  // Envía una respuesta al cliente
  echo json_encode(array('status' => 'success', 'message' => 'Fechas recibidas correctamente', 'info' => $data));
} else {
  // Si no es una solicitud POST, envía un error
  echo json_encode(array('status' => 'error', 'message' => 'Solicitud no válida'));
}
