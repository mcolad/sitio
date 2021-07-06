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
					<?
                         $result_analytics = mysqli_query($cnx, "SELECT * FROM apli_ANALYTICS"); 
                         $row_analytics = mysqli_fetch_array($result_analytics);
                         ?>         
                         <div class="row">
                              <div class="col-md-6 pt-1">
                                   <h5><a href='index.php'>Panel</a></h5>
                              </div>
                              <div class="col-md-6 pt-1 text-right">
                                   <h5>
                                   <? if($row_analytics['audiencia'] != '') {?> <a href='estadistica.php?analytics=audiencia'>Audiencia</a>&nbsp;&nbsp;&nbsp;<? }?>
                                   <? if($row_analytics['comportamiento'] != '') {?> <a href='estadistica.php?analytics=adquisicion'>Adquisiciones</a>&nbsp;&nbsp;&nbsp;<? }?>
                                   <? if($row_analytics['adquisicion'] != '') {?> <a href='estadistica.php?analytics=comportamiento'>Comportamiento</a>&nbsp;&nbsp;&nbsp;<? }?>                                   
                                   </h5>
                              </div>
                         </div>

                         <div class="card-body" style="padding:0">
                         <? 
                         
                         if(empty($_GET['analytics'])){ $analytics = $row_analytics['audiencia']; }
                         elseif($_GET['analytics'] == 'audiencia'){ $analytics = $row_analytics['audiencia']; }
                         elseif($_GET['analytics'] == 'adquisicion'){ $analytics = $row_analytics['adquisicion']; }
                         elseif($_GET['analytics'] == 'comportamiento'){ $analytics = $row_analytics['comportamiento']; }
                         ?>
                         <iframe width="100%" height="700" src="<? echo $analytics ?>" frameborder="0" style="border:0" allowfullscreen></iframe>
                         </div>
          </div>
         


</div>

        </div>
    </div>


	<?PHP $include = "footer.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>

</body>
</html>