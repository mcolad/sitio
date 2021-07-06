<?
function tag_filtro($array_id_apli_tagdetag, $apli)
{
	global $cnx, $order_que, $order;
	foreach ($array_id_apli_tagdetag as $valor) 
	{
		$id_apli_tagdetag = $valor;
	
		$result_tagdetag = mysqli_query($cnx, "SELECT estado, titulo FROM apli_TAGDETAG WHERE id_apli_tagdetag = '".$id_apli_tagdetag."';");
		$row_tagdetag = mysqli_fetch_array($result_tagdetag);
		if($row_tagdetag['estado'] > 1)
		{
			echo "<div id='".md5($id_apli_tagdetag)."' style='float:left'>";
			echo "<div style='float:left; margin-right:10px; padding-bottom:5px;'>";
			
			
			if(!empty($_GET['filtro_tag'])) // verificamos si hay un filtro $_GET['filtro_tag']
			{ 
				if($_GET['filtro_tag'] != '') // si el filtro está activo, solo mostramos lo elegido 
				{ 
						$result_tag = mysqli_query($cnx, "SELECT * FROM apli_TAG WHERE (id_apli_tag = '".$_GET['filtro_tag']."') LIMIT 1");
						$row_tag = mysqli_fetch_array($result_tag);
						echo "<div>";
						echo " <a style='cursor:pointer' class='btn-sm btn-warning' onclick=\"window.location.href='?order_que=$order_que&order=$order'\">".$row_tag['titulo']."×</a>";
						echo " <a class='btn-sm btn-success' target='_blank' href='../../gestion/ver_filtros.php?apli=".$apli."&filtro_tag=".$_GET['filtro_tag']."'>ver</a>";
						echo "</div>";
						$break = 1;
				}
			}
			else // si no hay filtro seleccionado mostramos todas las opcioness
			{
				echo "<form name='formu_tag".$id_apli_tagdetag."' onchange=";
				echo '"window.location.href=';
				echo "'?order_que=$order_que&order=$order&filtro_tag='+formu_tag".$id_apli_tagdetag.".filtro_tag.value;";
				echo '" style="display: inline">';
				echo "<select class='form-control form-control-sm' name='filtro_tag'>";
				echo "<option style='background-color:#fff' selected value=''>- ".$row_tagdetag['titulo']." -</option>";
				$result_tag = mysqli_query($cnx, "SELECT id_apli_tag, titulo FROM apli_TAG WHERE ((estado > 0) AND (id_apli_tagdetag LIKE '%".$id_apli_tagdetag."%')) ORDER BY titulo ASC");
				while($row_tag = mysqli_fetch_array($result_tag))
				{
					$selected = '';
					if(!empty($_GET['filtro_tag'])){ 
					if($_GET['filtro_tag'] == $row_tag['id_apli_tag']){ $selected = "selected style='margin-top:-5px;'";} else{ $selected = " style='margin-top:-5px;'"; } }
					echo "<option style='background-color:#fff' $selected value='".$row_tag['id_apli_tag']."'>".$row_tag['titulo']."</option>";
				}
				mysqli_free_result($result_tag);
				echo "</select></form>";
			}
			echo "</div></div>";
		}
		mysqli_free_result($result_tagdetag);
		if(!empty($break)){ break; }
	}
}
?>