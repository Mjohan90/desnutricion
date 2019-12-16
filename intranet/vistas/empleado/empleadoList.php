<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/empleadoDAL.php';
	$empl_dal = new empleadoDAL();
	$b = GetStringParam('b');
	$empl_list = $empl_dal->listar($b);
?>
<table id='tblempleado' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Persona</th>
		<th>Cargo</th>
		<th hidden>Registrado</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($empl_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['empl_id']); ?></td>
		<td><?php echo $row['pers_nombre']; ?></td>
		<td><?php echo $row['carg_nombre']; ?></td>
		<td class='txt_center' hidden><?php echo $row['empl_fecha_reg']; ?></td>
		<td hidden><?php echo $row['empl_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="empl_editar('<?php echo $row['empl_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="empl_borrar('<?php echo $row['empl_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function empl_editar(empl_id) {
		performLoad('vistas/empleado/empleadoUpd.php?empl_id=' + empl_id);
	}
	function empl_borrar(empl_id) {
		if (confirm("¿Borrar empleado?")) {
			$.post('vistas/empleado/proceso/empleado_borrar.php', {
				empl_id: empl_id
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
	function empl_activar(empl_id) {
		if (confirm("¿Activar empleado?")) {
			$.post('vistas/empleado/proceso/empleado_activar.php', {
				empl_id: empl_id
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