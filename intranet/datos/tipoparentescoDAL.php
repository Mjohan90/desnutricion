<?php
	include_once 'conexion.php';

	class tipoparentescoDAL {

		function getRow($tparent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoparentesco_getRow('$tparent_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($tparent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoparentesco_getByID('$tparent_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($tparent_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoparentesco_listcbo('$tparent_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $tparent_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoparentesco_list('$b', '$tparent_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(tipoparentesco $tparent) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_tipoparentesco_insert(
					@tparent_id,
					'$tparent->nombre');");

			$tparent_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $tparent_id;
		}

		public function actualizar(tipoparentesco $tparent) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_tipoparentesco_update(
					'$tparent->tparent_id',
					'$tparent->nombre',
					'$tparent->estado');");
			return $rs;
		}

		public function borrar($tparent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoparentesco_delete('$tparent_id');");
			return $rs;
		}

		public function activar($tparent_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoparentesco_activate('$tparent_id');");
			return $rs;
		}
	}
