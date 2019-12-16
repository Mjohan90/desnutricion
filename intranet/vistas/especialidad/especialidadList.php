<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/especialidadDAL.php';
	$espec_dal = new especialidadDAL();
	$b = GetStringParam('b');
	$espec_list = $espec_dal->listar($b);
?>
<table id='tblespecialidad' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($espec_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['espec_id']); ?></td>
		<td><?php echo $row['espec_nombre']; ?></td>
		<td hidden><?php echo $row['espec_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="espec_editar('<?php echo $row['espec_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="espec_borrar('<?php echo $row['espec_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function espec_editar(espec_id) {
		performLoad('vistas/especialidad/especialidadUpd.php?espec_id=' + espec_id);
	}
	function espec_borrar(espec_id) {
		if (confirm("¿Borrar especialidad?")) {
			$.post('vistas/especialidad/proceso/especialidad_borrar.php', {
				espec_id: espec_id
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
	function espec_activar(espec_id) {
		if (confirm("¿Activar especialidad?")) {
			$.post('vistas/especialidad/proceso/especialidad_activar.php', {
				espec_id: espec_id
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