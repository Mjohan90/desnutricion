<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/especialidad.php';
	include_once '../../../datos/especialidadDAL.php';

	if (isset($_POST['espec_nombre'])){

		$espec_dal = new especialidadDAL();
		$espec = new especialidad();

		$espec->nombre = $_POST['espec_nombre'];

		$espec_rs = $espec_dal->registrar($espec);
		echo ($espec_rs > 0) ? $espec_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>