<?php
function paginador($select, $from, $where, $order_que, $order, $var, $paso = 10, $view = 1)
{
	global $path;
	echo "<style> .pagination{ justify-content: center; }  </style>";
	global $cnx, $order_que, $order, $play;
	if(!empty($play)){ $play = $_GET['play']; } else { $play = 0; }
//	if(!empty($_GET['play'])){ $play = $_GET['play']; } else { $play = 0; }
//	if(!empty($_GET['order_que'])){ $order_que = $_GET['order_que']; }
//	if(!empty($_GET['order'])){ $order = $_GET['order']; }
	$result = mysqli_query($cnx, "SELECT * FROM $from $where");
	$cantidad = mysqli_num_rows($result);
	$count = ceil($cantidad/$paso);
	
	if ($cantidad>0)
	{
			$cantidad = mysqli_num_rows($result);
			$count = ceil($cantidad/$paso);
	
			if($cantidad > $paso)
			{
				if($view) {
				?>
                    <div class="d-none d-lg-block d-xl-block">
                    <ul class='pagination pagination-sm' style="margin-top:10px;">
					<?
                         if(($order_que == 'listorder') AND ($order == 'ASC')) { 
                         echo "<li><a title='Abrir modal para ordenar' class='page-link modalButton' style='border-right:none' data-toggle='modal' data-width=100% data-target='#myModal_ordenar'>"; 
                         svg('svgadmin/list-ol.svg', '20', '20', 'orange'); 
                         echo "</a></li>";
                         echo "<li title='Ordenado con el link ORDENAR'  class='page-item'><a style='border-left:none' class='page-link' href='?play=".$play."&".$var."&order_que=listorder&order=DESC'>"; svg('svgadmin/list.svg', '20', '20', '#e5627e'); echo "</a></li>";}
                         
                         elseif(($order_que == 'listorder') AND ($order == 'DESC')){ 
                         echo "<li><a title='Abrir modal para ordenar' class='page-link modalButton' style='border-right:none' data-toggle='modal' data-width=100% data-target='#myModal_ordenar'>"; 
                         svg('svgadmin/list-ol.svg', '20', '20', 'orange'); 
                         echo "</a></li>";
                         echo "<li title='Ordenado con el link ORDENAR' class='page-item'><a style='border-left:none' class='page-link' href='?play=".$play."&".$var."&order_que=listorder&order=ASC'>"; svg('svgadmin/list.svg', '20', '20', 'red'); echo "</a></li>";}
                         
                         else{ 
                         echo "<li><a title='Abrir modal para ordenar' class='page-link' style='border-right:none; cursor:default' data-width=100% >"; 
                         svg('svgadmin/list-ol.svg', '20', '20', 'gray'); 
                         echo "</a></li>";
                         echo "<li title='Ordenado con el link ORDENAR' class='page-item'><a style='border-left:none' class='page-link' href='?play=".$play."&".$var."&order_que=listorder&order=".$order."'>"; svg('svgadmin/list.svg', '20', '20', 'gray'); echo "</a></li>";}
                         
                         if(($order_que == 'titulo') AND ($order == 'ASC')) { echo "<li title='Ordenado por título'  class='page-item'><a class='page-link' href='?play=".$play."&".$var."&order_que=titulo&order=DESC'>"; svg('svgadmin/sort-alpha-down.svg', '20', '20', '#e5627e'); echo "</a></li>";}
                         elseif(($order_que == 'titulo') AND ($order == 'DESC')){ echo "<li title='Ordenado por título'  class='page-item'><a class='page-link' href='?play=".$play."&".$var."&order_que=titulo&order=ASC'>"; svg('svgadmin/sort-alpha-down-alt.svg', '20', '20', 'red'); echo "</a></li>";}
                         else{ echo "<li title='Ordenado por título' class='page-item'><a class='page-link' href='?play=".$play."&".$var."&order_que=titulo&order=".$order."'>"; svg('svgadmin/sort-alpha-down.svg', '20', '20', 'gray'); echo "</a></li>";}
                         
                         if(($order_que == 'fecha') AND ($order == 'ASC')) { echo "<li title='Ordenado por fecha'  class='page-item'><a class='page-link' href='?play=".$play."&".$var."&order_que=fecha&order=DESC'>"; svg('svgadmin/calendar.svg', '20', '20', '#e5627e'); echo "</a></li>";}
                         elseif(($order_que == 'fecha') AND ($order == 'DESC')){ echo "<li title='Ordenado por fecha'  class='page-item'><a class='page-link' href='?play=".$play."&".$var."&order_que=fecha&order=ASC'>"; svg('svgadmin/calendar.svg', '20', '20', 'red'); echo "</a></li>";}
                         else{ echo "<li title='Ordenado por fecha' class='page-item'><a class='page-link' href='?play=".$play."&".$var."&order_que=fecha&order=".$order."'>"; svg('svgadmin/calendar.svg', '20', '20', 'gray'); echo "</a></li>";}
                         
                         if(($order_que == 'id_'.strtolower($from)) AND ($order == 'ASC')) { echo "<li title='Ordenado por carga'  class='page-item'><a class='page-link' href='?play=".$play."&".$var."&order_que=id_".strtolower($from)."&order=DESC'>"; svg('svgadmin/history.svg', '20', '20', '#e5627e'); echo "</a></li>";}
                         elseif(($order_que == 'id_'.strtolower($from)) AND ($order == 'DESC')){ echo "<li title='Ordenado por carga'  class='page-item'><a class='page-link' href='?play=".$play."&".$var."&order_que=id_".strtolower($from)."&order=ASC'>"; svg('svgadmin/history.svg', '20', '20', 'red'); echo "</a></li>";}
                         else{ echo "<li title='Ordenado por carga' class='page-item'><a class='page-link' href='?play=".$play."&".$var."&order_que=id_".strtolower($from)."&order=".$order."'>"; svg('svgadmin/history.svg', '20', '20', 'gray'); echo "</a></li>";}
                         ?>
                        <!-- MODAL -->
                        <div class="modal fade" id="myModal_ordenar" tabindex="-1" role="dialog"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                        <!--            <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Top</h4>
                                    </div>
                        -->        <div class="modal-body" style="height:650px">
                                <iframe height='600px' width='100%' src="<? echo $path; ?>_admin/gestion/ordenar.php?apli_padre=<? echo str_replace('apli_', '', $from); ?>" frameborder="0"></iframe>
                                </div>
                                <div class="modal-footer">
                                <button type="button" onClick="javascript:window.location.reload()" class="btn btn_admin" data-dismiss="modal">Guardar</button>
                                </div>
                                </div>
                            </div>
                        </div>                    
				</ul>
                    </div>
                 <? } ?>   
                    
                    <ul class='pagination pagination-sm' style="margin-top:10px">         
                <?
				if($play == 0){echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-double-left.svg', 21, 21, 'gray');
				echo "</a></li>";	
				echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-left.svg', 21, 21, 'gray');
				echo "</a></li>";}
				else{echo "<li class='page-item'><a class='page-link' href='?play=0&order_que=$order_que&order=$order&".$var."'>";
				 svg('svgadmin/angle-double-left.svg', 21, 21, '#e5627e');
				echo "</a></li>"; 
				echo "<li class='page-item'><a class='page-link' href='?play=".($play-1)."&order_que=$order_que&order=$order&".$var."'>";
				 svg('svgadmin/angle-left.svg', 21, 21, '#e5627e');
				echo "</a></li>";}

				$a = 0;
				$control = 0;
	
				if($play > 4)
				{
					$a = $play-4;
					if(($count - $play) <= 5){$a = $a-(5-($count-$play));if ($a < 0) {$control += $a;$a = 0;}}
					if ($count - $a > 10) {$control = $a + 10; } 
					else {$control = $count;}
				} 
				else {if ($count > 10) {$control = 10; }else {$control = $count;}}
			
				while($a < $control)
				{
					if($play == $a){ echo "<li class='page-item active'><a href='#' class='page-link bg-warning text-white'><b>".($a+1)."</b></a></li>"; }
					else{ echo "<li class='page-item'><a class='page-link d-none d-lg-block d-xl-block' href='?play=".$a."&order_que=$order_que&order=$order&".$var."'>".($a+1)."</a></li>"; }
					$a++;
				}
				
				
				if($play+1 == $count){echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-right.svg', 21, 21, 'gray'); 
				echo "</a></li>"; 
				
				echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-double-right.svg', 21, 21, 'gray');
				echo "</a></li>";}
				
				else{echo "<li class='page-item'><a class='page-link' href='?play=".($play+1)."&order_que=$order_que&order=$order&".$var."'>";
				 svg('svgadmin/angle-right.svg', 21, 21, '#e5627e'); 
				echo "</a></li>";  

				echo "<li class='page-item'><a class='page-link' href='?play=".($count-1)."&order_que=$order_que&order=$order&".$var."'>";
				 svg('svgadmin/angle-double-right.svg', 21, 21, '#e5627e');
				echo "</a></li>";}
				echo "</ul>"; 
			} 
			else
			{
				if ($cantidad != 1)
				{
					?>
                        <a class='btn modalButton' data-toggle='modal' data-width=100% data-target='#myModal_ordenar'><? svg('svgadmin/list-ol.svg', '20', '20', 'orange'); ?> Ordenar</a>
                        <!-- MODAL -->
                        <div class="modal fade" id="myModal_ordenar" tabindex="-1" role="dialog"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                        <!--            <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Top</h4>
                                    </div>
                        -->        <div class="modal-body" style="height:650px">
                                <iframe height='600px' width='100%' src="<? echo $path; ?>_admin/gestion/ordenar.php?apli_padre=<? echo str_replace('apli_', '', $from); ?>" frameborder="0"></iframe>
                                </div>
                                <div class="modal-footer">
                                <button type="button" onClick="javascript:window.location.reload()" class="btn btn_admin" data-dismiss="modal">Guardar</button>
                                </div>
                                </div>
                            </div>
                        </div>                    
					<?
				}
			}

			if($order_que == 'listorder'){ $order_que_mysql = 'listorder + 0'; } else { $order_que_mysql = $order_que; } 
			$query = "SELECT * FROM $from $where ORDER BY $order_que_mysql $order, id_$from DESC LIMIT ".($play*$paso).", ".$paso.";";
			$result = mysqli_query($cnx, $query);
			while( $row = mysqli_fetch_array($result)){ $rowp[] = $row; }
			
			mysqli_free_result($result);
			if(!empty($rowp)){ return array($rowp); }
	}
}

