-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2017 a las 06:26:29
-- Versión del servidor: 5.6.37-log
-- Versión de PHP: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gesol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_06_20_235936_create_roles_table', 1),
('2017_06_21_000022_create_usuarios_table', 1),
('2017_06_22_000035_create_solicitudes_table', 1),
('2017_06_23_000050_create_respuestas_table', 1),
('2017_07_18_231054_alter_usuarios', 2),
('2017_08_11_110355_alter_password_usuarios', 3),
('2017_08_23_224033_alter_email_usuarios', 4),
('2017_08_26_014905_alter_usuarios_rememberToken', 5),
('2017_09_24_195904_alter_respuestas_nombre_solicitud', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ing.acmartinez@gmail.com', '$2y$10$Emu5SiCP/VxhRTuCZfSZiOalob/543dHZskKG9v4Ca99gtw4nMI6i', '2017-11-14 14:53:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `res_id` int(10) UNSIGNED NOT NULL,
  `sol_nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `res_formato` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `res_fechaRespuesta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usu_cedula` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`res_id`, `sol_nombre`, `res_formato`, `res_fechaRespuesta`, `usu_cedula`) VALUES
(13, 'R-DC-14', '1046669700-R-DC-14No0.pdf', '2017-09-25 01:47:32', '1046669400'),
(14, 'R-DC-13', '1046669700-R-DC-13No1.pdf', '2017-09-27 22:23:48', '1046669400'),
(15, 'R-DC-13', '1046669700-R-DC-13No1.pdf', '2017-09-27 22:29:13', '1046669400'),
(16, 'R-DC-13', '1046669700-R-DC-13No2.pdf', '2017-09-28 01:05:18', '123434565'),
(17, 'R-DC-14', '2147483647-R-DC-14No0.pdf', '2017-10-11 17:08:29', '1046669400'),
(18, 'R-DC-13', '1046669700-R-DC-13No0.pdf', '2017-10-14 02:11:02', '1046669400'),
(19, 'R-DC-39', '0008877712345-R-DC-39No2.pdf', '2017-10-14 02:13:27', '1046669400'),
(20, 'R-DC-13', '2147483647-R-DC-13No0.pdf', '2017-11-04 23:43:22', '1046669400'),
(21, 'R-DC-40', '5480345-R-DC-40No0.pdf', '2017-11-14 14:29:38', '1046669400'),
(22, 'R-DC-13', '1046669700-R-DC-13No3.pdf', '2017-11-16 03:08:44', '23489328'),
(23, 'R-DC-13', '1046669700-R-DC-13No3.pdf', '2017-11-16 03:15:09', '23489328'),
(24, 'R-DC-13', '1046669700-R-DC-13No3.pdf', '2017-11-16 03:41:56', '23489328'),
(25, 'R-DC-13', '1046669700-R-DC-13No3.pdf', '2017-11-16 03:44:56', '23489328'),
(26, 'R-DC-13', '1046669700-R-DC-13No3.pdf', '2017-11-16 03:52:50', '23489328'),
(27, 'R-DC-13', '1046669700-R-DC-13No3.pdf', '2017-11-16 03:53:29', '23489328'),
(28, 'R-DC-13', '1046669700-R-DC-13No3.pdf', '2017-11-16 03:54:00', '23489328'),
(29, 'R-DC-40', '1046669700-R-DC-40No0.pdf', '2017-11-16 04:32:47', '10937746'),
(30, 'R-DC-13', '1046669700-R-DC-13No4.pdf', '2017-11-16 05:04:40', '23489328'),
(31, 'R-DC-13', '1046669700-R-DC-13No4.pdf', '2017-11-16 05:05:49', '1046669400'),
(32, 'R-DC-13', '1046669700-R-DC-13No4.pdf', '2017-11-16 05:11:21', '10937746');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` int(10) UNSIGNED NOT NULL,
  `rol_nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `rol_descripcion` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `rol_nombre`, `rol_descripcion`) VALUES
(1, 'Estudiante', 'Rol predeterminado. Permite crear solicitudes solamente.'),
(2, 'Secretaria', 'Permite únicamente responder solicitudes. '),
(3, 'Coordinador', 'Permite administrar todas las entidades: crear, editar y eliminar usuarios, solicitudes y respuestas, a la vez que cambiar el rol de cualquier usuario a voluntad y ver gráficos de rendimiento.'),
(4, 'Decano', 'Rol para permitir a los Decanos responder los apartados que les pertenecen para algunas solicitudes'),
(5, 'Docente', 'Rol para permitir a los Docentes responder los apartados que les pertenecen para algunas solicitudes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `sol_id` int(10) UNSIGNED NOT NULL,
  `sol_nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sol_formato` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sol_fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sol_estado` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `usu_cedula` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`sol_id`, `sol_nombre`, `sol_formato`, `sol_fechaCreacion`, `sol_estado`, `usu_cedula`) VALUES
