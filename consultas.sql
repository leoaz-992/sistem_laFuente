-- CONSULTA DE LA TABLA DISTRIBUCION
SELECT p.id_pedido AS idPedido, c.nombre AS Nombre_cliente, c.telefono AS telefono, d.calle AS Direccion, d.numeracion AS altura, b.nombre_barrio as barrio, b.zona as distrito, m.tipo_pago AS metodo_de_pago, w.nombre_estado AS estado_de_pago, p.fecha_entrega as dia_entrega FROM pedidos p INNER JOIN clientes c ON p.cliente_id = c.id_cliente INNER JOIN direcciones d ON c.dirreccion_id = d.id_direccion INNER JOIN barrios b ON b.id_barrio = d.barrio_id INNER JOIN metodos_Pago m ON p.metPago_id = m.id_metodo_pago INNER JOIN pagos_stados w ON p.statusPago_id = w.id_estado WHERE p.fecha_entrega IS NULL ORDER BY `distrito` asc; 

--COMO CALCULAR EL TOTAL EN LA TABLA PEDIDOS
UPDATE pedidos
SET total = (
  SELECT SUM(productos.precio_producto * detallesPedidos.cantidad)
  FROM detallesPedidos
  INNER JOIN productos ON detallesPedidos.producto_id = productos.id_productos
  WHERE detallesPedidos.pedido_id = pedidos.id_pedido
);

--actualizar precio en detalle pedidos
UPDATE detallesPedidos dp
INNER JOIN productos p ON dp.producto_id = p.id_productos
SET dp.precio = p.precio_producto;



--trae el número de pedidos entregados cadda dia en el rango de una semana
SELECT 
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
WHERE `fecha_entrega` BETWEEN '2024-05-23' AND '2024-05-29'
GROUP BY `dia_semana`;


--trae el total de pedidos por mes
SELECT
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
WHERE fecha_entrega BETWEEN '2024-01-01' AND '2024-12-31'
GROUP BY MONTH(fecha_entrega)
ORDER BY Meses;

-- relaciona las tablas de cliente pedidos y detalle de pedidos
SELECT 
        clientes.id_cliente, 
        clientes.nombre, 
        clientes.apellido,
        pedidos.id_pedido,
        pedidos.fecha_pedido AS fecha_pedido,
        detallespedidos.id_detalle_prod,
        detallespedidos.producto_id,
        detallespedidos.cantidad,
        detallespedidos.precio,
        (detallespedidos.cantidad * detallespedidos.precio) AS total
    FROM 
        clientes
    INNER JOIN 
        pedidos ON clientes.id_cliente = pedidos.cliente_id
    INNER JOIN 
        detallespedidos ON pedidos.id_pedido = detallespedidos.pedido_id
    ORDER BY 
        clientes.id_cliente, pedidos.id_pedido, detallespedidos.id_detalle_prod;