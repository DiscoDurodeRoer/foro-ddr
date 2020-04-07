-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2020 a las 22:15:17
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foroddr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `icon` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `num_topics` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `parent_cat`, `icon`, `num_topics`) VALUES
(1, 'Programacion', 'Preguntas sobre programacion', 15, '', 0),
(2, 'Java', 'Preguntas sobre java', 1, '', 0),
(3, 'PHP', 'Preguntas sobre PHP', 1, '', 2),
(4, 'Ficheros', 'Preguntas de ficheros', 2, '', 6),
(5, 'Visual Basic .NET', 'Topics sobre Visual Basic .NET', 1, '', 0),
(6, 'Javascript', 'Topics sobre Javascript', 1, '', 0),
(7, 'SQL', 'Topics sobre SQL', 1, '', 0),
(8, 'MySQL', 'Topics sobre MySQL', 7, '', 0),
(9, 'Oracle', 'Topics sobre Oracle', 7, '', 0),
(10, 'Angular', 'Topics sobre Angular', 1, '', 0),
(11, 'C#', 'Topics sobre C#', 1, '', 0),
(12, 'Python', 'Topics sobre Python', 1, '', 0),
(13, 'Pseudocodigo', 'Topics sobre pseudocodigo', 1, '', 0),
(14, 'Lua', 'Topics sobre Lua', 1, '', 0),
(15, 'Inicio', 'Foros disponibles', 15, '', 0),
(16, 'test7', 'tetst', 1, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8_spanish_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `user_origin` int(11) NOT NULL,
  `show_message` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `text`, `date_creation`, `user_origin`, `show_message`) VALUES
