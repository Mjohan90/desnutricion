<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/rol.php';
	include_once '../../../datos/rolDAL.php';

	if (isset($_POST['rol_id'])) {

		$rol_dal = new rolDAL();
		$rol = new rol();

		$rol_id = $_POST['rol_id'];
		$rol_row = $rol_dal->getRow($rol_id);

		$rol->rol_id	 = $rol_id;
		$rol->nombre	 = getField('rol_nombre', $rol_row);
		$rol->estado	 = getField('rol_estado', $rol_row);

		$rol_rs = $rol_dal->actualizar($rol);
		echo ($rol_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>