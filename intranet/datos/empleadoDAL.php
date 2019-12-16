<?php
	include_once 'conexion.php';

	class empleadoDAL {

		function getRow($empl_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_empleado_getRow('$empl_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($empl_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_empleado_getByID('$empl_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($empl_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_empleado_listcbo('$empl_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $empl_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_empleado_list('$b', '$empl_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(empleado $empl) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_empleado_insert(
					@empl_id,
					'$empl->pers_id',
					'$empl->carg_id');");

			$empl_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $empl_id;
		}

		public function actualizar(empleado $empl) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_empleado_update(
					'$empl->empl_id',
					'$empl->pers_id',
					'$empl->carg_id',
					'$empl->estado');");
			return $rs;
		}

		public function borrar($empl_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_empleado_delete('$empl_id');");
			return $rs;
		}

		public function activar($empl_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_empleado_activate('$empl_id');");
			return $rs;
		}
	}
