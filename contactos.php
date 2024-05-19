<?php include("includes/header.php");
require "conn.php";
require("config/consultas.php");
/* si no esta logeado o no tiene un rol admin o recepcion te envia al index */
if (!isset($_SESSION['id_rol']) || ($_SESSION['id_rol'] != 1 && $_SESSION['id_rol'] != 3)) {
  header('Location: index.php');
}
/* si recibe por get un id cambia el estado de mensaje con ese id */
if (isset($_GET['id_msj'])) {
  $id_mensaje = $_GET['id_msj'];
  $select_sql = "SELECT `leido` FROM `contactos` WHERE `contactos`.`id_contactos` = $id_mensaje";
  $resultSelect = mysqli_query($connection, $select_sql);
  $row = mysqli_fetch_assoc($resultSelect);
  $leido = $row['leido'];

  // Cambia el valor de 'leido' al opuesto
  $nuevo_leido = $leido == '1' ? '0' : '1';

  $update_sql = "UPDATE `contactos` SET `leido` = '$nuevo_leido' WHERE `contactos`.`id_contactos` = $id_mensaje";
  $resultContactoUpdate = mysqli_query($connection, $update_sql);

  if ($resultContactoUpdate) {
    header("location:contactos.php");
  }
}
if (isset($_GET['id_msj_delete'])) {

  $id = $_GET['id_msj_delete'];
  $sql = "DELETE FROM contactos WHERE `contactos`.`id_contactos` = $id";

  $deleteResult = mysqli_query($connection, $sql);
  if ($deleteResult) {
    header("location:contactos.php");
  }
}

$sql = "SELECT * FROM `contactos`";
$resultContacto = mysqli_query($connection, $sql);
?>
<section class="mx-3">
  <h1>Mensajes</h1>
  <table class="table table-dark">
    <thead>
      <tr class="">
        <th scope="col-2">Nombre</th>
        <th scope="col-2">Telefono</th>
        <th scope="col-2">correo</th>
        <th scope="col-4">mensaje</th>
        <th scope="col-2">accion</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (mysqli_num_rows($resultContacto) > 0) {
        while ($msj = mysqli_fetch_assoc($resultContacto)) {
          if ($msj["leido"] == 1) {
            echo "<tr class='table-info'>";
          } else {
            echo "<tr>";
          }
          echo "<td>" . $msj["nombre_contacto"] . "</td>";
          echo "<td>" . $msj["telefono_contacto"] . "</td>";
          echo "<td>" . $msj["correo_contacto"] . "</td>";
          echo "<td>" . $msj["mensaje"] . "</td>";
          if ($msj["leido"] == 1) {
            echo '<td class="actions"><a class="btn btn-outline-warning btn-sm" href="contactos.php?id_msj=' . $msj["id_contactos"] . '">Marcar como no leído</a> <a class="btn btn-outline-danger btn-sm delete_msj" href="contactos.php?id_msj_delete=' . $msj["id_contactos"] . '">Eliminar</a></td>';
          } else {
            echo '<td class="actions"><a class="btn btn-outline-info btn-sm" href="contactos.php?id_msj=' . $msj["id_contactos"] . '">Marcar como leído</a> <a class="btn btn-outline-danger btn-sm delete_msj" href="contactos.php?id_msj_delete=' . $msj["id_contactos"] . '">Eliminar</a></td>';
          }
          echo "</tr>";
        }
      } else {
        echo "<tr class='text-center'><th colspan='5'>No hay mensajes disponibles.</th></tr>";
      }
      obtenerConsultasSinLeer();
      mysqli_close($connection);
      ?>
    </tbody>
  </table>
</section>

<?php include("includes/footer.php") ?>