
<?php
date_default_timezone_set('America/Lima');

abstract class Helper {

    static function getSOCliente() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        $osArray = [
            'Windows 10' => '/Windows NT 10.0/i',
            'Windows 8.1' => '/Windows NT 6.3/i',
            'Windows 8' => '/Windows NT 6.2/i',
            'Windows 7' => '/Windows NT 6.1/i',
            'Windows Vista' => '/Windows NT 6.0/i',
            'Windows Server 2003/XP x64' => '/Windows NT 5.2/i',
            'Windows XP' => '/Windows NT 5.1/i',
            'Windows 2000' => '/Windows NT 5.0/i',
            'Mac OS X' => '/Mac OS X/i',
            'Mac OS' => '/Mac_PowerPC/i',
            'Linux' => '/Linux/i',
            'Ubuntu' => '/Ubuntu/i',
            'iPhone' => '/iPhone/i',
            'iPod' => '/iPod/i',
            'iPad' => '/iPad/i',
            'Android' => '/Android/i',
            'BlackBerry' => '/BlackBerry/i',
            'Mobile' => '/Mobile/i'
        ];

        foreach ($osArray as $os => $regex) 
            if (preg_match($regex, $userAgent)) 
                return $os;

        return 'SO Desconocido';
    }

         /**
          * Obtenemos la IP del Cliente
          */
    static function getIPCliente(): String {
        $ipAddress = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // Check if IP is from shared internet
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // Check if IP is passed from proxy
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // Check if IP is from remote address
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }

        // Handle multiple IPs (when using proxies)
        if (strpos($ipAddress, ',') !== false) {
            $ipList = explode(',', $ipAddress);
            $ipAddress = trim($ipList[0]);
        }

        return $ipAddress;
    }

    static public function getFechaHoraLocal() {
        return array(
            'dia'   =>  date("d"),
            'mes'   =>  date("m"),
            'anio'  =>  date("Y"),
            'hoyBD' =>  date("Y-m-d"),
            'hoy'   =>  date("d-m-Y"),
            'hora'  =>  date("G:i:s")
        );
 
    }
    static function getBrowserCliente() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $browser = "Navegador Desconocido";

        $browserArray = [
            'Edge' => '/Edge/i',
            'Chrome' => '/Chrome/i',
            'Firefox' => '/Firefox/i',
            'Safari' => '/Safari/i',
            'Opera' => '/Opera|OPR/i',
            'Internet Explorer' => '/MSIE|Trident/i'
        ];

        foreach ($browserArray as $name => $regex) {
            if (preg_match($regex, $userAgent)) {
                $browser = $name;
                break;
            }
        }

        return $browser;
    }
    static public function inject($cad)
  { $nop = array('"','<','>','=','where','select','from','*','inner');
	$cad=str_replace($nop, "", $cad);$cad=trim($cad);return $cad;}
  
  static function eliminaCaracterEspecial($string)//todo en mayusculas
  {  
    // Mapa de caracteres con tildes y sus equivalentes sin tildes
    $caracteresNoReconocidos = [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
        'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
        'à' => 'a', 'è' => 'e', 'ì' => 'i', 'ò' => 'o', 'ù' => 'u',
        'À' => 'A', 'È' => 'E', 'Ì' => 'I', 'Ò' => 'O', 'Ù' => 'U',
        'ä' => 'a', 'ë' => 'e', 'ï' => 'i', 'ö' => 'o', 'ü' => 'u',
        'Ä' => 'A', 'Ë' => 'E', 'Ï' => 'I', 'Ö' => 'O', 'Ü' => 'U',
        'â' => 'a', 'ê' => 'e', 'î' => 'i', 'ô' => 'o', 'û' => 'u',
        'Â' => 'A', 'Ê' => 'E', 'Î' => 'I', 'Ô' => 'O', 'Û' => 'U',
        'ã' => 'a', 'ñ' => 'n', 'õ' => 'o', 'Ã' => 'A', 'Ñ' => 'N', 'Õ' => 'O',
        'å' => 'a', 'Å' => 'A', 'æ' => 'ae', 'Æ' => 'AE', 'ç' => 'c', 'Ç' => 'C',
        'ø' => 'o', 'Ø' => 'O', 'œ' => 'oe', 'Œ' => 'OE', 'ß' => 'ss',
        '¿' => '', '¡' => ''
    ];

    // Reemplaza los caracteres
    return strtr($string, $caracteresNoReconocidos);
  }

  static function getOrdinal($numero) {
    $data = [
        1 => '1ro.', 2 => '2do.', 3 => '3ro.', 4 => '4to.', 5 => '5to.',
        6 => '6to.', 7 => '7mo.', 8 => '8vo.', 9 => '9no.', 10 => '10mo.'
    ];

    return (array_key_exists($numero, $data)) ? $data[$numero]:"Clave no encontrada";
    
  }

  static function separa2Array($data,$valor=''){
    $seleccionados = [];
    $otros=[];
    
    foreach ($data as $item) 
        if ($item['nivel'] === $valor) 
            $seleccionados[] = $item;
         else 
            $otros[] = $item;
    
    return array($seleccionados,$otros);
  }
    static function estoyATiempo($fechaVencimiento) : bool {
        $hoy = new DateTime();
        $hoy->setTime(0, 0, 0); // Establecer hora a 23:59:59
        $vencimiento = new DateTime($fechaVencimiento);
        $vencimiento->setTime(23, 59, 59); // Establecer hora a medianoche
        
        return $hoy <= $vencimiento;
    }
    static function formatoFecha($fecha): string {
        $fechaObj = new DateTime($fecha);
        $diaSemana = [
            'Mon' => 'lunes,',
            'Tue' => 'martes, ',
            'Wed' => 'miércoles, ',
            'Thu' => 'jueves, ',
            'Fri' => 'viernes, ',
            'Sat' => 'sábado, ',
            'Sun' => 'domingo, '
        ];
        $diaSemanaFormateado = $diaSemana[$fechaObj->format('D')];
        return $diaSemanaFormateado.  $fechaObj->format('d/m/Y');
    }
    static function formatearNumero($numero,$decimiales = 2) : string {
        return number_format($numero, $decimiales, ',', ' ');
        
    }
    static function getArrayFromGET($texto,$caracter='|') : array {
    return explode($caracter, $texto);
    }

}






