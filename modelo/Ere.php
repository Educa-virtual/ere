<?php
require_once './../../core/Modelo.php';

class Ere extends Modelo
{
    public function __construct()
    {
        parent::__construct('1');
    }
    public function getDistritos4UgelSelect($ugel)
    {
        $sql = "Select * from distrito where ugel=? ORDER BY distrito";
        $parametros = [$ugel];
        return [
            'data' => $this->_bd->ejecutar($sql, $parametros)['data'],
            'clave' => 'distrito',
            'valor' => 'distrito'
        ];
    }
    public function getIe4DistritoSelect($ugel, $nivel, $distrito, $zona, $gestion)
    {
        $sql = "Select * from ies where ugel=? and nivel=?";

        if ($distrito != 0) $sql .= " AND distrito='$distrito'";
        if ($zona != 0) $sql .= " AND zona='$zona'";
        if ($gestion != 0) $sql .= " AND gestion='$gestion'";

        $sql .= " ORDER BY descripcion";
        /* var_dump($sql);exit; */
        $parametros = [$ugel, $nivel];
        /*  $parametros = []; */
        $data = $this->_bd->ejecutar($sql, $parametros);
        if (!$data['success']) {

            var_dump($data);
            exit;
        }
        return [
            'data' => $this->_bd->ejecutar($sql, $parametros)['data'],
            'clave' => 'codmodular',
            'valor' => 'descripcion'
        ];
    }

    public function getGrados4NivelSelect($nivel)
    {
        $sql = "Select distinct nivel, grado from area_nivel_grado where nivel=? ORDER BY grado";
        $parametros = [$nivel];
        return [
            'data' => $this->_bd->ejecutar($sql, $parametros)['data'],
            'clave' => 'nivel|grado',
            'valor' => 'grado'
        ];
    }
    public function getArea4GradoSelect($nivel, $grado)
    {
        $sql = "Select * from area_nivel_grado where nivel=? and grado=? ORDER BY area";
        $parametros = [$nivel, $grado];
        return [
            'data' => $this->_bd->ejecutar($sql, $parametros)['data'],
            'clave' => 'codarea',
            'valor' => 'area'
        ];
    }

