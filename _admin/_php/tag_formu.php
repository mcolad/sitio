<?
function tag_formu($id_apli_tagdetag, $apli, $id_apli, $id_apli_tag, $mostrar = 1)
{
	global $cnx, $path, $abs; 
	$no_registro = 1; 
		$result_tagdetag = mysqli_query($cnx, "SELECT * FROM apli_TAGDETAG WHERE id_apli_tagdetag = '".$id_apli_tagdetag."';");
		$row_tagdetag = mysqli_fetch_array($result_tagdetag);
		
		if($row_tagdetag['estado'] > 1)
		{
			$result_tag = mysqli_query($cnx, "SELECT * FROM apli_TAG WHERE ((estado > 1) AND (id_apli_tagdetag LIKE '%".$id_apli_tagdetag."%')) ORDER BY titulo ASC");
			while($row_tag = mysqli_fetch_array($result_tag))
			{
				$result = mysqli_query($cnx, "SELECT * FROM apli_".$apli." WHERE (id_apli_".strtolower($apli)." = '".$id_apli."' AND `".$id_apli_tagdetag."` LIKE '%".$row_tag['id_apli_tag']."%' )");
				$cantidad = mysqli_num_rows($result);
				$row = mysqli_fetch_array($result);
				if($cantidad == 0)
				{ $noactivos[$row_tag['id_apli_tag']] = $row_tag['titulo'];}

			}
			mysqli_free_result($result_tag);
		
			$result = mysqli_query($cnx, "SELECT * FROM apli_".$apli." WHERE (id_apli_".strtolower($apli)." = '".$id_apli."')");
			$row = mysqli_fetch_array($result);
			
			echo "<div id='".md5($id_apli_tagdetag.$id_apli.$mostrar)."' style='clear:both;'>";
					echo "<div style='float:left; padding-bottom:10px;'>";
							if($mostrar == 1)
							{
								$flag = false;
								//echo "<form name='formu_".md5($id_apli_tagdetag.$id_apli)."' style='display: inline'>";
								echo "<select class='form-control dropdown-toggle' name='".$id_apli_tagdetag."' onchange=\"recibeid('/".$abs."_admin/gestion/tag_formu.php', 'tag=1&agrega=1&id_apli_tagdetag=".$id_apli_tagdetag."&apli=".$apli."&id_apli=".$id_apli."&id_apli_tags=".$row[$id_apli_tagdetag]."&id_apli_tag='+this.value, '', '".md5($id_apli_tagdetag.$id_apli.$mostrar)."')\">";
								echo "<option disabled selected value=''>&nbsp;&nbsp;&nbsp;".$row_tagdetag['titulo']."&nbsp;&darr;&nbsp;</option>";
								if(!empty($noactivos))
								{
									foreach ($noactivos as $clave => $valor) 
									{
										echo "<option style='margin-top:-5px;' value='".$clave."'>".$valor."</option>";
									}
								}
								echo "</select>";
							}
							else
							{
								$flag = true;
								echo $row_tagdetag['titulo']." -> ";
							} 
					echo "</div>";
			
					$select = '';
					$result_tag = mysqli_query($cnx, "SELECT * FROM apli_TAG WHERE ((estado > 0) AND (id_apli_tagdetag LIKE '%".$id_apli_tagdetag."%'))");
		
					echo "<div class='form-control' style='padding:7px;'><a class='close'>&nbsp;</a>";
					while($row_tag = mysqli_fetch_array($result_tag))
					{
						$result = mysqli_query($cnx, "SELECT * FROM apli_".$apli." WHERE (id_apli_".strtolower($apli)." = '".$id_apli."' AND `".$id_apli_tagdetag."` LIKE '%".$row_tag['id_apli_tag']."%' )");
						$cantidad = mysqli_num_rows($result);
						$row = mysqli_fetch_array($result);
						if($cantidad != 0)
						{ 
								echo $row_tag['titulo'];
								if($mostrar == 1)
								{
									echo "<a onclick=\"javascript:recibeid('/".$abs."_admin/gestion/tag_formu.php', 'tag=1&elimina=1&id_apli_tagdetag=".$id_apli_tagdetag."&apli=".$apli."&id_apli=".$id_apli."&id_apli_tag=".$row_tag['id_apli_tag']."&id_apli_tags=".$row[$id_apli_tagdetag]."', '', '".md5($id_apli_tagdetag.$id_apli.$mostrar)."')\" class='close' style='color:#F1C6B4' data-dismiss='alert' aria-label='close'>&times;</a>&nbsp;&nbsp;&nbsp;";
									$select = $select.$row_tag['id_apli_tag'].";";
								}
								else{ $flag = false; }
								echo "<input name='".$id_apli_tagdetag."' type='hidden' value='".$select."'>";
						}
					}
					echo "</div>"; 
					
					mysqli_free_result($result_tag);

					
			echo "</div>";  
			if($flag){ echo '<script>document.getElementById("'.md5($id_apli_tagdetag.$id_apli.$mostrar).'").style.display = "none";</script>'; }
		}
		mysqli_free_result($result_tagdetag);

}
?>