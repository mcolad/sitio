<?
function cuerpo($cuerpo, $adj = false, $palabras = false) 
{
	global $cnx, $path;
	$agujas = array("IMG:", "VID:", "URL:", "PDF:");
	foreach($agujas as $aguja) 
	{
		$pos = 0;
		$cuerpo = " ".$cuerpo;
		while(stripos($cuerpo, $aguja, $pos))
		{
			$new_pos = stripos($cuerpo, $aguja, $pos);
			$codigos[] = substr($cuerpo, $new_pos, 18);
			$pos = stripos($cuerpo, $aguja, $pos) + 1;
		}
	}
	if(!empty($codigos))
	{
		foreach($codigos as $codigo) 
		{
			if(substr_count($codigo, 'IMG:') AND !$adj)
			{
				$id_apli_img = strstr ($codigo, 'IMG:');
				$id_apli_img = substr($id_apli_img, 4, 18);
				$result = mysqli_query($cnx, "SELECT * FROM apli_IMG WHERE id_apli_img = '".$id_apli_img."'"); 
				$row = mysqli_fetch_array($result);
				if($row['estado'] > 1)
				{
					$reemplazar = '<div class="row"><div class="col-md-9" >';
					$reemplazar .= '<img class="img-fluid" src="'.$path.'_fotos/'.$row['id_apli_img'].'.jpg" /><br />';
					$reemplazar .= '<font size="-1" style="border-left:solid 1px #ccc; border-bottom:solid 1px #ccc;">&nbsp;&nbsp;&nbsp;'.$row['titulo'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></div></div>';
				} else { $reemplazar = ''; }
				$cuerpo = str_replace($codigo, $reemplazar, $cuerpo);
			}	
			elseif(substr_count($codigo, 'URL:') AND $adj)
			{
				$id_img = strstr ($codigo, 'URL:');
				$id_img = substr($id_img, 4, 14);
				$result = mysqli_query($cnx, "SELECT * FROM _url WHERE id_url = ".$id_img." AND estado >= 1"); 
				$row = mysqli_fetch_array($result);
				$reemplazar = 
				"<div style'width:100%'>
					<div class='epigrafe'><a href='".$row['code']."' target='_blank'>".$row['epigrafe']."</a><br clear='all'>
					<div style='font-size:9px'>".$row['code']."</div>
				</div></div><br clear='all'>";
				$cuerpo = str_replace($codigo, $reemplazar, $cuerpo);
			}
			else
			{
				$cuerpo = str_replace($codigo, '', $cuerpo);
			}
		}
	}
	if($palabras){ echo limita_texto(nl2br($cuerpo), $palabras); } else { echo nl2br($cuerpo); }
	
}
?>