<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/categvariable.php';
	include_once '../../../datos/categvariableDAL.php';

	if (isset($_POST['catvar_id'])) {

		$catvar_dal = new categvariableDAL();
		$catvar = new categvariable();

		$catvar_id = $_POST['catvar_id'];
		$catvar_row = $catvar_dal->getRow($catvar_id);

		$catvar->catvar_id	 = $catvar_id;
		$catvar->nombre	 = getField('catvar_nombre', $catvar_row);
		$catvar->estado	 = getField('catvar_estado', $catvar_row);

		$catvar_rs = $catvar_dal->actualizar($catvar);
		echo ($catvar_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>