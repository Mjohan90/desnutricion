<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/variable.php';
	include_once '../../../datos/variableDAL.php';

	if (isset($_POST['var_id'])) {

		$var_dal = new variableDAL();
		$var = new variable();

		$var_id = $_POST['var_id'];
		$var_row = $var_dal->getRow($var_id);

		$var->var_id	 = $var_id;
		$var->catvar_id	 = getField('var_catvar_id', $var_row);
		$var->nombre	 = getField('var_nombre', $var_row);
		$var->um_id	 = getField('var_um_id', $var_row);
		$var->tipo_var	 = getField('var_tipo_var', $var_row);
		$var->estado	 = getField('var_estado', $var_row);

		$var_rs = $var_dal->actualizar($var);
		echo ($var_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>