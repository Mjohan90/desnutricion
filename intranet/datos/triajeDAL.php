<?php
	include_once 'conexion.php';

	class triajeDAL {

		function getRow($triaje_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_triaje_getRow('$triaje_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($triaje_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_triaje_getByID('$triaje_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($triaje_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_triaje_listcbo('$triaje_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $triaje_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_triaje_list('$b', '$triaje_estado');");
			return $mysql->rsToArray($rs);
		}
		
		public function listarByAtencion($atenc_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_triaje_listByAtencion('$atenc_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function registrar(triaje $triaje) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_triaje_insert(
					@triaje_id,
					'$triaje->atenc_id',
					'$triaje->var_id',
					'$triaje->um_id',
					'$triaje->valor',
					'$triaje->escala');");

			$triaje_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $triaje_id;
		}

		public function actualizar(triaje $triaje) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_triaje_update(
					'$triaje->triaje_id',
					'$triaje->atenc_id',
					'$triaje->var_id',
					'$triaje->um_id',
					'$triaje->valor',
					'$triaje->escala',
					'$triaje->estado');");
			return $rs;
		}

		public function borrar($triaje_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_triaje_delete('$triaje_id');");
			return $rs;
		}

		public function activar($triaje_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_triaje_activate('$triaje_id');");
			return $rs;
		}
	}
