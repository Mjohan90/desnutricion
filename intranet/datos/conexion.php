<?php
	
	class Conexion {
		
		public  $servidor = 'localhost';
		public  $usuario  = 'root';
		public  $clave    = '';
		public  $bdatos   = 'desnutricion';
		public  $auto;
		private $link;
		
		function __construct($auto = true) {
			$this->auto = $auto;
		}
		
		/* Retorna: objeto mysqli | Si error: NULL */
		function conectar() {
			$cnn = mysqli_connect($this->servidor, $this->usuario, $this->clave, $this->bdatos);
			if (mysqli_connect_errno() == 0) {
				$this->link = $cnn;
				return $cnn;
			} else {
				$this->link = null;
				return null;
			}
		}
		
		/* Retorna: TRUE | Si no hay efecto: FALSE */
		function desconectar() {
			if ($this->link) {
				return mysqli_close($this->link);
			} else {
				return false;
			}
		}
		
		/* Retorna: objeto mysqli_result o TRUE | Si error: FALSE */
		function ejecutar($query) {
			
			$cnn = $this->auto ? $this->conectar() : $this->link;
			
			if ($cnn) {
				mysqli_query($cnn, "SET NAMES 'utf8'");
				$rs = mysqli_query($cnn, $query);
				if ($rs) {
					if ($this->auto) {
						$this->desconectar();
					}
					return $rs;
				} else {
					if ($cnn->errno == 1062) {
						echo 'Ya existe un registro duplicado en la base de datos. ';
					} else {
						echo 'Error en la consulta. '. $cnn->error;
					}
					if ($this->auto) {
						$this->desconectar();
					}
					return $rs;
				}
			} else {
				echo 'Error de Conexion. ';
				return false;
			}
		}
		
		function getLastID() {
			$rs = $this->ejecutar("SELECT LAST_INSERT_ID() AS identificador;");
			return $rs ? mysqli_fetch_assoc($rs)['identificador'] : 0;
		}
		
		function rsToArray($rs) {
			$array = array();
			if ($rs) {
				while ($row = mysqli_fetch_assoc($rs)) {
					$array[] = $row;
				}
			}
			return $array;
		}
		
		/* Retorna: objeto mysqli_result o TRUE | Si error: FALSE */
		function ejecutar_multi($query) {
			$cnn = $this->conectar();
			if ($cnn) {
				mysqli_multi_query($cnn, "SET NAMES 'utf8'");
				$rs = mysqli_multi_query($cnn, $query);
				$this->desconectar();
				if (!$rs) {
					echo 'Error en la consulta. ';
				}
				return $rs;
			} else {
				echo 'Error de conexión. ';
				return false;
			}
		}
	}