<?php
require_once './core/Controlador.php';

abstract class CtrlError extends Controlador{
    public static function mostrar($err = null): void {
        // echo "Saludos desde " .__CLASS__;
        
       self::show('error.php',$err);
    }
    public static function mostrar404(): void {
        
        self::show('404.html');
    }

}