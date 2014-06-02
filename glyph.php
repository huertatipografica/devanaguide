<?php
header("Content-type: text/html; charset=utf-8"); // UTF 8
include('_functions.php');
include('fonts_list.php');

$nombre = $_GET['nombre'];
$glifo = $signo[$nombre];
$char = uni($glifo['char']);
	
foreach ($fuentes as $fuente){
	$nombre_fuente=substr($fuente, 0, -4);
	$thumbsBig.='<div class="thumbBig" style="font-family:'.$nombre_fuente.'">'.$char.'<label>'.$nombre_fuente.'</label></div>'."\n";
	$thumbsWord.='<div class="thumbWord" style="font-family:'.$nombre_fuente.'">'.$char.'Hamburge'.$char.'vontpids0123<label>'.$nombre_fuente.'</label></div>'."\n";
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="author" content="Deva">
<title>Devanaguide- <? echo $glifo['nombre']?></title>
<style>
<? echo $css?>
</style>
<link type="text/css" href="css/estilos.css" rel="stylesheet" charset="utf-8">
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
			
			<div class="thumbs">
				<? echo $thumbsWord ?>
			</div>
			
			<h2>Words containing <? echo $glifo['nombre'] ?></h2>
			<p><? echo 'Mostrando 100 de '.count($wordlist).' palabras encontradas. ('.count($words).' total)'?></p>

			<select id="preview_font" onchange="setfont();">
				<option value="">Default</option>
				<? 
				foreach ($fuentes as $fuente) {
					$nombre_fuente=substr($fuente, 0, -4);
					echo '<option value="'.$nombre_fuente.'">'.$nombre_fuente.'</option>';
				}
				?>
			</select>
			
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
</script>		
</body>
</html>