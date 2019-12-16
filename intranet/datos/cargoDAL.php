<?php
	include_once 'conexion.php';

	class cargoDAL {

		function getRow($carg_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_cargo_getRow('$carg_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($carg_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_cargo_getByID('$carg_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($carg_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_cargo_listcbo('$carg_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $carg_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_cargo_list('$b', '$carg_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(cargo $carg) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_cargo_insert(
					@carg_id,
					'$carg->nombre');");

			$carg_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $carg_id;
		}

		public function actualizar(cargo $carg) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_cargo_update(
					'$carg->carg_id',
					'$carg->nombre');");
			return $rs;
		}

		public function borrar($carg_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_cargo_delete('$carg_id');");
			return $rs;
		}

		public function activar($carg_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_cargo_activate('$carg_id');");
			return $rs;
		}
	}
