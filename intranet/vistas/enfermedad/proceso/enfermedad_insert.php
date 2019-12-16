<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/enfermedad.php';
	include_once '../../../datos/enfermedadDAL.php';

	if (isset($_POST['enferm_nombre'], $_POST['enferm_tratamiento_sug'], $_POST['enferm_dieta_sug'])){

		$enferm_dal = new enfermedadDAL();
		$enferm = new enfermedad();

		$enferm->nombre = $_POST['enferm_nombre'];
		$enferm->tratamiento_sug = $_POST['enferm_tratamiento_sug'];
		$enferm->dieta_sug = $_POST['enferm_dieta_sug'];

		$enferm_rs = $enferm_dal->registrar($enferm);
		echo ($enferm_rs > 0) ? $enferm_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>