<?PHP
function charesp($texto) 
		{
			$charesp = array (
			'"' => '"', 
			'"' => '"',
			'"' => '"',
			'"' => '"',
//			"'" => '"',
			'"' => '"',
			'"' => '"',
			'-' => '-' 
			);
		
			$texto = strtr($texto, $charesp);
			return $texto;
		}
?>