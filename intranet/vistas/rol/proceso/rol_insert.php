<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/rol.php';
	include_once '../../../datos/rolDAL.php';

	if (isset($_POST['rol_nombre'])){

		$rol_dal = new rolDAL();
		$rol = new rol();

		$rol->nombre = $_POST['rol_nombre'];

		$rol_rs = $rol_dal->registrar($rol);
		echo ($rol_rs > 0) ? $rol_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>