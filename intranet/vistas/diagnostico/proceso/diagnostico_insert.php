<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/diagnostico.php';
	include_once '../../../datos/diagnosticoDAL.php';

	if (isset($_POST['diag_atenc_id'], $_POST['diag_enferm_id'])){

		$diag_dal = new diagnosticoDAL();
		$diag = new diagnostico();

		$diag->atenc_id = $_POST['diag_atenc_id'];
		$diag->enferm_id = $_POST['diag_enferm_id'];

		$diag_rs = $diag_dal->registrar($diag);
		echo ($diag_rs > 0) ? $diag_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>