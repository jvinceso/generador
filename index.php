<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<!-- CSS -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="chosen/chosen.css" />
	<!-- JS -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script> -->
  <script src="js/jquery-1.8.1.min.js" type="text/javascript"></script>
  <script src="chosen/chosen.jquery.js" type="text/javascript"></script>

	<title>Generador de Clases CI</title>
</head>
<body>
	<h1>JVGenerator</h1>
	<p id="sub-name" >Un Mega generador de clases para <span class="naranja" >codeigniter</span> pruebalo ya!!! by <span class="naranja">@jvinceso</span> </p>
	<div id="tablas">
		<?php  
		include 'conexion.php';
		$db = new Db();
		$tsql = "SELECT name as [nameTab],object_id as [cod] FROM sys.tables WHERE name <> 'sysdiagrams' order by name ASC";
		$result = $db->consulta_simple($tsql);
		?>
		<label for="cboTablas"> Selecciones Tabla </label>
		<!-- <select data-placeholder="Seleccione una tabla" name="cboTablas" id="cboTablas" class="chzn-select" > -->
		<select data-placeholder="Seleccione una tabla"  name="cboTablas" id="cboTablas" multiple class="chzn-select" >
		<?php
			foreach ($result as $fila) {
				echo '<option value="'. $fila["cod"] .'">'.$fila["nameTab"].'</option>';
			}
		?>
		</select>
		<button id="btnGenerarClases" class="btn" > Go go go!!!!</button>
	</div>
	<hr>
	<br>
		<div id="log" class="hidden"></div>
		<fieldset class="hidden">
			<legend>Campos de Tabla</legend>
			<div id="CamposTabla" >
				<ul>
					<li>nTablaCampo</li>
					<li>nTablaCampo</li>
					<li>nTablaCampo</li>
				</ul>
			</div>
		</fieldset>
	</div>
  	<script src="js/core.generator.js" type="text/javascript"></script>
</body>
</html>