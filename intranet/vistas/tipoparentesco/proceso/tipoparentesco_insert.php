<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/tipoparentesco.php';
	include_once '../../../datos/tipoparentescoDAL.php';

	if (isset($_POST['tparent_nombre'])){

		$tparent_dal = new tipoparentescoDAL();
		$tparent = new tipoparentesco();

		$tparent->nombre = $_POST['tparent_nombre'];

		$tparent_rs = $tparent_dal->registrar($tparent);
		echo ($tparent_rs > 0) ? $tparent_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>