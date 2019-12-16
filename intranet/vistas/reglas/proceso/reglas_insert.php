<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/reglas.php';
	include_once '../../../datos/reglasDAL.php';

	if (isset($_POST['regla_indic1_id'], $_POST['regla_indic2_id'], $_POST['regla_formula'], $_POST['regla_diag_id'])){

		$regla_dal = new reglasDAL();
		$regla = new reglas();

		$regla->indic1_id = $_POST['regla_indic1_id'];
		$regla->indic2_id = $_POST['regla_indic2_id'];
		$regla->formula = $_POST['regla_formula'];
		$regla->diag_id = $_POST['regla_diag_id'];

		$regla_rs = $regla_dal->registrar($regla);
		echo ($regla_rs > 0) ? $regla_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>