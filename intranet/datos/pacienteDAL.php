<?php
	include_once 'conexion.php';
	
	class pacienteDAL
	{
		
		function getRow($pac_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_paciente_getRow('$pac_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		function getByID($pac_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_paciente_getByID('$pac_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		function getByTdi($tdi_id, $tdi_nro) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_paciente_getByTdi('$tdi_id', '$tdi_nro');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		public function listarcbo($pac_id = 0) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_paciente_listcbo('$pac_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listar($b = '', $pac_estado = 1) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_paciente_list('$b', '$pac_estado');");
			return $mysql->rsToArray($rs);
		}
		
		public function registrar(paciente $pac, persona $pers) {
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
					'$pers->telefono',
					'$pers->ubig_id',
					'$pers->direccion');");
			
			$pers_id = $rs ? $mysql->getLastID() : 0;
			
			$rs = $mysql->ejecutar("
				CALL pa_paciente_insert(
					@pac_id,
					'$pers_id');");
			
			$pac_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $pac_id;
		}
		
		public function actualizar(paciente $pac, persona $pers) {
			$mysql = new Conexion();
			
			$rs = $mysql->ejecutar("
				CALL pa_paciente_update(
					'$pac->pac_id',
					'$pac->pers_id');");
			
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
					'$pers->telefono',
					'$pers->ubig_id',
					'$pers->direccion');");
			
			return $rs;
		}
		
		public function borrar($pac_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_paciente_delete('$pac_id');");
			return $rs;
		}
		
		public function activar($pac_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_paciente_activate('$pac_id');");
			return $rs;
		}
	}
