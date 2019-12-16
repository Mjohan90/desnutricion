<?php
	include_once 'conexion.php';

	class claseenfermedadDAL {

		function getRow($clsenferm_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_claseenfermedad_getRow('$clsenferm_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($clsenferm_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_claseenfermedad_getByID('$clsenferm_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($clsenferm_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_claseenfermedad_listcbo('$clsenferm_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $clsenferm_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_claseenfermedad_list('$b', '$clsenferm_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(claseenfermedad $clsenferm) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_claseenfermedad_insert(
					'$clsenferm->id',
					'$clsenferm->nombre');");
			$mysql->desconectar();
			return $rs;
		}

		public function actualizar(claseenfermedad $clsenferm) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_claseenfermedad_update(
					'$clsenferm->id',
					'$clsenferm->nombre',
					'$clsenferm->estado');");
			return $rs;
		}

		public function borrar($clsenferm_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_claseenfermedad_delete('$clsenferm_id');");
			return $rs;
		}

		public function activar($clsenferm_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_claseenfermedad_activate('$clsenferm_id');");
			return $rs;
		}
	}
