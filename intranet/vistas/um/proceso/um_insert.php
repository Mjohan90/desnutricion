<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/um.php';
	include_once '../../../datos/umDAL.php';

	if (isset($_POST['um_nombre'], $_POST['um_abrev'])){

		$um_dal = new umDAL();
		$um = new um();

		$um->nombre = $_POST['um_nombre'];
		$um->abrev = $_POST['um_abrev'];

		$um_rs = $um_dal->registrar($um);
		echo ($um_rs > 0) ? $um_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>