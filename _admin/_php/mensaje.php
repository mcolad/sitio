<?
function mensaje($titulo = '', $mensaje = '')
{
	global $abs;
	$include = $abs."_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); 
?>
<body style="background-size: cover; background-repeat:no-repeat">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">
 
               <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                         <div class="row">
                              <div class="col-lg-3"></div>
                              <div class="col-lg-6">
                                   <div class="p-5">
                                   <div class="text-center">
                                   <h4 class="h4 text-gray-900"><? echo $titulo ?></h4>
                                   </div>
                                   <div class="text-center text-danger"><? echo $mensaje; ?></div>

                                   <div><a style="width:100%; margin-top:40px;" href="?instancia=registrarse" class="btn btn-info">Ir a Registro</a></div>
                                   <div><a style="width:100%; margin-top:20px;" href="?registro=loguearse" class="btn btn-info">Ir a Logueo</a></div>
                                   
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
<?
}
?>