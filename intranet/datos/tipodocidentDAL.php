<?php
	include_once 'conexion.php';

	class tipodocidentDAL {

		function getRow($tdi_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipodocident_getRow('$tdi_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($tdi_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipodocident_getByID('$tdi_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($tdi_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipodocident_listcbo('$tdi_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $tdi_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipodocident_list('$b', '$tdi_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(tipodocident $tdi) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_tipodocident_insert(
					@tdi_id,
					'$tdi->nombre',
					'$tdi->abrev');");

			$tdi_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $tdi_id;
		}

		public function actualizar(tipodocident $tdi) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_tipodocident_update(
					'$tdi->tdi_id',
					'$tdi->nombre',
					'$tdi->abrev');");
			return $rs;
		}

		public function borrar($tdi_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipodocident_delete('$tdi_id');");
			return $rs;
		}

		public function activar($tdi_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipodocident_activate('$tdi_id');");
			return $rs;
		}
	}
