<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/triaje.php';
	include_once '../../../datos/triajeDAL.php';
	$triaje_dal = new triajeDAL();
	
	if (isset($_POST['triaje_atenc_id'])) {
		$atenc_id       = $_POST['triaje_atenc_id'];
		$pac_sexo       = $_POST['pac_sexo'];
		$pac_edad_meses = $_POST['pac_edad_meses'];
		$triaje_prod    = $_SESSION["triaje{$atenc_id}.var"];
		$triaje_list    = [];
		
		foreach ($triaje_prod as $det) {
			$triaje            = new triaje();
			$triaje->triaje_id = $det['triaje_id'];
			$triaje->atenc_id  = $atenc_id;
			$triaje->var_id    = $det['var_id'];
			$triaje->um_id     = $det['triaje_um_id'];
			$triaje->valor     = $det['triaje_valor'];
			$triaje_list[]     = $triaje;
		}
		
		$triaje_rs = $triaje_dal->registrarList($pac_sexo, $pac_edad_meses, $atenc_id, $triaje_list);
		echo ($triaje_rs > 0) ? $triaje_rs : 'No se ha podido registrar';
		
	} else {
		echo 'Ingrese datos validos';
	}
?>
