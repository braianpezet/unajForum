-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2019 a las 21:06:32
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
(2, 32, '../uploads/10wGWDs1-gJY6rZRMaL9qZnP_HCnJgdx.jpeg'),
(3, 2, '../uploads/v-rmrUusRLNwFQo8glDGm4Tn5KTPebWh.jpeg'),
(4, 2, '../uploads/v-rmrUusRLNwFQo8glDGm4Tn5KTPebWh.jpg'),
(11, 6, '../uploads/Politica de descargas.pdf'),
(12, 6, '../uploads/Politica de seguridad.docx');

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
  `megusta` int(255) NOT NULL,
  `dislike` int(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `id_post`, `id_usuario`, `contenido`, `megusta`, `dislike`, `fecha`) VALUES
(1, 6, 12, 'Muy bueno', 14, 2, '2019-10-26 03:02:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE `etiqueta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`id`, `nombre`) VALUES
(1, 'Fisica'),
(2, 'Matematica III'),
(11, 'youtube'),
(12, 'Politica'),
(13, 'Seguridad'),
(14, 'Reglas'),
(15, 'Comunidad'),
(16, 'tiempo'),
(17, 'real'),
(18, 'ingenieria'),
(19, '2020'),
(20, 'ingresante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta_post`
--

CREATE TABLE `etiqueta_post` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_etiqueta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `etiqueta_post`
--

INSERT INTO `etiqueta_post` (`id`, `id_post`, `id_etiqueta`) VALUES
(1, 40, 1),
(2, 40, 2),
(3, 39, 1),
(4, 6, 12),
(5, 6, 13),
(6, 6, 14),
(7, 6, 15);

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
(4, 12, 13, 'aVdXZnplREY4STZsRTF6bm55c2hiUT09', '2019-10-24 14:09:53', b'1');

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
  `megusta` int(255) NOT NULL,
  `dislike` int(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visitas` int(255) NOT NULL,
  `post_picture` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `id_subcategoria`, `id_usuario`, `nombre`, `des_corta`, `contenido`, `megusta`, `dislike`, `fecha`, `visitas`, `post_picture`) VALUES
(6, 5, 12, 'Política de contenido', 'Aquí se hallan reglas que indican que contenido es el adecuado y cual no.', '<p><strong>Pol&iacute;tica de contenido y conducta del usuario</strong></p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Actividades ilegales</strong></p>\r\n\r\n	<p>No utilices nuestros servicios para realizar actividades ilegales ni fomentar aquellas que sean ilegales y peligrosas, como la venta de drogas ilegales o el tr&aacute;fico de personas.</p>\r\n\r\n	<p>Tambi&eacute;n podemos eliminar el contenido que infrinja las leyes locales aplicables.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Pr&aacute;cticas maliciosas y enga&ntilde;osas</strong></p>\r\n\r\n	<p>No se permite la distribuci&oacute;n de virus, de malware ni de cualquier otro tipo de c&oacute;digo destructivo o malintencionado. Tampoco se permite la distribuci&oacute;n de contenido que da&ntilde;e las redes, los servidores u otra infraestructura de Google o de terceros o que interfiera en el funcionamiento de dichos elementos. No utilices nuestros servicios para realizar estafas de suplantaci&oacute;n de identidad.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Incitaci&oacute;n al odio</strong></p>\r\n\r\n	<p>Nuestros productos son plataformas de libre expresi&oacute;n, pero no permitimos la incitaci&oacute;n al odio. El contenido que incita al odio es aquel que promueve o justifica la violencia, o cuyo fin principal es fomentar el odio hacia una persona o un grupo por su raza u origen &eacute;tnico, religi&oacute;n, discapacidad, edad, nacionalidad, condici&oacute;n de veterano, orientaci&oacute;n sexual, sexo, identidad de g&eacute;nero u otra caracter&iacute;stica que est&eacute; asociada a la discriminaci&oacute;n o marginalizaci&oacute;n sistem&aacute;ticas.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Acoso, intimidaci&oacute;n y amenazas</strong></p>\r\n\r\n	<p>No acoses, intimides ni muestres un comportamiento amenazante, ni incites a los dem&aacute;s a actuar as&iacute;. Cualquiera que use nuestros servicios para marginar a otras personas y abusar de ellas de forma maliciosa, amenazarlas con da&ntilde;os serios, para sexualizarlas de forma no deseada o para acosarlas de otras maneras se expone a que se elimine el contenido ofensivo o a que se le proh&iacute;ba permanentemente utilizar los Servicios. En situaciones de emergencia, es posible que las amenazas inminentes con da&ntilde;os graves se denuncien a las autoridades. Recuerda que el acoso online es ilegal en muchas jurisdicciones y puede tener graves consecuencias en la vida real, tanto para el acosador como para la v&iacute;ctima.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Informaci&oacute;n personal y confidencial</strong></p>\r\n\r\n	<p>No distribuyas datos personales ni confidenciales de otras personas, como n&uacute;meros de tarjetas de cr&eacute;dito, n&uacute;meros de identificaci&oacute;n nacional confidenciales ni contrase&ntilde;as de cuentas, sin su permiso. No publiques ni distribuyas im&aacute;genes o v&iacute;deos de menores de edad sin el consentimiento expreso de sus representantes legales.&nbsp;<a href=\"https://support.google.com/plus/troubleshooter/6080141?hl=es\">Denunciar una infracci&oacute;n</a></p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Explotaci&oacute;n infantil</strong></p>\r\n\r\n	<p>No subas ni compartas contenido que constituya explotaci&oacute;n infantil o abuso de menores. Esto incluye cualquier tipo de im&aacute;genes de abuso sexual de menores (incluidas im&aacute;genes de dibujos animados) y cualquier tipo de contenido en que se vea a menores en un contexto sexual. Retiraremos este tipo de contenido y emprenderemos las medidas necesarias, como la inhabilitaci&oacute;n de la cuenta, la denuncia al Centro Nacional para Menores Desaparecidos y Explotados (NCMEC) de los Estados Unidos y la aplicaci&oacute;n de la ley. Ten en cuenta que esta pol&iacute;tica tambi&eacute;n puede aplicarse a cualquier contenido subido o transmitido a trav&eacute;s de nuestros servicios.</p>\r\n\r\n	<p>Si detectas contenido que crees que constituye este tipo de explotaci&oacute;n infantil, no hagas +1, no lo compartas y no lo comentes (ni siquiera para notificarlo a Google). Lo que debes hacer es marcarlo a trav&eacute;s del enlace&nbsp;<a href=\"https://support.google.com/plus/answer/1253377?hl=es\" target=\"_blank\">Informar de uso indebido</a>. Si encuentras contenido de este tipo en otros sitios de Internet, ponte en contacto con el&nbsp;<a href=\"http://www.missingkids.com/home\" target=\"_blank\">NCMEC</a>&nbsp;directamente.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Spam</strong></p>\r\n\r\n	<p>No se permite el spam, incluido el env&iacute;o de contenido comercial o promocional indeseado, o convocatorias indeseadas o masivas.</p>\r\n\r\n	<p>No env&iacute;es invitaciones, a&ntilde;adas personas a tus c&iacute;rculos ni env&iacute;es mensajes a personas que no conozcas de forma agresiva.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Material sexualmente expl&iacute;cito</strong></p>\r\n\r\n	<p>No distribuyas material sexualmente expl&iacute;cito o pornogr&aacute;fico. Tampoco debes dirigir el tr&aacute;fico a sitios de pornograf&iacute;a comercial.</p>\r\n\r\n	<p>Permitimos representaciones naturalistas y documentales de la desnudez (como una imagen de un beb&eacute; amamantado), as&iacute; como representaciones de desnudez que tengan un prop&oacute;sito claramente educativo, cient&iacute;fico o art&iacute;stico.</p>\r\n\r\n	<p>Ten en cuenta que tu foto de perfil de Google+ no puede incluir contenido ofensivo o destinado a un p&uacute;blico adulto. Por ejemplo, no est&aacute; permitido el uso de fotos que muestren primeros planos de las nalgas o el escote de una persona.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Violencia</strong></p>\r\n\r\n	<p>No se debe publicar contenido violento o morboso que tenga como principal objeto el impacto o el sensacionalismo, o que sea innecesario. Si publicas contenido expl&iacute;cito en un contexto informativo, documental, cient&iacute;fico o art&iacute;stico, proporciona la informaci&oacute;n suficiente para que los usuarios puedan entender el contexto. En algunos casos, es posible que el contenido sea tan violento o impactante que, independientemente del contexto que se proporcione, se elimine de nuestras plataformas. Por &uacute;ltimo, no alientes a otros a cometer actos de violencia.</p>\r\n	</li>\r\n</ol>\r\n', 15, 8, '2019-10-27 20:03:50', 271, '../uploads/iLSjxra6WXBnfqvlvXDa5IxW3wSr4M5N.jpg'),
(35, 1, 12, '[Duda] Ejercicio de programación en tiempo real', 'Ejercicio 2 practica 3', '<p>Hola comunidad no estoy entendiendo bien como se hace este ejercicio</p>\r\n\r\n<p><img alt=\"\" src=\"https://imgur.com/a/qO6Euan\" /><img alt=\"\" src=\"https://i.imgur.com/36uuSyG.png\" style=\"height:445px; width:676px\" /></p>\r\n\r\n<p>Les agradeceria su ayudo</p>\r\n', 1, 0, '2019-10-27 20:03:38', 100, '../uploads/dE6t9oVqr_M3D1XHEdrHlXxPv9QN-5Nr.jpg'),
(36, 1, 12, 'Prueba con tags', 'Estoy un poco cansado ', '<p>sera que anda&nbsp;ejercicio clave</p>\r\n', 1, 0, '2019-10-25 17:00:06', 44, '../uploads/Raio44urNkRHq_6XGlVfLhJze6ITqgHz.png'),
(37, 10, 12, 'Inscripcion Ciclo Lectivo 2020', 'Pasos para la inscripcion', '<p>Inscripci&oacute;n Ciclo Lectivo 2020<br />\r\nDel 15 de octubre al 15 de noviembre de 2019</p>\r\n\r\n<p>Los pasos para la inscripci&oacute;n son:</p>\r\n\r\n<p>clave</p>\r\n\r\n<p>Completar el Formulario de Pre-Inscripci&oacute;n ingresando&nbsp;aqu&iacute; &gt;&gt;</p>\r\n\r\n<p>Desde el mismo Formulario&nbsp;elegir turno para traer la documentaci&oacute;n.</p>\r\n\r\n<p>C&oacute;mo completar el Formulario de Pre- Inscripci&oacute;n:</p>\r\n\r\n<p>Es necesario tener una direcci&oacute;n de correo electr&oacute;nico activa.</p>\r\n\r\n<p>Ingres&aacute; al link de Inscripci&oacute;n que figura en la p&aacute;gina&nbsp;www.unaj.edu.ar</p>\r\n\r\n<p>All&iacute; encontrar&aacute;s el acceso al Formulario. Ingres&aacute; donde dice &ldquo;Registrate&rdquo; y complet&aacute; los datos solicitados.</p>\r\n\r\n<p>Tu&nbsp;usuario&nbsp;ser&aacute; la direcci&oacute;n de tu correo electr&oacute;nico, agend&aacute; bien la&nbsp;contrase&ntilde;a.</p>\r\n\r\n<p>Una vez finalizada la Registraci&oacute;n, el sistema te enviar&aacute; a tu correo electr&oacute;nico la confirmaci&oacute;n a trav&eacute;s de un link (este correo puede llegar a tu bandeja de entrada o a la de Spam o Correo No deseado).</p>\r\n\r\n<p>Hac&eacute; click en el link recibido e ingresar&aacute;s al Formulario de Pre-inscripci&oacute;n.</p>\r\n\r\n<p>Deb&eacute;s completar cada solapa. Y subir la documentaci&oacute;n al sistema.</p>\r\n\r\n<p>Cuando completes todos los datos ingres&aacute; a la solapa &ldquo;Turno para traer la documentaci&oacute;n&rdquo;, eleg&iacute; desde el almanaque el d&iacute;a y la hora para acercarte a la UNAJ.</p>\r\n\r\n<p>El d&iacute;a del turno elegido, entregar en la Universidad la documentaci&oacute;n que a continuaci&oacute;n se indica. La Sede Central de la UNAJ est&aacute; ubicada en la Av. Calchaqu&iacute; 6200 (ex Laboratorios YPF), Florencio Varela. Hall de entrada. All&iacute; chequearemos la documentaci&oacute;n y te derivaremos al mostrador del Departamento de Alumnos.</p>\r\n\r\n<p>Estudiantes con discapacidad:&nbsp;Es importante que completes la solapa y la informaci&oacute;n que solicitamos para poder brindarte la asistencia adecuada para que estudies y asistas a la UNAJ.<br />\r\nAl traer la documentaci&oacute;n, en el turno correspondiente, te pediremos que completes una planilla con tus datos, a partir de la cual nos comunicaremos con vos para una entrevista individual.<br />\r\nLos ingresantes con discapacidad auditiva y con discapacidad visual&nbsp;realizar&aacute;n actividades de lectura y escritura con fines diagn&oacute;sticos. As&iacute; podremos conocer sus capacidades y brindarle a cada uno los apoyos necesarios al comenzar las clases.<br />\r\nLas fechas de la entrevista y de las actividades ser&aacute;n informadas oportunamente.</p>\r\n\r\n<p>Documentaci&oacute;n a presentar</p>\r\n\r\n<p>Formulario de Pre-Inscripci&oacute;n.&nbsp;Ultima versi&oacute;n impresa firmada.</p>\r\n\r\n<p>Foto digital.&nbsp;La misma se carga al formulario de Pre-inscripci&oacute;n&nbsp;(no se requiere en papel).</p>\r\n\r\n<p>T&iacute;tulo Secundario (original y copia). Si fue emitido antes del 2010 debe estar legalizado por el Ministerio del Interior y Transporte de la Naci&oacute;n Argentina. Aqu&iacute; te mostramos un ejemplo del Sello que tiene que figurar al dorso de tu t&iacute;tulo:</p>\r\n\r\n<p>Para la legalizaci&oacute;n debes solicitar turno en la p&aacute;gina del Ministerio del Interior, Transporte y Vivienda. Este tr&aacute;mite es gratuito y se realiza en la siguiente direcci&oacute;n:</p>\r\n\r\n<p>CABA<br />\r\nDirecci&oacute;n: Av. Leandro N. Alem 150 1&ordm; Piso / 25 de Mayo 155<br />\r\nTel&eacute;fono: (011) 4339-0800 &ndash; Internos: 71958 / 71960<br />\r\nHorario de atenci&oacute;n: de 8 a 17:30 hs.</p>\r\n\r\n<p>Si fue emitido a partir del 2010 debe constar la legalizaci&oacute;n de la jurisdicci&oacute;n que lo emite.</p>\r\n\r\n<p>Si a&uacute;n no cont&aacute;s con el t&iacute;tulo&nbsp;deb&eacute;s presentar el&nbsp;Certificado de T&iacute;tulo en Tr&aacute;mite. Tendr&aacute;s tiempo para entregarlo en las siguientes fechas:</p>\r\n\r\n<p>Para ingresar a cursar el primer cuatrimestre: Plazo m&aacute;ximo: 13/03/2020.<br />\r\nPara ingresar a cursar el segundo cuatrimestre: Plazo m&aacute;ximo: 09/08/2020.</p>\r\n\r\n<p>Si est&aacute;s cursando el &uacute;ltimo a&ntilde;o del nivel secundario, deb&eacute;s traer el certificado de alumno regular emitido por la instituci&oacute;n escolar a la que asist&iacute;s donde conste que sos alumno/a del &uacute;ltimo a&ntilde;o.</p>\r\n\r\n<p>Respecto del PLAN FINES, s&oacute;lo podr&aacute;n inscribirse quienes est&eacute;n cursando 3ro. 2da y tambi&eacute;n deber&aacute;n traer certificado que indique que est&aacute;n cursando ese nivel.</p>\r\n\r\n<p>En caso de haber realizado el secundario en el extranjero,&nbsp;deber&aacute;s presentar, tambi&eacute;n la Convalidaci&oacute;n o laconstancia de convalidaci&oacute;n en tr&aacute;mite.del Titulo Secundario del Ministerio de Educaci&oacute;n de la Naci&oacute;n Argentina.(Original y fotocopia).<br />\r\nInf&oacute;rmate en :http://portales.educacion.gov.ar/vnt/estudios-extranjeros-2/</p>\r\n\r\n<p>Estudiantes extranjeros de origen de habla no hispana deber&aacute;n presentar el Certificado de Espa&ntilde;ol: Lengua y uso CELU nivel intermedio. Para m&aacute;s informaci&oacute;n ingresar a&nbsp;celu.edu.ar. La no presentaci&oacute;n de dicho certificado es excluyente.</p>\r\n\r\n<p>Documento Nacional de Identidad &ndash; DNI. Solo se aceptar&aacute; Dni Digital. (original y fotocopia).</p>\r\n\r\n<p>En caso de extranjeros, deber&aacute;n presentar residencia precaria, parcial o definitiva.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 0, 0, '2019-10-24 03:20:16', 7, '../uploads/DXLSc-ZQuNRiro70sOyNSC-1zCRcR5q3.jpg'),
(38, 1, 12, 'ayudaaa con tarea de fisica', 'fisica 2', '<p>iwjaodiw</p>\r\n', 0, 1, '2019-10-27 20:06:00', 16, NULL),
(39, 1, 12, 'ayudaaa con tarea de fisica', 'fisica 2', '<p>iwjaodiw clave</p>\r\n', 0, 0, '2019-10-25 03:54:30', 19, NULL),
(40, 1, 12, 'ayudaaa con tarea de fisica', 'fisica 2', '<p>iwjaodiw</p>\r\n', 0, 0, '2019-10-26 03:03:46', 9, NULL);

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
(12, 'braianpezet', 'braianpezet@gmail.com', 'L01EdGV0UEdINjArM0ZjRU5Ta01qZz09', '../uploads/braianpezet.jpg', '3f6127d4c97ab7dcfc51fd1d55472693cb3e0680e7e30a47f0599c15d34e548a102b388d22d5d2b0d3361f46687450da0859782793fe2b5a4b9c7c14c5bb296611fba1816965b63a6d17894778b88f60d0f2cd2bc9098a01ce61d71fe5b82c4d01a0eceb', 'd6886198a2d3e61591f506700bf717dc24c9922bfe1c0cd11d9a0504d3301d0354eadac0649d0e745b7d2629655f0ff733f54470553626563304a8d3363b84ecadd95b81ef80218ab5de53d61179c39db27f7ab052b51340bd6a8a15d032dbc2fe751458', 1, 10, '', '1992-11-06', 'Estudiante de ingeniaria en informatica'),
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
-- Indices de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `etiqueta_post`
--
ALTER TABLE `etiqueta_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_etiqueta` (`id_etiqueta`),
  ADD KEY `id_post` (`id_post`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `etiqueta_post`
--
ALTER TABLE `etiqueta_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
-- Filtros para la tabla `etiqueta_post`
--
ALTER TABLE `etiqueta_post`
  ADD CONSTRAINT `etiqueta_post_ibfk_1` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiqueta` (`id`),
  ADD CONSTRAINT `etiqueta_post_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`);

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
