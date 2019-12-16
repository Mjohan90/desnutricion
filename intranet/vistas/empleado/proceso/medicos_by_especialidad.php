<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/empleadoDAL.php';
	$empl_dal = new empleadoDAL();
	
	$espec_id  = IssetOr($_POST['espec_id'], 0);
	$empl_list = $empl_dal->listarMedicosByEspecialidad($espec_id);
	
	echo json_encode($empl_list);
	
