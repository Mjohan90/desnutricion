<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/pacienteDAL.php';
	$pac_dal  = new pacienteDAL();
	$b        = GetStringParam('b');
	$pac_list = $pac_dal->listar($b);
?>
<table id='tblpaciente' class='datatable'>
    <tr>
        <th>ID</th>
        <th>Persona</th>
        <th>D.I.</th>
        <th>Nº</th>
        <th>Fecha nac</th>
        <th hidden>Registrado</th>
        <th hidden>Estado</th>
        <th>Familiares</th>
        <th>Editar</th>
        <th>Borrar</th>
    </tr>
	<?php foreach ($pac_list as $row) { ?>
        <tr>
            <td class='txt_center'><?php echo pad($row['pac_id']); ?></td>
            <td><?php echo $row['pers_nombre'], ' ', $row['pers_snombre'], ' ', $row['pers_ap_paterno'], ' ', $row['pers_ap_materno']; ?></td>
            <td class='txt_center'><?php echo $row['tdi_abrev']; ?></td>
            <td class='txt_center'><?php echo $row['pers_tdi_nro']; ?></td>
            <td class='txt_center'><?php echo formatDate($row['pers_fecha_nac']); ?></td>
            <td class='txt_center' hidden><?php echo $row['pac_fecha_reg']; ?></td>
            <td hidden><?php echo $row['pac_estado']; ?></td>
            <td class='txt_center'><a href='#' onclick="pac_familiares('<?php echo $row['pers_id']; ?>');">Familiares</a>
            </td>
            <td class='txt_center'><a href='#' onclick="pac_editar('<?php echo $row['pac_id']; ?>');">Editar</a></td>
            <td class='txt_center'><a href='#' onclick="pac_borrar('<?php echo $row['pac_id']; ?>');">Borrar</a></td>
        </tr>
	<?php } ?>
</table>
<script>
    function pac_editar(pac_id) {
        performLoad('vistas/paciente/pacienteUpd.php?pac_id=' + pac_id);
    }

    function pac_familiares(pers_id) {
        performLoad('vistas/persona/personaFam.php?pers_id=' + pers_id + '&parent=vistas/paciente/paciente.php');
    }

    function pac_borrar(pac_id) {
        if (confirm("¿Borrar paciente?")) {
            $.post('vistas/paciente/proceso/paciente_borrar.php', {
                    pac_id: pac_id
                },
                function (datos) {
                    if (datos > 0) {
                        alert('Borrado correcto');
                        volver();
                    } else {
                        alert('Error al borrar. ' + datos);
                    }
                });
        }
    }

    function pac_activar(pac_id) {
        if (confirm("¿Activar paciente?")) {
            $.post('vistas/paciente/proceso/paciente_activar.php', {
                    pac_id: pac_id
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