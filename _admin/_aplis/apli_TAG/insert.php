<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP
if(!empty($_GET['confirma']))
{
	$id = $_GET['id'];
    $consul ="SELECT id_apli_".strtolower($apli)." FROM apli_$apli WHERE id_apli_".strtolower($apli)." = '".$id."'";
    $result = mysqli_query($cnx, $consul);

	$titulos_array = explode("\n", $_POST['titulo']);

    if (mysqli_num_rows($result) == 0) 
	{ 
			$result_count = mysqli_query($cnx, "SELECT id_apli_".strtolower($apli)." FROM apli_$apli ORDER BY id_apli_".strtolower($apli)." DESC LIMIT 1");
			$row_count = mysqli_fetch_array($result_count);
			
			$count = intval(substr($row_count['id_apli_'.strtolower($apli)], -6))+1;

			foreach($titulos_array as $valor)
			{
				if(trim($valor) != '')
				{ 

					$var = explode("\t", $valor);
		
					$id = substr($id, 0, -6).str_pad($count, 6, "0", STR_PAD_LEFT);
					mysqli_query($cnx, "INSERT INTO apli_$apli (id_apli_".strtolower($apli).") VALUES ('".$id."')") or die(mysqli_error());
					mysqli_query($cnx, "UPDATE apli_$apli SET fecha = '".$_POST['fecha_nota']."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
					mysqli_query($cnx, "UPDATE apli_$apli SET titulo = '".trim(charesp($var[0]))."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
					if(!empty($var[1]))
					{
						mysqli_query($cnx, "UPDATE apli_$apli SET bajada = '".trim(charesp($var[1]))."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
					}
					mysqli_query($cnx, "UPDATE apli_$apli SET id_apli_tagdetag = '".$_GET['id_apli_tagdetag'].";' WHERE id_apli_".strtolower($apli)." = '".$id."';");
				}
					$count++;	
			}
	}
	else
	{
		mysqli_query($cnx, "UPDATE apli_$apli SET fecha = '".$_POST['fecha_nota']."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
		mysqli_query($cnx, "UPDATE apli_$apli SET titulo = '".trim(charesp($_POST['titulo']))."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
		mysqli_query($cnx, "UPDATE apli_$apli SET bajada = '".trim(charesp($_POST['bajada']))."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
		mysqli_query($cnx, "UPDATE apli_$apli SET id_apli_tagdetag = '".$_GET['id_apli_tagdetag'].";' WHERE id_apli_".strtolower($apli)." = '".$id."';");
	}
}

// elimina vacios
$query = "DELETE FROM apli_$apli WHERE (titulo is NULL) OR (titulo = '')";
mysqli_query($cnx, $query); 
?>