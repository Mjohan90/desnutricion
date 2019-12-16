<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/claseenfermedad.php';
	include_once '../../../datos/claseenfermedadDAL.php';

	if (isset($_POST['clsenferm_id'], $_POST['clsenferm_nombre'])){

		$clsenferm_dal = new claseenfermedadDAL();
		$clsenferm = new claseenfermedad();

		$clsenferm->id = $_POST['clsenferm_id'];
		$clsenferm->nombre = $_POST['clsenferm_nombre'];

		$clsenferm_rs = $clsenferm_dal->registrar($clsenferm);
		echo ($clsenferm_rs > 0) ? $clsenferm_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>