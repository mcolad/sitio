<?
	function id_fecha($fecha)
	{	
		$id_fecha = $fecha;
		$fecha = substr($fecha, 0, 4)."-".substr($fecha, 4, 2)."-".substr($fecha, 6, 2);
		$meses = array('0','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov', 'Dic');
		$mes = $meses[intval(substr($fecha, 5, 2))];
		$date = new DateTime($fecha);
		$salida = $date->format('d');
		$salida = $salida."/".$mes."/";
		$salida = $salida.$date->format('Y');
		$salida = $salida." ".substr($id_fecha, 8, 2).":".substr($id_fecha, 10, 2);
		return $salida;
	}
	
	function fecha($fecha)
	{	
		$meses = array('0','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov', 'Dic');
		$mes = $meses[intval(substr($fecha, 5, 2))];
		$date = new DateTime($fecha);
		$salida = $date->format('d');
		$salida = $salida." de ".$mes." de ";
		$salida = $salida.$date->format('Y');
		return $salida;
	}

	function fecha_comp($fecha)
	{	
		$meses = array('0','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov', 'Dic');
		$mes = $meses[intval(substr($fecha, 5, 2))];
		$date = new DateTime($fecha);
		$salida = $date->format('d');
		$salida = $salida." de ".$mes;
//		$salida = $salida.$date->format('Y');
		return $salida;
	}

	function fecha_dias($fecha)
	{	
		$meses = array('0','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov', 'Dic');
		$mes = $meses[intval(substr($fecha, 5, 2))];
		$date = new DateTime($fecha);
		$salida = $date->format('d');
		$salida = $salida." de ".$mes." de ";
		$salida = $salida.$date->format('Y');
		$fecha = substr($fecha, 0, 10);
		$dias = (strtotime(date('Y-m-d'))-strtotime($fecha))/86400;
		$dias = abs($dias); 
//		if($dias == 0){ $dias = "Hoy"; } elseif($dias == 1){ $dias = "Hace ".floor($dias)." día"; } else { $dias = "Hace ".floor($dias)." días";}
		
		return $dias;
	}

	function tiempotranscurrido($fechaInicio,$fechaFin)
	{
		$fecha1 = new DateTime($fechaInicio);
		$fecha2 = new DateTime($fechaFin);
		$fecha = $fecha1->diff($fecha2);
		$tiempo = "";
			 
		//años
		if($fecha->y > 0) { $tiempo .= $fecha->y; if($fecha->y == 1) $tiempo .= " año"; else $tiempo .= " años"; }
		else{
			//meses
			if($fecha->m > 0) { $tiempo .= $fecha->m; if($fecha->m == 1) $tiempo .= " mes"; else $tiempo .= " meses"; }
			//dias
			else {
				if($fecha->d > 0) { $tiempo .= $fecha->d; if($fecha->d == 1) $tiempo .= " día"; else $tiempo .= " días"; }
				//horas
				else {
					if($fecha->h > 0) { $tiempo .= $fecha->h; if($fecha->h == 1)$tiempo .= " hora"; else $tiempo .= " horas"; }
					//minutos
					else {
							if($fecha->i > 0) { $tiempo .= $fecha->i; if($fecha->i == 1) $tiempo .= " minuto"; else $tiempo .= " min"; }
							//segundos
							else if($fecha->i == 0) $tiempo .= $fecha->s." seg"; 
						 }
					  }
				 }
			}	
		return $tiempo;
	}
?>