<?php
require_once './../../core/Modelo.php';

class cuadernillo extends Modelo
{
    public function __construct()
    {
        parent::__construct('1');
    }
    public function getVerCuadernillo($anio)
    {
        $sql = "SELECT * from historial_ere where anio=?";
        $parametros = [$anio];
        $listadoCuadernillo = $this->_bd->ejecutar($sql, $parametros)['data'];
        return [
            'listadoCuadernillo' => $listadoCuadernillo,
        ];
    }
    public function getIesParticipan($nivel, $ugel, $evaluacion)
    {
        $sql = "SELECT * from ies where ugel=? and nivel=? and codmodular in (
                Select cod_modular from ie_examen where historial_id=?
                )";
        $parametros = [$ugel, $nivel,   $evaluacion];
        $iesParticipan = $this->_bd->ejecutar($sql, $parametros)['data'];
        $sql = "SELECT * from ies where ugel=? and nivel=? and codmodular not in (
                Select cod_modular from ie_examen where historial_id=?
                )";
        $parametros = [$ugel, $nivel,   $evaluacion];
        $iesNoParticipan = $this->_bd->ejecutar($sql, $parametros)['data'];
        //Necesitamos sabe cuales participan en la Evaluación.
        //CONTEO
        $sqlParticipan = "SELECT COUNT(*) as total FROM ies WHERE ugel=? AND nivel=? AND codmodular IN (
    SELECT cod_modular FROM ie_examen WHERE historial_id=?)";
        $parametrosParticipan = [$ugel, $nivel, $evaluacion];
        $resultadoParticipan = $this->_bd->ejecutar($sqlParticipan, $parametrosParticipan);
        $totalParticipan = $resultadoParticipan['data'][0]['total'];
        // Contar IES que no participan
        $sqlNoParticipan = "SELECT COUNT(*) as total FROM ies WHERE ugel=? AND nivel=? AND codmodular NOT IN (
      SELECT cod_modular FROM ie_examen WHERE historial_id=?)";
        $parametrosNoParticipan = [$ugel, $nivel, $evaluacion];
        $resultadoNoParticipan = $this->_bd->ejecutar($sqlNoParticipan, $parametrosNoParticipan);
        $totalNoParticipan = $resultadoNoParticipan['data'][0]['total'];
        return [
            'iesParticipan' => $iesParticipan,
            'iesNoParticipan' => $iesNoParticipan,
            'totalParticipan' => $totalParticipan,
            'totalNoParticipan' => $totalNoParticipan
        ];
    }
    // Método para insertar en la tabla ie_examen

}
