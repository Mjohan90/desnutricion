<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/direccionDAL.php';
	$direc_dal = new direccionDAL();
	$b = GetStrParam('b');
	$direc_list = $direc_dal->listar($b);
?>
<table id='tbldireccion' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Persona</th>
		<th>Ubicación geográfica</th>
		<th>Descripcion</th>
		<th hidden>Registrado</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($direc_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['direc_id']); ?></td>
		<td><?php echo $row['pers_nombre']; ?></td>
		<td><?php echo $row['ubig_nombre']; ?></td>
		<td><?php echo $row['direc_descripcion']; ?></td>
		<td class='txt_center' hidden><?php echo $row['direc_fecha_reg']; ?></td>
		<td hidden><?php echo $row['direc_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="direc_editar('<?php echo $row['direc_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="direc_borrar('<?php echo $row['direc_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function direc_editar(direc_id) {
		performLoad('vistas/direccion/direccionUpd.php?direc_id=' + direc_id);
	}
	function direc_borrar(direc_id) {
		if (confirm("¿Borrar dirección?")) {
			$.post('vistas/direccion/proceso/direccion_borrar.php', {
				direc_id: direc_id
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
	function direc_activar(direc_id) {
		if (confirm("¿Activar dirección?")) {
			$.post('vistas/direccion/proceso/direccion_activar.php', {
				direc_id: direc_id
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
