<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/triajeDAL.php';
	$triaje_dal = new triajeDAL();
	$b = GetStringParam('b');
	$triaje_list = $triaje_dal->listar($b);
?>
<table id='tbltriaje' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Atención</th>
		<th>Variable</th>
		<th>Unidad de medida</th>
		<th>Valor</th>
		<th hidden>Registrado</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($triaje_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['triaje_id']); ?></td>
		<td><?php echo $row['atenc_id']; ?></td>
		<td><?php echo $row['var_nombre']; ?></td>
		<td><?php echo $row['um_nombre']; ?></td>
		<td class='txt_right'> <?php echo $row['triaje_valor']; ?></td>
		<td class='txt_center' hidden><?php echo $row['triaje_fecha_reg']; ?></td>
		<td hidden><?php echo $row['triaje_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="triaje_editar('<?php echo $row['triaje_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="triaje_borrar('<?php echo $row['triaje_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function triaje_editar(triaje_id) {
		performLoad('vistas/triaje/triajeUpd.php?triaje_id=' + triaje_id);
	}
	function triaje_borrar(triaje_id) {
		if (confirm("¿Borrar triaje?")) {
			$.post('vistas/triaje/proceso/triaje_borrar.php', {
				triaje_id: triaje_id
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
	function triaje_activar(triaje_id) {
		if (confirm("¿Activar triaje?")) {
			$.post('vistas/triaje/proceso/triaje_activar.php', {
				triaje_id: triaje_id
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