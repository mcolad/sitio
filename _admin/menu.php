<nav id="sidebar">
<!--<nav id="sidebar" class='active'>  -->
            <div class="list-unstyled components pt-2 pb-2 text-center">
                <a title='ir al sitio'  target="_blank" href='/<? echo $abs ?>' ><span style=" position:relative; top:2px"><? svg('svgadmin/desktop.svg', '15', '15', '#dce7e9') ?></span>&nbsp; VER SITIO</a>
            </div> 

		<? if(!empty($_SESSION['nick'])){ ?>
            <div class="sidebar-header pt-2 pb-2" style="background-color:#5a6671"> 
                    <a style="cursor:pointer; color:#FFF" data-toggle="modal" data-width=100% data-target="#myModal_usuario">&nbsp;&nbsp;&nbsp;<span style=" position:relative; top:2px"><? svg('svgadmin/user.svg', '15', '15', '#fff') ?></span>&nbsp;<? echo $_SESSION['nick']; ?></a> 
                    <a style="" title='eliminar session <? echo $_SESSION['acc_adm_us'] ?>' href='/<? echo $abs ?>_admin/index.php?destroy=1'>│&nbsp;<span style=" position:relative; top:2px"><? svg('svgadmin/user-slash.svg', '15', '15', 'red') ?></span></a> 
            </div>
          <!-- Modal usuario-->

            <div class="modal fade" id="myModal_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body" >
                    <iframe src="/<? echo $abs ?>_admin/gestion/registro_cambioclave.php?email_us=<? echo $_SESSION['email_us'] ?>" width="100%" height="600" style="padding:0px important!; margin:0px important;" frameborder="0" allowtransparency="true"></iframe> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
                    <?
                    if(!empty($_SESSION['flag_pedircambioclave'])) { echo "<script>$( document ).ready(function() { $('#myModal_usuario').modal('toggle') });</script>"; unset($_SESSION['flag_pedircambioclave']); }
                    ?> 
          <!-- /.modal -->
		<? } ?> 

            <ul class="list-unstyled components" style="clear:both; border-bottom:none">
               <li><a href='/<? echo $abs ?>_admin/?<? echo date('is') ?>'><? svg('svgadmin/home.svg', 15, 15 ,'#dce7e9');  ?>&nbsp;Panel</a></li> 
                <?
			// LISTAR EN EL MENU CON CARPETA
			$result_menu_adm = mysqli_query($cnx, "SELECT * FROM apli_MENU WHERE (estado > 1) AND (id_apli_menu <> '00000000000000') AND (id_apli_menu <> '00000000000001')  AND (id_apli_menu <> '00000000000002')  AND (id_apli_menu <> '00000000000003') AND (titulo IS NOT NULL) ORDER BY fecha ASC"); 
			while($row_menu_adm = mysqli_fetch_array($result_menu_adm))
			{	
				$result_menu = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE ((estado > 1 AND titulo IS NOT NULL) AND (menu_admin = '".$row_menu_adm['id_apli_menu']."')) ORDER BY fecha ASC");
				$cantidad = mysqli_num_rows($result_menu);
				if($cantidad)
				{	
					?> 
						<?
                              while($row_menu = mysqli_fetch_array($result_menu))
                              {	
                                   $result_count = mysqli_query($cnx, "SELECT * FROM apli_".$row_menu['titulo']." WHERE (estado = 1 AND titulo IS NOT NULL)");
                                   $row_count = mysqli_num_rows($result_count);
								if((in_array("apli_".$row_menu['titulo'], $_SESSION['acc_apli'])) XOR ($_SESSION['acc_apli'][0] == ''))
								{
								    ?> 
                                            
										<? if(empty($flag_menu)){?>
                                                  <li>
                                                  <a href="#pageSubmenu<? echo $row_menu_adm['id_apli_menu'] ?>" data-toggle="collapse" aria-expanded="false"><span style=" position:relative; top:3px"><? svg('svgadmin/caret-right.svg', 20, 20 ,'#dce7e9'); ?></span><? echo $row_menu_adm['titulo'] ?></a>                    
                                                  <ul class="collapse list-unstyled" id="pageSubmenu<? echo $row_menu_adm['id_apli_menu'] ?>">
                                                  <? $flag_menu = 1; }?>
                                                  
                                                  
									   <li><a href="/<? echo $abs ?>_admin/__aplis/apli_<? echo $row_menu['titulo']  ?>">&nbsp;&nbsp;&nbsp;
								    <? 
										echo $row_menu['bajada'] ?>&nbsp;&nbsp;<? if($row_count!=0){ ?><sup><? echo $row_count ?></sup><? } 
								    ?>
									   </a></li> 
								    <?
								}
                              }
						
						if(!empty($flag_menu)) { ?> </ul> </li> <? unset($flag_menu); }
                              ?>
					<?
				}
			}
				?>
                	<?
					// LISTAR EN EL MENU SIN CARPETA
					$result_menu = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE ((estado > 1) AND (titulo IS NOT NULL) AND (".$_SESSION['acc_adm_us']." >= acc_adm) AND (menu_admin = '00000000000002')) ORDER BY fecha ASC"); 
					while($row_menu = mysqli_fetch_array($result_menu))
					{	
						$result_count = mysqli_query($cnx, "SELECT * FROM apli_".$row_menu['titulo']." WHERE (estado = 1 AND titulo IS NOT NULL)");
						$row_count = mysqli_num_rows($result_count);
						
							if((in_array("apli_".$row_menu['titulo'], $_SESSION['acc_apli'])) XOR ($_SESSION['acc_apli'][0] == ''))
							{
							?>
                                        <li><a href="/<? echo $abs ?>_admin/__aplis/apli_<? echo $row_menu['titulo']  ?>">&nbsp;&nbsp;&nbsp;
                                        <? echo $row_menu['bajada'] ?>&nbsp;&nbsp;<? if($row_count!=0){ ?><sup style="font-size:11px"><? echo $row_count ?></sup><? } ?></a></li> 
							<?
							}
					}
				?>
                </ul>



		<?
               if($_SESSION['acc_adm_us']  > 5)
               {
          ?>

            <ul class="list-unstyled text-left">
              	<li>
                  <a href="#pageSubmenu_admin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" style="background:#3f87c0; color:#fff">&nbsp;&nbsp;&nbsp;Administrador</a>                    
                    <ul class="collapse list-unstyled" id="pageSubmenu_admin">
 
						<?
                              // LISTAR EN EL MENU los ADMIN
                              $result_menu = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (estado > 1 AND titulo IS NOT NULL AND menu_admin = '00000000000000' AND '".$_SESSION['acc_adm_us']."' >= acc_adm) ORDER BY fecha ASC"); 
                              while($row_menu = mysqli_fetch_array($result_menu))
                              {	
							$result_count = mysqli_query($cnx, "SELECT * FROM apli_".$row_menu['titulo']." WHERE (estado = 1 AND titulo IS NOT NULL)"); 
							$row_count = mysqli_num_rows($result_count);
							?>
							<li><a href="/<? echo $abs ?>_admin/_aplis/apli_<? echo $row_menu['titulo']; 	?>"><? if($row_menu['svg'] != ''){ svg($row_menu['svg'], 20, 20 ,'#dce7e9'); } ?><span style=" position:relative; top:-5px">&nbsp;&nbsp;&nbsp;<? echo $row_menu['bajada'] ?>&nbsp;&nbsp;</span><? if($row_count!=0){ ?><sup style=" position:relative; top:-4px;"><? echo $row_count ?></sup><? } ?></a></li> 
							<?
                              }
						?>
						
						<?
                              // LISTAR OCULTOS
                              $result_menu_adm = mysqli_query($cnx, "SELECT * FROM apli_MENU WHERE (estado > 1) AND (id_apli_menu = '00000000000003') AND (titulo IS NOT NULL) ORDER BY fecha ASC"); 
                              while($row_menu_adm = mysqli_fetch_array($result_menu_adm))
                              {	
                                             $result_menu = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (estado > 1 AND titulo IS NOT NULL AND menu_admin = '".$row_menu_adm['id_apli_menu']."') ORDER BY fecha ASC");
                                             $cantidad = mysqli_num_rows($result_menu);
                                             if($cantidad)
                                             {	
                                                       ?> 
                                                     <li>
                                                     <a href="#pageSubmenu<? echo $row_menu_adm['id_apli_menu'] ?>" data-toggle="collapse" aria-expanded="false"><? svg('svgadmin/eraser.svg', 20, 20 ,'#dce7e9'); ?><span style=" position:relative; top:-5px">&nbsp;&nbsp;&nbsp;<? echo $row_menu_adm['titulo'] ?></span></a>                    
                                                     <ul class="collapse list-unstyled" id="pageSubmenu<? echo $row_menu_adm['id_apli_menu'] ?>">
                                                         <?
                                                             while($row_menu = mysqli_fetch_array($result_menu))
                                                             {	
                                                                 $result_count = mysqli_query($cnx, "SELECT * FROM apli_".$row_menu['titulo']." WHERE (estado = 1 AND titulo IS NOT NULL)");
                                                                 $row_count = mysqli_num_rows($result_count);
                                                                     ?> 
                                                                         <li><a href="/<? echo $abs ?>_admin/__aplis/apli_<? echo $row_menu['titulo']  ?>">&nbsp;&nbsp;&nbsp;
                                                                     <? 
                                                                           echo $row_menu['bajada'] ?>&nbsp;&nbsp;<? if($row_count!=0){ ?><sup><? echo $row_count ?></sup><? } 
                                                                     ?>
                                                                         </a></li> 
                                                                     <?
                                                             }
                                                         ?>
                                                     </ul>
                                                     </li>
                                                       <?
                                             }
                              }
                              ?>
						
	                               <li class="text-center" style="background-color: #4598C9; padding-top:10px; padding-bottom:10px;">  
                    <!--<button class='btn btn-admin btn-sm modalButton' data-toggle='modal' data-src='/<? echo $abs ?>/_admin/_svg/' data-width=100% data-target='#myModalsinReload'><? svg('svgadmin/database.svg', '15', '15') ?></span> SQL</button>-->

                                    <button title="admin usuarios" class="btn modalButton" style="cursor:pointer; padding:5px" data-toggle="modal" data-width=100% data-src="/<? echo $abs ?>_admin/_aplis/apli_USUARIOS/" data-target='#myModalsinReload'><? svg('svgadmin/user-friends.svg', 20, 20 ,'#3D9D3D');?></button>
                                    <button title="Herramientas" class="btn modalButton" style="cursor:pointer; padding:5px" data-toggle="modal" data-width=100% data-src="/<? echo $abs ?>_admin/_aplis/apli_HERRAMIENTAS/" data-target="#myModalsinReload"><? svg('svgadmin/cogs.svg', 20, 20 ,'#3F87C0');?></button>
                                    <button title="menu" class="btn modalButton" style="cursor:pointer; padding:5px" data-toggle="modal" data-width=100% data-src="/<? echo $abs ?>_admin/_aplis/apli_MENU/" data-target="#myModalsinReload"><? svg('svgadmin/align-justify.svg', 20, 20 ,'#3F87C0');?></button>
                                    <button title="logos" class="btn modalButton" style="cursor:pointer; padding:5px" data-toggle="modal" data-width=100% data-src="/<? echo $abs ?>_admin/_svg/" data-target="#myModalsinReload"><? svg('svgadmin/grip-horizontal.svg', 20, 20 ,'#3F87C0');?></button>
                                    <button title="Estadística" class="btn modalButton" style="cursor:pointer; padding:5px" data-toggle="modal" data-width=100% data-src="/<? echo $abs ?>_admin/_aplis/apli_ANALYTICS/" data-target="#myModalsinReload"><? svg('svgadmin/chart-area.svg', 20, 20 ,'#3F87C0');?></button>
                                    </li> 

                    </ul>
                </li>
            </ul>
            
		<?
               }
          ?>

            
             <ul class="list-unstyled CTAs text-center" style="border-top:1px solid #47748b;" >  
                    <!--<li class="mt-2"><a href="_img/INTRANET - Manual_de_carga.pdf" target="_blank" class="btn btn-info"><span style="position:relative; top:4px;"><? echo svg('svgadmin/info-circle.svg', 20, 20, 'yellow') ?></span> MANUAL DE USO</a></li>-->             
                    <li><a href="https://www.facebook.com/socialeweb/" target="_blank"><span"><? svg('svgadmin/socialweb.svg', 100, 35, '')?></span></a></li>
	        </ul>
