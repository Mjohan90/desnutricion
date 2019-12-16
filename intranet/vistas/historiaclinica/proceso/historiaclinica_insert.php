<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/historiaclinica.php';
	include_once '../../../datos/historiaclinicaDAL.php';

	if (isset($_POST['hc_pac_id'], $_POST['hc_fecha_suceso'], $_POST['hc_comentario'], $_POST['hc_atenc_id_ref'])){

		$hc_dal = new historiaclinicaDAL();
		$hc = new historiaclinica();

		$hc->pac_id = $_POST['hc_pac_id'];
		$hc->fecha_suceso = $_POST['hc_fecha_suceso'];
		$hc->comentario = $_POST['hc_comentario'];
		$hc->atenc_id_ref = $_POST['hc_atenc_id_ref'];

		$hc_rs = $hc_dal->registrar($hc);
		echo ($hc_rs > 0) ? $hc_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>