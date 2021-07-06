<?
function tag($array_id_apli_tagdetag, $apli, $id_apli, $id_apli_tag, $mostrar = 1)
{
	global $cnx, $path, $abs;
	foreach ($array_id_apli_tagdetag as $valor) 
	{
		unset($noactivos);	
		$id_apli_tagdetag = $valor;
	
		$result_tagdetag = mysqli_query($cnx, "SELECT * FROM apli_TAGDETAG WHERE id_apli_tagdetag = '".$id_apli_tagdetag."';");
		$row_tagdetag = mysqli_fetch_array($result_tagdetag);
		
		if($row_tagdetag['estado'] > 1)
		{
			$result_tag = mysqli_query($cnx, "SELECT * FROM apli_TAG WHERE ((estado > 1) AND (id_apli_tagdetag LIKE '%".$id_apli_tagdetag."%')) ORDER BY titulo ASC");
			while($row_tag = mysqli_fetch_array($result_tag))
			{
				$result = mysqli_query($cnx, "SELECT * FROM apli_".$apli." WHERE (id_apli_".strtolower($apli)." = '".$id_apli."' AND id_apli_tag LIKE '%".$row_tag['id_apli_tag']."%' )");
				$cantidad = mysqli_num_rows($result);
				$row = mysqli_fetch_array($result);
				if($cantidad == 0)
				{ $noactivos[$row_tag['id_apli_tag']] = $row_tag['titulo'];}

			}
			mysqli_free_result($result_tag);
		
			$result = mysqli_query($cnx, "SELECT * FROM apli_".$apli." WHERE (id_apli_".strtolower($apli)." = '".$id_apli."')");
			$row = mysqli_fetch_array($result);
			
			echo "<div id='".md5($id_apli_tagdetag.$id_apli.$mostrar)."' style='clear:both;'>";
					echo "<div style='float:left; margin-right:10px; padding-bottom:10px;'>";
							if($mostrar == 1)
							{
								$flag = false;
								echo "<form name='formu_".md5($id_apli_tagdetag.$id_apli)."' style='display: inline'>";
								echo "<select style='background-color:#eee' class='form-control form-control-sm' name='activar' onchange=\"recibeid('/".$abs."_admin/gestion/tag.php', 'tag=1&agrega=1&id_apli_tagdetag=".$id_apli_tagdetag."&apli=".$apli."&id_apli=".$id_apli."&id_apli_tags=".$row['id_apli_tag']."&id_apli_tag='+this.value, '', '".md5($id_apli_tagdetag.$id_apli.$mostrar)."')\">";
								echo "<option disabled selected value=''>- ".$row_tagdetag['titulo']." -</option>";
								if(!empty($noactivos))
								{
									foreach ($noactivos as $clave => $valor) 
									{
										echo "<option style='margin-top:-5px;' value='".$clave."'>".$valor."</option>";
									}
								}
								echo "</select></form>";
							}
							else
							{
								$flag = true;
								echo $row_tagdetag['titulo']." -> ";
							}
					echo "</div>";
			
					$result_tag = mysqli_query($cnx, "SELECT * FROM apli_TAG WHERE ((estado > 0) AND (id_apli_tagdetag LIKE '%".$id_apli_tagdetag."%'))");
					while($row_tag = mysqli_fetch_array($result_tag))
					{
						$result = mysqli_query($cnx, "SELECT * FROM apli_".$apli." WHERE (id_apli_".strtolower($apli)." = '".$id_apli."' AND id_apli_tag LIKE '%".$row_tag['id_apli_tag']."%' )");
						$cantidad = mysqli_num_rows($result);
						$row = mysqli_fetch_array($result);
						if($cantidad != 0)
						{ 
								echo "<div class='form-control form-control-sm tag' style='float:left; margin-right:10px'>".$row_tag['titulo']."&nbsp;";
								if($mostrar == 1)
								{
									echo "<a onclick=\"javascript:recibeid('/".$abs."_admin/gestion/tag.php', 'tag=1&elimina=1&id_apli_tagdetag=".$id_apli_tagdetag."&apli=".$apli."&id_apli=".$id_apli."&id_apli_tag=".$row_tag['id_apli_tag']."&id_apli_tags=".$row['id_apli_tag']."', '', '".md5($id_apli_tagdetag.$id_apli.$mostrar)."')\" class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
								}else{ $flag = false; }
								
								echo "</div>"; 
						}
					}
					mysqli_free_result($result_tag);

					
			echo "</div>";  
			if($flag){ echo '<script>document.getElementById("'.md5($id_apli_tagdetag.$id_apli.$mostrar).'").style.display = "none";</script>'; }
		}
		mysqli_free_result($result_tagdetag);

	}
}
?>