<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>

<?
	$select = "*";
	$from = "apli_$apli";
	$where = "WHERE titulo <> ''";
	$order_que = "listorder";
	$order = "DESC";
	$var = ""; 
	list($rowp) = paginador($select, $from, $where, $order_que, $order, $var, 5);
?>


	
  	<?PHP
	$countrow = 0;
	while(!empty($rowp[$countrow]))
	{
	?>
    
	<div class="card">
        <div class='card-header'>
            <div style="float:left">		
                    <button class='btn btn-admin btn-sm' onclick="window.location.href='index.php?editar=1&play=<? echo $play; ?>&id=<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>'">EDITAR</button>
                    <button class='btn btn-admin btn-sm modalButton' data-toggle='modal' data-src='<? echo $path ?>_admin/gestion/ver.php?apli=<? echo $apli ?>&id=<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>' data-width=100% data-target='#myModal'><i class="far fa-eye"></i> VER</button>
            </div>
            <div style="float:right">
                <div style="float:left" class='d-none d-lg-block'><button disabled="disabled" class="btn btn-fecha btn-sm"><?PHP echo substr($rowp[$countrow]['fecha'], 0, -3); ?></button></div>
                <div style="float:left; margin-top:6px;" id='estado<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>'>
					<?PHP $tipo = "apli_$apli"; $id_tipo = $rowp[$countrow]["id_apli_".strtolower($apli)]; include("$path/_admin/gestion/estado.php"); ?>
                </div>
            </div>
        </div>
        <div class="card-body">		
                        <h5>
						<?PHP 
                            echo $rowp[$countrow]['titulo'];
                        ?>
                        </h5>
  						<?PHP 
								$result_tag = mysqli_query($cnx, "SELECT * FROM apli_TAG WHERE ((estado > 1) AND (id_apli_TAGDETAG LIKE '%".$rowp[$countrow]['id_apli_tagdetag'].";%')) ORDER BY titulo ASC");
								while($row_tag = mysqli_fetch_array($result_tag))
								{
									?>
                                    <div class="p-1 float-left"><button disabled="disabled" class="btn btn-fecha btn-sm "><?PHP echo $row_tag['titulo'] ?></button></div>
                                    <?
								}
                        ?>
        </div>
    </div><br />
			<?PHP	
		$countrow++;	
	}
?>
