// funciones clase string:
// <HACK> para admitir la funcion trim() en IE (8 y anteriores)
if (typeof String.prototype.trim !== 'function') {
    String.prototype.trim = function () {
        return this.replace(/^\s+|\s+$/g, '');
    }
}

// Valida si "n" es un numero (decimal o entero)
// (NOTA: no debe convertirse con "+n")
function isNumeric(n) {
    return $.isNumeric(n);
}

// Valida si "n" es un numero entero
// (no debe convertirse con "+n")
function isInteger(n) {
    return $.isNumeric(n) && n % 1 === 0;
}

// Valida si "n" es un numero entero
// (no debe convertirse con "+n")
function isTinyint(n) {
    return $.isNumeric(n) && n % 1 === 0 && n >= 0 && n <= 255;
}

// Validar direccion de correo
function isEmail(campo) {
    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
    return pattern.test(campo);
}

// Validar que una cadena solo tenga letras
function validUsuario(cadena) {
    var pattern = /^[a-z0-9_]+$/i;
    return pattern.test(cadena);
}

function validContrasena(cadena) {
    var pattern = /^[a-z0-9#@\-._]+$/i;
    return pattern.test(cadena);
}

function validNombre(cadena) {
    var pattern = /^[a-zñáéíóúü ]+$/i;
    return pattern.test(cadena);
}

function validDescripcion(cadena) {
    var pattern = /^[a-zñáéíóúü0-9.! ]+$/i;
    return pattern.test(cadena);
}

function validDireccion(cadena) {
    var pattern = /^[a-zñáéíóúü0-9#\-.() ]+$/i;
    return pattern.test(cadena);
}

function validTelefono(cadena) {
    var pattern = /^[0-9#\-() ]+$/i;
    return pattern.test(cadena);
}

function validPlaca(cadena) {
    var pattern = /^([A-Z0-9])+[\-][A-Z0-9]+([\-][A-Z0-9]+)*$/i;
    return pattern.test(cadena);
}

function validNroDoc(cadena) {
    var pattern = /^[0-9F\-]+$/i;
    return pattern.test(cadena);
}

function validText(cadena) {
    var pattern = /^[a-zñáéíóúü0-9.,;\-#@_=()\[\]><?+*/ ]+$/i;
    return pattern.test(cadena);
}

// funciones de fecha y hora:
function getDateYMD(ddmmyy) {
    if (ddmmyy !== '') {
        var parts = ddmmyy.split("/");
        return parts[2] + '-' + parts[1] + '-' + parts[0];
    } else {
        return '';
    }
}

function getSelectedCheckboxes(name) {
    var selected = [];
    $('input[name="' + name + '"]:checked').each(function () {
        selected.push(parseInt($(this).attr('value')));
    });
    return selected;
}

function sortNumeric(vector) {
    vector.sort(function (a, b) {
        return a - b;
    });
}

function dateCompare(fecha1, fecha2) {
    var a = new Date(fecha1);
    var b = new Date(fecha2);
    return (a > b) ? 1 : (a < b) ? -1 : 0;
}

function toDateYMD(fecha) {
    return new Date(getDateYMD(fecha));
}

function toDate(fecha) {
    return new Date(fecha);
}

// Convierte a float si "valor" es numérico, sino retorna "def"
function toFloat(valor, def) {
    def = (typeof def !== 'undefined') ? def : 0;
    return isNumeric(valor) ? parseFloat(valor) : def;
}

// Convierte a entero si "valor" es numérico, sino retorna "def"
function toInteger(valor, def) {
    def = (typeof def !== 'undefined') ? def : 0;
    return isNumeric(valor) ? parseInt(valor) : def;
}

// Entrada d/m/Y, Salida date object
function sumarDias(fecha, dias) {
    console.log('fecha: ' + fecha);
    console.log('dias: ' + dias);
    if (fecha !== '') {
        var datepart = fecha.split("/");
        var newdate  = new Date(datepart[2], datepart[1] - 1, datepart[0]);
        newdate.setDate(newdate.getDate() + parseInt(dias));
        return newdate;
    } else {
        return '';
    }
}

// Entrada d/m/Y, Salida date object
function sumarMeses(fecha, meses) {
    console.log('fecha: ' + fecha);
    console.log('meses: ' + meses);
    if (fecha !== '') {
        var datepart = fecha.split("/");
        var newdate  = new Date(datepart[2], datepart[1] - 1, datepart[0]);
        newdate.setMonth(newdate.getMonth() + parseInt(meses));
        return newdate;
    } else {
        return '';
    }
}

// Entrada d/m/Y, Salida date object
function sumarAnios(fecha, anios) {
    console.log('fecha: ' + fecha);
    console.log('anios: ' + anios);
    if (fecha !== '') {
        var datepart = fecha.split("/");
        var newdate  = new Date(datepart[2], datepart[1] - 1, datepart[0]);
        newdate.setFullYear(newdate.getFullYear() + parseInt(anios));
        return newdate;
    } else {
        return '';
    }
}


function formatDate(date) {
    return pad(date.getDate(), 2) + '/' + pad(date.getMonth() + 1, 2) + '/' + date.getFullYear();
}

function formatDateAM(date) {
    return pad(date.getDate(), 2) + '/' + pad(date.getMonth() + 1, 2) + '/' + date.getFullYear()
           + " " + pad(date.getHours()) + ":" + pad(date.getMinutes(), 2) + ":" + pad(date.getSeconds(), 2);
}

function formatYMD(date) {
    return date.getFullYear() + '-' + pad(date.getMonth() + 1, 2) + '-' + pad(date.getDate(), 2);
}

// Validar una fecha
// Entrada: [D/M/Y]
function isDate(campo) {

    var valor = campo;
    if (valor === '') {
        return false;
    }

    var datePattern = /^(\d{1,2})([\/-])(\d{1,2})([\/-])(\d{4})$/; //Declare Regex
    var datePart    = valor.match(datePattern); // is format OK?
    if (datePart === null) {
        return false;
    }

    // verifica el formato "dd/mm/yyyy".
    var dia  = datePart[1];
    var mes  = datePart[3];
    var anio = datePart[5];

    if (mes < 1 || mes > 12) {
        return false;
    } else if (dia < 1 || dia > 31) {
        return false;
    } else if ((mes === 4 || mes === 6 || mes === 9 || mes === 11) && dia === 31) {
        return false;
    } else if (mes === 2) {
        var bisiesto = (anio % 4 === 0 && (anio % 100 !== 0 || anio % 400 === 0));
        if (dia > 29 || (dia === 29 && !bisiesto)) {
            return false;
        }
    }
    return true;
}

$.datepicker.regional['es'] = {
    prevText          : '',
    nextText          : '',
    currentText       : 'Hoy',
    monthNames        : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort   : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames          : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort     : ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin       : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader        : 'Sm',
    dateFormat        : 'dd/mm/yy',
    firstDay          : 0,
    isRTL             : false,
    showMonthAfterYear: false,
    yearSuffix        : ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);
$.datepicker._gotoToday = function (id) {
    var target = $(id);
    var inst   = this._getInst(target[0]);
    if (this._get(inst, 'gotoCurrent') && inst.currentDay) {
        inst.selectedDay = inst.currentDay;
        inst.drawMonth   = inst.selectedMonth = inst.currentMonth;
        inst.drawYear = inst.selectedYear = inst.currentYear;
    }
    else {
        var date         = new Date();
        inst.selectedDay = date.getDate();
        inst.drawMonth   = inst.selectedMonth = date.getMonth();
        inst.drawYear = inst.selectedYear = date.getFullYear();
        // the below two lines are new
        this._setDateDatepicker(target, date);
        this._selectDate(id, this._getDateDatepicker(target));
    }
    this._notifyChange(inst);
    this._adjustDate(target);
};

function jsonParse(str) {
    try {
        if (str !== 'null') {
            return JSON.parse(str);
        } else {
            return '';
        }
    } catch (e) {
        return '';
    }
}

function pad(val, n) {
    var s = val + '';
    while (s.length < n) {
        s = '0' + s;
    }
    return s;
}

function redondear(num, exp) {
    num = +num;
    exp = +exp;

    num = num.toFixed(exp + 2);
    num = Math.round(+(num + 'e' + exp));
    num = +(num + 'e' + -exp);
    return num;
}

// funciones equivalentes a PHP:
function isBetweenArray(valor, array, col_ini, col_fin, col_return) {
    var i, ini, fin;
    valor = toFloat(valor);

    for (i = 0; i < array.length; i++) {
        ini = toFloat(array[i][col_ini]);
        fin = toFloat(array[i][col_fin]);

        if (valor != '' && ((valor >= ini && valor < fin) || (ini > fin && valor >= ini || valor < fin))) {
            return array[i][col_return];
        }
    }
    return "";
}
