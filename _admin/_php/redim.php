<?PHP
	function redim($id_img, $dst_w, $dst_h, $recorta = false)
	{
		// para ancho fijo y alto proporcional al original, $dst_h = 0
		// para alto fijo y ancho proporcional al original, $dst_w = 0
		// la salida es del tipo CODE_NNNx0.jpg
		

		global $path;
		ini_set('memory_limit', '5120M');

		if (!file_exists($path.'_fotos/')) {
		    mkdir($path.'_fotos/', 0777, true);
		}


		if($recorta){ $name = '_1'; }else{ $name = ''; }

		if(!file_exists($path.'_fotos/'.$id_img.'_'.$dst_w.'x'.$dst_h.$name.'.jpg'))
		{	
			if(file_exists($path.'_fotos/'.$id_img.'.jpg'))
			{ $src_img = imagecreatefromjpeg($path.'_fotos/'.$id_img.'.jpg'); 
			list($src_w, $src_h) = getimagesize($path.'_fotos/'.$id_img.'.jpg');}

			elseif(file_exists($path.'_fotos/'.$id_img.'.jpeg'))
			{ $src_img = imagecreatefromjpeg($path.'_fotos/'.$id_img.'.jpeg');
			list($src_w, $src_h) = getimagesize($path.'_fotos/'.$id_img.'.jpeg');}

			elseif(file_exists($path.'_fotos/'.$id_img.'.png'))
			{ $src_img = imagecreatefrompng($path.'_fotos/'.$id_img.'.png');
			list($src_w, $src_h) = getimagesize($path.'_fotos/'.$id_img.'.png');}

			elseif(file_exists($path.'_fotos/'.$id_img.'.gif'))
			{ $src_img = imagecreatefromgif($path.'_fotos/'.$id_img.'.gif');
			list($src_w, $src_h) = getimagesize($path.'_fotos/'.$id_img.'.gif');}

			if($dst_w == 0)
			{
				$dst_w = ($dst_h/$src_h)*$src_w;
				$fijo = 'alto';
			}
			elseif($dst_h == 0)
			{
				$dst_h = ($dst_w/$src_w)*$src_h;
				$fijo = 'ancho';
			}
			else{ $fijo = ''; }
		
			$dst_img = imagecreatetruecolor($dst_w, $dst_h);
			$white = imagecolorallocate($dst_img, 255, 255, 255);
			imagefill($dst_img, 0, 0, $white);


			if(!file_exists($path.'_fotos/'.$id_img.'.jpg'))
			{	
				imagejpeg($src_img, $path.'_fotos/'.$id_img.'.jpg', 90); 
			}
			
			if($fijo == 'alto')
			{
				if($recorta)
				{ $new_w = ($dst_h*$src_w)/$src_h; $new_x = ($dst_w - $new_w)/2;
				  imagecopyresampled($dst_img, $src_img, $new_x, 0, 0, 0, $new_w, $dst_h, $src_w, $src_h); }
				else
				{ $new_y = ($src_h - (($dst_h*$src_w)/$dst_w))/2; $new_h = $src_h-($new_y*2);
				  imagecopyresampled($dst_img, $src_img, 0, 0, 0, $new_y, $dst_w, $dst_h, $src_w, $new_h); }
				  $dst_w = 0;
			}
			elseif($fijo == 'ancho')
			{
				if($recorta)
				{ $new_w = ($dst_h*$src_w)/$src_h; $new_x = ($dst_w - $new_w)/2;
				  imagecopyresampled($dst_img, $src_img, $new_x, 0, 0, 0, $new_w, $dst_h, $src_w, $src_h); }
				else
				{ $new_y = ($src_h - (($dst_h*$src_w)/$dst_w))/2; $new_h = $src_h-($new_y*2);
				  imagecopyresampled($dst_img, $src_img, 0, 0, 0, $new_y, $dst_w, $dst_h, $src_w, $new_h); }
				  $dst_h = 0;
			}
			elseif(($src_h/$src_w) >= ($dst_h/$dst_w))
			{
				if($recorta)
				{ $new_w = ($dst_h*$src_w)/$src_h; $new_x = ($dst_w - $new_w)/2;
				  imagecopyresampled($dst_img, $src_img, $new_x, 0, 0, 0, $new_w, $dst_h, $src_w, $src_h); }
				else
				{ $new_y = ($src_h - (($dst_h*$src_w)/$dst_w))/2; $new_h = $src_h-($new_y*2);
				  imagecopyresampled($dst_img, $src_img, 0, 0, 0, $new_y, $dst_w, $dst_h, $src_w, $new_h); }
			}
			else
			{
				if($recorta)
				{ $new_h = ($dst_w*$src_h)/$src_w; $new_y = ($dst_h - $new_h)/2;
	              imagecopyresampled($dst_img, $src_img, 0, $new_y, 0, 0, $dst_w, $new_h, $src_w, $src_h);}					
				else
				{ $new_x = ($src_w - (($dst_w*$src_h)/$dst_h))/2; $new_w = $src_w-($new_x*2);
				  imagecopyresampled($dst_img, $src_img, 0, 0, $new_x, 0, $dst_w, $dst_h, $new_w, $src_h);}
			}
			imagejpeg($dst_img, $path.'_fotos/'.$id_img.'_'.$dst_w.'x'.$dst_h.$name.'.jpg', 90); 
			imagedestroy($dst_img);
			imagedestroy($src_img);
		}
	}
?>