<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>
<?
if(!empty($_GET['tag']))
{

	$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE (id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli']."')");
	$row = mysqli_fetch_array($result);
	
	$array_id_apli_tagdetag = array ($_GET['id_apli_tagdetag']);
	if(!empty($_GET['elimina']))
	{
		mysqli_query($cnx, "UPDATE apli_".$_GET['apli']." SET id_apli_tag = '".str_replace($_GET['id_apli_tag'].";", '', $row['id_apli_tag'])."' WHERE id_apli_".$_GET['apli']." = '".$_GET['id_apli']."';");
		mysqli_query($cnx, "UPDATE apli_emprod SET estado = 0 WHERE (id_empresa = ".$_GET['id_empresa']." AND id_producto = ".$_GET['id_apli_tag'].");");
	}
	if(!empty($_GET['agrega']))
	{
		mysqli_query($cnx, "UPDATE apli_".$_GET['apli']." SET id_apli_tag = '".$row['id_apli_tag'].$_GET['id_apli_tag'].";' WHERE id_apli_".$_GET['apli']." = '".$_GET['id_apli']."';");


// agrega en emprod solo si son tags de productos --->
	$result_esproducto = mysqli_query($cnx, "SELECT esproducto FROM apli_TAG WHERE (id_apli_tag = '".$_GET['id_apli_tag']."')");
	$row_esproducto = mysqli_fetch_array($result_esproducto);

	if($row_esproducto['esproducto'])
	{
			$result_agrega = mysqli_query($cnx, "SELECT * FROM apli_emprod WHERE (id_empresa = '".$_GET['id_empresa']."' AND id_producto = '".$_GET['id_apli_tag']."');");
			$row_agrega = mysqli_fetch_array($result_agrega);
			if($row_agrega['id_apli_emprod'] != ''){ mysqli_query($cnx, "UPDATE apli_emprod SET estado = 2 WHERE (id_empresa = ".$_GET['id_empresa']." AND id_producto = ".$_GET['id_apli_tag'].");"); }
			else{ 
				$nuevo_id = date('Ymdhis');
				if(mysqli_query($cnx, "INSERT INTO apli_emprod (id_apli_emprod) VALUES ('".$nuevo_id."')"))
				{ 
					$result_tag = mysqli_query($cnx, "SELECT * FROM apli_TAG WHERE (id_apli_tag = '".$_GET['id_apli_tag']."')");
					$row_tag = mysqli_fetch_array($result_tag);
					mysqli_query($cnx, "UPDATE apli_emprod SET fecha = '".date('Y-m-d H:i')."' WHERE id_apli_emprod = '".$nuevo_id."';");
					mysqli_query($cnx, "UPDATE apli_emprod SET id_producto = '".$_GET['id_apli_tag']."' WHERE id_apli_emprod = '".$nuevo_id."';");
					mysqli_query($cnx, "UPDATE apli_emprod SET id_empresa = '".$_GET['id_empresa']."' WHERE id_apli_emprod = '".$nuevo_id."';");
					mysqli_query($cnx, "UPDATE apli_emprod SET titulo = '".$row['titulo']." - ".$row_tag['titulo']."' WHERE id_apli_emprod = '".$nuevo_id."';");
					mysqli_query($cnx, "UPDATE apli_emprod SET estado = 2 WHERE id_apli_emprod = '".$nuevo_id."';");
				}
			  }
	}
	}
	
	
	tag_productos($array_id_apli_tagdetag, $_GET['apli'], $_GET['id_apli'], $_GET['id_apli_tag'], $_GET['id_empresa'], $_GET['titulo_empresa']);
}
?>