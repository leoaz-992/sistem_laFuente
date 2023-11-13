-- Creación de la base de datos
CREATE DATABASE db_lafuente;

-- Usar la base de datos recién creada
USE db_lafuente;
--en caso q ya exista borra las tablas para crearlas de nuevo
DROP TABLE IF EXISTS metodos_Pago;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS empleados;
DROP TABLE IF EXISTS roles_empleados;
DROP TABLE IF EXISTS pagos_stados;
DROP TABLE IF EXISTS barrios;
DROP TABLE IF EXISTS pedidos_estados;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS direcciones;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS detallesPedidos;

CREATE TABLE contactos (
id_contactos INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_contacto VARCHAR(80) NOT NULL ,
telefono_contacto VARCHAR(20) NOT NULL ,
correo_contacto VARCHAR(120) NOT NULL ,
mensaje TEXT NOT NULL ); 

CREATE TABLE metodos_Pago (
id_metodo_pago INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
tipo_pago VARCHAR(60) NOT NULL UNIQUE);

CREATE TABLE productos (
id_productos INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_producto VARCHAR(120) NOT NULL UNIQUE,
descripcion_producto TEXT,
imagen_producto VARCHAR(255)NULL,
precio_producto DECIMAL(10,4) NOT NULL,
stock_poducto INT(11) NOT NULL);

CREATE TABLE empleados (
id_usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre  VARCHAR(60) NOT NULL,
apellido VARCHAR(60) NOT NULL,
nombre_usuario VARCHAR(60) NOT NULL UNIQUE,
correo VARCHAR(120) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
id_rol INT(11) NOT NULL);

CREATE TABLE roles_empleados (
id_rol INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_rol VARCHAR(80) NOT NULL UNIQUE);

CREATE TABLE pagos_stados (
id_estado INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_estado VARCHAR(60) NOT NULL);

CREATE TABLE barrios (
id_barrio INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_barrio VARCHAR(80) NOT NULL UNIQUE,
zona INT(11) NOT NULL);

CREATE TABLE pedidos_estados (
id_estado INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_estado VARCHAR(60) NOT NULL UNIQUE);

CREATE TABLE clientes (
id_cliente INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre VARCHAR(60) NOT NULL,
apellido VARCHAR(60) NOT NULL,
telefono INT(11) NOT NULL UNIQUE,
coreo VARCHAR(80) NOT NULL UNIQUE,
dirreccion_id INT(11) NOT NULL);

CREATE TABLE direcciones (
id_direccion INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
calle VARCHAR(80) NOT NULL,
numeracion INT(6) NOT NULL,
calle_1 VARCHAR(80) NOT NULL,
calle_2 VARCHAR(80) NOT NULL,
barrio_id INT(11) NOT NULL);

CREATE TABLE pedidos (
id_pedido INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
fecha_pedido TIMESTAMP NOT NULL,
fecha_entrega TIMESTAMP NULL,
estado_pedido_id INT(11) NOT NULL,
metPago_id INT(11) NOT NULL,
statusPago_id INT(11) NOT NULL,
cliente_id INT(11) NOT NULL,
total DECIMAL(10,4) NOT NULL);

CREATE TABLE detallesPedidos (
id_detalle_prod INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
pedido_id INT(11) NOT NULL,
producto_id INT(11) NOT NULL,
cantidad INT(11) NOT NULL,
precio DECIMAL(10,4) NOT NULL,
subTotal DECIMAL(10,4) NOT NULL);

