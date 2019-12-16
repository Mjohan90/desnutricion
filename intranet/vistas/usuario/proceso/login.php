<?php
	include '../../../entidades/usuario.php';
	include '../../../datos/usuarioDAL.php';
	include '../../../datos/AppUtils.php';
	
	$dal_usu = new usuarioDAL();
	$usu     = new usuario();
	
	$usu->nombre     = $_POST['nombre'];
	$usu->contrasena = $_POST['contrasena'];
	
	// Logear usuario
	$row = $dal_usu->login($usu->nombre, $usu->contrasena);
	
	if ($row) {
		if ($row['usu_estado'] == ACTIVO) {
			session_start();
			$_SESSION['auth.usu_id']          = $row['usu_id'];
			$_SESSION['auth.pers_id']         = $row['pers_id'];
			$_SESSION['auth.empl_id']         = $row['empl_id'];
			$_SESSION['auth.rol_id']          = $row['rol_id'];
			$_SESSION['auth.rol_nombre']      = $row['rol_nombre'];
			$_SESSION['auth.pers_nombres']    = $row['pers_nombre'];
			$_SESSION['auth.pers_ap_paterno'] = $row['pers_ap_paterno'];
			$_SESSION['auth.pers_ap_materno'] = $row['pers_ap_materno'];
			
			echo $row['usu_id'];
		} else {
			echo 'Cuenta de usuario deshabilitada';
		}
	} else {
		echo 'Usuario no válido';
	}
