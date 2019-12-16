<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/tipoparentescoDAL.php';
	$tparent_dal = new tipoparentescoDAL();
	$b = GetStrParam('b');
	$tparent_list = $tparent_dal->listar($b);
?>
<table id='tbltipoparentesco' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($tparent_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['tparent_id']); ?></td>
		<td><?php echo $row['tparent_nombre']; ?></td>
		<td hidden><?php echo $row['tparent_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="tparent_editar('<?php echo $row['tparent_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="tparent_borrar('<?php echo $row['tparent_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function tparent_editar(tparent_id) {
		performLoad('vistas/tipoparentesco/tipoparentescoUpd.php?tparent_id=' + tparent_id);
	}
	function tparent_borrar(tparent_id) {
		if (confirm("¿Borrar tipo de parentesco?")) {
			$.post('vistas/tipoparentesco/proceso/tipoparentesco_borrar.php', {
				tparent_id: tparent_id
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
	function tparent_activar(tparent_id) {
		if (confirm("¿Activar tipo de parentesco?")) {
			$.post('vistas/tipoparentesco/proceso/tipoparentesco_activar.php', {
				tparent_id: tparent_id
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
