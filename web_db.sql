-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2021 a las 08:03:03
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
  `published` text NOT NULL,
  `ispublished` int(1) NOT NULL DEFAULT 0,
  `name` varchar(70) DEFAULT NULL,
  `date` varchar(33) DEFAULT current_timestamp(),
  `description` varchar(255) DEFAULT NULL,
  `num_articles` int(7) DEFAULT 1,
  `type` int(4) DEFAULT NULL,
  `class` int(20) DEFAULT NULL,
  `state` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_projects`
--

INSERT INTO `tb_projects` (`id`, `user_id`, `editor_id`, `published`, `ispublished`, `name`, `date`, `description`, `num_articles`, `type`, `class`, `state`) VALUES
(1, 2, 23, '                                                                                                                                                <p>                                                                                                                                      Place <em>some</em> <u>text a<font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">aaaaaaaa ASDASDwadw</font><font color=\"#000000\" style=\"background-color: rgb(0, 255, 0);\">asdasd</font><font color=\"#000000\" style=\"background-color: rgb(0, 0, 255);\">asdasd</font></u><span style=\"font-family: Verdana;\">asdasd</span></p><p><span style=\"font-family: Verdana;\"><br></span></p><h1><span style=\"font-family: Verdana;\">asdasd</span><span style=\"font-family: Impact;\">AASD</span></h1>                                                                                                                                ', 1, 'Project test', '13/02/2021', 'I need an article that describes the procces of making a new project', 0, 2, 3, 1),
(2, 1, 0, '', 0, 'Project test 1', '13/02/2021', 'I need an article that describes the procces of making a new project', 0, 3, 1, 1),
(3, 1, 0, '', 0, 'Project test 2', '13/02/2021', 'I need an article that describes the procces of making a new project', 0, 3, 2, 3),
(18, 1, 0, '', 0, 'Juanete Debasdw', '03/05/2021', 'avvvvvvvvvvvvvvvvvvvvv', 1, 1, 1, 1),
(19, 1, 0, '', 0, 'Juanete', '03/05/2021', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 1, 2, 2, 1),
(20, 1, 0, '', 0, 'Juanete', '03/05/2021', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 1, 2, 2, 1),
(21, 1, 0, '', 0, 'adddddddddddddddd', '03/05/2021', 'ddaaaaaaaaaaaaaaaaaaaaaaaa', 1, 3, 6, 1),
(22, 1, 0, '', 0, 'aaaaaaaaaa', '03/05/2021', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1, 3, 3, 1),
(23, 1, 0, '', 0, 'aaaaaaaaaa', '03/05/2021', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1, 3, 3, 1),
(24, 15, 0, '', 0, 'adddddddddddddddd', '06/05/2021', 'asdasd', 1, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `role_id` int(2) DEFAULT NULL,
  `name` varchar(70) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `recoveryCode` varchar(255) DEFAULT NULL,
  `pendant_project` int(11) DEFAULT 0,
  `editor_saved` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_users`
--

INSERT INTO `tb_users` (`id`, `role_id`, `name`, `email`, `passwd`, `recoveryCode`, `pendant_project`, `editor_saved`) VALUES
(1, 3, 'Santi Mamani ', 'santi@gmail.com', '$2y$15$PWACg6Ner2sMd7diPOPvRuNWPXifjdbAvPw4UZmYZJ5BiQnRqNauG', NULL, 2, '                                                                                                                                                <p>                                                                                                                                      Place <em>some</em> <u>text a<font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">aaaaaaaa ASDASDwadw</font><font color=\"#000000\" style=\"background-color: rgb(0, 255, 0);\">asdasd</font><font color=\"#000000\" style=\"background-color: rgb(0, 0, 255);\">asdasd</font></u><span style=\"font-family: Verdana;\">asdasd</span></p><p><span style=\"font-family: Verdana;\"><br></span></p><h1><span style=\"font-family: Verdana;\">asdasd</span><span style=\"font-family: Impact;\">AASD</span></h1>                                                                                                                                '),
(2, 1, 'Carlitos', 'carlos@gmail.com', '$2y$15$UVQk4QUnrWGtQhnzLw7nJOqas6hyQbCIPoq0RyNmCjgfyYfvbWJQO', '1444', 0, ''),
(3, 1, 'asdasd', 'a@a.a', '$2y$15$cPL6BQt08MI9.hmff6p8AuKhy/EMN2IeIC9qKHCSG4SF3dn.e7wAK', '1444', 0, ''),
(4, 2, 'Milagros Hash', 'hash@a.a', '$2y$15$FehhOiW8Vi8dCuujaslNQ.MaJpm7z/Ca4ibkzU0MPDIjI1scMAsRe', '0', 1, '');

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_classes`
--
ALTER TABLE `tb_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tb_projects`
--
ALTER TABLE `tb_projects`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



