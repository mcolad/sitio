<?
function tagdeaplis_formu($apli, $id_apli_tag, $mostrar = 1)
{
	global $cnx, $path, $abs;
	unset($noactivos);	

		$flag = 0;
		$result_tagdetag = mysqli_query($cnx, "SELECT * FROM apli_TAGDETAG WHERE (estado > 1)");
		while($row_tagdetag = mysqli_fetch_array($result_tagdetag))
		{
			$sql = "SELECT * FROM apli_APLIS WHERE (id_apli_aplis = '".$id_apli_tag."' AND id_apli_tagdetag LIKE '%".$row_tagdetag['id_apli_tagdetag']."%' )";
			$result = mysqli_query($cnx, $sql);
			$cantidad = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result);
			if($cantidad == 0){ $noactivos[$row_tagdetag['id_apli_tagdetag']] = $row_tagdetag['titulo'];}else{$flag++;}		
		}
		mysqli_free_result($result_tagdetag);
	
		echo "<div id='div_".$id_apli_tag."' style='clear:both;'>";
			echo "<div style='float:left; margin-right:10px; padding-bottom:10px;'>";
			if($mostrar == 1)
			{
						echo "<form name='formu_$id_apli_tag' style='display: inline'>";
						echo "<select class='form-control form-control-sm' name='activar' onchange=\"recibeid('/".$abs."_admin/gestion/tag_formu.php', 'tagdeaplis=agrega&apli=".$apli."&id_apli_aplis=".$id_apli_tag."&id_apli_tagdetag='+formu_$id_apli_tag.activar.value, '', 'div_".$id_apli_tag."')\">";
						echo "<option disabled selected value=''>- tagdetag -</option>";
						if(!empty($noactivos))
						{
							foreach ($noactivos as $clave => $valor) 
							{
								echo "<option style='margin-top:-5px;' value='".$clave."'>".$valor."</option>";
							}
						}		
						echo "</select></form>";
			}
			echo "</div>"; 

			$result_tag = mysqli_query($cnx, "SELECT * FROM apli_TAGDETAG WHERE (estado > 0)");
			while($row_tag = mysqli_fetch_array($result_tag))
			{
				$result = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (id_apli_aplis = '".$id_apli_tag."' AND id_apli_tagdetag LIKE '%".$row_tag['id_apli_tagdetag']."%' )");
				$cantidad = mysqli_num_rows($result);
				$row = mysqli_fetch_array($result);
				if($cantidad != 0)
				{ 
					echo "<div class='form-control form-control-sm tag' style='float:left; margin-right:10px'>".$row_tag['titulo']."&nbsp;";
						if($mostrar == 1)
						{
								echo "<a onclick=\"javascript:recibeid('/".$abs."_admin/gestion/tag_formu.php', 'tagdeaplis=elimina&apli=".$apli."&id_apli_aplis=".$id_apli_tag."&id_apli_tagdetag=".$row_tag['id_apli_tagdetag']."', '', 'div_".$id_apli_tag."')\" class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
						}
					echo "</div>"; 
				}
			}
			mysqli_free_result($result_tag);

		echo "</div>";
}
?>