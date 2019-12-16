<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/categvariable.php';
	include_once '../../../datos/categvariableDAL.php';

	if (isset($_POST['catvar_nombre'])){

		$catvar_dal = new categvariableDAL();
		$catvar = new categvariable();

		$catvar->nombre = $_POST['catvar_nombre'];

		$catvar_rs = $catvar_dal->registrar($catvar);
		echo ($catvar_rs > 0) ? $catvar_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>