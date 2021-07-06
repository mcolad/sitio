<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP
	$result_destacado = mysqli_query($cnx, "SHOW COLUMNS FROM apli_".$_GET['apli_padre']." WHERE Field = 'destacado'");
	$row_destacado = mysqli_fetch_array($result_destacado);
	if (empty($row_destacado['Field'])) 
	{
		mysqli_query($cnx, "ALTER TABLE `apli_".$_GET['apli_padre']."` ADD `destacado` varchar(64) NULL AFTER `titulo`");
	}
	
	$result_destacado = mysqli_query($cnx, "SELECT destacado FROM apli_".$_GET['apli_padre']." WHERE id_apli_".$_GET['apli_padre']." = '".$_GET['id_apli']."';");
	$row_destacado = mysqli_fetch_array($result_destacado);
	$destacado = explode(";", $row_destacado['destacado']);
	$array_destacado = explode(";", $row_destacado['destacado']);

	$code_ext = '';
	$code = '';
	foreach($array_destacado as $value)
	{
		// leo el codigo de la extension que me interesa
		if(strtolower($_GET['tipo']) == substr($value, 4))
		{
			$code_ext = substr($value, 4);
			$code = substr($value, 0, 4);
			$desdentado = str_replace($value.";", "", $destacado);
			echo $desdentado."xxxx";
		}
	}	
echo "hola";
?>