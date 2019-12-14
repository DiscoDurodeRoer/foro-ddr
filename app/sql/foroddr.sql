-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2019 a las 23:39:38
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
-- Base de data: `foroddr`
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
-- Volcado de data para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `parent_cat`, `icon`, `num_topics`) VALUES
(1, 'Programacion', 'Preguntas sobre programacion', 1, '', 0),
(2, 'Java', 'Preguntas sobre java', 1, '', 0),
(3, 'PHP', 'Preguntas sobre PHP', 1, '', 1),
(4, 'Ficheros', 'Preguntas de ficheros', 2, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8_spanish_ci NOT NULL,
  `date_creation` date NOT NULL,
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
  `id_topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `date_creation` date NOT NULL,
  `creator_user` int(11) NOT NULL,
  `open` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de data para la tabla `topics`
--

INSERT INTO `topics` (`id`, `title`, `date_creation`, `creator_user`, `open`, `views`, `id_cat`) VALUES
(1, '¡Problema con mi fichero!', '2019-10-22', 1, 1, 0, 4),
(7, 'problema fichero 2', '2019-10-24', 1, 1, 0, 3);

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
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nickname` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `registry_date` date NOT NULL,
  `avatar` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `last_connection` date NOT NULL,
  `baneado` int(11) NOT NULL,
  `borrado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de data para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `nickname`, `email`, `pass`, `registry_date`, `avatar`, `rol`, `last_connection`, `baneado`, `borrado`) VALUES
(1, 'disco', 'duro de roer', 'discoduroderoer', 'administrador@discoduroderoer.es', '123456', '2019-10-22', '', 0, '2019-10-22', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages_private`
--
ALTER TABLE `messages_private`
  ADD PRIMARY KEY (`id_message`);

--
-- Indices de la tabla `messages_public`
--
ALTER TABLE `messages_public`
  ADD PRIMARY KEY (`id_message`,`id_topic`);

--
-- Indices de la tabla `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
