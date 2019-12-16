<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/cargo.php';
	include_once '../../../datos/cargoDAL.php';

	if (isset($_POST['carg_nombre'])){

		$carg_dal = new cargoDAL();
		$carg = new cargo();

		$carg->nombre = $_POST['carg_nombre'];

		$carg_rs = $carg_dal->registrar($carg);
		echo ($carg_rs > 0) ? $carg_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>