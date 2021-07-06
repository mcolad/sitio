<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?
	if(!empty($_GET['flag'])){ $id_apli_img = $_GET['id_apli_img']; } else { $id_apli_img = ''; }

	mysqli_query($cnx, "UPDATE apli_IMG SET estado = '2' WHERE id_apli = '".$_GET['id_apli']."' AND estado = '3';");
	mysqli_query($cnx, "UPDATE apli_IMG SET estado = '3' WHERE id_apli_img = '".$id_apli_img."';");
?>