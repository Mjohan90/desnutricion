<?php
	include_once 'conexion.php';
	
	define('ROL_ADMIN', 1);
	define('ROL_MEDICO', 2);
	define('ROL_RECEPCION', 3);
	define('ROL_ENFERMERA', 4);
	define('ROL_CAJA', 5);
	define('ROL_PACIENTE', 6);
	
	define('CLI_PERSONA', 1);
	define('CLI_EMPRESA', 2);
	
	define('TD_BOLETA', 1);
	define('TD_FACTURA', 2);
	
	define('TPAGO_EFECTIVO', 1);
	define('TPAGO_TARJETA', 2);
	
	function getTipoPago() {
		$estados[TPAGO_EFECTIVO] = 'Efectivo';
		$estados[TPAGO_TARJETA]  = 'Tarjeta';
		return $estados;
	}
	
	define('ATENCION_PENDIENTE', 1);
	define('ATENCION_ATENDIDO', 2);
	
	function getSituacionAtencion() {
		$estados[ATENCION_PENDIENTE] = 'Pendiente';
		$estados[ATENCION_ATENDIDO]  = 'Atendido';
		return $estados;
	}
	
	define('YMD', 'Y-m-d');
	define('DMY', 'd/m/Y');
	
	define('INACTIVO', 0);
	define('ACTIVO', 1);
	define('DESACTIVADO', 2);
	
	define('IGV_VALUE', 0.18);
	
	function getEstados() {
		$estados[INACTIVO]    = 'Inactivo';
		$estados[ACTIVO]      = 'Activo';
		$estados[DESACTIVADO] = 'Desactivado';
		return $estados;
	}
	
	define('TVAR_NUMERIC', 1);
	define('TVAR_ESCALA', 2);
	
	function getTipoVar() {
		$tipovar[TVAR_NUMERIC] = 'Numerico';
		$tipovar[TVAR_ESCALA]  = 'Escala';
		return $tipovar;
	}
	
	define('TESC_NINGUNA', 1);
	define('TESC_SINO', 2);
	define('TESC_LIKERT3', 3);
	define('TESC_LIKERT5', 4);
	
	function getTipoEscala() {
		$tipoesc[TESC_NINGUNA] = 'Ninguna';
		$tipoesc[TESC_SINO]    = 'Si/No';
		$tipoesc[TESC_LIKERT3] = 'Likert 3';
		$tipoesc[TESC_LIKERT5] = 'Likert 5';
		return $tipoesc;
	}
	
	define('VAR_EDAD', 3);
	
	function getEscalaSiNo() {
		$tipoesc[1] = 'Si';
		$tipoesc[2] = 'No';
		return $tipoesc;
	}
	
	function getEscalaLikert5() {
		$tipoesc[1] = 'Muy bajo';
		$tipoesc[2] = 'Bajo';
		$tipoesc[3] = 'Normal';
		$tipoesc[4] = 'Alto';
		$tipoesc[5] = 'Muy Alto';
		return $tipoesc;
	}
	
	function getEscalaLikert3() {
		$tipoesc[1] = 'Bajo';
		$tipoesc[2] = 'Normal';
		$tipoesc[3] = 'Alto';
		return $tipoesc;
	}
	
	// Desde el servidor:
	function today() {
		$mysql   = new Conexion();
		$rs      = $mysql->ejecutar("SELECT NOW() AS Hoy;");
		$hoy     = mysqli_fetch_assoc($rs)['Hoy'];
		$newdate = new DateTime($hoy);
		return date_format($newdate, 'd/m/Y');
	}
	
	function todayYMD() {
		$mysql   = new Conexion();
		$rs      = $mysql->ejecutar("SELECT NOW() AS Hoy;");
		$hoy     = mysqli_fetch_assoc($rs)['Hoy'];
		$newdate = new DateTime($hoy);
		return date_format($newdate, 'Y-m-d');
	}
	
	function todayMonth() {
		$mysql   = new Conexion();
		$rs      = $mysql->ejecutar("SELECT NOW() AS Hoy;");
		$hoy     = mysqli_fetch_assoc($rs)['Hoy'];
		$newdate = new DateTime($hoy);
		return date_format($newdate, 'm');
	}
	
	function todayAM() {
		$mysql   = new Conexion();
		$rs      = $mysql->ejecutar("SELECT NOW() AS Hoy;");
		$hoy     = mysqli_fetch_assoc($rs)['Hoy'];
		$newdate = new DateTime($hoy);
		return date_format($newdate, 'd/m/Y h:i a');
	}
	
	function thisYear() {
		$mysql   = new Conexion();
		$rs      = $mysql->ejecutar("SELECT NOW() AS Hoy;");
		$hoy     = mysqli_fetch_assoc($rs)['Hoy'];
		$newdate = new DateTime($hoy);
		return date_format($newdate, 'Y');
	}
	
	function firstDayOfMonth() {
		$mysql   = new Conexion();
		$rs      = $mysql->ejecutar("SELECT NOW() AS Fecha;");
		$hoy     = mysqli_fetch_assoc($rs)['Fecha'];
		$newdate = new DateTime($hoy);
		return date_format($newdate, '01/m/Y');
	}
	
	function lastDayOfMonth($mes = '', $anio = '') {
		$mysql = new Conexion();
		if ($mes != '') {
			if ($anio != '') {
				$rs = $mysql->ejecutar("SELECT '$anio-$mes-01' AS Fecha;");
			} else {
				$rs = $mysql->ejecutar("SELECT CONCAT(YEAR(NOW()), '-$mes-01') AS Fecha;");
			}
		} else {
			$rs = $mysql->ejecutar("SELECT NOW() AS Fecha;");
		}
		$hoy     = mysqli_fetch_assoc($rs)['Fecha'];
		$newdate = new DateTime($hoy);
		return date_format($newdate, 't/m/Y');
	}
	
	function numberWeeksOnYear($anio) {
		$mysql = new Conexion();
		$rs    = $mysql->ejecutar("SELECT WEEKOFYEAR('$anio-12-31') AS Week;");
		$week  = mysqli_fetch_assoc($rs)['Week'];
		return $week;
	}
	
	// Entrada: [Y-m-d H:i:s] | Salida: [int]
	function NroMesesEntre($fecha1, $fecha2, $truncate = true) {
		$nro_meses = 0;
		if ($fecha1 && $fecha2) {
			if ($truncate) {
				$f1 = explode('-', $fecha1);
				$f2 = explode('-', $fecha2);
				// truncate to first day of month
				$fecha1 = new DateTime("$f1[0]-$f1[1]-01");
				$fecha2 = new DateTime("$f2[0]-$f2[1]-01");
			} else {
				$fecha1 = new DateTime($fecha1);
				$fecha2 = new DateTime($fecha2);
			}
			$diff      = date_diff($fecha1, $fecha2);
			$nro_meses = ($diff->y * 12) + $diff->m;
		}
		return $nro_meses;
	}
	
	function Moneda($abrev) {
		if ($abrev == 'PEN') {
			return 'S/';
		} elseif ($abrev == 'USD') {
			return '$';
		}
		return '';
	}
	
	//--------------------------------------------------
	
	function SetCurrentPage($pagina) {
		$_SESSION["pagina"] = $pagina;
		return $pagina;
	}
	
	function ReceiveParent($action, $default) {
		$sname = "$action.parent";
		
		if (isset($_GET['parent'])) {
			$pagina = $_GET['parent'];
			if ($pagina != 'default') {
				$_SESSION["$sname"] = $pagina;
			} else {
				$_SESSION["$sname"] = $pagina = $default;
			}
		} elseif (isset($_SESSION["$sname"])) {
			$pagina = $_SESSION["$sname"];
		} else {
			$_SESSION["$sname"] = $pagina = $default;
		}
		return $pagina;
	}
	
	function IssetPost($valores) {
		$valores = is_array($valores) ? $valores : [$valores];
		foreach ($valores as $v) {
			if (!isset($_POST[$v])) {
				return false;
			}
		}
		return true;
	}
	
	function IssetOr(&$campo, $def) {
		return isset($campo) ? $campo : $def;
	}
	
	// Funciones "Param" para la capa de VISTAS:
	// (Parametros recibidos por GET)
	
	function IssetGetParam($var_name) {
		return isset($_GET["$var_name"]);
	}
	
	function GetNumParam($var_name, $default = 0) {
		return isset($_GET["$var_name"]) && is_numeric($_GET["$var_name"]) ? $_GET["$var_name"] : $default;
	}
	
	function GetStrParam($var_name, $default = '') {
		return isset($_GET["$var_name"]) ? $_GET["$var_name"] : $default;
	}
	
	// Login Access
	
	function CheckLoginAccess() {
		if (!isset($_SESSION["auth.usu_id"])) {
			echo "<script>window.location='login.php';</script>";
			exit();
		}
	}
	
	function GetAuthVar($var_name) {
		if (isset($_SESSION["auth.$var_name"])) {
			return $_SESSION["auth.$var_name"];
		}
		return null;
	}
	
	function dateTransform($value, $format1, $format2) {
		$date = DateTime::createFromFormat($format1, $value);
		return $date->format($format2);
	}
	
	function getShortMeses() {
		$meses     = [];
		$meses[1]  = 'Ene';
		$meses[2]  = 'Feb';
		$meses[3]  = 'Mar';
		$meses[4]  = 'Abr';
		$meses[5]  = 'May';
		$meses[6]  = 'Jun';
		$meses[7]  = 'Jul';
		$meses[8]  = 'Ago';
		$meses[9]  = 'Set';
		$meses[10] = 'Oct';
		$meses[11] = 'Nov';
		$meses[12] = 'Dic';
		return $meses;
	}
	
	function getMeses() {
		$meses     = [];
		$meses[1]  = 'Enero';
		$meses[2]  = 'Febrero';
		$meses[3]  = 'Marzo';
		$meses[4]  = 'Abril';
		$meses[5]  = 'Mayo';
		$meses[6]  = 'Junio';
		$meses[7]  = 'Julio';
		$meses[8]  = 'Agosto';
		$meses[9]  = 'Setiembre';
		$meses[10] = 'Octubre';
		$meses[11] = 'Noviembre';
		$meses[12] = 'Diciembre';
		return $meses;
	}
	
	function getDias() {
		$dias    = [];
		$dias[1] = 'Domingo';
		$dias[2] = 'Lunes';
		$dias[3] = 'Martes';
		$dias[4] = 'Miercoles';
		$dias[5] = 'Jueves';
		$dias[6] = 'Viernes';
		$dias[7] = 'Sabado';
		return $dias;
	}
	
	function getShortDias() {
		$dias    = [];
		$dias[1] = 'Dom';
		$dias[2] = 'Lun';
		$dias[3] = 'Mar';
		$dias[4] = 'Mie';
		$dias[5] = 'Jue';
		$dias[6] = 'Vie';
		$dias[7] = 'Sab';
		return $dias;
	}
	
	function convertToDays($days_number) {
		$m    = [];
		$days = getShortDias();
		foreach ($days_number as $n) {
			$m [] = IssetOr($days[$n], '');
		}
		return $m;
	}
	
	function dropAtEnd(&$cadena, $char) {
		$cadena = rtrim($cadena, $char);
	}
	
	function isBetween($valor, $ini, $fin) {
		return (isset($valor) && (($valor >= $ini && $valor < $fin) || ($ini > $fin && $valor >= $ini || $valor < $fin)));
	}
	
	function isBetweenArray($valor, $array, $col_ini, $col_fin, $col_return) {
		foreach ($array as $row) {
			$ini = $row[$col_ini];
			$fin = $row[$col_fin];
			if (isset($valor) && (($valor >= $ini && $valor < $fin) || ($ini > $fin && $valor >= $ini || $valor < $fin))) {
				return $row[$col_return];
			}
		}
		return "";
	}
	
	// PRONOSTICOS: -----------------------------------------
	define('PRS_AUTOMATICO', 1);
	define('PRS_MOVIL', 2);
	define('PRS_MOVIL_PONDERADO', 3);
	define('PRS_ESTACIONAL', 4);
	
	// TIEMPO : ---------------------------------------------
	define('TIEMPO_MINUTOS', 1);
	define('TIEMPO_HORAS', 2);
	define('TIEMPO_DIAS', 3);
	define('TIEMPO_SEMANAS', 4);
	define('TIEMPO_MESES', 5);
	define('TIEMPO_ANIOS', 6);
	
	function getTimePart() {
		$tiempo                 = [];
		$tiempo[TIEMPO_MINUTOS] = 'Minutos';
		$tiempo[TIEMPO_HORAS]   = 'Horas';
		$tiempo[TIEMPO_DIAS]    = 'Días';
		// $tiempo[TIEMPO_SEMANAS] = 'Semanas';
		$tiempo[TIEMPO_MESES] = 'Meses';
		$tiempo[TIEMPO_ANIOS] = 'Años';
		return $tiempo;
	}
	
	// Entrada: [Y-m-d] | Salida: el número del día de la semana, [dom: 0] a [sab: 6]
	function NroDiaSemana($date) {
		$newdate = new DateTime($date);
		return date_format($newdate, 'w');
	}
	
	// Entrada [nro_dia: 0 a 6]
	function DayName($nro_dia) {
		$dayNames = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
		return ($nro_dia >= 0 && $nro_dia <= 6) ? $dayNames[$nro_dia] : '';
	}
	
	// Entrada [nro_dia: 0 a 6]
	function DayShortName($nro_dia) {
		$dayNames = ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"];
		return ($nro_dia >= 0 && $nro_dia <= 6) ? $dayNames[$nro_dia] : '';
	}
