<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/claseenfermedadDAL.php';
	$clsenferm_dal = new claseenfermedadDAL();
	$b = GetStrParam('b');
	$clsenferm_list = $clsenferm_dal->listar($b);
?>
<table id='tblclaseenfermedad' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Registrado</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($clsenferm_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['clsenferm_id']); ?></td>
		<td><?php echo $row['clsenferm_nombre']; ?></td>
		<td class='txt_center' hidden><?php echo $row['clsenferm_fecha_reg']; ?></td>
		<td hidden><?php echo $row['clsenferm_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="clsenferm_editar('<?php echo $row['clsenferm_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="clsenferm_borrar('<?php echo $row['clsenferm_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function clsenferm_editar(clsenferm_id) {
		performLoad('vistas/claseenfermedad/claseenfermedadUpd.php?clsenferm_id=' + clsenferm_id);
	}
	function clsenferm_borrar(clsenferm_id) {
		if (confirm("¿Borrar clase de enfermedad?")) {
			$.post('vistas/claseenfermedad/proceso/claseenfermedad_borrar.php', {
				clsenferm_id: clsenferm_id
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
	function clsenferm_activar(clsenferm_id) {
		if (confirm("¿Activar clase de enfermedad?")) {
			$.post('vistas/claseenfermedad/proceso/claseenfermedad_activar.php', {
				clsenferm_id: clsenferm_id
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
