<?php
require_once './../../core/Modelo.php';

class Estadistica extends Modelo {
    public function __construct(){
        parent::__construct('1');
    }
    public function getCalculoIndicador($evaluacion, $area, $nivel, $grado){
        $sql = "SELECT * FROM calculoindicador where idevaluacion=? and grado=? and idnivel=? and idarea=? ";
        $parametros = [$evaluacion, $grado, $nivel, $area];
        return $this->_bd->ejecutar($sql,$parametros)['data'];
    }
    public function getMatriz($evaluacion, $area, $nivel, $grado)  {
        $sql = "SELECT * FROM matriz where idevaluacion=? 
            and grado=? and nivel=? and idcurso=? order by item";
        $parametros = [$evaluacion, $grado, $nivel, $area];
        return $this->_bd->ejecutar($sql,$parametros)['data'];
    }
    public  function getDataEvaluacion($tabla,$area, $nivel, $grado, 
            $ugel=0, $distrito=0, $gestion=0, $zona=0, $ie=0, $seccion=0, $sexo=0) {
        $sql = "SELECT * FROM $tabla WHERE area=? and nivel=? and grado=?";

        if ($ugel!=0) $sql .= " AND ugel = '$ugel'";
        if ($distrito!=0) $sql .= " AND distrito = '$distrito'";
        if ($gestion!=0) $sql .= " AND gestion = '$gestion'";
        if ($zona!=0) $sql .= " AND zona = '$zona'";
        if ($ie!=0) $sql .= " AND codigomodular = '$ie' ";
        if ($seccion!=0) $sql .= " AND seccion = '$seccion'";
        if ($sexo!=0) $sql .= " AND sexo = '$sexo'";
            
        $parametros = [$area, $nivel, $grado];
        /* var_dump($sql);exit; */
        return [
            'datos'=>$this->_bd->ejecutar($sql,$parametros)['data'],
            'matriz'=>$this->getMatriz($tabla, $area, $nivel, $grado),
            'indicadores'=>$this->getCalculoIndicador($tabla, $area, $nivel, $grado)
        ];
    }
    public  function getTotalDataEvaluacion($tabla,$area, $nivel, $grado, 
            $ugel=0, $distrito=0, $gestion=0, $zona=0, $ie, $seccion, $sexo) {
        $sql = "SELECT count(id) as total FROM $tabla WHERE area=? and nivel=? and grado=? ";

        if ($ugel!=0) $sql .= " AND ugel = '$ugel'";
        if ($distrito!=0) $sql .= " AND distrito = '$distrito'";
        if ($gestion!=0) $sql .= " AND gestion = '$gestion'";
        if ($zona!=0) $sql .= " AND zona = '$zona'";
        if ($ie!=0) $sql .= " AND codmodular = '$ie' ";
        if ($seccion!=0) $sql .= " AND seccion = '$seccion'";
        if ($sexo!=0) $sql .= " AND sexo = '$sexo'";

        $parametros = [$area, $nivel, $grado];

        return $this->_bd->ejecutar($sql,$parametros)['data'][0]['total'];
    }

}