    public function getDataEvaluacion($e, $c)
    {
        $sql = "Select * from v_historial_ies where evaluacion=? and codmodular=?";
        $parametros = [$e, $c];
        return  $this->_bd->ejecutar($sql, $parametros)['data'];
    }
    public function getDataEvaluacionPrimaria($e, $c)
    {
        $sql = "Select * from v_historial_ies where historial_id=? and codmodular=? and idgrado in (1,2,3)";
        $parametros = [$e, $c];
        return  $this->_bd->ejecutar($sql, $parametros)['data'];
    }
    public function getDataEvaluacionSecundaria($e, $c)
    {
        $sql = "Select * from v_historial_ies where historial_id=? and codmodular=? and idgrado in (4,5)";
        $parametros = [$e, $c];
        return  $this->_bd->ejecutar($sql, $parametros)['data'];
    }
    public function getDataEvaluacionPrimaria1($h, $c, $e)
    {
        $sql = "Select * from v_historial_ies where historial_id=? and codmodular=? and evaluacion=? and idgrado in (1,2,3)";
        $parametros = [$h, $c, $e];
        return  $this->_bd->ejecutar($sql, $parametros)['data'];
    }
    public function getDataEvaluacionSecundaria1($h, $c, $e)
    {
        $sql = "Select * from v_historial_ies where historial_id=? and codmodular=? and evaluacion=? and idgrado in (4,5)";
        $parametros = [$h, $c, $e];
        return  $this->_bd->ejecutar($sql, $parametros)['data'];
    }
    public function getIesXUgelNivel($u, $n)
    {
        $sql = "Select * from ies where ugel=? and nivel=?  order by distrito,descripcion";
        $parametros = [$u, $n];
        return  $this->_bd->ejecutar($sql, $parametros)['data'];
    }
    public function getUgeles()
    {
        $sql = "Select * from ugel";
        $parametros = [];
        return  $this->_bd->ejecutar($sql, $parametros)['data'];
    }
    public function crear()
    {
        /* $sql = "Select * from ies where id>206";
        $parametros = [];
        $ies = $this->_bd->ejecutar($sql,$parametros)['data'];
        foreach ($ies as $ie) {
            for ($i=1; $i < 16; $i++) { 
               
                $sql = "Insert into ie_examen (historial_id,cod_modular,detalle_id)
                VALUES (1, '".$ie['codmodular']."',$i)";
                $this->_bd->ejecutar($sql,$parametros);
            }
        } */
    }
    public function guardarExamen($historial, $detalle, $codigo, $dest_path, $tipo)
    {
        if ($tipo == 'General') {

            $sql = "Update ie_examen set examen=? WHERE historial_id=? and detalle_id=? and cod_modular=?";
        } else {
            $sql = "Update ie_examen set examen1=? WHERE historial_id=? and detalle_id=? and cod_modular=?";
        }
        $parametros = [$dest_path, $historial, $detalle, $codigo];
        return $this->_bd->ejecutar($sql, $parametros);
    }
    public function validarExamen($historial, $detalle, $codigo, $estado, $obs, $tipo)
    {
        // echo $estado; exit;
        if ($tipo == 'General') {

            $sql = "Update ie_examen set validacion=?, obs=? WHERE historial_id=? and detalle_id=? and cod_modular=?";
        } else {
            $sql = "Update ie_examen set validacion1=?, obs=? WHERE historial_id=? and detalle_id=? and cod_modular=?";
        }
        $parametros = [$estado, $obs, $historial, $detalle, $codigo];
        return $this->_bd->ejecutar($sql, $parametros);
    }
    public function checkUpdateProcesarExamen($historial, $detalle, $codigo)
    {

        $sql = "Update ie_examen set examen2='1' WHERE historial_id=? and detalle_id=? and cod_modular=?";

        $parametros = [$historial, $detalle, $codigo];
        return $this->_bd->ejecutar($sql, $parametros);
    }
    public function getExamen($historial, $detalle, $codigo)
    {

        $sql = "Select * from ie_examen  
        WHERE examen<>'' and historial_id=? and detalle_id=? and cod_modular=?";

        $parametros = [$historial, $detalle, $codigo];

        return $this->_bd->ejecutar($sql, $parametros)['data'];
    }
    public function getOne($tabla, $id)
    {
        $sql = "Select * from $tabla WHERE id=?";

        $parametros = [$id];

        return $this->_bd->ejecutar($sql, $parametros)['data'];
    }
    public function guardarRespuestas($tabla, $datos)
    {
        $sql = "INSERT INTO $tabla (
        fecha, dni, apellidopaterno, apellidomaterno,primernombre,segundonombre,tercernombre, 
        sexo, ie, codigomodular, nivel, distrito, zona, gestion, 
        seccion,respuestas1,respuestas2,respuestas3,respuestas4,respuestas5,respuestas6,
        respuestas7,respuestas8,respuestas9,respuestas10,respuestas11, respuestas12, respuestas13, 
        respuestas14, respuestas15, respuestas16, respuestas17, respuestas18, respuestas19, respuestas20, 
        grado, area, ugel, dnidocente, apepaternodo, apematernodo,nombredo
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $parametros = [
            $datos['fecha'],
            $datos['dni'],
            $datos['apepat'],
            $datos['apemat'],
            $datos['nombre1'],
            $datos['nombre2'],
            $datos['nombre3'],
            $datos['sexo'],
            $datos['ie'],
            $datos['codModular'],
            $datos['nivel'],
            $datos['distrito'],
            $datos['zona'],
            $datos['gestion'],
            $datos['seccion'],
            $datos['r1'],
            $datos['r2'],
            $datos['r3'],
            $datos['r4'],
            $datos['r5'],
            $datos['r6'],
            $datos['r7'],
            $datos['r8'],
            $datos['r9'],
            $datos['r10'],
            $datos['r11'],
            $datos['r12'],
            $datos['r13'],
            $datos['r14'],
            $datos['r15'],
            $datos['r16'],
            $datos['r17'],
            $datos['r18'],
            $datos['r19'],
            $datos['r20'],
            $datos['grado'],
            $datos['area'],
            $datos['ugel'],
            $datos['dnidoc'],
            $datos['apepatdoc'],
            $datos['apematdoc'],
            $datos['nombredoc']
        ];
        return $this->_bd->ejecutar($sql, $parametros);
    }
    public function eliminarDatosExamen($tabla, $wh)
    {
        $sql = "DELETE FROM $tabla WHERE codigomodular=? and nivel=? and grado=? and area=?";
        $parametros = [$wh['codmodular'], $wh['nivel'], $wh['grado'], $wh['area']];
        return $this->_bd->ejecutar($sql, $parametros);
    }
    public function getDataHistorialIE($evaluacion, $codmodular, $coddetalle)
    {
        $sql = "SELECT * FROM v_historial_ies WHERE evaluacion=? and detalle_id=? and codmodular=?";
        $parametros = [$evaluacion, $coddetalle, $codmodular];
        return $this->_bd->ejecutar($sql, $parametros)['data'];
    }
}
