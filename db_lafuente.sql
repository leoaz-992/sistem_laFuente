-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2024 a las 23:37:05
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_lafuente`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrios`
--

CREATE TABLE `barrios` (
  `id_barrio` int(11) NOT NULL,
  `nombre_barrio` varchar(80) NOT NULL,
  `zona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `barrios`
--

INSERT INTO `barrios` (`id_barrio`, `nombre_barrio`, `zona`) VALUES
(1, 'SAN MARTÍN', 1),
(2, 'DON BOSCO', 1),
(3, 'INDEPENDENCIA', 1),
(4, 'SAN JOSE OBRERO', 2),
(5, 'BARRIO OBRERO', 3),
(6, 'LA PILAR', 3),
(7, 'MARIANO MORENO', 3),
(8, 'VIRGEN DEL ROSARIO', 3),
(9, 'SAN JUAN BAUTISTA', 3),
(10, 'PARQUE INDUSTRIAL', 4),
(11, 'LA ARBOLADA', 5),
(12, 'INCONE', 5),
(13, 'COLUCIO', 5),
(14, 'LIBORSI', 5),
(15, '2 DE ABRIL', 6),
(16, 'SAN FRANCISCO', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `dirreccion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `telefono`, `correo`, `dirreccion_id`) VALUES
(4, 'ana', 'karenina', 111112321, 'mi_correo@correo.com', 4),
(5, 'pepe', 'argento', 121231989, 'pepe@argento.com', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id_contactos` int(11) NOT NULL,
  `nombre_contacto` varchar(80) NOT NULL,
  `telefono_contacto` varchar(20) NOT NULL,
  `correo_contacto` varchar(120) NOT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallespedidos`
--

CREATE TABLE `detallespedidos` (
  `id_detalle_prod` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `subTotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `detallespedidos`
--

INSERT INTO `detallespedidos` (`id_detalle_prod`, `pedido_id`, `producto_id`, `cantidad`, `precio`, `subTotal`) VALUES
(9, 4, 1, 2, 1500.00, 3000.00),
(10, 5, 4, 1, 8000.00, 8000.00),
(11, 6, 1, 9, 1500.00, 13500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id_direccion` int(11) NOT NULL,
  `calle` varchar(80) NOT NULL,
  `numeracion` int(6) NOT NULL,
  `calle_1` varchar(80) DEFAULT NULL,
  `calle_2` varchar(80) DEFAULT NULL,
  `barrio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id_direccion`, `calle`, `numeracion`, `calle_1`, `calle_2`, `barrio_id`) VALUES
(4, 'salta', 324, NULL, NULL, 9),
(5, 'san Martin', 460, NULL, NULL, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `nombre_usuario` varchar(60) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_usuario`, `nombre`, `apellido`, `nombre_usuario`, `correo`, `password`, `id_rol`) VALUES
(1, 'Administrador', 'lafuente', 'usuario1', 'usuario1@lafuente.com', '$2y$10$EDObej4yHOmG4MdUGIV6vuq01rkTZG4x0W2s4rvYKMWMzmALVOd2a', 1),
(2, 'jorge', 'lafuente', 'jorge_lafuente', 'jorge@lafuente.com', '$2y$10$rQ0Ad8SFlu2Ke04fB88nkeAGHPy61vGXb2HXgOdwIXJ8EZyBzfNvG', 2),
(3, 'hector', 'lafuente', 'hector_lafuente', 'hector@lafuente.com', '$2y$10$JyP0LrxOW2UWRKS6PukvA.yeHpb4WyUKcxeIPckIGU2E/b1smvWXO', 3),
(4, 'walter', 'lafuente', 'walter_lafuente', 'walter@lafuente.com', '$2y$10$GrN1XBh/H1//bA4KqqyPveS9xJg/e80fs7b5UPAVWhsZGcS.cSAR2', 4),
(11, 'cosme', 'fulanito', 'cosme_fulanito', 'cosme@gm.com', '$2y$10$nLRoIb0QUu7kOJ/7MWWI0ewwXOZI39JqJPm0n2et1C7db9HhYwuVG', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id_metodo_pago` int(11) NOT NULL,
  `tipo_pago` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`id_metodo_pago`, `tipo_pago`) VALUES
(3, 'DEPOSITO BANCARIO'),
(1, 'EFECTIVO'),
(2, 'MERCADO PAGO'),
(4, 'TRANSFERENCIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_stados`
--

CREATE TABLE `pagos_stados` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pagos_stados`
--

INSERT INTO `pagos_stados` (`id_estado`, `nombre_estado`) VALUES
(1, 'PENDIENTE'),
(2, 'PAGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_entrega` timestamp NULL DEFAULT NULL,
  `estado_pedido_id` int(11) NOT NULL,
  `metPago_id` int(11) NOT NULL,
  `statusPago_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `fecha_pedido`, `fecha_entrega`, `estado_pedido_id`, `metPago_id`, `statusPago_id`, `cliente_id`, `total`) VALUES
(4, '2023-11-22 00:22:38', '2023-11-22 00:22:38', 1, 1, 2, 4, 3000.00),
(5, '2023-11-22 00:22:40', '2023-11-22 00:22:40', 1, 3, 2, 5, 8000.00),
(6, '2023-11-23 19:26:03', '2023-11-23 19:26:03', 1, 1, 2, 4, 13500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_estados`
--

CREATE TABLE `pedidos_estados` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pedidos_estados`
--

INSERT INTO `pedidos_estados` (`id_estado`, `nombre_estado`) VALUES
(3, 'EN REPARTO'),
(1, 'ENTREGADO'),
(2, 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL,
  `nombre_producto` varchar(120) NOT NULL,
  `descripcion_producto` text DEFAULT NULL,
  `imagen_producto` varchar(255) DEFAULT NULL,
  `precio_producto` decimal(10,2) NOT NULL,
  `stock_poducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `nombre_producto`, `descripcion_producto`, `imagen_producto`, `precio_producto`, `stock_poducto`) VALUES
(1, 'bidon20l', 'bidon de agua 20 litros', 'bidon-agua-20L.png', 1500.00, 300),
(2, 'soda', 'sifón soda 2,25 litro', 'sifon_soda_descartable.png', 600.00, 600),
(3, 'dispencer', 'dispenser común para bidones de agua', 'dispenser-comun.jpg', 500.00, 3000),
(4, 'dispencerFrio-Calor', 'dispenser eléctrico con agua fría y caliente.', 'dispensador-de-agua-fria-y-caliente.png', 8000.00, 400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_empleados`
--

CREATE TABLE `roles_empleados` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles_empleados`
--

INSERT INTO `roles_empleados` (`id_rol`, `nombre_rol`) VALUES
(1, 'ADMIN'),
(4, 'ENCARGADO'),
(3, 'RECEPCION'),
(2, 'REPARTIDOR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barrios`
--
ALTER TABLE `barrios`
  ADD PRIMARY KEY (`id_barrio`),
  ADD UNIQUE KEY `nombre_barrio` (`nombre_barrio`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD UNIQUE KEY `coreo` (`correo`),
  ADD KEY `clientes_dirreccion_id_direcciones_id_direccion` (`dirreccion_id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_contactos`);

--
-- Indices de la tabla `detallespedidos`
--
ALTER TABLE `detallespedidos`
  ADD PRIMARY KEY (`id_detalle_prod`),
  ADD KEY `detallesPedidos_pedido_id_pedidos_id_pedido` (`pedido_id`),
  ADD KEY `detallesPedidos_producto_id_productos_id_productos` (`producto_id`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direccion`),
  ADD KEY `direcciones_barrio_id_barrios_id_barrio` (`barrio_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `empleados_id_rol_roles_empleados_id_rol` (`id_rol`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id_metodo_pago`),
  ADD UNIQUE KEY `tipo_pago` (`tipo_pago`);

--
-- Indices de la tabla `pagos_stados`
--
ALTER TABLE `pagos_stados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `pedidos_estado_pedido_id_pedidos_estados_id_estado` (`estado_pedido_id`),
  ADD KEY `pedidos_metPago_id_metodos_Pago_id_metodo_pago` (`metPago_id`),
  ADD KEY `pedidos_statusPago_id_pagos_stados_id_estado` (`statusPago_id`),
  ADD KEY `pedidos_cliente_id_clientes_id_cliente` (`cliente_id`);

--
-- Indices de la tabla `pedidos_estados`
--
ALTER TABLE `pedidos_estados`
  ADD PRIMARY KEY (`id_estado`),
  ADD UNIQUE KEY `nombre_estado` (`nombre_estado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`),
  ADD UNIQUE KEY `nombre_producto` (`nombre_producto`);

--
-- Indices de la tabla `roles_empleados`
--
ALTER TABLE `roles_empleados`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barrios`
--
ALTER TABLE `barrios`
  MODIFY `id_barrio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contactos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detallespedidos`
--
ALTER TABLE `detallespedidos`
  MODIFY `id_detalle_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id_metodo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pagos_stados`
--
ALTER TABLE `pagos_stados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedidos_estados`
--
ALTER TABLE `pedidos_estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles_empleados`
--
ALTER TABLE `roles_empleados`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_dirreccion_id_direcciones_id_direccion` FOREIGN KEY (`dirreccion_id`) REFERENCES `direcciones` (`id_direccion`);

--
-- Filtros para la tabla `detallespedidos`
--
ALTER TABLE `detallespedidos`
  ADD CONSTRAINT `detallesPedidos_pedido_id_pedidos_id_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detallesPedidos_producto_id_productos_id_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_productos`);

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_barrio_id_barrios_id_barrio` FOREIGN KEY (`barrio_id`) REFERENCES `barrios` (`id_barrio`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_id_rol_roles_empleados_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles_empleados` (`id_rol`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_cliente_id_clientes_id_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `pedidos_estado_pedido_id_pedidos_estados_id_estado` FOREIGN KEY (`estado_pedido_id`) REFERENCES `pedidos_estados` (`id_estado`),
  ADD CONSTRAINT `pedidos_metPago_id_metodos_Pago_id_metodo_pago` FOREIGN KEY (`metPago_id`) REFERENCES `metodos_pago` (`id_metodo_pago`),
  ADD CONSTRAINT `pedidos_statusPago_id_pagos_stados_id_estado` FOREIGN KEY (`statusPago_id`) REFERENCES `pagos_stados` (`id_estado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
