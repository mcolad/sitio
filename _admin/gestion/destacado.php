<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?
	$result_destacado = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli_padre']." LIMIT 1");
	$row_destacado = mysqli_fetch_array($result_destacado);
	if (empty($row_destacado['destacado'])) 
	{
		mysqli_query($cnx, "ALTER TABLE `apli_".$_GET['apli_padre']."` ADD `destacado` varchar(64) NULL AFTER `titulo`");
	}

//	if(!empty($_GET['flag'])){ $id_tipo = $_GET['id_tipo']; } else { $id_tipo = ''; }
//	mysqli_query($cnx, "UPDATE apli_".$_GET['tipo']." SET estado = '2' WHERE id_apli = '".$_GET['id_apli']."' AND estado = '3';");
//	mysqli_query($cnx, "UPDATE apli_".$_GET['tipo']." SET estado = '3' WHERE id_apli_".strtolower($_GET['tipo'])." = '".$id_tipo."';");
//	mysqli_query($cnx, "UPDATE apli_".$_GET['apli_padre']." SET ".strtolower($_GET['tipo'])."_destacado = '".$id_tipo."' WHERE id_apli_".$_GET['apli_padre']." = '".$_GET['id_apli']."';");
//	echo date('is');

//	echo $row_destacado['img_destacado'];

//	$result_estado = mysqli_query($cnx, "SELECT estado FROM apli_".$_GET['tipo']." WHERE id_apli_".strtolower($_GET['tipo'])." = '".$_GET['id_tipo']."';");
//	$row_estado = mysqli_fetch_array($result_estado);
//	if($row_estado['estado'] == 2){ $estado = 3; } else { $estado = 2; } 
//	mysqli_query($cnx, "UPDATE apli_".$_GET['tipo']." SET estado = '".$estado."' WHERE id_apli = '".$_GET['id_apli']."';");	

//	echo $row_destacado[strtolower($_GET['tipo']).'_destacado']."<br />";

// leo el registro destacado de la fila

	$result_destacado = mysqli_query($cnx, "SELECT destacado FROM apli_".$_GET['apli_padre']." WHERE id_apli_".$_GET['apli_padre']." = '".$_GET['id_apli']."';");
	$row_destacado = mysqli_fetch_array($result_destacado);
	$destacado = $row_destacado['destacado'];

//	echo "lo que hay: ".$destacado."<br />";
//	echo $_GET['tipo'].":".$_GET['id_tipo'].";<br />";
	
	$array_destacado = explode(";", $row_destacado['destacado']);


	// si existe se trata simplemente de eliminar
	if (in_array($_GET['tipo'].":".$_GET['id_tipo'], $array_destacado)) 
	{
	    //echo "Existe ".$_GET['tipo'].":".$_GET['id_tipo']."; por lo tanto eliminamos";
	    $insert = str_replace($_GET['tipo'].":".$_GET['id_tipo'].";", '', $destacado);
	}
	
	// si no existe, hay dos posibilidades... si existe otro IMG hay que reemplazarlo, sino solo se agrega
	else
	{
		foreach($array_destacado as $value)
		{
			// existe otro y hay que reemplazarlo
			if($_GET['tipo'] == substr($value, 0, 3))
			{  
				//echo "existe otro y hay que reemplazarlo";
				$code_new = substr($value, 4);
			     $insert = str_replace($_GET['tipo'].":".substr($value, 4).";", $_GET['tipo'].":".$_GET['id_tipo'].";", $destacado);
			} 
		}
		
		// no existe, por lo tanto solo hay que agregar a la cadena 
		if(empty($insert))
		{
				//echo "no existe, por lo tanto solo hay que agregar a la cadena";
			     $insert = $destacado.$_GET['tipo'].":".$_GET['id_tipo'].";";
		}
		
	}

		mysqli_query($cnx, "UPDATE apli_".$_GET['apli_padre']." SET destacado = '$insert' WHERE id_apli_".$_GET['apli_padre']." = '".$_GET['id_apli']."';");

//	$result_destacado = mysqli_query($cnx, "SELECT ".strtolower($_GET['tipo'])."_destacado FROM apli_".$_GET['apli_padre']." WHERE id_apli_".$_GET['apli_padre']." = '".$_GET['id_apli']."';");
//	$row_destacado = mysqli_fetch_array($result_destacado);
//	echo $row_destacado[strtolower($_GET['tipo']).'_destacado'];

?>