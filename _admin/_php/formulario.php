<? 
if(empty($_GET['formu_paso'])){ $formu_paso = 0; }else{ $formu_paso = $_GET['formu_paso']; }
if(empty($_POST['formu_paso_repite'])){ $formu_paso_repite = 0; }else{ $formu_paso_repite = 1; }
if(!empty($_POST['id'])){ $id = $_POST['id']; }
if(!empty($_GET['id'])){ $id = $_GET['id']; }
//$id_padre = $_SESSION['id_beca'];
function insert_formu($array_aplis, $formu_paso, $formu_paso_repite, $id)
{
	global $cnx;
	$input_arr = array(); 
	foreach ($_POST as $key => $input_arr) 
	{ 
		mysqli_query($cnx, "UPDATE apli_".$array_aplis[$formu_paso-1]." SET ".$key." = '".charesp($_POST[$key])."' WHERE id_apli_".$array_aplis[$formu_paso-1]." = '".$id."';");
		mysqli_query($cnx, "UPDATE apli_".$array_aplis[$formu_paso-1]." SET estado = '2' WHERE id_apli_".$array_aplis[$formu_paso-1]." = '".$id."';");
//		echo "UPDATE apli_".$array_aplis[$formu_paso-1]." SET ".$key." = '".charesp($_POST[$key])."' WHERE id_apli_".$array_aplis[$formu_paso-1]." = '".$id."';<br>";
	}
	$formu_paso = $formu_paso-$formu_paso_repite;
	
	//todos las APLIS que no son PADRE
	if(!empty($array_aplis[$formu_paso]))
	{ 
		$apli = $array_aplis[$formu_paso]; 
		$id = date('YmdHis'); 
//		echo "INSERT IGNORE INTO apli_$apli (id_apli_".$apli.", titulo, id_apli_padre) VALUES ('".$id."', 'Sin completar', '".$id_padre."')";
		mysqli_query($cnx, "INSERT IGNORE INTO apli_$apli (id_apli_".$apli.", titulo, id_apli_padre) VALUES ('".$id."', 'Sin completar', '".$_SESSION['id_beca']."')") or die(mysqli_error());
	}
	else
	{ 
		$apli = 'fin'; 
	} 
	
	return array($id, $apli, $formu_paso);
}
function formulario($array_aplis, $exepciones = array())
{ 
	global $cnx, $id, $formu_paso, $id_padre;

	// PRIMER APLI 
	if (empty($formu_paso))
	{
		$apli = $array_aplis[0];
		$id = $_SESSION['id_beca'];
		mysqli_query($cnx, "INSERT IGNORE INTO apli_$apli (id_apli_".$apli.") VALUES ('".$id."')") or die(mysqli_error());
	} 

	$result_data = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (titulo = '".$array_aplis[$formu_paso]."')");
	$row_data = mysqli_fetch_array($result_data);						 

	$exepciones['id_apli_'.$array_aplis[$formu_paso]] = array('edit' => 'noedit', 'insert' => 'noinsert');
	$exepciones['fecha'] = array('edit' => 'noedit', 'insert' => 'noinsert');
	$exepciones['titulo'] = array('edit' => 'noedit', 'insert' => 'noinsert');
	$exepciones['listorder'] = array('edit' => 'noedit', 'insert' => 'noinsert');
	$exepciones['id_apli_tag'] = array('edit' => 'noedit', 'insert' => 'noinsert');
	$exepciones['id_apli_padre'] = array('edit' => 'noedit', 'insert' => 'noinsert');
	$exepciones['usuario'] = array('edit' => 'noedit', 'insert' => 'noinsert');
	$exepciones['estado'] = array('edit' => 'noedit', 'insert' => 'noinsert');
	$exepciones['destacado'] = array('edit' => 'noedit', 'insert' => 'noinsert');

?>
	<style>
     input{ background-color: #EEE !important}
     textarea{ background-color: #EEE !important}
     select{ background-color: #EEE !important}
     </style>
     
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto text-center">
            <h5 class="description"><? echo $row_data['bajada'] ?></h5>
          </div>
        </div>


	<? 
     if($row_data['publicar'])
     { 
          $result_yaagregados = mysqli_query($cnx, "SELECT * FROM apli_".$array_aplis[$formu_paso]." WHERE id_apli_padre = '".$_SESSION['id_beca']."'");
          while($row_yaagregados = mysqli_fetch_array($result_yaagregados))
          {
               ?>
               <div class="row justify-content-center"> 
               <?
               $result_column = mysqli_query($cnx, "SHOW COLUMNS FROM apli_".$array_aplis[$formu_paso]);
               while($row_column = mysqli_fetch_array($result_column))
               {
                    if(empty($exepciones[$row_column['Field']]))
                    {
                         if(substr($row_yaagregados[$row_column['Field']], 14, 1) == ';')
                         { echo "<strong>".leer_titulo_tag($row_yaagregados[$row_column['Field']])."</strong> "; }
                         else { echo "<strong>".$row_yaagregados[$row_column['Field']]."</strong> "; }
                         echo " • ";
                    }
               }
               ?>
               </div>	
               <?
               
          }
     } 
     ?>

<form method="post" action="encuesta.php?formu_paso=<? echo $formu_paso+1 ?>">
		<input name="id" value="<? echo $id ?>" type="hidden" />
		<input name="id_padre" value="<? echo $_SESSION['id_beca'] ?>" type="hidden" />
          <div class="row justify-content-center">
          <div class="col-md-8">
		
          <div class="row justify-content-center">
                <?  
               $result_column = mysqli_query($cnx, "SHOW COLUMNS FROM apli_".$array_aplis[$formu_paso]);
               while($row_column = mysqli_fetch_array($result_column))
               { 
				if(!in_array($row_column['Field'], $exepciones)) { ${$row_column['Field']} = ''; } 
			}
          
			$result_column = mysqli_query($cnx, "SHOW FULL COLUMNS FROM apli_".$array_aplis[$formu_paso]);
               while($row_column = mysqli_fetch_array($result_column))
               {
                         if(empty($exepciones[$row_column['Field']]['edit'])){ $exepciones[$row_column['Field']]['edit'] = 'edit'; }
                         if($exepciones[$row_column['Field']]['edit'] != 'noedit')
                         {	
                              if(!empty($exepciones[$row_column['Field']]['disabled'])){ $disabled = $exepciones[$row_column['Field']]['disabled']; }else{ $disabled = ''; }
                              if(!empty($exepciones[$row_column['Field']]['style'])){ $style = $exepciones[$row_column['Field']]['style']; }else{ $style = ''; }
                              if(($row_column['Field'] == 'titulo') OR (strpos($row_column['Comment'], '[obligatorio]') !== false)) { $required = 'required'; } else { $required = ''; }
          
                              // lo que sea /4/8 --- lo que sea /4
                              if(ctype_digit(substr(strrchr($row_column['Comment'], "/"), 1))){ $col = substr(strrchr($row_column['Comment'], "/"), 1); } else { $col = '12'; }
                              $row_column['Comment'] = str_replace(strrchr($row_column['Comment'], "/"), '', $row_column['Comment']); // askjdklasj 
          				if($row_column['Comment'] == ''){ $comment = $row_column['Field']; } else { $comment = $row_column['Comment']; }
						
						
                              if($row_column['Type'] == 'mediumtext')	
                              {
                              ?>
                                   <div class='col-md-<? echo $col ?>  form-group bmd-form-group'>
                                        <label class="bmd-label-floating"><? echo $comment ?></label>
                                        <textarea <? echo $required ?> <? echo $disabled; ?> class='form-control' rows="4" name='<? echo $row_column['Field'] ?>' id="edited" onFocus="elEditor = ini_editor(this)" onChange="prever()" ><? echo ${$row_column['Field']}; ?></textarea>
                                   </div>                                    
                              <?
                              }
                              elseif($row_column['Type'] == 'date')	
                              {
                                   ?>
                                   <div class='col-md-<? echo $col ?> form-group bmd-form-group'>
                                        <label class="bmd-label-floating"><? echo $comment ?></label>
                                        <input style="padding:.55rem !important; padding: " class='form-control' <? echo $required ?> <? echo $disabled; ?> value="2000-01-01" name='<? echo $row_column['Field'] ?>' type='date'/>
                                   </div>  
                                   <?
                              }
                              elseif($row_column['Type'] == 'tinyint(1)')	
                              {
                                   ?> 
                                   <div class='col-md-<? echo $col ?>  form-group bmd-form-group'>
                                   
                                   <div class="togglebutton">
                                   <label> <? echo $comment ?>
							<? if(${$row_column['Field']} == 1){ $checked = 'checked="checked"'; } else { $checked = ''; } ?><br />
                                   <input name='<? echo $row_column['Field'] ?>' type="checkbox" value="1" <? echo $checked ?>>
                                   NO&nbsp;&nbsp;<span class="toggle"></span>SI
                                   </label>
                                   </div>                                           

                                   </div> 
                                   <?
                              }
                              elseif(ctype_digit($row_column['Field']))	
                              {
                                   ?> 
                                        <div class='col-md-<? echo $col ?>'>
                                        <label class="bmd-label-floating"><? echo $comment ?></label>
                                        <? 
								
                                             tag_formu($row_column['Field'], $array_aplis[$formu_paso], $id, $id_apli_tag);
                                        ?>
                                        </div>
                                   <?
                              }
                              else
                              {
                              ?>
                                   <div class='col-md-<? echo $col ?> form-group bmd-form-group'>
                                        <label class="bmd-label-floating"><? echo $comment ?></label>
                                        <input class='form-control' <? echo $required ?> <? echo $disabled; ?>  name='<? echo $row_column['Field'] ?>' value='<?PHP  echo ${$row_column['Field']}; ?>' type='text'/>
                                   </div> 
                              <?	
                              }
                         }
               }
          ?>                    
          </div>
		<? if($row_data['publicar']){ ?>
          <div class="row">
               <div class="col-4 offset-md-4 text-center">
                    <input name="formu_paso_repite" class="w-100" type="submit" value="AGREGAR">
                    <br />
                    o
               </div>
          </div>
		<? } ?>
          <div class="row">
               <div class="col-4 offset-md-4 text-center"><input class="w-100" type="submit" value="CONTINUAR"></div>
          </div>
          
          
        </div>
        </div>
</form>          
<?
}
?>