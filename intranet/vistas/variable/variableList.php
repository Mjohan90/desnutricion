<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/variableDAL.php';
	$var_dal = new variableDAL();
	$b = GetStringParam('b');
	$var_list = $var_dal->listar($b);
?>
<table id='tblvariable' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Categoría de variable</th>
		<th>Nombre</th>
		<th>Unidad de medida</th>
		<th>Tipo var</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($var_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['var_id']); ?></td>
		<td><?php echo $row['catvar_nombre']; ?></td>
		<td><?php echo $row['var_nombre']; ?></td>
		<td><?php echo $row['um_nombre']; ?></td>
		<td class='txt_center'><?php echo $row['var_tipo_var']; ?></td>
		<td hidden><?php echo $row['var_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="var_editar('<?php echo $row['var_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="var_borrar('<?php echo $row['var_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function var_editar(var_id) {
		performLoad('vistas/variable/variableUpd.php?var_id=' + var_id);
	}
	function var_borrar(var_id) {
		if (confirm("¿Borrar variable?")) {
			$.post('vistas/variable/proceso/variable_borrar.php', {
				var_id: var_id
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
	function var_activar(var_id) {
		if (confirm("¿Activar variable?")) {
			$.post('vistas/variable/proceso/variable_activar.php', {
				var_id: var_id
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