<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$UsuarioId = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/paciente.php';
	include_once '../../../entidades/persona.php';
	include_once '../../../datos/pacienteDAL.php';
	
	if (IssetPost([
		'pac_pers_id',
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
		'pers_telefono',
		'pers_ubig_id',
		'pers_direccion',
	])) {
		$pac          = new paciente();
		$pac->pers_id = $_POST['pac_pers_id'];
		
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
		$pers->ubig_id    = $_POST['pers_ubigeo'];
		$pers->direccion  = $_POST['pers_direccion'];
		
		$dal_pac = new pacienteDAL();
		$pac_rs  = $dal_pac->registrar($pac, $pers);
		echo ($pac_rs > 0) ? 1 : 'No se ha podido registrar';
		
	} else {
		echo 'Ingrese datos validos';
	}
?>