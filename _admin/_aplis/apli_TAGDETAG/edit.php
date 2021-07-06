<script type="text/javascript" src="_editor/editor.js"></script>
<script type="text/javascript" src="_editor/personal.js"></script>

<?PHP 
	if(!empty($_GET['id']) AND empty($_GET['confirma']))
	{
		$id = $_GET['id'];
		$result = mysqli_query($cnx, "SELECT * FROM apli_$apli WHERE id_apli_".strtolower($apli)." = '".$_GET['id']."'; "); 
		$row = mysqli_fetch_array($result);
		$fecha_nota = $row['fecha'];
		$titulo = $row['titulo'];
		$bajada = $row['bajada'];
		$unico = $row['unico'];
	}
	else
	{
		$id = date('YmdHis');
		$fecha_nota = date('Y-m-d H:i');
		$titulo = '';
		$bajada = '';
		$unico = '';
	}
?>
 
 <div class='col-lg-12 text-right'>
 
<!--    <button class='btn btn-admin btn-sm modalButton' data-toggle='modal' data-src='<? echo $path; ?>/_admin/_aplis/apli_TAG/index.php?id_apli_tagdetag=<? echo $id; ?>' data-width=100% data-target='#myModal'><i class="fas fa-tags"></i>  Tags</button>
--></div>

<form name="formu" action="index.php?id=<? echo $id; ?>&play=<? echo $play ?>&confirma=1" method="post">
        <div class="form-group">
            <div class="row">
                    <div class='col-md-4'>
                        <div class="row">
<!--                            <div class='col-md-12'>
                                    <label>Fecha y hora</label><br />
-->                                    <input name='fecha_nota' id='fecha_nota' value='<?PHP  echo $fecha_nota; ?>' type='hidden' class='form-control'/>
                           <!--         <script>$('#fecha_nota').datetimepicker({ footer: true, modal: true, format: 'yyyy-mm-dd HH:MM' });</script>
                            </div>-->
                            <div class='col-md-12'>
                                    <label>Nombre del tagdetag</label> [<? echo $id ?>]<br />
                                    <input class='form-control' name='titulo' value='<?PHP  echo $titulo; ?>' type='text'/>
                            </div>
                            <div class='col-md-12'>
                                    <label>Aclaración</label><br />
                                    <textarea class='form-control' name='bajada'><?PHP  echo $bajada; ?></textarea>
                            </div>
                              <div class="col-12">
                                   <label>&nbsp;</label><br />
                                   <div style="float:left; margin-top:5px;">unico&nbsp;&nbsp;&nbsp;</div><div class="material-switch">
                                   <? if($unico == 1){ $checked = 'checked="checked"'; } else { $checked = ''; } ?>
                                   <input id="switch-info3" name="unico" value="1" <? echo $checked ?>  type="checkbox">
                                   <label for="switch-info3" class="info-color"></label>
                                   </div>
                              </div>

                              <div class='col-md-12 text-center mt-3'>
                                  <button class='btn btn-success' value="Guardar" type="submit"/>Guardar</button>
                                  <button class='btn btn-danger' value="Cancelar" type="reset" onClick="location.href='?play=<? echo $play ?>'" />Cancelar</button>
                              </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class='col-md-12 card' style="padding:0px">
                                <div class="col-md-12 card-body" style="padding:0px">
                                <iframe style="border:0px" width="100%" height="520px" src="<? echo $path; ?>/_admin/_aplis/apli_TAG/index.php?id_apli_tagdetag=<? echo $id; ?>"></iframe>
						  <?PHP 
                                      /*  $result_tag = mysqli_query($cnx, "SELECT * FROM apli_TAG WHERE (id_apli_tagdetag LIKE '%".$id.";%') ORDER BY titulo ASC");
                                        while($row_tag = mysqli_fetch_array($result_tag))
                                        {
											if($row_tag['estado'] == 0){ $btn = 'btn-danger'; } elseif($row_tag['estado'] == 1) { $btn = 'btn-warning'; } else{ $btn = 'btn-success'; }
                                            ?>
                                            <div class="btn <? echo $btn; ?> btn-sm m-1"><?PHP echo $row_tag['titulo'] ?></div>
                                            <?
                                        }*/
                                ?>
                                </div>
                            </div>
                            </div>
                    </div>

           </div>
        </div>
 		</form>