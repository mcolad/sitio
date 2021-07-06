<? $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?PHP $include = "../_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
</head>
<body>
    <div class="container" >
		<?
            $result = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE id_apli_".strtolower($_GET['apli'])." = '".$_GET['id']."' LIMIT 1");
            $row = mysqli_fetch_array($result);
            $result_column = mysqli_query($cnx, "SHOW FULL COLUMNS FROM apli_".$row['titulo']);

            while($row_column = mysqli_fetch_array($result_column))
            {
				$divid = md5($row_column['Field']);
                echo "<div id='".$divid."'>\n";

					echo "<div class='row'>\n";
					echo "<div class='col-5'><strong>".$row_column['Field']."</strong></div>\n";
					echo "<div class='col-4'><small>".$row_column['Type']."</small></div>\n";
					echo "<div class='col-1' style='padding:0px'>";
//					if($row_column['Field'] != 'titulo')
//					{
						echo "<button onclick=\"recibeid('sql_edit.php', 'divid=".$divid."&edita=1&apli_edit=".$row['titulo']."&field=".$row_column['Field']."', '', '".$divid."')\" class='btn btn-sm btn-success' />";
						svg('svgadmin/edit.svg', 15, 15, 'white');
						echo "</button>&nbsp;";
//					}
					echo "</div>\n";
					echo "<div class='col-1' style='padding:0px'>";
					if($row_column['Field'] != 'titulo')
					{
						echo "<button onclick=\"recibeid('sql_edit.php', 'divid=".$divid."&elimina=1&apli_edit=".$row['titulo']."&field=".$row_column['Field']."', '', '".$divid."')\" class='btn btn-sm btn-danger' title='Eliminar' />";
						svg('svgadmin/skull.svg', 15, 15, 'white');
						echo "</button>&nbsp;";
					}
					echo "</div>\n"; 
					echo "<div class='col-1' style='padding:0px'>";
						echo "<button onclick=\"recibeid('sql_edit.php', 'divid=".md5($divid)."&agrega=1&apli_edit=".$row['titulo']."&field=".$row_column['Field']."', '', '".md5($divid)."')\" class='btn btn-sm btn-primary' />";
						svg('svgadmin/plus.svg', 15, 15, 'white');
						echo "</button>";
					echo "</div>\n";
					echo "</div>\n";
					echo "<div class='row'>";
					echo "<div class='col-9'><small>".$row_column['Comment']."</small></div>";
					echo "</div>";

                echo "</div>\n";

                echo "<div class='mb-3' id='".md5($divid)."'></div>\n";
            }
        ?>

        <div class="col-12 text" style="background: #eee">
        	<small>
        		Referencias: 
        		Para tabular, poner al final /n donde n son las cantidad de columnas
        	</small>
       	</div>

    </div>

</body>