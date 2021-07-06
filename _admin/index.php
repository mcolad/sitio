<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP $include = "header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP $acc_adm = 3; ?>
<?PHP // registro(true); ?>
<body>
    <div class="wrapper">
		<?PHP  	
			$menu = 'si';
			$include = "menu.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); 
		?>
			<style>
               th{ height:70px; vertical-align:middle!important}
			   td{ height:40px; vertical-align:middle!important}
               </style>                    
 
        <div id="content">

            <nav style='margin-bottom:10px'>
                	<div class="row ml-2">
					        <button type="button" id="sidebarCollapse" class="btn btn_admin"><? svg('svgadmin/bars.svg', 20, 20, '#667788') ?>  </button> <h4 class="pl-2">ADMINISTRADOR DE CONTENIDOS</h4>
                	</div>
            </nav>

          <div class="col-lg-12">
         
                         <div class="row">
                              <div class="col-md-6 pt-1">
                                   <h5><a href='index.php'>Panel</a></h5>
                              </div> 
                              <div class="col-md-6 pt-1 text-right">
                                   <h5>
                                   <?
                                   $result_analytics = mysqli_query($cnx, "SELECT * FROM apli_ANALYTICS"); 
                                   $row_analytics = mysqli_fetch_array($result_analytics);
                                   ?>
                                   <? if(@$row_analytics['audiencia'] != '') {?> <a href='estadistica.php?analytics=audiencia'>Audiencia</a>&nbsp;&nbsp;&nbsp;<? }?>
                                   <? if(@$row_analytics['comportamiento'] != '') {?> <a href='estadistica.php?analytics=adquisicion'>Adquisiciones</a>&nbsp;&nbsp;&nbsp;<? }?>
                                   <? if(@$row_analytics['adquisicion'] != '') {?> <a href='estadistica.php?analytics=comportamiento'>Comportamiento</a>&nbsp;&nbsp;&nbsp;<? }?>
                                   </h5>
                              </div>
                         </div>

         </div>



            <div class="row">
            	<div class="col-md-4 col-xs-12 bg-white p-4  border rounded shadow-sm">
                    <table class="table table-sm table-striped"	>
                    <thead style="background:#9283BE" class=" text-light"><tr>
                        <th>Publicaciones</th><th align="center" style="text-align:center"><? svg('svgadmin/laugh.svg', 30, 30, 'white'); ?></th><th align="center" style="text-align:center"><? svg('svgadmin/meh.svg', 30, 30, 'white'); ?></th><th align="center" style="text-align:center"><? svg('svgadmin/dizzy.svg', 30, 30, 'white'); ?></th><th></th></tr></thead>
					<? 
					$query = "SELECT * FROM apli_APLIS WHERE (titulo != '' AND menu_admin <> '00000000000000' AND menu_admin <> '00000000000001');";
					$result_apli = mysqli_query($cnx, $query);
					while($row_apli = mysqli_fetch_array($result_apli))
					{
						sintesis_panel($row_apli['titulo'], $row_apli['bajada']);
					}
					?>
                    </table>
                </div>
                
                <div class="col-md-4 col-xs-12 bg-white p-4  border rounded shadow-sm">
                    <table class="table table-sm table-striped">
                    <thead style="background:#50B8B1" class=" text-light"><tr><th>Archivos disponibles</th><th align="center" style="text-align:center"><? svg('svgadmin/laugh.svg', 30, 30, 'white'); ?></th><th align="center" style="text-align:center"><? svg('svgadmin/meh.svg', 30, 30, 'white'); ?></th><th align="center" style="text-align:center"><? svg('svgadmin/dizzy.svg', 30, 30, 'white'); ?></th><th></th></tr></tr></thead>
					<? 
					$query = "SELECT * FROM apli_APLIS WHERE (titulo != '' AND  menu_admin = '00000000000001' AND id_apli_aplis != '00000000000007' );";
					$result_apli = mysqli_query($cnx, $query);
					while($row_apli = mysqli_fetch_array($result_apli))
					{
						sintesis_panel($row_apli['titulo'], $row_apli['bajada']);
					}
					?>
                   
                    </table>
                </div>
                
                <div class="col-md-4 col-xs-12 bg-white p-4  border rounded shadow-sm">
                    <table class="table table-sm table-striped">
                    <thead style="background: #D784A7" class=" text-light"><tr><th>Herramientas de gestión</th><th align="center" style="text-align:center"><? svg('svgadmin/laugh.svg', 30, 30, 'white'); ?></th><th align="center" style="text-align:center"><? svg('svgadmin/meh.svg', 30, 30, 'white'); ?></th><th align="center" style="text-align:center"><? svg('svgadmin/dizzy.svg', 30, 30, 'white'); ?></th><th></th></tr></tr></thead>
					<? 
					$query = "SELECT * FROM apli_APLIS WHERE (titulo != '' AND (menu_admin = '00000000000000' XOR id_apli_aplis = '00000000000007' ));";
					$result_apli = mysqli_query($cnx, $query);
					while($row_apli = mysqli_fetch_array($result_apli))
					{
						sintesis_panel($row_apli['titulo'], $row_apli['bajada']);
					}
					?>
                   
                    </table>
                </div>


			<? 	if($_SESSION['acc_adm_us']  > 5)
               {
               ?>
                     <div class="col col-md-12" id='div_backup'>
                         <button type='button' class='btn btn-primary btn-sm' style="width:100%" onClick="recibeid('gestion/gen_backup.php', '', '', 'div_backup')">Generar Backup</button>
                     </div>
			<? } ?>
            </div>
        </div>
    </div>

	<?PHP $include = "footer.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>

</body>
</html>