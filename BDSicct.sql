-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-07-2021 a las 19:59:18
-- Versión del servidor: 10.4.14-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u231967084_BDSicct`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblAccesorios`
--

CREATE TABLE `TblAccesorios` (
  `IdAccesorio` int(11) NOT NULL,
  `Accesorio` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Medida` varchar(5) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblAccesorios`
--

INSERT INTO `TblAccesorios` (`IdAccesorio`, `Accesorio`, `Medida`) VALUES
(1, 'Cierre', ''),
(2, 'Bies', ''),
(3, 'Botón', ''),
(4, 'Bolsa de player', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblAccesoriosSesiones`
--

CREATE TABLE `TblAccesoriosSesiones` (
  `IdAcceSecc` int(11) NOT NULL,
  `IdSesion` int(11) NOT NULL,
  `IdAccesorio` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblAccesoriosSesiones`
--

INSERT INTO `TblAccesoriosSesiones` (`IdAcceSecc`, `IdSesion`, `IdAccesorio`, `IdProducto`, `Cantidad`) VALUES
(1, 1, 2, 1, 0),
(2, 2, 4, 1, 0),
(3, 2, 4, 1, 0),
(4, 2, 4, 1, 0),
(5, 3, 3, 1, 0),
(6, 3, 1, 1, 0),
(7, 1, 4, 3, 0),
(8, 1, 1, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblClientes`
--

CREATE TABLE `TblClientes` (
  `IdCliente` int(11) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `RFC` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Nombrecontacto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `TelefonoContacto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Bloqueado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblClientes`
--

INSERT INTO `TblClientes` (`IdCliente`, `Nombre`, `RFC`, `Direccion`, `Correo`, `Telefono`, `Nombrecontacto`, `TelefonoContacto`, `Bloqueado`) VALUES
(1, 'Liverpooll', 'LIV53467PO45', 'Av. Insurgentes # 56 COL. Los rosales Alcaldia Miguel Hidalgo, CDMX CP: 89028', 'comprasmexico@liverpool.com.mx', '5510985568', 'Alvaro Méndez Ordoñez', '5509182930', 0),
(2, 'Coppel', 'COP681207EL90', 'Carr. Fed. Mexico-Puebla #56 Col. San Miguel Alcaldia Iztapalapa, CDMX CP: 68090', 'compras@coppel.com', '5510293878', 'Adriana Nicolaz Bravo', '5509172899', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblDepartamento`
--

CREATE TABLE `TblDepartamento` (
  `IdDepartamento` int(11) NOT NULL,
  `Departamento` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblDepartamento`
--

INSERT INTO `TblDepartamento` (`IdDepartamento`, `Departamento`) VALUES
(1, 'Almacen'),
(2, 'Corte'),
(3, 'Producción'),
(4, 'Terminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblProduccion`
--

CREATE TABLE `TblProduccion` (
  `IdProduccion` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `IdSesion` int(11) NOT NULL,
  `Produccion` int(11) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `TblProduccion`
--

INSERT INTO `TblProduccion` (`IdProduccion`, `IdProducto`, `IdSesion`, `Produccion`, `Fecha`) VALUES
(1, 1, 1, 200, '2021-01-19'),
(2, 1, 2, 250, '2021-01-19'),
(3, 1, 3, 500, '2021-01-19'),
(4, 1, 1, 300, '2021-01-19'),
(5, 1, 2, 250, '2021-01-19'),
(6, 1, 3, 0, '2021-01-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblProducto`
--

CREATE TABLE `TblProducto` (
  `IdProducto` int(11) NOT NULL,
  `Clave` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `IdTProducto` int(11) NOT NULL,
  `Estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Totalpiezas` int(11) NOT NULL,
  `NumeroSesiones` int(11) NOT NULL,
  `Fechaingreso` datetime NOT NULL,
  `Fechasalida` datetime NOT NULL,
  `Clasificacion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Terminado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblProducto`
--

INSERT INTO `TblProducto` (`IdProducto`, `Clave`, `IdCliente`, `IdTProducto`, `Estado`, `Totalpiezas`, `NumeroSesiones`, `Fechaingreso`, `Fechasalida`, `Clasificacion`, `Terminado`) VALUES
(1, '391040', 1, 5, '1', 1500, 3, '2021-01-01 00:00:00', '2021-01-19 00:00:00', 'Niño', 0),
(2, 'pans-099', 1, 8, '2', 1000, 5, '2021-02-25 00:00:00', '2021-03-11 00:00:00', 'Dama', 0),
(3, 'C1245', 1, 3, '2', 3000, 3, '2021-07-01 00:00:00', '2021-07-30 00:00:00', 'Niño', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblPuesto`
--

CREATE TABLE `TblPuesto` (
  `IdPuesto` int(11) NOT NULL,
  `Puesto` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblPuesto`
--

INSERT INTO `TblPuesto` (`IdPuesto`, `Puesto`) VALUES
(1, 'Administrador'),
(2, 'Asistente de administración'),
(3, 'Cortador de tela'),
(4, 'Asistente de cortado'),
(5, 'Asistente de cortador'),
(6, 'Administrador de almacen'),
(7, 'Asistente de almacen'),
(8, 'Encargado de linea'),
(9, 'Administrador de terminado'),
(10, 'Asistente de terminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblRoles`
--

CREATE TABLE `TblRoles` (
  `IdRol` int(11) NOT NULL,
  `Rol` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblRoles`
--

INSERT INTO `TblRoles` (`IdRol`, `Rol`) VALUES
(1, 'Control total'),
(2, 'Consulta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblSesiones`
--

CREATE TABLE `TblSesiones` (
  `IdSesion` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `IdTaller` int(11) NOT NULL,
  `Estado` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaProgramada` date NOT NULL,
  `PiezasHechas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblSesiones`
--

INSERT INTO `TblSesiones` (`IdSesion`, `IdProducto`, `IdTaller`, `Estado`, `Cantidad`, `FechaInicio`, `FechaProgramada`, `PiezasHechas`) VALUES
(1, 1, 3, 'Iniciado', 500, '2021-01-19', '2021-01-14', 500),
(2, 1, 2, 'Iniciado', 500, '2021-01-19', '2021-01-12', 500),
(3, 1, 3, 'Iniciado', 500, '2021-01-19', '2021-01-13', 500),
(1, 3, 1, 'Iniciado', 1000, '2021-07-03', '2021-07-15', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblTallas`
--

CREATE TABLE `TblTallas` (
  `IdTalla` int(11) NOT NULL,
  `Talla` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblTallas`
--

INSERT INTO `TblTallas` (`IdTalla`, `Talla`) VALUES
(1, 'Ech'),
(2, 'Ch'),
(3, 'Md'),
(4, 'Gr'),
(5, 'EG'),
(6, 'JU'),
(7, 'XL'),
(8, '1XL'),
(9, '2XL'),
(10, '3XL'),
(11, '2'),
(12, '4'),
(13, '6'),
(14, '8'),
(15, '10'),
(16, '12'),
(17, '14'),
(18, '16'),
(19, '3'),
(20, '5'),
(21, '7'),
(22, '9'),
(23, '11'),
(24, '13'),
(25, '15'),
(26, '17'),
(27, '19'),
(28, '28'),
(29, '30'),
(30, '32'),
(31, '34'),
(32, '36'),
(33, '38'),
(34, '40'),
(35, '42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblTallasSesiones`
--

CREATE TABLE `TblTallasSesiones` (
  `IdSesion` int(11) NOT NULL,
  `IdTalla` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblTallasSesiones`
--

INSERT INTO `TblTallasSesiones` (`IdSesion`, `IdTalla`, `IdProducto`, `Cantidad`) VALUES
(1, 1, 1, 500),
(2, 2, 1, 250),
(2, 3, 1, 250),
(3, 4, 1, 250),
(3, 5, 1, 250),
(1, 2, 3, 150),
(1, 3, 3, 350),
(1, 4, 3, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblTallerExterno`
--

CREATE TABLE `TblTallerExterno` (
  `IdExterno` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `ApPaterno` varchar(30) NOT NULL,
  `ApMaterno` varchar(30) NOT NULL,
  `Direccion` text NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Bloqueado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `TblTallerExterno`
--

INSERT INTO `TblTallerExterno` (`IdExterno`, `Nombre`, `ApPaterno`, `ApMaterno`, `Direccion`, `Telefono`, `Bloqueado`) VALUES
(1, 'Ana', 'Balcón', 'Valerio', 'Altotonga', '157993577', 0),
(2, 'Noelia', 'Balcón', 'Valerio', 'Altalpas', '2315687090', 0),
(3, 'Héctor', 'Canela', 'Aburto', 'San Juan Xiutetelco', '2315784070', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblTipoProducto`
--

CREATE TABLE `TblTipoProducto` (
  `IdTProducto` int(11) NOT NULL,
  `TipoProducto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `TblTipoProducto`
--

INSERT INTO `TblTipoProducto` (`IdTProducto`, `TipoProducto`) VALUES
(1, 'Camisa'),
(2, 'Pantalón'),
(3, 'Sudadera'),
(4, 'Chamarra'),
(5, 'Playera'),
(6, 'Blusa'),
(7, 'Jeans'),
(8, 'Pans');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TblUsuario`
--

CREATE TABLE `TblUsuario` (
  `IdUsuario` int(11) NOT NULL,
  `IdPuesto` int(11) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `ApPaterno` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `ApMaterno` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `IdRol` int(11) NOT NULL,
  `Usuario` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Pass` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Bloqueado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TblUsuario`
--

INSERT INTO `TblUsuario` (`IdUsuario`, `IdPuesto`, `Nombre`, `ApPaterno`, `ApMaterno`, `Direccion`, `Correo`, `Telefono`, `IdRol`, `Usuario`, `Pass`, `Bloqueado`) VALUES
(1, 1, 'Administrador', 'Adm', '', '-', '-', '-', 1, 'admin', 'admin', 0),
(2, 1, 'Aldo', 'Pablo', 'Vera', 'C. Reforma # 182', 'aldopv@gmail.com', '231 152 8818', 1, 'aldo1', 'aldo2012', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `TblAccesorios`
--
ALTER TABLE `TblAccesorios`
  ADD PRIMARY KEY (`IdAccesorio`);

--
-- Indices de la tabla `TblAccesoriosSesiones`
--
ALTER TABLE `TblAccesoriosSesiones`
  ADD PRIMARY KEY (`IdAcceSecc`);

--
-- Indices de la tabla `TblClientes`
--
ALTER TABLE `TblClientes`
  ADD PRIMARY KEY (`IdCliente`);

--
-- Indices de la tabla `TblDepartamento`
--
ALTER TABLE `TblDepartamento`
  ADD PRIMARY KEY (`IdDepartamento`);

--
-- Indices de la tabla `TblProduccion`
--
ALTER TABLE `TblProduccion`
  ADD PRIMARY KEY (`IdProduccion`);

--
-- Indices de la tabla `TblProducto`
--
ALTER TABLE `TblProducto`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `TblPuesto`
--
ALTER TABLE `TblPuesto`
  ADD PRIMARY KEY (`IdPuesto`);

--
-- Indices de la tabla `TblRoles`
--
ALTER TABLE `TblRoles`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `TblTallas`
--
ALTER TABLE `TblTallas`
  ADD PRIMARY KEY (`IdTalla`);

--
-- Indices de la tabla `TblTallerExterno`
--
ALTER TABLE `TblTallerExterno`
  ADD PRIMARY KEY (`IdExterno`);

--
-- Indices de la tabla `TblTipoProducto`
--
ALTER TABLE `TblTipoProducto`
  ADD PRIMARY KEY (`IdTProducto`);

--
-- Indices de la tabla `TblUsuario`
--
ALTER TABLE `TblUsuario`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `TblAccesorios`
--
ALTER TABLE `TblAccesorios`
  MODIFY `IdAccesorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `TblAccesoriosSesiones`
--
ALTER TABLE `TblAccesoriosSesiones`
  MODIFY `IdAcceSecc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `TblClientes`
--
ALTER TABLE `TblClientes`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TblDepartamento`
--
ALTER TABLE `TblDepartamento`
  MODIFY `IdDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `TblProduccion`
--
ALTER TABLE `TblProduccion`
  MODIFY `IdProduccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `TblProducto`
--
ALTER TABLE `TblProducto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TblPuesto`
--
ALTER TABLE `TblPuesto`
  MODIFY `IdPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `TblRoles`
--
ALTER TABLE `TblRoles`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TblTallas`
--
ALTER TABLE `TblTallas`
  MODIFY `IdTalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `TblTallerExterno`
--
ALTER TABLE `TblTallerExterno`
  MODIFY `IdExterno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TblTipoProducto`
--
ALTER TABLE `TblTipoProducto`
  MODIFY `IdTProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `TblUsuario`
--
ALTER TABLE `TblUsuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
