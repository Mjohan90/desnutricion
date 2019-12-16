<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/claseenfermedad.php';
	include_once '../../../datos/claseenfermedadDAL.php';

	if (isset($_POST['clsenferm_id'])) {

		$clsenferm_dal = new claseenfermedadDAL();
		$clsenferm = new claseenfermedad();

		$clsenferm_id = $_POST['clsenferm_id'];
		$clsenferm_row = $clsenferm_dal->getRow($clsenferm_id);

		$clsenferm->id	 = $clsenferm_id;
		$clsenferm->nombre	 = getField('clsenferm_nombre', $clsenferm_row);
		$clsenferm->estado	 = getField('clsenferm_estado', $clsenferm_row);

		$clsenferm_rs = $clsenferm_dal->actualizar($clsenferm);
		echo ($clsenferm_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>