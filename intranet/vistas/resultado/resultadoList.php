<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/resultadoDAL.php';
	$result_dal = new resultadoDAL();
	$b = GetStrParam('b');
	$result_list = $result_dal->listar($b);
?>
<table id='tblresultado' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Atención</th>
		<th>Diagnóstico</th>
		<th hidden>Registrado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($result_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['result_id']); ?></td>
		<td><?php echo $row['atenc_id']; ?></td>
		<td><?php echo $row['diag_nombre']; ?></td>
		<td class='txt_center' hidden><?php echo $row['result_fecha_reg']; ?></td>
		<td class='txt_center'><a href='#' onclick="result_editar('<?php echo $row['result_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="result_borrar('<?php echo $row['result_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function result_editar(result_id) {
		performLoad('vistas/resultado/resultadoUpd.php?result_id=' + result_id);
	}
	function result_borrar(result_id) {
		if (confirm("¿Borrar resultado?")) {
			$.post('vistas/resultado/proceso/resultado_borrar.php', {
				result_id: result_id
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
	function result_activar(result_id) {
		if (confirm("¿Activar resultado?")) {
			$.post('vistas/resultado/proceso/resultado_activar.php', {
				result_id: result_id
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
