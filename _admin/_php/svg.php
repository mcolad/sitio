<?
function svg($svg, $width, $height, $color = 'black')
{
	global $abs;
	if(substr($svg, 0, 4) == 'http')
	{
		$include = $svg;
	}
	else
	{ 
		$include = $abs."_admin/_svg/$svg"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } 
	}

	$svg = file_get_contents($include); 
	$svg = str_replace('xmlns', 'fill="'.$color.'" width="'.$width.'" height="'.$height.'" xmlns', $svg);     
	echo  $svg;
}
?>