(9, 'ejemplo topic', '2019-11-26 19:35:00', 7, 1),
(10, 'EJEMPLO', '2019-11-26 19:44:00', 8, 1),
(11, 'EJEMPLO 2', '2019-11-26 20:04:00', 9, 1),
(12, 'EJEMPLO 2', '2019-11-26 20:11:00', 10, 1),
(13, 'EJEMPLO 2', '2019-11-26 20:11:00', 7, 1),
(14, 'EJEMPLO 2', '2019-11-26 20:11:00', 8, 1),
(15, 'Tengo una duda sobre php', '2019-11-26 20:12:00', 9, 1),
(16, 'Tengo una duda sobre php', '2019-11-26 20:12:00', 10, 1),
(17, 'Responder al topic 14', '2019-11-28 19:07:00', 11, 1),
(18, 'responder al topic 14, prueba 2', '2019-11-28 19:08:00', 7, 1),
(20, 'contestando rapido', '2019-11-28 19:14:00', 8, 1),
(21, 'dime tu duda', '2019-11-28 19:16:00', 9, 1),
(22, 'Pues no lo se la verdad', '2019-11-28 19:16:00', 10, 1),
(23, 'respuesta', '2019-11-28 20:06:00', 7, 1),
(24, 'respuesta 2', '2019-11-28 20:06:00', 8, 1),
(25, 'respuesta', '2019-12-10 18:39:00', 9, 1),
(26, 'respuesta', '2019-12-10 18:39:00', 10, 1),
(27, 'respuesta', '2019-12-10 18:39:00', 7, 1),
(28, 'respuesta', '2019-12-10 18:39:00', 8, 1),
(29, 'respuesta', '2019-12-10 18:39:00', 9, 1),
(30, 'respuesta', '2019-12-10 18:39:00', 10, 1),
(31, 'respuesta', '2019-12-10 18:39:00', 7, 1),
(32, 'respuesta\r\n', '2019-12-10 18:39:00', 8, 1),
(33, 'respuesta', '2019-12-10 18:39:00', 9, 1),
(34, 'respuesta', '2019-12-10 18:39:00', 10, 1),
(35, 'respuesta', '2019-12-10 18:39:00', 10, 1),
(36, 'respuesta', '2019-12-10 18:39:00', 10, 1),
(37, 'respuesta', '2019-12-10 19:10:00', 10, 1),
(38, 'respuesta', '2019-12-10 19:10:00', 10, 1),
(39, 'respuesta', '2019-12-10 19:10:00', 10, 1),
(40, 'respuesta', '2019-12-10 19:10:00', 10, 1),
(41, 'respuesta', '2019-12-10 19:10:00', 10, 1),
(42, 'respuesta', '2019-12-10 19:10:00', 10, 1),
(43, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(44, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(45, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(46, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(47, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(48, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(49, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(50, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(51, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(52, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(53, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(54, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(55, 'respuesta', '2019-12-10 19:41:00', 10, 1),
(56, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(57, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(58, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(59, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(60, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(61, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(62, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(63, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(64, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(65, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(66, 'respuestarespuesta', '2019-12-10 19:42:00', 10, 1),
(67, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(68, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(69, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(70, 'respuesta', '2019-12-10 19:42:00', 10, 1),
(71, 'EJEMPLO', '2019-12-10 19:52:00', 10, 1),
(72, 'EJEMPLO', '2019-12-10 19:52:00', 10, 1),
(73, 'EJEMPLO', '2019-12-10 19:52:00', 10, 1),
(74, 'EJEMPLO', '2019-12-10 19:52:00', 10, 1),
(75, 'EJEMPLO', '2019-12-10 19:52:00', 10, 1),
(76, 'EJEMPLO', '2019-12-10 19:52:00', 10, 1),
(77, 'EJEMPLO', '2019-12-10 19:52:00', 10, 1),
(78, 'EJEMPLO', '2019-12-10 19:52:00', 10, 1),
(79, 'EJEMPLO', '2019-12-10 19:53:00', 10, 1),
(80, 'EJEMPLO', '2019-12-10 19:53:00', 10, 1),
(81, '<p><strong>fer</strong></p><p><i><strong>fer</strong></i></p><ul><li><i><strong>fer</strong></i><ul><li><i><strong>fer</strong></i></li></ul></li><li><i><strong>fer</strong></i></li></ul><blockquote><p><i><strong>fer</strong></i></p></blockquote>', '2019-12-19 19:33:00', 10, 1),
(82, '<p>Hola soy el user 11</p>', '2020-04-01 19:07:00', 11, 1),
(83, '<p>Segundo mensaje user 11</p>', '2020-04-01 19:17:00', 11, 1),
(84, '<p>test</p>', '2020-04-01 19:21:00', 11, 1),
(85, '<p>test 2</p>', '2020-04-01 19:24:00', 11, 1),
(86, '<p>test 2</p>', '2020-04-01 20:11:00', 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages_private`
--

CREATE TABLE `messages_private` (
  `id_message` int(11) NOT NULL,
  `user_destiny` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages_public`
--

CREATE TABLE `messages_public` (
  `id_message` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `message_index` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `messages_public`
--

INSERT INTO `messages_public` (`id_message`, `id_topic`, `message_index`) VALUES
(9, 14, 1),
(10, 15, 1),
(11, 16, 1),
(12, 17, 1),
(13, 18, 1),
(14, 19, 1),
(15, 20, 1),
(16, 21, 1),
(17, 14, 1),
(18, 14, 1),
(20, 14, 1),
(21, 20, 1),
(22, 20, 1),
(23, 14, 1),
(24, 14, 1),
(25, 14, 1),
(26, 14, 1),
(27, 14, 1),
(28, 14, 1),
(29, 14, 1),
(30, 14, 1),
(31, 14, 1),
(32, 14, 1),
(33, 14, 1),
(34, 14, 1),
(35, 14, 1),
(36, 14, 1),
(37, 14, 1),
(38, 14, 1),
(39, 14, 1),
(40, 14, 1),
(41, 14, 1),
(42, 14, 1),
(43, 14, 1),
(44, 14, 1),
(45, 14, 1),
(46, 14, 1),
(47, 14, 1),
(48, 14, 1),
(49, 14, 1),
(50, 14, 1),
(51, 14, 1),
(52, 14, 1),
(53, 14, 1),
(54, 14, 1),
(55, 14, 1),
(56, 14, 1),
(57, 14, 1),
(58, 14, 1),
(59, 14, 1),
(60, 14, 1),
(61, 14, 1),
(62, 14, 1),
(63, 14, 1),
(64, 14, 1),
(65, 14, 1),
(66, 14, 1),
(67, 14, 1),
(68, 14, 1),
(69, 14, 1),
(70, 14, 1),
(71, 15, 1),
(72, 15, 1),
(73, 15, 1),
(74, 15, 1),
(75, 15, 1),
(76, 15, 1),
(77, 15, 1),
(78, 15, 1),
(79, 15, 1),
(80, 15, 1),
(81, 14, 1),
(82, 14, 1),
(83, 14, 1),
(84, 14, 1),
(85, 14, 1),
(86, 14, 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `creator_user` int(11) NOT NULL,
  `open` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `topics`
--

INSERT INTO `topics` (`id`, `title`, `date_creation`, `creator_user`, `open`, `views`, `id_cat`) VALUES
(14, 'titulo', '2019-11-26 19:35:00', 10, 0, 0, 4),
(15, 'titulo 2', '2019-11-26 19:44:00', 10, 1, 0, 4),
(16, 'titulo 3', '2019-11-26 20:04:00', 10, 1, 0, 4),
(17, 'titulo 3', '2019-11-26 20:11:00', 10, 1, 0, 4),
(18, 'titulo 3', '2019-11-26 20:11:00', 10, 1, 0, 4),
(19, 'titulo 3', '2019-11-26 20:11:00', 10, 1, 0, 4),
(20, 'duda php', '2019-11-26 20:12:00', 10, 1, 0, 3),
(21, 'duda php', '2019-11-26 20:12:00', 10, 1, 0, 3);

--
-- Disparadores `topics`
--
DELIMITER $$
CREATE TRIGGER `update_num_topics_delete` AFTER DELETE ON `topics` FOR EACH ROW BEGIN
    
    declare num_topics_update int(11);
    	
    SELECT count(*) into num_topics_update FROM topics WHERE id_cat = OLD.id_cat;
    
   	UPDATE categories SET num_topics = num_topics_update where id = OLD.id_cat;
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_num_topics_insert` AFTER INSERT ON `topics` FOR EACH ROW BEGIN
    
    declare num_topics_update int(11);
    	
    SELECT count(*) into num_topics_update FROM topics WHERE id_cat = NEW.id_cat;
    
   	UPDATE categories SET num_topics = num_topics_update where id = NEW.id_cat;
   
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_num_topics_update` AFTER UPDATE ON `topics` FOR EACH ROW BEGIN
    
    declare num_topics_update int(11);
    
    SELECT count(*) into num_topics_update FROM topics WHERE id_cat = NEW.id_cat;
    
    UPDATE categories SET num_topics = num_topics_update where id = NEW.id_cat;
        
    SELECT count(*) into num_topics_update FROM topics WHERE id_cat = OLD.id_cat;
    
    UPDATE categories SET num_topics = num_topics_update where id = OLD.id_cat;
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unread_messages_public`
--

CREATE TABLE `unread_messages_public` (
  `id_user` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `id_message` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `unread_messages_public`
--

INSERT INTO `unread_messages_public` (`id_user`, `id_topic`, `id_message`) VALUES
(7, 14, 85),
(7, 14, 86),
(8, 14, 85),
(8, 14, 86),
(9, 14, 85),
(9, 14, 86),
(10, 14, 85),
(10, 14, 86);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unread_message_private`
--

CREATE TABLE `unread_message_private` (
  `id_message` int(11) NOT NULL,
  `id_user_destiny` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nickname` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `registry_date` date NOT NULL,
  `avatar` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `last_connection` datetime NOT NULL,
  `baneado` int(11) NOT NULL,
  `borrado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `nickname`, `email`, `pass`, `registry_date`, `avatar`, `rol`, `last_connection`, `baneado`, `borrado`) VALUES
(1, 'disco', 'duro de roer', 'discoduroderoer', 'administrador@discoduroderoer.es', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2019-10-22', 'http://localhost:8080/foro-ddr/public/img/default-avatar.jpg', 1, '2019-10-22 00:00:00', 0, 0),
(6, 'fer', 'fer', 'ddr', 'email@email.com', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2019-10-31', 'http://localhost:8080/foro-ddr/public/img/default-avatar.jpg', 2, '2019-10-31 20:09:00', 0, 1),
(7, 'ddr3', 'ddr3', 'ddr3', 'ddr3@ddr3.com', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2019-11-05', 'http://localhost:8080/foro-ddr/public/img/default-avatar.jpg', 2, '2019-11-05 19:22:00', 1, 1),
(8, 'ddr4', 'ddr4', 'ddr4', 'ddr4@ddr4.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-11-05', 'http://localhost:8080/foro-ddr/public/img/default-avatar.jpg', 2, '2019-11-05 19:37:00', 0, 1),
(9, 'ddr5', 'ddr5', 'ddr5', 'ddr5@ddr5.com', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2019-11-05', 'http://localhost:8080/foro-ddr/public/img/default-avatar.jpg', 2, '2019-11-05 19:39:00', 0, 1),
(10, 'Pepito2', 'Perez2', 'ddr6', 'ddr7@ddr7.com', '68c6932d39d733b092c9b998d0e0571ed2ac008f1ac8b7bc0ef65dd497bc89448d9bd755721dd61468dd151259a6d5ac3b87cef97223b341a48aa72ad4e77d1c', '2019-11-05', 'http://localhost:8080/foro-ddr/public/img/default-avatar.jpg', 1, '2019-11-05 20:25:00', 0, 0),
(11, 'ddr7', 'ddr7', 'ddr7', 'ddr7@ddr7.es', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2020-03-05', 'http://localhost:8080/foro-ddr/public/img/default-avatar.jpg', 1, '2020-03-05 18:52:00', 0, 0),
(12, 'ddr8', 'ddr8', 'ddr8', 'ddr8@ddr8.com', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2020-04-01', 'http://localhost:8080/foro-ddr/public/img/default-avatar.jpg', 2, '2020-04-01 20:11:00', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categories_parent_cat` (`parent_cat`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_messages_user_origin` (`user_origin`);

--
-- Indices de la tabla `messages_private`
--
ALTER TABLE `messages_private`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `fk_messages_private_id_user` (`user_destiny`);

--
-- Indices de la tabla `messages_public`
--
ALTER TABLE `messages_public`
  ADD PRIMARY KEY (`id_message`,`id_topic`),
  ADD KEY `fk_messages_public_id_topic` (`id_topic`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_topics_id_user` (`creator_user`),
  ADD KEY `fk_topics_id_cat` (`id_cat`);

--
-- Indices de la tabla `unread_messages_public`
--
ALTER TABLE `unread_messages_public`
  ADD PRIMARY KEY (`id_user`,`id_topic`,`id_message`),
  ADD KEY `fk_unread_messages_public_id_message` (`id_message`),
  ADD KEY `fk_unread_messages_public_id_topic` (`id_topic`);

--
-- Indices de la tabla `unread_message_private`
--
ALTER TABLE `unread_message_private`
  ADD KEY `fk_unread_messages_private_id_message` (`id_message`),
  ADD KEY `fk_unread_messages_private_id_user` (`id_user_destiny`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_id_rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_parent_cat` FOREIGN KEY (`parent_cat`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_user_origin` FOREIGN KEY (`user_origin`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `messages_private`
--
ALTER TABLE `messages_private`
  ADD CONSTRAINT `fk_messages_private_id_message` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `fk_messages_private_id_user` FOREIGN KEY (`user_destiny`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `messages_public`
--
ALTER TABLE `messages_public`
  ADD CONSTRAINT `fk_messages_public_id_message` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `fk_messages_public_id_topic` FOREIGN KEY (`id_topic`) REFERENCES `topics` (`id`);

--
-- Filtros para la tabla `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `fk_topics_id_cat` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_topics_id_user` FOREIGN KEY (`creator_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `unread_messages_public`
--
ALTER TABLE `unread_messages_public`
  ADD CONSTRAINT `fk_unread_messages_public_id_message` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `fk_unread_messages_public_id_topic` FOREIGN KEY (`id_topic`) REFERENCES `topics` (`id`),
  ADD CONSTRAINT `fk_unread_messages_public_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `unread_message_private`
--
ALTER TABLE `unread_message_private`
  ADD CONSTRAINT `fk_unread_messages_private_id_message` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `fk_unread_messages_private_id_user` FOREIGN KEY (`id_user_destiny`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_id_rol` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
