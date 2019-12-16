<?php
	// proceso:
	include_once '../../../entidades/triaje.php';
	include_once '../../../datos/triajeDAL.php';
	
	$atenc_id    = IssetOr($_POST['atenc_id'], 0);
	$triaje_prod = $_SESSION['triaje.var'];
	
	$triaje_list = [];
	foreach ($triaje_prod as $det) {
		$triaje            = new triaje();
		$triaje->triaje_id = 0; // DAL
		$triaje->atenc_id  = $atenc_id; // DAL
		$triaje->var_id    = $det['var_id'];
		$triaje->um_id     = $det['triaje_um_id'];
		$triaje->valor     = $det['triaje_valor'];
		$triaje->fecha_reg = $det['triaje_fecha_reg'];
		$triaje->estado    = $det['triaje_estado'];
		$triaje_list[]     = $triaje;
	}
	
	
	
