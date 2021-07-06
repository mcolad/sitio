<?
// Estado 0: Usuario dado de baja 
// Estado 1: Usuario registrado pero aún sin alta para operar
// Estado 2: Usuario con acceso normal a merced de los estados de acc_adm_us

// Pass con 4 dígitos: Se necesita cambio de logueo / continua con acc_adm_us asignado

// acc_adm_us 0: Usuario anónimo sin logueo
?>
<?
if(empty($_SESSION['nick'])){ $email = ''; $msj_err = ''; $instancia = 'loguearse'; }
if($bd == 'apli_USUARIOS')
{
	if(empty($_SESSION['acc_adm_us'])){ $email = ''; $msj_err = ''; $instancia = 'loguearse'; }
}

if(empty($_POST['instancia'])){
	$instancia = 'loguearse';
	if(empty($_GET['instancia'])){ $instancia = 'loguearse'; }
	else{ $instancia = $_GET['instancia']; }
}else{ $instancia = $_POST['instancia']; }

//echo $_SERVER['PHP_SELF'];
if(($instancia == 'loguearse') AND ($_SERVER['PHP_SELF'] != $_SESSION['url_registro'])) { echo "<script>window.top.location.href = \"".$_SESSION['url_registro']."\";</script>";  /* header("Location: ".$abs."/_admin/index.php");  */ die;}

if($instancia == 'loguear')
{ 
	$result = mysqli_query($cnx, "SELECT * FROM $bd WHERE titulo = '".$_POST['email']."';"); 
	$row = mysqli_fetch_array($result);

	if((md5($_POST['pass']) ==  $row['pass']) OR ($_POST['pass'] ==  substr($row['pass'], 0, 4).substr($row['pass'], -4)))
	{ 
		if($row['estado'] == 0)
		{ 
			$include = $abs."_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); $msj_err = $row['titulo'].": Este usuario está dado de baja"; $instancia = 'loguearse'; 
		}
		elseif($row['estado'] == 1)
		{ 
			$include = $abs."_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); $msj_err = $row['titulo'].": Usted se encuentra registrado pero aún no le han dado el alta para operar<br>Comuníquese con el administrador"; $instancia = 'loguearse'; 
		}
		elseif($row['estado'] == 2)
		{ 
			if($bd == 'apli_USUARIOS')
			{
				$_SESSION['acc_adm_us'] = $row['acc_adm_us']; 
				$_SESSION['acc_apli'] = explode(";", $row['acc_apli']); 
			}
			$_SESSION['nick'] = charesp(strstr($row['titulo'], '@', true)); 
			$_SESSION['email_us'] = $row['titulo']; 
			$_SESSION['estado_us'] = $row['estado']; 
			if($_POST['pass'] ==  substr($row['pass'], 0, 4).substr($row['pass'], -4)){ $_SESSION['flag_pedircambioclave'] = 1; }
		}
	} 
	elseif($row == ''){ $msj_err = 'El correo '.$_POST['email'].' no existe. Usted debe registrarse'; $email = $_POST['email']; $instancia = 'registrarse'; } 
	else{ $email = $_POST['email']; $msj_err = 'La clave ingresada no se corresponde con el usuario'; $instancia = 'loguearse';}
	
}
elseif($instancia == 'registrar')
{ 

	$result = mysqli_query($cnx, "SELECT * FROM $bd WHERE titulo = '".$_POST['email']."'; "); 
	$row = mysqli_fetch_array($result);

	if($row == '')
	{
		$id = date('Ymdhis');
		$nick = charesp(strstr($_POST['email'], '@', true));
		mysqli_query($cnx, "INSERT INTO $bd (id_".strtolower($bd).") VALUES ('".$id."')");
		mysqli_query($cnx, "UPDATE $bd SET titulo = '".charesp($_POST['email'])."' WHERE id_".strtolower($bd)." = '".$id."';");
//		mysqli_query($cnx, "UPDATE $bd SET nick = '".$nick."' WHERE id_".strtolower($bd)." = '".$id."';");
		mysqli_query($cnx, "UPDATE $bd SET pass = '".md5($_POST['pass'])."' WHERE id_".strtolower($bd)." = '".$id."';"); 
		if($bd == 'apli_USUARIOS')
		{
			mysqli_query($cnx, "UPDATE $bd SET acc_adm_us = '1' WHERE id_".strtolower($bd)." = '".$id."';"); 
			
		}
		else
		{ mensaje('Registro Exitoso!', 'Inicie el proceso de logueo con su usuario y clave'); die; }
//		mysqli_query($cnx, "UPDATE apli_USUARIOS SET email = '".$_POST['email']."' WHERE id_apli_usuarios = '".$id."';"); 
	}
	else{ $msj_err = "El correo ".$_POST['email']." ya existe en nuestras bases"; $instancia = 'registrarse'; }
}
elseif($instancia == 'recuperar') 
{ 
	$result = mysqli_query($cnx, "SELECT * FROM $bd WHERE titulo = '".$_POST['email']."'; "); 
	$row = mysqli_fetch_array($result);

	if($row == '')
	{ 
		$email = $_POST['email'];
		$msj_err = 'El correo '.$_POST['email'].' no existe. Usted debe registrarse'; 
		$instancia = 'registrarse'; 
	} 
	else
	{ 
		if($email_smtp != '')
		{
			$include = $abs."_admin/phpmailer/class.phpmailer.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);
			
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = $email_smtp; // SMTP a utilizar. Por ej. smtp.elserver.com
			$mail->Username = $email_from; // Correo completo a utilizar
			$mail->Password = $email_pass; // Contraseña
			$mail->Port = 25; // Puerto a utilizar
			$mail->From = $email_from; // Desde donde enviamos (Para mostrar)
			$mail->FromName = $namesite;
			$mail->AddAddress($_POST['email']); // Esta es la dirección a donde enviamos
			//$mail->AddCC("matutecolado@gmail.com"); // Copia
			//$mail->AddCC("comunicacion@amgba.org.ar"); // Copia
			//$mail->AddBCC("cuenta@dominio.com"); // Copia oculta
			$mail->IsHTML(true); // El correo se envía como HTML
			$mail->Subject = $namesite; // Este es el titulo del email.

			$mesage = "Tu nueva clave es: ".substr($row['pass'], 0, 4).substr($row['pass'], -4);
//			ob_start();
//			include('email_contenido.php');
//			$mesage = ob_get_contents();
//			ob_end_clean();
			
			$body = utf8_decode($mesage);
			$mail->Body = $body; // Mensaje a enviar
			$mail->AltBody = "En caso de no poder leer correctamente este msj, notifique a comunicacion@amgba.org.ar"; // Texto sin html
			//$mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");


			$exito = $mail->Send(); // Envía el correo.
//			$exito = 's'; // Envía el correo.
		
			$msj_err = 'Hemos enviado una clave de recuperación a su cuenta de correo';
			$email = $_POST['email'];
			$instancia = 'loguearse';  
		}
		else
		{
			$msj_err = 'No hemos podido enviar una clave de recuperación porque el administrador no ha configurado los correos del servidor. Ponte en contacto con el webmaster.';
			$email = $_POST['email'];
			$instancia = 'loguearse';  
		}
	}
} 

