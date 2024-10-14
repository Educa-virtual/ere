<?php
include_once "DBManager.php";
class cAdmision
{
    public function __construct()
    {

        $this->Conexion = new DBManager;
    }
    function guardarsesion($usuario, $ip, $navegador, $sistemaopera, $fecha, $hora)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT auditoria (dniusuario,ip,navegador,so,fecha,hora) VALUES ('$usuario', '$ip', '$navegador', '$sistemaopera', '$fecha', '$hora');";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    public function contarprerguntascuadr($idpregunta)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(idpregunta ) FROM pregunta where idnuevaevaluacion= '$idpregunta';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }
    public function preguntase($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM pregunta where idnuevaevaluacion='$dni';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }
    public function idpregunta($idpregunta)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM nuevaevaluacion where idnuevaevaluacion='$idpregunta';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    function guardarcuadernillo($area, $nivelp, $gradosw, $idevaluacion, $fechan)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT INTO nuevaevaluacion (idnuevaevaluacion,nivel,area,grado,evaluacion,fechac) 
         VALUES ('','$nivelp','$area','$gradosw','$idevaluacion','$fechan')";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }


    public function verevaluacionescreadas($nivel, $grado)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM nuevaevaluacion where nivel='$nivel' and grado='$grado';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    function listadocuadernillo($evaluacion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT  * FROM nuevaevaluacion where evaluacion='$evaluacion'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }


