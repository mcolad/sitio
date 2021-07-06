<?PHP 

/*	$sql = "ALTER TABLE `apli_aplis` 
	ADD COLUMN `adjuntos` 
	varchar(1)
	DEFAULT '1'
	AFTER `publicar`
	";
	if (!mysqli_query($cnx, $sql)){ echo "Error al crear la tabla: " . mysqli_error($cnx); }	
*/


	if(!empty($_GET['id']) AND empty($_GET['confirma']))
	{
		$id = $_GET['id'];
		$result = mysqli_query($cnx, "SELECT * FROM apli_$apli WHERE id_apli_".strtolower($apli)." = '".$_GET['id']."'; "); 
		$row = mysqli_fetch_array($result);
		$fecha_nota = $row['fecha'];
		$titulo = $row['titulo'];
		$bajada = $row['bajada'];
		$publicar = $row['publicar'];
		$fecha_sino = $row['fecha_sino'];
		$acc_adm = $row['acc_adm'];
		$adjuntos = $row['adjuntos'];
		$menu_admin = $row['menu_admin'];
		$disable = 'readonly="readonly"';
	}
	else
	{
		$id = date('YmdHis');
		mysqli_query($cnx, "INSERT INTO apli_$apli (id_apli_".strtolower($apli).") VALUES ('".$id."')") or die(mysqli_error());
 		$fecha_nota = date('Y-m-d H:i');
		$id_apli_tag = '';
		$titulo = '';
		$bajada = '';
		$publicar = '1';
		$adjuntos = '1';
		$fecha_sino = '1';
		$acc_adm = '5';
		$menu_admin = '00000000000002';
		$disable = '';
	}
?>

	<?
     if(!empty($_GET['id']) AND empty($_GET['confirma']))
     {
     ?>
          <button class='btn btn-admin btn-sm modalButton' data-toggle='modal' data-src='sql.php?apli=<? echo $apli ?>&id=<? echo $id ?>' data-width=100% data-target='#myModal'><? svg('svgadmin/database.svg', '15', '15') ?></span> SQL</button>
          <button class='btn btn-admin btn-sm' onclick="window.location.href='../../__aplis/<? echo "apli_".$titulo ?>/'"><span><? svg('svgadmin/external-link-alt.svg', '15', '15') ?></span> IR</button>
     <?
     }
     ?>

    	<form name="formu" action="index.php?id=<? echo $id; ?>&play=<? echo $play ?>&confirma=1" method="post">
        <div class="form-group">
            <div class="row">





                    <div class="col-10">
                        <div class="row">
                            <div class="col-6">
                                    <label>Fecha y hora</label><br />
                                    <input name='fecha_nota' id='fecha_nota' value='<?PHP  echo $fecha_nota; ?>' type='text' class='form-control'/>
                                    <script>$('#fecha_nota').datetimepicker({ footer: true, modal: true, format: 'yyyy-mm-dd HH:MM' });</script>
                            </div>    
  
                            <div class="col-6">
                                            <label>Nombre Carpeta</label><br />
                                            <input <? echo $disable ?> class='form-control' name='titulo' value='<?PHP  echo $titulo; ?>' type='text'/>
                            </div>    
                            <div class="col-12">
                                            <label>Nombre</label><br />
                                            <input class='form-control' name='bajada' value='<?PHP  echo $bajada; ?>' type='text'/>
                            </div>                     
                        </div>
                    </div>
                    <div class="col-2">
                            <div class="row">
                                <div class="col-12">
                                                <label>&nbsp;</label><br />
                                                <div style="float:left; margin-top:5px;">Publicar&nbsp;&nbsp;&nbsp;</div><div class="material-switch">
                                                <? if($publicar == 1){ $checked = 'checked="checked"'; } else { $checked = ''; } ?>
                                                <input id="switch-info" name="publicar" value="1" <? echo $checked ?>  type="checkbox">
                                                <label for="switch-info" class="info-color"></label>
                                                </div>
                                </div>
                            
                                <div class="col-12">
                                                <label>&nbsp;</label><br />
                                                <div style="float:left; margin-top:5px;">Adjuntos&nbsp;&nbsp;&nbsp;</div><div class="material-switch">
                                                <? if($adjuntos == 1){ $checked = 'checked="checked"'; } else { $checked = ''; } ?>
                                                <input id="switch-info2" name="adjuntos" value="1" <? echo $checked ?>  type="checkbox">
                                                <label for="switch-info2" class="info-color"></label>
                                                </div>
                                </div>
                                <div class="col-12">
                                                <label>&nbsp;</label><br />
                                                <div style="float:left; margin-top:5px;">Fecha&nbsp;&nbsp;&nbsp;</div><div class="material-switch">
                                                <? if($fecha_sino == 1){ $checked = 'checked="checked"'; } else { $checked = ''; } ?>
                                                <input id="switch-info3" name="fecha_sino" value="1" <? echo $checked ?>  type="checkbox">
                                                <label for="switch-info3" class="info-color"></label>
                                                </div>
                                </div>
                        
                                <div class="col-12">
                                                <br />
                                                <label>Permiso ADMIN</label><br />
                                                <input class='form-control' name='acc_adm' value='<?PHP  echo $acc_adm; ?>' type='text'/>
                                </div>
                                <div class="col-12">
                                                <br />
                                                <label>Menu</label><br />
                                                <select name="menu_admin">
                                                	<?
														$result_menu = mysqli_query($cnx, "SELECT * FROM apli_MENU WHERE estado > 1;"); 
														while($row_menu = mysqli_fetch_array($result_menu))
														{
															if($row_menu['id_apli_menu'] == $menu_admin){ $select = 'selected="selected"'; } else { $select = ''; }
															if($row_menu['titulo'] != '')
															{  
															?>
															<option <? echo $select; ?>  value="<? echo $row_menu['id_apli_menu'] ?>"><? echo $row_menu['titulo'] ?></option>
															<?
                                                                           }
														}
													?>
                                                	
                                                </select>
                                </div>



                            </div>
                    </div>

 
                    <div class='col-12 text-center mt-3' style="position:absolute; bottom:-50px;">
                        <button class='btn btn-success' value="Guardar" type="submit"/>Guardar</button>
                        <button class='btn btn-danger' value="Cancelar" type="reset" onClick="location.href='?play=<? echo $play ?>'" />Cancelar</button>
                    </div>
           </div>
        </div>
 		</form>
        
        
        <div class="row">
            <div class='col-md-12'>
           		<?  tagdeaplis($apli, $id);?>	
            </div>
        </div>
        
        <div class="row">
            <div class='col-md-12'>
           		<? tagdehijos($apli, $id);?>	
            </div>
        </div>        
        
        