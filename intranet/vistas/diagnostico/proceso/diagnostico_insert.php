<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/diagnostico.php';
	include_once '../../../datos/diagnosticoDAL.php';

	if (isset($_POST['diag_nombre'], $_POST['diag_tratamiento_sug'], $_POST['diag_dieta_sug'])){

		$diag_dal = new diagnosticoDAL();
		$diag = new diagnostico();

		$diag->nombre = $_POST['diag_nombre'];
		$diag->tratamiento_sug = $_POST['diag_tratamiento_sug'];
		$diag->dieta_sug = $_POST['diag_dieta_sug'];

		$diag_rs = $diag_dal->registrar($diag);
		echo ($diag_rs > 0) ? $diag_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>