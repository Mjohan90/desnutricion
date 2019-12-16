<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/rolDAL.php';
	$rol_dal = new rolDAL();
	$b = GetStringParam('b');
	$rol_list = $rol_dal->listar($b);
?>
<table id='tblrol' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Registrado</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($rol_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['rol_id']); ?></td>
		<td><?php echo $row['rol_nombre']; ?></td>
		<td class='txt_center' hidden><?php echo $row['rol_fecha_reg']; ?></td>
		<td hidden><?php echo $row['rol_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="rol_editar('<?php echo $row['rol_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="rol_borrar('<?php echo $row['rol_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function rol_editar(rol_id) {
		performLoad('vistas/rol/rolUpd.php?rol_id=' + rol_id);
	}
	function rol_borrar(rol_id) {
		if (confirm("¿Borrar rol?")) {
			$.post('vistas/rol/proceso/rol_borrar.php', {
				rol_id: rol_id
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
	function rol_activar(rol_id) {
		if (confirm("¿Activar rol?")) {
			$.post('vistas/rol/proceso/rol_activar.php', {
				rol_id: rol_id
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