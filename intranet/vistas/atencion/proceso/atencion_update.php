<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/atencion.php';
	include_once '../../../datos/atencionDAL.php';

	if (isset($_POST['atenc_id'])) {

		$atenc_dal = new atencionDAL();
		$atenc = new atencion();

		$atenc_id = $_POST['atenc_id'];
		$atenc_row = $atenc_dal->getRow($atenc_id);

		$atenc->atenc_id	 = $atenc_id;
		$atenc->pac_id	 = getField('atenc_pac_id', $atenc_row);
		$atenc->medico_id	 = getField('atenc_medico_id', $atenc_row);
		$atenc->espec_id	 = getField('atenc_espec_id', $atenc_row);
		$atenc->fecha_atenc	 = getField('atenc_fecha_atenc', $atenc_row);
		$atenc->observacion	 = getField('atenc_observacion', $atenc_row);
		$atenc->tratamiento	 = getField('atenc_tratamiento', $atenc_row);
		$atenc->dieta	 = getField('atenc_dieta', $atenc_row);
		$atenc->situacion	 = getField('atenc_situacion', $atenc_row);
		$atenc->estado	 = getField('atenc_estado', $atenc_row);

		$atenc_rs = $atenc_dal->actualizar($atenc);
		echo ($atenc_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>