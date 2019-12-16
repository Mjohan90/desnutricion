<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
	
	include_once '../../../entidades/persona.php';
	include_once '../../../datos/personaDAL.php';
	// proceso:
	include_once '../../../entidades/parentesco.php';
	include_once '../../../datos/parentescoDAL.php';
	
	$pers_dal = new personaDAL();
	$pers_id  = IssetOr($_POST['pers_id'], 0);
	
	$parent_fam = $_SESSION["parent.pers{$pers_id}"];
	
	$familiares = [];
	foreach ($parent_fam as $det) {
		$parent               = new parentesco();
		$parent->parent_id    = $det['parent_id'];
		$parent->pers1_id     = $det['parent_pers1_id'];
		$parent->pers2_id     = $det['parent_pers2_id'];
		$parent->tparent_id   = $det['parent_tparent_id'];
		$parent->es_apoderado = $det['parent_es_apoderado'];
		$parent->estado       = $det['parent_estado'];
		$familiares[]         = $parent;
	}
	
	echo $pers_dal->registrarFamiliares($pers_id, $familiares);
	
