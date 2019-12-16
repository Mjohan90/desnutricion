<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/enfermedadDAL.php';
	$enferm_dal = new enfermedadDAL();
	$b = GetStringParam('b');
	$enferm_list = $enferm_dal->listar($b);
?>
<table id='tblenfermedad' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Tratamiento sug</th>
		<th>Dieta sug</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($enferm_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['enferm_id']); ?></td>
		<td><?php echo $row['enferm_nombre']; ?></td>
		<td><?php echo $row['enferm_tratamiento_sug']; ?></td>
		<td><?php echo $row['enferm_dieta_sug']; ?></td>
		<td hidden><?php echo $row['enferm_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="enferm_editar('<?php echo $row['enferm_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="enferm_borrar('<?php echo $row['enferm_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function enferm_editar(enferm_id) {
		performLoad('vistas/enfermedad/enfermedadUpd.php?enferm_id=' + enferm_id);
	}
	function enferm_borrar(enferm_id) {
		if (confirm("¿Borrar enfermedad?")) {
			$.post('vistas/enfermedad/proceso/enfermedad_borrar.php', {
				enferm_id: enferm_id
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
	function enferm_activar(enferm_id) {
		if (confirm("¿Activar enfermedad?")) {
			$.post('vistas/enfermedad/proceso/enfermedad_activar.php', {
				enferm_id: enferm_id
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