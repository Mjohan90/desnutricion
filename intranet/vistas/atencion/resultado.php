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
	include_once '../../datos/diagnosticoDAL.php';
	include_once '../../entidades/diagnostico.php';
	$diag_dal = new diagnosticoDAL();
?>
<?php
	$atenc_id  = $_GET['atenc_id'];
	$atenc_row = $atenc_dal->getByID($atenc_id);
	$diag_row  = $atenc_dal->detectEnfermedad($atenc_id);
?>
<?php
	$pac_id  = $atenc_row['pac_id'];
	$pac_row = $pac_dal->getByID($pac_id);
?>
<?php
	$pac_edad             = edad($atenc_row['atenc_fecha_reg'], $pac_row['pers_fecha_nac'], true);
	$pac_edad_total_meses = $pac_edad['anios'] * 12 + $pac_edad['meses'];
	$normal               = $atenc_dal->getValoresNormalesEdad($pac_edad_total_meses, $pac_row['pers_sexo']);
?>
<?php
	$diag            = new diagnostico();
	$diag->atenc_id  = $atenc_id;
	$diag->enferm_id = $diag_row['enferm_id'];
	$diag_rs = $diag_dal->registrar($diag);
?>
<div style='margin: 10px; padding: 10px; border: 2px solid #a2c6d6; border-radius: 10px; width: 250px;'>
    <span class='h2'>Resultados:</span><br>
	<?php if ($diag_row) { ?>
        El niño presenta diagnostico: <b><?= strtolower_utf8($diag_row['enferm_nombre']) ?></b><br>
        <img src='../recursos/img/enfermedad/<?= $diag_row['enferm_id'] ?>.png' style='height: 200px;' alt=''><br>
        <b>Posible tratamiento: </b><br>
		<?= $diag_row['enferm_tratamiento_sug'] ?><br>
        <b>Posible dieta: </b><br>
		<?= $diag_row['enferm_dieta_sug'] ?>
	<?php } else { ?>
        El niño probablemente presenta <b>otro problema de crecimiento o nutricion</b>
	<?php } ?>
    <br>
    Los valores normales para un niño de <?= "$pac_edad[anios] años, $pac_edad[meses] meses" ?> del
    sexo <?= $pac_row['pers_sexo'] ?> son:<br>
	<?php foreach ($normal as $valor) { ?>
		<?= "<b>$valor[var_nombre]</b> : $valor[var_valor]  $valor[um_abrev]" ?><br>
	<?php } ?>
</div>

