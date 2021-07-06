<?PHP $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>
<?
if(!empty($_GET['tag']))
{

	$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE (id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli']."')");
	$row = mysqli_fetch_array($result);
	
	$array_id_apli_tagdetag = array ($_GET['id_apli_tagdetag']);
	if(!empty($_GET['elimina']))
	{
		mysqli_query($cnx, "UPDATE apli_".$_GET['apli']." SET id_apli_tag = '".str_replace($_GET['id_apli_tag'].";", '', $row['id_apli_tag'])."' WHERE id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli']."';");
	}
	if(!empty($_GET['agrega']))
	{
		mysqli_query($cnx, "UPDATE apli_".$_GET['apli']." SET id_apli_tag = '".$row['id_apli_tag'].$_GET['id_apli_tag'].";' WHERE id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli']."';");
	}
	
	$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE (id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli']."')");
	$row = mysqli_fetch_array($result);
	
	tag($array_id_apli_tagdetag, $_GET['apli'], $_GET['id_apli'], $_GET['id_apli_tag']);
}
if(!empty($_GET['tagdeaplis']))
{
	$result = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (id_apli_aplis = '".$_GET['id_apli_aplis']."')");
	$row = mysqli_fetch_array($result);
	if($_GET['tagdeaplis'] == 'agrega')
	{	
		mysqli_query($cnx, "UPDATE apli_APLIS SET id_apli_hijos = '".$row['id_apli_hijos'].$_GET['id_apli_tagdetag'].";' WHERE id_apli_aplis = '".$_GET['id_apli_aplis']."';");
	}
	elseif($_GET['tagdeaplis'] == 'elimina')
	{
		$sql = "UPDATE apli_APLIS SET id_apli_hijos = '".str_replace($_GET['id_apli_tagdetag'].";", '', $row['id_apli_hijos'])."' WHERE id_apli_aplis = '".$_GET['id_apli_aplis']."';";
		mysqli_query($cnx, $sql);
	}
	$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE (id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli_'.strtolower($_GET['apli'])]."')");
	$row = mysqli_fetch_array($result);
	tagdehijos($_GET['apli'], $_GET["id_apli_".strtolower($_GET['apli'])]);
}
?>