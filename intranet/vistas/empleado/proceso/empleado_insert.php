<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/empleado.php';
	include_once '../../../entidades/persona.php';
	include_once '../../../datos/empleadoDAL.php';
	
	if (IssetPost([
		'empl_pers_id',
		'empl_carg_id',
		'pers_nombre',
		'pers_snombre',
		'pers_ap_paterno',
		'pers_ap_materno',
		'pers_tdi_id',
		'pers_tdi_nro',
		'pers_sexo',
		'pers_fecha_nac',
		'pers_email',
		'pers_celular',
		'pers_telefono'
	])) {
		$pers             = new persona();
		$pers->nombre     = $_POST['pers_nombre'];
		$pers->snombre    = $_POST['pers_snombre'];
		$pers->ap_paterno = $_POST['pers_ap_paterno'];
		$pers->ap_materno = $_POST['pers_ap_materno'];
		$pers->tdi_id     = $_POST['pers_tdi_id'];
		$pers->tdi_nro    = $_POST['pers_tdi_nro'];
		$pers->sexo       = $_POST['pers_sexo'];
		$pers->fecha_nac  = $_POST['pers_fecha_nac'];
		$pers->email      = $_POST['pers_email'];
		$pers->celular    = $_POST['pers_celular'];
		$pers->telefono   = $_POST['pers_telefono'];
		
		$empl          = new empleado();
		$empl->pers_id = $_POST['empl_pers_id'];
		$empl->carg_id = $_POST['empl_carg_id'];
		
		$empl_dal = new empleadoDAL();
		$empl_rs  = $empl_dal->registrar($empl, $pers);
		echo ($empl_rs > 0) ? $empl_rs : 'No se ha podido registrar';
		
	} else {
		echo 'Ingrese datos validos';
	}
?>
