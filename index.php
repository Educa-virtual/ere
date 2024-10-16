<?php
abstract class Index
{
    public static function ejecutar() {
        
        $miControlador = isset ($_GET['ctrl'])?$_GET['ctrl']:'CtrlPrincipal';
        $accion = isset($_REQUEST['accion'])?$_REQUEST['accion']:'index';

        $ctrlError = './controlador/CtrlError.php';
        if (file_exists($ctrlError) == false) {     // Si no existe el Error
                trigger_error ('El Controlador ' . $ctrlError . ' no Existe.', E_USER_NOTICE);
                return false;
        }
        require_once $ctrlError;
        self::runController($miControlador, $accion);
    }
    private static function runController($miControlador, $accion) {
        $fileControlador = './controlador/'.$miControlador.'.php';
        try {   // Cargamos el Controlador
            @require_once $fileControlador;
            eval ( '$controlador= new '.$miControlador.'();' );
            try {   // Asociamos la acción al Controlador
                $metodo = array($controlador, $accion);
                @eval ( '$controlador->' . $accion . '();' );
            } catch (\Throwable $th) {  // Capturamos errores con el método
                CtrlError::mostrar404();
                exit();
            }
        } catch (\Throwable $th) {  // Capturamos errores con el controlador
            CtrlError::mostrar([ 'th'=>$th ]);
            exit();
        }
    }
}

Index::ejecutar();