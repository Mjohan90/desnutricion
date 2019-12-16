<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/pacienteDAL.php';
	
	if (isset($_POST['tdi_id']) && isset($_POST['tdi_nro'])) {
		$pac_dal = new pacienteDAL();
		
		$tdi_id  = $_POST['tdi_id'];
		$tdi_nro = $_POST['tdi_nro'];
		$pac_rs  = $pac_dal->getByTdi($tdi_id, $tdi_nro);
		
		echo json_encode($pac_rs);
		
	} else {
		echo 'Ingrese datos validos';
	}
