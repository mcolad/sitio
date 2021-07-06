<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?
$date = date('YmdHis');
$tables=array();
$sql="SHOW TABLES";
$result=mysqli_query($cnx,$sql);

while($row=mysqli_fetch_row($result)){ $tables[]=$row[0]; }

$backupSQL="";
foreach($tables as $table)
{
	$query="SHOW CREATE TABLE $table";
	$result=mysqli_query($cnx,$query);
	$row=mysqli_fetch_row($result);
	$backupSQL.="\n\n".$row[1].";\n\n";

	$query="SELECT * FROM $table";
	$result=mysqli_query($cnx,$query);
	
	$columnCount=mysqli_num_fields($result);
	
	for($i=0;$i<$columnCount;$i++)
	{
		while($row=mysqli_fetch_row($result))
		{ 
			$backupSQL.="INSERT INTO $table VALUES(";
			for($j=0;$j<$columnCount;$j++)
			{ 
				$row[$j]=$row[$j];
				if(isset($row[$j])){ $backupSQL.='"'.$row[$j].'"'; }else{ $backupSQL.='""'; }
				if($j<($columnCount-1)){ $backupSQL.=','; }
			}
			$backupSQL.=");\n";
		}
	}
	$backupSQL.="\n";
}

if(!empty($backupSQL))
{
	$backup_file_name=$date."_".$database_name.'.sql';
	$fileHandler=fopen("../backup/".$backup_file_name,'w+');
	$number_of_lines=fwrite($fileHandler,$backupSQL);
	fclose($fileHandler);
	
//	header('Content-Description: File Transfer');
//	header('Content-Type: application/octet-stream');
//	header('Content-Disposition: attachment; filename='.basename($backup_file_name));
//	header('Content-Transfer-Encoding: binary');
//	header('Expires: 0');
//	header('Cache-Control: must-revalidate');
//	header('Pragma: public');
//	header('Content-Length: '.filesize($backup_file_name));
//	readfile($backup_file_name);
//	ob_clean();
//	flush();
}
?>
Ha quedado una copia dela BD en nuestro servidor. <br>
Si desea, puede descargar una copia aquí:
<a type='button' class='btn btn-success btn-sm' href="backup/<? echo $backup_file_name ?>" style="width:100%">Descargar Backup</a>

<?php

function agregar_zip($dir, $zip) {
  //verificamos si $dir es un directorio
  if (is_dir($dir)) {
    //abrimos el directorio y lo asignamos a $da
    if ($da = opendir($dir)) {
      //leemos del directorio hasta que termine
      while (($archivo = readdir($da)) !== false) {
        /*Si es un directorio imprimimos la ruta
         * y llamamos recursivamente esta función
         * para que verifique dentro del nuevo directorio
         * por mas directorios o archivos
         */
        if (is_dir($dir . $archivo) && $archivo != "." && $archivo != "..") {
          echo "<strong>Creando directorio: $dir$archivo</strong><br/>";
          agregar_zip($dir . $archivo . "/", $zip);
 
          /*si encuentra un archivo imprimimos la ruta donde se encuentra
           * y agregamos el archivo al zip junto con su ruta 
           */
        } elseif (is_file($dir . $archivo) && $archivo != "." && $archivo != "..") {
          echo "Agregando archivo: $dir$archivo <br/>";
          $zip->addFile($dir . $archivo, $dir . $archivo);
        }
      }
      //cerramos el directorio abierto en el momento
      closedir($da);
    }
  }
}

die;

$zip = new ZipArchive();

$dir = '../';
 
//ruta donde guardar los archivos zip, ya debe existir
$rutaFinal = "../backup";
 
if(!file_exists($rutaFinal)){
  mkdir($rutaFinal);
}
 
$archivoZip = $date."_archivos.zip";
 
if ($zip->open($archivoZip, ZIPARCHIVE::CREATE) === true) {
  agregar_zip($dir, $zip);
  $zip->close();
 
  //Muevo el archivo a una ruta
  //donde no se mezcle los zip con los demas archivos
  rename($archivoZip, "$rutaFinal/$archivoZip");
 
  //Hasta aqui el archivo zip ya esta creado
  //Verifico si el archivo ha sido creado
  if (file_exists($rutaFinal. "/" . $archivoZip)) {
    echo "Proceso Finalizado!! <br/><br/>
                Descargar: <a href='$rutaFinal/$archivoZip'>$archivoZip</a>";
  } else {
    echo "Error, archivo zip no ha sido creado!!";
  }
}
?>


    <a  href="backup/<? echo $backup_file_name; ?>" class='btn btn-info btn-sm' style="width:100%"> Descargar</a>
