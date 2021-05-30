-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2021 a las 04:36:23
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `web_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_articles`
--

CREATE TABLE `tb_articles` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `state` int(11) DEFAULT 0,
  `project_id` int(11) NOT NULL,
  `user_id` int(55) NOT NULL,
  `article` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_classes`
--

CREATE TABLE `tb_classes` (
  `id` int(11) NOT NULL,
  `name` varchar(77) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_classes`
--

INSERT INTO `tb_classes` (`id`, `name`) VALUES
(1, 'Sports'),
(2, 'Videogames'),
(3, 'Beauty and woman care'),
(4, 'Politics'),
(5, 'ONG and activism'),
(6, 'Home & garden'),
(7, 'Wellness and business'),
(8, 'Computers & electronics'),
(9, 'Natural medicine and health'),
(10, 'Music & arts');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_projects`
--

CREATE TABLE `tb_projects` (
  `id` int(55) NOT NULL,
  `user_id` int(55) NOT NULL,
  `editor_id` int(55) DEFAULT 0,
  `published` text DEFAULT NULL,
  `ispublished` int(1) NOT NULL DEFAULT 0,
  `name` varchar(70) DEFAULT NULL,
  `date` varchar(33) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `num_articles` int(7) DEFAULT 1,
  `type` int(4) DEFAULT NULL,
  `class` int(20) DEFAULT NULL,
  `state` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tickets`
--

CREATE TABLE `tb_tickets` (
  `id` int(55) NOT NULL,
  `user_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `ticket` text NOT NULL,
  `answer` text NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `adminname` text NOT NULL,
  `date` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `role_id` int(2) DEFAULT NULL,
  `name` varchar(70) DEFAULT NULL,
  `description` text NOT NULL,
  `skills` text NOT NULL,
  `numarticles` int(11) NOT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT 0.00,
  `email` varchar(40) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `startedon` text NOT NULL,
  `recoveryCode` varchar(255) DEFAULT NULL,
  `finishedprojects` int(20) DEFAULT 0,
  `pendant_project` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_articles`
--
ALTER TABLE `tb_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_classes`
--
ALTER TABLE `tb_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_projects`
--
ALTER TABLE `tb_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_tickets`
--
ALTER TABLE `tb_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_articles`
--
ALTER TABLE `tb_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_classes`
--
ALTER TABLE `tb_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tb_projects`
--
ALTER TABLE `tb_projects`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_tickets`
--
ALTER TABLE `tb_tickets`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
