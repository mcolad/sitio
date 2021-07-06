<? $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?PHP $include = "../_admin/header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
</head>
<body>
        <div class="row">
             <div class="col-lg-12">
                <table class="table table-striped">
                  <tbody>
                    <?
						$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']);
						$row = mysqli_fetch_array($result);
							$result_column = mysqli_query($cnx, "SHOW COLUMNS FROM apli_".$_GET['apli']);
							echo "<tr>";
							while($row_column = mysqli_fetch_array($result_column))
							{
								
								echo "<td style='cursor:help' scope='row' title='".$row_column['Type']."'>".$row_column['Field']."</td>";
							} 
							echo "</tr>";
						while($row = mysqli_fetch_array($result))
						{
							echo "<tr>";
							$result_column = mysqli_query($cnx, "SHOW COLUMNS FROM apli_".$_GET['apli']);
							while($row_column = mysqli_fetch_array($result_column))
							{
								echo "<td><div style='float:left; word-wrap:break-word;'><code>".htmlspecialchars($row[$row_column['Field']])."</code></div></td>";
							} 
							echo "</tr>";
						} 

                    ?>
                  </tbody> 
                </table> 
              </div> 
           </div>
</body>