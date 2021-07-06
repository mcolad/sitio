<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP
$flag_elimina_gestion = '';
if(!empty($_GET['confirma']))
{
		$id = $_GET['id'];

		mysqli_query($cnx, "UPDATE apli_$apli SET fecha = '".$_POST['fecha']."' WHERE id_apli_".strtolower($apli)." = '".$id."';");

//		$exepciones = array('id_apli_'.$apli, 'fecha', 'destacado', 'id_apli_tag', 'contador', 'estado');
		$result_column = mysqli_query($cnx, "SHOW COLUMNS FROM apli_$apli");
		while($row_column = mysqli_fetch_array($result_column))
		{
			if(!in_array($row_column['Field'], $exepciones))
			{
				mysqli_query($cnx, "UPDATE apli_$apli SET ".$row_column['Field']." = '".charesp($_POST[$row_column['Field']])."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
			}
		}
		$result_insert = mysqli_query($cnx, "SELECT * FROM apli_$apli WHERE id_apli_".strtolower($apli)." = '".$id."'; "); 
		$row_insert = mysqli_fetch_array($result_insert);
		mysqli_query($cnx, "UPDATE apli_$apli SET usuario = '".$row_insert['usuario']."|".date('YmsHis')."-".$_SESSION['nick']."' WHERE id_apli_$apli = '".$id."';");

		if(file_exists('insert_local.php')){ include('insert_local.php'); }
}


// elimina vacios
$query = "DELETE FROM apli_$apli WHERE (titulo is NULL) OR (titulo = '')";
mysqli_query($cnx, $query); 
?>
