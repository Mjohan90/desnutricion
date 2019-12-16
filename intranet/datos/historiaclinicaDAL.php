<?php
	include_once 'conexion.php';

	class historiaclinicaDAL {

		function getRow($hc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_historiaclinica_getRow('$hc_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($hc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_historiaclinica_getByID('$hc_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($hc_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_historiaclinica_listcbo('$hc_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $hc_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_historiaclinica_list('$b', '$hc_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(historiaclinica $hc) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_historiaclinica_insert(
					@hc_id,
					'$hc->pac_id',
					'$hc->fecha_suceso',
					'$hc->comentario',
					'$hc->atenc_id_ref');");

			$hc_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $hc_id;
		}

		public function actualizar(historiaclinica $hc) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_historiaclinica_update(
					'$hc->hc_id',
					'$hc->pac_id',
					'$hc->fecha_suceso',
					'$hc->comentario',
					'$hc->atenc_id_ref');");
			return $rs;
		}

		public function borrar($hc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_historiaclinica_delete('$hc_id');");
			return $rs;
		}

		public function activar($hc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_historiaclinica_activate('$hc_id');");
			return $rs;
		}
	}
