/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.4.11-MariaDB : Database - amiko
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `apoyo` */

DROP TABLE IF EXISTS `apoyo`;

CREATE TABLE `apoyo` (
  `id_apoyo` int(11) NOT NULL AUTO_INCREMENT,
  `apoyo` varchar(256) NOT NULL,
  `id_usuario_autoriza` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `id_unidad` int(11) NOT NULL,
  PRIMARY KEY (`id_apoyo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `apoyo` */

insert  into `apoyo`(`id_apoyo`,`apoyo`,`id_usuario_autoriza`,`descripcion`,`id_unidad`) values (3,'Arena',0,'',1);

/*Table structure for table `area` */

DROP TABLE IF EXISTS `area`;

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(128) NOT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `area` */

insert  into `area`(`id_area`,`area`) values (1,'Sistemas');

/*Table structure for table `beneficiario` */

DROP TABLE IF EXISTS `beneficiario`;

CREATE TABLE `beneficiario` (
  `id_beneficiario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `apPaterno` varchar(64) NOT NULL,
  `apMaterno` varchar(64) DEFAULT NULL,
  `ine` varchar(18) DEFAULT NULL,
  `curp` varchar(18) NOT NULL,
  `id_tenencia` int(11) NOT NULL,
  `id_comunidad` int(11) NOT NULL,
  `direccion` varchar(256) NOT NULL,
  `numero` varchar(32) NOT NULL,
  `telefono` varchar(32) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `comprobante` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_beneficiario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `beneficiario` */

insert  into `beneficiario`(`id_beneficiario`,`nombre`,`apPaterno`,`apMaterno`,`ine`,`curp`,`id_tenencia`,`id_comunidad`,`direccion`,`numero`,`telefono`,`fecha_registro`,`id_usuario_registro`,`comprobante`) values (1,'Luis','Magaña','','','',1,1,'Avenida Morelos','144','','2020-06-25 00:49:01',1,'');

/*Table structure for table `comunidad` */

DROP TABLE IF EXISTS `comunidad`;

CREATE TABLE `comunidad` (
  `id_comunidad` int(11) NOT NULL AUTO_INCREMENT,
  `comunidad` varchar(128) NOT NULL,
  `id_tenencia` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_comunidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `comunidad` */

insert  into `comunidad`(`id_comunidad`,`comunidad`,`id_tenencia`) values (1,'Charo',1);

/*Table structure for table `estatus_solicitud` */

DROP TABLE IF EXISTS `estatus_solicitud`;

CREATE TABLE `estatus_solicitud` (
  `id_estatus_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(32) NOT NULL,
  `color` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_estatus_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `estatus_solicitud` */

insert  into `estatus_solicitud`(`id_estatus_solicitud`,`estatus`,`color`) values (1,'Pendiente',NULL),(2,'Rechazado',NULL),(3,'Autorizado',NULL),(4,'Entregado',NULL);

/*Table structure for table `solicitud` */

DROP TABLE IF EXISTS `solicitud`;

CREATE TABLE `solicitud` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `id_beneficiario` int(11) NOT NULL,
  `id_apoyo` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `cantidad` float(11,2) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estatus_solicitud` int(11) NOT NULL,
  `id_usuario_autorizo` int(11) DEFAULT NULL,
  `cantidad_autorizada` float(11,2) DEFAULT NULL,
  `fecha_autorizo` date DEFAULT NULL,
  `id_tenencia` int(11) NOT NULL,
  `id_comunidad` int(11) NOT NULL,
  `id_usuario_entrega` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `costo` float(12,2) NOT NULL,
  `motivo_rechazo` text NOT NULL,
  PRIMARY KEY (`id_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `solicitud` */

insert  into `solicitud`(`id_solicitud`,`id_beneficiario`,`id_apoyo`,`id_unidad`,`cantidad`,`fecha`,`descripcion`,`id_usuario`,`id_estatus_solicitud`,`id_usuario_autorizo`,`cantidad_autorizada`,`fecha_autorizo`,`id_tenencia`,`id_comunidad`,`id_usuario_entrega`,`fecha_entrega`,`costo`,`motivo_rechazo`) values (1,1,3,1,10.00,'2020-06-25','Arena',1,4,1,10.00,'2020-06-25',1,1,1,'2020-06-25',100.00,'');

/*Table structure for table `tenencia` */

DROP TABLE IF EXISTS `tenencia`;

CREATE TABLE `tenencia` (
  `id_tenencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  PRIMARY KEY (`id_tenencia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tenencia` */

insert  into `tenencia`(`id_tenencia`,`nombre`) values (1,'Charo');

/*Table structure for table `tipo_usuario` */

DROP TABLE IF EXISTS `tipo_usuario`;

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(32) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_usuario` */

insert  into `tipo_usuario`(`id_tipo_usuario`,`tipo_usuario`) values (1,'Capturista'),(2,'Gestor'),(3,'Administrador');

/*Table structure for table `unidad` */

DROP TABLE IF EXISTS `unidad`;

CREATE TABLE `unidad` (
  `id_unidad` int(11) NOT NULL AUTO_INCREMENT,
  `unidad` varchar(128) NOT NULL,
  PRIMARY KEY (`id_unidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `unidad` */

insert  into `unidad`(`id_unidad`,`unidad`) values (1,'Toneladas');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(32) NOT NULL,
  `password` text NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `autoriza` int(1) NOT NULL DEFAULT 0,
  `ultimo_ingreso` datetime DEFAULT NULL,
  `estatus_usuario` int(1) NOT NULL DEFAULT 1,
  `id_area` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id_usuario`,`usuario`,`password`,`nombre`,`id_tipo_usuario`,`autoriza`,`ultimo_ingreso`,`estatus_usuario`,`id_area`,`fecha_registro`) values (1,'sistemas','$2y$10$Arn2MrC1EivTFgSUM5Bbt.VPWa1xI9Q4Mrvnn8ZMcyuDbVVyAAhj6','Sistemas',3,1,'2020-06-25 00:14:54',1,1,'0000-00-00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
