<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?php 

$array	= array_reverse($_POST['arrayorder']);
if ($_POST['update'] == "update")
{
	$count = 1;
	foreach ($array as $idval) 
	{
		$query = "UPDATE apli_".$_POST['apli_padre']." SET listorder = ".$count." WHERE id_apli_".strtolower($_POST['apli_padre'])." = " . $idval.";\n";
		mysqli_query($cnx, $query);
		$count ++;	
	}
	echo '<ul><li class="text-center" style="background-color:#5cb85c"><strong>Los cambios fueron salvados exitosamente!</strong></li></ul>';
}
?>
<!--<script> location.href = "destacado.php"; </script>-->