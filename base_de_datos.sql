#
# TABLE STRUCTURE FOR: apoyo
#

DROP TABLE IF EXISTS `apoyo`;

CREATE TABLE `apoyo` (
  `id_apoyo` int(11) NOT NULL AUTO_INCREMENT,
  `apoyo` varchar(256) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_unidad` int(11) NOT NULL,
  `costo` double(10,2) NOT NULL,
  PRIMARY KEY (`id_apoyo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `apoyo` (`id_apoyo`, `apoyo`, `descripcion`, `id_unidad`, `costo`) VALUES (3, 'Arena', '', 1, '100.00');
INSERT INTO `apoyo` (`id_apoyo`, `apoyo`, `descripcion`, `id_unidad`, `costo`) VALUES (4, 'Calentador Solar', 'Descripción', 2, '3500.00');


#
# TABLE STRUCTURE FOR: beneficiario
#

DROP TABLE IF EXISTS `beneficiario`;

CREATE TABLE `beneficiario` (
  `id_beneficiario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `apPaterno` varchar(64) NOT NULL,
  `apMaterno` varchar(64) DEFAULT NULL,
  `id_seccion` int(11) NOT NULL,
  `id_comunidad` int(11) NOT NULL,
  `direccion` varchar(256) NOT NULL,
  `numero` varchar(32) NOT NULL,
  `telefono` varchar(32) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  PRIMARY KEY (`id_beneficiario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `beneficiario` (`id_beneficiario`, `nombre`, `apPaterno`, `apMaterno`, `id_seccion`, `id_comunidad`, `direccion`, `numero`, `telefono`, `fecha_registro`, `id_usuario_registro`, `codigo`) VALUES (2, 'LUIS', 'MAGAÑA', 'SALGUERO', 1, 1, 'AVENIDA MORELOS', '144', '', '2020-09-24 15:44:19', 1, '88367');
INSERT INTO `beneficiario` (`id_beneficiario`, `nombre`, `apPaterno`, `apMaterno`, `id_seccion`, `id_comunidad`, `direccion`, `numero`, `telefono`, `fecha_registro`, `id_usuario_registro`, `codigo`) VALUES (3, 'SALVADOR ', 'CORTEZ', 'ESPINDOLA', 1, 1, 'MONUMENTO', '463', '44232232', '2020-09-25 17:33:30', 1, '64836');
INSERT INTO `beneficiario` (`id_beneficiario`, `nombre`, `apPaterno`, `apMaterno`, `id_seccion`, `id_comunidad`, `direccion`, `numero`, `telefono`, `fecha_registro`, `id_usuario_registro`, `codigo`) VALUES (4, 'DANIELA ', 'TERCERO ', 'BARCO ', 1, 1, '20 DE OCTUBRE ', '850', '4431389298', '2020-09-26 04:16:33', 3, '86668');


#
# TABLE STRUCTURE FOR: comunidad
#

DROP TABLE IF EXISTS `comunidad`;

CREATE TABLE `comunidad` (
  `id_comunidad` int(11) NOT NULL AUTO_INCREMENT,
  `comunidad` varchar(128) NOT NULL,
  PRIMARY KEY (`id_comunidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `comunidad` (`id_comunidad`, `comunidad`) VALUES (1, 'Charo');
INSERT INTO `comunidad` (`id_comunidad`, `comunidad`) VALUES (2, 'La Goleta');


#
# TABLE STRUCTURE FOR: estatus_solicitud
#

DROP TABLE IF EXISTS `estatus_solicitud`;

CREATE TABLE `estatus_solicitud` (
  `id_estatus_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(32) NOT NULL,
  `color` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_estatus_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `estatus_solicitud` (`id_estatus_solicitud`, `estatus`, `color`) VALUES (1, 'Pendiente', 'info');
INSERT INTO `estatus_solicitud` (`id_estatus_solicitud`, `estatus`, `color`) VALUES (2, 'Rechazado', 'danger');
INSERT INTO `estatus_solicitud` (`id_estatus_solicitud`, `estatus`, `color`) VALUES (3, 'Autorizado', 'primary');
INSERT INTO `estatus_solicitud` (`id_estatus_solicitud`, `estatus`, `color`) VALUES (4, 'Entregado', 'success');


#
# TABLE STRUCTURE FOR: sanitizar
#

DROP TABLE IF EXISTS `sanitizar`;

CREATE TABLE `sanitizar` (
  `id_sanitizar` int(11) NOT NULL AUTO_INCREMENT,
  `responsable` varchar(64) NOT NULL,
  `direccion` varchar(128) NOT NULL,
  `giro` varchar(32) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estatus` int(1) NOT NULL,
  `telefono` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id_sanitizar`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO `sanitizar` (`id_sanitizar`, `responsable`, `direccion`, `giro`, `fecha`, `estatus`, `telefono`) VALUES (4, 'Mayra Lizbeth Rojas Martínez ', 'Ignacio Lopez Ráyon # 55, Irapeo', 'Abarrotes Esperanza', '2021-01-27', 1, '4435746548');
INSERT INTO `sanitizar` (`id_sanitizar`, `responsable`, `direccion`, `giro`, `fecha`, `estatus`, `telefono`) VALUES (8, 'Griselda Hernandez Cesar', 'Ignacio Lopez Ráyon, Irapeo', 'Desconocido', '2021-01-27', 2, '###');
INSERT INTO `sanitizar` (`id_sanitizar`, `responsable`, `direccion`, `giro`, `fecha`, `estatus`, `telefono`) VALUES (9, 'Maria Diaz Eguiza', 'Melchor Ocampo # 37, Irapeo', 'Desconocido', '2021-01-27', 1, '###');
INSERT INTO `sanitizar` (`id_sanitizar`, `responsable`, `direccion`, `giro`, `fecha`, `estatus`, `telefono`) VALUES (10, 'Jose Luis Ortiz Miranda', 'Ignacio Lopez Rayon s/n, Irapeo', 'Desconocido', '2021-01-27', 1, '###');
INSERT INTO `sanitizar` (`id_sanitizar`, `responsable`, `direccion`, `giro`, `fecha`, `estatus`, `telefono`) VALUES (11, 'Beatriz Rodriguez Bucio', 'Vicente Guerrero s/n. Irapeo', 'Desconocido', '2021-01-27', 1, '###');
INSERT INTO `sanitizar` (`id_sanitizar`, `responsable`, `direccion`, `giro`, `fecha`, `estatus`, `telefono`) VALUES (12, 'Cesar Melchor', 'Cerca de la primaria', 'Negocio desconocido', '2021-01-27', 1, '###');
INSERT INTO `sanitizar` (`id_sanitizar`, `responsable`, `direccion`, `giro`, `fecha`, `estatus`, `telefono`) VALUES (13, 'Jose Alfredo Ramirez Maciel', 'Ignacio Lopez Rayon s/n, Irapeo', 'Desconocido', '2021-01-27', 1, '###');
INSERT INTO `sanitizar` (`id_sanitizar`, `responsable`, `direccion`, `giro`, `fecha`, `estatus`, `telefono`) VALUES (14, 'María Guadalupe Gonzalez Orozco', 'Jose Ma. Morelos # 2, Irapeo', 'Desconocido', '2021-01-27', 1, '###');
INSERT INTO `sanitizar` (`id_sanitizar`, `responsable`, `direccion`, `giro`, `fecha`, `estatus`, `telefono`) VALUES (15, 'Karina Itzel Gonzalez Robles', 'Vicente Guerrero s/n, Irapeo ', 'Desconocido', '2021-01-27', 1, '###');


#
# TABLE STRUCTURE FOR: secciones
#

DROP TABLE IF EXISTS `secciones`;

CREATE TABLE `secciones` (
  `id_seccion` int(11) NOT NULL AUTO_INCREMENT,
  `seccion` varchar(128) NOT NULL,
  `id_comunidad` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_seccion`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (1, '0346', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (2, '0347', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (3, '0348', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (4, '0349', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (5, '0350', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (6, '0351', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (7, '0352', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (8, '0353', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (9, '0354', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (10, '0355', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (11, '0356', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (12, '0357', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (13, '0358', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (14, '0359', 1);
INSERT INTO `secciones` (`id_seccion`, `seccion`, `id_comunidad`) VALUES (15, '0360', 1);


#
# TABLE STRUCTURE FOR: solicitud
#

DROP TABLE IF EXISTS `solicitud`;

CREATE TABLE `solicitud` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `id_beneficiario` int(11) NOT NULL,
  `id_apoyo` int(11) NOT NULL,
  `cantidad` float(11,2) NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estatus_solicitud` int(11) NOT NULL,
  `id_usuario_autorizo` int(11) DEFAULT NULL,
  `cantidad_autorizada` float(11,2) DEFAULT NULL,
  `fecha_autorizo` date DEFAULT NULL,
  `id_usuario_entrega` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `descuento` float(12,2) NOT NULL,
  `motivo_rechazo` text NOT NULL,
  `total` double(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `solicitud` (`id_solicitud`, `id_beneficiario`, `id_apoyo`, `cantidad`, `fecha`, `id_usuario`, `id_estatus_solicitud`, `id_usuario_autorizo`, `cantidad_autorizada`, `fecha_autorizo`, `id_usuario_entrega`, `fecha_entrega`, `descuento`, `motivo_rechazo`, `total`) VALUES (3, 2, 3, '10.00', '2020-09-24', 1, 2, 1, NULL, NULL, 0, '0000-00-00', '0.00', 'Porque no quiero', '0.00');
INSERT INTO `solicitud` (`id_solicitud`, `id_beneficiario`, `id_apoyo`, `cantidad`, `fecha`, `id_usuario`, `id_estatus_solicitud`, `id_usuario_autorizo`, `cantidad_autorizada`, `fecha_autorizo`, `id_usuario_entrega`, `fecha_entrega`, `descuento`, `motivo_rechazo`, `total`) VALUES (4, 2, 3, '15.00', '2020-09-24', 1, 4, 1, '15.00', '2020-09-24', 1, '2020-09-24', '0.00', '', '0.00');


#
# TABLE STRUCTURE FOR: tipo_usuario
#

DROP TABLE IF EXISTS `tipo_usuario`;

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(32) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`) VALUES (1, 'Capturista');
INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`) VALUES (2, 'Gestor');
INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`) VALUES (3, 'Administrador');


#
# TABLE STRUCTURE FOR: unidad
#

DROP TABLE IF EXISTS `unidad`;

CREATE TABLE `unidad` (
  `id_unidad` int(11) NOT NULL AUTO_INCREMENT,
  `unidad` varchar(128) NOT NULL,
  PRIMARY KEY (`id_unidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `unidad` (`id_unidad`, `unidad`) VALUES (1, 'Toneladas');
INSERT INTO `unidad` (`id_unidad`, `unidad`) VALUES (2, 'Paquete');


#
# TABLE STRUCTURE FOR: usuario
#

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(32) NOT NULL,
  `password` text NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `ultimo_ingreso` datetime DEFAULT NULL,
  `estatus_usuario` int(1) NOT NULL DEFAULT 1,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `nombre`, `id_tipo_usuario`, `ultimo_ingreso`, `estatus_usuario`, `fecha_registro`) VALUES (1, 'sistemas', '$2y$10$s82cOscSD5JD9FFOg3QzJeSohJb9XanlOkieRg0F5SWeLSpcgdEse', 'Sistemas', 3, '2020-10-07 22:32:58', 1, '0000-00-00');
INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `nombre`, `id_tipo_usuario`, `ultimo_ingreso`, `estatus_usuario`, `fecha_registro`) VALUES (2, 'luism', '$2y$10$fNflURlq4QnmWW.Pa2cHC.qVwmmlcg6kqPGxatpa8uGpTTlWtNKTq', 'Luis Magaña', 2, NULL, 1, '2020-09-25');
INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `nombre`, `id_tipo_usuario`, `ultimo_ingreso`, `estatus_usuario`, `fecha_registro`) VALUES (3, 'chavacharo', '$2y$10$TjSrU4q0QNky5CZ8q1yVluAZaprMaCiJ3eGzDTXYR4t4Gg2bxz7aa', 'Salvador Cortes Espindola', 3, '2021-10-15 21:20:32', 1, '2020-09-25');


