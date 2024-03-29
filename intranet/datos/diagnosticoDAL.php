<?php
	include_once 'conexion.php';
	
	class diagnosticoDAL
	{
		
		function getRow($diag_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_diagnostico_getRow('$diag_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		function getByID($diag_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_diagnostico_getByID('$diag_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		public function listarcbo($diag_id = 0) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_diagnostico_listcbo('$diag_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listar($b = '') {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_diagnostico_list('$b');");
			return $mysql->rsToArray($rs);
		}
		
		public function registrar(diagnostico $diag) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			if ($diag->enferm_id > 0) {
				$rs = $mysql->ejecutar("
					DELETE FROM diagnostico WHERE diag_atenc_id = $diag->atenc_id;
				");
				$rs = $mysql->ejecutar("
					CALL pa_diagnostico_insert(
						@diag_id,
						'$diag->atenc_id',
						'$diag->enferm_id');");
				
				$diag_id = $rs ? $mysql->getLastID() : 0;
				$mysql->desconectar();
				return $diag_id;
			}
			return 0;
		}
		
		public function actualizar(diagnostico $diag) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				CALL pa_diagnostico_update(
					'$diag->diag_id',
					'$diag->atenc_id',
					'$diag->enferm_id');");
			return $rs;
		}
		
	}
