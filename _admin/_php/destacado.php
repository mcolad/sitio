<?
function destacado($destacado)
{
	// para recojer los datos:
	// list($img, $img_url, $pdf, $pdf_url, $zip, $zip_url) = destacado()
	
	global $path, $cnx;
	$array = explode(";", $destacado);
	foreach($array as $value)
	{
		$url = '';
		$var = strtolower(substr($value, 0, 3));
		$var_url = strtolower(substr($value, 0, 3)).'_url';
		if($var == 'img')
		{ 
			$result = mysqli_query($cnx, "SELECT ext FROM apli_IMG WHERE id_apli_img = '".substr($value, 4)."' LIMIT 1;");
			$row  = mysqli_fetch_array($result);
			$url = $path.'_fotos/'.substr($value, 4).".".$row['ext']; 
		}
		if($var == 'pdf'){ $url = $path.'_pdf/'.substr($value, 4).'.pdf'; }
		if($var == 'zip')
		{ 
			$result = mysqli_query($cnx, "SELECT ext FROM apli_ZIP WHERE id_apli_zip = '".substr($value, 4)."' LIMIT 1;");
			$row  = mysqli_fetch_array($result);
			$url = $path.'_zip/'.substr($value, 4).".".$row['ext'];  
		}
		$$var = substr($value, 4);
		$$var_url = $url;
	}
	if(empty($img)){ $img = ''; }; if(empty($pdf)){ $pdf = ''; }; if(empty($zip)){ $zip = ''; };
	if(empty($img_url)){ $img_url = ''; }; if(empty($pdf_url)){ $pdf_url = ''; }; if(empty($zip_url)){ $zip_url = ''; };
	return array($img, $img_url, $pdf, $pdf_url, $zip, $zip_url);
}



function xxxdestacado($id_apli, $tipo)
{
	return substr(strstr($id_apli, $tipo), 4, 14);
}
?>