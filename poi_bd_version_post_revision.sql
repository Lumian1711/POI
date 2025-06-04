-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2025 a las 03:24:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `poi_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `id_chat` int(7) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Tipo` enum('Privado','Grupal','','') NOT NULL,
  `crea_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chats`
--

INSERT INTO `chats` (`id_chat`, `name`, `Tipo`, `crea_date`) VALUES
(1, 'Privado', 'Privado', '2025-05-20 19:49:10'),
(3, 'Los 3 amigos', 'Grupal', '2025-05-20 19:49:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id_mssg` int(8) NOT NULL,
  `id_chat` int(7) DEFAULT NULL,
  `id_sender` int(6) NOT NULL,
  `content` text NOT NULL,
  `mssg_type` enum('texto','imagen','audio','video') NOT NULL,
  `sndng_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `coded` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id_mssg`, `id_chat`, `id_sender`, `content`, `mssg_type`, `sndng_date`, `coded`) VALUES
(4, 1, 1, 'Hola!', '', '2025-04-08 21:46:19', 1),
(8, 1, 1, 'No reprobamos putooooo', '', '2025-04-09 02:16:25', 1),
(9, 1, 1, 'Hola, como estás?', '', '2025-05-20 16:02:30', 1),
(10, 1, 2, 'Ya dejame en paz Ana! ', '', '2025-05-20 16:03:13', 1),
(11, 1, 2, 'Oye, trajiste lonche?', '', '2025-05-20 17:27:30', 1),
(12, 1, 2, 'O qué vamos a comer?', '', '2025-05-20 17:29:43', 1),
(14, 1, 2, 'Eh, perro, si pasamos la materia?', '', '2025-05-20 23:12:45', 1),
(16, NULL, 2, 'Hola!', '', '2025-05-20 23:14:23', 1),
(17, NULL, 2, 'Hola!', '', '2025-05-20 23:14:32', 1),
(18, NULL, 2, 'Hola!', '', '2025-05-20 23:15:22', 1),
(27, 3, 2, 'Hola!', '', '2025-05-20 23:31:55', 1),
(28, 3, 2, 'Hola!', '', '2025-05-20 23:37:55', 1),
(29, 3, 2, 'Hola!', '', '2025-05-20 23:39:49', 1),
(30, 3, 1, 'bu', '', '2025-05-21 00:28:05', 1),
(31, 0, 1, 'bu x2', '', '2025-05-21 00:50:36', 1),
(32, 3, 1, 'bu x2', '', '2025-05-21 00:52:37', 1),
(33, 3, 1, 'bux3', '', '2025-05-21 00:58:28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rewards`
--

CREATE TABLE `rewards` (
  `id_reward` int(2) NOT NULL,
  `id_user` int(6) NOT NULL,
  `description` text NOT NULL,
  `givn_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id_task` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_creator` int(11) NOT NULL,
  `content` text NOT NULL,
  `stat` enum('pendiente','en progreso','completada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id_task`, `id_group`, `id_creator`, `content`, `stat`) VALUES
(7, 3, 1, 'Pasar POI', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(6) NOT NULL,
  `name` varchar(36) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `conn_stat` tinyint(1) NOT NULL,
  `regis_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `name`, `mail`, `password`, `conn_stat`, `regis_date`) VALUES
(1, 'MiguelOG', 'Mog1097@gmail.com', '$2y$10$OhD', 1, '2025-05-20 23:40:36'),
(2, 'SamCalig', 'Caligas@gmail.com', '$2y$10$.LR', 0, '2025-05-20 23:40:01'),
(3, 'Saturn1097', 'Saturn99@gmail.com', 'CaligasPro', 0, '2025-05-20 18:53:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_group`
--

CREATE TABLE `user_group` (
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_group`
--

INSERT INTO `user_group` (`id_user`, `id_group`, `join_date`) VALUES
(1, 1, '2025-05-20 18:55:51'),
(2, 1, '2025-05-20 18:55:51'),
(1, 3, '2025-05-20 19:57:44'),
(2, 3, '2025-05-20 19:57:44'),
(3, 3, '2025-05-20 19:57:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videochat`
--

CREATE TABLE `videochat` (
  `id_videochat` int(8) NOT NULL,
  `id_user1` int(6) NOT NULL,
  `id_user2` int(6) NOT NULL,
  `begin_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_mssg`),
  ADD KEY `messages_id_chat_id_chat` (`id_chat`),
  ADD KEY `messages_id_sender_id_user` (`id_sender`);

--
-- Indices de la tabla `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id_reward`),
  ADD KEY `reward_id_user` (`id_user`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `tasks_id_group_id_group` (`id_group`),
  ADD KEY `tasks_id_creator_id_user` (`id_creator`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `UNIQUE` (`mail`);

--
-- Indices de la tabla `user_group`
--
ALTER TABLE `user_group`
  ADD KEY `user_group_id_user_id_user` (`id_user`),
  ADD KEY `user_group_id_group_id_group` (`id_group`);

--
-- Indices de la tabla `videochat`
--
ALTER TABLE `videochat`
  ADD PRIMARY KEY (`id_videochat`),
  ADD KEY `videochat_id_user1_id_user` (`id_user1`),
  ADD KEY `videochat_id_user2_id_user` (`id_user2`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `id_chat` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id_mssg` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id_reward` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `videochat`
--
ALTER TABLE `videochat`
  MODIFY `id_videochat` int(8) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rewards`
--
ALTER TABLE `rewards`
  ADD CONSTRAINT `reward_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_id_group` FOREIGN KEY (`id_group`) REFERENCES `chats` (`id_chat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tasks_id_creator_id_user` FOREIGN KEY (`id_creator`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_id_group_id_group` FOREIGN KEY (`id_group`) REFERENCES `chats` (`id_chat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_group_id_user_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `videochat`
--
ALTER TABLE `videochat`
  ADD CONSTRAINT `videochat_id_user1_id_user` FOREIGN KEY (`id_user1`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `videochat_id_user2_id_user` FOREIGN KEY (`id_user2`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
