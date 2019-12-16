<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal  = new atencionDAL();
	$b          = GetStrParam('b');
	$atenc_list = $atenc_dal->listar($b);
?>
<table id='tblreporte' class='datatable'>
	<tr>
	
	</tr>
	<?php foreach ($atenc_list as $row) { ?>
		<tr>
		
		</tr>
	<?php } ?>
</table>