<?PHP if(empty($id_session)) { session_start(); } $id_session = session_id();?>
<?PHP error_reporting(E_ALL); ini_set('display_errors', '1'); ?>
<?PHP 
//  header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
//  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//  header("Cache-Control: no-store, no-cache, must-revalidate");
//  header("Cache-Control: post-check=0, pre-check=0", false);
//  header("Pragma: no-cache");

//	$raiz = "";   
	$namesite = 'Sistemas normativa - El Hoyo';

	$dom = 'sistema.concejoelhoyo.com.ar/';
	$abs = ''; // si hay nombre de carpeta se debe poner / al final
//	$abs = 'ingenieria/'; // si hay nombre de carpeta se debe poner / al final

	$database_name = "c1400473_sis_eh";
	$database_host = 'localhost';
	$database_user = 'c1400473_sis_eh';
	$database_pass = 'KAlido86ba';

	// necesario para recupero de claves
	$email_smtp = 'c1400473.ferozo.com';
	$email_from = 'prensa@concejoelhoyo.com.ar';
	$email_pass = 'Calesita01'; 
	 
	$path = substr($include, 0, -10); 
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);	
?>
<?PHP 
	$cnx = mysqli_connect($database_host, $database_user, $database_pass, $database_name) or die ("No se ha podido conectar<br />	 Comunicarse con soporte<br />");
	!$cnx->set_charset("utf8");
?>
<?
	$directorio = opendir($path."_admin/_php/"); //ruta actual
	while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
	{
		if (!is_dir($archivo) AND (substr($archivo, 0, 1) != '_') AND (substr($archivo, -4) != '.txt')) //verificamos si es o no un directorio y excluimos los que empiezan con _
		{
			include_once($path."_admin/_php/".$archivo);
		}
	}
?>
<?PHP if(!empty($_GET['play'])){ $play = $_GET['play']; } else { $play = ''; }  ?>
<?PHP if(!empty($_GET['filtro_tag'])){ $filtro_tag = $_GET['filtro_tag']; } else { $filtro_tag= ''; }  ?>
<?PHP if(empty($_GET['order_que'])){ $order_que = "fecha"; } else { $order_que = $_GET['order_que']; }  ?>
<?PHP if(empty($_GET['order'])){ $order = "DESC"; } else { $order = $_GET['order']; }  ?>
<?
//$get = '';
//foreach ($_GET as $key => $input_arr){ $get = $get.$key."=".$_GET[$key]."&"; }
?>
<? 
if(!empty($_GET['destroy'])){ unset($_SESSION['acc_apli']); unset($_SESSION['nick']); unset($_SESSION['nick']); $_SESSION['estado_us']; unset($_SESSION['acc_adm_us']); unset($_SESSION['flag_pedircambioclave']); }
?>
<?php 
//if((strstr(strstr($_SERVER['SCRIPT_FILENAME'], '_admin'), '/', true) == '_admin') AND (empty($inicializa)))
if(empty($inicializa))
{
	// cargo todas las variables globales
	$result_variables = mysqli_query($cnx, "SELECT * FROM apli_VARIABLES WHERE (estado > 1)");
	while($row_variables = mysqli_fetch_array($result_variables))
	{
		eval($row_variables['variables']);
	}

	// cargo todos los tags quedando tipo id_apli_tagdetag[id_apli_tag] = titulo

	$result = mysqli_query($cnx, "SELECT * FROM apli_TAGDETAG"); 
	while($row = mysqli_fetch_array($result))
	{
		// cada tagdetag en un array distinto de tipo
		// $array20210424002144['titulo']

		// array único (todo en un solo array)

		$arraytags[$row['id_apli_tagdetag']]['titulo'] = $row['titulo'];
		$query2 = "SELECT * FROM apli_TAG WHERE id_apli_tagdetag LIKE '%".$row['id_apli_tagdetag']."%'";
		$result2 = mysqli_query($cnx, $query2); 
		while($row2 = mysqli_fetch_array($result2))
		{
			$arraytags[$row['id_apli_tagdetag']][$row2['id_apli_tag']] = $row2['titulo'];
		}
//		${'array'.$row['id_apli_tagdetag']} = array($row2['id_apli_tag'] => $row2['titulo']);

         ${'array'.$row['id_apli_tagdetag']} = $arraytags[$row['id_apli_tagdetag']];

//		$arraytututu = $arraytags['20210424002144'];

//		${'array'.$row['id_apli_tagdetag']} = 
	} 
	
	// cargo todos los datos de la apli $row_data
	if((strstr(strstr($_SERVER['SCRIPT_FILENAME'], '_admin'), '/', true) == '_admin'))
	{
		$apli = substr(strstr(strstr($_SERVER['SCRIPT_FILENAME'], 'apli_'), '/', true), 5); 
		$result_data = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (titulo = '".$apli."')");
		$row_data = mysqli_fetch_array($result_data);						 
		$acc_adm = $row_data['acc_adm'];
	}

	// solicito registro
//	echo strstr(strstr($_SERVER['SCRIPT_FILENAME'], '_admin'), '/', true); die;
	if((strstr(strstr($_SERVER['SCRIPT_FILENAME'], '_admin'), '/', true) == '_admin') AND empty($no_registro))
	{
		registro();
	}
}
?>