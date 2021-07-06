<?
function limita_palabras($texto, $palabras = 20, $puntos = "...")
{
    $articulo = explode(' ', $texto);
    if (count($articulo) > $palabras)
    {
            return implode(' ', array_slice($articulo, 0, $palabras)) ." ". $puntos;
    }
    else
    {
            return $texto;
    }
}
function limita_caracteres($texto, $caracteres = 50, $puntos = "...")
{
    if (strlen($texto) > $caracteres)
    {
		   $articulo = substr($texto, 0, $caracteres);
		   $articulo = strrev($articulo);
		   $articulo = strstr($articulo, ' ');
		   $articulo = strrev($articulo);
             return $articulo. $puntos;
    }
    else
    {
            return $texto;
    }
}

?>