<?php
	include_once 'conexion.php';

	class reglasDAL {

		function getRow($regla_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_reglas_getRow('$regla_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($regla_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_reglas_getByID('$regla_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($regla_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_reglas_listcbo('$regla_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '') {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_reglas_list('$b');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(reglas $regla) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_reglas_insert(
					@regla_id,
					'$regla->indic1_id',
					'$regla->indic2_id',
					'$regla->formula',
					'$regla->diag_id');");

			$regla_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $regla_id;
		}

		public function actualizar(reglas $regla) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_reglas_update(
					'$regla->regla_id',
					'$regla->indic1_id',
					'$regla->indic2_id',
					'$regla->formula',
					'$regla->diag_id');");
			return $rs;
		}

	}
