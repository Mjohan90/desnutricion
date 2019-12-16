<?php
	include_once 'conexion.php';
	
	class empleadoDAL
	{
		
		function getRow($empl_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_empleado_getRow('$empl_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		function getByID($empl_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_empleado_getByID('$empl_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		public function listarcbo($empl_id = 0) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_empleado_listcbo('$empl_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listarmedicos($empl_id = 0) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_empleado_listmedicos('$empl_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listarMedicosByEspecialidad($espec_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_empleado_listMedicosByEspecialidad('$espec_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listar($b = '', $empl_estado = 1) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_empleado_list('$b', '$empl_estado');");
			return $mysql->rsToArray($rs);
		}
		
		public function registrar(empleado $empl, persona $pers) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			
			$rs = $mysql->ejecutar("
				CALL pa_persona_insert(
					@pers_id,
					'$pers->nombre',
					'$pers->snombre',
					'$pers->ap_paterno',
					'$pers->ap_materno',
					'$pers->tdi_id',
					'$pers->tdi_nro',
					'$pers->sexo',
					'$pers->fecha_nac',
					'$pers->email',
					'$pers->celular',
					'$pers->telefono');");
			
			$pers_id = $rs ? $mysql->getLastID() : 0;
			
			$rs = $mysql->ejecutar("
				CALL pa_empleado_insert(
					@empl_id,
					'$pers_id',
					'$empl->carg_id',
					'$empl->espec_id');");
			
			$empl_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $empl_id;
		}
		
		public function actualizar(empleado $empl, persona $pers) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				CALL pa_empleado_update(
					'$empl->empl_id',
					'$empl->pers_id',
					'$empl->carg_id',
					'$empl->espec_id');");
			
			$rs = $mysql->ejecutar("
				CALL pa_persona_update(
					'$pers->pers_id',
					'$pers->nombre',
					'$pers->snombre',
					'$pers->ap_paterno',
					'$pers->ap_materno',
					'$pers->tdi_id',
					'$pers->tdi_nro',
					'$pers->sexo',
					'$pers->fecha_nac',
					'$pers->email',
					'$pers->celular',
					'$pers->telefono');");
			return $rs;
		}
		
		public function borrar($empl_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_empleado_delete('$empl_id');");
			return $rs;
		}
		
		public function activar($empl_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_empleado_activate('$empl_id');");
			return $rs;
		}
	}
