<?
$fh = fopen('signos.txt','r');
$i=0;
while ($line = fgets($fh)) {
  $values=explode("|", $line);
  $char=$values[0];
  $nombre=$values[1];
  $categoria=$values[2];
  $subcategoria=$values[3];
  $descripcion=$values[4];
  $signo[$nombre]=array('char'=>$char,'nombre'=>$nombre,'categoria'=>$categoria,'subcategoria'=>$subcategoria,'descripcion'=>$descripcion);
  $i++;
}
fclose($fh);


function uni($value){
	if($value=='None'){
		$output='_';
	} else {
	$unicode='\u'.$value;
	$output=json_decode('"'.$unicode.'"');
	}
	return $output;
}

function multiexplode ($delimiters,$string) {
    
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

?>