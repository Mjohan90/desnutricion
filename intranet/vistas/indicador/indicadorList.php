<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/indicadorDAL.php';
	$indic_dal = new indicadorDAL();
	$b = GetStrParam('b');
	$indic_list = $indic_dal->listar($b);
?>
<table id='tblindicador' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Var1 id</th>
		<th>Var2 id</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($indic_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['indic_id']); ?></td>
		<td><?php echo $row['indic_nombre']; ?></td>
		<td><?php echo $row['indic_var1_id']; ?></td>
		<td><?php echo $row['indic_var2_id']; ?></td>
		<td hidden><?php echo $row['indic_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="indic_editar('<?php echo $row['indic_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="indic_borrar('<?php echo $row['indic_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function indic_editar(indic_id) {
		performLoad('vistas/indicador/indicadorUpd.php?indic_id=' + indic_id);
	}
	function indic_borrar(indic_id) {
		if (confirm("¿Borrar indicador?")) {
			$.post('vistas/indicador/proceso/indicador_borrar.php', {
				indic_id: indic_id
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
	function indic_activar(indic_id) {
		if (confirm("¿Activar indicador?")) {
			$.post('vistas/indicador/proceso/indicador_activar.php', {
				indic_id: indic_id
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
