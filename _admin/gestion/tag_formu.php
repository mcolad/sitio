<?PHP $no_registro = 1; $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include);  ?>
<?
if(!empty($_GET['tag']))
{
	$id_apli_tagdetag = $_GET['id_apli_tagdetag']; 

	$result_tagdetag = mysqli_query($cnx, "SELECT * FROM apli_TAGDETAG WHERE id_apli_tagdetag = '".$id_apli_tagdetag."';");
	$row_tagdetag = mysqli_fetch_array($result_tagdetag);

	$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE (id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli']."')");
	$row = mysqli_fetch_array($result);
	
	if(!empty($_GET['elimina']))
	{
		mysqli_query($cnx, "UPDATE apli_".$_GET['apli']." SET `".$_GET['id_apli_tagdetag']."` = '".str_replace($_GET['id_apli_tag'].";", '', $row[$_GET['id_apli_tagdetag']])."' WHERE id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli']."';");
	}
	if(!empty($_GET['agrega']))
	{

		if($row_tagdetag['unico'] == 1)
		{
			$result_tags = mysqli_query($cnx, "SELECT * FROM apli_TAG WHERE id_apli_tagdetag = '".$row_tagdetag['id_apli_tagdetag'].";';");
			while($row_tags = mysqli_fetch_array($result_tags))
			{
				$row['id_apli_tag'] = str_replace($row_tags['id_apli_tag'].';', '', $row['id_apli_tag']); 
			} 

		} 
		$insert_id_apli_tagdetag = $row['id_apli_tag'].$_GET['id_apli_tag'];
		mysqli_query($cnx, "UPDATE apli_".$_GET['apli']." SET `".$_GET['id_apli_tagdetag']."` = '".$insert_id_apli_tagdetag.";' WHERE id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli']."';");
	}
	
	$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE (id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli']."')");
	$row = mysqli_fetch_array($result);
	
	tag_formu($id_apli_tagdetag, $_GET['apli'], $_GET['id_apli'], $_GET['id_apli_tag']);
}
/*if(!empty($_GET['tagdeaplis']))
{
	$result = mysqli_query($cnx, "SELECT * FROM apli_APLIS WHERE (id_apli_aplis = '".$_GET['id_apli_aplis']."')");
	$row = mysqli_fetch_array($result);
	if($_GET['tagdeaplis'] == 'agrega')
	{	
		mysqli_query($cnx, "UPDATE apli_APLIS SET id_apli_tagdetag = '".$row['id_apli_tagdetag'].$_GET['id_apli_tagdetag'].";' WHERE id_apli_aplis = '".$_GET['id_apli_aplis']."';");
	}
	elseif($_GET['tagdeaplis'] == 'elimina')
	{
		$sql = "UPDATE apli_APLIS SET id_apli_tagdetag = '".str_replace($_GET['id_apli_tagdetag'].";", '', $row['id_apli_tagdetag'])."' WHERE id_apli_aplis = '".$_GET['id_apli_aplis']."';";
		mysqli_query($cnx, $sql);
	}
	$result = mysqli_query($cnx, "SELECT * FROM apli_".$_GET['apli']." WHERE (id_apli_".strtolower($_GET['apli'])." = '".$_GET['id_apli_'.strtolower($_GET['apli'])]."')");
	$row = mysqli_fetch_array($result);
	tagdeaplis_formu($_GET['apli'], $_GET["id_apli_".strtolower($_GET['apli'])]);
}
*/?>