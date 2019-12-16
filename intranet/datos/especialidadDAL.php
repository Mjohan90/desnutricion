<?php
	include_once 'conexion.php';

	class especialidadDAL {

		function getRow($espec_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_especialidad_getRow('$espec_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($espec_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_especialidad_getByID('$espec_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($espec_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_especialidad_listcbo('$espec_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $espec_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_especialidad_list('$b', '$espec_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(especialidad $espec) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_especialidad_insert(
					@espec_id,
					'$espec->nombre');");

			$espec_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $espec_id;
		}

		public function actualizar(especialidad $espec) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_especialidad_update(
					'$espec->espec_id',
					'$espec->nombre',
					'$espec->estado');");
			return $rs;
		}

		public function borrar($espec_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_especialidad_delete('$espec_id');");
			return $rs;
		}

		public function activar($espec_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_especialidad_activate('$espec_id');");
			return $rs;
		}
	}
