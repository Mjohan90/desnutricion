<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/resultado.php';
	include_once '../../../datos/resultadoDAL.php';

	if (isset($_POST['result_atenc_id'], $_POST['result_diag_id'])){

		$result_dal = new resultadoDAL();
		$result = new resultado();

		$result->atenc_id = $_POST['result_atenc_id'];
		$result->diag_id = $_POST['result_diag_id'];

		$result_rs = $result_dal->registrar($result);
		echo ($result_rs > 0) ? $result_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>