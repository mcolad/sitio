<?
function registro($bd = 'apli_USUARIOS', $url_registro = '_admin/index.php')
{
	global $cnx, $path, $abs, $acc_adm, $email_smtp, $email_from, $email_pass, $namesite;
	
	$_SESSION['url_registro'] = '/'.$abs.$url_registro;

	if(empty($inicializa))
	{
		// PARA QUE PIDA CONTRASENIA EN TODO MOMENTO COMENTAR EL SIG IF 
		//
			if(empty($_SESSION['nick']))
			{ 	 
				include($path.'_admin/gestion/registro.php');
			}
			if($bd == 'apli_USUARIOS')
			{
				if(empty($_SESSION['acc_adm_us']))
				{ 	
					include($path.'_admin/gestion/registro.php');
				}
			}
			elseif(!empty($_SESSION['email_us']))
			{
				$result = mysqli_query($cnx, "SELECT * FROM $bd WHERE titulo = '".$_SESSION['email_us']."' LIMIT 1" ); 
				$row = mysqli_fetch_array($result);;
				if($row['estado'] == 0){ mensaje("Cuenta suspendida"); session_destroy(); unset($_SESSION['nick']); unset($_SESSION['acc_adm_us']); die; }
				if($row['estado'] == 1){ mensaje("Cuenta suspendida"); session_destroy(); unset($_SESSION['nick']); unset($_SESSION['acc_adm_us']); die; }
				
				$_SESSION['id_'.strtolower($bd)] = $row['id_'.strtolower($bd)];

				if($bd == 'apli_USUARIOS')
				{
					$_SESSION['acc_adm_us'] = $row['acc_adm_us'];
					if($acc_adm != ''){ if($acc_adm > $row['acc_adm_us']){ echo "CODE ACC001 - Usted no tiene acceso a esta sección"; die; }}
				}
			}
		//
		//
	}
}
?>