<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP $include = "header.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titulo</th>
    </tr>
  </thead>
  <tbody>	
<?
$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE id_apli_tag LIKE '%".$_GET['filtro_tag']."%' ORDER BY titulo ASC;");
$a = 0;
while($row = mysqli_fetch_array($result))
{ 
// SI HAY DATOS EN APLI HIJOS --->
//	$result_sub = mysqli_query($cnx, "SELECT * FROM apli_01_sa WHERE id_apli_padre = ".$row['id_apli_asfi']." LIMIT 1;");
//	$row_sub = mysqli_fetch_array($result_sub);
	echo "<tr><th scope='row'>".++$a."</th>";
	echo "<td>".$row['titulo']."</td>";
  echo "</tr>";
}
?>
  </tbody>
</table>