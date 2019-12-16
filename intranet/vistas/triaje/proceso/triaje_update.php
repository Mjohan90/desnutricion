<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/triaje.php';
	include_once '../../../datos/triajeDAL.php';

	if (isset($_POST['triaje_id'])) {

		$triaje_dal = new triajeDAL();
		$triaje = new triaje();

		$triaje_id = $_POST['triaje_id'];
		$triaje_row = $triaje_dal->getRow($triaje_id);

		$triaje->triaje_id	 = $triaje_id;
		$triaje->atenc_id	 = getField('triaje_atenc_id', $triaje_row);
		$triaje->var_id	 = getField('triaje_var_id', $triaje_row);
		$triaje->um_id	 = getField('triaje_um_id', $triaje_row);
		$triaje->valor	 = getField('triaje_valor', $triaje_row);
		$triaje->estado	 = getField('triaje_estado', $triaje_row);

		$triaje_rs = $triaje_dal->actualizar($triaje);
		echo ($triaje_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>