</nav>

        
<!-- Modal delogos
<div class="modal fade" id="myModal_svg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-body" >
          <iframe src="/<? echo $abs ?>_admin/_svg/" width="100%" height="600" style="padding:0px important!; margin:0px important;" frameborder="0" allowtransparency="true"></iframe>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>-->
<!-- /.modal -->


<!-- Modal delogos
<div class="modal fade" id="myModal_menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-body" >
          <iframe src="/<? echo $abs ?>_admin/_aplis/apli_MENU/" width="100%" height="600" style="padding:0px important!; margin:0px important;" frameborder="0" allowtransparency="true"></iframe>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>-->
<!-- /.modal -->
  
 
<!-- Modal delogos
<div class="modal fade" id="myModal_herramientas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-body">
          <iframe src="/<? echo $abs ?>_admin/_aplis/apli_HERRAMIENTAS/" width="100%" height="600" style="padding:0px important!; margin:0px important;" frameborder="0" allowtransparency="true"></iframe>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>-->
<!-- /.modal -->

<!-- Modal delogos
<div class="modal fade" id="myModal_usuarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-body">
          <iframe src="/<? echo $abs ?>_admin/_aplis/apli_USUARIOS/" width="100%" height="600" style="padding:0px important!; margin:0px important;" frameborder="0" allowtransparency="true"></iframe>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>-->
<!-- /.modal -->


	<script src="/<? echo $abs; ?>_admin/_js/jquery.mCustomScrollbar.concat.min.js"></script>
  
    <script type="text/javascript">
		<? // if(empty($menu)){ echo '$("#sidebar").toggleClass(\'active\');'; } ?>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>