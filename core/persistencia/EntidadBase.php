<?php
require_once "BaseDeDatos.php";
class EntidadBase
{
    private $_tabla;
    protected $_bd;

    private $_sql='';
    private $_parametros=[];

    
    public function __construct($tabla) {
        $this->_tabla=(string) $tabla;
        $this->_bd = new BaseDeDatos(new MySQL()); 
        
    }

    public function getAll(){
        $sql = "SELECT * FROM ". $this->_tabla;
        $parametros = [];
        
        return $this->_bd->ejecutar($sql,$parametros);
    }

    public function getAllData($tabla,$order=''){
        $sql = "SELECT * FROM $tabla";
        $parametros = [];
        if ($order!='')
            $sql .= " ORDER BY $order";
                
        return $this->_bd->ejecutar($sql,$parametros)['data'];
    }

   
 
    /*
     * Aquí podemos montarnos un montón de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
     
}
?>
