<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/variableDAL.php';

	if (isset($_POST['var_id'])){
		$var_dal = new variableDAL();

		$var_id = $_POST['var_id'];
		$var_rs = $var_dal->borrar($var_id);

		echo ($var_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
