<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/enfermedad.php';
	include_once '../../../datos/enfermedadDAL.php';

	if (isset($_POST['enferm_id'])) {

		$enferm_dal = new enfermedadDAL();
		$enferm = new enfermedad();

		$enferm_id = $_POST['enferm_id'];
		$enferm_row = $enferm_dal->getRow($enferm_id);

		$enferm->enferm_id	 = $enferm_id;
		$enferm->nombre	 = getField('enferm_nombre', $enferm_row);
		$enferm->clsenferm_id	 = getField('enferm_clsenferm_id', $enferm_row);
		$enferm->tratamiento_sug	 = getField('enferm_tratamiento_sug', $enferm_row);
		$enferm->dieta_sug	 = getField('enferm_dieta_sug', $enferm_row);
		$enferm->estado	 = getField('enferm_estado', $enferm_row);

		$enferm_rs = $enferm_dal->actualizar($enferm);
		echo ($enferm_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>