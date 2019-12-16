<?php
	include_once 'conexion.php';

	class direccionDAL {

		function getRow($direc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_direccion_getRow('$direc_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($direc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_direccion_getByID('$direc_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($direc_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_direccion_listcbo('$direc_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $direc_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_direccion_list('$b', '$direc_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(direccion $direc) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_direccion_insert(
					@direc_id,
					'$direc->pers_id',
					'$direc->ubig_id',
					'$direc->descripcion');");

			$direc_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $direc_id;
		}

		public function actualizar(direccion $direc) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_direccion_update(
					'$direc->direc_id',
					'$direc->pers_id',
					'$direc->ubig_id',
					'$direc->descripcion');");
			return $rs;
		}

		public function borrar($direc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_direccion_delete('$direc_id');");
			return $rs;
		}

		public function activar($direc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_direccion_activate('$direc_id');");
			return $rs;
		}
	}
