<?
function sintesis_panel($apli, $nombre, $color = 'gray')
{
	global $cnx;
	global $path;
	$result_publi = mysqli_query($cnx, "SELECT * FROM apli_".$apli." WHERE (estado = 2  AND titulo != '')"); 
	$cantidad_publi = mysqli_num_rows($result_publi);
	$result_standbay = mysqli_query($cnx, "SELECT * FROM apli_".$apli." WHERE (estado = 1  AND titulo != '')"); 
	$cantidad_standbay = mysqli_num_rows($result_standbay);
	$result = mysqli_query($cnx, "SELECT * FROM apli_".$apli." WHERE (estado = 0  AND titulo != '')"); 
	$cantidad = mysqli_num_rows($result);
	if($cantidad_publi != 0): $color_publi = 'green'; else: $color_publi = 'gray'; endif;
	if($cantidad_standbay != 0): $color_standbay = 'orange'; else: $color_standbay = 'gray'; endif;
	if($cantidad != 0): $color = 'red'; else: $color = 'gray'; endif;
	echo "<tr id='div_".$apli."'><td align='left'><strong>".$nombre."</strong></td>
	<td align='center'><strong><span style='color:".$color_publi."'>".$cantidad_publi."</span></strong></td>
	<td align='center'><strong><span style='color:".$color_standbay."'>".$cantidad_standbay."</span></strong></td>
	<td align='center'><strong><span style='color:".$color."'>".$cantidad."</span></strong></td>
	<td align='center'>";

	if($_SESSION['acc_adm_us']  > 5)
	{
		echo "<a style='cursor:pointer' ";
		echo 'onClick="recibeid';
		echo "('".$path."_admin/gestion/depura.php', 'apli=".$apli."&nombre=".$nombre."', '', 'div_".$apli."')";
		echo '">';
		svg('svgadmin/redo-alt.svg', 20, 20, $color);
		echo '</a></td>';
	}

	echo '</tr>';
	mysqli_free_result($result);
}
?>
