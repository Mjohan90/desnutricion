<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/usuarioDAL.php';
	$usu_dal = new usuarioDAL();
	$b = GetStringParam('b');
	$usu_list = $usu_dal->listar($b);
?>
<table id='tblusuario' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Empleado</th>
		<th>Rol</th>
		<th hidden>Registrado</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($usu_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['usu_id']); ?></td>
		<td><?php echo $row['usu_nombre']; ?></td>
		<td><?php echo $row['empl_id']; ?></td>
		<td><?php echo $row['rol_nombre']; ?></td>
		<td class='txt_center' hidden><?php echo $row['usu_fecha_reg']; ?></td>
		<td hidden><?php echo $row['usu_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="usu_editar('<?php echo $row['usu_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="usu_borrar('<?php echo $row['usu_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function usu_editar(usu_id) {
		performLoad('vistas/usuario/usuarioUpd.php?usu_id=' + usu_id);
	}
	function usu_borrar(usu_id) {
		if (confirm("¿Borrar usuario?")) {
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