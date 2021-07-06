<? $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?PHP $include = "../_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
</head>
<body>
    <div class="container">
        <div class="row">
             <div class="col-lg-12">
                <table class="table table-striped">
                  <tbody>
                    <?
						$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE id_apli_".$_GET['apli']." = '".$_GET['id']."' LIMIT 1");
						$row = mysqli_fetch_array($result);
						$result_column = mysqli_query($cnx, "SHOW COLUMNS FROM apli_".$_GET['apli']);
						while($row_column = mysqli_fetch_array($result_column))
						{
							echo "<tr>
							<th style='cursor:help' scope='row' title='".$row_column['Type']."'>".$row_column['Field']."</th>
							<td id='div_".$row_column['Field']."'>
							<div style='float:left; word-wrap:break-word;'><code>".htmlspecialchars($row[$row_column['Field']])."</code></div>
							<div style='float:right;'><a style='cursor:pointer; align:left' onClick=\"recibeid('ver_edit.php', 'valor=".$row[$row_column['Field']]."&Field=".$row_column['Field']."&apli=".$_GET['apli']."&id=".$_GET['id']."', '', 'div_".$row_column['Field']."');\">";
							svg('svgadmin/pen.svg', '12', '12', '#E83E8C');
							echo "</a></div></td></tr>";
						} 
                    ?>
                  </tbody> 
                </table> 
              </div> 
           </div>
    </div>
</body>