<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal  = new atencionDAL();
	$b          = GetStrParam('b');
	$fecha      = GetStrParam('fecha');
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
        <th>Editar</th>
        <th>Borrar</th>
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
                <a href='#' onclick="atenc_editar('<?php echo $row['atenc_id']; ?>');">Editar</a>
            </td>
            <td class='txt_center'>
                <a href='#' onclick="atenc_borrar('<?php echo $row['atenc_id']; ?>');">Borrar</a>
            </td>
        </tr>
	<?php } ?>
</table>
<script>
    function atenc_editar(atenc_id) {
        performLoad('vistas/atencion/citaUpd.php?atenc_id=' + atenc_id);
    }

    function atenc_borrar(atenc_id) {
        if (confirm("¿Borrar cita?")) {
            $.post('vistas/atencion/proceso/atencion_borrar.php', {
                    atenc_id: atenc_id
                },
                function (datos) {
                    if (datos > 0) {
                        alert('Borrado correcto');
                        // volver();
                    } else {
                        alert('Error al borrar. ' + datos);
                    }
                });
        }
    }

    function atenc_activar(atenc_id) {
        if (confirm("¿Activar cita?")) {
            $.post('vistas/atencion/proceso/atencion_activar.php', {
                    atenc_id: atenc_id
                },
                function (datos) {
                    if (datos > 0) {
                        alert('Activado correcto');
                        volver();
                    } else {
                        alert('Error al activar. ' + datos);
                    }
                });
        }
    }
</script>
