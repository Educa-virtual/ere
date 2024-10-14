<?php
require_once './../../core/Modelo.php';
class ReportesSubirArchivos extends Modelo
{
    public function __construct()
    {
        parent::__construct('1');
    }
    public function getTotales()
    {
        // Total de instituciones
        $sql = "SELECT count(*) as total FROM ies";
        $parametros = [];
        $total = $this->_bd->ejecutar($sql, $parametros)['data'][0];
        // IIES que subieron archivos
        $sql = "SELECT count(*) as total FROM ies
            where codmodular  
            in (Select cod_modular from ie_examen where examen is not null);";
        $ieeSubieron = $this->_bd->ejecutar($sql, $parametros)['data'][0];
        // IIES que no subieron archivos
        $sql = "SELECT count(*) as total FROM ies
            where codmodular  
            not in (Select cod_modular from ie_examen where examen is not null);";
        $ieeNoSubieron = $this->_bd->ejecutar($sql, $parametros)['data'][0];

        // archivos Validados
        $sql = "SELECT count(*) as total FROM ies
            where codmodular  
            in (Select cod_modular from ie_examen where examen is not null and validacion=1);";
        $validados = $this->_bd->ejecutar($sql, $parametros)['data'][0];
        // archivos Procesados
        $sql = "SELECT count(*) as total FROM ies
            where codmodular  
            in (Select cod_modular from ie_examen where examen is not null and examen2='1');";
        $procesados = $this->_bd->ejecutar($sql, $parametros)['data'][0];
        return [
            'total' => $total['total'],
            'ieSubieron' => $ieeSubieron['total'],
            'ieNoSubieron' => $ieeNoSubieron['total'],
            'ieValidados' => $validados['total'],
            'ieProcesados' => $procesados['total']
        ];
    }
    public function getTotalesXUgel($ugel)
    {
        // Total de instituciones
        $sql = "SELECT count(*) as total FROM ies where ugel=?";
        $parametros = [$ugel];
        $total = $this->_bd->ejecutar($sql, $parametros)['data'][0];
        // IIES que subieron archivos
        $sql = "SELECT count(*) as total FROM ies
            where ugel=? and codmodular  
            in (Select cod_modular from ie_examen where examen is not null);";
        $ieeSubieron = $this->_bd->ejecutar($sql, $parametros)['data'][0];
        // IIES que no subieron archivos
        $sql = "SELECT count(*) as total FROM ies
            where ugel=? and codmodular  
            not in (Select cod_modular from ie_examen where examen is not null);";
        $ieeNoSubieron = $this->_bd->ejecutar($sql, $parametros)['data'][0];

        // archivos Validados
        $sql = "SELECT count(*) as total FROM ies
            where ugel=? and codmodular  
            in (Select cod_modular from ie_examen where examen is not null and validacion=1);";
        $validados = $this->_bd->ejecutar($sql, $parametros)['data'][0];
        // archivos Validados
        $sql = "SELECT count(*) as total FROM ies
            where ugel=? and codmodular  
            in (Select cod_modular from ie_examen where examen is not null and examen2='1');";
        $procesados = $this->_bd->ejecutar($sql, $parametros)['data'][0];

        return [
            'total' => $total['total'],
            'ieSubieron' => $ieeSubieron['total'],
            'ieNoSubieron' => $ieeNoSubieron['total'],
            'ieValidados' => $validados['total'],
            'ieProcesados' => $procesados['total']
        ];
    }
    public function getIIEEnoSubieronXUGEL($ugel)
    {
        // IIES que no subieron archivos
        $sql = "SELECT * FROM ies
            where ugel=? and codmodular  
            not in (Select cod_modular from ie_examen where examen is not null)
            order by distrito, codmodular;";
        $parametros = [$ugel];
        return $this->_bd->ejecutar($sql, $parametros)['data'];
    }
}
