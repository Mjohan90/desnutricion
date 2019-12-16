<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal  = new atencionDAL();
	$fecha      = GetStringParam('fecha');
	$b          = GetStringParam('b');
	$atenc_list = $atenc_dal->listarByFecha($fecha, $b);
?>
<table id='tblatencion' class='datatable'>
    <tr>
        <th>ID</th>
        <th>Paciente</th>
        <th>Médico</th>
        <th>Especialidad</th>
        <th>Fecha atención</th>
        <th>Situacion</th>
        <th>Registrado</th>
        <th hidden>Estado</th>
        <th>Triaje</th>
    </tr>
	<?php foreach ($atenc_list as $row) { ?>
        <tr>
            <td class='txt_center'><?php echo pad($row['atenc_id']); ?></td>
            <td><?php echo $row['pac_nombre'], ' ', $row['pac_ap_paterno'], ' ', $row['pac_ap_materno']; ?></td>
            <td><?php echo $row['empl_nombre'], ' ', $row['empl_ap_paterno'], ' ', $row['empl_ap_materno']; ?></td>
            <td><?php echo $row['espec_nombre']; ?></td>
            <td class='txt_center'><?php echo formatDate($row['atenc_fecha_atenc']); ?></td>
            <td><?php echo getSituacionAtencion()[$row['atenc_situacion']]; ?></td>
            <td class='txt_center'><?php echo formatDate($row['atenc_fecha_reg']); ?></td>
            <td hidden><?php echo $row['atenc_estado']; ?></td>
            <td class='txt_center'>
                <a href='#' onclick="triaje('<?php echo $row['atenc_id']; ?>');">Triaje</a>
            </td>
        </tr>
	<?php } ?>
</table>
<script>
    function triaje(atenc_id) {
        performLoad('vistas/triaje/triajeReg.php?atenc_id=' + atenc_id + '&parent=vistas/triaje/triaje.php');
    }
</script>
