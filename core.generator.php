<?php 

include 'conexion.php';
switch ($_POST['act']) {
	case 'c':
		$id = $_POST['vidTab'];
		ObtenerCamposTablaGet($id);
	break;
	case 'g':
		limpia_directorio();
		$ids = $_POST['vidTab'];
		if ( is_array($ids) ) {
			GenerarMultiplesClases($ids);
			echo "2";
		}else{
			GenerarClase($ids);
			echo "1";			
		}
	break;
}

function limpia_directorio(){
	include 'config.ini';
	$dir = $config['ruta'] .'/';
	$handle = opendir($dir);
	while ($file = readdir($handle))
	{
	   if(!is_dir("$handle/$file"))
	   {
	   	if($file != "." && $file != ".." ){ 
	       unlink($dir.$file);
	   	}
	   }
	}	
}

function GenerarZipFiles(){
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
}

function GenerarMultiplesClases( $array_tablas ){
	for( $i=0;$i< count($array_tablas) ; $i++){
		GenerarClase( $array_tablas[ $i ] );
	}
}

function print_p($expression){
	print("<pre>".print_r($expression,true)."</pre>");			
}
function GenerarClase($nIdTab){
	$db = new Db();
	$idTabla = $nIdTab;
	$tsqlT = "SELECT name as [nameTab] FROM sys.tables WHERE object_id=".$idTabla." and name <> 'sysdiagrams' order by name ASC ";
	$tabla = $db->consulta_simple($tsqlT);	
	$tableName = $tabla[0]['nameTab'];
	$tsql   = "select  name as atributo from sys.columns where object_id = ".$idTabla."";	
	$result = $db->consulta_simple($tsql);
	// Encabezado - Clase
	$tableName = ucwords(strtolower($tableName));
	$clase = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');\r\n
/*Autogenered Developed by @jvinceso*/\r\n/* Date : ".date('d-m-Y H:i:s')." */\n
Class ".$tableName."_model extends CI_Model {\n\n";
	$campos;
	foreach ($result as $fila) {
		$clase .= "	private $".$fila["atributo"]." = '';\n";
		$campos[]= $fila["atributo"];
	}
	$clase.="\n	//Constructor ".$tableName."_model
	function __construct(){\n		parent::__construct();\n	}\r\n";
	$clase.="\r\n/*	FUNCIONES SETTER*/\n";
	foreach ($campos as $indice => $valor) {
		$clase.= "	public function set_".$valor."($".$valor."){\n		".'$this->'.$valor.' = $'.$valor.';'."\n	}\n";
	}
	$clase.="\r\n/*	FUNCIONES GETTER*/\n";
	foreach ($campos as $indice => $valor) {
		$clase.= "	public function get_".$valor."($".$valor."){\n		".'return $this->'.$valor.';'."\n	}\n";

	}
	$clase .="	/*Aqui Va la logica de Tu Modelo*/\n\r\n";
	$clase.= GenerarGetObject($tableName,$campos);
	$clase.= GenerarInserts($tableName,$campos);
	$clase.= GenerarSelects($tableName,$campos);
	$clase.= GenerarUpdates($tableName,$campos);
	$clase.= GenerarDeletes($tableName,$campos);
	$clase .="}\n";//Fin de la Clase
	$clase .="/* End of file ".$tableName."_model".".php */\n/* Location: ./application/models/~/".$tableName."_model.php */\n";
	// print_p($campos);
	// file_put_contents('result/'.strtolower($tabla[0]['nameTab']).'_model.php', $clase, FILE_APPEND |LOCK_EX);
	file_put_contents('result/'.strtolower($tabla[0]['nameTab']).'_model.php', $clase, LOCK_EX);
	// echo '1';
}

function ObtenerCamposTablaGet($nIdTab){
	$db = new Db();
	// var_dump($db);
	$idTabla = $nIdTab;
	$tsql = "select  name as atributo from sys.columns where object_id = ".$idTabla."";
	$result = $db->consulta_simple($tsql);
	$html = '<ul>';
	foreach ($result as $fila) {
		$html .= '<li>'.$fila["atributo"].'</li>';
	}
	$html .='</ul>';
	echo $html;
}
/*Siguiendo Estandar CRUD -> Create Read Update Delete*/
function GenerarInserts($NombreTabla,$parametros){

	$ins= "	/* Funcion Insertar */\n";
	$ins.= "	public function ".strtolower( $NombreTabla )."Ins(){\n";
	$ins.= '		$this->adampt->Liberar();'."\n";
	foreach ($parametros as $indice => $valor) {
		$ins.='		$this->adampt->setParam( '.'$this->get_'.$valor.'() );'."\n";
	}	
	$ins .='		$query = $this->adampt->consulta("USP_XXX_I_'.$NombreTabla.'");'."\n";
	$ins .='		if( count($result) > 0){'."\n";
	$ins .='			return $result;'."\n";
	$ins .='		}else{'."\n";
	$ins .='			return null;'."\n";
	$ins .='		}'."\n";
	$ins .="	}\n\n";
	return $ins;
}
function GenerarGetObject($NombreTabla,$parametros){

	$get= "\n	/* Funcion Get Object ".$NombreTabla." */\n";
	$get.= "	public function ".strtolower( $NombreTabla )."Get(){\n";
	$get.= '		$this->adampt->Liberar();'."\n";
	foreach ($parametros as $indice => $valor) {
		if( $indice == 0 ){
			$get.='		$this->adampt->setParam( '.'$this->get_'.$valor.'() );'."\n";
		}
	}	
	$get .='		$query = $this->adampt->consulta("USP_XXX_G_'.$NombreTabla.'");'."\n";
	$get .='		if( count($result) > 0){'."\n";
	foreach ($parametros as $indice => $valor) {
			$get.='			$this->set_'.$valor.'( $query["'.$valor.'"] );'."\n";
	}	
	$get .='		}else{'."\n";
	$get .='			return null;'."\n";
	$get .='		}'."\n";
	$get .="	}\n\n";
	return $get;
}
function GenerarSelects($NombreTabla,$parametros){

	$sel= "	/* Funcion Select */\n";
	$sel.= "	public function ".strtolower( $NombreTabla )."Qry(){\n";
	$sel.= '		$this->adampt->Liberar();'."\n";
	foreach ($parametros as $indice => $valor) {
		$sel.='		$this->adampt->setParam( '.'$this->get_'.$valor.'() );'."\n";
	}	
	$sel .='		$query = $this->adampt->consulta("USP_XXX_S_'.$NombreTabla.'");'."\n";
	$sel .='		if( count($result) > 0){'."\n";
	$sel .='			return $result;'."\n";
	$sel .='		}else{'."\n";
	$sel .='			return null;'."\n";
	$sel .='		}'."\n";
	$sel .="	}\n\n";
	return $sel;
}

function GenerarDeletes($NombreTabla,$parametros){

	$del= "	/* Funcion Delete */\n";
	$del.= "	public function ".strtolower( $NombreTabla )."Del(){\n";
	$del.= '		$this->adampt->Liberar();'."\n";
	foreach ($parametros as $indice => $valor) {
		$del .='		$this->adampt->setParam( '.'$this->get_'.$valor.'() );'."\n";
	}	
	$del .='		$this->adampt->setParamOut1();'."\n";
	$del .='		$this->adampt->prepara("USP_XXX_D_'.$NombreTabla.'");'."\n";
	$del .='		$this->adampt->ejecuta();'."\n";
	$del .='		if( $this->adampt->getParamOut1()=="1" ){'."\n";
	$del .='			return true;'."\n";
	$del .='		}else{'."\n";
	$del .='			return false;'."\n";
	$del .='		}'."\n";
	$del .="	}\n\n";
	return $del;

}
function GenerarUpdates($NombreTabla,$parametros){

	$upd= "	/* Funcion Update */\n";
	$upd.= "	public function ".strtolower( $NombreTabla )."Upd(){\n";
	$upd.= '		$this->adampt->Liberar();'."\n";
	foreach ($parametros as $indice => $valor) {
		$upd .='		$this->adampt->setParam( '.'$this->get_'.$valor.'() );'."\n";
	}	
	$upd .='		$this->adampt->setParamOut1();'."\n";
	$upd .='		$this->adampt->prepara("USP_XXX_U_'.$NombreTabla.'");'."\n";
	$upd .='		$this->adampt->ejecuta();'."\n";
	$upd .='		if( $this->adampt->getParamOut1()=="1" ){'."\n";
	$upd .='			return true;'."\n";
	$upd .='		}else{'."\n";
	$upd .='			return false;'."\n";
	$upd .='		}'."\n";
	$upd .="	}\n\n";
	return $upd;

}
?>