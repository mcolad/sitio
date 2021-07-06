<? $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?
	if(empty($id_tipo))
	{
		$id_tipo = $_GET['id_tipo'];
		$tipo  = $_GET['tipo'];
		$semaforo  = $_GET['semaforo'];
	}
	if(empty($semaforo)){$amarillo = true; $semaforo = ''; } elseif ($semaforo == 'rv'){$amarillo = false ;} else {$amarillo = true ;}
?>
<?PHP 
	if(!empty($_GET['conf']))
	{
		if($_GET['conf'] == 'x')
		{ $set = 0; }
		else { $set = $_GET['conf']; } 
		mysqli_query($cnx, "UPDATE ".$tipo." SET estado = ".$set." WHERE id_".strtolower($tipo)." = '".$id_tipo."';");
	}

	$query = "SELECT estado FROM ".$tipo." WHERE id_".strtolower($tipo)." = '".$id_tipo."' ";
	$result_estado = mysqli_query($cnx, $query); 
	$row_estado = mysqli_fetch_array($result_estado);
?>
<?		
		if($row_estado['estado'] >= 2)
		{  
			svg('svgadmin/laugh.svg', 20, 20, 'green');	

			if($amarillo){
			echo " <a href=\"javascript:recibeid('/".$abs."_admin/gestion/estado.php', 'semaforo=".$semaforo."&tipo=".$tipo."&id_tipo=".$id_tipo."&conf=1', '', 'estado$id_tipo');\">";
			svg('svgadmin/meh.svg', 20, 20, 'gray');
			echo "</a>";
			}

			echo " <a onclick=\"div = document.getElementById('star".$id_tipo."'); div.style.display = 'none';\" href=\"javascript:recibeid('/".$abs."_admin/gestion/estado.php', 'semaforo=".$semaforo."&tipo=".$tipo."&id_tipo=".$id_tipo."&conf=x', '', 'estado$id_tipo');\">";
			svg('svgadmin/dizzy.svg', 20, 20, 'gray');
			echo "</a>";	
		}
		
		if($row_estado['estado'] == 1)
		{
			echo " <a href=\"javascript:recibeid('/".$abs."_admin/gestion/estado.php', 'semaforo=".$semaforo."&tipo=".$tipo."&id_tipo=".$id_tipo."&conf=2', '', 'estado$id_tipo');\">";
			svg('svgadmin/laugh.svg', 20, 20, 'gray');	
			echo "</a> ";	

			if($amarillo){ 
			svg('svgadmin/meh.svg', 20, 20, 'orange');	 

			echo " <a href=\"javascript:recibeid('/".$abs."_admin/gestion/estado.php', 'semaforo=".$semaforo."&tipo=".$tipo."&id_tipo=".$id_tipo."&conf=x', '', 'estado$id_tipo');\">";
			svg('svgadmin/dizzy.svg', 20, 20, 'gray');
			echo "</a>"; }
		}

		if($row_estado['estado'] == 0)
		{
			echo "<script>div = document.getElementById('star".$id_tipo."'); div.style.display = 'none'; </script>";
			echo " <a onclick=\"div = document.getElementById('star".$id_tipo."'); div.style.display = '';\"  href=\"javascript:recibeid('/".$abs."_admin/gestion/estado.php', 'semaforo=".$semaforo."&tipo=".$tipo."&id_tipo=".$id_tipo."&conf=2', '', 'estado$id_tipo');\">";
			svg('svgadmin/laugh.svg', 20, 20, 'gray');	
			echo "</a> ";	

			if($amarillo){
			echo " <a onclick='' href=\"javascript:recibeid('/".$abs."_admin/gestion/estado.php', 'semaforo=".$semaforo."&tipo=".$tipo."&id_tipo=".$id_tipo."&conf=1', '', 'estado$id_tipo');\">";
			svg('svgadmin/meh.svg', 20, 20, 'gray');
			echo "</a> ";	
			}
			
			svg('svgadmin/dizzy.svg', 20, 20, 'red');
		}

//	}
?>
<br clear="all" />