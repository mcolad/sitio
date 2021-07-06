<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP $include = "header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<body>
<?
if(!empty($_POST['pass_old']))
{
	$result = mysqli_query($cnx, "SELECT * FROM apli_USUARIOS WHERE titulo = '".$_GET['email_us']."'; "); 
	$row = mysqli_fetch_array($result);
	if((md5($_POST['pass_old']) == $row['pass']) OR ($_POST['pass_old'] ==  substr($row['pass'], 0, 4).substr($row['pass'], -4)))
	{
		mysqli_query($cnx, "UPDATE apli_USUARIOS SET pass = '".md5($_POST['pass'])."' WHERE titulo = '".$_GET['email_us']."';"); 
			?>
                       <div class="container">
						<div id="registro">
							<h3 class="text-center text-info pt-5">Modificar Clave </h3>
								<div id="login-row" class="row justify-content-center align-items-center">
                                        <? echo "Clave modificada exitosamente"; ?>
								</div>
								<div class="row justify-content-center align-items-center p-4">
                                        <? echo svg('svgadmin/laugh-wink.svg', '400', '400', '#17a2b8'); ?>
								</div>
                              </div>
                         </div>
					
			<?
		die;
	}
	else
	{
		echo "No nos coincide tu antigua clave. vuelve a intentar";	
	}

}
?>
        <div class="container">
						<script>
						var check = function() 
						{
							  if ((document.getElementById('pass').value == document.getElementById('confirm_pass').value)) 
							  {
								document.getElementById('message').style.color = 'green';
								document.getElementById('message').innerHTML = '<input type="submit" style="width:100%" name="submit" class="btn btn-info btn-md" value="MODIFICAR CLAVE">';
							  } 
							  else 
							  {
 								document.getElementById('message').style.color = 'red';
								document.getElementById('message').innerHTML = 'Error en la repetici&oacute;n de Password';
							  }
						}
						</script>
						<div id="registro">
							<h3 class="text-center text-info pt-5">Modificar Clave </h3>
								<div id="login-row" class="row justify-content-center align-items-center">
									<div id="login-column" class="col-md-6">
										<div class="login-box col-md-12">
											<form id="login-form" name="formu" action="?email_us=<? echo $_GET['email_us']?>" class="form" method="post">
												<div class="form-group">
													<label class="text-info">Correo electrónico</label><br>
													<? echo $_GET['email_us']?>
												<div class="form-group">
													<label for="password" class="text-info">Clave actual:</label><br>
													<input type="password" required name="pass_old" id="pass_old" class="form-control">
												</div>
												</div>
												<div class="form-group">
													<label for="password" class="text-info">Clave nueva:</label><br>
													<input type="password" required name="pass" id="pass" class="form-control">
												</div>
												<div class="form-group">
													<label for="confirm_password" class="text-info">Repetir clave nueva:</label><br>
													<input type="password" required name="confirm_pass" id="confirm_pass" class="form-control" onkeyup='check();'>
												</div>
												<div class="form-group"><span id='message'>&nbsp;</span></div>
											</form>
										</div>
									</div>
								</div>
							</div>
       </div>
</body>