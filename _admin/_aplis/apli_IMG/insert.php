<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP
if(!empty($_GET['confirma']))
{
	$id_apli_img = $_GET['id_apli_img'];

	// CARGAR LA FOTO
	if($_POST['flag'] == 'inserta_foto')
	{
		if(!empty($_FILES['archivo']))
		{
			$id_apli = $_POST['id_apli'];
			$result = mysqli_query($cnx, "SELECT * FROM apli_IMG WHERE id_apli = '".$_POST['id_apli']."'; "); 
			$count = mysqli_num_rows($result);
			foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
			{
				if($_FILES["archivo"]["name"][$key]) 
				{
					$filename = $_FILES["archivo"]["name"][$key];
					$source = $_FILES["archivo"]["tmp_name"][$key];
					$directorio = '../../../_fotos'; 
					if(!file_exists($directorio)){mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");}
					$dir = opendir($directorio); 
					$id = substr($id_apli_img, 0, -2).str_pad($count, 2, "0", STR_PAD_LEFT);
					$target_path = $directorio.'/'.$id.strtolower(strrchr($filename, '.')); 
					if(move_uploaded_file($source, $target_path)) { $mensaje = "El archivo $source se ha almacenado en forma exitosa";} else { $mensaje = "Ha ocurrido un error, por favor inténtelo de nuevo";}
					closedir($dir); 
					redim($id, 300, 300); 
					if($_POST['titulo'] != ''){ $titulo = $_POST['titulo']; } else { $titulo = strstr($filename, '.', true); }
					mysqli_query($cnx, 'INSERT apli_IMG (id_apli_img, id_apli, titulo, ext, fecha, estado) VALUES ("'.$id.'", "'.$id_apli.'", "'.$titulo.'", "'.strtolower(strrev(strstr(strrev($filename), '.', true))).'", "'.$_POST['fecha_nota'].'", 2);');
					$count++;
				}
			}
		}
		else
		{ echo "No has cargado ninguna foto !"; }
	}
	elseif($_POST['flag'] == 'modifica_foto')
	{
		mysqli_query($cnx, "UPDATE apli_IMG SET fecha = '".$_POST['fecha_nota']."' WHERE id_apli_img = '".$id_apli_img."';");
		mysqli_query($cnx, "UPDATE apli_IMG SET titulo = '".charesp($_POST['titulo'])."' WHERE id_apli_img = '".$id_apli_img."';");
	}
}
?>