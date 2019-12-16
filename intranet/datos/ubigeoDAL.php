<?php
	include_once 'conexion.php';

	class ubigeoDAL {

		function getRow($ubig_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_ubigeo_getRow('$ubig_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		function getByID($ubig_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_ubigeo_getByID('$ubig_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarcbo($ubig_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_ubigeo_listcbo('$ubig_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $ubig_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_ubigeo_list('$b', '$ubig_estado');");
			return $mysql->rsToArray($rs);
		}
		
		public function getDepartamentoOfDistrito($ubigeoId) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
                SELECT dpto.ubig_id, dpto.ubig_nombre
                FROM (
                    SELECT ubig.ubig_id, ubig.ubig_dpto_cod, ubig.ubig_prov_cod, ubig.ubig_dist_cod, ubig.ubig_nombre
                    FROM ubigeo ubig
                    WHERE ubig.ubig_id = $ubigeoId
                ) distr
                INNER JOIN ubigeo dpto ON distr.ubig_dpto_cod = dpto.ubig_dpto_cod AND dpto.ubig_dist_cod = 0 and dpto.ubig_prov_cod = 0;
			");
			return mysqli_fetch_assoc($rs);
		}
		
		public function getListDepartamentosCbo() {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				SELECT ubig.ubig_id, ubig.ubig_dpto_cod, ubig.ubig_prov_cod, ubig.ubig_dist_cod, ubig.ubig_nombre
				FROM ubigeo ubig
				WHERE ubig.ubig_prov_cod = 0 AND ubig.ubig_dist_cod = 0;
			");
			return $rs;
		}
		
		public function getListProvinciasByDepartamento_Cbo($codDpto) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				SELECT ubig.ubig_id, ubig.ubig_dpto_cod, ubig.ubig_prov_cod, ubig.ubig_dist_cod, ubig.ubig_nombre
				FROM ubigeo ubig
				WHERE ubig.ubig_dpto_cod = $codDpto AND ubig.ubig_prov_cod <> 0 AND ubig.ubig_dist_cod = 0;
			");
			return $rs;
		}
		
		public function getListDistritosByProvincia_Cbo($codDpto, $codProv) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				SELECT ubig.ubig_id, ubig.ubig_dpto_cod, ubig.ubig_prov_cod, ubig.ubig_dist_cod, ubig.ubig_nombre
				FROM ubigeo ubig
				WHERE ubig.ubig_dpto_cod = '$codDpto' AND ubig.ubig_prov_cod = '$codProv' AND ubig.ubig_dist_cod <> 0;
			");
			return $rs;
		}
		
		public function getListAllDistritosCboCods() {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				SELECT distr.ubig_id, distr.ubig_dpto_cod, distr.ubig_prov_cod, distr.ubig_dist_cod,
				    distr.ubig_nombre AS distr_nombre, prov.ubig_nombre AS prov_nombre, dpto.ubig_nombre AS dpto_nombre,
				    CONCAT(distr.ubig_nombre, ' / ', prov.ubig_nombre, ' / ', dpto.ubig_nombre) AS ubig_nombre_full
				FROM (
					SELECT * FROM ubigeo ubig
					WHERE ubig.ubig_dpto_cod <> 0 AND ubig.ubig_prov_cod <> 0 AND ubig.ubig_dist_cod <> 0
				) distr
				INNER JOIN (
					SELECT * FROM ubigeo ubig
					WHERE ubig.ubig_dpto_cod <> 0 AND ubig.ubig_prov_cod <> 0 AND ubig.ubig_dist_cod = 0
				) prov ON distr.ubig_dpto_cod = prov.ubig_dpto_cod AND distr.ubig_prov_cod = prov.ubig_prov_cod
				INNER JOIN (
					SELECT * FROM ubigeo ubig
					WHERE ubig.ubig_dpto_cod <> 0 AND ubig.ubig_prov_cod = 0 AND ubig.ubig_dist_cod = 0
				) dpto ON prov.ubig_dpto_cod = dpto.ubig_dpto_cod
				ORDER BY distr.ubig_dpto_cod, distr.ubig_prov_cod, distr.ubig_dist_cod;
			");
			return $rs;
		}
		
		public function getListAllDistritosCbo() {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				SELECT distr.ubig_id, distr.ubig_dpto_cod, distr.ubig_prov_cod, distr.ubig_dist_cod,
				    distr.ubig_nombre AS distr_nombre, prov.ubig_nombre AS prov_nombre, dpto.ubig_nombre AS dpto_nombre,
				    CONCAT(distr.ubig_nombre, ' / ', prov.ubig_nombre, ' / ', dpto.ubig_nombre) AS ubig_nombre_full
				FROM (
					SELECT * FROM ubigeo ubig
					WHERE ubig.ubig_dpto_cod <> 0 AND ubig.ubig_prov_cod <> 0 AND ubig.ubig_dist_cod <> 0
				) distr
				INNER JOIN (
					SELECT * FROM ubigeo ubig
					WHERE ubig.ubig_dpto_cod <> 0 AND ubig.ubig_prov_cod <> 0 AND ubig.ubig_dist_cod = 0
				) prov ON distr.ubig_dpto_cod = prov.ubig_dpto_cod AND distr.ubig_prov_cod = prov.ubig_prov_cod
				INNER JOIN (
					SELECT * FROM ubigeo ubig
					WHERE ubig.ubig_dpto_cod <> 0 AND ubig.ubig_prov_cod = 0 AND ubig.ubig_dist_cod = 0
				) dpto ON prov.ubig_dpto_cod = dpto.ubig_dpto_cod
				ORDER BY dpto.ubig_nombre, prov.ubig_nombre, distr.ubig_nombre;
			");
			return $rs;
		}
		
		public function getFullNameOfLugar($ubigeoId) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				SELECT distr.ubig_id, distr.ubig_dpto_cod, distr.ubig_prov_cod, distr.ubig_dist_cod,
				    distr.ubig_nombre AS distr_nombre, prov.ubig_nombre AS prov_nombre, dpto.ubig_nombre AS dpto_nombre,
				    CONCAT(distr.ubig_nombre, ' / ', prov.ubig_nombre, ' / ', dpto.ubig_nombre) AS ubig_nombre_full
				FROM (
					SELECT * FROM ubigeo ubig	WHERE ubig.ubig_id = '$ubigeoId'
				) distr
				INNER JOIN (
					SELECT * FROM ubigeo ubig
					WHERE ubig.ubig_dpto_cod <> 0 AND ubig.ubig_prov_cod <> 0 AND ubig.ubig_dist_cod = 0
				) prov ON distr.ubig_dpto_cod = prov.ubig_dpto_cod AND distr.ubig_prov_cod = prov.ubig_prov_cod
				INNER JOIN (
					SELECT * FROM ubigeo ubig
					WHERE ubig.ubig_dpto_cod <> 0 AND ubig.ubig_prov_cod = 0 AND ubig.ubig_dist_cod = 0
				) dpto ON prov.ubig_dpto_cod = dpto.ubig_dpto_cod
				ORDER BY distr.ubig_dpto_cod, distr.ubig_prov_cod, distr.ubig_dist_cod;
			");
			return mysqli_fetch_assoc($rs);
		}
		
		public function registrar(ubigeo $ubig) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_ubigeo_insert(
					@ubig_id,
					'$ubig->cod',
					'$ubig->dpto_cod',
					'$ubig->prov_cod',
					'$ubig->dist_cod',
					'$ubig->nombre');");

			$ubig_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $ubig_id;
		}

		public function actualizar(ubigeo $ubig) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_ubigeo_update(
					'$ubig->ubig_id',
					'$ubig->cod',
					'$ubig->dpto_cod',
					'$ubig->prov_cod',
					'$ubig->dist_cod',
					'$ubig->nombre');");
			return $rs;
		}

		public function borrar($ubig_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_ubigeo_delete('$ubig_id');");
			return $rs;
		}

		public function activar($ubig_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_ubigeo_activate('$ubig_id');");
			return $rs;
		}
	}
