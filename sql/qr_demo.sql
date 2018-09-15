-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-09-2018 a las 00:43:45
-- Versión del servidor: 5.7.23-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.31-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `qr_demo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL COMMENT '获取资源的access_token',
  `client_id` varchar(80) NOT NULL COMMENT '开发者Appid',
  `user_id` varchar(255) DEFAULT NULL COMMENT '开发者用户id',
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '认证的时间date("Y-m-d H:i:s")',
  `scope` varchar(2000) DEFAULT NULL COMMENT '权限容器'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`access_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('04a3cbb5e6965febbd7434569faf32ccf9745080', 'testclient', 'user', '2018-09-15 17:56:50', 'userinfo cloud file node'),
('06a49da2daf331f7faa83c19111f7ab9a4078636', 'testclient', 'user', '2018-09-15 19:33:04', 'userinfo cloud file node'),
('06bd1fa8996977cffef5a282f68989958a9c74c8', 'testclient', 'alfonso', '2018-09-15 19:37:23', 'userinfo cloud file node'),
('0b84a512b6ea40d9aa71027fd3dd46d898e2ae5c', 'testclient', 'user', '2015-06-28 20:55:05', 'userinfo cloud file node'),
('1d83cfb85c8afe71dac8a9ab32875d4ce8025c11', 'testclient', 'user', '2015-06-28 20:53:34', 'userinfo cloud file node'),
('1f960e7bd2454a4a25f91232b71e2659fa8d6415', 'testclient', 'xiaocao', '2015-06-28 20:46:33', 'userinfo cloud file node'),
('23b3ce4747183460fd753238f0e79b34b3e7bc3c', 'testclient', 'user', '2015-06-28 20:55:06', 'userinfo node file'),
('3478e84a961f1236df4cb9c6cade9ca3bcf6a982', 'testclient', 'user', '2018-09-15 17:21:14', 'userinfo'),
('370a3c8428a11cdfd26b7ec8e500d0519ded0448', 'testclient', 'user', '2018-09-15 15:47:57', 'userinfo'),
('3a7c6028d03fddbeddcfbaab50889ee9a4ccaeae', 'testclient', 'user', '2018-09-15 19:10:19', 'userinfo cloud file node'),
('5c19932029b545ba220b3cba53cc996d8e321704', 'testclient', 'user', '2015-06-28 20:54:33', 'userinfo cloud file node'),
('69a99cc04938f6b2f56c7490232e1510d1988629', 'testclient', 'user', '2018-09-15 17:21:17', 'userinfo'),
('6b0abf82a8b4269759b47a2797794f657fe8868a', 'testclient', 'user', '2015-06-28 20:46:36', 'userinfo cloud file node'),
('6d5560a377fc5769dc13a1b207d28ad3bb4b75b9', 'testclient', 'user', '2018-09-15 18:57:43', 'userinfo cloud file node'),
('7b6c72176ede3e63f78d61849b6ad01b2bf81a6b', 'testclient', 'user', '2015-06-28 20:55:16', 'userinfo node file'),
('7f36518b30baebccc89b1d2a40d01cf193a9f303', 'testclient', 'user', '2018-09-15 19:10:26', 'userinfo'),
('8995e510a6e5672c73e800d48acf8a3f79205621', 'testclient', 'user', '2015-06-28 20:46:49', 'userinfo cloud file node'),
('8cb848d89b7d12beb746b0421ece7209f5c8633a', 'testclient', 'xiaocao', '2015-06-28 20:55:13', 'userinfo cloud file node'),
('ae5f8c93dc51d856d6536aec528c31c6f6450458', 'testclient', 'user', '2015-06-28 20:55:16', 'userinfo cloud file node'),
('b9335a178a2854a11384906e1e2f22a0d47902fd', 'testclient', 'alfonso', '2018-09-15 19:41:13', 'userinfo cloud file node'),
('df43443857a63df74f426dfa679c887483827318', 'testclient', 'xiaocao', '2015-06-28 20:46:48', 'userinfo cloud file node'),
('e2b61783499d6ace28606800cad5fb0a7f9bdc11', 'testclient', 'user', '2018-09-15 17:46:20', 'userinfo cloud file node'),
('f15162689b0272e01d18952afabd0f63e0338673', 'testclient', 'user', '2018-09-15 17:35:37', 'userinfo cloud file node'),
('f4c13cc95e2d3a29e2390886c7314dcf5df31f0e', 'testclient', 'user', '2018-09-15 17:22:10', 'userinfo'),
('fb88d5b71b36583eb978d3af7943b2a3d4b544d4', 'testclient', 'user', '2018-09-15 17:50:22', 'userinfo cloud file node');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_authorization_codes`
--

CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL COMMENT '通过Authorization 获取到的code，用于获取access_token',
  `client_id` varchar(80) NOT NULL COMMENT '开发者Appid',
  `user_id` varchar(255) DEFAULT NULL COMMENT '开发者用户id',
  `redirect_uri` varchar(2000) DEFAULT NULL COMMENT '认证后跳转的url',
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '认证的时间date("Y-m-d H:i:s")',
  `scope` varchar(2000) DEFAULT NULL COMMENT '权限容器'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oauth_authorization_codes`
