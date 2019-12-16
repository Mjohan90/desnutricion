<?php
	include_once 'conexion.php';

	class variableDAL {

		function getRow($var_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_variable_getRow('$var_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($var_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_variable_getByID('$var_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($var_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_variable_listcbo('$var_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $var_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_variable_list('$b', '$var_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(variable $var) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_variable_insert(
					@var_id,
					'$var->catvar_id',
					'$var->nombre',
					'$var->um_id',
					'$var->tipo_var');");

			$var_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $var_id;
		}

		public function actualizar(variable $var) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_variable_update(
					'$var->var_id',
					'$var->catvar_id',
					'$var->nombre',
					'$var->um_id',
					'$var->tipo_var');");
			return $rs;
		}

		public function borrar($var_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_variable_delete('$var_id');");
			return $rs;
		}

		public function activar($var_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_variable_activate('$var_id');");
			return $rs;
		}
	}
