<?php
	include_once 'conexion.php';
	
	class triajeDAL
	{
		
		function getRow($triaje_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_triaje_getRow('$triaje_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		function getByID($triaje_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_triaje_getByID('$triaje_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		public function listarcbo($triaje_id = 0) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_triaje_listcbo('$triaje_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listar($b = '', $triaje_estado = 1) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_triaje_list('$b', '$triaje_estado');");
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
		
		public function registrarList($pac_sexo, $pac_edad_meses, $atenc_id, array $triaje_list) {
			$mysql  = new Conexion(false);
			$mysql2 = new Conexion();
			$mysql->conectar();
			
			$rs = $mysql->ejecutar("DELETE FROM triaje WHERE triaje_atenc_id = '$atenc_id';");
			foreach ($triaje_list as $triaje) {
				$rs2 = $mysql2->ejecutar("
					SELECT percent_id, percent_escala
					FROM percentil p
					INNER JOIN indicador i ON p.percent_indic_id = i.indic_id
					WHERE i.indic_var1_id = 3 AND i.indic_var2_id = '$triaje->var_id' AND p.percent_sexo = '$pac_sexo'
					  AND (p.percent_var1_valor <= '$pac_edad_meses' AND p.percent_var2_valor <= '$triaje->valor')
					ORDER BY p.percent_var1_valor DESC, p.percent_var2_valor DESC
					LIMIT 1;
				");
				$row = $rs ? mysqli_fetch_assoc($rs2) : ['percent_id' => 0, 'percent_escala' => 0];
				
				$rs = $rs && $mysql->ejecutar("
					CALL pa_triaje_insert(
						@triaje_id,
						'$triaje->atenc_id',
						'$triaje->var_id',
						'$triaje->um_id',
						'$triaje->valor',
						'$row[percent_escala]');
				");
			}
			
			$mysql->desconectar();
			return $rs ? 1 : 0;
		}
		
		public function actualizar(triaje $triaje) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
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
			$rs    = $mysql->ejecutar("CALL pa_triaje_delete('$triaje_id');");
			return $rs;
		}
		
		public function activar($triaje_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_triaje_activate('$triaje_id');");
			return $rs;
		}
	}
