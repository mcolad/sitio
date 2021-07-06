<?
function leer_titulo_tag($id_tag)
{
	global $cnx;
	$array_id_tag = explode(";",$id_tag);
	$titulo = '';
	foreach($array_id_tag as $id)
	{
		$result_tag = mysqli_query($cnx, "SELECT titulo FROM apli_TAG WHERE id_apli_tag = '".$id."' LIMIT 1");
		$row_tag = mysqli_fetch_array($result_tag);
		$titulo = $titulo." ".$row_tag['titulo'];
	}
	return $titulo;
}
?>