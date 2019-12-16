<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
	$b = GetStringParam('b');
	$pers_list = $pers_dal->listar($b);
?>
<table id='tblpersona' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Snombre</th>
		<th>Ap paterno</th>
		<th>Ap materno</th>
		<th>Tipo documento de identidad</th>
		<th>Tdi nro</th>
		<th>Sexo</th>
		<th>Fecha nac</th>
		<th>Email</th>
		<th>Celular</th>
		<th>Telefono</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($pers_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['pers_id']); ?></td>
		<td><?php echo $row['pers_nombre']; ?></td>
		<td><?php echo $row['pers_snombre']; ?></td>
		<td><?php echo $row['pers_ap_paterno']; ?></td>
		<td><?php echo $row['pers_ap_materno']; ?></td>
		<td><?php echo $row['tdi_nombre']; ?></td>
		<td><?php echo $row['pers_tdi_nro']; ?></td>
		<td class='txt_center'><?php echo $row['pers_sexo']; ?></td>
		<td class='txt_center'><?php echo formatDate($row['pers_fecha_nac']); ?></td>
		<td><?php echo $row['pers_email']; ?></td>
		<td><?php echo $row['pers_celular']; ?></td>
		<td><?php echo $row['pers_telefono']; ?></td>
		<td hidden><?php echo $row['pers_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="pers_editar('<?php echo $row['pers_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="pers_borrar('<?php echo $row['pers_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function pers_editar(pers_id) {
		performLoad('vistas/persona/personaUpd.php?pers_id=' + pers_id);
	}
	function pers_borrar(pers_id) {
		if (confirm("¿Borrar persona?")) {
			$.post('vistas/persona/proceso/persona_borrar.php', {
				pers_id: pers_id
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
	function pers_activar(pers_id) {
		if (confirm("¿Activar persona?")) {
			$.post('vistas/persona/proceso/persona_activar.php', {
				pers_id: pers_id
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