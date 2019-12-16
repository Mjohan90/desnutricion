<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/usuarioDAL.php';
	$usu_dal  = new usuarioDAL();
	$b        = GetStrParam('b');
	$usu_list = $usu_dal->listar($b);
?>
<table id='tblusuario' class='datatable'>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Empleado</th>
        <th>Rol</th>
        <th hidden>Registrado</th>
        <th>Estado</th>
        <th>Editar</th>
        <th>Desactivar</th>
    </tr>
	<?php foreach ($usu_list as $row) { ?>
        <tr>
            <td class='txt_center'><?php echo pad($row['usu_id']); ?></td>
            <td><?php echo $row['usu_nombre']; ?></td>
            <td><?php echo $row['pers_nombre'], ' ', $row['pers_ap_paterno'], ' ', $row['pers_ap_materno']; ?></td>
            <td><?php echo $row['rol_nombre']; ?></td>
            <td class='txt_center' hidden><?php echo $row['usu_fecha_reg']; ?></td>
            <td><span class='<?= $row['usu_estado'] == ACTIVO ? 'verde' : 'rojo' ?>'>
                    <?php echo getEstados()[$row['usu_estado']]; ?>
                </span>
            </td>
            <td class='txt_center'>
                <a href='#' onclick="usu_editar('<?php echo $row['usu_id']; ?>');">Editar</a>
            </td>
            <td class='txt_center'>
				<?php if ($row['usu_estado'] == ACTIVO) { ?>
                    <a href='#' onclick="usu_desactivar('<?php echo $row['usu_id']; ?>');">Desactivar</a>
				<?php } else { ?>
                    <a href='#' onclick="usu_activar('<?php echo $row['usu_id']; ?>');">Activar</a>
				<?php } ?>
            </td>
        </tr>
	<?php } ?>
</table>
<script>
function usu_editar(usu_id) {
    performLoad('vistas/usuario/usuarioUpd.php?usu_id=' + usu_id);
}

function usu_desactivar(usu_id) {
    if (confirm("¿Inactivar usuario?")) {
        $.post('vistas/usuario/proceso/usuario_desactivar.php', {
                usu_id: usu_id
            },
            function (datos) {
                if (datos > 0) {
                    alert('Usuario deshabilitado correctamente');
                    volver();
                } else {
                    alert('Error al deshabilitar. ' + datos);
                }
            });
    }
}

function usu_borrar(usu_id) {
    if (confirm("¿Inactivar usuario?")) {
        $.post('vistas/usuario/proceso/usuario_borrar.php', {
                usu_id: usu_id
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

function usu_activar(usu_id) {
    if (confirm("¿Activar usuario?")) {
        $.post('vistas/usuario/proceso/usuario_activar.php', {
                usu_id: usu_id
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
