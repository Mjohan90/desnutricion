<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('cita_upd', 'vistas/atencion/atencionUpd.php');
?>
<?php
	include_once '../../datos/pacienteDAL.php';
	$pac_dal = new pacienteDAL();
	$pac_id  = GetNumParam('pac_id');
	$pac_row = $pac_dal->getByID($pac_id);
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
	$pers_row = $pers_dal->getByID($pac_row['pers_id']);
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal  = new atencionDAL();
	$atenc_list = $atenc_dal->listarByPaciente($pac_id);
?>
<div style='width: 100%;max-width: 800px; text-align: center;padding-top: 10px;'>
<h2>HISTORIA CLÍNICA DEL PACIENTE</h2>
<h3>(Ficha Tecnica)</h3>

<div class='txt_left'>
    <span class='bold'>DATOS DEL PACIENTE:</span><br>
    <hr class='separator_bold'>
    <div class='inline' style='padding: 10px 20px 0;'>
        <span class='lbold'>Nombres: </span><?= $pac_row['pers_nombre'] ?>
    </div>
    <div class='inline' style='padding: 10px 20px 0;'>
        <span class='lbold'>Apellidos: </span><?= $pac_row['pers_nombre'] ?>
    </div>
    <div class='inline' style='padding: 10px 20px 0;'>
        <span class='lbold'><?= $pers_row['tdi_abrev'] ?>: </span><?= $pers_row['pers_tdi_nro'] ?>
    </div>
    <br>
    <div class='inline' style='padding: 10px 20px 0;'>
        <span class='lbold'>Fecha nacimiento: </span><?= formatDate($pac_row['pers_fecha_nac']) ?>
    </div>
	<?php $edad = edad(todayYMD(), $pac_row['pers_fecha_nac'], true); ?>
    <div class='inline' style='padding: 10px 20px 0;'>
        <span class='lbold'>Edad: </span><?= $edad['anios'] ?> años <?= $edad['meses'] ?> meses
    </div>
    <div class='inline' style='padding: 10px 20px 0;'>
        <span class='lbold'>Sexo: </span><?= $pac_row['pers_sexo'] ?>
    </div>
    <br>
</div>
<br>
<div class='txt_left'>
    <span class='bold'>DATOS ADICIONALES:</span><br>
    <hr class='separator_bold'>
    <div class='inline' style='padding: 10px 20px 0;'>
        <span class='lbold'>Correo: </span><?= $pers_row['pers_email'] ?>
    </div>
    <div class='inline' style='padding: 10px 20px 0;'>
        <span class='lbold'>Celular: </span><?= $pers_row['pers_celular'] ?>
    </div>
    <div class='inline' style='padding: 10px 20px 0;'>
        <span class='lbold'>Telefono: </span><?= $pers_row['pers_telefono'] ?>
    </div>
</div>
<br>
<div class='txt_left'>
    <span class='bold'>HISTORIAL CLÍNICO:</span><br>
    <hr class='separator_bold'>
	<?php foreach ($atenc_list as $atenc_row) { ?>
        <div class='inline' style='padding: 10px 20px 0;'>
            <span class='lbold'>Fecha: </span><?= formatDateAM($atenc_row['atenc_fecha_reg']) ?>
        </div>
        <div class='inline' style='padding: 10px 20px 0;'>
            <span class='lbold'>Médico tratante: </span><?= "$atenc_row[empl_nombre] $atenc_row[empl_ap_paterno] $atenc_row[empl_ap_materno]" ?>
        </div>
        <hr class='separator_x'>
        <div class='inline' style='padding: 10px 20px 0;'>
            <span class='lbold'>Observaciones: </span>
            <br><?= "$atenc_row[atenc_observacion]" ?>
        </div>
        <br>
        <div class='inline' style='padding: 10px 20px 0;'>
            <span class='lbold'>Tratamiento: </span>
            <br><?= "$atenc_row[atenc_tratamiento]" ?>
        </div>
        <br>
        <div class='inline' style='padding: 10px 20px 0;'>
            <span class='lbold'>Dieta: </span>
            <br><?= "$atenc_row[atenc_dieta]" ?>
        </div>
        <br>
	<?php } ?>
</div>
<a href='#' class='btn' id='btnCancelar'>Volver</a>
</div>
<script>
    $(function () {
        $('#btnCancelar').click(function (e) {
            volver();
        });
    });

    function volver() {
        performLoad('<?php echo $parent; ?>');
    }
</script>
