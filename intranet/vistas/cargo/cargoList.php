<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/cargoDAL.php';
	$carg_dal = new cargoDAL();
	$b = GetStringParam('b');
	$carg_list = $carg_dal->listar($b);
?>
<table id='tblcargo' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($carg_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['carg_id']); ?></td>
		<td><?php echo $row['carg_nombre']; ?></td>
		<td hidden><?php echo $row['carg_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="carg_editar('<?php echo $row['carg_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="carg_borrar('<?php echo $row['carg_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function carg_editar(carg_id) {
		performLoad('vistas/cargo/cargoUpd.php?carg_id=' + carg_id);
	}
	function carg_borrar(carg_id) {
		if (confirm("¿Borrar cargo?")) {
			$.post('vistas/cargo/proceso/cargo_borrar.php', {
				carg_id: carg_id
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
	function carg_activar(carg_id) {
		if (confirm("¿Activar cargo?")) {
			$.post('vistas/cargo/proceso/cargo_activar.php', {
				carg_id: carg_id
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