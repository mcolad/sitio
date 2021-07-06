<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?
	$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE estado = 0"); 
	while($row = mysqli_fetch_array($result))
	{
		$query = "DELETE FROM apli_IMG WHERE id_apli = ".$row['id_apli_'.strtolower($_GET['apli'])].""; mysqli_query($cnx, $query); 
		$query = "DELETE FROM apli_PDF WHERE id_apli = ".$row['id_apli_'.strtolower($_GET['apli'])].""; mysqli_query($cnx, $query); 
		$query = "DELETE FROM apli_ZIP WHERE id_apli = ".$row['id_apli_'.strtolower($_GET['apli'])].""; mysqli_query($cnx, $query); 
	}

	if($_GET['apli'] == 'APLIS')
	{
		$result_apli = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE estado = 0"); 
		while($row_apli = mysqli_fetch_array($result_apli))
		{
			$result = mysqli_query($cnx, "SELECT * FROM apli_".$row_apli['titulo']); 
			while($row = mysqli_fetch_array($result))
			{
				$query = "DELETE FROM apli_IMG WHERE id_apli = ".$row['id_apli_'.strtolower($row_apli['titulo'])].""; mysqli_query($cnx, $query); 
				$query = "DELETE FROM apli_PDF WHERE id_apli = ".$row['id_apli_'.strtolower($row_apli['titulo'])].""; mysqli_query($cnx, $query); 
				$query = "DELETE FROM apli_ZIP WHERE id_apli = ".$row['id_apli_'.strtolower($row_apli['titulo'])].""; mysqli_query($cnx, $query); 
			}
		}
	}


	// pendiente: que al borrar un TAGs, 
	// se puede verificar en el resto de las aplicacionessi hay alguno activo. 
	// O sea, para borrar un TAGDETAG y todos sus TAGs correspondientes, 
	// verificar que no este ningun TAG vinculado aalgun contenido de las aplicaciones
	
	if($_GET['apli'] == 'TAGDETAG')
	{
		$result_apli = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE estado = 0"); 
		while($row_apli = mysqli_fetch_array($result_apli))
		{
			$query = "DELETE FROM apli_TAG WHERE id_apli_tagdetag = ".$row_apli['id_apli_tagdetag'].""; mysqli_query($cnx, $query); 
		}
	}
	
	$result_apli_aplis_padre = mysqli_query($cnx, "SELECT titulo, id_apli_hijos FROM apli_APLIS WHERE titulo = '".$_GET['apli']."'");  
	$row_apli_aplis_padre = mysqli_fetch_array($result_apli_aplis_padre);
 	$apli_hijos_delete = explode(";", $row_apli_aplis_padre['id_apli_hijos']);

	if($apli_hijos_delete)
	{
		foreach($apli_hijos_delete as $apli_delete)
		{
			$result_apli_delete = mysqli_query($cnx, "SELECT titulo FROM apli_APLIS WHERE id_apli_aplis = '".$apli_delete."'"); 
			$row_apli_delete = mysqli_fetch_array($result_apli_delete);
			
			$result_alfin = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE estado = 0"); 
			while($row_alfin = mysqli_fetch_array($result_alfin))
			{
//				echo               "DELETE FROM apli_".$row_apli_delete['titulo']." WHERE id_apli_padre = '".$row_alfin['id_apli_'.$_GET['apli']].'"'; 
				mysqli_query($cnx, "DELETE FROM apli_".$row_apli_delete['titulo']." WHERE id_apli_padre = '".$row_alfin['id_apli_'.$_GET['apli']]."'"); 
			}
		}
	}
	
	mysqli_query($cnx, "DELETE FROM apli_".$_GET['apli']." WHERE estado = 0"); 
	mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE estado = 0"); 
	sintesis_panel($_GET['apli'], $_GET['nombre'], $color = 'green'); 
?>
