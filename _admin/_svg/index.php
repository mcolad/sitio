<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP $include = "header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<style>
.viewport {
    overflow: auto;
 
    /* Make sure the inner div is not larger than the container
     * so that we have room to scroll.
     */
    max-height: 100%;

    /* Pick an arbitrary margin/padding that should be bigger
     * than the max width of all the scroll bars across
     * the devices you are targeting.
     * padding = -margin
     */
    margin-right: -100px;
    padding-right: 100px;
}

.hide-scroll {
    overflow: hidden;
}

/* Optional styles */
.hide-scroll {
    height: 600px;
    background-color: #FFF;
    padding: 0 5px;
    position: relative;
}

.hide-scroll:after {
    content: '';
    height: 2em;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
}
.viewport p:last-child {
    margin-bottom: 2em;
}
</style>
<body>
     <div class="content">
          <div class="hide-scroll">
                   <div class="viewport">
                        <div class="row" style="border-bottom:#CCC solid 1px; padding-left:20px; padding-right:5px;">
                        <?
                    
                    
                    function listar_directorios_ruta($ruta){
                           // abrir un directorio y listarlo recursivo
                           if (is_dir($ruta)) {
                              if ($dh = opendir($ruta)) {
                                 while (($file = readdir($dh)) !== false) {
                                     if($file!="." && $file!=".." && substr($file, -4) != '.php'  && !is_dir($file))
                                     {
                                        ?>
                                        <div id='<? echo $file ?>' class='col-2 text-center p-2'>
                                        <img height='50px;' src="<? echo substr($ruta, 2).$file ?>"><br /><font size="-2"><? echo substr($file, 0, -4) ?> 
                                        <a href="javascript:recibeid('delete.php', 'borrar=<? echo substr($ruta, 2).$file ?>', '', '<? echo $file ?>')">[x]</a></font>
                                        </div>
                                        <?
                                     }
                                     if (is_dir($ruta . $file) && $file!="." && $file!="..")
                                    {
                                       ?>
                                       <div class='col-12 p-2 text-center' style='background-color: #FFC;'><strong><? echo strtoupper($file) ?></strong></div>
                                       <?
                                       listar_directorios_ruta($ruta . $file . "/");
                                    }
                        
                                 }
                              closedir($dh);
                              }
                           }
                        }
                        listar_directorios_ruta("./");
                        
                        ?>
                        </div>
                         <div class="row" style=" padding-left:0px important!; margin-left:0px important!">
                              <div class="col-12" style="background-color: #FFC; width:100%"><a href='https://iconscout.com/' target="_blank" >iconscout</a></div>
                              <div class="col-12" style="background-color: #FFC; width:100%"><a href='https://es.vexels.com/' target="_blank" >vexels</a></div>
                              <div class="col-12" style="background-color: #FFC; width:100%"><a href='https://icon-icons.com/es/' target="_blank" >icon-icons</a></div>
                              <div class="col-12" style="background-color: #FFC; width:100%"><a href='https://iconos8.es/icons' target="_blank" >iconos8</a></div>
                              
                              <div class="col-12">&nbsp;</div>
                         </div>
               </div>
          </div>
     </div>
</body>