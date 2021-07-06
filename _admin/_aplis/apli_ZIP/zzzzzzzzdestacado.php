<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?
	if(!empty($_GET['flag'])){ $id_apli_zip = $_GET['id_apli_zip']; } else { $id_apli_zip = ''; }
	mysqli_query($cnx, "UPDATE apli_".$_GET['apli_padre']." SET destacado_zip = '".$id_apli_zip."' WHERE id_apli_".$_GET['apli_padre']." = '".$_GET['id_apli']."';");
?>