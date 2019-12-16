<?php
    define('RUTA_TEXTO', '../../../recursos/texto');

    function abrir_archivo($ruta, $archivo) {
        $archivo = fopen("$ruta/$archivo", "r");
        return $archivo;
    }

    function guardar_archivo($ruta, $archivo, $contenido) {
        $archivo = fopen("$ruta/$archivo", "a+");
        $rpta    = fwrite($archivo, $contenido . "\n");
        fclose($archivo);
        return $rpta;
    }

    function limpiar_archivo($ruta, $archivo) {
        $archivo = fopen("$ruta/$archivo", "w+");
        $rpta    = fwrite($archivo, "");
        fclose($archivo);
        return $rpta;
    }

    function limpiar_dato($texto) {
        $texto = str_replace('\t', '', $texto);
        return $texto;
    }