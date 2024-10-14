<?php
require_once "ManejadorBDInterface.php";
/* require_once './controllers/CtrlError.php'; */

class MySQL implements ManejadorBDInterface
{
    # private $_driver;
    private $_host, $_user, $_pass, $_database, $_charset;
    private $_conexion;

    public function __construct()
    {
        $this->_host = "localhost";
        $this->_user = "root";
        $this->_pass = "";
        $this->_database = "ere";
        $this->_charset = "utf8";
    }

    public function conectar()
    {
        try {
            $this->_conexion = new mysqli(
                $this->_host,
                $this->_user,
                $this->_pass,
                $this->_database
            );
        } catch (\Throwable $th) {  // Capturamos errores con el controlador
            /* CtrlError::mostrar([ 'th'=>$th ]); */
            exit();
        }
        $this->_conexion->query("SET NAMES '" . $this->_charset . "'");
    }

    public function desconectar()
    {
        mysqli_close($this->_conexion);
    }

    public function exeQuery($query, $params)
    {
        // Preparar la declaración
        if ($stmt = $this->_conexion->prepare($query)) {
            // Vincular los parámetros
            if (!empty($params)) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }

            // Ejecutar la declaración
            if ($stmt->execute()) {
                // Obtener resultados si es una consulta de selección
                if (strpos(strtolower($query), 'select') === 0) {
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    $stmt->close();
                    return ['success' => true, 'data' => $data];
                }

                // Cerrar la declaración
                $stmt->close();
                return ['success' => true];
            } else {
                // Capturar el error
                $error = $stmt->error;
                $stmt->close();
                return ['success' => false, 'error' => $error];
            }
        } else {
            // Error en la preparación de la declaración
            return ['success' => false, 'error' => $this->_conexion->error];
        }
    }
}
