<?php
	include_once 'conexion.php';

	class pacienteDAL {

		function getRow($pac_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_paciente_getRow('$pac_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($pac_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_paciente_getByID('$pac_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($pac_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_paciente_listcbo('$pac_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $pac_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_paciente_list('$b', '$pac_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(paciente $pac) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_paciente_insert(
					@pac_id,
					'$pac->pers_id');");

			$pac_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $pac_id;
		}

		public function actualizar(paciente $pac) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_paciente_update(
					'$pac->pac_id',
					'$pac->pers_id',
					'$pac->estado');");
			return $rs;
		}

		public function borrar($pac_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_paciente_delete('$pac_id');");
			return $rs;
		}

		public function activar($pac_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_paciente_activate('$pac_id');");
			return $rs;
		}
	}
