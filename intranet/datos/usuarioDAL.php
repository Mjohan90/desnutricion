<?php
	include_once 'conexion.php';
	
	class usuarioDAL
	{
		function login($usu_nombre, $usu_contrasena) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_login('$usu_nombre', '$usu_contrasena');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		function getRow($usu_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_getRow('$usu_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		function getByID($usu_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_getByID('$usu_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		public function listarcbo($usu_id = 0) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_listcbo('$usu_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listar($b = '', $usu_estado = 1) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_list('$b', '$usu_estado');");
			return $mysql->rsToArray($rs);
		}
		
		public function registrar(usuario $usu) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_usuario_insert(
					@usu_id,
					'$usu->nombre',
					'$usu->contrasena',
					'$usu->empl_id',
					'$usu->rol_id');");
			
			$usu_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $usu_id;
		}
		
		public function actualizar(usuario $usu) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				CALL pa_usuario_update(
					'$usu->usu_id',
					'$usu->nombre',
					'$usu->contrasena',
					'$usu->empl_id',
					'$usu->rol_id');");
			return $rs;
		}
		
		public function borrar($usu_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_delete('$usu_id');");
			return $rs;
		}
		
		public function activar($usu_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_activate('$usu_id');");
			return $rs;
		}
		
		public function desactivar($usu_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("UPDATE usuario SET usu_estado = 2 WHERE usu_id = '$usu_id';");
			return $rs;
		}
		
	}
