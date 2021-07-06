<?
function tags_activos($apli, $id)
{
	global $cnx;
	$result = mysqli_query($cnx, "SELECT * FROM apli_".$apli." WHERE id_apli_".$apli." = '".$id."' LIMIT 1");
	$row = mysqli_fetch_array($result);
	$array_aplitag_activos = explode(";", $row['id_apli_tag'], -1);

	$result = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (titulo = '$apli')");
	$row = mysqli_fetch_array($result);
	$array_aplitagdetag_activos = explode(";", $row['id_apli_tagdetag'], -1);

	$query_tagdetag = "SELECT * FROM apli_TAGDETAG WHERE (estado > 1) ORDER BY fecha ASC;";
	$result_tagdetag = mysqli_query($cnx, $query_tagdetag);
	while($row_tagdetag = mysqli_fetch_array($result_tagdetag))
	{
			if(in_array($row_tagdetag['id_apli_tagdetag'], $array_aplitagdetag_activos))
			{
					$array_tagdetag_activos[$row_tagdetag['titulo']] = $row_tagdetag['id_apli_tagdetag'];
					
					$query_tag = "SELECT * FROM apli_TAG WHERE (estado > 1 AND id_apli_tagdetag LIKE '%".$row_tagdetag['id_apli_tagdetag']."%');";
					$result_tag = mysqli_query($cnx, $query_tag);
					while($row_tag = mysqli_fetch_array($result_tag))
					{
						if(in_array($row_tag['id_apli_tag'], $array_aplitag_activos))
						{
							$array_tag_activos[$row_tag['titulo']] = $row_tag['id_apli_tag'];
						}
					}
			}
	
	}
	mysqli_free_result($result_tagdetag);
	
	if(empty($array_tag_activos)){ $array_tag_activos = array();}
	return $array_tag_activos;
}
?>