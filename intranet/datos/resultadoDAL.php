<?php
	include_once 'conexion.php';

	class resultadoDAL {

		function getRow($result_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_resultado_getRow('$result_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($result_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_resultado_getByID('$result_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($result_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_resultado_listcbo('$result_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '') {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_resultado_list('$b');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(resultado $result) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_resultado_insert(
					@result_id,
					'$result->atenc_id',
					'$result->diag_id');");

			$result_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $result_id;
		}

		public function actualizar(resultado $result) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_resultado_update(
					'$result->result_id',
					'$result->atenc_id',
					'$result->diag_id');");
			return $rs;
		}

	}
