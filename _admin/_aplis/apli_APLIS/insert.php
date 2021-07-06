<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP
$flag_elimina_gestion = '';
if(!empty($_GET['confirma']))
{
	$id = $_GET['id'];

	mysqli_query($cnx, "INSERT INTO apli_$apli (id_apli_".strtolower($apli).") VALUES ('".$id."')");
	mysqli_query($cnx, "UPDATE apli_$apli SET titulo = '".charesp($_POST['titulo'])."' WHERE id_apli_".strtolower($apli)." = '".$id."';");

	if(!file_exists("../"))
	{ 
		mkdir("../"); 
	}

	if(!file_exists("../../__aplis/"))
	{
		mkdir("../../__aplis/");
	}

	if(!file_exists("../../__aplis/apli_".$_POST['titulo']))
	{ 
		mkdir("../../__aplis/apli_".$_POST['titulo']);
	
		$from = "../../gestion/modelos/novedades";
		$to = "../../__aplis/apli_".$_POST['titulo'];
		
		$dir = opendir($from);
		while(($file = readdir($dir)) !== false){
			if(strpos($file, '.') !== 0){
				copy($from.'/'.$file, $to.'/'.$file);
			}
		}
	
		$sql = "CREATE TABLE IF NOT EXISTS `apli_".$_POST['titulo']."` (
		`id_apli_".strtolower($_POST['titulo'])."` varchar(14) NOT NULL,
		`listorder` int(10),
		`fecha` datetime DEFAULT NULL,
		`titulo` varchar(1024) COMMENT '[obligatorio]',
		`destacado` varchar(64),
		`id_apli_tag` mediumtext,
		`id_apli_padre` varchar(1024), 
		`usuario` mediumtext,
		`estado` int(1) DEFAULT '1',
		PRIMARY KEY (`id_apli_".strtolower($_POST['titulo'])."`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		";
		if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla: " . mysqli_error($cnx); }
	}

	if(!empty($_POST['publicar'])){ $publicar = '1'; } else { $publicar = ''; } 
	if(!empty($_POST['adjuntos'])){ $adjuntos = '1'; } else { $adjuntos = ''; } 
	if(!empty($_POST['fecha_sino'])){ $fecha_sino = '1'; } else { $fecha_sino = ''; } 

	mysqli_query($cnx, "UPDATE apli_$apli SET fecha = '".$_POST['fecha_nota']."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
	mysqli_query($cnx, "UPDATE apli_$apli SET bajada = '".charesp($_POST['bajada'])."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
	mysqli_query($cnx, "UPDATE apli_$apli SET publicar = '".$publicar."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
	mysqli_query($cnx, "UPDATE apli_$apli SET menu_admin = '".$_POST['menu_admin']."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
	mysqli_query($cnx, "UPDATE apli_$apli SET acc_adm = '".$_POST['acc_adm']."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
	mysqli_query($cnx, "UPDATE apli_$apli SET adjuntos = '".$adjuntos."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
	mysqli_query($cnx, "UPDATE apli_$apli SET fecha_sino = '".$fecha_sino."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
}

$query = "DELETE FROM apli_$apli WHERE (titulo is NULL) OR (titulo = '')";
mysqli_query($cnx, $query); 
?>