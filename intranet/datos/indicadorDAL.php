<?php
	include_once 'conexion.php';

	class indicadorDAL {

		function getRow($indic_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_indicador_getRow('$indic_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($indic_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_indicador_getByID('$indic_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($indic_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_indicador_listcbo('$indic_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $indic_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_indicador_list('$b', '$indic_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(indicador $indic) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_indicador_insert(
					@indic_id,
					'$indic->nombre',
					'$indic->var1_id',
					'$indic->var2_id');");

			$indic_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $indic_id;
		}

		public function actualizar(indicador $indic) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_indicador_update(
					'$indic->indic_id',
					'$indic->nombre',
					'$indic->var1_id',
					'$indic->var2_id');");
			return $rs;
		}

		public function borrar($indic_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_indicador_delete('$indic_id');");
			return $rs;
		}

		public function activar($indic_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_indicador_activate('$indic_id');");
			return $rs;
		}
	}
