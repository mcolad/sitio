<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>
<style>
input[type*='checkbox'] { opacity: 0; margin-top:-15px; position:relative; left:15px }


.demo input[type="checkbox"] + label span {
	display: inline-block;
	width: 15px;
	height: 15px;
	margin-top:-15px;
/*	margin: -1px 4px 0 0;
	vertical-align: middle;*/
	background: url(../../_img/checkbox-uncheck.png);
	background-size: cover;
	cursor: pointer;
}
.demo input[type="checkbox"]:checked + label span {
	background: url(../../_img/checkbox-check.png);
	background-size: cover;
}
</style>
<?
	$select = "*";
	$from = "apli_ZIP";
	$where = "WHERE id_apli = ".$id_apli;
	$order_que = "listorder";
	$order = "DESC";
	$var = "id_apli=".$_GET['id_apli']."&apli_padre=".$_GET['apli_padre'];
	list($rowp) = paginador($select, $from, $where, $order_que, $order, $var, 2);
?>
<?PHP
		$result_destacado = mysqli_query($cnx, "SHOW COLUMNS FROM apli_".$_GET['apli_padre']." WHERE Field = 'destacado'");
		$row_destacado = mysqli_fetch_array($result_destacado);
		if (!empty($row_destacado['Field'])) 
		{
			$result_destacado = mysqli_query($cnx, "SELECT destacado FROM apli_".$_GET['apli_padre']." WHERE id_apli_".strtolower($_GET['apli_padre'])." = '".$_GET['id_apli']."' ");
			$row_destacado = mysqli_fetch_array($result_destacado);
			$array_destacado = explode(";", $row_destacado['destacado']);
			foreach($array_destacado as $value)
			{
				if('ZIP' == substr($value, 0, 3))
				{  
					$zip_destacado = substr($value, 4);
				} 
			}
			if(empty($zip_destacado)){ $zip_destacado = ''; }
		}
		else
		{
			$zip_destacado = '';
		}

	$countrow = 0;
	while(!empty($rowp[$countrow]))
	{
	?>
	<div class="card">
        <div class='card-header'>
            <div style="float:left">		
                    <div class="coupon-banner">
                         <button class='btn btn-admin btn-sm' onclick="window.location.href='?editar=1&id_apli_zip=<? echo $rowp[$countrow]['id_apli_zip'] ?>&id_apli=<? echo $rowp[$countrow]['id_apli'] ?>&apli_padre=<? echo $_GET['apli_padre'] ?>'">EDITAR</button>
                         <style>.coupon-banner #alert<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>{ display:none;}</style>
                         <a id="coupon-btn" class="btn btn-warning btn-sm" data-icon="i"><span id='code<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>' class="copy-btn" data-clipboard-text="ZIP:<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>">ZIP:<?PHP echo $rowp[$countrow]['id_apli_zip']; ?></span><span id="alert<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>"><strong>Código Copiado!</strong></span></a>
                         <style>.coupon-banner #alert_link_<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>{ display:none;}</style>
                         <a id="coupon-btn" class="btn btn-warning btn-sm" data-icon="i"><span id='code_link_<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>' class="copy-btn" data-clipboard-text="<? echo $dom."/".$abs."_zip/".$rowp[$countrow]['id_apli_zip'].".zip"; ?>">Link</span><span id="alert_link_<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>" style="background-color:#090"><strong>Copy!</strong></span></a>

                    <script>
                         const copytargetlink<?PHP echo $rowp[$countrow]['id_apli_zip']; ?> = document.getElementById("code_link_<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>"); copytargetlink<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>.addEventListener("click", copyToClipboardlink<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>);
                         function copyToClipboardlink<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>() {
                         document.getElementById("code_link_<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>").style.display = "none"; document.getElementById("alert_link_<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>").style.display = "unset";
                         setTimeout(function(){ document.getElementById("code_link_<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>").style.display = "unset"; document.getElementById("alert_link_<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>").style.display = "none";}, 500); }
                    </script>
                    </div>
          
                    <script>
                         const copytarget<?PHP echo $rowp[$countrow]['id_apli_zip']; ?> = document.getElementById("code<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>");copytarget<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>.addEventListener("click", copyToClipboard<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>);
                         function copyToClipboard<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>() {
                         document.getElementById("code<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>").style.display = "none"; document.getElementById("alert<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>").style.display = "unset";
                         setTimeout(function(){ document.getElementById("code<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>").style.display = "unset"; document.getElementById("alert<?PHP echo $rowp[$countrow]['id_apli_zip']; ?>").style.display = "none";}, 500); }
                    </script>
           </div>
            <div style="float:right">
                <div style="float:left; vertical-align:text-top" id='star<? echo $rowp[$countrow]['id_apli_zip'] ?>' class="demo">
                    <? if($rowp[$countrow]['id_apli_zip'] == $zip_destacado ){ $checked = 'checked="checked"'; $flag = '';  } else { $checked = ''; $flag = '1'; }  ?>
                    <input <? echo $checked; ?> title='destacar' type="checkbox" id="acepto" class='chk star' name="acepto" onclick="javascript:recibeid('../../gestion/destacado.php', 'tipo=ZIP&apli_padre=<? echo $_GET['apli_padre'] ?>&id_tipo=<? echo $rowp[$countrow]['id_apli_zip']; ?>&id_apli=<? echo $_GET['id_apli']; ?>&flag=<? echo $flag; ?>', '', 'div_null')" ><label><span></span></label>&nbsp;<div id='div_null'></div>
                </div>
                <div style="float:right" id='estado<? echo $rowp[$countrow]['id_apli_zip'] ?>'>		
                    <?PHP $semaforo = 'rv'; $tipo = 'apli_ZIP'; $id_tipo = $rowp[$countrow]['id_apli_zip']; include("$path/_admin/gestion/estado.php");?>
                </div>
            </div>

  		</div>

        <div class="card-body">
                       <div class="cc-selector pr-2" style='float:left;'><i class="far fa-file-archive fa-3x"></i></div>
                       <p><?PHP  echo "<a title='ver zip' target='_blank' href='".$path."/_zip/".$rowp[$countrow]['id_apli_zip'].$rowp[$countrow]['ext']."'>".$rowp[$countrow]['titulo']."</a>"; ?></p> 
        </div> 

    </div><br />
			<?PHP	
		$countrow++;	
	}
	if(!$countrow)
	{
		?>
          <div class="text-center">
		<?
		svg('svgadmin/frown.svg', 300, 300, '#DCE7E9'); 
		?>
          </div>
		<?
	}
?>
<script>
$(document).ready(function(){
    $('.copy-btn').on("click", function(){
        value = $(this).data('clipboard-text'); //Upto this I am getting value
 
        var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(value).select();
          document.execCommand("copy");
          $temp.remove();
    })
})
</script> 

<script>
$('input.chk').on('change', function() {
    $('input.chk').not(this).prop('checked', false);  
});   
</script>

<script>
function star() 
{
	$('input.chk').not(this).prop('checked', false);
}   
</script>
