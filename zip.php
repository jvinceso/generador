<?php 
include 'config.ini';
include ("zipfile.php");
$zipfile = new zipfile();
$ubicacion = $config['ruta'];
$directorio = opendir($ubicacion); 
while ($archivo = readdir($directorio)) { 
	if(!is_dir("$ubicacion/$archivo")){ 
		$zipfile->add_file( implode( "",file("$ubicacion/$archivo") ) , $archivo); 
	}else{ 
		      	//Aun por Implementar recursividad
	} 
} 
header("Content-type: application/octet-stream");
header("Content-disposition: attachment; filename=clases_ci.zip");
echo $zipfile->file(); 
?>