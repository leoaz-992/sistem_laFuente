<?php include('includes/header.php') ?>
    <h2 class="mb-4">Pedidos</h2>

    <!-- Formulario para Alta -->
    <form method="post" action="procesar.php" class="mb-4">
       
       <!-- <div class="form-group">
            <label for="fecha_entrega">Fecha de Entrega:</label>
            <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
        </div> -->
        <div class="form-group" class="col">>
            <label for="estado_pedido">Estado del Pedido:</label>
            <input type="date" class="form-control" id="estado_pedido" name="estado_pedido" required>
        </div>
        <div class="form-group">
            <label for="met_pago_id">Metodo de Pago:</label>
            <input type="date" class="form-control" id="met_pago_id" name="met_pago_id" required>
        </div>
       
        <div class="form-group">
            <label for="cliente_id">Cliente_id:</label>
            <input type="date" class="form-control" id="cliente_id" name="cliente_id" required>
        </div>
        <div class="form-group">
            <label for="total">Cliente_id:</label>
            <input type="number" class="form-control" id="total" name="total" required>
        </div>
        <!-- Otros campos del formulario -->

        <button type="submit" class="btn btn-primary">Agregar Pedido</button>
    </form>

    <!-- Tabla para Mostrar Pedidos -->
    <table class="table">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Fecha Pedido</th>
                <th>Fecha Entrega</th>
                <th>Estado</th>
                <th>Método de Pago</th>
                <th>Status de Pago</th>
                <th>Cliente ID</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se cargarán los registros desde la base de datos -->
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


        <!-- Otros campos del formulario -->

        <button type="submit" class="btn btn-primary">Agregar Pedido</button>
    </form>

    <!-- Tabla para Mostrar Pedidos -->
    <table class="table">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Fecha Pedido</th>
                <th>Fecha Entrega</th>
                <th>Estado</th>
                <th>Método de Pago</th>
                <th>Status de Pago</th>
                <th>Cliente ID</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se cargarán los registros desde la base de datos -->
        </tbody>
    </table>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<?php include('includes/footer.php') ?>