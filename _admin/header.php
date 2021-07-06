<html>
<head>
<link href="/<? echo $abs; ?>_admin/_img/favicon.png" rel="Shortcut Icon">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->

<!-- Bootstrap CSS CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
 
<link rel="stylesheet" href="/<? echo $abs; ?>_admin/_css/menu.css">

<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> -->

  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<!--  <link rel="shortcut icon" type="image/png" href="/catalogo_alimentos/img/ico.png">
  <link rel="apple-touch-icon" href="/catalogo_alimentos/img/ico.png">
  <link rel="apple-touch-startup-image" href="/catalogo_alimentos/img/ico.png">-->


<script src="/<? echo $abs; ?>_admin/_js/jquery-3.3.1.slim.min.js"></script>
<script src="/<? echo $abs; ?>_admin/_js/bootstrap.min.js"></script>
<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
-->

<script src="/<? echo $abs; ?>_admin/_js/gijgo.min.js" type="text/javascript"></script>
<link href="/<? echo $abs; ?>_admin/_css/gijgo.css" rel="stylesheet" type="text/css" />




<script type="text/javascript" src="/<? echo $abs; ?>_admin/_js/Ajax_Objetus.js"></script>

<script type="text/javascript" src="/<? echo $abs; ?>_admin/_js/highslide-with-html.js" ></script>
<link rel="stylesheet" href="/<? echo $abs; ?>_admin/_css/highslide.css" />

<!--ampliar imagen-->
<script type="text/javascript">
hs.graphicsDir = '<?PHP echo $path; ?>/_admin/_css/graphics/';
hs.outlineType = 'rounded-white';
hs.wrapperClassName = 'draggable-header';
</script>

<script type="text/javascript" src="<? echo $path."/_admin/_js/_editor/editor.js" ?>"></script>
<script type="text/javascript" src="<? echo $path."/_admin/_js/_editor/personal.js" ?>"></script>

<style>
sup {
    vertical-align: super;
    font-size: smaller;
    color:#ffc107;
    position:relative;
    top:1px;
}
</style>

<style>
/*.btn-success{ background-color: #A3CDAA}*/
.btn-success:disabled{ background-color: #DAE6D5}

/*.btn-warning{ background-color: #EBEDD1; color:#666}
.btn-warning:disabled{ background-color: #F5F3CF}
.bg-warning{ background-color: #EBEDD1; color:#666}
.bg-warning:disabled{ background-color: #F5F3CF}*/


.card {
	border-left:solid 5px #CED3DB;
}
.card:hover {
	border-left:solid 5px #2A4;
}
.border-fechapublicacion {
	border-bottom: solid 3px #E34  !important;
}

.bg-info {
    background-color: #678!important;
	border-color: #678!important;
    cursor: pointer;
}
.page-link {
    color: #333;
}
.tag {
 	width: initial;
	padding-top: 4px;
  	padding-bottom: 2px;
}
.tagdetag {
 	width: initial;
	padding-top: 4px;
  	padding-bottom: 2px;
}
.close {
	position:relative;
	top:-4px;
	}

a.close:hover
{
	color:#F00!important;
	
	}
/*.btn:hover {
    background-color: #3F4954;
}*/
label {
	margin-bottom:0px!important;
    margin-top: 1rem;
}
</style>

<style>
/*** 
	SWCHT de formularios
	Material Design Switches for Bootstrap 4 and Material Design Bootstrap (MDB)
	by djibe
	JSFiddle : https://jsfiddle.net/djibe89/9deak9dh/
***/

.material-switch > input[type="checkbox"] {display: none;}

.material-switch > label {
  cursor: pointer;
  height: 0px;
  position: relative;
  top: 2px;
  width: 40px;
}

.material-switch > label::before {
  background: #E34;
  box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
  border-radius: 8px;
  content: '';
  height: 16px;
  margin-top: -8px;
  position: absolute;
  opacity: 0.3;
  transition: all 0.4s ease-in-out;
  width: 40px;
}

.material-switch > label::after {
  background: rgb(255, 255, 255);
  border-radius: 16px;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
  content: '';
  height: 24px;
  left: -4px;
  margin-top: -8px;
  position: absolute;
  top: -4px;
  transition: all 0.3s ease-in-out;
  width: 24px;
}

.material-switch > input[type="checkbox"]:checked + label::before {
  background: #2A4;
  opacity: 0.5;
}

.material-switch > input[type="checkbox"]:checked + label::after {
 /* background: inherit;*/
  left: 20px;
}
</style>
</head>