--

INSERT INTO `oauth_authorization_codes` (`authorization_code`, `client_id`, `user_id`, `redirect_uri`, `expires`, `scope`) VALUES
('016e1a57392e4b672415340ba4d6df18c90eab9f', 'testclient', NULL, '', '2015-06-28 19:56:55', 'userinfo'),
('2f37568bc9a2d8eb3ecb4c360a3abc71235f68c0', 'testclient', NULL, '', '2015-06-28 19:52:14', 'userinfo'),
('63c3b32c565eea30197068658d32678baf1202d6', 'testclient', NULL, '', '2015-06-28 19:56:51', 'userinfo'),
('89fab65a94cbbf8b39ac21a3d797d45964deabd2', 'testclient', NULL, '', '2015-06-28 19:56:57', 'userinfo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) NOT NULL COMMENT '开发者AppId',
  `client_secret` varchar(80) NOT NULL COMMENT '开发者AppSecret',
  `redirect_uri` varchar(2000) NOT NULL COMMENT '认证后跳转的url',
  `grant_types` varchar(80) DEFAULT NULL COMMENT '认证的方式，client_credentials、password、refresh_token、authorization_code、authorization_access_token',
  `scope` varchar(100) DEFAULT NULL COMMENT '权限容器',
  `user_id` varchar(80) DEFAULT NULL COMMENT '开发者用户id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`client_id`, `client_secret`, `redirect_uri`, `grant_types`, `scope`, `user_id`) VALUES
('client2', 'pass2', 'http://homeway.me/', 'authorization_code', 'file node userinfo cloud', 'xiaocao'),
('testclient', 'testpass', 'http://homeway.me/', 'client_credentials password authorization_code refresh_token', 'file node userinfo cloud', 'xiaocao');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_jwt`
--

CREATE TABLE `oauth_jwt` (
  `client_id` varchar(80) NOT NULL COMMENT '开发者用户id',
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL COMMENT '跟新access_token的token',
  `client_id` varchar(80) NOT NULL COMMENT '开发者AppId',
  `user_id` varchar(255) DEFAULT NULL COMMENT '开发者用户id',
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '认证的时间date("Y-m-d H:i:s")',
  `scope` varchar(2000) DEFAULT NULL COMMENT '权限容器'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`refresh_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('0dcd00a06f1598db7c7df2d2faf4c16a7be9c28d', 'testclient', 'user', '2015-07-12 19:55:06', 'userinfo node file'),
('1df2aebc6acded54ad6e0715d3ea5fcca39675c7', 'testclient', 'user', '2018-09-29 16:46:20', 'userinfo cloud file node'),
('31a678010a2fa0f1a22640da7766f4474ef07d38', 'testclient', 'alfonso', '2018-09-29 18:37:23', 'userinfo cloud file node'),
('349be7ac53cfda7a5577a249ab2e3c2db376d455', 'testclient', 'user', '2018-09-29 18:10:19', 'userinfo cloud file node'),
('4c7fb21080b5a7fd3f5b306744a6f02487e225af', 'testclient', 'user', '2018-09-29 16:50:22', 'userinfo cloud file node'),
('52faaaa75503c2c0f69aee9c2563c620700a7617', 'testclient', 'user', '2018-09-29 16:21:17', 'userinfo'),
('7432203dc184c6c2090fef8b02c5c5acf3f349a5', 'testclient', 'user', '2015-07-12 19:55:16', 'userinfo node file'),
('83d6ae1cab6ee487b5e9bfd3f70ce639d4822dcd', 'testclient', 'user', '2018-09-29 18:33:04', 'userinfo cloud file node'),
('934bf8c76314d903f2ca8a1223c388a2c8dad9b9', 'testclient', 'user', '2018-09-29 16:35:37', 'userinfo cloud file node'),
('a169125598e59ee433f3a28ab13f095ed5379a8c', 'testclient', 'user', '2018-09-29 18:10:26', 'userinfo'),
('ad19006ab1f103290b244064031867711a3822ec', 'testclient', 'alfonso', '2018-09-29 18:41:13', 'userinfo cloud file node'),
('aef23d373a276116b3afd946ba4a9c39780186c0', 'testclient', 'user', '2015-07-12 19:53:34', 'userinfo cloud file node'),
('af1e55594cae88cedf312f84a89109e3b80a5932', 'testclient', 'user', '2015-07-12 19:54:33', 'userinfo cloud file node'),
('d830f84ba4e177ec496e5281c8584f65305a66ca', 'testclient', 'user', '2018-09-29 16:56:50', 'userinfo cloud file node'),
('dc9674c691705a977b7ad39bf4a37a6d10a0bd61', 'testclient', 'user', '2018-09-29 16:22:10', 'userinfo'),
('e19c6de15ee711f0ff44e876075e480940cec505', 'testclient', 'user', '2018-09-29 14:47:57', 'userinfo'),
('e252f16cfeb5ddea05b9b99b1691ec61d9fc8d25', 'testclient', 'user', '2018-09-29 16:21:14', 'userinfo'),
('f09ed02ebf185fb08b4f0f316e59bac07028997b', 'testclient', 'user', '2015-07-12 19:46:36', 'userinfo cloud file node'),
('f9b4fea2581434b85af0e720291c00501ada1948', 'testclient', 'user', '2018-09-29 17:57:43', 'userinfo cloud file node'),
('fb1aa4bd8d123abaa882c759d60326dae51543c3', 'testclient', 'user', '2015-07-12 19:46:49', 'userinfo cloud file node');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_scopes`
--

CREATE TABLE `oauth_scopes` (
  `scope` text COMMENT '容器名字',
  `is_default` tinyint(1) DEFAULT NULL COMMENT '是否默认拥有，1=>是，0=>否'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oauth_scopes`
--

INSERT INTO `oauth_scopes` (`scope`, `is_default`) VALUES
('userinfo', 1),
('file', 0),
('node', 0),
('cloud', 0),
('share', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_users`
--

CREATE TABLE `oauth_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT '内部时候使用的认证用户名',
  `password` text COMMENT '内部时候使用的认证用户密码',
  `nombre` varchar(255) DEFAULT NULL,
  `apellido_paterno` varchar(255) DEFAULT NULL,
  `apellido_materno` varchar(255) DEFAULT NULL,
  `token_movil` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oauth_users`
--

INSERT INTO `oauth_users` (`id`, `username`, `password`, `nombre`, `apellido_paterno`, `apellido_materno`, `token_movil`) VALUES
(7, 'alfonso', '$2a$08$kOoVJ8H5AAKHJeJC6/B2XeFSI.SiTTTpEXI85jaHXdykz/aQ3kDfO', 'Tacos Chona', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`access_token`);

--
-- Indices de la tabla `oauth_authorization_codes`
--
ALTER TABLE `oauth_authorization_codes`
  ADD PRIMARY KEY (`authorization_code`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indices de la tabla `oauth_jwt`
--
ALTER TABLE `oauth_jwt`
  ADD PRIMARY KEY (`client_id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`refresh_token`);

--
-- Indices de la tabla `oauth_users`
--
ALTER TABLE `oauth_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `oauth_users`
--
ALTER TABLE `oauth_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
