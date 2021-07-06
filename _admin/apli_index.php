<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP $include = "_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>
<? 
$exepciones[] = 'id_apli_'.strtolower($apli);
$exepciones[] = 'id_apli_tag';
$exepciones[] = 'id_apli_padre';
$exepciones[] = 'fecha';
$exepciones[] = 'usuario';
$exepciones[] = 'estado';

if(!empty($_GET['editar'])){ $collapseOne = 'show'; $collapseTwo = ''; }else{ $collapseOne = ''; $collapseTwo = 'show'; } 
$publicar = $row_data['publicar'];
?>

<?PHP include_once('insert.php'); ?>
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
									?><button type="button" id="sidebarCollapse" class="btn btn_admin"><? svg('svgadmin/bars.svg', 20, 20, '#667788') ?> </button>
									<? echo strtoupper($apli) ?>
									<? 
								} 
								elseif($menu == 'menu_adjuntos') 
								{
									$menu_adjuntos = array ('IMG', 'PDF', 'ZIP');
									foreach ($menu_adjuntos as $valor) 
									{ 
										$result_nro = mysqli_query($cnx, "SELECT * FROM apli_".$valor." WHERE ((estado > 0) AND (id_apli = ".$_GET['id_apli']."))");
										$cantidad_nro = mysqli_num_rows($result_nro);
										if($apli == $valor){ $active_menu_adjunto = "disabled='true'"; $active_class_adjunto = 'btn-info'; } else { $active_menu_adjunto = ''; $active_class_adjunto = 'btn_admin'; } 
										?><button class="btn <? echo $active_class_adjunto; ?>" <? echo $active_menu_adjunto; ?> onClick="window.location.href='../apli_<? echo $valor?>/?id_apli=<? echo $_GET['id_apli'] ?>&apli_padre=<? echo $_GET['apli_padre'] ?>'" type="button" id="sidebarCollapse"><? echo $valor ?> <div class="badge badge-light"><? echo $cantidad_nro ?></div></button> <?
									}
								
								}
								elseif($menu == 'menu_tag') 
								{
									$menu_adjuntos = array ('tag');
									foreach ($menu_adjuntos as $valor) 
									{ 
										if($apli == $valor){ $active_menu_adjunto = "disabled='true'"; } else { $active_menu_adjunto = ''; } 
										?><button <? echo $active_menu_adjunto; ?> onClick="window.location.href='../apli_<? echo $valor?>/?id_apli=<? echo $_GET['id_apli'] ?>&apli_padre=<? echo $_GET['apli_padre'] ?>'" type="button" id="sidebarCollapse" class="btn btn_admin"><? echo $valor?></button><?
									}
								}
								elseif($menu == 'Menu') 
								{
									echo strtoupper($apli);
								}
								?>
                        </div>
                        <div class="col text-right">
                         <?  if($publicar) {?>
                            <style> @media (max-width: 768px) { #headingOne span { display: none; } #headingTwo span { display: none; }} </style> 
                            <button title="subir contenido" <? if(!empty($_GET['editar'])){ echo "disabled='true'"; }?> id="headingOne" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span class="d-inline"><? svg('svgadmin/plus.svg', 15, 15, 'white') ?></span><span class="d-none d-sm-inline" style="position:relative; top:-3px;"> agregar</span></button>
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
								<?PHP include_once('edit.php'); ?>
                          </div>
                        </div>
                      </div>
                      
                      <div class="bg-light">
                        <div id="collapseTwo" class="collapse <? echo $collapseTwo ?>" aria-labelledby="headingTwo" data-parent="#accordion">
                          <div class="card-body">
                              <?PHP include_once('listar.php'); ?>
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
</script>