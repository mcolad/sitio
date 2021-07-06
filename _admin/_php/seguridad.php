<?
	// SEGURIDAD seteo de GET y POST
	$input_arr = array(); 
	foreach ($_POST as $key => $input_arr) 
	{ 
		$_POST[$key] = limpiarCadena($input_arr); 
//		$_POST[$key] = addslashes(limpiarCadena($input_arr)); 
	}
	
	$input_arr = array(); 
	foreach ($_GET as $key => $input_arr) 
	{ 
	$_GET[$key] = addslashes(limpiarCadena($input_arr)); 
	}
	
	function limpiarCadena($valor) {
	$valor = str_ireplace("win.ini","",$valor);
	$valor = str_ireplace("WEB-INF","",$valor);
	$valor = str_ireplace("boot.ini","",$valor);
	$valor = str_ireplace("acunetix_wvs_security_test","",$valor);
	$valor = str_ireplace("web.xml","",$valor);
	$valor = str_ireplace("\nset","",$valor);
	$valor = str_ireplace("|set","",$valor);
	$valor = str_ireplace("root","",$valor);
	$valor = str_ireplace("1'='1","",$valor);
	
//	$valor = str_ireplace("SELECT","",$valor);
//	$valor = str_ireplace("COPY","",$valor);
	$valor = str_ireplace("DELETE","",$valor);
	$valor = str_ireplace("ROOT","",$valor);
	$valor = str_ireplace("DROP","",$valor);
	$valor = str_ireplace("DUMPING","DxUMPING",$valor);
	$valor = str_ireplace("DUMP","",$valor);
	$valor = str_ireplace("DxUMPING","DUMPING",$valor);
	
	$valor = str_ireplace("COLLATE","",$valor);
	$valor = str_ireplace("DROP","",$valor);

	$valor = str_ireplace("/*","",$valor);
	$valor = str_ireplace("*/","",$valor);
	$valor = str_ireplace("||","",$valor);	
	
	
	
	
//	$valor = str_ireplace(" OR ","",$valor);
//	$valor = str_ireplace("LIKE","",$valor);
	$valor = str_ireplace("--","",$valor);
	$valor = str_ireplace("^","",$valor);
	$valor = str_ireplace("¨",'"',$valor);
	$valor = str_ireplace("'",'"',$valor);
//	$valor = str_ireplace("–","-",$valor);
//	$valor = str_ireplace("'","",$valor);
	$valor = str_ireplace('´','"',$valor);
	$valor = str_ireplace('“','"',$valor);
	$valor = str_ireplace('”','"',$valor);
	$valor = str_ireplace('‘','"',$valor);
	$valor = str_ireplace('’','"',$valor);
	return $valor;
	}
	// Eliminar acentos y caracteres especiales para generar archivos en el servidor
?>