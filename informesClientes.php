<?php
include_once("includes/header.php");
require_once("config/conn.php");

if (!isset($_SESSION['rol'])) {
  redirigirA('index');
}

$nombre_usuario = $_SESSION['nombre_usuario'];


$sqlCliente="SELECT id_cliente, nombre, apellido FROM `clientes`";
$queryCliente= mysqli_query($connection,$sqlCliente);
?>

<h2> Informacion sobre ventas a clientes</h2>
<div class="container mt-5">
  <form  id="filtroFechas" class="row g-3 mb-4">
        <div class="row">
          <div class="col-md-4">
          <label for="select" class="form-label">Seleccione un cliente:</label>
            <select id="Id_cliente" class="form-select">
            <option selected disabled> seleccione un cliente</option>
            <?php
              while ($option = mysqli_fetch_array($queryCliente)) {
                echo "<option value=".$option["id_cliente"].">".$option["nombre"]."</option>";
              }
            ?>
        </select>
          </div>
          <div class="col-md-4 ">
                <label for="fechaInicio" class="form-label">Fecha Inicio</label>
                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
            </div>
            <div class="col-md-4">
                <label for="fechaFin" class="form-label">Fecha Fin</label>
                <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
            </div>
            <div class="col-md-2 mt-3 align-self-end">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>   
        </form>
</div>
<div class="">
<h3 class="text-center">informes</h3>
    <table class='table table-bordered table-striped'>
    <thead class='thead-dark'> <!-- Añadir una clase de Bootstrap para un encabezado oscuro -->
    <tr>
        <th scope='col'>Cliente</th> <!-- Uso de 'scope' para accesibilidad -->
        <th scope='col'>Pedido</th>
        <th scope='col'>Cliente</th>
        <th scope='col'>Apellido</th>
        <th scope='col'>Fecha Solic.</th>
        <th scope="col">Producto</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Precio</th>
        <th scope='col'>Total</th>
    </tr>
    
    </thead>
      <tbody id="informesResultado"></tbody>
    </table>
    <div class="align-self-end">
      <p class="badge bg-primary fs-5" id="imprimetotal"></p>
    </div>
</div>

<!-- Ejemplo  como debe quedar con titulo. -->

<script>
  let formcliente=document.getElementById("filtroFechas");
  formcliente.addEventListener("submit",function(event){
    event.preventDefault();
    let cliente=document.getElementById("Id_cliente");
    let fechainicio=document.getElementById("fechaInicio");
    let fechafin=document.getElementById("fechaFin");

    fetch("config/informes.php",{
      method:"POST",
      headers: {
      "Content-Type": "application/json",
    },
      body:JSON.stringify({
        cliente:cliente.value,
        fechainicio:fechainicio.value,
        fechafin:fechafin.value
      })
    }).then(res=>res.json())
    .then(data=>{
      console.log(data);
      creaartabla(data.info);
    })
    
  }

  )
  function creaartabla(data){
    let sumatotal = 0;
    let informes=document.getElementById("informesResultado");
    let imprimirtotal=document.getElementById("imprimetotal");
    informes.innerHTML="";
    data.forEach(element => {
      let tr=document.createElement("tr");
      let td1=document.createElement("td");
      let td2=document.createElement("td");
      let td3=document.createElement("td");
      let td4=document.createElement("td");
      let td5=document.createElement("td");
      let td6=document.createElement("td");
      let td7=document.createElement("td");
      let td8=document.createElement("td");
      let td9=document.createElement("td");
      td1.innerHTML=element.cliente_id;
      td2.innerHTML=element.id_pedido;
      td3.innerHTML=element.nombre;
      td4.innerHTML=element.apellido;
      td5.innerHTML=element.fecha_solicitada;
      td6.innerHTML=element.producto;
      td7.innerHTML=element.cant;
      td8.innerHTML=element.precio;
      td9.innerHTML=element.total;
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td4);
      tr.appendChild(td5);
      tr.appendChild(td6);
      tr.appendChild(td7);
      tr.appendChild(td8);
      tr.appendChild(td9);
      informes.appendChild(tr);
    });
    data.forEach(element => {
      sumatotal = sumatotal + parseInt(element.total);
    });
    imprimirtotal.innerHTML = "<strong>Total: $" + sumatotal + "</strong>"; 
  }
</script>
<?php
include("includes/footer.php");
?>