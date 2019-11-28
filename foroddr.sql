-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2019 a las 20:18:50
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
(1, 'Programacion', 'Preguntas sobre programacion', 1, '', 0),
(2, 'Java', 'Preguntas sobre java', 1, '', 0),
(3, 'PHP', 'Preguntas sobre PHP', 1, '', 2),
(4, 'Ficheros', 'Preguntas de ficheros', 2, '', 6);

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
(9, 'ejemplo topic', '2019-11-26 19:35:00', 10, 1),
(10, 'EJEMPLO', '2019-11-26 19:44:00', 10, 1),
(11, 'EJEMPLO 2', '2019-11-26 20:04:00', 10, 1),
(12, 'EJEMPLO 2', '2019-11-26 20:11:00', 10, 1),
(13, 'EJEMPLO 2', '2019-11-26 20:11:00', 10, 1),
(14, 'EJEMPLO 2', '2019-11-26 20:11:00', 10, 1),
(15, 'Tengo una duda sobre php', '2019-11-26 20:12:00', 10, 1),
(16, 'Tengo una duda sobre php', '2019-11-26 20:12:00', 10, 1),
(17, 'Responder al topic 14', '2019-11-28 19:07:00', 10, 1),
(18, 'responder al topic 14, prueba 2', '2019-11-28 19:08:00', 10, 1),
(20, 'contestando rapido', '2019-11-28 19:14:00', 10, 1),
(21, 'dime tu duda', '2019-11-28 19:16:00', 10, 1),
(22, 'Pues no lo se la verdad', '2019-11-28 19:16:00', 10, 1),
(23, 'respuesta', '2019-11-28 20:06:00', 10, 1),
(24, 'respuesta 2', '2019-11-28 20:06:00', 10, 1);

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
  `id_topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `messages_public`
--

INSERT INTO `messages_public` (`id_message`, `id_topic`) VALUES
(9, 14),
(10, 15),
(11, 16),
(12, 17),
(13, 18),
(14, 19),
(15, 20),
(16, 21),
(17, 14),
(18, 14),
(20, 14),
(21, 20),
(22, 20),
(23, 14),
(24, 14);

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
(14, 'titulo', '2019-11-26 19:35:00', 10, 1, 0, 4),
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
(1, 'disco', 'duro de roer', 'discoduroderoer', 'administrador@discoduroderoer.es', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2019-10-22', 'https://i.ibb.co/JcyLDjg/discoduroderoer-solo-Logo.png', 1, '2019-10-22 00:00:00', 0, 0),
(6, 'fer', 'fer', 'ddr', 'email@email.com', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2019-10-31', '', 2, '2019-10-31 20:09:00', 0, 0),
(7, 'ddr3', 'ddr3', 'ddr3', 'ddr3@ddr3.com', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2019-11-05', '', 2, '2019-11-05 19:22:00', 0, 0),
(8, 'ddr4', 'ddr4', 'ddr4', 'ddr4@ddr4.com', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2019-11-05', '', 2, '2019-11-05 19:37:00', 0, 0),
(9, 'ddr5', 'ddr5', 'ddr5', 'ddr5@ddr5.com', '6df1a9f518a73b3d978b1b753eba66b8e7c46cd117879faf585f4debe54ddd04467a9ad3a4ddc13dc04e32c852248807b6ac5aea136c11734cfda301411b4084', '2019-11-05', '', 2, '2019-11-05 19:39:00', 0, 1),
(10, 'Pepito', 'Perez', 'ddr6', 'ddr6@ddr6.com', '68c6932d39d733b092c9b998d0e0571ed2ac008f1ac8b7bc0ef65dd497bc89448d9bd755721dd61468dd151259a6d5ac3b87cef97223b341a48aa72ad4e77d1c', '2019-11-05', 'https://i.ibb.co/JcyLDjg/discoduroderoer-solo-Logo.png', 1, '2019-11-05 20:25:00', 0, 0);

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
  ADD KEY `fk_unread_messages_public_id_user` (`id_user`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `fk_messages_user_origin` FOREIGN KEY (`user_origin`) REFERENCES `messages` (`id`);

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
