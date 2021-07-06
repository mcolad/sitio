<?PHP 
if(!empty($_GET['id_apli_pdf']) AND empty($_GET['confirma']))
	{
		$id_apli_pdf = $_GET['id_apli_pdf'];
		$result = mysqli_query($cnx, "SELECT * FROM apli_PDF WHERE id_apli_pdf = '".$_GET['id_apli_pdf']."'; "); 
		$row = mysqli_fetch_array($result);
		$id_apli = $row['id_apli'];
		$fecha_nota = $row['fecha'];
		$titulo = $row['titulo'];
		?>
			<form name="formu" action="index.php?id_apli_pdf=<?PHP  echo $_GET['id_apli_pdf'] ?>&id_apli=<?PHP  echo $_GET['id_apli'] ?>&apli_padre=<?PHP  echo $_GET['apli_padre'] ?>&play=<? echo $play ?>&confirma=1" method="post">
			<input name="flag" type="hidden" value="modifica_foto" />
			<input name="id_apli_pdf" type="hidden" value="<?PHP  echo $id_apli_pdf; ?>"/>
			<input name="id_apli" type="hidden" value="<?PHP  echo $id_apli; ?>"/>
            <div class="row">
<!--                <div class='col-lg-4'>
                        <label>Fecha y hora de publicación</label><br />-->
                        <input id='fecha' name='fecha_nota' value='<?PHP  echo substr($fecha_nota, 0, -3); ?>' type='hidden' class='form-control'/>
					<!--<script>$('#fecha').datetimepicker({ footer: true, modal: true, format: 'yyyy-mm-dd HH:MM' });</script>
                </div>-->

                <div class='col-md-12'>
                    <label>Titulo <font color="#666666" size="-2">No admite links ni estilos</font></label><br />
                    <input class='form-control' name='titulo' value='<?PHP  echo $titulo; ?>' type='text'/>
                </div>
                
		        <div class='col-12 text-center'>&nbsp;</div>

                <div class='col-md-12 text-center mt-3'>
                    <button class='btn btn-success' value="Guardar" type="submit"/>Guardar</button>
                    <button class='btn btn-danger' value="Cancelalr" type="reset" onClick="location.href='?play=<? echo $play ?>&id_apli=<?PHP  echo $_GET['id_apli'] ?>&apli_padre=<?PHP  echo $_GET['apli_padre'] ?>'" />Cancelar</button>
                </div>
            </div>

    
    	<?
	}
	else
	{
		$id_apli_pdf = date('YmdHis');
		$id_apli = $_GET['id_apli'];
		$fecha_nota = date('Y-m-d H:i');
		$titulo = '';
		?>
            <form name="formu" action="index.php?id_apli_pdf=<? echo $id_apli_pdf; ?>&id_apli=<?PHP  echo $_GET['id_apli'] ?>&apli_padre=<?PHP  echo $_GET['apli_padre'] ?>&play=<? echo $play ?>&confirma=1" method="post" enctype="multipart/form-data">
			<input name="id_apli" type="hidden" value="<?PHP  echo $id_apli; ?>"/>
            <div class="form-group">
                <div class="row">
                        <!--<div class='col-lg-4'>
                            <label>Fecha y hora</label><br />-->
                            <input id='fecha' name='fecha_nota' value='<?PHP  echo substr($fecha_nota, 0, 16); ?>' type='hidden' class='form-control'/>
						 <!--   <script>$('#fecha').datetimepicker({ footer: true, modal: true, format: 'yyyy-mm-dd HH:MM' });</script>
                        </div>-->
                        <div class='col-md-12'>
                            <label>Titulo <font color="#666666" size="-2">No admite links ni estilos</font></label><br />
                            <input class='form-control' name='titulo' value='<?PHP  echo $titulo; ?>' type='text'/>
                        </div>

                        <div class='col-md-12'>
                          <div class="custom-file">
                            <input name="archivo[]" type="file" class="custom-file-input" id="customFile" accept=".pdf"  multiple >
                            <label class="custom-file-label" for="customFile">Seleccione Archivos</label>
                            <input name="flag" type="hidden" value="inserta_foto" />
                          </div>
                        </div>
                        <div class='col-12 text-center'>&nbsp;</div>

                        <div class='col-12 text-center'> 
                            <button class='btn btn-success' value="Guardar" type="submit"/>Guardar</button>
                            <button class='btn btn-danger' value="Cancelar" type="reset" onClick="location.href='?play=<? echo $play ?>&id_apli=<?PHP  echo $_GET['id_apli'] ?>&apli_padre=<?PHP  echo $_GET['apli_padre'] ?>'" />Cancelar</button>
                        </div>

               </div>
            </div>
            </form>		
		<?
	}
?>
<script>
            $('#customFile').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
</script>
