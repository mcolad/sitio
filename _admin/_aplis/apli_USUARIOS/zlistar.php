<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>
<div class="row">
    <div class="col-12">
<? 
	$result = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (titulo = '$apli')");
	$row = mysqli_fetch_array($result);
	$array_id_apli_tagdetag = explode(";", $row['id_apli_tagdetag']);
	tag_filtro($array_id_apli_tagdetag, '$apli');
	if(!empty($_GET['filtro_tag'])){ $sql_tag = " AND id_apli_tag LIKE '%".$_GET['filtro_tag']."%'"; $filtro_tag = $_GET['filtro_tag']; } else { $sql_tag = ''; $filtro_tag = ''; }
?>
    </div>
    <div class="col-12">

<?
	$select = "*";
	$from = "apli_$apli";
	$where = "WHERE titulo <> '' $sql_tag";
	$order_que = "listorder";
	$order = "DESC";
	$var = "filtro_tag=".$filtro_tag; 
	list($rowp) = paginador($select, $from, $where, $order_que, $order, $var, 5);
?>
    </div>
</div>	
  	<?PHP
	$countrow = 0;
	while(!empty($rowp[$countrow]))
	{
//		if($rowp[$countrow]["fecha"] > date('Y-m-d H:i')){ $title = 'El contenido se pulica a partir de la fecha y hora establecida'; $fecha_publi = 'border-fechapublicacion';}
//		else { $title = ''; $fecha_publi = 'bg-green';}
	?>
	<div class="card">
        <div class='card-header '>
                <div class="row">
                    <div class='col-auto'>		
                            <button class='btn btn-admin btn-sm' onclick="window.location.href='index.php?editar=1&play=<? echo $play; ?>&filtro_tag=<? echo $filtro_tag; ?>&id=<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>'">EDITAR</button>
                            <button class='btn btn-admin btn-sm modalButton' data-toggle='modal' data-src='<? echo $path ?>_admin/gestion/ver.php?apli=<? echo $apli ?>&id=<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>' data-width=100% data-target='#myModal'><i class="far fa-eye"></i> VER</button>
                    </div>
                    <div class="col">
                        <div class='float-right' id='estado<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>'>
                            <?PHP $tipo = "apli_$apli"; $id_tipo = $rowp[$countrow]["id_apli_".strtolower($apli)]; include("$path/_admin/gestion/estado.php"); ?>
                        </div>
                       <!-- <div class='d-none d-lg-block float-right'><button disabled="disabled" title='<?PHP echo  $title ?>' class="btn btn-fecha btn-sm <?PHP echo  $fecha_publi  ?>"><?PHP echo substr($rowp[$countrow]['fecha'], 0, -3); ?></button>&nbsp;</div>-->
                    </div>
		  		</div>
  		</div>
        <div class="card-body ">		
                <div class="row">
                    <div class='col-auto'><?PHP  if(!empty($rowp[$countrow]['destacado'])){echo "<a title='ver nota' href='".$path."/_fotos/".$rowp[$countrow]['destacado']."_original.jpg' onclick=\"return hs.expand(this)\"><img style='padding:5px' width=65px; src='".$path."/_fotos/".$rowp[$countrow]['destacado']."_300x300.jpg'></a>";} ?> </div>
                    <div class='col'><h5><?PHP echo $rowp[$countrow]['titulo']; ?> </h5></div> 
		        </div>
        </div>
        <div class="card-footer">	 
           <? tag($array_id_apli_tagdetag, "$apli", $rowp[$countrow]["id_apli_".strtolower($apli)], $rowp[$countrow]['id_apli_tag'], 0); ?>	
        </div>
    </div>
    <br />
	<?PHP	
		$countrow++;	
	}
?>

