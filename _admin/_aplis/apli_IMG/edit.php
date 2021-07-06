<?PHP 
if(!empty($_GET['id_apli_img']) AND empty($_GET['confirma']))
	{
		$id_apli_img = $_GET['id_apli_img'];
		$result = mysqli_query($cnx, "SELECT * FROM apli_IMG WHERE id_apli_img = '".$_GET['id_apli_img']."'; "); 
		$row = mysqli_fetch_array($result);
		$id_apli = $row['id_apli'];
		$fecha_nota = $row['fecha'];
		$titulo = $row['titulo'];
		echo "<img class='img-fluid' src='../../../_fotos/".$row['id_apli_img']."_original.jpg'>";
		?>
          
			<form name="formu" action="index.php?id_apli_img=<?PHP  echo $_GET['id_apli_img'] ?>&id_apli=<?PHP  echo $_GET['id_apli'] ?>&apli_padre=<?PHP  echo $_GET['apli_padre'] ?>&play=<? echo $play ?>&confirma=1" method="post">
			<input name="flag" type="hidden" value="modifica_foto" />
			<input name="id_apli_img" type="hidden" value="<?PHP  echo $id_apli_img; ?>"/>
			<input name="id_apli" type="hidden" value="<?PHP  echo $id_apli; ?>"/>
            <div class="row">
                <!--<div class='col-lg-4'>-->
                   <!-- <label>Fecha y hora de publicación</label><br />-->
                    <input name='fecha_nota' id='fecha' value='<?PHP  echo substr($fecha_nota, 0, -3); ?>' type="hidden" class='form-control'/>
				<!--<script>$('#fecha').datetimepicker({ footer: true, modal: true, format: 'yyyy-mm-dd HH:MM' });</script>-->
                <!--</div>-->
                <div class='col-md-12'>
                    <label>Titulo <font color="#666666" size="-2">No admite links ni estilos</font></label><br />
                    <input class='form-control' name='titulo' value='<?PHP  echo $titulo; ?>' type='text'/>
                </div>
                    <div class='col-md-12 text-center mt-3' style="position:absolute; bottom:-50px;">
                    <button class='btn btn-success' value="Guardar" type="submit"/>Guardar</button>
                    <button class='btn btn-danger' value="Cancelalr" type="reset" onClick="location.href='?play=<? echo $play ?>&id_apli=<?PHP  echo $_GET['id_apli'] ?>&apli_padre=<?PHP  echo $_GET['apli_padre'] ?>'" />Cancelar</button>
                </div>
            </div> 

    
    	<?
	}
	else
	{
		$id_apli_img = date('YmdHis');
		$id_apli = $_GET['id_apli'];
		$fecha_nota = date('Y-m-d H:i');
		$titulo = '';
		?>

            <form name="formu" id='formu' action="index.php?id_apli_img=<? echo $id_apli_img; ?>&id_apli=<?PHP  echo $_GET['id_apli'] ?>&apli_padre=<?PHP  echo $_GET['apli_padre'] ?>&play=<? echo $play ?>&confirma=1"  method="post" enctype="multipart/form-data">
			<input name="id_apli" type="hidden" value="<?PHP  echo $id_apli; ?>"/>
               <input name="flag" type="hidden" value="inserta_foto" />
            <div class="form-group">
                <div class="row">
                        <!--<div class='col-lg-4'>
                            <label>Fecha y hora</label><br />-->
                            <input name='fecha_nota' id='fecha' value='<?PHP  echo substr($fecha_nota, 0, 16); ?>' type="hidden" class='form-control'/>
					   <!--<script>$('#fecha').datetimepicker({ footer: true, modal: true, format: 'yyyy-mm-dd HH:MM' });</script>
                        </div>-->
                        <div class='col-md-12'>
                            <label>Titulo <font color="#666666" size="-2">No admite links ni estilos</font></label><br />
                            <input class='form-control' name='titulo' value='<?PHP  echo $titulo; ?>' type='text'/>
                        </div>

                        <div class='col-md-12'>
                          <div class="custom-file">
                            <input name="archivo[]" type="file" id="customFile" accept=".jpg,.jpeg,.gif,.png"  multiple>
<!--                            <input name="archivo[]" type="file" class="custom-file-input" id="customFile" accept=".jpg,.jpeg,.gif,.png"  multiple onchange="uploadFile()" >-->
                            <label class="custom-file-label" for="customFile">Seleccione Archivos</label>
                          </div>
                        </div>
                        <div class='col-12 text-center'>&nbsp;</div>

                        <div class='col-12 text-center'> 
                            <button class='btn btn-success' value="Guardar" type="submit"/>Guardar</button>
                            <button class='btn btn-danger' value="Cancelar" type="reset" onClick="location.href='?play=<? echo $play ?>&id_apli=<?PHP  echo $_GET['id_apli'] ?>&apli_padre=<?PHP  echo $_GET['apli_padre'] ?>'" />Cancelar</button>
                        </div>
 </p> 
               </div>
            </div>
            </form>		
		<?
	}
?>
<!--<script>
	const form = document.getElementById("formu"); 
	const fileInput = document.getElementById("customFile");
	fileInput.addEventListener('change', () => { form.submit(); });
	window.addEventListener('paste', e => {	fileInput.files = e.clipboardData.files; });
</script>
<script>
            $('#customFile').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
</script>-->