<?php
	include_once 'conexion.php';

	class enfermedadDAL {

		function getRow($enferm_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_enfermedad_getRow('$enferm_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($enferm_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_enfermedad_getByID('$enferm_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($enferm_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_enfermedad_listcbo('$enferm_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $enferm_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_enfermedad_list('$b', '$enferm_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(enfermedad $enferm) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_enfermedad_insert(
					@enferm_id,
					'$enferm->nombre',
					'$enferm->clsenferm_id',
					'$enferm->tratamiento_sug',
					'$enferm->dieta_sug');");

			$enferm_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $enferm_id;
		}

		public function actualizar(enfermedad $enferm) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_enfermedad_update(
					'$enferm->enferm_id',
					'$enferm->nombre',
					'$enferm->clsenferm_id',
					'$enferm->tratamiento_sug',
					'$enferm->dieta_sug',
					'$enferm->estado');");
			return $rs;
		}

		public function borrar($enferm_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_enfermedad_delete('$enferm_id');");
			return $rs;
		}

		public function activar($enferm_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_enfermedad_activate('$enferm_id');");
			return $rs;
		}
	}
