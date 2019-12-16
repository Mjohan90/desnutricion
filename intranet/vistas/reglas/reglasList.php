<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/reglasDAL.php';
	$regla_dal = new reglasDAL();
	$b = GetStringParam('b');
	$regla_list = $regla_dal->listar($b);
?>
<table id='tblreglas' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Indicador</th>
		<th>Indicador</th>
		<th>Formula</th>
		<th>Diagnóstico</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($regla_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['regla_id']); ?></td>
		<td><?php echo $row['indic_nombre']; ?></td>
		<td><?php echo $row['indic_nombre']; ?></td>
		<td><?php echo $row['regla_formula']; ?></td>
		<td><?php echo $row['diag_nombre']; ?></td>
		<td class='txt_center'><a href='#' onclick="regla_editar('<?php echo $row['regla_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="regla_borrar('<?php echo $row['regla_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function regla_editar(regla_id) {
		performLoad('vistas/reglas/reglasUpd.php?regla_id=' + regla_id);
	}
	function regla_borrar(regla_id) {
		if (confirm("¿Borrar reglas?")) {
			$.post('vistas/reglas/proceso/reglas_borrar.php', {
				regla_id: regla_id
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
	function regla_activar(regla_id) {
		if (confirm("¿Activar reglas?")) {
			$.post('vistas/reglas/proceso/reglas_activar.php', {
				regla_id: regla_id
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