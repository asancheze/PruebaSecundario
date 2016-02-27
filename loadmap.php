<?php
//"C:\Users\HP\Desktop\Por Ubicar\coordenadas.txt"

$file = fopen("coordenadas.txt","r") or die ("Error al leer el archivo.");
$cadena = "";
while (!feof($file)) {
	$texto=fgets($file);
	$textoS=nl2br($texto);
	$cadena = $cadena . $texto . ';';
	
}
echo $cadena;
?>