    function desevaluacion($idevalua)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM evaluacion where tabla='$idevalua';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }


    public function verperfil($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "call verdetalle('$dni')";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }
    public function listapersofecha($fecha)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT newususario.dni, newususario.nombres,concat(newususario.apellidopat,' ',newususario.apellidomat) as fullnombre, auditoria.ip,auditoria.navegador, auditoria.so, auditoria.fecha,auditoria.hora FROM newususario JOIN auditoria on newususario.dni= auditoria.dniusuario AND auditoria.fecha = '$fecha';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }



    public function moestraries($iddetalle)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM newcomplementodetalle 
            JOIN ies 
            ON newcomplementodetalle.codmodular= ies.codmodular 
            and newcomplementodetalle.iddetalleusuario='$iddetalle';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function verugel($idugel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM ugel where ugel='$idugel';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function veries($idugel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM ies where codmodular='$idugel';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function consultacompleta($tabla)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM $tabla ;";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function consultaconsolidado($ugel, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM ies where ugel='$ugel' and nivel='$nivel' ;";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function consultaiesmatermatica($nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM ies where nivel='$nivel';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function consultagradoner($nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM grados where nivel='$nivel' ;";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }





    public function nombreevaluacion($evaluacion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM evaluacion where tabla='$evaluacion' ;";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function regitroalto($tabla)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT max(id) FROM $tabla  ;";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function contardatos($tabla, $campo, $ugel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM $tabla where $campo= '$ugel';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function contardatosauditgori()
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM auditoria;";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function contargrados($tabla, $nivel, $grado, $area)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM $tabla where nivel='$nivel' and grado='$grado' and area='$area';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function contargradostotal($tabla, $nivel, $grado)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM $tabla where nivel='$nivel' and grado='$grado' ;";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function contardatosmivel($tabla, $campo, $ugel, $grado)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM $tabla where $campo= '$ugel' and grado= '$grado';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function contardatosmatematica($tabla, $area)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM $tabla where area='$area';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function contardatosmatematicanivel($tabla, $area, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM $tabla where area='$area' and nivel='$nivel';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function contardatosmatematicanivelcod($tabla, $area, $codigomudlar)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM $tabla where area='$area'  and codigomodular='$codigomudlar';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function contardatosmatematicanivelcodg($tabla, $area, $codigomudlar, $grado)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM $tabla where area='$area'  and codigomodular='$codigomudlar' and grado='$grado';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function contardatosmatematicanivelseci($tabla, $area, $codigomudlar, $grado, $seccion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM $tabla where area='$area'  and codigomodular='$codigomudlar' and grado='$grado' and seccion='$seccion';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }




    public function contardatosevarea($tabla, $grado, $ugel, $codigomodular, $area)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(id) FROM $tabla where grado= '$grado' and ugel='$ugel' and codigomodular='$codigomodular' and area ='$area';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function verusuarios($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM newususario where dni='$dni';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }



    public function conteverusuariosdetalle($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT count(iddetalleus) FROM newdetalleusuario where dnidocente='$dni';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function verusuariosdetalle($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM newdetalleusuario where dnidocente='$dni';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function veriesfilro($distrito, $ugel, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM ies where distrito='$distrito' and ugel='$ugel' and nivel='$nivel';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }



    public function evaluacionmoestrar($ideva)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM evaluacion where id='$ideva';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function evaluacionmoestrartipo($ideva)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM tipo where idtipo='$ideva';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }
    public function datacompletanew($evaluacion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM $evaluacion;";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    function datanewdetalle($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM newdetalleusuario where dnidocente='$dni';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function datatipo($tipo)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM tipo where idtipo ='$tipo';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function dataevaluacion($evaluacion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM evaluacion where id ='$evaluacion';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }


    function descripcionealuacion($evaluacion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM evaluacion where tabla ='$evaluacion';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function mostrardatosmatriz($evaluacion, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT DISTINCT(area),idcurso FROM matriz WHERE idevaluacion='$evaluacion' and nivel='$nivel';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function mostrardatosmatrizb($evaluacion, $nivel, $idcurso)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT DISTINCT(grado) FROM matriz WHERE idevaluacion='$evaluacion' and nivel='$nivel' and idcurso='$idcurso';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }



    public function vertotalusuarios()
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT tipo.descripcion as tipo, COUNT(newdetalleusuario.id) as total from tipo JOIN newdetalleusuario on tipo.id = newdetalleusuario.tipo GROUP by tipo.descripcion;";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    function datacomplementodetalle($idetalle)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM newcomplementodetalle where iddetalleusuario='$idetalle'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }




    function datacompletaevaluaciontabla($tabla)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM $tabla";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }


    function datacompletaevaluacionlista()
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM evaluacion";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }



    function verestado($dnid)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT count(iddetalleus) FROM newdetalleusuario where dnidocente='$dnid';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function verestadorol($dnid)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM newdetalleusuario JOIN tipo ON newdetalleusuario.tipo=tipo.idtipo AND newdetalleusuario.dnidocente='$dnid';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }



    function contardetalle($iddetalle)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT COUNT(id) FROM newcomplementodetalle WHERE iddetalleusuario='$iddetalle'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }



    function sesioningreso($dni, $clave)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM newdetalleusuario JOIN newususario on newususario.dni=newdetalleusuario.dnidocente JOIN tipo ON newdetalleusuario.tipo=tipo.idtipo AND newdetalleusuario.dnidocente='$dni' and newdetalleusuario.clave='$clave';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }



    function listatexttipo($text)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM `newususario` INNER JOIN newdetalleusuario on newususario.dni = newdetalleusuario.dnidocente and newdetalleusuario.tipo='$text';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }



    function guardarpregunta($idnuevaevaluacion, $nro, $descripcion, $a, $alternativaa, $b, $alternativab, $c, $alternativac, $d, $alternativad)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT INTO pregunta (idpregunta,idnuevaevaluacion,nro,descripcion,a,alternativaa,b,alternativab,c,alternativac,d,alternativad) 
         VALUES ('','$idnuevaevaluacion','$nro','$descripcion','$a','$alternativaa','$b','$alternativab','$c','$alternativac','$d','$alternativad')";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }


    function guardarperfil($dnidocente, $clave, $tipo, $periodo, $estado, $idevaluacion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT INTO newdetalleusuario (dnidocente,clave,tipo,periodo,estado,idevaluacion) 
         VALUES ('$dnidocente','$clave','$tipo','$periodo','$estado','$idevaluacion')";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function listatext($text)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM newususario WHERE newususario.nombres LIKE '%$text%'or newususario.apellidopat LIKE '%$text%' or newususario.apellidomat like '%$text%';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function Crearcomplemento($iddetalleusuario, $codmodular, $ugel, $grado, $seccion, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT INTO newcomplementodetalle (iddetalleusuario,codmodular,ugel,grado,seccion,nivel) VALUES ('$iddetalleusuario','$codmodular','$ugel','$grado','$seccion','$nivel')";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function detallerrol($dniusu)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM tipo where id='$dniusu' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function detalleeva($cod)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM evaluacion where id='$cod' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function mostrarugel($detalleusu)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM newcomplementodetalle JOIN ugel ON newcomplementodetalle.ugel=ugel.ugel and newcomplementodetalle.iddetalleusuario='$detalleusu'  ORDER BY newcomplementodetalle.id desc limit 1;";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function contarcome($detalleusu)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT COUNT(id) FROM newcomplementodetalle WHERE iddetalleusuario='$detalleusu';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function mostradireccion($detalleusu)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM newcomplementodetalle JOIN ugel ON newcomplementodetalle.ugel=ugel.ugel JOIN ies on ies.codmodular= newcomplementodetalle.codmodular AND newcomplementodetalle.iddetalleusuario='$detalleusu';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }


    function mostracomplemente($detalleusu)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM newcomplementodetalle where iddetalleusuario='$detalleusu';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }




    function guardarasistencia($dni, $fecha, $hora)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT INTO asistencia (dni,fecha,hora) 
         VALUES ('$dni','$fecha','$hora')";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function guardarmatriz($idevaluacion, $idcurso, $area, $competencia, $capacidad, $desempeno, $conocimiento, $caractersticaiten, $item, $nivelp, $clave, $grado, $nivel, $estado)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT INTO matriz (idevaluacion,idcurso,area,competencia,capacidad,desempeno,conocimiento,caractersticaiten,item,nivelp,clave,grado,nivel,estado) 
         VALUES ('$idevaluacion','$idcurso','$area','$competencia','$capacidad','$desempeno','$conocimiento','$caractersticaiten','$item','$nivelp','$clave','$grado','$nivel','$estado')";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function aperturaevaluacion($descripcion, $comentario, $fecha, $tabla, $estado, $visible)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT INTO evaluacion (descripcion,comentario,fecha,tabla,estado,visible) 
         VALUES ('$descripcion','$comentario','$fecha','$tabla','$estado','$visible')";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function creartabla($descripcion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "CREATE TABLE $descripcion (
                id int(11) AUTO_INCREMENT PRIMARY KEY,
                fecha date NOT NULL,
                dni varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
                apellidopaterno varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
                apellidomaterno varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
                primernombre varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
                segundonombre varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
                tercernombre varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
                sexo varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
                ie varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
                codigomodular varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
                nivel varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
                distrito varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
                zona varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
                gestion varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
                seccion varchar(2) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas1 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas2 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas3 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas4 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas5 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas6 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas7 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas8 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas9 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas10 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas11 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas12 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas13 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas14 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas15 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas16 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas17 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas18 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas19 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                respuestas20 varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
                grado varchar(2) COLLATE utf8mb4_spanish_ci NOT NULL,
                `area` varchar(7) COLLATE utf8mb4_spanish_ci NOT NULL,
                `ugel` varchar(5) COLLATE utf8mb4_spanish_ci NOT NULL,        
                `dnidocente` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,        
                `apepaternodo` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,        
                `apematernodo` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,        
                `nombredo` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL        
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;          
                ";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function datacompleta($tabla)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM $tabla";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function datacompletaconciste($tabla)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT count('id') FROM $tabla ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function datacoisteerror($tabla, $campo, $variablea, $variableb)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT count('id') FROM $tabla where  $campo='$variablea' or $campo='$variableb'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function datacoisteerrora($tabla, $campo, $variablea, $variableb)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE $tabla SET $campo= REPLACE($campo,'PÚBLICO','$variablea')";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }







    function desenpenoscompletos($idcurso, $grado, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT DISTINCT competencia FROM matriz where idcurso='$idcurso' and grado='$grado' and nivel='$nivel' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function datatabla($idevaluacion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM evaluacion where id='$idevaluacion'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function datacompletatotal($tabla)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT COUNT(id) FROM $tabla";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function datacompletaevaluacion()
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM evaluacion where visible=1";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function datacompletaevaluacionestado()
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM evaluacion where estado=1";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    public function iesugel($ugel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM distrito where  ugel='$ugel'  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }
    public function iesdescripcion($codmodular)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM ies where  codmodular='$codmodular'  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }
    public function iesareas($codmodular)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT DISTINCT(area) FROM participantes	where  codigomodular='$codmodular'  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }
    public function iesareasdes($idarea)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT *FROM area	where  cod='$idarea'  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function areastotales()
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT *FROM area ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function iverareas()
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT *FROM area";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }
    public function infodistrito($idugel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT *FROM distrito	where  ugel='$idugel'  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    function actualizarrolr($idda, $tipo, $idevaluacion, $estado)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE newdetalleusuario SET tipo='$tipo',idevaluacion='$idevaluacion',estado='$estado' WHERE iddetalleus='$idda'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }



    function actualizaradministrador($dni, $estado)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE usuario SET tipo='$estado' WHERE dni='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizarestadonuevo($dni, $estado)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE newususario SET 	estado='$estado' WHERE dni='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizarmatriz($idm, $competen, $capacoidad, $desempa, $conocime, $nvele, $claves)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE matriz SET competencia='$competen', capacidad='$capacoidad', desempeno='$desempa', conocimiento='$conocime', nivelp='$nvele', clave='$claves' WHERE idmatriz='$idm'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizarlogro($idindicador, $iniciala, $finala, $resultadoa, $inicialb, $finalb, $resultadob, $inicialc, $finalc, $resultadoc, $iniciald, $finald, $resultadod)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE calculoindicador SET iniciala='$iniciala',finala='$finala',resultadoa='$resultadoa',inicialb='$inicialb',finalb='$finalb',resultadob='$resultadob',inicialc='$inicialc',finalc='$finalc',resultadoc='$resultadoc',iniciald='$iniciald',finald='$finald',resultadod='$resultadod' WHERE idindicador='$idindicador'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizarvisible($id, $visible)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE evaluacion SET visible='$visible' WHERE id='$id'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizarvisibleg($id, $estado)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE evaluacion SET estado='$estado' WHERE id='$id'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizarvisibleeditar($id, $nombre, $comenttio)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE evaluacion SET descripcion='$nombre', comentario='$comenttio' WHERE id='$id'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizarnewusuario($dniusuariocu, $inombrecu, $apepatwernocu, $apematwernocu, $emailcus, $celularcun)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE newususario SET nombres='$inombrecu',	apellidopat='$apepatwernocu',	apellidomat='$apematwernocu',	email='$emailcus',celular='$celularcun' WHERE dni='$dniusuariocu'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function matrizanular($id, $anular)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE matriz SET estado='$anular' WHERE idmatriz='$id'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function restablecercontrasena($id, $dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE newdetalleusuario SET clave='$dni' WHERE iddetalleus ='$id'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizaradministradoru($dni, $estado, $ugel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE usuario SET tipo='$estado', privilegio='$ugel'  WHERE dni='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizaradministradocole($dni, $estado, $ugel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE usuario SET tipo='$estado', privilegio='$ugel'  WHERE dni='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizaradministradocoledos($dni, $ies)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE usuario SET 	codmodulardos='$ies'  WHERE dni='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function actualizarclavenueva($dni, $contrasena)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "UPDATE newdetalleusuario SET clave='$contrasena'  WHERE dnidocente='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function eliminarusuario($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "DELETE FROM usuario where dni='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function eliminarusuarioevaluacion($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "DELETE FROM evaluacion where id='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }

    function eliminarusuariodetalle($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "DELETE FROM newdetalleusuario where dnidocente ='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }

    function eliminarusuarioevaluacionlista($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "DELETE FROM newususario where dni ='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }


    function eliminarcomplemeto($idn)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "DELETE FROM newcomplementodetalle where id ='$idn'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }

    function eliminardistrito($id)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "DELETE FROM distrito where id='$id'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function eliminarmatriz($idmat)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "DELETE FROM matriz where id='$idmat'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function eliminarlogro($idmat)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "DELETE FROM calculoindicador where idindicador='$idmat'";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    public function areadescon($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM newdetalleusuario where dnidocente='$dni'  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }
    public function areades($area)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM area where  cod='$area'  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }
    public function ugelesde($ugelc)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM provincias where  idpro='$ugelc'  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    public function ugelre($ugel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM ugel where  ugel='$ugel';  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }

    public function evaluacionnombre($tabla)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query  = "SELECT * FROM evaluacion where  tabla='$tabla';  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
    }


    function mostracolegio($ies)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM ies where codmodular='$ies'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function asistencia($nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where nivel='$nivel'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    /*************************************************************************************************/
    /*************************************************************************************************/
    function consultatotal($ugel, $gestion, $zona, $distrito, $sexo, $nivel, $curso, $grado, $seccion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where ugel='$ugel' and gestion='$gestion' and zona='$zona' and distrito='$distrito' and sexo='$sexo' and nivel='$nivel' and area='$curso' and grado='$grado' and seccion='$seccion'  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    /*************************************************************************************************/
    /*************************************************************************************************/
    function consultaugel($ugel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where ugel='$ugel'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function iesdistrito($distrito, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM ies where distrito='$distrito' and nivel='$nivel'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function iesgrado($nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM grados where nivel='$nivel'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultagestion($gestion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where gestion='$gestion'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultazona($zona)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where zona='$zona'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultadistrito($distrito)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where distrito='$distrito'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultasexo($sexo)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where sexo='$sexo'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultaseccion($seccion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where seccion='$seccion'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultasnivel($nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where nivel='$nivel'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function consultagrado($grado)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where grado='$grado'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function consultacurso($curso)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where area='$curso'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function desie($codmodular)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM ies where codmodular='$codmodular'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    /*************************************************************************************************/
    /*************************************************************************************************/
    function consultanew($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $tablaw)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            if ($ugel != '') {
                $datoa = " and ugel='" . $ugel . "'";
            } else {
                $datoa = "";
            }
            if ($gestion != '') {
                $datob = " and gestion='" . $gestion . "'";
            } else {
                $datob = "";
            }
            if ($zona != '') {
                $datoc = " and zona='" . $zona . "'";
            } else {
                $datoc = "";
            }
            if ($distrito != '') {
                $datod = " and distrito='" . $distrito . "'";
            } else {
                $datod = "";
            }
            if ($sexo != '') {
                $datoe = " and sexo='" . $sexo . "'";
            } else {
                $datoe = "";
            }
            if ($seccion != '') {
                $datof = " and seccion='" . $seccion . "'";
            } else {
                $datof = "";
            }
            if ($ie != '') {
                $datog = " and codigomodular='" . $ie . "'";
            } else {
                $datog = "";
            }
            $query = "SELECT * FROM $tablaw where area='$curso' and nivel='$nivel' and grado='$grado'" . $datoa . $datob . $datoc . $datod . $datoe . $datof . $datog . "; ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function contarconsultanew($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $tabla)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            if ($ugel != '') {
                $datoa = " and ugel='" . $ugel . "'";
            } else {
                $datoa = "";
            }
            if ($gestion != '') {
                $datob = " and gestion='" . $gestion . "'";
            } else {
                $datob = "";
            }
            if ($zona != '') {
                $datoc = " and zona='" . $zona . "'";
            } else {
                $datoc = "";
            }
            if ($distrito != '') {
                $datod = " and distrito='" . $distrito . "'";
            } else {
                $datod = "";
            }
            if ($sexo != '') {
                $datoe = " and sexo='" . $sexo . "'";
            } else {
                $datoe = "";
            }
            if ($seccion != '') {
                $datof = " and seccion='" . $seccion . "'";
            } else {
                $datof = "";
            }
            if ($ie != '') {
                $datog = " and codigomodular='" . $ie . "'";
            } else {
                $datog = "";
            }
            $query = "SELECT count(id) FROM $tabla where area='$curso' and nivel='$nivel' and grado='$grado'" . $datoa . $datob . $datoc . $datod . $datoe . $datof . $datog . "; ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function contarconsultanewb($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $tabla)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            if ($ugel != '') {
                $datoa = " and ugel='" . $ugel . "'";
            } else {
                $datoa = "";
            }
            if ($gestion != '') {
                $datob = " and gestion='" . $gestion . "'";
            } else {
                $datob = "";
            }
            if ($zona != '') {
                $datoc = " and zona='" . $zona . "'";
            } else {
                $datoc = "";
            }
            if ($distrito != '') {
                $datod = " and distrito='" . $distrito . "'";
            } else {
                $datod = "";
            }
            if ($sexo != '') {
                $datoe = " and sexo='" . $sexo . "'";
            } else {
                $datoe = "";
            }
            if ($seccion != '') {
                $datof = " and seccion='" . $seccion . "'";
            } else {
                $datof = "";
            }
            if ($ie != '') {
                $datog = " and codigomodular='" . $ie . "'";
            } else {
                $datog = "";
            }
            $query = "SELECT count(id) FROM $tabla where area='$curso' and nivel='$nivel' and grado='$grado'" . $datoa . $datob . $datoc . $datod . $datoe . $datof . $datog . "; ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultaa($campoa, $variablea)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where $campoa='$variablea'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultab($campoa, $variablea, $campob, $variableb)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where $campoa='$variablea' and $campob='$variableb' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultac($campoa, $variablea, $campob, $variableb, $campoc, $variablec)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where $campoa='$variablea' and $campob='$variableb' and $campoc='$variablec' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultad($campoa, $variablea, $campob, $variableb, $campoc, $variablec, $campod, $variabled)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where $campoa='$variablea' and $campob='$variableb' and $campoc='$variablec' and $campod='$variabled' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultae($campoa, $variablea, $campob, $variableb, $campoc, $variablec, $campod, $variabled, $campoe, $variablee)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where $campoa='$variablea' and $campob='$variableb' and $campoc='$variablec' and $campod='$variabled' and $campoe='$variablee' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultaf($campoa, $variablea, $campob, $variableb, $campoc, $variablec, $campod, $variabled, $campoe, $variablee, $campof, $variablef)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where $campoa='$variablea' and $campob='$variableb' and $campoc='$variablec' and $campod='$variabled' and $campoe='$variablee' and $campof='$variablef' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultag($campoa, $variablea, $campob, $variableb, $campoc, $variablec, $campod, $variabled, $campoe, $variablee, $campof, $variablef, $campog, $variableg)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where $campoa='$variablea' and $campob='$variableb' and $campoc='$variablec' and $campod='$variabled' and $campoe='$variablee' and $campof='$variablef' and $campog='$variableg' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultah($campoa, $variablea, $campob, $variableb, $campoc, $variablec, $campod, $variabled, $campoe, $variablee, $campof, $variablef, $campog, $variableg, $campoh, $variableh)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where $campoa='$variablea' and $campob='$variableb' and $campoc='$variablec' and $campod='$variabled' and $campoe='$variablee' and $campof='$variablef' and $campog='$variableg' and $campoh='$variableh'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function consultai($campoa, $variablea, $campob, $variableb, $campoc, $variablec, $campod, $variabled, $campoe, $variablee, $campof, $variablef, $campog, $variableg, $campoh, $variableh, $campoi, $variablei)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM participantes where $campoa='$variablea' and $campob='$variableb' and $campoc='$variablec' and $campod='$variabled' and $campoe='$variablee' and $campof='$variablef' and $campog='$variableg' and $campoh='$variableh' and $campoi='$variablei'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    /*************************************************************************************************/
    /*************************************************************************************************/
    function respuestasere($npregunta, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM preguntas where npregunta='$npregunta' and niveleducativo='$nivel'  ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function matris($idcurso, $grado, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM matriz where idcurso='$idcurso' and grado='$grado' and 	nivel='$nivel' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function calculoindicador($idevaluacion, $idcurso, $grado, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM calculoindicador where idevaluacion='$idevaluacion' and grado='$grado' and 	idnivel='$nivel' and idarea='$idcurso' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function matrisnuevo($evaluacion, $idcurso, $grado, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT  *  FROM matriz where idevaluacion='$evaluacion' and idcurso='$idcurso' and grado='$grado' and 	nivel='$nivel' ORDER BY item asc; ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function matrisnuevolistado($evaluacion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT  DISTINCT idevaluacion, idcurso, grado, nivel  FROM matriz where idevaluacion='$evaluacion'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function listadologro($evaluacion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM calculoindicador JOIN area ON calculoindicador.idarea=area.cod JOIN evaluacion ON evaluacion.tabla=calculoindicador.idevaluacion and calculoindicador.idevaluacion='$evaluacion';";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function contarintem($idevaluacion, $idcurso, $grado, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT  COUNT('item')  FROM matriz where idevaluacion='$idevaluacion' and idcurso='$idcurso' and grado='$grado' AND nivel='$nivel'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function suncontarintem($idevaluacion, $idcurso, $grado, $nivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT  sum(nivelp)  FROM matriz where idevaluacion='$idevaluacion' and idcurso='$idcurso' and grado='$grado' AND nivel='$nivel'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function matrisnuevoarea($idarea)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT  * FROM area where cod ='$idarea'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }


    function matrisies($nivel, $ugel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM ies where nivel='$nivel' and ugel='$ugel' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }



    function matrisres($idcurso, $grado, $nivel, $iten, $idevaluacion)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM matriz where   idevaluacion='$idevaluacion' 
            and   idcurso='$idcurso' and grado='$grado' and 	nivel='$nivel' and item='$iten' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function descurso($idcurso)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM area where cod='$idcurso' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }

    function infodocumento($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM documento where dni='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function CrearDocumento($dni, $asunto, $fecha, $hora, $archivo)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT INTO documento (dni,asunto,fecha,hora,archivo) VALUES ('$dni','$asunto','$fecha','$hora','$archivo')";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }

    function Crearlogro($idevaluacion, $idnivel, $idarea, $grado, $iniciala, $finala, $resultadoa, $inicialb, $finalb, $resultadob, $inicialc, $finalc, $resultadoc, $iniciald, $finald, $resultadod, $calinivel)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT INTO calculoindicador (idevaluacion,idnivel,idarea,grado,iniciala,finala,resultadoa,inicialb,finalb
            ,resultadob,inicialc,finalc,resultadoc,iniciald,finald,resultadod,calinivel) VALUES ('$idevaluacion','$idnivel','$idarea','$grado','$iniciala','$finala','$resultadoa','$inicialb','$finalb','$resultadob','$inicialc','$finalc','$resultadoc','$iniciald','$finald','$resultadod','$calinivel')";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }
    function conteo($tipo)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT count(dni) FROM usuario where tipo='$tipo'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function usuarioconteo($tipo)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT count(dni) FROM usuario where tipo='$tipo'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function usuariototal()
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT count(dni) FROM usuario";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }




    function listaperso()
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM usuario ORDER BY apellidos ASC";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }


    function listatipo($tipo)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM usuario where tipo='$tipo' ORDER BY apellidos ASC";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function listaasistencia()
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM asistencia ORDER BY hora ASC";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function listaasistenciafecha($fecha)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM asistencia where fecha='$fecha' ORDER BY hora ASC";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function datosusuario($dni)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM usuario where dni='$dni'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    function validacionma($idcurso, $compentencia, $desempeno)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM matriz where idcurso='$idcurso' and  competencia='$compentencia'  and  desempeno='$desempeno' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }


    function Crearpersonal($dni, $nombres, $apellidopat, $apellidomat, $email, $celular, $fechanacimiento, $sexo, $fechaRegistro)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "INSERT INTO newususario (dni,nombres,apellidopat,apellidomat,email,celular,fechanacimiento,sexo,fechaRegistro) VALUES ('$dni','$nombres','$apellidopat','$apellidomat','$email','$celular','$fechanacimiento','$sexo','$fechaRegistro')";
            $result = mysqli_query($link, $query);
            if (!$result)
                return false;
            else
                return true;
        }
    }

    //FUNCIONES NUEVAS CODMODULAR ADMICION

    function mostrariessubir($historial_id, $cod_modular, $detalle_id)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM ie_examen where nivel='$historial_id' and historialid cod_modular='$cod_modular' and detalle_id='$detalle_id' ";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    //*-*-*-*-*-*-*-*-**-
    // funcion nueva
    function participacionie($historial_id, $cod_modular, $examen, $examen1, $examen2, $detalle_id, $validacion, $validacion1, $obs)
    {
        $link = $this->Conexion->Conectarse();
        if ($link) {
            $query = "INSERT INTO ie_examen (historial_id, cod_modular, examen, examen1, examen2, detalle_id, validacion, validacion1, obs) VALUES ('$historial_id', '$cod_modular', '$examen', '$examen1', '$examen2', '$detalle_id', '$validacion', '$validacion1', '$obs')";
            $result = mysqli_query($link, $query);

            if (!$result) {
                return false; // Error en la inserción
            }
            return true; // Inserción exitosa
        }
        return false; // Error de conexión
    }
    //matrisies prueba 1
    function matrisiesp($nivel, $ugel)
    {
        $link = $this->Conexion->Conectarse(); // Establece conexión a la base de datos
        if ($link) { // Verifica si la conexión fue exitosa
            // Escapar los valores para prevenir inyecciones SQL
            $nivel = mysqli_real_escape_string($link, $nivel);
            $ugel = mysqli_real_escape_string($link, $ugel);

            // Define la consulta SQL
            $query = "
                SELECT 
                    m.*, 
                    e.historial_id, 
                    e.detalle_id,
                    e.cod_modular,
                    e.examen,
                    e.examen1,
                    e.examen2,
                    e.validacion,
                    e.validacion1,
                    e.obs
                FROM 
                    ies m 
                LEFT JOIN 
                    ie_examen e ON m.codmodular = e.cod_modular 
                WHERE 
                    m.nivel = '$nivel' AND m.ugel = '$ugel'
                GROUP BY 
                    m.codmodular
            ";

            $result = mysqli_query($link, $query); // Ejecuta la consulta
            if (!$result) { // Verifica si hubo un error en la consulta
                return false; // Retorna false si hay un error
            } else {
                return $result; // Retorna el resultado de la consulta
            }
        }
        mysqli_close($link); // Cierra la conexión a la base de datos
    }
    //***-*-*TERMINA PRUEBA 1-*-**-*-**-* */

    //COMENZAR CONSULTA POR CODMODULAR

    function compararCod($nivel, $ugel)
    {
        $link = $this->Conexion->Conectarse(); // Establece conexión a la base de datos
        if ($link) { // Verifica si la conexión fue exitosa
            // Escapar los valores para prevenir inyecciones SQL
            $nivel = mysqli_real_escape_string($link, $nivel);
            $ugel = mysqli_real_escape_string($link, $ugel);

            // Define la consulta SQL
            $query = "
            SELECT 
                m.codmodular, 
                m.descripcion, 
                e.historial_id, 
                e.detalle_id 
            FROM 
                ies m 
            INNER JOIN 
                ie_examen e ON m.codmodular = e.cod_modular 
            WHERE 
                m.nivel = '$nivel' AND m.ugel = '$ugel'
            GROUP BY 
                m.codmodular
        ";
            $result = mysqli_query($link, $query); // Ejecuta la consulta
            if (!$result) { // Verifica si hubo un error en la consulta
                return false; // Retorna false si hay un error
            } else {
                return $result; // Retorna el resultado de la consulta
            }
        }
        mysqli_close($link); // Cierra la conexión a la base de datos
    }


    //MOSTRAR EL ID DE LA TABLA HISTORIAL_ID -> DESCEVA
    function obtenerDesceva($desceva)
    {
        $link = $this->Conexion->Conectarse();
        if ($link == true) {
            $query = "SELECT * FROM historial_ere where desceva='$desceva'";
            $result = mysqli_query($link, $query);
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        }
        mysqli_close($link);
    }
    public function __destruct() {}
}
