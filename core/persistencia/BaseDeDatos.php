<?php
require_once "MySQL.php";
require_once "SQL.php";
class BaseDeDatos {
    
    private $_manejador;

    public function __construct(ManejadorBDInterface $manejador){
        $this->_manejador  = $manejador;
    }
    public function ejecutar($sql,$parametros){
        $this->_manejador->conectar();
        
        $retorno = $this->_manejador->exeQuery($sql,$parametros);
        
        $this->_manejador->desconectar();
        return $retorno;
    }
}