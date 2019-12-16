<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/persona.php';
	include_once '../../../datos/personaDAL.php';

	if (isset($_POST['pers_id'])) {

		$pers_dal = new personaDAL();
		$pers = new persona();

		$pers_id = $_POST['pers_id'];
		$pers_row = $pers_dal->getRow($pers_id);

		$pers->pers_id	 = $pers_id;
		$pers->nombre	 = getField('pers_nombre', $pers_row);
		$pers->snombre	 = getField('pers_snombre', $pers_row);
		$pers->ap_paterno	 = getField('pers_ap_paterno', $pers_row);
		$pers->ap_materno	 = getField('pers_ap_materno', $pers_row);
		$pers->tdi_id	 = getField('pers_tdi_id', $pers_row);
		$pers->tdi_nro	 = getField('pers_tdi_nro', $pers_row);
		$pers->sexo	 = getField('pers_sexo', $pers_row);
		$pers->fecha_nac	 = getField('pers_fecha_nac', $pers_row);
		$pers->email	 = getField('pers_email', $pers_row);
		$pers->celular	 = getField('pers_celular', $pers_row);
		$pers->telefono	 = getField('pers_telefono', $pers_row);
		$pers->estado	 = getField('pers_estado', $pers_row);

		$pers_rs = $pers_dal->actualizar($pers);
		echo ($pers_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>