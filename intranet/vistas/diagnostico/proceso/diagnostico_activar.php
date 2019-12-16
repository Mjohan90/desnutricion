<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/diagnosticoDAL.php';

	if (isset($_POST['diag_id'])){
		$diag_dal = new diagnosticoDAL();

		$diag_id = $_POST['diag_id'];
		$diag_rs = $diag_dal->activar($diag_id);

		echo ($diag_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
