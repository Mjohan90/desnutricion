<?php
	include_once 'conexion.php';

	class categvariableDAL {

		function getRow($catvar_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_categvariable_getRow('$catvar_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($catvar_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_categvariable_getByID('$catvar_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($catvar_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_categvariable_listcbo('$catvar_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $catvar_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_categvariable_list('$b', '$catvar_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(categvariable $catvar) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_categvariable_insert(
					@catvar_id,
					'$catvar->nombre');");

			$catvar_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $catvar_id;
		}

		public function actualizar(categvariable $catvar) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_categvariable_update(
					'$catvar->catvar_id',
					'$catvar->nombre',
					'$catvar->estado');");
			return $rs;
		}

		public function borrar($catvar_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_categvariable_delete('$catvar_id');");
			return $rs;
		}

		public function activar($catvar_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_categvariable_activate('$catvar_id');");
			return $rs;
		}
	}
