<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/enfermedadDAL.php';
	$enferm_dal  = new enfermedadDAL();
	$enferm_list = $enferm_dal->listar();
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal  = new atencionDAL();
	$anio       = GetStrParam('anio');
	$b          = GetStrParam('b');
	$atenc_list = $atenc_dal->reporteDiagnosticos($anio, $b);
?>
<table id='tblreporte' class='datatable'>
    <tr>
        <td>Lugar</td>
		<?php foreach ($enferm_list as $enferm_row) { ?>
            <td><?= $enferm_row['enferm_nombre'] ?></td>
		<?php } ?>
        <td>Total</td>
    </tr>
	<?php foreach ($atenc_list as $atenc_row) { ?>
		<?php $total_region = $atenc_row['enferm_1'] + $atenc_row['enferm_2'] + $atenc_row['enferm_3'] + $atenc_row['enferm_4']; ?>
        <tr>
            <td><?= $atenc_row['ubig_nombre_full'] ?></td>
            <td><?= $atenc_row['enferm_1'] ?></td>
            <td><?= $atenc_row['enferm_2'] ?></td>
            <td><?= $atenc_row['enferm_3'] ?></td>
            <td><?= $atenc_row['enferm_4'] ?></td>
            <td class='bold'><?= int_nformat($total_region) ?></td>
        </tr>
	<?php } ?>
</table>
