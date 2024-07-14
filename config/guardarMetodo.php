<?php
require_once "conn.php";
require_once "redireccion.php";

if(isset($_GET['id_delete'])){
    $id= $_GET['id_delete'];
   $sql= "DELETE FROM metodos_pago WHERE `metodos_pago`.`id_metodo_pago` = $id";
   $respond=mysqli_query($connection,$sql);
   if($respond){
    header("location:../metodopago.php.");
    return;
   }
else
header("location:../formulariometodo_pago.php&msj= ocurrio un error al borrr el metodo de pago.");
}




if(isset($_POST['id_metodo_pago'])){

    $id_metodo_pago = $_POST['id_metodo_pago'];
$tipopago= $_POST["tipo_pago"];
    if(empty($id_metodo_pago)){

        header("location:../formulariometodo_pago.php&msj=El campo no puede estar vacio.");
    }
    if(empty($tipopago)){

        header("location:../formulariometodo_pago.php&msj=El campo no puede estar vacio.");
    }
   $sql="UPDATE `metodos_pago` SET `tipo_pago` = '$tipopago' WHERE `metodos_pago`.`id_metodo_pago` = $id_metodo_pago;";
   
   $respond= mysqli_query($connection,$sql);
   if ($respond){
    header("location:../metodopago.php");
    return;
   }
   else{
    header("location:../formulariometodo_pago.php&msj=No se guardo el metodo de pago intentolo nuevamnete.");
    return;
   }
}
// Recibe los datos del formulario
$tipo_pago= $_POST["tipo_pago"];
if(empty($tipo_pago)){
    echo('El campo no puede estar vacio.');
    
}
// Preparar la consulta SQL
$sql = "INSERT INTO metodos_pago (tipo_pago) VALUES (?)";

// Preparar la declaración de la consulta
$stmt = $connection->prepare($sql);

// Enlazar los datos a la declaración de la consulta
$stmt->bind_param("s", $tipo_pago);

// Ejecutar la declaración de la consulta

$result=$stmt->execute();
if($result){
echo('datos guardados.');
header("location:../metodopago.php");



    
    
}else{
    echo("Error en el registro. Por favor, intenta de nuevo.");
    

}


// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();

echo "Datos guardados exitosamente";
?>

?>