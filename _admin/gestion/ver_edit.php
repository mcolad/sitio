<? $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>

<? if(empty($_GET['insert'])){ 
//	echo "".$_GET['Field']." / ".$_GET['apli']." / ".$_GET['id']."</code></div>

?>
<form name="formu">
<div>
<div style='float:left; width:80%; word-wrap:break-word;' class="input-group input-group-sm">
<input class="form-control" aria-label="Small" type="text" name="valor" value="<? echo $_GET['valor']; ?>">
<input class="form-control" aria-label="Small" type="hidden" name="Field" value="<? echo $_GET['Field']; ?>">
<input class="form-control" aria-label="Small" type="hidden" name="apli" value="<? echo $_GET['apli']; ?>">
<input class="form-control" aria-label="Small" type="hidden" name="id" value="<? echo $_GET['id']; ?>">
</div>
<div style='float:right; width:20%; text-align:right'><a style='cursor:pointer;' onClick="recibeid('ver_edit.php', 'insert=1&valor='+formu.valor.value+'&Field='+formu.Field.value+'&apli='+formu.apli.value+'&id='+formu.id.value, '', 'div_<? echo $_GET['Field'] ?>');">
<?
	svg('svgadmin/save.svg', '17', '17', '#E83E8C');
?>
</a>
</div>
</div>
</form>
<? } else { ?>

<? 
mysqli_query($cnx, "UPDATE apli_".$_GET['apli']." SET ".$_GET['Field']." = '".$_GET['valor']."' WHERE  id_apli_".strtolower($_GET['apli'])." = '".$_GET['id']."'");
echo "<div style='float:left; word-wrap:break-word;'><code>".htmlspecialchars($_GET['valor'])."</code></div>
<div style='float:right;'><a style='cursor:pointer; align:left' onClick=\"recibeid('ver_edit.php', 'valor=".$_GET['valor']."&Field=".$_GET['Field']."&apli=".$_GET['apli']."&id=".$_GET['id']."', '', 'div_".$_GET['Field']."');\">";
svg('svgadmin/pen.svg', '12', '12', '#E83E8C');
echo "</a></div>" 


?>
<? } ?>
<!--UPDATE `c94_intranet`.`apli_APLIS` SET `bajada`='Pruesba' WHERE  `id_apli_aplis`='20200510032818';-->