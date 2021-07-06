<? $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);?>


<?
	$result = mysqli_query($sql, "SELECT fecha FROM apli_archivos ORDER BY fecha DESC LIMIT 1; "); 
	$row = mysqli_fetch_array($result);
	$fecha_archivo = "20".substr($row['fecha'], 0, -4);
	$fecha_archivo_fin = date("Ymd");

	listar_rastreo('../../../sitio/gobierno/digesto', 0);

	function listar_rastreo($ruta, $count = 0, $buffer = array("x"))
	{
		$buffer[] = $ruta;
		if(!in_array($ruta, $buffer));
		listar_rastreo_dependencia($ruta, $count, $buffer);
	}

	function listar_rastreo_dependencia($ruta, $count = 0, $buffer)
	{
		global $fecha_archivo;
		global $fecha_archivo_fin;
		
		if (is_dir($ruta))
		{
			$gestor = opendir($ruta);
			while (($archivo = readdir($gestor)) !== false)  
			{ 
				if ($archivo=="." || $archivo=="..") 
				{ 
					echo " "; 
				} 
				else 
				{ 
					$archivos[$archivo] = $archivo;
				}
			} 
			
			if(!empty($archivos))
			{	
				foreach ($archivos as $archivo) 
				{
					$ruta_completa = $ruta . "/" . $archivo;
					if ($archivo != "." && $archivo != "..") 
					{
						if (is_dir($ruta_completa)) 
						{
							$name = $archivo;
							listar_rastreo($ruta_completa, $count++, $buffer);
						} 
						else 
						{

										$ext = substr(strrchr($archivo, "."), 1); 
										if(strtolower($ext) == 'xlsx' XOR strtolower($ext) == 'docx' XOR strtolower($ext) == 'xls' XOR strtolower($ext) == 'zip' XOR strtolower($ext) == 'rar' XOR strtolower($ext) == 'pdf' XOR strtolower($ext) == 'doc' XOR strtolower($ext) == 'ppt'  XOR strtolower($ext) == 'pptx'  XOR strtolower($ext) == 'pps'  XOR strtolower($ext) == 'ppsx')
										{
											if((date("Ymd", filectime($ruta_completa)) >= $fecha_archivo) AND (date("Ymd", filectime($ruta_completa)) <= $fecha_archivo_fin))
											{							
												listar_rastreo_tratar_archivo($ruta_completa, $archivo);
											}
										}

						}
					}
				}
			}
			closedir($gestor);
			} else { echo "<strong>".$ruta."</strong> no es una ruta de directorio valida<br/>"; }
	}
	
	function listar_rastreo_tratar_archivo($ruta_completa, $archivo)
	{
		global $fecha_archivo;
		global $fecha_archivo_fin;
		global $cnx;
		$ext = substr(strrchr($archivo, "."), 1); 

				$name = $archivo;
				$img = "<img src='/sitio/_img/_".$ext.".gif'/>";
				$area = strstr($ruta_completa, "/areas/");
				$area = substr($area, 7);
				$area = strstr($area, '/', true);
				if(is_numeric(substr($name, 0, 6)))
				{ $name = substr($name, 7, -4); } 
				else 
				{ $name = substr($name, 0, -4); }
/*				echo "<div id='".md5($ruta_completa)."'>"
				.$img." ".$area." 
				<a target='_blank' href='".($ruta_completa)."'>".$name."</a> 
				<a href=\"javascript:recibeid('rastreo/carga.php', 'id=".md5($ruta_completa)."', 'id_area=".$area."&fecha=".filectime($ruta_completa)."&ruta=".$ruta_completa."&titulo=".$name."', '".md5($ruta_completa)."')\">[agregar]</a>
				</div>";
*/
		$id = md5($ruta_completa);

		$consul ="SELECT id_apli_archivos FROM apli_archivos WHERE id_apli_archivos = '".$id."'";
		$result = mysqli_query($consul,$cnx);
		if (mysqli_num_rows($result) == 0) 
		{ 
			$sql = "INSERT INTO apli_archivos (id_apli_archivos) VALUES ('".$id."')";
			$sql = mysqli_query($sql) or die(mysqli_error());
			mysqli_query($sql, "UPDATE apli_archivos SET id_area = '".$area."' WHERE id_apli_archivos = '".$id."';");
			mysqli_query($sql, "UPDATE apli_archivos SET fecha = '".date("ymdHis", filectime($ruta_completa))."' WHERE id_apli_archivos = '".$id."';");
			mysqli_query($sql, "UPDATE apli_archivos SET titulo = '".charesp($name)."' WHERE id_apli_archivos = '".$id."';");
			mysqli_query($sql, "UPDATE apli_archivos SET ruta = '".substr($ruta_completa, 6)."' WHERE id_apli_archivos = '".$id."';");
			mysqli_query($sql, "UPDATE apli_archivos SET fecha_carga = '".date('Y-m-d')."' WHERE id_apli_archivos = '".$id."';");
			mysqli_query($sql, "UPDATE apli_archivos SET nick = CONCAT(COALESCE(nick, ''), '".date('ymdHis')."-".$_SESSION['nick'].";') WHERE id_apli_archivos = '".$id."';");
		}
	}
?>