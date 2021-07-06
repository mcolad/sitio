<?
function imprime_tag($tag, $tags)
{
	global $arraytags;
		if($arraytags)
		{ 
			$arr_ph = explode(";",$tags);
			foreach($arr_ph as $i)
			{  
				if(!empty($arraytags[$tag][$i])){ echo $arraytags[$tag][$i]; } 
			}
		}
}
?>