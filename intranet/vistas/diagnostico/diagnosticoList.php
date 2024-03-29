<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/diagnosticoDAL.php';
	$diag_dal = new diagnosticoDAL();
	$b = GetStrParam('b');
	$diag_list = $diag_dal->listar($b);
?>
<table id='tbldiagnostico' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Atención</th>
		<th>Enfermedad</th>
		<th hidden>Registrado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($diag_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['diag_id']); ?></td>
		<td><?php echo $row['atenc_id']; ?></td>
		<td><?php echo $row['enferm_nombre']; ?></td>
		<td class='txt_center' hidden><?php echo $row['diag_fecha_reg']; ?></td>
		<td class='txt_center'><a href='#' onclick="diag_editar('<?php echo $row['diag_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="diag_borrar('<?php echo $row['diag_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function diag_editar(diag_id) {
		performLoad('vistas/diagnostico/diagnosticoUpd.php?diag_id=' + diag_id);
	}
	function diag_borrar(diag_id) {
		if (confirm("¿Borrar diagnóstico?")) {
			$.post('vistas/diagnostico/proceso/diagnostico_borrar.php', {
				diag_id: diag_id
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
	function diag_activar(diag_id) {
		if (confirm("¿Activar diagnóstico?")) {
			$.post('vistas/diagnostico/proceso/diagnostico_activar.php', {
				diag_id: diag_id
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
