<?php
require_once('class.db.php');
class admin
{
    public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }


function getMedicos()
{
    $sent = "SELECT nºColegiado, nombre, apellidos, activo FROM medico";
    $cons = $this->conn->prepare($sent);
    $cons->execute();
    $cons->bind_result($nColegiado, $nombre, $apellidos, $especialidad);
    
    $result = array();
    while ($cons->fetch()) {
        $result[] = array($nColegiado, $nombre, $apellidos, $especialidad);
    }
    $cons->close();
    return $result;
}

function getPacientes()
{
    $sent = "SELECT NHC, nombre, apellidos,f_nac,edad,sexo,tlf,login FROM pacientes";
    $cons = $this->conn->prepare($sent);
    $cons->execute();
    $cons->bind_result($NHC, $nombre, $apellidos,$f_nac,$edad,$sexo,$tlf,$login);
    
    $result = array();
    while ($cons->fetch()) {
        $result[] = array($NHC, $nombre, $apellidos,$f_nac,$edad,$sexo,$tlf,$login);
    }
    $cons->close();
    return $result;
}

function getInforme()
{
    $sent = "SELECT id_informe,resultados,Validado,f_informe FROM informes";
    $cons = $this->conn->prepare($sent);
    $cons->execute();
    $cons->bind_result($id_informe, $resultados, $Validado, $f_informe);
    
    $result = array();
    while ($cons->fetch()) {
        $result[] = array($id_informe, $resultados, $Validado, $f_informe);
    }
    $cons->close();
    return $result;
}

function crearPrueba($codigo, $descripcion, $modalidad)
{
    $consulta = "INSERT INTO pruebas (cod_prueba, descripcion, modalidad) VALUES (?, ?, ?)";
    $sentencia = $this->conn->prepare($consulta);
    
    if (!$sentencia) {
        return false;
    }
    
    $sentencia->bind_param("sss", $codigo, $descripcion, $modalidad);
    $resultado = $sentencia->execute();
    
    $sentencia->close();
    return $resultado;
}


}
?>