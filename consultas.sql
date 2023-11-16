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