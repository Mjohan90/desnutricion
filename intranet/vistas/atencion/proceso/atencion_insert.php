<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/atencion.php';
	include_once '../../../datos/atencionDAL.php';
	
	if (isset($_POST['atenc_pac_id'], $_POST['atenc_medico_id'], $_POST['atenc_espec_id'], $_POST['atenc_fecha_atenc'], $_POST['atenc_observacion'], $_POST['atenc_tratamiento'], $_POST['atenc_dieta'], $_POST['atenc_situacion'])) {
		
		$atenc_dal = new atencionDAL();
		$atenc     = new atencion();
		
		$atenc->pac_id      = $_POST['atenc_pac_id'];
		$atenc->medico_id   = $_POST['atenc_medico_id'];
		$atenc->espec_id    = $_POST['atenc_espec_id'];
		$atenc->fecha_atenc = $_POST['atenc_fecha_atenc'];
		$atenc->observacion = $_POST['atenc_observacion'];
		$atenc->tratamiento = $_POST['atenc_tratamiento'];
		$atenc->dieta       = $_POST['atenc_dieta'];
		$atenc->situacion   = $_POST['atenc_situacion'];
		$atenc->registra_id = $usu_id;
		
		$atenc_rs = $atenc_dal->registrar($atenc);
		echo ($atenc_rs > 0) ? $atenc_rs : 'No se ha podido registrar';
		
	} else {
		echo 'Ingrese datos validos';
	}
?>
