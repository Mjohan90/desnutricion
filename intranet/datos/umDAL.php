<?php
	include_once 'conexion.php';

	class umDAL {

		function getRow($um_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_um_getRow('$um_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($um_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_um_getByID('$um_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($um_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_um_listcbo('$um_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $um_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_um_list('$b', '$um_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(um $um) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_um_insert(
					@um_id,
					'$um->nombre',
					'$um->abrev');");

			$um_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $um_id;
		}

		public function actualizar(um $um) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_um_update(
					'$um->um_id',
					'$um->nombre',
					'$um->abrev');");
			return $rs;
		}

		public function borrar($um_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_um_delete('$um_id');");
			return $rs;
		}

		public function activar($um_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_um_activate('$um_id');");
			return $rs;
		}
	}
