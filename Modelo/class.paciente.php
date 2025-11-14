<?php
require_once('class.db.php');
class paciente
{
    public $db;
    public $conn;

    public function __construct()
    {
        $this->db = new db();
        $this->conn = $this->db->getConn();
    }


    public function getResultados($login)
    {
        $sent = "select d.descripcion,c.resultados,a.NHC,b.nombre as nombrePaciente,b.apellidos as apellidosPaciente,e.apellidos as apellidosMedico 
            from estudios a LEFT join pacientes b on a.NHC = b.NHC left join informes c on a.id_informe = c.id_informe 
            LEFT join pruebas d on a.cod_prueba = d.cod_prueba left join medico e on a.num_colegiado = e.nºColegiado 
            where a.informado = 1 
            and b.login = ?
            limit 10
            ;";
        $cons = $this->conn->prepare($sent);
         $cons ->bind_param("s", $_SESSION['id_usuario']);
        $cons->execute();
        $cons->bind_result($NHC, $descripcion, $apellidosPaciente,$resultados,$apellidosMedico,$nombrePaciente);
        $result = array();
        while ($cons->fetch()) {
            $result[] = array($NHC, $descripcion, $apellidosPaciente,$resultados,$apellidosMedico,$nombrePaciente);
        }
        $cons->close();
        return $result;
    }
    public function crearPaciente($nombre, $apellidos, $fechaNacimiento, $edad, $sexo, $telefono, $login)
    {
        $consulta = "INSERT INTO pacientes (Nombre, Apellidos, f_nac, edad, sexo, tlf, login) VALUES (?,?,?,?,?,?,?)";
        $sentencia = $this->conn->prepare($consulta);
        $sentencia->bind_param("ssdisis", $nombre, $apellidos, $fechaNacimiento, $edad, $sexo, $telefono, $login);
        $sentencia->execute();
        $bool = false;
        if ($sentencia->affected_rows == 1) {
            $bool = true;
        }
        ;
        $sentencia->close();
        return $bool;
    }

    public function solicitarPrueba()
    {
        $consulta = "SELECT descripcion FROM pruebas";
        $sentencia = $this->conn->prepare($consulta);
        if (!$sentencia) return []; // protección en caso de error
        $sentencia->execute();
        $sentencia->bind_result($descripcion);

        $pruebas = [];
        while ($sentencia->fetch()) {
            $pruebas[] = $descripcion;
        }

        $sentencia->close();
        return $pruebas;
    }

    public function insertarPrueba($prueba,$login)
    {

        //insertamos finalmente la prueba en estudios.
        $consulta = "insert into estudios (cod_prueba, NHC) VALUES (?, ?)";
        $sentencia = $this->conn->prepare($consulta);
        $sentencia->bind_param("si", $prueba, $login);
        $sentencia->execute();
        $bool = false;
        if ($sentencia->affected_rows == 1) {
            $bool = true;
        }
        $sentencia->close();
        return $bool;
    }

    function buscarPrueba($prueba){
                // extraigo el cod_prueba
        $consultapre = "select cod_prueba from pruebas where descripcion = ?";
        $sentencia1 = $this->conn->prepare($consultapre);
        $sentencia1->bind_param("s", $prueba);
        $sentencia1->execute();
        $sentencia1->bind_result($cod_prueba);
        $cod_prueba_val ;
        while ($sentencia1->fetch()) {
            $cod_prueba_val = $cod_prueba;
        }      
        $sentencia1->close();
        
        return $cod_prueba_val;
    }
    function buscarPaciente($login){
 
        //extraigo el NHC del paciente
        $consultapaciente = "select NHC from pacientes where login = ?";
        $sentencia2 = $this->conn->prepare($consultapaciente);
        $sentencia2->bind_param("s", $login);
        $sentencia2->execute();
        $sentencia2->bind_result($NHC);
        $NHC_val ;
        while ($sentencia2->fetch()) {
            $NHC_val = $NHC;
        }      
        $sentencia2->close();
        
        return $NHC_val;
        

    }
    function test($login,$prueba){

        $consulta = "INSERT INTO estudios (cod_prueba, NHC) VALUES (?, ?)";
        $sentencia = $this->conn->prepare($consulta);
        $sentencia->bind_param("si", $prueba, $login);
        $sentencia->execute();
        $bool = false;
        if ($sentencia->affected_rows == 1) {
            $bool = true;
        }
        $sentencia->close();
        return $bool;
    }
}

?>