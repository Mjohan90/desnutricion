<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/paciente.php';
	include_once '../../../entidades/persona.php';
	include_once '../../../datos/pacienteDAL.php';
	include_once '../../../datos/personaDAL.php';
	
	$dal_pac  = new pacienteDAL();
	$dal_pers = new personaDAL();
	
	if (IssetPost(['pac_id', 'pers_id'])) {
		$pac_id  = $_POST['pac_id'];
		$pers_id = $_POST['pers_id'];
		
		$pac_row  = $dal_pac->getRow($pac_id);
		$pers_row = $dal_pers->getRow($pers_id);
		
		$pac          = new paciente();
		$pac->pac_id  = $pac_id;
		$pac->pers_id = getField('pers_id', $pac_row);
		$pac->estado  = getField('pac_estado', $pac_row);
		
		$pers             = new persona();
		$pers->pers_id    = $pers_id;
		$pers->nombre     = getField('pers_nombre', $pers_row);
		$pers->snombre    = getField('pers_snombre', $pers_row);
		$pers->ap_paterno = getField('pers_ap_paterno', $pers_row);
		$pers->ap_materno = getField('pers_ap_materno', $pers_row);
		$pers->tdi_id     = getField('pers_tdi_id', $pers_row);
		$pers->tdi_nro    = getField('pers_tdi_nro', $pers_row);
		$pers->sexo       = getField('pers_sexo', $pers_row);
		$pers->fecha_nac  = getField('pers_fecha_nac', $pers_row);
		$pers->email      = getField('pers_email', $pers_row);
		$pers->celular    = getField('pers_celular', $pers_row);
		$pers->telefono   = getField('pers_telefono', $pers_row);
		$pers->estado     = getField('pers_estado', $pers_row);
		
		$pac_rs = $dal_pac->actualizar($pac, $pers);
		echo ($pac_rs == 1) ? 1 : 'No se ha podido actualizar';
		
	} else {
		echo 'Ingrese datos validos';
	}
	
	function getField($campo, $row) {
		return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
	}
