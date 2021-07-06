<?PHP $inicializa = 1; $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?
$sql = "
CREATE TABLE IF NOT EXISTS `apli_APLIS` (
  `id_apli_aplis` varchar(14) NOT NULL,
  `listorder` int(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` mediumtext DEFAULT NULL COMMENT '[obligatorio]',
  `bajada` varchar(512) DEFAULT NULL,
  `svg` varchar(128) DEFAULT NULL,
  `publicar` varchar(1) DEFAULT '1',
  `adjuntos` varchar(1) DEFAULT '1',
  `fecha_sino` varchar(1) DEFAULT '1',
  `menu_admin` varchar(514) DEFAULT NULL,
  `acc_adm` varchar(1) DEFAULT '0',
  `id_apli_tagdetag` mediumtext DEFAULT NULL,
  `id_apli_hijos` varchar(1024) DEFAULT NULL,
  `usuario` mediumtext DEFAULT NULL,
  `estado` int(1) DEFAULT '2',
  PRIMARY KEY (`id_apli_aplis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_APLIS: " . mysqli_error($cnx); }

		$sql = "INSERT INTO `apli_APLIS` (`id_apli_aplis`, `fecha`, `titulo`, `bajada`, `svg`, `publicar`, `adjuntos`,  `fecha_sino`, `menu_admin`, `acc_adm`, `id_apli_tagdetag`, `estado`) VALUES ('00000000000001', '0000-00-00 00:00:00', 'APLIS', 'Aplicaciones', 'svgadmin/caret-square-up.svg', '1', '1', '', '00000000000000', '9', 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en APLIS: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_APLIS` (`id_apli_aplis`, `fecha`, `titulo`, `bajada`, `svg`, `publicar`, `adjuntos`,  `fecha_sino`, `menu_admin`, `acc_adm`, `id_apli_tagdetag`, `estado`) VALUES ('00000000000002', '0000-00-00 00:00:00', 'MENU', 'Menú', 'svgadmin/align-justify.svg', '1', '', '', '00000000000001', '9', 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en APLIS: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_APLIS` (`id_apli_aplis`, `fecha`, `titulo`, `bajada`, `svg`, `publicar`, `adjuntos`,  `fecha_sino`, `menu_admin`, `acc_adm`, `id_apli_tagdetag`, `estado`) VALUES ('00000000000003', '0000-00-00 00:00:00', 'VARIABLES', 'Variables', 'svgadmin/dollar-sign.svg', '1', '1', '', '00000000000000', '9', 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en APLIS: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_APLIS` (`id_apli_aplis`, `fecha`, `titulo`, `bajada`, `svg`, `publicar`, `adjuntos`,  `fecha_sino`, `menu_admin`, `acc_adm`, `id_apli_tagdetag`, `estado`) VALUES ('00000000000004', '0000-00-00 00:00:00', 'HERRAMIENTAS', 'Herramientas y notas', 'svgadmin/cogs.svg', '', '', '', '00000000000001', '9', 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en APLIS: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_APLIS` (`id_apli_aplis`, `fecha`, `titulo`, `bajada`, `svg`, `publicar`, `adjuntos`,  `fecha_sino`, `menu_admin`, `acc_adm`, `id_apli_tagdetag`, `estado`) VALUES ('00000000000005', '0000-00-00 00:00:00', 'USUARIOS', 'Usuarios', 'svgadmin/user-friends.svg', '', '', '1', '00000000000001', '9', 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en APLIS: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_APLIS` (`id_apli_aplis`, `fecha`, `titulo`, `bajada`, `svg`, `publicar`, `adjuntos`,  `fecha_sino`, `menu_admin`, `acc_adm`, `id_apli_tagdetag`, `estado`) VALUES ('00000000000006', '0000-00-00 00:00:00', 'TAGDETAG', 'Tags', 'svgadmin/tag.svg', '1', '1', '', '00000000000000', '6', 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en APLIS: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_APLIS` (`id_apli_aplis`, `fecha`, `titulo`, `bajada`, `svg`, `publicar`, `adjuntos`,  `fecha_sino`, `menu_admin`, `acc_adm`, `id_apli_tagdetag`, `estado`) VALUES ('00000000000007', '0000-00-00 00:00:00', 'TAG', 'TAG', NULL, '1', '1', '', '00000000000001', '2', 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en APLIS: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_APLIS` (`id_apli_aplis`, `fecha`, `titulo`, `bajada`, `svg`, `publicar`, `adjuntos`,  `fecha_sino`, `menu_admin`, `acc_adm`, `id_apli_tagdetag`, `estado`) VALUES ('00000000000008', '0000-00-00 00:00:00', 'IMG', 'IMG', NULL, '1', '1', '', '00000000000001', '2', 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en APLIS: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_APLIS` (`id_apli_aplis`, `fecha`, `titulo`, `bajada`, `svg`, `publicar`, `adjuntos`,  `fecha_sino`, `menu_admin`, `acc_adm`, `id_apli_tagdetag`, `estado`) VALUES ('00000000000009', '0000-00-00 00:00:00', 'ZIP', 'ZIP', NULL, '1', '1', '', '00000000000001', '2', 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en APLIS: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_APLIS` (`id_apli_aplis`, `fecha`, `titulo`, `bajada`, `svg`, `publicar`, `adjuntos`,  `fecha_sino`, `menu_admin`, `acc_adm`, `id_apli_tagdetag`, `estado`) VALUES ('00000000000010', '0000-00-00 00:00:00', 'PDF', 'PDF', NULL, '1', '1', '', '00000000000001', '2', 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en APLIS: " . mysqli_error($cnx); }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$sql = "
CREATE TABLE IF NOT EXISTS `apli_MENU` (
  `id_apli_menu` varchar(14) NOT NULL,
  `listorder` int(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` varchar(1024) DEFAULT NULL COMMENT '[obligatorio]',
  `svg` varchar(514) DEFAULT NULL,
  `id_apli_tag` mediumtext DEFAULT NULL,
  `usuario` mediumtext DEFAULT NULL,
  `estado` int(1) DEFAULT '2',
  PRIMARY KEY (`id_apli_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_MENU: " . mysqli_error($cnx); }

		$sql = "INSERT INTO `apli_MENU` (`id_apli_menu`, `fecha`, `titulo`, `svg`, `id_apli_tag`, `usuario`, `estado`) VALUES ('00000000000000', '2019-05-15 13:46:00', 'Admin', '', NULL, 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en MENU: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_MENU` (`id_apli_menu`, `fecha`, `titulo`, `svg`, `id_apli_tag`, `usuario`, `estado`) VALUES ('00000000000001', '2019-02-08 09:31:00', 'Admin Oculto', '', NULL, 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en MENU: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_MENU` (`id_apli_menu`, `fecha`, `titulo`, `svg`, `id_apli_tag`, `usuario`, `estado`) VALUES ('00000000000002', '2019-02-08 09:31:00', 'Raíz', '', NULL, 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en MENU: " . mysqli_error($cnx); }
		$sql = "INSERT INTO `apli_MENU` (`id_apli_menu`, `fecha`, `titulo`, `svg`, `id_apli_tag`, `usuario`, `estado`) VALUES ('00000000000003', '2019-02-08 09:31:00', 'Oculto', '', NULL, 'SISTEMA', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar en MENU: " . mysqli_error($cnx); }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$sql = "
CREATE TABLE `apli_VARIABLES` (
  `id_apli_variables` varchar(14) NOT NULL,
  `listorder` int(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` varchar(1024) DEFAULT NULL COMMENT '[obligatorio]',
  `aclaracion` mediumtext DEFAULT NULL,
  `variables` mediumtext DEFAULT NULL,
  `id_apli_tag` mediumtext DEFAULT NULL,
  `usuario` mediumtext DEFAULT NULL,
  `estado` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_VARIABLES: " . mysqli_error($cnx); }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$sql = "
CREATE TABLE `apli_HERRAMIENTAS` (
  `id_apli_herramientas` varchar(14) NOT NULL,
  `listorder` int(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` varchar(1024) DEFAULT NULL COMMENT '[obligatorio]',
  `aclaracion` mediumtext DEFAULT NULL,
  `herramientas` mediumtext DEFAULT NULL,
  `id_apli_tag` mediumtext DEFAULT NULL,
  `usuario` mediumtext DEFAULT NULL,
  `estado` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_HERRAMIENTAS: " . mysqli_error($cnx); }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$sql = "
CREATE TABLE IF NOT EXISTS `apli_USUARIOS` (
  `id_apli_usuarios` varchar(14) NOT NULL,
  `listorder` int(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` varchar(1024) DEFAULT NULL COMMENT '[obligatorio]',
  `nick` varchar(1024) DEFAULT NULL,
  `pass` varchar(512) DEFAULT NULL,
  `acc_adm_us` varchar(2) DEFAULT NULL,
  `acc_apli` varchar(1024) DEFAULT NULL,
  `id_apli_tag` mediumtext DEFAULT NULL,
  `usuario` mediumtext DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  PRIMARY KEY (`id_apli_usuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_USUARIOS: " . mysqli_error($cnx); }

		$sql = "INSERT INTO `apli_USUARIOS` (`id_apli_usuarios`, `fecha`, `titulo`, `nick`, `pass`, `acc_adm_us`, `id_apli_tag`, `usuario`, `estado`) VALUES ('20190517104836', NULL, 'matutecolado@gmail.com', 'matutecolado', '202cb962ac59075b964b07152d234b70', '9', NULL, 'SISTEMA;', 2);";
		if (!mysqli_query($cnx, $sql)){ echo "Error al cargar USUARIOS: " . mysqli_error($cnx); }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$sql = "
CREATE TABLE IF NOT EXISTS `apli_TAG` (
  `id_apli_tag` varchar(14) NOT NULL,
  `listorder` int(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` mediumtext DEFAULT NULL COMMENT '[obligatorio]',
  `bajada` mediumtext DEFAULT NULL,
  `id_apli_tagdetag` varchar(128) DEFAULT NULL,
  `usuario` mediumtext DEFAULT NULL,
  `estado` int(1) DEFAULT '2',
  PRIMARY KEY (`id_apli_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_TAG: " . mysqli_error($cnx); }

		$sql = "
CREATE TABLE IF NOT EXISTS `apli_TAGDETAG` (
  `id_apli_tagdetag` varchar(14) NOT NULL,
  `listorder` int(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` mediumtext DEFAULT NULL COMMENT '[obligatorio]',
  `bajada` mediumtext DEFAULT NULL,
  `unico` tinyint(1) DEFAULT NULL,  
  `estado` int(1) DEFAULT '2',
  PRIMARY KEY (`id_apli_tagdetag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_TAGDETAG: " . mysqli_error($cnx); }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$sql = "
CREATE TABLE IF NOT EXISTS `apli_IMG` (
  `id_apli_img` varchar(14) NOT NULL,
  `id_apli` varchar(64) NOT NULL,
  `listorder` int(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` mediumtext DEFAULT NULL COMMENT '[obligatorio]',
  `ext` varchar(6) DEFAULT NULL,
  `usuario` mediumtext DEFAULT NULL,
  `estado` int(1) DEFAULT '2',
  PRIMARY KEY (`id_apli_img`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_TAG: " . mysqli_error($cnx); }


	$sql = "
CREATE TABLE IF NOT EXISTS `apli_PDF` (
  `id_apli_pdf` varchar(14) NOT NULL,
  `id_apli` varchar(64) NOT NULL,
  `listorder` int(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` mediumtext DEFAULT NULL COMMENT '[obligatorio]',
  `usuario` mediumtext DEFAULT NULL,
  `estado` int(1) DEFAULT '2',
  PRIMARY KEY (`id_apli_pdf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_TAG: " . mysqli_error($cnx); }

	$sql = "
CREATE TABLE IF NOT EXISTS `apli_ZIP` (
  `id_apli_zip` varchar(14) NOT NULL,
  `id_apli` varchar(64) NOT NULL,
  `listorder` int(6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` mediumtext DEFAULT NULL COMMENT '[obligatorio]',
  `ext` varchar(6) DEFAULT NULL,
  `usuario` mediumtext DEFAULT NULL,
  `estado` int(1) DEFAULT '2',
  PRIMARY KEY (`id_apli_zip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_TAG: " . mysqli_error($cnx); }

	$sql = "
CREATE TABLE IF NOT EXISTS `apli_ANALYTICS` (
 `id_apli_analytics` varchar(14) NOT NULL,
  `listorder` int(10) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `titulo` varchar(1024) DEFAULT NULL COMMENT '[obligatorio]',
  `Audiencia` varchar(1024) DEFAULT NULL,
  `Comportamiento` varchar(1024) DEFAULT NULL,
  `Adquisición` varchar(1024) DEFAULT NULL,
  `destacado` varchar(64) DEFAULT NULL,
  `id_apli_tag` mediumtext,
  `id_apli_padre` varchar(1024) DEFAULT NULL,
  `usuario` mediumtext,
  `estado` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla apli_TAG: " . mysqli_error($cnx); }

header("Location: index.php");
?>