            <div class='col-md-12 text-right mt-3'>
                 <button class='btn btn-success btn-sm' onclick="window.location.href='index.php?editar=1&play=<? echo $play; ?>&id_apli_tagdetag=<? echo $_GET['id_apli_tagdetag'] ?>'" type="submit"/>Carga Manual</button>
            </div>

            <form name="formu" action="index.php?csv_insert=1&play=<? echo $play ?>&id_apli_tagdetag=<? echo $_GET['id_apli_tagdetag'] ?>&confirma=1" method="post" enctype="multipart/form-data">
			<input name="id_apli" type="hidden" value="<?PHP  echo $id_apli; ?>"/>
            <div class="form-group">
                <div class="row">
                        <div class='col-md-3 text-left mt-3 custom-file'>
                             <input id="file" name="archivo[]" class='btn btn-success btn-sm custom-file-input' accept=".csv,.txt" type="file" value="Subir CSV">
                             <label class="custom-file-label" for="file">Seleccionar archivo csv o txt</label>
                        </div>
                        <div class='col-md-12 text-center mt-3'><br clear="all" /></div>
                        <div class='col-md-12 text-center mt-3'>
                            <button class='btn btn-success' value="Guardar" type="submit"/>Guardar</button>
                            <button class='btn btn-danger' value="Cancelar" type="reset" onClick="location.href='?play=<? echo $play ?>&id_apli_tagdetag=<?PHP  echo $_GET['id_apli_tagdetag'] ?>'" />Cancelar</button>
                        </div>
               </div>
            </div>
            </form>	