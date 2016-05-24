<?php
header("Content-type: text/html; charset=utf-8"); // UTF 8
include('_functions.php');
include('fonts_list.php');

$nombre = $_GET['nombre'];
$glifo = $signo[$nombre];
$char = uni($glifo['char']);
$fonts = array_merge($fuentes2, $fuentes);

foreach ($fonts as $fuente){
	$nombre_fuente=substr($fuente, 0, -4);
	$thumbsBig.='<div class="thumbBig" style="font-family:\''.$nombre_fuente.'\', AdobeBlank">'.$char.'<label>'.$nombre_fuente.'</label></div>'."\n";
	$thumbsWord.='<div class="thumbWord" style="font-family:\''.$nombre_fuente.'\', AdobeBlank">'.'<span class="dyntext">'.$char.'कagnv</span><label>'.$nombre_fuente.'</label></div>'."\n";
}

#abre diccionario
$fh = fopen('deva-dictionary.txt','r');
$wordlist=fgets($fh);
fclose($fh);

#arma array con palabras
$words=multiexplode(array(","), $wordlist);

#busca signo
$wordlist=array();
foreach($words as $word){
	$pos = strpos($word, $char);
	if ($pos == true) {
		array_push($wordlist, $word);
	}
}

#arma palabras aleatorias hasta 50
for($i=0;$i<100;$i++){
	$index=rand(0,(count($wordlist)-1));
	$textoPrueba.=$wordlist[$index].' ';
}

?>
<!DOCTYPE html>
<html>
<head>
<?php include 'meta.php'; ?>
<meta name="author" content="Deva">
<title>Devanaguide- <? echo $glifo['nombre']?></title>
<style>
<? echo $css?>
</style>
<link type="text/css" href="css/estilos.css" rel="stylesheet" charset="utf-8">
<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script>
$(function() {
    var fSizeArray = new Array('48', '72', '90', '100', '125', '150', '175', '200', '250', '300');
    $('#slider').slider({
        value: 4,
        min: 0,
        max: 9,
        step: 1,
        slide: function(event, ui) {
            var vfSizeArray = fSizeArray[ui.value];
            $('#font_size').val(vfSizeArray + ' px');
            $('.thumbWord').css('font-size', vfSizeArray + 'px' );
        }
    });
    $('#font_size').val((fSizeArray[$('#slider').slider('value')]) + ' px');
});
$(function() {
    var fSizeArray = new Array('18', '24', '36', '40', '50', '64', '72');
    $('#sliderb').slider({
        value: 4,
        min: 0,
        max: 6,
        step: 1,
        slide: function(event, ui) {
            var vfSizeArray = fSizeArray[ui.value];
            $('#font_sizeb').val(vfSizeArray + ' px');
            $('#contexto').css('font-size', vfSizeArray + 'px' );
        }
    });
    $('#font_sizeb').val((fSizeArray[$('#slider').slider('value')]) + ' px');
});
</script>
</head>

<body>

	<div id="left">
		<div class="container">

			<a href="index.php"><< Menu</a><br /><br />
			<table id="data" cellpading=0 cellspacing=0>
				<tr><th>Categoria</th><td><? echo $glifo['categoria']?></td></tr>
				<tr><th>Subcategoría</th><td><? echo $glifo['subcategoria']?></td></tr>
				<tr><th>Nombre</th><td><? echo $glifo['nombre']?></td></tr>
				<tr><th>Char</th><td><? echo uni($glifo['char'])?></td></tr>
				<tr><th>Unicode</th><td><? echo $glifo['char']?></td></tr>
			</table>
			<h3>Descripcion</h3>
			<? echo $glifo['descripcion']?>

		</div>
	</div>

	<div id="main">
		<div class="container">

			<h2><? echo $glifo['nombre'] ?></h2>

			<div class="thumbs">
				<? echo $thumbsBig ?>
			</div>

			<div id="inputtext">
				Change preview: <input id="slide" type="text" value="<? echo $char.'कagnv' ?>"
				onchange="updateText(this.value);" />
			</div>

			<div id="slider" style="width: 200px; display: inline-block; margin: 0 7px 7px 0;"></div>
			<input type="text" id="font_size" style="border:0; color:#222; font-weight:bold; vertical-align: top">

			<div class="thumbs">
				<? echo $thumbsWord ?>
			</div>

			<h2>Words containing <? echo $glifo['nombre'] ?></h2>
			<p><? echo 'Mostrando 100 de '.count($wordlist).' palabras encontradas. ('.count($words).' total)'?></p>

			<select id="preview_font" onchange="setfont();">
				<option value="">Default</option>
				<?
				foreach ($fonts as $fuente) {
					$nombre_fuente=substr($fuente, 0, -4);
					echo '<option value="\''.$nombre_fuente.'\',UnicodeFallback">'.$nombre_fuente.'</option>';
				}
				?>
			</select>

			<div id="sliderb" style="width: 200px; display: inline-block; margin: 0 7px 0; vertical-align: middle"></div>
			<input type="text" id="font_sizeb" style="border:0; color:#222; font-weight:bold;">

			<div class="contexto" id="contexto">
				<? echo $textoPrueba?>
			</div>

		</div>
	</div>

<script type="text/javascript">
	function setfont() {
		var e = document.getElementById("preview_font");
		var myfont = e.options[e.selectedIndex].value;

		var texto_ejemplo = document.querySelector('#contexto');
		texto_ejemplo.setAttribute("style","font-family: " + myfont);
	}
	// Text input for change texts
	function updateText(inputtext) {
		var tipos = document.getElementsByClassName('dyntext'),
		i = tipos.length;

		while(i--) {
			tipos[i].innerHTML =inputtext;
		}
	}
	// Drag boxes
	$(function() {
		$( ".thumbs" ).sortable();
		$( ".thumbs" ).disableSelection();
	});
</script>
</body>
</html>