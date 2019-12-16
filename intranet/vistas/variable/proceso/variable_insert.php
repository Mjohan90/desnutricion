<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/variable.php';
	include_once '../../../datos/variableDAL.php';

	if (isset($_POST['var_catvar_id'], $_POST['var_nombre'], $_POST['var_um_id'], $_POST['var_tipo_var'], $_POST['var_tipo_escala'], $_POST['var_formula'])){

		$var_dal = new variableDAL();
		$var = new variable();

		$var->catvar_id = $_POST['var_catvar_id'];
		$var->nombre = $_POST['var_nombre'];
		$var->um_id = $_POST['var_um_id'];
		$var->tipo_var = $_POST['var_tipo_var'];
		$var->tipo_escala = $_POST['var_tipo_escala'];
		$var->formula = $_POST['var_formula'];

		$var_rs = $var_dal->registrar($var);
		echo ($var_rs > 0) ? $var_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>