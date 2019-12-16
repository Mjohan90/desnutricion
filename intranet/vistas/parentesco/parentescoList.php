<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/parentescoDAL.php';
	$parent_dal = new parentescoDAL();
	$b = GetStringParam('b');
	$parent_list = $parent_dal->listar($b);
?>
<table id='tblparentesco' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Persona</th>
		<th>Persona</th>
		<th>Tipo de parentesco</th>
		<th>Es apoderado</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($parent_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['parent_id']); ?></td>
		<td><?php echo $row['pers_nombre']; ?></td>
		<td><?php echo $row['pers_nombre']; ?></td>
		<td><?php echo $row['tparent_nombre']; ?></td>
		<td><?php echo $row['parent_es_apoderado']; ?></td>
		<td hidden><?php echo $row['parent_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="parent_editar('<?php echo $row['parent_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="parent_borrar('<?php echo $row['parent_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function parent_editar(parent_id) {
		performLoad('vistas/parentesco/parentescoUpd.php?parent_id=' + parent_id);
	}
	function parent_borrar(parent_id) {
		if (confirm("¿Borrar parentesco?")) {
			$.post('vistas/parentesco/proceso/parentesco_borrar.php', {
				parent_id: parent_id
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
	function parent_activar(parent_id) {
		if (confirm("¿Activar parentesco?")) {
			$.post('vistas/parentesco/proceso/parentesco_activar.php', {
				parent_id: parent_id
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