<? $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<? 
if(!empty($_GET['edita']))
{
		$divid = $_GET['divid'];
?>
<form name="formu_<? echo $divid; ?>" action="">
<div class="form-group">
<?
	$result_column = mysqli_query($cnx, "SHOW FULL COLUMNS FROM apli_".$_GET['apli_edit']." WHERE Field = '".$_GET['field']."' ");
	while($row_column = mysqli_fetch_array($result_column))
	{
		echo "<div class='row'>";
		echo "<div class='col-5'><input type='text' name='Field' scope='row' value='".$row_column['Field']."' class='form-control form-control-sm'></div>";
		echo "<div class='col-4'><input type='text' name='Type' scope='row' value='".$row_column['Type']."' class='form-control form-control-sm'></div>";
		echo "<div class='col-3'><a style='width:100%' class='btn btn-sm btn-success' onclick=\"recibeid('sql_edit.php', 'divid=".$divid."&insert=1&apli_edit=".$_GET['apli_edit']."&field_ant=".$row_column['Field']."&field='+formu_".$divid.".Field.value+'&type='+formu_".$divid.".Type.value+'&comment='+formu_".$divid.".Comment.value, '', '".$divid."')\" />";
		svg('svgadmin/plus.svg', 15, 15, 'white');
		echo "</a></div>";
		echo "</div>";
		echo "<div class='row'>";
		echo "<div class='col-9'><input style='width:100%' type='text' name='Comment' scope='row' value='".$row_column['Comment']."' class='form-control form-control-sm'></div>";
		echo "</div>";

	}
	?>
</div>    
</form>
<?
}
?> 
<?  
if(!empty($_GET['insert']))
{
	$sql = "ALTER TABLE `apli_".$_GET['apli_edit']."` 
	CHANGE COLUMN `".$_GET['field_ant']."` `".$_GET['field']."` 
	".$_GET['type']."
	NULL
	DEFAULT
	NULL
	COMMENT '".$_GET['comment']."'
	";
	if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla: " . mysqli_error($cnx); }	

	$result_column = mysqli_query($cnx, "SHOW FULL COLUMNS FROM apli_".$_GET['apli_edit']." WHERE Field = '".$_GET['field']."' ");
	$row_column = mysqli_fetch_array($result_column);
	$divid = $_GET['divid'];
	echo "<div class='row'>";
	echo "<div class='col-5'><strong>".$row_column['Field']."</strong></div>\n";
	echo "<div class='col-4'><small>".$row_column['Type']."</small></div>\n";
	echo "<div class='col-1' style='padding-left:0px'><a onclick=\"recibeid('sql_edit.php', 'divid=".$divid."&edita=1&apli_edit=".$_GET['apli_edit']."&field=".$_GET['field']."', '', '".$divid."')\" class='btn  btn-sm btn-success' />";
	svg('svgadmin/edit.svg', 15, 15, 'white');
	echo "</a></div><div class='col-1' style='padding-left:0px'><a onclick=\"recibeid('sql_edit.php', 'divid=".$divid."&elimina=1&apli_edit=".$_GET['apli_edit']."&field=".$_GET['field']."', '', '".$divid."')\" class='btn btn-sm btn-danger' title='Eliminar' />";
	svg('svgadmin/skull.svg', 15, 15, 'white');
	echo "</a></div><div class='col-1' style='padding-left:0px'><a onclick=\"recibeid('sql_edit.php', 'divid=".md5($divid)."&agrega=1&apli_edit=".$_GET['apli_edit']."&field=".$_GET['field']."', '', '".md5($divid)."')\" class='btn btn-sm btn-primary' />";
	svg('svgadmin/plus.svg', 15, 15, 'white');
	echo "</a></div></div>";

	echo "<div class='row'>";
	echo "<div class='col-9'><small>".$row_column['Comment']."</small></div>";
	echo "</div>";

	
}
?> 
<? 
if(!empty($_GET['elimina']))
{
	$sql = "ALTER TABLE `apli_".$_GET['apli_edit']."` 
	DROP COLUMN `".$_GET['field']."`";
	if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla: " . mysqli_error($cnx); }	
}
?>   
<? 
if(!empty($_GET['agrega']))
{
	$divid = $_GET['divid'];
	?>
	<form name="formu_<? echo $divid; ?>" action="">
    <div class="form-group">
	<?
			echo "<div class='row mt-3'>";
			echo "<div class='col-5'><input type='text' name='Field' scope='row' placeholder='field' class='form-control  form-control-sm'><input type='hidden' name='after_field' scope='row' value='".$_GET['field']."' class='form-control'></div>";
			echo "<div class='col-4'><input type='text' name='Type' scope='row' placeholder='type' class='form-control  form-control-sm'></div>";
			echo "<div class='col-3'><a style='width:100%' class='btn btn-sm btn-success' onclick=\"recibeid('sql_edit.php', 'divid=".$divid."&insert_new=1&apli_edit=".$_GET['apli_edit']."&after_field='+formu_".$divid.".after_field.value+'&field='+formu_".$divid.".Field.value+'&type='+formu_".$divid.".Type.value+'&comment='+formu_".$divid.".Comment.value, '', '".$divid."')\" />";
			svg('svgadmin/plus.svg', 15, 15, 'white');
			echo "</a></div>";
			echo "</div>";
			echo "<div class='row'>";
			echo "<div class='col-9'><input style='width:100%' type='text' name='Comment' scope='row' placeholder='comment' class='form-control form-control-sm'></div>";
			echo "</div>";
		?>
	</div>
	</form>
	<?
}
?> 
<? 
if(!empty($_GET['insert_new']))
{
	$sql = "ALTER TABLE `apli_".$_GET['apli_edit']."` 
	ADD COLUMN `".$_GET['field']."` 
	".$_GET['type']."
	NULL
	COMMENT '".$_GET['comment']."'
	AFTER `".$_GET['after_field']."`
	";
	if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla: " . mysqli_error($cnx); }	 

	$result_column = mysqli_query($cnx, "SHOW FULL COLUMNS FROM apli_".$_GET['apli_edit']." WHERE Field = '".$_GET['field']."' ");
	$row_column = mysqli_fetch_array($result_column);
	$divid = md5($_GET['divid']);
	echo "<div id='".$divid."'>\n"; 

		echo "<div class='row mt-3'>\n"; 
			echo "<div class='col-5'><strong>".$row_column['Field']."</strong></div>\n";
			echo "<div class='col-4'><small>".$row_column['Type']."</small></div>\n";
			echo "<div class='col-1' style='padding-left:0px'><button onclick=\"recibeid('sql_edit.php', 'divid=".$divid."&edita=1&apli_edit=".$_GET['apli_edit']."&field=".$_GET['field']."', '', '".$divid."')\" class='btn btn-sm btn-success' />";
			svg('svgadmin/edit.svg', 15, 15, 'white');
			echo "</button></div><div class='col-1' style='padding-left:0px'><button onclick=\"recibeid('sql_edit.php', 'divid=".$divid."&elimina=1&apli_edit=".$_GET['apli_edit']."&field=".$_GET['field']."', '', '".$divid."')\" class='btn btn-sm btn-danger' title='Eliminar' />";
			svg('svgadmin/skull.svg', 15, 15, 'white');
			echo "</button></div><div class='col-1' style='padding-left:0px'><button onclick=\"recibeid('sql_edit.php', 'divid=".md5($divid)."&agrega=1&apli_edit=".$_GET['apli_edit']."&field=".$_GET['field']."', '', '".md5($divid)."')\" class='btn btn-sm btn-primary' />";
			svg('svgadmin/plus.svg', 15, 15, 'white');
			echo "</button></div>";
		echo "</div>\n";
	
		echo "<div class='row mb-3'>";
			echo "<div class='col-9'><small>".$row_column['Comment']."</small></div>";
		echo "</div>";
 
    echo "</div>\n";

	echo "<div class='mb-3' id='".md5($divid)."'></div>\n";
}
?>