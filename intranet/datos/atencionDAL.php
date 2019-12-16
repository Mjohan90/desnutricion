<?php
	include_once 'conexion.php';

	class atencionDAL {

		function getRow($atenc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_atencion_getRow('$atenc_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($atenc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_atencion_getByID('$atenc_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($atenc_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_atencion_listcbo('$atenc_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $atenc_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_atencion_list('$b', '$atenc_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(atencion $atenc) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_atencion_insert(
					@atenc_id,
					'$atenc->pac_id',
					'$atenc->medico_id',
					'$atenc->espec_id',
					'$atenc->fecha_atenc',
					'$atenc->observacion',
					'$atenc->tratamiento',
					'$atenc->dieta',
					'$atenc->situacion',
					'$atenc->registra_id');");

			$atenc_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $atenc_id;
		}

		public function actualizar(atencion $atenc) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_atencion_update(
					'$atenc->atenc_id',
					'$atenc->pac_id',
					'$atenc->medico_id',
					'$atenc->espec_id',
					'$atenc->fecha_atenc',
					'$atenc->observacion',
					'$atenc->tratamiento',
					'$atenc->dieta',
					'$atenc->situacion');");
			return $rs;
		}

		public function borrar($atenc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_atencion_delete('$atenc_id');");
			return $rs;
		}

		public function activar($atenc_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_atencion_activate('$atenc_id');");
			return $rs;
		}
	}
