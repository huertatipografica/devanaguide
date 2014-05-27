<?php include('_functions.php');
include('fonts_list.php');
$nombre=$_GET['nombre'];
$glifo=$signo[$nombre];
$char=uni($glifo['char']);
	
#$fonts=array('FreeSans','FreeSerif','EkMukta','Fedra','KunKun','Lohit','NotoSans','Saral','Devanagari Sangam MN','Adobe Devanagari','Arial');
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
#foreach($wordlist as $word){
#	$textoPrueba.=$word.' ';
#}
?>

<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="author" content="Deva">
<title>Devanaguide- <? echo $glifo['nombre']?></title>
<link type="text/css" href="css/estilos.css" rel="stylesheet" charset="utf-8">
<style>
<? echo $css?>
</style>
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

<h2>Ejemplos de <? echo $glifo['nombre'] ?></h2>
<div class="thumbs">

	<? echo $thumbsBig ?>
</div>
<div class="thumbs">
	<? echo $thumbsWord ?>
</div>
<h2>Palabras</h2>
<p><? echo 'Mostrando 100 de '.count($wordlist).' palabras encontradas. ('.count($words).' total)'?></p>
<div class="contexto">
<? echo $textoPrueba?>
</div>
</div>
</div>
</body>