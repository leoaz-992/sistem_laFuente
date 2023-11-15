<?php include("includes/header.php");
  require "conn.php";

  $sql="SELECT * FROM `contactos`";
  $resultContacto=mysqli_query($connection,$sql);
?>
<section class="mx-3">
  <h1>Mensajes</h1>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Telefono</th>
      <th scope="col">correo</th>
      <th scope="col">mensaje</th>
      <th scope="col">accion</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (mysqli_num_rows($resultContacto) > 0) {
      while ($msj = mysqli_fetch_assoc($resultContacto)) {
          echo "<tr>";
            echo"<th scope='row'></th>";
            echo "<td>" . $msj["tabla01_nombre"] . "</td>";
            echo "<td>" . $msj["tabla01_email"] . "</td>";
            echo "<td>" . $msj["tabla01_mensaje"] . "</td>";
            echo '<td class="actions"><a href="#">Editar</a> | <a href="#">Eliminar</a></td>';
          echo "</tr>";
      }
  } else {
      echo "<tr class='text-center'><th colspan='5'>No hay mensajes disponibles.</th></tr>";
  }

  mysqli_close($connection);
  ?>
  </tbody>
</table>
</section>

<?php include("includes/footer.php")?>