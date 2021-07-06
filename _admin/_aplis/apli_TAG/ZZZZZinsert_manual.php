<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP
if(!empty($_GET['confirma']))
{
	$id = $_GET['id'];

    $consul ="SELECT id_apli_$apli FROM apli_$apli WHERE id_apli_$apli = '".$id."'";
    $result = mysqli_query($cnx, $consul);
 
    if (mysqli_num_rows($result) == 0) 
	{ 
		$sql = "INSERT INTO apli_$apli (id_apli_$apli) VALUES ('".$id."')";
		$sql = mysqli_query($cnx, $sql) or die(mysqli_error());
	}
		mysqli_query($cnx, "UPDATE apli_$apli SET fecha = '".$_POST['fecha_nota']."' WHERE id_apli_$apli = '".$id."';");
		mysqli_query($cnx, "UPDATE apli_$apli SET titulo = '".charesp($_POST['titulo'])."' WHERE id_apli_$apli = '".$id."';");
		mysqli_query($cnx, "UPDATE apli_$apli SET bajada = '".charesp($_POST['bajada'])."' WHERE id_apli_$apli = '".$id."';");
		mysqli_query($cnx, "UPDATE apli_$apli SET id_apli_tagdetag = '".$_GET['id_apli_tagdetag'].";' WHERE id_apli_$apli = '".$id."';");
//				echo "UPDATE apli_$apli SET id_apli_tagdetag = '".$_GET['id_apli_tagdetag'].";' WHERE id_apli_$apli = '".$id."';";
}

// elimina vacios
$query = "DELETE FROM apli_$apli WHERE (titulo is NULL) OR (titulo = '')";
mysqli_query($cnx, $query); 
?>