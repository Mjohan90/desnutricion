<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/personaDAL.php';
	
	$pers_dal = new personaDAL();
	
	$pers_id   = $_POST['pers_id'];
	$pers_list = $pers_dal->listForFamCbo($pers_id);
	
	echo json_encode($pers_list);
	
	
