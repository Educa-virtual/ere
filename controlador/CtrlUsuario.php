<?php
session_start();

require_once './core/Controlador.php';
require_once './modelo/Usuario.php';

class CtrlUsuario extends Controlador{
    private $_usuario;
    public function index(){
        $ere = new Ere;
        $datos = [
            'contador'=> $ere->getContador()['data'],
            'evaluaciones'=>$ere->getAllData('evaluacion','descripcion desc')
        ];

        $this->show('index.php',$datos);
    }

    public function validar() {
        

        if (! $this->preValidar())
            $this->cerrarSesion();
        
        $this->_usuario = new Usuario;
        
        $this->_usuario->validar($_POST['usuario'],$_POST['clave']);
        
        if (! isset($_SESSION)){
            header("Location: index.php"); die();
        }
        if ($_SESSION["dni"] == '') {
            $this->cerrarSesion();
        }
        //TODO
        $this->showDashBoard($_SESSION['idTipo']);
        
    }
    
   private function preValidar():bool {
        $u = isset($_POST['usuario'])?$_POST['usuario']:'';
        $p = isset($_POST['clave'])?$_POST['clave']:'';
        
        return (($p == '') || ($u == ''))?false:true;
    }
    public function cerrarSesion(){
        session_destroy();
        
        header("Location: ?"); die();
    }
    private function showDashBoard($idTipo){
        // Si es 1: Administrador, 3:Dremo, 4: Ugel
        // echo $idTipo;
       //$secciones = $this->_usuario->getGrados()['data'];

        //$niveles = Helper::separa2Array($secciones, 'Primaria');
        $ugel = $this->_usuario->getUgelUsuario($_SESSION['idDetalles'])['data'][0]['ugel'];
        $ie = $this->_usuario->getIeUsuario($_SESSION['idDetalles'])['data'][0];
        //var_dump($_SESSION['idDetalles']);exit;

        $dataPrincipal = [
            'idUgel'=>$ugel,
            'nombreUgel'=>($ugel!=null)?$this->getNombreUgel($ugel):'',
            'ie'=>$ie
        ];

        // var_dump($dataPrincipal);exit;
        $home = $this->show('administrador/principal.php',$dataPrincipal,true);

        if (in_array($idTipo,[1,3,4])){

            $menu = $this->show('template/nav.php',null,true);
            $datos = array(
                'menu'=> $menu,
                'contenido'=>$home
            );
            echo json_encode($datos);
            //$this->show('template.php',$datos); 
        } else {
            echo "Tipo:  ". $_SESSION['idTipo'];
        }
    }
    private function getNombreUgel($ugel){
        $nombreUgel = null;
        switch ($ugel) {
            case 'gsc':
                $nombreUgel = 'General Sanchez Cerro';
                break;
            case 'ilo':
                $nombreUgel = 'Ilo';
                break;
            case 'mn':
                $nombreUgel = 'Mariscal Nieto';
                break;
            case 'sanig':
                $nombreUgel = 'San Ignacion de Loyola';
                break;
        }
        return $nombreUgel;
    }

}