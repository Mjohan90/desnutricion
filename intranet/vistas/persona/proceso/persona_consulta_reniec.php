<?php
	require 'simple_html_dom.php';
	
	$pers_dni = $_POST['pers_dni'];
	
	// OBTENEMOS EL VALOR
	// $consulta = file_get_html('http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI='.$dni)->plaintext;
	$html = file_get_html('https://eldni.com/buscar-por-dni?dni='.$pers_dni);
	
	$pers_data = [];
	foreach ($html->find('td') as $dato) {
		$pers_data[] = $dato->plaintext;
	}
	
	// LA LOGICA DE LA PAGINAS ES: NOMBRES | APELLIDO PATERNO | APELLIDO MATERNO
	$datos = [
		'pers_dni'        => $pers_dni,
		'pers_nombres'    => $pers_data[0],
		'pers_ap_paterno' => $pers_data[1],
		'pers_ap_materno' => $pers_data[2]
	];
	
	echo json_encode($datos);