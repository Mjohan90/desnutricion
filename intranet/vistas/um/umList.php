<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/umDAL.php';
	$um_dal = new umDAL();
	$b = GetStringParam('b');
	$um_list = $um_dal->listar($b);
?>
<table id='tblum' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Abrev</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($um_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['um_id']); ?></td>
		<td><?php echo $row['um_nombre']; ?></td>
		<td><?php echo $row['um_abrev']; ?></td>
		<td hidden><?php echo $row['um_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="um_editar('<?php echo $row['um_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="um_borrar('<?php echo $row['um_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function um_editar(um_id) {
		performLoad('vistas/um/umUpd.php?um_id=' + um_id);
	}
	function um_borrar(um_id) {
		if (confirm("¿Borrar unidad de medida?")) {
			$.post('vistas/um/proceso/um_borrar.php', {
				um_id: um_id
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
	function um_activar(um_id) {
		if (confirm("¿Activar unidad de medida?")) {
			$.post('vistas/um/proceso/um_activar.php', {
				um_id: um_id
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