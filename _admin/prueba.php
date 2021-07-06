<?

$exepciones['usuario'] = array('z' => 'zz');
$exepciones['usuario'] = array_merge($exepciones['usuario'], array('x' => 'xx', 'y' => 'yy'));

$exepciones['usuario']['edit'] = 'edit';


print_r($exepciones);
//foreach($exepciones as $key => $dato){   echo $key.$dato[0].$dato[1].$dato[2]."<br>"; }
//echo $exepciones['titulo']['edit'];

?> 