?>
<? if($instancia == 'loguearse'){ ?>
<?PHP $include = $abs."_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<!--<body style=" background:url(/<? echo $abs; ?>_admin/_img/fondo.jpg); background-position:center; background-size: cover; background-repeat:no-repeat">-->
<body>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9" style="opacity:0.8;">
 
               <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                         <div class="row">
                          	<div class="col-lg-6 d-none d-lg-block"><img class="img-fluid"  src="/<? echo $abs; ?>_admin/_img/logueo.png" /></div>
              				<div class="col-lg-6">
                              
                              	<div class="text-center pl-5 pr-5"><br>
							Si es la primera vez que ingresás<br>primero tenés que realizar el 
                                   <a type="submit" href="?instancia=registrarse" style="width:100%" name="submit" class="btn btn-primary btn-info btn-block" >REGISTRO</a>
                                   </div>
                                   
                                   <div class="pt-3 pl-5 pr-5">
                                   <div class="text-center">
                                   <h4 class="h4 text-gray-900">LOGUEO</h4>
                                   <div class="mb-4">(Ya tengo cuenta registrada)</div>
                                   </div>
                                   <div class="text-center text-danger"><? echo $msj_err; ?></div>
                                        <form class="user" action="?" method="post">
                                        <input type="hidden" value="loguear" name="instancia" />
                                        <div class="form-group">
                                        <input type="email" required name="email" value="<? echo $email; ?>" placeholder="ingrese correo" class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <input type="password" required name="pass" placeholder="pass" class="form-control">
                                        </div>
                                        
                                        <input type="submit" style="width:100%" name="submit" class="btn btn-primary btn-info btn-block" value="INGRESAR"><br>
                                        </form>
                                   <div class="text-right"><a style="width:100%" href="?instancia=registrarse" class="text-info">Ir a Registro</a></div>
                                   <? if($email_smtp != ''){?><div class="text-right"><a style="width:100%" href="?instancia=recupero" class="text-info">Ir a Recuperar Clave</a></div><? } ?>
                                   
                                   </div>
                              </div>
                              <div class="col-lg-3"></div>
                         </div>
                    </div>
               </div>

    </div>

  </div>
  </div>
</body>
<? die; }  ?>
<? if($instancia == 'registrarse'){ ?>
<?PHP $include = $abs."_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
						<script>
						var check = function() {
						  if (document.getElementById('pass').value ==
							document.getElementById('confirm_pass').value) {
							document.getElementById('message').style.color = 'green';
							document.getElementById('message').innerHTML = '<input type="submit" style="width:100%" name="submit" class="btn btn-info btn-md" value="REGISTRAR">';
						  } else {
							document.getElementById('message').style.color = 'red';
							document.getElementById('message').innerHTML = 'Error en la repetición de Password';
						  }
						}
						</script>

<body style=" background:url(/<? echo $abs; ?>_admin/_img/fondo.jpg); background-size: cover; background-repeat:no-repeat">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9"  style="opacity:0.8;">
 
            

               <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                         <div class="row">
                              <div class="col-lg-3"></div>
                              <div class="col-lg-6">
                                   <div class="p-5">
                                   <div class="text-center">
                                   <h4 class="h4 text-gray-900">REGISTRO DE USUARIO</h4>
                                   <div class="mb-4 text-danger">(Aún no tengo usuario)</div>
                                   </div>
                                   <div class="text-center text-danger"><? echo $msj_err; ?></div>
                                        <form class="user" action="?" method="post">
								<input type="hidden" value="registrar" name="instancia" />
                                        <div class="form-group">
                                        <input type="email" required name="email" placeholder="ingrese correo" class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <input type="password" required name="pass" id="pass" placeholder="ingrese pass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <input type="password" required name="confirm_pass" id="confirm_pass" placeholder="repita pass" class="form-control" onkeyup='check();'>
                                        </div>
                                        <div class="form-group">
                                        <span id='message'>&nbsp;</span>
                                        </div> 
                                        </form>
                                   <div class="text-right"><a style="width:100%" href="?registro=loguearse" class="text-info">Ir a Logueo</a></div>
                                   <? if($email_smtp != ''){?><div class="text-right"><a style="width:100%" href="?instancia=recupero" class="text-info">Ir a Recuperar Clave</a></div><? } ?>
                                   
                                   </div>
                              </div>
                              <div class="col-lg-3"></div>
                         </div>
                    </div>
               </div>

    </div>

  </div>
  </div>
</body>
<? die; }  ?>

