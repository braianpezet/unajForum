-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2019 a las 02:12:18
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `unajforum`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `id_post`, `url`) VALUES
(1, 32, '../uploads/10wGWDs1-gJY6rZRMaL9qZnP_HCnJgdx.jpg'),
(2, 32, '../uploads/10wGWDs1-gJY6rZRMaL9qZnP_HCnJgdx.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Foro'),
(2, 'Carreras'),
(3, 'Ingresantes'),
(4, 'Off-topic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `contenido` varchar(256) NOT NULL,
  `votos` int(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `id_post`, `id_usuario`, `contenido`, `votos`, `fecha`) VALUES
(1, 2, 12, 'jajajaja', NULL, '2019-10-15 00:31:22'),
(2, 2, 12, 'te la kreiste wexd', NULL, '2019-10-15 00:31:22'),
(23, 2, 12, 'hola2', NULL, '2019-10-15 00:31:22'),
(24, 2, 12, 'hola2', NULL, '2019-10-15 00:31:22'),
(25, 2, 12, 'hola', NULL, '2019-10-15 00:31:22'),
(26, 2, 12, 'fcy', NULL, '2019-10-15 00:31:22'),
(27, 2, 12, 'hola', NULL, '2019-10-15 00:31:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `ID` int(11) NOT NULL,
  `ID_USER_EMISOR` int(11) NOT NULL,
  `ID_USER_RECEPTOR` int(11) NOT NULL,
  `NOTIFICACION` varchar(8000) DEFAULT NULL,
  `FECHA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visto` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`ID`, `ID_USER_EMISOR`, `ID_USER_RECEPTOR`, `NOTIFICACION`, `FECHA`, `visto`) VALUES
(2, 13, 12, 'QktXVU1HbVFvTWFvbnh6Y0Q5aDN3RmZ6VjlTbEVvRTBiUjl4YXVqd0prYz0=', '2019-10-16 15:22:18', b'1'),
(3, 13, 12, 'R1VhS1d4YmRUSHhsaDcrUFg4d1J4QkxYaDhRM1dCU3U4RGF4UmVUUDN2enFDUDJwaENSTTZiRVVISmRvbkwrUQ==', '2019-10-16 15:22:18', b'1'),
(4, 12, 13, 'aVdXZnplREY4STZsRTF6bm55c2hiUT09', '2019-10-16 15:24:25', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `des_corta` varchar(100) NOT NULL,
  `contenido` varchar(8000) NOT NULL,
  `megusta` int(255) DEFAULT NULL,
  `dislike` int(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visitas` int(255) NOT NULL,
  `post_picture` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `id_subcategoria`, `id_usuario`, `nombre`, `des_corta`, `contenido`, `megusta`, `dislike`, `fecha`, `visitas`, `post_picture`) VALUES
(1, 1, 12, 'Primer post', 'Esto seria un primer post', '<p>Post de prueba</p>\r\n', NULL, NULL, '2019-10-19 16:21:31', 59, '../uploads/N7qvujc7COrBgz8X_L35OwTcLXjc1SrJ.png'),
(2, 1, 12, 'Memes', 'Prueba descripcion corta', '<p><img alt=\"\" src=\"https://cdn.memegenerator.es/imagenes/memes/full/26/62/26626819.jpg\" style=\"height:349px; width:400px\" /></p>\r\n\r\n<p>u3u3u3uu3u3u3u3u3</p>\r\n', NULL, NULL, '2019-10-19 00:12:49', 31, ''),
(3, 1, 12, 'prueba con descripcion', 'Prueba descripcion corta', '<p>uhuiuih</p>\r\n', NULL, NULL, '2019-10-19 00:12:44', 11, ''),
(4, 1, 12, 'Prueba de creacion', 'Esto es una prueba', '<p><img alt=\"\" src=\"http://sabadodelacreacion.org/wp-content/uploads/2018/01/Ecologia-biodiversidad-y-creacion-un-enfoque-estructural.jpg\" style=\"height:418px; width:800px\" /></p>\r\n', NULL, NULL, '2019-10-17 21:11:11', 6, ''),
(5, 1, 12, 'Prueba de creacion 2', 'dwad', '<p>hvj</p>\r\n', NULL, NULL, '2019-10-19 00:12:41', 8, ''),
(6, 5, 12, 'Política de contenido', 'Aquí se hallan reglas que indican que contenido es el adecuado y cual no.', '<p><strong>Pol&iacute;tica de contenido y conducta del usuario</strong></p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Actividades ilegales</strong></p>\r\n\r\n	<p>No utilices nuestros servicios para realizar actividades ilegales ni fomentar aquellas que sean ilegales y peligrosas, como la venta de drogas ilegales o el tr&aacute;fico de personas.</p>\r\n\r\n	<p>Tambi&eacute;n podemos eliminar el contenido que infrinja las leyes locales aplicables.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Pr&aacute;cticas maliciosas y enga&ntilde;osas</strong></p>\r\n\r\n	<p>No se permite la distribuci&oacute;n de virus, de malware ni de cualquier otro tipo de c&oacute;digo destructivo o malintencionado. Tampoco se permite la distribuci&oacute;n de contenido que da&ntilde;e las redes, los servidores u otra infraestructura de Google o de terceros o que interfiera en el funcionamiento de dichos elementos. No utilices nuestros servicios para realizar estafas de suplantaci&oacute;n de identidad.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Incitaci&oacute;n al odio</strong></p>\r\n\r\n	<p>Nuestros productos son plataformas de libre expresi&oacute;n, pero no permitimos la incitaci&oacute;n al odio. El contenido que incita al odio es aquel que promueve o justifica la violencia, o cuyo fin principal es fomentar el odio hacia una persona o un grupo por su raza u origen &eacute;tnico, religi&oacute;n, discapacidad, edad, nacionalidad, condici&oacute;n de veterano, orientaci&oacute;n sexual, sexo, identidad de g&eacute;nero u otra caracter&iacute;stica que est&eacute; asociada a la discriminaci&oacute;n o marginalizaci&oacute;n sistem&aacute;ticas.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Acoso, intimidaci&oacute;n y amenazas</strong></p>\r\n\r\n	<p>No acoses, intimides ni muestres un comportamiento amenazante, ni incites a los dem&aacute;s a actuar as&iacute;. Cualquiera que use nuestros servicios para marginar a otras personas y abusar de ellas de forma maliciosa, amenazarlas con da&ntilde;os serios, para sexualizarlas de forma no deseada o para acosarlas de otras maneras se expone a que se elimine el contenido ofensivo o a que se le proh&iacute;ba permanentemente utilizar los Servicios. En situaciones de emergencia, es posible que las amenazas inminentes con da&ntilde;os graves se denuncien a las autoridades. Recuerda que el acoso online es ilegal en muchas jurisdicciones y puede tener graves consecuencias en la vida real, tanto para el acosador como para la v&iacute;ctima.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Informaci&oacute;n personal y confidencial</strong></p>\r\n\r\n	<p>No distribuyas datos personales ni confidenciales de otras personas, como n&uacute;meros de tarjetas de cr&eacute;dito, n&uacute;meros de identificaci&oacute;n nacional confidenciales ni contrase&ntilde;as de cuentas, sin su permiso. No publiques ni distribuyas im&aacute;genes o v&iacute;deos de menores de edad sin el consentimiento expreso de sus representantes legales.&nbsp;<a href=\"https://support.google.com/plus/troubleshooter/6080141?hl=es\">Denunciar una infracci&oacute;n</a></p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Explotaci&oacute;n infantil</strong></p>\r\n\r\n	<p>No subas ni compartas contenido que constituya explotaci&oacute;n infantil o abuso de menores. Esto incluye cualquier tipo de im&aacute;genes de abuso sexual de menores (incluidas im&aacute;genes de dibujos animados) y cualquier tipo de contenido en que se vea a menores en un contexto sexual. Retiraremos este tipo de contenido y emprenderemos las medidas necesarias, como la inhabilitaci&oacute;n de la cuenta, la denuncia al Centro Nacional para Menores Desaparecidos y Explotados (NCMEC) de los Estados Unidos y la aplicaci&oacute;n de la ley. Ten en cuenta que esta pol&iacute;tica tambi&eacute;n puede aplicarse a cualquier contenido subido o transmitido a trav&eacute;s de nuestros servicios.</p>\r\n\r\n	<p>Si detectas contenido que crees que constituye este tipo de explotaci&oacute;n infantil, no hagas +1, no lo compartas y no lo comentes (ni siquiera para notificarlo a Google). Lo que debes hacer es marcarlo a trav&eacute;s del enlace&nbsp;<a href=\"https://support.google.com/plus/answer/1253377?hl=es\" target=\"_blank\">Informar de uso indebido</a>. Si encuentras contenido de este tipo en otros sitios de Internet, ponte en contacto con el&nbsp;<a href=\"http://www.missingkids.com/home\" target=\"_blank\">NCMEC</a>&nbsp;directamente.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Spam</strong></p>\r\n\r\n	<p>No se permite el spam, incluido el env&iacute;o de contenido comercial o promocional indeseado, o convocatorias indeseadas o masivas.</p>\r\n\r\n	<p>No env&iacute;es invitaciones, a&ntilde;adas personas a tus c&iacute;rculos ni env&iacute;es mensajes a personas que no conozcas de forma agresiva.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Material sexualmente expl&iacute;cito</strong></p>\r\n\r\n	<p>No distribuyas material sexualmente expl&iacute;cito o pornogr&aacute;fico. Tampoco debes dirigir el tr&aacute;fico a sitios de pornograf&iacute;a comercial.</p>\r\n\r\n	<p>Permitimos representaciones naturalistas y documentales de la desnudez (como una imagen de un beb&eacute; amamantado), as&iacute; como representaciones de desnudez que tengan un prop&oacute;sito claramente educativo, cient&iacute;fico o art&iacute;stico.</p>\r\n\r\n	<p>Ten en cuenta que tu foto de perfil de Google+ no puede incluir contenido ofensivo o destinado a un p&uacute;blico adulto. Por ejemplo, no est&aacute; permitido el uso de fotos que muestren primeros planos de las nalgas o el escote de una persona.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Violencia</strong></p>\r\n\r\n	<p>No se debe publicar contenido violento o morboso que tenga como principal objeto el impacto o el sensacionalismo, o que sea innecesario. Si publicas contenido expl&iacute;cito en un contexto informativo, documental, cient&iacute;fico o art&iacute;stico, proporciona la informaci&oacute;n suficiente para que los usuarios puedan entender el contexto. En algunos casos, es posible que el contenido sea tan violento o impactante que, independientemente del contexto que se proporcione, se elimine de nuestras plataformas. Por &uacute;ltimo, no alientes a otros a cometer actos de violencia.</p>\r\n	</li>\r\n</ol>\r\n', NULL, NULL, '2019-10-17 21:11:18', 11, ''),
(8, 1, 12, 'Primer post', 'Aquí se hallan reglas que indican que contenido es el adecuado y cual no.', '<p>86r8</p>\r\n', NULL, NULL, '2019-10-19 00:12:46', 5, NULL),
(32, 1, 12, 'Memes', 'Prueba descripcion corta', '<p>kygui</p>\r\n', NULL, NULL, '2019-10-19 04:24:46', 29, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` int(11) NOT NULL,
  `id_categoria` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `id_categoria`, `nombre`) VALUES
(1, 2, 'Informatica'),
(2, 2, 'Petroleo'),
(3, 2, 'Salud'),
(4, 4, 'Musica'),
(5, 1, 'Reglas de la comunidad'),
(6, 1, 'Recomendaciones y sugerencias'),
(7, 1, 'Ayuda'),
(8, 1, 'Anuncios'),
(9, 1, 'Inscripciones'),
(10, 3, 'Inscripciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(250) NOT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `authKey` varchar(250) NOT NULL,
  `accessToken` varchar(250) NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT '0',
  `rol` int(11) NOT NULL DEFAULT '10',
  `verification_code` varchar(250) NOT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `extracto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_picture`, `authKey`, `accessToken`, `activate`, `rol`, `verification_code`, `fecha_de_nacimiento`, `extracto`) VALUES
(12, 'braianpezet', 'braianpezet@gmail.com', 'L01EdGV0UEdINjArM0ZjRU5Ta01qZz09', '../uploads/braianpezet.png', '3f6127d4c97ab7dcfc51fd1d55472693cb3e0680e7e30a47f0599c15d34e548a102b388d22d5d2b0d3361f46687450da0859782793fe2b5a4b9c7c14c5bb296611fba1816965b63a6d17894778b88f60d0f2cd2bc9098a01ce61d71fe5b82c4d01a0eceb', 'd6886198a2d3e61591f506700bf717dc24c9922bfe1c0cd11d9a0504d3301d0354eadac0649d0e745b7d2629655f0ff733f54470553626563304a8d3363b84ecadd95b81ef80218ab5de53d61179c39db27f7ab052b51340bd6a8a15d032dbc2fe751458', 1, 20, '', '1992-11-06', 'Estudiante de ingeniaria en informatica'),
(13, 'braianpezet2', 'braianpezet@hotmail.com', 'cXBUOHhVT2Z5RGxVSk1JbHo2a0RNQT09', NULL, '0161383e14cf2ab89a4a20fd3f741108ea16ffd0d26568995d36ee942eca09162424a0382460c1942cd9660cbbacfe43797988b5576b2cd230e4211773390021375657869fd988d4c4adbfbf24e65b936c6e39e7999e4335c7717fc35a3bbc5699bab241', 'd962908fbd300e1decad93bdae2782c4730a9f5e9fbd6608aba529041a88145e65d8231b9b0390f4590540d4ae57055b23ff6086f48e38305dc0b46b6b49d9fb356713fa5e6928261ce6be1e0ed66a221d6ec593da6eb6cc4f81b438a68cef9698ee9e11', 1, 20, '', '0000-00-00', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_USER_EMISOR` (`ID_USER_EMISOR`),
  ADD KEY `ID_USER_RECEPTOR` (`ID_USER_RECEPTOR`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subcategoria` (`id_subcategoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`ID_USER_EMISOR`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notificacion_ibfk_2` FOREIGN KEY (`ID_USER_RECEPTOR`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategoria` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
