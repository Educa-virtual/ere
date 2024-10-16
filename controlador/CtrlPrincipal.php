<?php
session_start();

require_once './core/Controlador.php';
require_once './modelo/Ere.php';

class CtrlPrincipal extends Controlador{
    public function index(){
        $ere = new Ere;
        $dataLogin = [
            'contador'=> $ere->getContador()['data'],
            'evaluaciones'=>$ere->getAllData('evaluacion','descripcion desc'),
            
        ];
        $datos = [
            'contenido'=>$this->show('index.php',$dataLogin,true)
        ];
        $this->show('template.php',$datos);
    }
    
   

}