ALTER TABLE empleados ADD CONSTRAINT empleados_id_rol_roles_empleados_id_rol FOREIGN KEY (id_rol) REFERENCES roles_empleados(id_rol);
ALTER TABLE clientes ADD CONSTRAINT clientes_dirreccion_id_direcciones_id_direccion FOREIGN KEY (dirreccion_id) REFERENCES direcciones(id_direccion);
ALTER TABLE direcciones ADD CONSTRAINT direcciones_barrio_id_barrios_id_barrio FOREIGN KEY (barrio_id) REFERENCES barrios(id_barrio);
ALTER TABLE pedidos ADD CONSTRAINT pedidos_estado_pedido_id_pedidos_estados_id_estado FOREIGN KEY (estado_pedido_id) REFERENCES pedidos_estados(id_estado);
ALTER TABLE pedidos ADD CONSTRAINT pedidos_metPago_id_metodos_Pago_id_metodo_pago FOREIGN KEY (metPago_id) REFERENCES metodos_Pago(id_metodo_pago);
ALTER TABLE pedidos ADD CONSTRAINT pedidos_statusPago_id_pagos_stados_id_estado FOREIGN KEY (statusPago_id) REFERENCES pagos_stados(id_estado);
ALTER TABLE pedidos ADD CONSTRAINT pedidos_cliente_id_clientes_id_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id_cliente);
ALTER TABLE detallesPedidos ADD CONSTRAINT detallesPedidos_pedido_id_pedidos_id_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id_pedido);
ALTER TABLE detallesPedidos ADD CONSTRAINT detallesPedidos_producto_id_productos_id_productos FOREIGN KEY (producto_id) REFERENCES productos(id_productos);

-- DATOS DE PRUEBA --
-- Carga 4 productos
INSERT INTO `productos` (`nombre_producto`, `descripcion_producto`, `imagen_producto`, `precio_producto`, `stock_poducto`) VALUES ( 'bidon20l', 'bidon de agua 20 litros', NULL, '1500', '300'), ( 'soda', 'sifón soda 2,25 litro', NULL, '600', '600'), ('dispencer', 'dispenser común para bidones de agua', NULL, '500', '3000'), ('dispencerFrio-Calor', 'dispenser eléctrico con agua fría y caliente.', NULL, '8000', '400');

-- CARGA DE ROLES EMPLEADOS
INSERT INTO `roles_empleados` (`id_rol`, `nombre_rol`) VALUES (NULL, 'ADMIN'), (NULL, 'REPARTIDOR'), (NULL, 'RECEPCION'),(NULL, 'ENCARGADO');


-- CARGA ESTADOS DE PEDIDOS
INSERT INTO `pedidos_estados` (`id_estado`, `nombre_estado`) VALUES (NULL, 'ENTREGADO'), (NULL, 'PENDIENTE'), (NULL, 'EN REPARTO');

-- CARGA ESTADOS DE PAGO
INSERT INTO `pagos_stados` (`id_estado`, `nombre_estado`) VALUES (NULL, 'PENDIENTE'), (NULL, 'PAGADO'); 

-- CARGA METODOS DE PAGO
INSERT INTO `metodos_pago` (`id_metodo_pago`, `tipo_pago`) VALUES (NULL, 'EFECTIVO'), (NULL, 'MERCADO PAGO'), (NULL, 'DEPOSITO BANCARIO'), (NULL, 'TRANSFERENCIA');

-- CARGA BARRIOS
INSERT INTO `barrios` (`id_barrio`, `nombre_barrio`, `zona`) VALUES (NULL, 'SAN MARTÍN', '1'), (NULL, 'DON BOSCO', '1'), (NULL, 'INDEPENDENCIA', '1'), (NULL, 'SAN JOSE OBRERO', '2'), (NULL, 'BARRIO OBRERO', '3'), (NULL, 'LA PILAR', '3'), (NULL, 'MARIANO MORENO', '3'), (NULL, 'VIRGEN DEL ROSARIO', '3'), (NULL, 'SAN JUAN BAUTISTA', '3'), (NULL, 'PARQUE INDUSTRIAL', '4'), (NULL, 'LA ARBOLADA', '5'), (NULL, 'INCONE', '5'), (NULL, 'COLUCIO', '5'), (NULL, 'LIBORSI', '5'), (NULL, '2 DE ABRIL', '6'), (NULL, 'SAN FRANCISCO', '6');


-- CARGA EMPLEADOS 
INSERT INTO `empleados` (`id_usuario`, `nombre`, `apellido`, `nombre_usuario`, `correo`, `password`, `id_rol`) VALUES (NULL, 'leo', 'lafuente', 'usuario1', 'usuario1@lafuente.com', 'user1234', '1'), (NULL, 'jorge', 'lafuente', 'jorge_lafuente', 'jorge@lafuente.com', 'jorge1234', '2'), (NULL, 'hector', 'lafuente', 'hector_lafuente', 'hector@lafuente.com', 'hector1234', '3'), (NULL, 'walter', 'lafuente', 'walter_lafuente', 'walter@lafuente.com', 'walter1234', '4');

