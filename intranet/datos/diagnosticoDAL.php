<?php
	include_once 'conexion.php';

	class diagnosticoDAL {

		function getRow($diag_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_diagnostico_getRow('$diag_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($diag_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_diagnostico_getByID('$diag_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($diag_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_diagnostico_listcbo('$diag_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $diag_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_diagnostico_list('$b', '$diag_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(diagnostico $diag) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_diagnostico_insert(
					@diag_id,
					'$diag->nombre',
					'$diag->tratamiento_sug',
					'$diag->dieta_sug');");

			$diag_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $diag_id;
		}

		public function actualizar(diagnostico $diag) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_diagnostico_update(
					'$diag->diag_id',
					'$diag->nombre',
					'$diag->tratamiento_sug',
					'$diag->dieta_sug',
					'$diag->estado');");
			return $rs;
		}

		public function borrar($diag_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_diagnostico_delete('$diag_id');");
			return $rs;
		}

		public function activar($diag_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_diagnostico_activate('$diag_id');");
			return $rs;
		}
	}
