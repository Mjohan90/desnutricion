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
	include_once '../../datos/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
?>
<?php
	include_once '../../datos/enfermedadDAL.php';
	$enferm_dal = new enfermedadDAL();
?>
<?php
	$anio  = GetNumParam('anio');
	$ubig_id = GetNumParam('ubig_id');
	
	$ubig_row    = $ubig_dal->getFullNameOfLugar($ubig_id);
	$enferm_list = $enferm_dal->listar();
	$rep_row     = $atenc_dal->reporteDiagnosticosByUbigId($anio, $ubig_id);
	
	$labels  = [];
	$valores = [];
	foreach ($enferm_list as $enferm_row) {
		$labels[]  = $enferm_row ['enferm_nombre'];
		$valores[] = $rep_row['enferm_'.$enferm_row['enferm_id']];
	}
?>
<h3>Niveles de desnutricion en <?= $ubig_row['ubig_nombre_full'] ?> </h3>
<div style='max-height: 250px; min-width: 450px; max-width: 900px;' class='centered pad15 rpad25 bmarg20'>
    <canvas id="chart_talla" height='250' width='800'></canvas>
</div>
<script>
    var chart = new Chart($("#chart_talla"), {
        type   : 'bar',
        data   : {
            labels  : jsonParse('<?= json_encode($labels); ?>'),
            datasets: [
                {
                    type           : 'bar',
                    label          : 'Nº de incidencias',
                    data           : jsonParse('<?= json_encode($valores); ?>'),
                    borderColor    : 'rgba(255,95,88,0.55)',
                    borderWidth    : 2,
                    backgroundColor: [
                        'rgba(255,143,160,0.62)'
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
