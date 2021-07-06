<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>


<?
	$select = "*";
	$from = "apli_IMG";
	$where = "WHERE id_apli = ".$id_apli;
	$order_que = "id_apli_img";
	$order = "DESC";
	$var = "id_apli=".$_GET['id_apli']."&apli_padre=".$_GET['apli_padre'];
	list($rowp) = paginador($select, $from, $where, $order_que, $order, $var, 2);
?>
<style>
	.star {
	visibility:hidden;
	font-size:20px;
	cursor:pointer;
	margin-top:-9px;
	}
	.star:before {
	content: "\2606";
	position: absolute;
	visibility:visible;
	}
	.star:checked:before {
	content: "\2605";
	color:#18f;
	position: absolute;
	}
</style>
<?PHP
		// averigual el estado del DESTACADO en la base padre
//		$query = "SELECT destacado_img FROM apli_".$_GET['apli_padre']." WHERE id_apli_".strtolower($_GET['apli_padre'])." = '".$_GET['id_apli']."' ";
//		$result_destacado = mysqli_query($cnx, $query); 
//		$row_destacado = mysqli_fetch_array($result_destacado);

	$countrow = 0;
	while(!empty($rowp[$countrow]))
	{
	?>
	<div class="card">
        <div class='card-header'>
            <div style="float:left">		
                    <button class='btn btn-admin btn-sm' onclick="window.location.href='?editar=1&id_apli_img=<? echo $rowp[$countrow]['id_apli_img'] ?>&id_apli=<? echo $rowp[$countrow]['id_apli'] ?>&apli_padre=<? echo $_GET['apli_padre'] ?>'">EDITAR</button>
                    <!--<button disabled="disabled" class='btn btn-fecha btn-sm'><?PHP echo $rowp[$countrow]['fecha']; ?></button>-->
                    <span class="copy-btn btn btn-copy btn-sm" data-type="attribute" 
                        data-attr-name="data-clipboard-text" 
                        data-model="couponCode" 
                        data-clipboard-text="IMG:<?PHP echo $rowp[$countrow]['id_apli_img']; ?>">IMG:<?PHP echo $rowp[$countrow]['id_apli_img']; ?>
                    </span>
			</div>
            <div style="float:right">
                <div style="float:left" id='star<? echo $rowp[$countrow]['id_apli_img'] ?>'>
                    <? if($rowp[$countrow]['estado'] == '3'){ $checked = 'checked="checked"'; $flag = '';  } else { $checked = ''; $flag = '1'; }  ?>
                    <input <? echo $checked; ?>  title='IMG destacado' type='checkbox' class='chk star' onclick="javascript:recibeid('../../gestion/destacado.php', 'tipo=IMG&id_tipo=<? echo $rowp[$countrow]['id_apli_img']; ?>&id_apli=<? echo $_GET['id_apli']; ?>&flag=<? echo $flag; ?>', '', 'div_null')" /><div id='div_null'></div>
                </div>
            <div style="float:right" id='estado<? echo $rowp[$countrow]['id_apli_img'] ?>'>		
				<?PHP $semaforo = 'rv'; $tipo = 'apli_IMG'; $id_tipo = $rowp[$countrow]['id_apli_img']; include("$path/_admin/gestion/estado.php");?>
            </div>
  		</div>

  		</div>
        
        <div class="card-body">		
                        <div class="cc-selector" style='float:left;'><?PHP  echo "<a title='ver nota' href='".$path."/_fotos/".$rowp[$countrow]['id_apli_img']."_original.jpg' onclick=\"return hs.expand(this)\"><img style='padding:5px' width=65px; src='".$path."/_fotos/".$rowp[$countrow]['id_apli_img']."_300x300.jpg'></a>"; ?></div>
                        <p><?PHP echo $rowp[$countrow]['titulo']; ?> </p> 
        </div>
    </div><br />
			<?PHP	
		$countrow++;	
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

 <!--<script src="/rumbocero/_js/style.switcher.js"></script> -->