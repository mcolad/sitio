<?PHP  $include = "config.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>
<?PHP  
// array('edit' => 'noedit'); No muestra al editar
// array('insert' => 'noinsert'); No insert
// array('disabled' => 'disabled'); Muestra pero no se puede modificar
$exepciones['id_apli_'.strtolower($apli)] = array('edit' => 'noedit', 'insert' => 'noinsert');
$exepciones['listorder'] = array('edit' => 'noedit', 'insert' => 'noinsert');
$exepciones['fecha'] = array('edit' => 'noedit', 'insert' => 'noinsert');
$exepciones['id_apli_tag'] = array('edit' => 'noedit', 'insert' => 'noinsert');
$exepciones['img_destacado'] = array('edit' => 'noedit', 'insert' => 'noinsert');
$exepciones['pdf_destacado'] = array('edit' => 'noedit', 'insert' => 'noinsert');
$exepciones['zip_destacado'] = array('edit' => 'noedit', 'insert' => 'noinsert');
$exepciones['usuario'] = array('edit' => 'noedit', 'insert' => 'noinsert');
$exepciones['estado'] = array('edit' => 'noedit', 'insert' => 'noinsert');

$exepciones['pass'] = array('disabled' => 'disabled', 'insert' => 'noinsert');
$exepciones['titulo'] = array('disabled' => 'disabled', 'insert' => 'noinsert');
$exepciones['nick'] = array('disabled' => 'disabled', 'insert' => 'noinsert');

$include = "../_admin/aple_index.php"; $i = 0; while ((!file_exists($include) XOR $i == 20)){$include = "../".$include; $i++; } include_once($include); ?>