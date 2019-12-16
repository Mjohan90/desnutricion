<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/usuario.php';
	include_once '../../../datos/usuarioDAL.php';

	if (isset($_POST['usu_nombre'], $_POST['usu_contrasena'], $_POST['usu_empl_id'], $_POST['usu_rol_id'])){

		$usu_dal = new usuarioDAL();
		$usu = new usuario();

		$usu->nombre = $_POST['usu_nombre'];
		$usu->contrasena = $_POST['usu_contrasena'];
		$usu->empl_id = $_POST['usu_empl_id'];
		$usu->rol_id = $_POST['usu_rol_id'];

		$usu_rs = $usu_dal->registrar($usu);
		echo ($usu_rs > 0) ? $usu_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>