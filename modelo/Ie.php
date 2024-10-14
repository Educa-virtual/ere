<?php
require_once './../../core/Modelo.php';

class Ie extends Modelo
{
    public function __construct()
    {
        parent::__construct('1');
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
    public function insertarExamen($nivel, $cod_modular, $evaluacion)
    {
        $nivel = strtoupper($nivel);
        $detalle_id = ($nivel == 'PRIMARIA') ? '1' : '2';
        if ($nivel == 'PRIMARIA') {
            $inicio = 1;
            $fin = 7;
        } else {
            $inicio = 8;
            $fin = 15;
        }
        for ($i = $inicio; $i <= $fin; $i++) {
            $sql = "DELETE FROM ie_examen WHERE detalle_id=? AND cod_modular=? AND historial_id=?";
            $parametros = [$i, $cod_modular, $evaluacion];
            $resultado = $this->_bd->ejecutar($sql, $parametros);
            $sql = "INSERT INTO ie_examen (detalle_id, cod_modular, historial_id) VALUES (?, ?, ?)";
            $parametros = [$i, $cod_modular, $evaluacion];
            $resultado = $this->_bd->ejecutar($sql, $parametros);
        }
        return [
            'resultado' => $resultado,
        ];
    }

    // Método para eliminar un registro en la tabla ie_examen
    public function eliminarExamen($cod_modular)
    {

        // Eliminar todos los registros relacionados con el cod_modular
        $sql = "DELETE FROM ie_examen WHERE cod_modular=?";
        $parametros = [$cod_modular];
        $resultado = $this->_bd->ejecutar($sql, $parametros);
        return [
            'resultado' => $resultado,
        ];
    }
}
