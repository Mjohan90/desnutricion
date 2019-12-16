<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/historiaclinicaDAL.php';
	$hc_dal = new historiaclinicaDAL();
	$b = GetStrParam('b');
	$hc_list = $hc_dal->listar($b);
?>
<table id='tblhistoriaclinica' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Paciente</th>
		<th>Fecha suceso</th>
		<th>Comentario</th>
		<th>Atenc id ref</th>
		<th hidden>Registrado</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($hc_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['hc_id']); ?></td>
		<td><?php echo $row['pac_id']; ?></td>
		<td class='txt_center'><?php echo formatDate($row['hc_fecha_suceso']); ?></td>
		<td><?php echo $row['hc_comentario']; ?></td>
		<td><?php echo $row['hc_atenc_id_ref']; ?></td>
		<td class='txt_center' hidden><?php echo $row['hc_fecha_reg']; ?></td>
		<td hidden><?php echo $row['hc_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="hc_editar('<?php echo $row['hc_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="hc_borrar('<?php echo $row['hc_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function hc_editar(hc_id) {
		performLoad('vistas/historiaclinica/historiaclinicaUpd.php?hc_id=' + hc_id);
	}
	function hc_borrar(hc_id) {
		if (confirm("¿Borrar historia clínica?")) {
			$.post('vistas/historiaclinica/proceso/historiaclinica_borrar.php', {
				hc_id: hc_id
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
	function hc_activar(hc_id) {
		if (confirm("¿Activar historia clínica?")) {
			$.post('vistas/historiaclinica/proceso/historiaclinica_activar.php', {
				hc_id: hc_id
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
