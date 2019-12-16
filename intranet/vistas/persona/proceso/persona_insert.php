<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/persona.php';
	include_once '../../../datos/personaDAL.php';
	
	if (isset($_POST['pers_nombre'], $_POST['pers_snombre'], $_POST['pers_ap_paterno'], $_POST['pers_ap_materno'], $_POST['pers_tdi_id'], $_POST['pers_tdi_nro'], $_POST['pers_sexo'], $_POST['pers_fecha_nac'], $_POST['pers_email'], $_POST['pers_celular'], $_POST['pers_telefono'])) {
		
		$pers_dal = new personaDAL();
		$pers     = new persona();
		
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
		
		$pers_rs = $pers_dal->registrar($pers);
		echo ($pers_rs > 0) ? $pers_rs : 'No se ha podido registrar';
		
	} else {
		echo 'Ingrese datos validos';
	}
?>