<? if($instancia == 'recupero'){ ?>
<?PHP $include = $abs."_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
						<script>
						var check = function() {
						  if (document.getElementById('pass').value ==
							document.getElementById('confirm_pass').value) {
							document.getElementById('message').style.color = 'green';
							document.getElementById('message').innerHTML = '<input type="submit" style="width:100%" name="submit" class="btn btn-info btn-md" value="REGISTRAR">';
						  } else {
							document.getElementById('message').style.color = 'red';
							document.getElementById('message').innerHTML = 'Error en la repetición de Password';
						  }
						}
						</script>

<body style=" background:url(/<? echo $abs; ?>_admin/_img/fondo.jpg); background-size: cover; background-repeat:no-repeat">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9"  style="opacity:0.8;">
 
            

               <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                         <div class="row">
                              <div class="col-lg-3"></div>
                              <div class="col-lg-6">
                                   <div class="p-5">
                                   <div class="text-center">
                                   <h4 class="h4 text-gray-900">RECUPERAR CLAVE</h4>
                                   <div class="mb-4 text-danger">(No recuerdo mi clave)</div>
                                   </div>
                                   <div class="text-center text-danger"><? echo $msj_err; ?></div>
                                        <form class="user" action="?" method="post">
								<input type="hidden" value="recuperar" name="instancia" />
                                        <div class="form-group">
                                        <input type="email" required name="email" placeholder="ingrese correo" class="form-control">
                                        </div>   
                                        <input type="submit" style="width:100%" name="submit" class="btn btn-primary btn-info btn-block" value="RECUPERAR"><br>
                                        </form>
                                   <div class="text-right"><a style="width:100%" href="?registro=loguearse" class="text-info">Ir a Logueo</a></div>
                                   <div class="text-right"><a style="width:100%" href="?instancia=registro" class="text-info">Ir a Registro</a></div>
                                   
                                   </div>
                              </div>
                              <div class="col-lg-3"></div>
                         </div>
                    </div>
               </div>

    </div>

  </div>
  </div>
</body>
<? die; }  ?>