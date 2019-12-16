<?php
	include_once 'conexion.php';

	class parentescoDAL {

		function getRow($parent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_parentesco_getRow('$parent_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($parent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_parentesco_getByID('$parent_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($parent_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_parentesco_listcbo('$parent_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $parent_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_parentesco_list('$b', '$parent_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(parentesco $parent) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_parentesco_insert(
					@parent_id,
					'$parent->pers1_id',
					'$parent->pers2_id',
					'$parent->tparent_id',
					'$parent->es_apoderado');");

			$parent_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $parent_id;
		}

		public function actualizar(parentesco $parent) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_parentesco_update(
					'$parent->parent_id',
					'$parent->pers1_id',
					'$parent->pers2_id',
					'$parent->tparent_id',
					'$parent->es_apoderado');");
			return $rs;
		}

		public function borrar($parent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_parentesco_delete('$parent_id');");
			return $rs;
		}

		public function activar($parent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_parentesco_activate('$parent_id');");
			return $rs;
		}
	}
