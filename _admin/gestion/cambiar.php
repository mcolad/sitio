<script type="text/javascript" src="/sitio/_admin/_scripts/js/Ajax_Objetus.js"></script>
<? $include = "_scripts/cnx/cnx.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);?>
<?

if(!empty($_GET['id_info']))
{
	$_GET['id_info'] = trim($_GET['id_info']);
	if(is_numeric($_GET['id_info']) AND (strlen($_GET['id_info']) == 12))
	{
			$result = "UPDATE info_destacados SET id_info = '".$_GET['id_info']."' WHERE id = ".$_GET['id'].";";
			mysql_query($result) or die(mysql_error());
	
			$query_info = "SELECT * FROM info WHERE (id_info = ".$_GET['id_info'].") LIMIT 1";
			$result_info = mysql_query($query_info, $cnx);
			$row_info = mysql_fetch_array($result_info);
			
					?><font color="#FFFFFF" size="+4"><? echo $_GET['listorder']; ?></font><strong>&nbsp;&nbsp;&nbsp;<?php echo ($row_info['titulo']); ?></strong>&nbsp;
					<a style='color:#000' href="javascript:recibeid('cambiar.php', 'listorder=<? echo $_GET['listorder']; ?>&id=<? echo $_GET['id']; ?>', '', 'nombre_<? echo $_GET['id']; ?>')"> Arrastre la barra (drag and drop) para posicionar el orden en el slide [Modificar]<br />
</a>
					<div class="clear"></div>
	<?
	} else { echo 'El nro de CODIGO contiene errores. Refresque y vuelva a intentar.'; } 
}
else
{
	$query  = "SELECT * FROM info_destacados WHERE id = '".$_GET['id']."';";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

//					$query_info = "SELECT * FROM info WHERE (id_info = ".$_GET['id'].") LIMIT 1";
	//				$result_info = mysql_query($query_info, $cnx);
		//			$row_info = mysql_fetch_array($result_info);
	?>
		<form name='formu_nombre' style="display:block">
            <input name='id_info' style="width:200px; color:#333" value='<? echo $row['id_info']; ?>' type='text'/>
            <!--<input name="none" type="text" readonly="readonly" value='<? echo $row_info['titulo']; ?>' />-->
            <a href="javascript:recibeid('cambiar.php', 'id_info='+formu_nombre.id_info.value+'&listorder=<? echo $_GET['listorder']; ?>&id=<? echo $_GET['id']; ?>', '', 'nombre_<? echo $_GET['id']; ?>')">ingresar</a>
        </form>
    <?
}
?> 