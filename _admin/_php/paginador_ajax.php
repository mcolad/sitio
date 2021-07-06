<?php
function paginador_ajax($select, $from, $where, $order, $var, $div, $paso = 10)
{
	global $cnx;
	if(!empty($_GET['play'])){ $play = $_GET['play']; } else { $play = 0; }
	if(!empty($_GET['data'])){ $data = $_GET['data']; } else { $data = ''; }

	$result = mysqli_query($cnx, "SELECT * FROM $from $where");

	$cantidad = mysqli_num_rows($result);
	$count = ceil($cantidad/$paso);
	if ($cantidad>0)
	{
		$cantidad = mysqli_num_rows($result);
		$count = ceil($cantidad/$paso);

		echo "<div class='row'><div class='col-md-12'><div class='text-center'><ul class='pagination pagination-sm'>";
		if($play == 0){
		echo "<li class='page-item disabled'><a class='page-link' href='#'>&laquo;&laquo;</a></li>";	
		echo "<li class='page-item disabled'><a class='page-link' href='#'>&laquo;</a></li>";} else{
		echo "<li class='page-item'><a class='page-link' href=\"javascript:recibeid('busqueda/r_predictivo.php', 'play=0&".$var."&q=".$_GET['q']."&data=".$data."&categoria=".$_GET['categoria']."', '', '".$div."');\">&laquo;&laquo;</a></li>"; 
		echo "<li class='page-item'><a class='page-link' href=\"javascript:recibeid('busqueda/r_predictivo.php', 'play=".($play-1)."&".$var."&q=".$_GET['q']."&data=".$data."&categoria=".$_GET['categoria']."', '', '".$div."');\">&laquo;</a></li>";}
		$a = 0;
		$control = 0;

		if($play > 4)
		{
			$a = $play-4;
			if(($count - $play) <= 5){$a = $a-(5-($count-$play));if ($a < 0) {$control += $a;$a = 0;}}
			if ($count - $a > 10) {$control = $a + 10;} 
			else {$control = $count;}
		} 
		else {if ($count > 10) {$control = 10; }else {$control = $count;}}
	
		while($a < $control)
		{
			if($play == $a){ echo "<li class='page-item disable'><a href='#' class='page-link bg-info text-white'><b>".($a+1)."</b></a></li>"; }
			else{ echo "<li class='page-item'><a class='page-link' href=\"javascript:recibeid('busqueda/r_predictivo.php', 'play=".$a."&q=".$_GET['q']."&data=".$data."&categoria=".$_GET['categoria']."&".$var."', '', '".$div."');\">".($a+1)."</a></li>"; }
			$a++;
		}
		if($play+1 == $count){
		echo "<li class='page-item disabled'><a class='page-link' href='#'>&raquo;</a></li>"; 
		echo "<li class='page-item disabled'><a  class='page-link' href='#'>&raquo;&raquo;</a></li>";}else{
		echo "<li class='page-item'><a class='page-link' href=\"javascript:recibeid('busqueda/r_predictivo.php', 'play=".($play+1)."&".$var."&q=".$_GET['q']."&data=".$data."&categoria=".$_GET['categoria']."', '', '".$div."');\">&raquo;</a></li>"; 
		echo "<li class='page-item'><a class='page-link' href=\"javascript:recibeid('busqueda/r_predictivo.php', 'play=".($count-1)."&".$var."&q=".$_GET['q']."&data=".$data."&categoria=".$_GET['categoria']."', '', '".$div."');\">&raquo;&raquo;</a></li>";}
	echo "</ul></div></div></div>";


	$query = "SELECT * FROM $from $where $order LIMIT ".($play*$paso).", ".$paso.";";

	$result = mysqli_query($cnx, $query);
	while($row = mysqli_fetch_array($result))
	{
		$rowp[] = $row;
	}
	if(!empty($rowp)){ return array($rowp); }

	}
	else{ echo "<div>0 registros hallados para este item</div>"; }
}
?>