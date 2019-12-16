<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/tipodocidentDAL.php';
	$tdi_dal = new tipodocidentDAL();
	$b = GetStringParam('b');
	$tdi_list = $tdi_dal->listar($b);
?>
<table id='tbltipodocident' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Abrev</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($tdi_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['tdi_id']); ?></td>
		<td><?php echo $row['tdi_nombre']; ?></td>
		<td><?php echo $row['tdi_abrev']; ?></td>
		<td hidden><?php echo $row['tdi_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="tdi_editar('<?php echo $row['tdi_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="tdi_borrar('<?php echo $row['tdi_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function tdi_editar(tdi_id) {
		performLoad('vistas/tipodocident/tipodocidentUpd.php?tdi_id=' + tdi_id);
	}
	function tdi_borrar(tdi_id) {
		if (confirm("¿Borrar tipo documento de identidad?")) {
			$.post('vistas/tipodocident/proceso/tipodocident_borrar.php', {
				tdi_id: tdi_id
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
	function tdi_activar(tdi_id) {
		if (confirm("¿Activar tipo documento de identidad?")) {
			$.post('vistas/tipodocident/proceso/tipodocident_activar.php', {
				tdi_id: tdi_id
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