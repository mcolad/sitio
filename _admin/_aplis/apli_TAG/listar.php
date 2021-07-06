<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>
<?
	$select = "*";
	$from = "apli_$apli";
	$where = "WHERE id_apli_tagdetag LIKE '".$_GET['id_apli_tagdetag'].";'";
	$order_que = "listorder";
	$order = "ASC";
	$var = "id_apli_tagdetag=".$_GET['id_apli_tagdetag'];
	list($rowp) = paginador($select, $from, $where, $order_que, $order, $var, 2, 0);
?>

  	<?PHP
	$countrow = 0;
	while(!empty($rowp[$countrow]))
	{
	?>
            <div class="card">
                <div class='card-header'>
                    <div style="float:left">		
                            <button class='btn btn-admin btn-sm' onclick="window.location.href='index.php?editar=1&play=<? echo $play; ?>&id_apli_tagdetag=<? echo $_GET['id_apli_tagdetag'] ?>&id=<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>'">EDITAR</button>&nbsp;<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>
                    </div>
                    <div style="float:right">
                        <div style="float:left" class='d-none d-lg-block'><button disabled="disabled" class="btn btn-fecha btn-sm"><?PHP echo substr($rowp[$countrow]['fecha'], 0, -3); ?></button></div>
                        <div style="float:left; margin-top:6px;" id='estado<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>'>
                            <?PHP $tipo = "apli_$apli"; $id_tipo = $rowp[$countrow]["id_apli_".strtolower($apli)]; include("$path/_admin/gestion/estado.php"); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body"><h5><?PHP  echo $rowp[$countrow]['titulo']; ?> </h5><?PHP  echo $rowp[$countrow]['bajada']; ?></div>
                <!--  <div class="card-footer">	
                    <? // tagdetag($apli, $rowp[$countrow]["id_apli_$apli"]); ?>	
                    <? $_GET['apli'] = "$apli"; $id = $rowp[$countrow]["id_apli_".strtolower($apli)]; ?><form name="formu_<? echo $id; ?>" method="post" style="display: inline"><?  $_SESSION['session_tagdetag'.$id] = $rowp[$countrow]['id_apli_tagdetag']; 			include('../tagdetag.php');	?></form>      
               </div>--> 
           </div><br />
			<?PHP	
		$countrow++;	
	}
?>
