<?php
    // Funciones de fecha
    function formatDate($date) {
        if ($date != '0000-00-00 00:00:00' && $date != null) {
            $newdate = new DateTime($date);

            return date_format($newdate, 'd/m/Y');
        } else {
            return '';
        }
    }

    function formatDateDMY_Name($date) {
        if ($date != '0000-00-00 00:00:00' && $date != null) {
            $newdate = new DateTime($date);

            return date_format($newdate, 'd M Y');
        } else {
            return '';
        }
    }

    function formatDateAM($date) {
        if ($date != '0000-00-00 00:00:00' && $date != null) {
            $newdate = new DateTime($date);

            return date_format($newdate, 'd/m/Y h:i a');
        } else {
            return '';
        }
    }

    function getHourFromDate($date) {
        if ($date != '0000-00-00 00:00:00' && $date != null) {
            $newdate = new DateTime($date);

            return date_format($newdate, 'h:i a');
        } else {
            return '';
        }
    }

    function getYear($date) {
        if ($date != '0000-00-00 00:00:00') {
            $newdate = new DateTime($date);

            return date_format($newdate, 'Y');
        } else {
            return '';
        }
    }

    function sumaFecha($date, $suma) {
        if ($date != '0000-00-00 00:00:00' && $date != null) {
            $nuevaFecha = strtotime($suma, strtotime($date));
            $nuevaFecha = date('Y-m-d', $nuevaFecha);
            return $nuevaFecha;
        } else {
            return '';
        }
    }

    function sumaFechaHora($date, $suma) {
        if ($date != '0000-00-00 00:00:00' && $date != null) {
            $nuevaFecha = strtotime($suma, strtotime($date));
            $nuevaFecha = date('Y-m-d H:i:s', $nuevaFecha);
            return $nuevaFecha;
        } else {
            return '';
        }
    }

    function horasDiff($fecha_fin, $fecha_ini) {
        $ini  = new DateTime($fecha_ini);
        $fin  = new DateTime($fecha_fin);
        $diff = $fin->diff($ini);
        $sign = ($ini <= $fin) ? 1 : -1;
        return $sign * ($diff->days * 24 + $diff->h);
    }

    function diasDiff($fecha_fin, $fecha_ini) {
        $ini  = new DateTime($fecha_ini);
        $fin  = new DateTime($fecha_fin);
        $diff = $fin->diff($ini);
        $sign = ($ini <= $fin) ? 1 : -1;
        return $sign * $diff->days;
    }

    function toDate($fecha) {
        if ($fecha != '0000-00-00 00:00:00' && $fecha != null) {
            $newDate = date($fecha);
            return $newDate;
        } else {
            return '';
        }
    }

    function dmyToYMD24H($cadena) {
        $new_time = DateTime::createFromFormat('d/m/Y h:i A', $cadena);
        $time_24  = $new_time->format('Y-m-d H:i:s');
        return $time_24;
    }

    function esMayorIgual($fecha1, $fecha2) {
        $a = toDate($fecha1);
        $b = toDate($fecha2);

        return ($a >= $b) ? 1 : 0;
    }

    // Funciones de texto
    function pad($val, $n = 3) {
        return str_pad($val, $n, '0', STR_PAD_LEFT);
    }

    function strtolower_utf8($string) {
        return mb_strtolower($string, 'UTF-8');
    }

    function strtoupper_utf8($string) {
        return mb_strtoupper($string, 'UTF-8');
    }

    // Funciones numericas
    function nformat($value, $d = 0) {
        return number_format($value, $d, '.', '');
    }

    function nformatEmpty($value, $d = 0) {
        return isset($value) ? number_format($value, $d, '.', '') : '';
    }

    function nformatNull($value, $d = 0) {
        return isset($value) ? number_format($value, $d, '.', '') : null;
    }

    function intformat($value) {
        if ($value > intval($value) || $value < intval($value)) {
            return $value;
        } else {
            return intval($value);
        }
    }

    function int_nformat($value, $d = 0) {
        if ($value > intval($value) || $value < intval($value)) {
            return number_format($value, $d, '.', '');
        } else {
            return intval($value);
        }
    }

    function int_vformat($value) {
        if ($value > intval($value) || $value < intval($value)) {
            $aux1 = number_format($value, 1, '.', '');
            $aux2 = number_format($value, 2, '.', '');

            return ($value == $aux1) ? $aux1 : $aux2;
        } else {
            return intval($value);
        }
    }

    function EmptyZero($val) {
        return ($val != 0) ? $val : '';
    }

    function GuionZero($val) {
        return ($val != 0) ? $val : '-';
    }

    function GetArrayByColumns($array, $col_names) {
        $vector    = array();
        $col_names = is_array($col_names) ? $col_names : [$col_names];

        foreach ($array as $key => $item) {
            foreach ($col_names as $col_name) {
                $vector[$key][$col_name] = $item[$col_name];
            }
        }
        return $vector;
    }

    function GetArrayByColumn($array, $col_name) {
        $vector = array();
        foreach ($array as $key => $item) {
            $vector[$key] = $item[$col_name];
        }
        return $vector;
    }

    function GetVectorByColumn($array, $col_name) {
        $vector = [];
        foreach ($array as $item) {
            $vector[] = $item[$col_name];
        }
        return $vector;
    }

    function GetVector($array) {
        $vector = array();
        foreach ($array as $key => $item) {
            $vector[] = $item;
        }
        return $vector;
    }

    // algoritmo quicksort
    function ordenar($vector, &$nros) {
        $len   = count($vector);
        $mitad = $len / 2;

        for ($i = 0; $i < $len; $i++) {
            $nros[$i] = $i;
        }

        for ($salto = $mitad; $salto != 0; $salto = intval($salto / 2)) {

            $cambios = true;
            while ($cambios) { // Mientras se intercambie algún elemento
                $cambios = false;
                for ($i = $salto; $i < $len; $i++) // se da una pasada
                {
                    if ($vector[$i - $salto] > $vector[$i]) { // y si están desordenados
                        $aux                 = $vector[$i]; // se reordenan
                        $vector[$i]          = $vector[$i - $salto];
                        $vector[$i - $salto] = $aux;

                        $x                 = $nros[$i]; // se reordenan
                        $nros[$i]          = $nros[$i - $salto];
                        $nros[$i - $salto] = $x;

                        $cambios = true; // y se marca como cambio.
                    }
                }
            }
        }
    }

    function print_value($value) {
        echo "<pre>$value</pre>";
    }

    function print_array($value) {
        echo "<pre>";
        $value = is_array($value) ? $value : [$value];
        print_r($value);
        echo "</pre>";
    }

    function exists_in($dato, $arreglo) {
        foreach ($arreglo as $item) {
            if ($dato == $item) {
                return $item;
            }
        }
        return null;
    }

    function SiNo($valor) {
        if ($valor == 1) {
            return 'Sí';
        } elseif ($valor == 0) {
            return 'No';
        }
        return '';
    }

    function save_file($ruta, $archivo, $contenido) {
        $archivo = fopen("$ruta/$archivo", "a+");
        fwrite($archivo, $contenido."\n");
        fclose($archivo);
    }

    function GetParam($key, $default = '') {
        return isset($_GET["$key"]) ? $_GET["$key"] : $default;
    }

    function PostParam($key, $default = '') {
        return isset($_POST["$key"]) ? $_POST["$key"] : $default;
    }

    // Entrada: [año][mes][dia][hora][min][seg]
    // ej. 20180101050010 -> 2018-01-01 05:00:10
    function convertToDate($date) {
        $anio = substr($date, 0, 4);
        $mes  = substr($date, 4, 2);
        $dia  = substr($date, 6, 2);
        $hora = substr($date, 8, 2);
        $min  = substr($date, 10, 2);
        $seg  = substr($date, 12, 2);
        return "$anio-$mes-$dia $hora:$min:$seg";
    }