function paginador_extajax($select, $from, $where, $order_que, $order, $var, $paso = 10, $view = 1, $url, $id_div)
{
	global $path; 
	echo "<style> .pagination{ justify-content: center; }  </style>";
	global $cnx;
//	if(!empty($play_ajax)){ $play_ajax = $_GET['play_ajax']; } else { $play_ajax = 0; }
	if(!empty($_GET['play_ajax'])){ $play_ajax = $_GET['play_ajax']; } else { $play_ajax = 0; }
	if(!empty($_GET['order_que'])){ $order_que = $_GET['order_que']; } 
	if(!empty($_GET['order'])){ $order = $_GET['order']; }
	$result = mysqli_query($cnx, "SELECT * FROM $from $where");
	$cantidad = mysqli_num_rows($result);
	$count = ceil($cantidad/$paso);
	if ($cantidad>0) 
	{    
			$cantidad = mysqli_num_rows($result);
			$count = ceil($cantidad/$paso);
	
			if($cantidad > $paso) 
			{   
			?>     
                    <ul class='pagination pagination-primary pagination-sm' style="margin-top:10px">         
                <? 
				if($play_ajax == 0){echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-double-left.svg', 21, 21, 'gray');
				echo "</a></li>";	
				echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-left.svg', 21, 21, 'gray'); 
				echo "</a></li>";}
				else{echo "<li class='page-item'><a class='page-link' href=\"javascript:recibeid('".$url."', 'play_ajax=0&order_que=".$order_que."&order=".$order."&".$var."', '', '".$id_div."')\">";
				 svg('svgadmin/angle-double-left.svg', 21, 21, '#e5627e');
				echo "</a></li>"; 
				echo "<li class='page-item'><a class='page-link' href=\"javascript:recibeid('".$url."', 'play_ajax=".($play_ajax-1)."&order_que=".$order_que."&order=".$order."&".$var."', '', '".$id_div."')\">";
				 svg('svgadmin/angle-left.svg', 21, 21, '#e5627e');
				echo "</a></li>";}

				$a = 0;
				$control = 0;
	
				if($play_ajax > 4)
				{
					$a = $play_ajax-4;
					if(($count - $play_ajax) <= 5){$a = $a-(5-($count-$play_ajax));if ($a < 0) {$control += $a; $a = 0;}}
					if ($count - $a > 10) {$control = $a + 10; } 
					else {$control = $count;}
				} 
				else {if ($count > 10) {$control = 10; }else {$control = $count;}}
			
				while($a < $control)
				{
					if($play_ajax == $a){ echo "<li class='page-item active'><a href='#' class='page-link bg-warning text-white'><b>".($a+1)."</b></a></li>"; }
					else{ echo "<li class='page-item'><a class='page-link d-none d-sm-block' href=\"javascript:recibeid('".$url."', 'play_ajax=".$a."&order_que=".$order_que."&order=".$order."&".$var."', '', '".$id_div."')\" >".($a+1)."</a></li>"; }
					$a++;
				}
				
				
				if($play_ajax+1 == $count){echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-right.svg', 21, 21, 'gray'); 
				echo "</a></li>"; 
				
				echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-double-right.svg', 21, 21, 'gray');
				echo "</a></li>";}
				
				else{echo "<li class='page-item'><a class='page-link' href=\"javascript:recibeid('".$url."', 'play_ajax=".($play_ajax+1)."&order_que=".$order_que."&order=".$order."&".$var."', '', '".$id_div."')\">";
				 svg('svgadmin/angle-right.svg', 21, 21, '#e5627e'); 
				echo "</a></li>"; 

				echo "<li class='page-item'><a class='page-link' href=\"javascript:recibeid('".$url."', 'play_ajax=".($count-1)."&order_que=".$order_que."&order=".$order."&".$var."', '', '".$id_div."')\">";
				 svg('svgadmin/angle-double-right.svg', 21, 21, '#e5627e');
				echo "</a></li>";}
				echo "</ul>";
			}
 
			$query = "SELECT * FROM $from $where ORDER BY $order_que DESC LIMIT ".($play_ajax*$paso).", ".$paso.";";
			$result = mysqli_query($cnx, $query);
			while( $row = mysqli_fetch_array($result)){ $rowp[] = $row; }
			
			mysqli_free_result($result);
			if(!empty($rowp)){ return array($rowp); }
	}
}
?>
<?
function paginador_ext($select, $from, $where, $order_que, $order, $var, $paso = 10, $view = 1)
{
	global $path;
	echo "<style> .pagination{ justify-content: center; }  </style>";
	global $cnx, $order_que, $order, $play;
//	if(!empty($play)){ $play = $_GET['play']; } else { $play = 0; }
	if(!empty($_GET['play'])){ $play = $_GET['play']; } else { $play = 0; }
	if(!empty($_GET['order_que'])){ $order_que = $_GET['order_que']; }
	if(!empty($_GET['order'])){ $order = $_GET['order']; }
	$result = mysqli_query($cnx, "SELECT * FROM $from $where");
	$cantidad = mysqli_num_rows($result);
	$count = ceil($cantidad/$paso);
	
	if ($cantidad>0)
	{
			$cantidad = mysqli_num_rows($result);
			$count = ceil($cantidad/$paso);
	
			if($cantidad > $paso)
			{ 
			?>   
                    <ul class='pagination pagination-sm' style="margin-top:10px">         
                <?
				if($play == 0){echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-double-left.svg', 21, 21, 'gray');
				echo "</a></li>";	
				echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-left.svg', 21, 21, 'gray');
				echo "</a></li>";}
				else{echo "<li class='page-item'><a class='page-link' href='?play=0&order_que=$order_que&order=$order&".$var."'>";
				 svg('svgadmin/angle-double-left.svg', 21, 21, '#e5627e');
				echo "</a></li>"; 
				echo "<li class='page-item'><a class='page-link' href='?play=".($play-1)."&order_que=$order_que&order=$order&".$var."'>";
				 svg('svgadmin/angle-left.svg', 21, 21, '#e5627e');
				echo "</a></li>";}

				$a = 0;
				$control = 0;
	
				if($play > 4)
				{
					$a = $play-4;
					if(($count - $play) <= 5){$a = $a-(5-($count-$play));if ($a < 0) {$control += $a;$a = 0;}}
					if ($count - $a > 10) {$control = $a + 10; } 
					else {$control = $count;}
				} 
				else {if ($count > 10) {$control = 10; }else {$control = $count;}}
			
				while($a < $control)
				{
					if($play == $a){ echo "<li class='page-item active'><a href='#' class='page-link bg-warning text-white'><b>".($a+1)."</b></a></li>"; }
					else{ echo "<li class='page-item'><a class='page-link d-none d-sm-block' href='?play=".$a."&order_que=$order_que&order=$order&".$var."'>".($a+1)."</a></li>"; }
					$a++;
				}
				
				
				if($play+1 == $count){echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-right.svg', 21, 21, 'gray'); 
				echo "</a></li>"; 
				
				echo "<li class='page-item disabled'><a class='page-link' href='#'>";
				 svg('svgadmin/angle-double-right.svg', 21, 21, 'gray');
				echo "</a></li>";}
				
				else{echo "<li class='page-item'><a class='page-link' href='?play=".($play+1)."&order_que=$order_que&order=$order&".$var."'>";
				 svg('svgadmin/angle-right.svg', 21, 21, '#e5627e'); 
				echo "</a></li>"; 

				echo "<li class='page-item'><a class='page-link' href='?play=".($count-1)."&order_que=$order_que&order=$order&".$var."'>";
				 svg('svgadmin/angle-double-right.svg', 21, 21, '#e5627e');
				echo "</a></li>";}
				echo "</ul>";
			}

			$query = "SELECT * FROM $from $where ORDER BY $order_que DESC LIMIT ".($play*$paso).", ".$paso.";";
			$result = mysqli_query($cnx, $query);
			while( $row = mysqli_fetch_array($result)){ $rowp[] = $row; }
			
			mysqli_free_result($result);
			if(!empty($rowp)){ return array($rowp); }
	}
}  
?>