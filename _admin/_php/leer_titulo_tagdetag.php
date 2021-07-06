<?
function leer_titulo_tagdetag($id_tagdetag)
{
	global $cnx;
	$result_tagdetag = mysqli_query($cnx, "SELECT titulo FROM apli_TAGDETAG WHERE id_apli_tagdetag = '".substr($id_tagdetag, 0, 14)."' LIMIT 1");
	$row_tagdetag = mysqli_fetch_array($result_tagdetag);
	return  $row_tagdetag['titulo'];
}
?>