(2, 'R-DC-39', '0008877712345-R-DC-39No1.pdf', '2017-09-09 03:44:15', 'Atendida', '0008877712345'),
(3, 'R-DC-39', '0008877712345-R-DC-39No2.pdf', '2017-09-09 03:48:14', 'Atendida', '0008877712345'),
(4, 'R-DC-39', '0008877712345-R-DC-39No3.pdf', '2017-09-09 03:50:54', 'Atendida', '0008877712345'),
(5, 'R-DC-39', '0008877712345-R-DC-39No4.pdf', '2017-09-09 04:01:28', 'Atendida', '0008877712345'),
(6, 'R-DC-39', '0008877712345-R-DC-39No5.pdf', '2017-09-09 04:01:58', 'Atendida', '0008877712345'),
(7, 'R-DC-39', '0008877712345-R-DC-39No6.pdf', '2017-09-09 04:02:13', 'Pendiente', '0008877712345'),
(8, 'R-DC-39', '0008877712345-R-DC-39No7.pdf', '2017-09-09 04:07:35', 'Pendiente', '0008877712345'),
(9, 'R-DC-39', '0008877712345-R-DC-39No8.pdf', '2017-09-09 04:08:07', 'Pendiente', '0008877712345'),
(10, 'R-DC-39', '1046669700-R-DC-39No0.pdf', '2017-09-09 05:19:42', 'Pendiente', '1046669700'),
(11, 'R-DC-39', '1046669700-R-DC-39No1.pdf', '2017-09-09 05:27:11', 'Pendiente', '1046669700'),
(12, 'R-DC-39', '1046669700-R-DC-39No2.pdf', '2017-09-09 05:44:33', 'Pendiente', '1046669700'),
(13, 'R-DC-39', '1046669700-R-DC-39No3.pdf', '2017-09-09 05:45:51', 'Pendiente', '1046669700'),
(14, 'R-DC-39', '1046669700-R-DC-39No4.pdf', '2017-09-09 05:46:55', 'Pendiente', '1046669700'),
(15, 'R-DC-39', '1046669700-R-DC-39No5.pdf', '2017-09-09 05:48:36', 'Pendiente', '1046669700'),
(16, 'R-DC-39', '1046669700-R-DC-39No6.pdf', '2017-09-09 05:55:20', 'Pendiente', '1046669700'),
(17, 'R-DC-39', '1046669700-R-DC-39No7.pdf', '2017-09-09 06:05:07', 'Pendiente', '1046669700'),
(18, 'R-DC-39', '1046669700-R-DC-39No8.pdf', '2017-09-09 06:27:53', 'Pendiente', '1046669700'),
(19, 'R-DC-39', '1046669700-R-DC-39No9.pdf', '2017-09-09 06:28:39', 'Pendiente', '1046669700'),
(20, 'R-DC-39', '0008877712345-R-DC-39No9.pdf', '2017-09-12 14:49:15', 'Pendiente', '0008877712345'),
(21, 'R-DC-39', '1046669700-R-DC-39No10.pdf', '2017-09-13 20:53:05', 'Pendiente', '1046669700'),
(22, 'R-DC-39', '1046669700-R-DC-39No11.pdf', '2017-09-13 20:53:48', 'Pendiente', '1046669700'),
(23, 'R-DC-39', '1046669700-R-DC-39No12.pdf', '2017-09-13 20:57:15', 'Pendiente', '1046669700'),
(24, 'R-DC-39', '1046669700-R-DC-39No13.pdf', '2017-09-13 21:07:07', 'Pendiente', '1046669700'),
(25, 'R-DC-39', '1046669700-R-DC-39No14.pdf', '2017-09-13 21:09:55', 'Pendiente', '1046669700'),
(26, 'R-DC-39', '1046669700-R-DC-39No15.pdf', '2017-09-18 20:02:33', 'Pendiente', '1046669700'),
(27, 'R-DC-13', '1046669700-R-DC-13No0.pdf', '2017-09-19 00:10:16', 'Atendida', '1046669700'),
(28, 'R-DC-13', '1046669700-R-DC-13No1.pdf', '2017-09-20 18:40:36', 'Atendida', '1046669700'),
(29, 'R-DC-13', '1046669700-R-DC-13No2.pdf', '2017-09-20 18:53:05', 'Atendida', '1046669700'),
(30, 'R-DC-14', '1046669700-R-DC-14No0.pdf', '2017-09-20 22:33:51', 'Atendida', '1046669700'),
(31, 'R-DC-39', '1046669700-R-DC-39No16.pdf', '2017-09-21 12:58:42', 'Pendiente', '1046669700'),
(32, 'R-DC-14', '2147483647-R-DC-14No0.pdf', '2017-09-27 21:42:26', 'Atendida', '2147483647'),
(33, 'R-DC-13', '2147483647-R-DC-13No0.pdf', '2017-10-14 02:51:28', 'Atendida', '2147483647'),
(34, 'R-DC-14', '2147483647-R-DC-14No1.pdf', '2017-10-14 02:53:44', 'Pendiente', '2147483647'),
(35, 'R-DC-39', '2147483647-R-DC-39No0.pdf', '2017-11-04 23:41:09', 'Pendiente', '2147483647'),
(36, 'R-DC-40', '5480345-R-DC-40No0.pdf', '2017-11-14 14:26:58', 'Atendida', '5480345'),
(37, 'R-DC-13', '5480345-R-DC-13No0.pdf', '2017-11-14 14:39:19', 'Pendiente', '5480345'),
(38, 'R-DC-13', '1046669700-R-DC-13No3.pdf', '2017-11-16 03:02:58', 'Atendida', '1046669700'),
(39, 'R-DC-40', '1046669700-R-DC-40No0.pdf', '2017-11-16 04:30:20', 'Atendida', '1046669700'),
(40, 'R-DC-13', '1046669700-R-DC-13No4.pdf', '2017-11-16 05:00:54', 'Atendida', '1046669700');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_cedula` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `usu_nombres` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usu_apellidos` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usu_genero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `usu_fechaNac` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sin Fecha',
  `usu_telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'defecto',
  `rol_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_cedula`, `usu_nombres`, `usu_apellidos`, `usu_genero`, `usu_fechaNac`, `usu_telefono`, `email`, `password`, `rol_id`, `remember_token`) VALUES
('0008877712345', 'carlos', 'osorio', 'Masculino', '2017-08-31', '2342242342', 'carlososorio@hotmail.com', '$2y$10$.OCAJamJbyq8FcF24EXFquwY81auE5oicidGQZrZB6/dXeJsTE0qG', 1, NULL),
('0990000909', 'miNombre', 'miApellido', 'Masculino', '2017-08-08', '0098090009', 'correo@mail.com', '$2y$10$EEKMUBMxq9AIzzP/iBH7metopBZeMnJY70JDqelRSIgTpPdrWWKzS', 1, NULL),
('1046669400', 'Juan Emmanuel', 'Martínez Gómez', 'Masculino', '2017-08-09', '3146511445', 'jemmanuelmg@hotmail.com', '$2y$10$8LsO8yBRaQseQ3fYVCBrO.tbAjlEQI.pX..IURPv3uBebbhFEJEum', 3, 'McQoiXBn7QqiYnJ8QMq6Cf5E2Sf6sDQnY2kC00vLY8XVcKC9vIMpEizNgrQz'),
('1046669700', 'Juan Emmanuel', 'Segundo Segundo', 'Masculino', '2017-09-05', '3146511445', 'juanemargo98@gmail.com', '$2y$10$3BADsxuXq97n2yU4LGENaOtQqrBAxmEvDwuONOx4iW8A91K60ng76', 1, 'z1jRBusUY4f9JiZFMbC02Wj3XGmoLWOv1RfTZj73r5OOSleROAb0ziv0NPSO'),
('10937746', 'Vladimir', 'Putin', 'Masculino', '2017-11-08', '45983598', 'vladimir@mail.com', '$2y$10$waNTVqulkVfOxoJeqgTMaukGXtWMQlUcNq/zyGquTxeyNmYyyMIOi', 4, 'yhZ3C1pYh7wc4PI7GAHmuub7rFaAMlIXJqsuN2crSRnkzj2lTO9OqYSiujr3'),
('1098781249', 'Jhor Jassler', 'Ballesteros Herrera', 'Masculino', '2017-09-14', '3146511445', 'jhor_9602@hotmail.com', '$2y$10$KZfk.D6not.Dm6ETQ1FjuOUmM4aKooktc0Piw1QpeVDWxiOIlEVEW', 3, NULL),
('123434565', 'Diana Maria', 'Mendoza Arias', 'Femenino', '2017-09-06', '3146512436', 'diana@hotmail.com', '$2y$10$pBYB4S9BLVDf08a.b/o97uRmxL/iSIVdXYxm37qDb4mc21YvLfqeO', 2, 'SSeEcVMJz1C3MZ9kghLRWqcHURsb1u96I3dbrDf8iQYLpvujxelNCOQSvCPw'),
('2147483647', 'Alexandra', 'Rivas', 'Femenino', '2017-09-27', '83240924398', 'alexarivas@hotmail.com', '$2y$10$tBN/E5eKia6VyoeI6oES5usigMBUv8HFhFH7Pmdjj5PDG9PxbcZs.', 1, 'p4GS3obmOwAQWIp3Y3ZkBXed91NELaUNUrGDehmahqp1z8Au1RoU8ThDelap'),
('23489328', 'Eduardo Mauricio', 'Cañas', 'Masculino', '2017-11-17', '12434234', 'eduardo@mail.com', '$2y$10$3BADsxuXq97n2yU4LGENaOtQqrBAxmEvDwuONOx4iW8A91K60ng76', 5, '0gKwna2CaMhBaIVm8ju3XIOhqjUljDPiJwlmnKUtaeiyF0ITXJlW0Y2Jp2A8'),
('5480345', 'Andrea', 'Martinez', 'Femenino', '2017-11-08', '454566546', 'ing.acmartinez@gmail.com', '$2y$10$oDmsIeevGKvK8ntXxUomPerebX.krel7xWQh4HvSraAorkF9qA9/W', 1, 'R22AtgVqfuD2zOumuvyMbHsBTetyn6ryhGcHmB0VTnXnKCZS6exQZDhgvOew'),
('88989988', 'Jhon', 'Garay', 'Femenino', '2017-09-06', '898983299', 'niggAray@gmail.com', '$2y$10$WlPyz5Flrrc9LPc/7CkvP.SLZZui/YShbzn2dNdt0xoxm9cEpVpim', 1, NULL),
('898989111', 'Petyr', 'Baelish', 'Masculino', '2017-09-06', '1233333', 'littleFinger@hotmail.com', '$2y$10$GiRbAO7VECpUySUTplIuKuIGaqT/fWfjvGgaRE1QDUOu5YJj6MFMS', 1, NULL),
('9090009090', 'Jhon', 'Garay', 'Masculino', '2017-09-12', '1928981928', 'negrojuicioso@hotmail.com', '$2y$10$Q01gsgU4CtQG3cOBPxsYj..KdUt0xH7brmRpPWi56uFUdy2/ZC5t6', 1, NULL),
('91919191999', 'Daeneris', 'Targaryen', 'Femenino', '2017-08-08', '9834984949', 'FireAndBlood@hotmail.com', '$2y$10$mXKscGAIxANOIDYBCnR2MujVvL22k8r1STpzQQUohV81Ml3AycHz6', 1, NULL),
('98989899999', 'Aegon', 'Targaryen', 'Masculino', '2017-09-06', '1252999', 'correo@hotmail.com', '$2y$10$.c6fqVKXzZdktEaR374/1uLjVwNDzgl0gMPoyoTu8g4iidP1gN9fG', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `respuestas_usu_cedula_foreign` (`usu_cedula`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`sol_id`),
  ADD KEY `solicitudes_usu_cedula_foreign` (`usu_cedula`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `usuarios_usu_cedula_unique` (`usu_cedula`),
  ADD UNIQUE KEY `usu_correo` (`email`),
  ADD KEY `usuarios_rol_id_foreign` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `res_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `sol_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_usu_cedula_foreign` FOREIGN KEY (`usu_cedula`) REFERENCES `usuarios` (`usu_cedula`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_usu_cedula_foreign` FOREIGN KEY (`usu_cedula`) REFERENCES `usuarios` (`usu_cedula`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
