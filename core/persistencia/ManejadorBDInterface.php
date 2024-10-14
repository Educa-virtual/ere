<?php
interface ManejadorBDInterface
{
    public function conectar();

    public function desconectar();

    public function exeQuery($sql, $parametros);
   /*  public function traerDatos(SQL $sql); */
}