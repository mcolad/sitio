<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP $include = "../_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>
<? if(file_exists('declaraciones.php')){ include_once('declaraciones.php'); }; ?>
<?
	if(!empty($_GET['editar'])){ $collapseOne = 'show'; $collapseTwo = ''; }else{ $collapseOne = ''; $collapseTwo = 'show'; } 
	$publicar = $row_data['publicar'];
?>
<?PHP if(!empty($_GET['play'])){ if(ctype_digit($_GET['play'])){ $play = $_GET['play']; } else { $play = 0; } } else { $play = 0; } ?> 
<?PHP if(!empty($_GET['filtro_tag'])){ if(ctype_digit($_GET['filtro_tag'])){ $filtro_tag = $_GET['filtro_tag']; } else { $filtro_tag = ''; } } else { $filtro_tag = ''; } ?> 
<?PHP if(empty($_GET['order_que'])){ $order_que = "listorder"; } else { $order_que = $_GET['order_que']; }  ?>  
<?PHP $validate_order_array = array("ASC", "DESC"); if(!empty($_GET['order'])){ if(in_array($_GET['order'], $validate_order_array)){  $order = $_GET['order']; } else { $order = 'DESC'; } }  else { $order = 'DESC'; }  ?>  
<?PHP if(!empty($_GET['filtro_padre'])){ $filtro_padre = $_GET['filtro_padre']; } else { $filtro_padre = ''; }  ?>  
<?PHP if(!empty($_GET['titulo_apli_padre'])){ $titulo_apli_padre = $_GET['titulo_apli_padre']; } else { $titulo_apli_padre = ''; }  ?>  

<!--INSERTAR-->
<?PHP
$flag_elimina_gestion = '';
if(!empty($_GET['confirma']))
{
		$id = $_GET['id'];
		if(!empty($_POST['fecha'])){ mysqli_query($cnx, "UPDATE apli_$apli SET fecha = '".$_POST['fecha']."' WHERE id_apli_".strtolower($apli)." = '".$id."';"); }

		$result_column = mysqli_query($cnx, "SHOW COLUMNS FROM apli_$apli");
		while($row_column = mysqli_fetch_array($result_column))
		{
			if(empty($exepciones[$row_column['Field']]['insert'])){ $exepciones[$row_column['Field']]['insert'] = 'insert'; }
			if($exepciones[$row_column['Field']]['insert'] != 'noinsert')
			{	
				if(!empty($_POST[$row_column['Field']])){ $inyecta = $_POST[$row_column['Field']]; } else { $inyecta = ''; } // esto se tiene que hacer porque los check box envian datos vacios
				mysqli_query($cnx, "UPDATE apli_$apli SET ".$row_column['Field']." = '".charesp($inyecta)."' WHERE id_apli_".strtolower($apli)." = '".$id."';");
			}
		}
		$result = mysqli_query($cnx, "SELECT * FROM apli_$apli WHERE id_apli_".strtolower($apli)." = '".$id."'; "); 
		$row = mysqli_fetch_array($result);
		
		if($filtro_padre != ''){ mysqli_query($cnx, "UPDATE apli_$apli SET id_apli_padre = '".$filtro_padre."' WHERE id_apli_".strtolower($apli)." = '".$id."';"); }

		mysqli_query($cnx, "UPDATE apli_$apli SET usuario = '".$row['usuario']."\n".date('ymdHis').";".$_SESSION['nick']."' WHERE id_apli_$apli = '".$id."';");

		if(file_exists('insert.php')){ include_once('insert.php'); };
}
// elimina vacios
$query = "DELETE FROM apli_$apli WHERE (titulo is NULL) OR (titulo = '')";
mysqli_query($cnx, $query); 
?>
<!-- FIN INSERTAR-->

