<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?
	if(!empty($_GET['flag'])){ $id_apli_pdf = $_GET['id_apli_pdf']; } else { $id_apli_pdf = ''; }
	mysqli_query($cnx, "UPDATE apli_".$_GET['apli_padre']." SET destacado_pdf = '".$id_apli_pdf."' WHERE id_apli_".$_GET['apli_padre']." = '".$_GET['id_apli']."';");
?>