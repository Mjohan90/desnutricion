<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal = new atencionDAL();
?>
<?php
	include_once '../../datos/pacienteDAL.php';
	$pac_dal = new pacienteDAL();
?>
<?php
	$pac_id  = GetNumParam('pac_id');
	$pac_row = $pac_dal->getByID($pac_id);
	
	$atenc_valores = $atenc_dal->getTriajeValores($pac_id);
	
	foreach ($atenc_valores as $key => $valor) {
		$edad       = edad($valor['atenc_fecha_reg'], $pac_row['pers_fecha_nac'], true);
		$edad_meses = ($edad['anios'] * 12) + $edad['meses'];
		$normal_row = $atenc_dal->getValoresNormalesEdad($edad_meses, $pac_row['pers_sexo']);
		$nval       = [];
		foreach ($normal_row as $item) {
			$nval[$item['var_id']] = $item['var_valor'];
		}
		$valor['var_1_normal'] = $nval[1];
		$valor['var_2_normal'] = $nval[2];
		$valor['var_3_edad'] = "$edad[anios]a $edad[meses]m";
		
		$atenc_valores[$key] = $valor;
	}
	
	$triaje_fechas       = GetVectorByColumn($atenc_valores, 'atenc_fecha_reg');
	$triaje_peso         = GetVectorByColumn($atenc_valores, 'var_1');
	$triaje_peso_normal  = GetVectorByColumn($atenc_valores, 'var_1_normal');
	$triaje_talla        = GetVectorByColumn($atenc_valores, 'var_2');
	$triaje_talla_normal = GetVectorByColumn($atenc_valores, 'var_2_normal');
	$triaje_edad         = GetVectorByColumn($atenc_valores, 'var_3_edad');
?>
<h3>Evolucion de la talla</h3>
<div style='max-height: 250px; min-width: 450px; max-width: 900px;' class='centered pad15 rpad25 bmarg20'>
    <canvas id="chart_talla" height='250' width='800'></canvas>
</div>
<h3>Evolucion del peso</h3>
<div style='max-height: 250px; min-width: 450px; max-width: 900px;' class='centered pad15 rpad25 bmarg20'>
    <canvas id="chart_peso" height='250' width='800'></canvas>
</div>
<script>
    var chart = new Chart($("#chart_talla"), {
        type   : 'bar',
        data   : {
            labels  : jsonParse('<?= json_encode($triaje_edad); ?>'),
            datasets: [
                {
                    type : 'line',
                    label: 'Talla (cm)',
                    data : jsonParse('<?= json_encode($triaje_talla); ?>'),
                    borderColor: 'rgba(39,192,255,0.5)',
                    borderWidth: 2,
                    backgroundColor: [
                        'rgba(39,192,255,0.16)'
                    ],
                }, {
                    type       : 'line',
                    label      : 'Talla normal (cm)',
                    data       : jsonParse('<?= json_encode($triaje_talla_normal); ?>'),
                    borderColor: 'rgba(255, 99, 132, 0.5)',
                    borderWidth: 2,
                    backgroundColor: [
                        'rgba(255,255,255,0)'
                    ],
                }
            ]
        },
        options: {
            responsive: true,
            scales    : {yAxes: [{ticks: {beginAtZero: true}}]},
            hover     : {mode: 'label'}
        }
    });
</script>


<script>
    var chart = new Chart($("#chart_peso"), {
        type   : 'bar',
        data   : {
            labels  : jsonParse('<?= json_encode($triaje_edad); ?>'),
            datasets: [
                {
                    type : 'line',
                    label: 'Peso (kg)',
                    data : jsonParse('<?= json_encode($triaje_peso); ?>'),
                    borderColor: 'rgba(39,192,255,0.5)',
                    borderWidth: 2,
                    backgroundColor: [
                        'rgba(39,192,255,0.16)'
                    ],
                }, {
                    type       : 'line',
                    label      : 'Peso normal (kg)',
                    data       : jsonParse('<?= json_encode($triaje_peso_normal); ?>'),
                    borderColor: 'rgba(255, 99, 132, 0.5)',
                    borderWidth: 2,
                    backgroundColor: [
                        'rgba(255,255,255,0)'
                    ],
                }
            ]
        },
        options: {
            responsive: true,
            scales    : {yAxes: [{ticks: {beginAtZero: true}}]},
            hover     : {mode: 'label'}
        }
    });
</script>
