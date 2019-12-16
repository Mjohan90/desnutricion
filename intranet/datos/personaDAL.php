<?php
	include_once 'conexion.php';
	
	class personaDAL
	{
		
		function getRow($pers_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_persona_getRow('$pers_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		function getByID($pers_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_persona_getByID('$pers_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		public function listarcbo($pers_id = 0) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_persona_listcbo('$pers_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listar($b = '', $pers_estado = 1) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_persona_list('$b', '$pers_estado');");
			return $mysql->rsToArray($rs);
		}
		
		public function listForFamCbo($pers_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_persona_listForFamCbo('$pers_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listarFamiliares($pers_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_persona_listFamiliares('$pers_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function registrar(persona $pers) {
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
			$mysql->desconectar();
			return $pers_id;
		}
		
		public function registrarFamiliares($pers_id, $pers_familiares = []) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			
			$rs = $mysql->ejecutar("DELETE FROM parentesco WHERE parent_pers1_id = '$pers_id';");
			
			foreach ($pers_familiares as $parent) {
				$rs = $rs && $mysql->ejecutar("
					CALL pa_parentesco_insert(
						@parent_id,
						'$pers_id',
						'$parent->pers2_id',
						'$parent->tparent_id',
						'$parent->es_apoderado');");
			}
			
			$parent_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $parent_id;
		}
		
		public function actualizar(persona $pers) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
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
		
		public function borrar($pers_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_persona_delete('$pers_id');");
			return $rs;
		}
		
		public function activar($pers_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_persona_activate('$pers_id');");
			return $rs;
		}
	}