<body>
	<div class="wrapper"><?PHP if(empty($menu)){ $include = "_admin/menu.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); }?>
        <div id="content">
            <nav style='margin-bottom:10px'>
                <div class="container-fluid"> 
                	<div class="row"> 
                        <div class="col-auto">
				           <?PHP 
						   		if(empty($menu)) 
						   		{ 
									?>
                                             <button type="button" id="sidebarCollapse" class="btn btn_admin"><? svg('svgadmin/bars.svg', 20, 20, '#667788') ?> </button>
                                    		<span class='btn btn-primary'><? echo strtoupper($row_data['bajada']) ?></span>
                                             
									<?
                                             if($_SESSION['acc_adm_us']  > 5)
                                             {
										?>
                                                  <button class='btn btn-admin btn-sm modalButton' data-toggle='modal' data-src='<? echo $path ?>_admin/gestion/vertodo.php?apli=<? echo $apli ?>' data-width=100% data-target='#myModalsinReload100'><span class="d-inline"><? svg('svgadmin/eye.svg', 17, 17, 'gray') ?></span><span class="d-none d-sm-inline" style="position:relative; top:-3px;"> VER</span></button>
                                                  <a class='btn btn-admin btn-sm' style="background-color:#EFEFEF" href='../../_aplis/apli_APLIS/index.php?editar=1&play=0&id=<? echo $row_data['id_apli_aplis']; ?>'><span class="d-inline"><? svg('svgadmin/pen.svg', 17, 17, 'gray') ?></span><span class="d-none d-sm-inline" style="position:relative; top:-3px;"> EDITAR</span></a>
										<?
									}
                                             ?>   
									<?
                                             if($titulo_apli_padre != '')
									{ 
										?>
										[<? echo "<a href='../apli_".$titulo_apli_padre."'>".$titulo_apli_padre."</a>" ?>]
										<? 
									}
									echo " ".$apli." ";    
								} 
								elseif($menu == 'menu_adjuntos') 
								{
									$menu_adjuntos = array ('IMG', 'PDF', 'ZIP');
									foreach ($menu_adjuntos as $valor) 
									{ 
										$result_nro = mysqli_query($cnx, "SELECT * FROM apli_".$valor." WHERE ((estado > 0) AND (id_apli = ".$_GET['id_apli']."))");
										$cantidad_nro = mysqli_num_rows($result_nro);
										if($apli == $valor){ $active_menu_adjunto = "disabled='true'"; } else { $active_menu_adjunto = ''; } 
										?><button <? echo $active_menu_adjunto; ?> onClick="window.location.href='../apli_<? echo $valor?>/?id_apli=<? echo $_GET['id_apli'] ?>&titulo_apli_padre=<? echo $titulo_apli_padre ?>'" type="button" id="sidebarCollapse" class="btn btn_admin"><? echo $valor ?> <div class="badge badge-light"><? echo $cantidad_nro ?></div></button> <?
									}
								}
								elseif($menu == 'menu_tag') 
								{
									$menu_adjuntos = array ('tag');
									foreach ($menu_adjuntos as $valor) 
									{ 
										if($apli == $valor){ $active_menu_adjunto = "disabled='true'"; } else { $active_menu_adjunto = ''; } 
										?><button <? echo $active_menu_adjunto; ?> onClick="window.location.href='../apli_<? echo $valor?>/?id_apli=<? echo $_GET['id_apli'] ?>&titulo_apli_padre=<? echo $titulo_apli_padre ?>'" type="button" id="sidebarCollapse" class="btn btn_admin"><? echo $valor?></button><?
									}
								}
								?>
                        </div>
                        <div class="col text-right">
                         <?
 						if($filtro_padre != ''){ $filtro_padre_sql = "id_apli_padre LIKE '%".$filtro_padre."%' AND "; } else { $filtro_padre_sql = ''; } 
						$query = "SELECT * FROM apli_$apli WHERE $filtro_padre_sql estado > 0";
						$result_registros = mysqli_query($cnx, $query);
						$cantidad_registros = mysqli_num_rows($result_registros);
                         ?>
                         <?  if($publicar OR !$cantidad_registros) {?>
                            <style> @media (max-width: 768px) { #headingOne span { display: none; } #headingTwo span { display: none; }} </style> 
                            <button title="subir contenido" <? if(!empty($_GET['editar'])){ echo "disabled='true'"; }?> id="headingOne" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span class="d-inline"><? svg('svgadmin/plus.svg', 15, 15, 'white') ?></span><span class="d-none d-sm-inline" style="position:relative; top:-3px;"> agregar <? // echo $cantidad_registros ?></span></button>
                            <button title="ver contenido" disabled='true' id="headingTwo" class="btn btn-success" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><span class="d-inline"><? svg('svgadmin/list-ul.svg', 15, 15, 'white') ?></span><span class="d-none d-sm-inline" style="position:relative; top:-3px;"> ver todo</span></button>
                        <? }?> 
                        </div>
					</div>
                </div>
            </nav>
            <div id="accordion">
            
            
            
            
            
                      <div class="card">
                        <div id="collapseOne" class="collapse <? echo $collapseOne ?>" aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
                          
 
 
 
 
 
 
 
 
<!--EDITAR-->
<?PHP 
		if(!empty($_GET['id']) AND empty($_GET['confirma']))
		{
			$id = $_GET['id'];
			$result = mysqli_query($cnx, "SELECT * FROM apli_$apli WHERE id_apli_".strtolower($apli)." = '".$_GET['id']."'; "); 
			$row = mysqli_fetch_array($result);
	
			$result_column = mysqli_query($cnx, "SHOW COLUMNS FROM apli_$apli");
			while($row_column = mysqli_fetch_array($result_column))
			{
				if(!in_array($row_column['Field'], $exepciones))
				{	
					${$row_column['Field']} = $row[$row_column['Field']];
				}
			}
			$id_apli_tag = $row['id_apli_tag'];
		}
		else
		{
			$result_listorder = mysqli_query($cnx, "SELECT * FROM apli_$apli ORDER BY listorder + 0 DESC LIMIT 1"); 
			$row_listorder = mysqli_fetch_array($result_listorder);
			$listorder_imp = $row_listorder['listorder']+1;

			$id = date('YmdHis');
			$sql = mysqli_query($cnx, "INSERT INTO apli_$apli (id_apli_".strtolower($apli).", listorder) VALUES ('".$id."', '".$listorder_imp."')") or die(mysqli_error());
	
			$result_column = mysqli_query($cnx, "SHOW COLUMNS FROM apli_$apli");
			while($row_column = mysqli_fetch_array($result_column))
			{
				if(!in_array($row_column['Field'], $exepciones))
				{	
					${$row_column['Field']} = '';
				}
			}
			$fecha = date('Y-m-d H:i');
			$id_apli_tag = '';
			$listorder = $listorder_imp;
		}
?>
				<? 
				// ADJUNTOS
				if($row_data['adjuntos']) 
				{?>
                    <div class="row">
                         <div class='col-3 text-left'>
                              <div>Registro Nro <? echo $listorder; ?></div>
                         </div>
                         <div class='col-3 text-left'>
                              <div class='float-right' id='estado<? echo $id ?>'>
                              <?PHP $tipo = "apli_$apli"; $id_tipo = $id; include("$path/_admin/gestion/estado.php"); ?>
                              </div>
                         </div>
     
                         <div class='col-6 text-right'>
                              <button class='btn btn-admin btn-sm modalButton' data-toggle='modal' data-src='<? echo $path; ?>/_admin/_aplis/apli_IMG/index.php?menu_adj=1&id_apli=<? echo $id; ?>&apli_padre=<? echo $apli; ?>' data-width=100% data-target='#myModal_adj'><? svg('svgadmin/paperclip.svg', 20, 20 ,'green');  ?><span style=" position:relative; top:-5px"> Adjuntos</span></button>
                         </div>
				</div>
				<? }  ?>
			<form name="formu" action="?titulo_apli_padre=<? echo $titulo_apli_padre ?>&filtro_padre=<? echo $filtro_padre; ?>&id=<? echo $id; ?>&play=<? echo $play ?>&order_que=<? echo $order_que ?>&order=<? echo $order ?>&filtro_tag=<? echo $filtro_tag ?>&confirma=1" method="post">
			<div class="form-group">
					<div class="row">
	<?                    
     $result_column = mysqli_query($cnx, "SHOW FULL COLUMNS FROM apli_$apli");
     while($row_column = mysqli_fetch_array($result_column))
     {
               if(empty($exepciones[$row_column['Field']]['edit'])){ $exepciones[$row_column['Field']]['edit'] = 'edit'; }
               if($exepciones[$row_column['Field']]['edit'] != 'noedit')
               {	
                    if(!empty($exepciones[$row_column['Field']]['disabled'])){ $disabled = $exepciones[$row_column['Field']]['disabled']; }else{ $disabled = ''; }
                    if(!empty($exepciones[$row_column['Field']]['style'])){ $style = $exepciones[$row_column['Field']]['style']; }else{ $style = ''; }
				if(($row_column['Field'] == 'titulo') OR (strpos($row_column['Comment'], '[obligatorio]') !== false)) { $required = 'required'; } else { $required = ''; }

				// lo que sea /4/8 --- lo que sea /4
				if(ctype_digit(substr(strrchr($row_column['Comment'], "/"), 1))){ $col = substr(strrchr($row_column['Comment'], "/"), 1); } else { $col = '12'; }
				$row_column['Comment'] = str_replace(strrchr($row_column['Comment'], "/"), '', $row_column['Comment']); // askjdklasj 

				if($row_column['Comment'] != ''){ $coment = $row_column['Comment']; } else { $coment = $row_column['Field']; }

                    if($row_column['Type'] == 'mediumtext')	
                    {
                    ?>
                         <div class='col-md-<? echo $col ?>' style=" <? echo $style ?>"><? echo $style ?>
                              <label><? echo $coment ?> <small><? echo ($row_column['Comment']) ?></small></label>
                                   <img src="<? echo $path; ?>/_admin/_js/_editor/negrita.gif" alt="negrita" onClick="formatear(this, 'b')"/>
                                   <img src="<? echo $path; ?>/_admin/_js/_editor/cursiva.gif" alt="negrita" onClick="formatear(this, 'i')"/>
                                   <img src="<? echo $path; ?>/_admin/_js/_editor/subrayado.gif" alt="negrita" onClick="formatear(this, 'u')"/>
                                   <img src="<? echo $path; ?>/_admin/_js/_editor/url.gif" alt="url" onClick="uri()"/><font color="#666666" size="-2">Para agregar un adjunto inserte el código del mismo</font><br />
                              <textarea <? echo $required ?> <? echo $disabled; ?> class='form-control' rows="4" name='<? echo $row_column['Field'] ?>' id="edited" onFocus="elEditor = ini_editor(this)" onChange="prever()" ><? echo ${$row_column['Field']}; ?></textarea>
                         </div>                                    
                    <?
                    }
                    elseif($row_column['Type'] == 'datetime')	
                    {
                         ?>
                         <div class='col-md-<? echo $col ?>' style=" <? echo $style ?> <? if(!$row_data['fecha_sino']){ echo "display:none;";}?>"><? echo $style ?> 
                                   <label><? echo $coment ?> <small><? echo ($row_column['Comment']) ?></small></label><br />
                                   <input <? echo $required ?> <? echo $disabled; ?> name='<? echo $row_column['Field'] ?>' id='<? echo $row_column['Field'] ?>' value='<?PHP echo substr(${$row_column['Field']}, 0, 16); ?>' type='text' class='form-control'/>
                                   <script>$('#<? echo $row_column['Field'] ?>').datetimepicker({ footer: true, modal: true, format: 'yyyy-mm-dd HH:MM' });</script>
                         </div>
                         <?
                    } 
                    elseif($row_column['Type'] == 'date')	
                    {
                         ?>
                         <div class='col-md-<? echo $col ?>' style=" <? echo $style ?>"><? echo $style ?>
                                   <label><? echo $coment ?> <small><? echo ($row_column['Comment']) ?></small></label><br />
                                   <input <? echo $required ?> <? echo $disabled; ?> name='<? echo $row_column['Field'] ?>' id='<? echo $row_column['Field'] ?>' value='<?PHP echo ${$row_column['Field']}; ?>' type='text' class='form-control'/>
                                   <script>$('#<? echo $row_column['Field'] ?>').datepicker({ footer: true, modal: true, format: 'yyyy-mm-dd' });</script>
                         </div> 
                         <?
                    }
                    elseif($row_column['Type'] == 'time')	
                    {
                         ?>
                         <div class='col-md-<? echo $col ?>' style=" <? echo $style ?>"><? echo $style ?>
                                   <label><? echo $coment ?> <small><? echo ($row_column['Comment']) ?></small></label><br />
                                   <input <? echo $required ?> <? echo $disabled; ?> name='<? echo $row_column['Field'] ?>' id='<? echo $row_column['Field'] ?>' value='<?PHP echo substr(${$row_column['Field']}, 0, 5); ?>' type='text' class='form-control'/>
                                   <script>$('#<? echo $row_column['Field'] ?>').timepicker({ footer: true, modal: true,  mode: '24hr', format: 'HH:MM' });</script>
                         </div> 
                         <?
                    }
                    elseif($row_column['Type'] == 'tinyint(1)')	
                    {
                         ?> 
                         <div class='col-md-<? echo $col ?>' style="margin-bottom:20px; <? echo $style ?>"><? echo $style ?> 
                                      <label><? echo $coment ?> <small><? echo ($row_column['Comment']) ?></small></label><br />
                                      <div class="material-switch">
                                      <? if(${$row_column['Field']} == 1){ $checked = 'checked="checked"'; } else { $checked = ''; } ?>
                                      <input id="switch-<? echo $row_column['Field'] ?>" name="<? echo $row_column['Field'] ?>" value="1" <? echo $checked ?>  type="checkbox">
                                      <label for="switch-<? echo $row_column['Field'] ?>" class="info-color"></label>
                                      </div>
                         </div> 
                         <?
                    }
                    elseif(ctype_digit($row_column['Field']))	
                    {
                         ?> 
                         <div class='col-md-<? echo $col ?>' style=" <? echo $style ?>"><? echo $style ?>
                              <label class="w-100"><div style="text-align:right; float:left;"><? echo $coment ?></div>
                              <? 
                                   tag_formu($row_column['Field'], $apli, $id, $id_apli_tag);
                              ?>
                         </div>
                         <?
                    }
				else
                    {
                    ?>
                         <div class='col-md-<? echo $col ?>' style=" <? echo $style ?>"><? echo $style ?>
                              <label class="w-100"><div style="text-align:right; float:left;"><? echo $coment ?></div>
                              <div style="text-align:left; float:right"> <small><? // echo ($row_column['Comment']) ?></small></div></label><br />
                              <input <? echo $required ?> <? echo $disabled; ?> class='form-control'  name='<? echo $row_column['Field'] ?>' value='<?PHP  echo ${$row_column['Field']}; ?>' type='text'/>
                              <label style="margin-top:0px" class="w-100"><small><? echo $row_column['Field'] ?></small></label>
                         </div> 
                    
                    <?	
                    }
               }
     }
?>                    
					</div>
			   
						<? if(file_exists('edit.php')){ include_once('edit.php'); };  ?>
	
	
					<? if(empty($noedit_tags)){ ?>
					<div class="row"> 
                              <div class='col-md-12' style="margin-top:20px">
                              <? 
                                   $result = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (titulo = '$apli')");
                                   $row_tag = mysqli_fetch_array($result);
                                   $array_id_apli_tagdetag = explode(";", $row_tag['id_apli_tagdetag']);
                                   tag($array_id_apli_tagdetag, $apli, $id, $id_apli_tag);
                              ?>
                              </div>
                         </div>
                         <? } ?>

					<div class="row"> 
						<div class='col-md-12 text-center mt-3'> 
							<button class='btn btn-success' value="Guardar" type="submit"/>Guardar</button>
                                   <? if(!empty($_GET['id']) AND empty($_GET['confirma'])) { ?>
                                   <button class="btn btn-danger" value="Cancelar" type="reset" onClick="location.href='?filtro_padre=<? echo $filtro_padre ?>&play=<? echo $play ?>&play=<? echo $play ?>&order_que=<? echo $order_que ?>&order=<? echo $order ?>&filtro_tag=<? echo $filtro_tag ?>'" />Cancelar</button>
							<? } else { ?><button title="ver contenido" id="headingTwoTwo" type="reset" class="btn btn-danger" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Cancelar</button><? }?> 
						</div>
					</div>
			</div>
			</form>
            
<!--FIN EDITAR-->
			<? if(file_exists('edit_extra.php')){ include_once('edit_extra.php'); };  ?>




















                          </div>
                        </div>
                      </div>
                      
                      <div class="bg-light">
                        <div id="collapseTwo" class="collapse <? echo $collapseTwo ?>" aria-labelledby="headingTwo" data-parent="#accordion">
                          <div class="card-body">
                          
                          
                          
                          
                          
                          
<!--LISTAR-->
<div class="row">
    <div class="col-3">
		<? 
               if($result = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (titulo = '$apli')"))
               {
                    $row = mysqli_fetch_array($result);
                    $id_apli_hijos = $row['id_apli_hijos'];
               }
               else{ $id_apli_hijos = ''; }
               
               $array_id_apli_tagdetag = explode(";", $row['id_apli_tagdetag']);
               if (empty($_GET['filtro_id'])) { tag_filtro($array_id_apli_tagdetag, $apli); }
               if(!empty($_GET['filtro_tag'])){ $sql_tag = " AND id_apli_tag LIKE '%".$_GET['filtro_tag']."%'"; $filtro_tag = $_GET['filtro_tag']; } else { $sql_tag = ''; $filtro_tag = ''; }
               if(!empty($_GET['filtro_id'])){ $sql_id = " AND id_apli_$apli = '".$_GET['filtro_id']."'"; $filtro_id = $_GET['filtro_id']; } else { $sql_id = ''; $filtro_id = ''; }


          ?>
   </div>
   <div class="col-6">
		<?
          //	echo "x".$filtro_padre."x";
               
               if($filtro_padre != ''){ $filtro_padre_sql = "id_apli_padre LIKE '%".$filtro_padre."%' AND "; } else { $filtro_padre_sql = ''; } 
          
               $select = "*";
               $from = "apli_$apli";
               $where = "WHERE $filtro_padre_sql titulo <> '' $sql_tag $sql_id ";
          //echo $filtro_padre." / ".$where;
          //	$order_que = "fecha";
          //	$order = "DESC";
               $var = "filtro_tag=".$filtro_tag."&titulo_apli_padre=".$titulo_apli_padre."&filtro_padre=$filtro_padre"; 
               list($rowp) = paginador($select, $from, $where, $order_que, $order, $var, 5);
          ?>
    </div>
    <div class="col-3 text-right">
		<?
          include('../../gestion/buscador_predictivo.php');
          ?>
    </div>
</div>	





	<?PHP
$countrow = 0;
while(!empty($rowp[$countrow]))
{
	if($rowp[$countrow]["fecha"] > date('Y-m-d H:i')){ $title = 'El contenido se pulica a partir de la fecha y hora establecida'; $fecha_publi = 'border-fechapublicacion';}
	else { $title = ''; $fecha_publi = 'bg-green';}
	?>
	<div class="card">
	    <div class='card-header '>
	            <div class="row">
	                <div class='col-auto'>		
	                        <button class='btn btn-success btn-sm' onClick="window.location.href='?editar=1&titulo_apli_padre=<? echo $titulo_apli_padre ?>&filtro_padre=<? echo $filtro_padre ?>&play=<? echo $play; ?>&order_que=<? echo $order_que ?>&order=<? echo $order ?>&filtro_tag=<? echo $filtro_tag; ?>&id=<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>'"><span class="d-inline"><? svg('svgadmin/pen.svg', 17, 17, 'white') ?></span><span class="d-none d-sm-inline" style="position:relative; top:-3px;"> EDITAR</span></button>
	                        <? if($_SESSION['acc_adm_us']  > 5) { ?><button class='btn btn-admin btn-sm modalButton' data-toggle='modal' data-src='<? echo $path ?>_admin/gestion/ver.php?apli=<? echo $apli ?>&id=<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>' data-width=100% data-target='#myModalsinReload'><span class="d-inline"><? svg('svgadmin/eye.svg', 17, 17, 'gray') ?></span><span class="d-none d-sm-inline" style="position:relative; top:-3px;"> VER</span></button><? } ?>
	                        <? if($row_data['adjuntos']) { ?><button class='btn btn-admin btn-sm modalButton' data-toggle='modal' data-src='<? echo $path; ?>/_admin/_aplis/apli_IMG/index.php?menu_adj=1&id_apli=<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>&apli_padre=<? echo $apli; ?>' data-width=100% data-target='#myModal_adj'><span class="d-inline"><? svg('svgadmin/paperclip.svg', 17, 17,'gray');  ?></span><span class="d-none d-sm-inline" style="position:relative; top:-3px;"> ADJUNTOS</span></button><? } ?>
	                </div>
	                <div class="col">
	                    <div class='float-right' id='estado<? echo $rowp[$countrow]["id_apli_".strtolower($apli)] ?>'>
	                        <?PHP $tipo = "apli_$apli"; $id_tipo = $rowp[$countrow]["id_apli_".strtolower($apli)]; include("$path/_admin/gestion/estado.php"); ?>
	                    </div>
	                    <div class='d-none d-lg-block float-right'><? echo $rowp[$countrow]['listorder'] ?><button disabled="disabled" title='<?PHP echo  $title ?>' class="btn btn-fecha btn-sm <?PHP echo  $fecha_publi  ?>"><?PHP echo substr($rowp[$countrow]['fecha'], 0, -3); ?></button>&nbsp;</div>
	                </div>
		  		</div>
			</div>
	    <div class="card-body ">		
	           <div class="row">
	                <?
	                if(!empty($rowp[$countrow]['destacado']))
	                {
					$img_destacado = ''; $pdf_destacado = ''; $zip_destacado = ''; 
					$array_destacado = explode(";", $rowp[$countrow]['destacado']);
					foreach($array_destacado as $value)
					{
						if('IMG' == substr($value, 0, 3)) { $img_destacado = substr($value, 4); } 
						if('PDF' == substr($value, 0, 3)) { $pdf_destacado = substr($value, 4); } 
						if('ZIP' == substr($value, 0, 3)) { $zip_destacado = substr($value, 4); } 
					}
					?>
					<? if($img_destacado != ''){ ?><div class='col-auto'><?PHP  echo "<a title='ver imagen destacada' onclick=\"return hs.expand(this)\" href='".$path."/_fotos/".$img_destacado.".jpg'><img style='padding:5px' width=65px; src='".$path."/_fotos/".$img_destacado."_300x300.jpg'></a>"; ?> </div><? } ?>
					<? if($pdf_destacado != ''){ ?><div class='col-auto'><?PHP  echo "<a title='ver pdf destacado' target='_blank' href='".$path."/_pdf/".$pdf_destacado.".pdf'>"; svg('svgadmin/file-pdf.svg', 65, 65, '#ccc'); echo "</a>"; ?> </div><? } ?>
					<? if($zip_destacado != ''){ ?><div class='col-auto'><?PHP  echo "<a title='ver zip destacado' target='_blank' href='".$path."/_zip/".$zip_destacado.".zip'>"; svg('svgadmin/file-archive.svg', 65, 65, '#ccc'); echo "</a>"; ?> </div><? } ?>
	                <? } ?>
	           
	           <div class='col'><h5><?PHP echo $rowp[$countrow]['titulo']; ?> </h5></div> 
	           </div>
	              
			<? if(file_exists('listar.php')){ include('listar.php'); };  ?>
	   </div>
	   
	    <div class="card-footer">	 
	       <? 
			tag($array_id_apli_tagdetag, $apli, $rowp[$countrow]["id_apli_".strtolower($apli)], $rowp[$countrow]['id_apli_tag'], 1); ?>	
	    </div>

	       <? if($id_apli_hijos != '')  
		 { 
		 ?>
	         <div class="card-footer">	 
		<?
			$array_hijos = explode(";", $id_apli_hijos);
			$array_hijos = array_filter($array_hijos);
			foreach ($array_hijos as &$valor) 
			{
				$result_hijos = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (id_apli_aplis = '$valor')");
				$row_hijos = mysqli_fetch_array($result_hijos);
				echo "<a class='btn btn-sm btn-outline-success' href='../apli_".$row_hijos['titulo']."/?titulo_apli_padre=".$apli."&filtro_padre=".$rowp[$countrow]["id_apli_".strtolower($apli)]."'>".$row_hijos['bajada']."</a>&nbsp;"; 
			}		
			?>
		</div>
		<?
		} 
		 ?>	
	</div> 
	<br />
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

<div class="row">
   <div class="col-3"> </div>
   <div class="col-6">
		<?     
               if($filtro_padre != ''){ $filtro_padre_sql = "id_apli_padre LIKE '%".$filtro_padre."%' AND "; } else { $filtro_padre_sql = ''; } 
          
               $select = "*";
               $from = "apli_$apli";
               $where = "WHERE $filtro_padre_sql titulo <> '' $sql_tag $sql_id ";
               $var = "filtro_tag=".$filtro_tag."&titulo_apli_padre=".$titulo_apli_padre."&filtro_padre=$filtro_padre"; 
               list($rowp) = paginador($select, $from, $where, $order_que, $order, $var, 5);
          ?>
    </div>
    <div class="col-3 text-right"></div>
</div>	



<!--FIN LISTAR-->
                      
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          </div>
                        </div>
                      </div>
 
 
 
 
 
 
 
 
 
            </div>
        </div>
    </div>
</body>
<script>
document.getElementById("headingOne").addEventListener("click", cierraOne);
function cierraOne() {
	$("#collapseOne").collapse('show');
	document.getElementById('headingOne').disabled = true;
	document.getElementById('headingTwo').disabled = false;
}
document.getElementById("headingTwo").addEventListener("click", cierraTwo);
function cierraTwo() {
	$("#collapseTwo").collapse('show');
    document.getElementById('headingOne').disabled = false;
	document.getElementById('headingTwo').disabled = true;
}
document.getElementById("headingTwoTwo").addEventListener("click", cierraTwoTwo);
function cierraTwoTwo() {
	$("#collapseTwo").collapse('show');
    document.getElementById('headingOne').disabled = false;
	document.getElementById('headingTwo').disabled = true;
}

</script>

<?PHP $include = "../_admin/footer.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>