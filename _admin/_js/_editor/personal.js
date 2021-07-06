var elEditor;	// declaración necesaria para el funcionamiento de la librería editor.js

// simple ejemplo de inserción dentro de un textarea

function parrafar(estilo)	{
	_insertar(elEditor, '<' + estilo + '>' + _lector() + '</' + estilo + '>');
}

function formatear(boton, estilo)	{
	boton.style.borderStyle = "inset";
	_seleccion = _lector();
	_resultado = prompt(estilo + ":", _seleccion);
	if (_resultado == null)
		_insertar(elEditor, _seleccion);
	else
		_insertar(elEditor, '<' + estilo + '>' + _resultado + '</' + estilo + '>');
	boton.style.borderStyle = "outset";
}

function insertarAsterisco()	{
	_insertar(elEditor, "*");
}

function entrecomillar()	{
	_insertar(elEditor, '"' + prompt("entrecomillar", _lector()) + '"');
}

function uri()	{
	var enlace = prompt("Introduzca la URL:", "http://");
	_insertar(elEditor, '<a href="' + enlace + '">' + prompt("enlace:", _lector()) + '</a>');
}

function ponerEmoticon(cual)	{
	_insertar(elEditor, cual);
}

var emotis = [
	"[:)]",
	"[:(]",
	"[:x]",
	"[BIEN]",
	"[MAL]",
	"[SI]",
	"[NO]",
	"[APLAUSOS]",
	"[MEJORABLE]",
	"[¡A VER!]",
	"[¡DÉJAME PENSAR!]",
	"[FLIPE]",
	"[¡SIN PALABRAS!]"
];

var fichs = [
	"../emotis/00.gif",
	"../emotis/01.gif",
	"../emotis/02.gif",
	"../emotis/03.gif",
	"../emotis/04.gif",
	"../emotis/05.gif",
	"../emotis/06.gif",
	"../emotis/07.gif",
	"../emotis/08.gif",
	"../emotis/09.gif",
	"../emotis/10.gif",
	"../emotis/11.gif",
	"../emotis/12.gif"
];

var descformatos = ["b", "i", "u", "a"];
var resulformatos = ["font-weight: bold", "font-style: oblique", "text-decoration: underline"];
var descparrafos = ["izquierdo", "derecho", "centrado", "justificado"];
var resulparrafos = ["left", "right", "center", "justify"];

function prever()	{
	document.getElementById("resultado").innerHTML = procesamiento(elEditor.value);
}

function procesamiento(texto)	{
	for (var i = 0; i < emotis.length; i ++)
		texto = texto.split(emotis[i]).join("<img src='" + fichs[i] + "' />");
	if (texto.split("<a href=").length > 1)
		texto = texto.split("<a href=").join("<a href=").split("</a>").join("</a>").split(">").join(" >");
	for (var i = 0, total = descformatos.length; i < total; i ++)
		texto = texto.split("<" + descformatos[i] + ">").join("<span style='" + resulformatos[i] + "' >").split("[/" + descformatos[i] + "]").join("</span>");
	for (var i = 0, total = descparrafos.length; i < total; i ++)
		texto = texto.split("<" + descparrafos[i] + ">").join("<p style='text-align:" + resulparrafos[i] + "' >").split("[/" + descparrafos[i] + "]").join("</p>");

	return texto;
}

