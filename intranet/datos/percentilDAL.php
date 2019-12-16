<?php
	include_once 'conexion.php';

	class percentilDAL {

		function getRow($percent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_percentil_getRow('$percent_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($percent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_percentil_getByID('$percent_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($percent_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_percentil_listcbo('$percent_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $percent_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_percentil_list('$b', '$percent_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(percentil $percent) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_percentil_insert(
					@percent_id,
					'$percent->sexo',
					'$percent->indic_id',
					'$percent->var1_valor',
					'$percent->var2_valor',
					'$percent->percentil');");

			$percent_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $percent_id;
		}

		public function actualizar(percentil $percent) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_percentil_update(
					'$percent->percent_id',
					'$percent->sexo',
					'$percent->indic_id',
					'$percent->var1_valor',
					'$percent->var2_valor',
					'$percent->percentil');");
			return $rs;
		}

		public function borrar($percent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_percentil_delete('$percent_id');");
			return $rs;
		}

		public function activar($percent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_percentil_activate('$percent_id');");
			return $rs;
		}
	}
