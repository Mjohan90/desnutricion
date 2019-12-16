<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/categvariableDAL.php';
	$catvar_dal = new categvariableDAL();
	$b = GetStrParam('b');
	$catvar_list = $catvar_dal->listar($b);
?>
<table id='tblcategvariable' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($catvar_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['catvar_id']); ?></td>
		<td><?php echo $row['catvar_nombre']; ?></td>
		<td hidden><?php echo $row['catvar_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="catvar_editar('<?php echo $row['catvar_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="catvar_borrar('<?php echo $row['catvar_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function catvar_editar(catvar_id) {
		performLoad('vistas/categvariable/categvariableUpd.php?catvar_id=' + catvar_id);
	}
	function catvar_borrar(catvar_id) {
		if (confirm("¿Borrar categoría de variable?")) {
			$.post('vistas/categvariable/proceso/categvariable_borrar.php', {
				catvar_id: catvar_id
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
	function catvar_activar(catvar_id) {
		if (confirm("¿Activar categoría de variable?")) {
			$.post('vistas/categvariable/proceso/categvariable_activar.php', {
				catvar_id: catvar_id
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
