<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/indicador.php';
	include_once '../../../datos/indicadorDAL.php';

	if (isset($_POST['indic_nombre'], $_POST['indic_var1_id'], $_POST['indic_var2_id'])){

		$indic_dal = new indicadorDAL();
		$indic = new indicador();

		$indic->nombre = $_POST['indic_nombre'];
		$indic->var1_id = $_POST['indic_var1_id'];
		$indic->var2_id = $_POST['indic_var2_id'];

		$indic_rs = $indic_dal->registrar($indic);
		echo ($indic_rs > 0) ? $indic_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>