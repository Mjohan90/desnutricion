<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/percentilDAL.php';
	$percent_dal = new percentilDAL();
	$b = GetStringParam('b');
	$percent_list = $percent_dal->listar($b);
?>
<table id='tblpercentil' class='datatable'>
	<tr>
		<th>ID</th>
		<th>Sexo</th>
		<th>Indicador</th>
		<th>Var1 valor</th>
		<th>Var2 valor</th>
		<th>Percentil</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($percent_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['percent_id']); ?></td>
		<td class='txt_center'><?php echo $row['percent_sexo']; ?></td>
		<td><?php echo $row['indic_nombre']; ?></td>
		<td class='txt_right'> <?php echo $row['percent_var1_valor']; ?></td>
		<td class='txt_right'> <?php echo $row['percent_var2_valor']; ?></td>
		<td class='txt_right'> <?php echo $row['percent_percentil']; ?></td>
		<td hidden><?php echo $row['percent_estado']; ?></td>
		<td class='txt_center'><a href='#' onclick="percent_editar('<?php echo $row['percent_id']; ?>');">Editar</a></td>
		<td class='txt_center'><a href='#' onclick="percent_borrar('<?php echo $row['percent_id']; ?>');">Borrar</a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function percent_editar(percent_id) {
		performLoad('vistas/percentil/percentilUpd.php?percent_id=' + percent_id);
	}
	function percent_borrar(percent_id) {
		if (confirm("¿Borrar percentil?")) {
			$.post('vistas/percentil/proceso/percentil_borrar.php', {
				percent_id: percent_id
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
	function percent_activar(percent_id) {
		if (confirm("¿Activar percentil?")) {
			$.post('vistas/percentil/proceso/percentil_activar.php', {
				percent_id: percent_id
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