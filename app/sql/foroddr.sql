-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2020 a las 21:01:45
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
(1, 'Inicio', '', 1, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories_child`
--

CREATE TABLE `categories_child` (
  `id_cat` int(11) NOT NULL,
  `id_cat_parent` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categories_child`
--

INSERT INTO `categories_child` (`id_cat`, `id_cat_parent`, `level`) VALUES
(1, 1, 1);

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
  `message_index` int(11) DEFAULT 1,
  `solution` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `borrado` int(11) NOT NULL,
  `verificado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Estructura de tabla para la tabla `users_activation`
--

CREATE TABLE `users_activation` (
  `id_user` int(11) NOT NULL,
  `user_key` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_remember`
--

CREATE TABLE `users_remember` (
  `id_user` int(11) NOT NULL,
  `user_key` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
-- Indices de la tabla `categories_child`
--
ALTER TABLE `categories_child`
  ADD PRIMARY KEY (`id_cat`,`id_cat_parent`);

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
-- Indices de la tabla `users_activation`
--
ALTER TABLE `users_activation`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `users_remember`
--
ALTER TABLE `users_remember`
  ADD PRIMARY KEY (`id_user`,`user_key`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_parent_cat` FOREIGN KEY (`parent_cat`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `categories_child`
--
ALTER TABLE `categories_child`
  ADD CONSTRAINT `fk_categories_id` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id`);

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

--
-- Filtros para la tabla `users_activation`
--
ALTER TABLE `users_activation`
  ADD CONSTRAINT `users_user_activation` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
