<?
$dir=['fonts/otras', 'fonts'];
$fuentes=array();

#lista de fuentes
foreach ($dir as $dir) {
    if ($handle = opendir($dir)) {

        /* This is the correct way to loop over the directory. */
        while (false !== ($entry = readdir($handle))) {
        #solo si son otf o ttf
            if(strpos($entry,".otf") or strpos($entry,".ttf")){
                array_push($fuentes, $entry);
            }

        }
        closedir($handle);
    }
}


// echo '<pre>';
// print_r($fuentes);
// echo '</pre>';

natsort($fuentes);
foreach($fuentes as $fuente){
	$css.="@font-face {
        font-family: '".substr($fuente, 0, -4)."';
        src: url('/fonts/$fuente');
        font-weight: normal;
        font-style: normal;
    }\n";
};

?>
