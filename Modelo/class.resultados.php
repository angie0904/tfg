<?php
require_once('class.db.php');
class resultados{
    public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        // Obtenemos el id del usuario con su nombre
        public function getId($Prueba){
            $consulta = "SELECT N_prueba FROM resultados WHERE N_prueba = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("s", $Prueba);
            $sentencia->bind_result($N_prueba);
            $info = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($info, [$N_prueba]);
            };
            $sentencia->close();
            return $info;
        }
    // private $db;
    // public function __construct(){
    //     $this->db=new db();
    // }

    public function getResultados(){
        $conn = $this->db->conn;
        $sent = "SELECT N_prueba, Prueba, Resultados, Valores, Descripción FROM resultados";
        $cons = $conn->prepare($sent);
        $cons->execute();
        $cons->bind_result($N_prueba, $Prueba, $Resultados, $Valores, $Descripcion);
        $result = array();
        while($cons->fetch()){
            $result[] = array($Prueba, $Resultados, $Valores, $Descripcion);
        }
        $cons->close();
        return $result;
    }
    public function getResul(string $N_prueba){
        $conn=$this->db->conn;
        $sent="SELECT  Prueba,Resultados,Valores,Descripción FROM resultados WHERE N_prueba=?";
        $cons=$conn->prepare($sent);
        $cons->bind_param('i',$N_prueba);
        // $cons->bind_result($id_clientes,$nombre,$apellidos,$dirección,$telefono);
        $cons->execute();
        $res=false;
        if($cons->affected_rows==1) $res=true;
        $cons->close();
        return $res;
    }
        //     public function getID($Nombre){
        //     $conn=$this->db->conn;
        //     $consulta = "SELECT Nombre, NHC FROM pacientes WHERE login = ?";
        //     $sentencia = $this->$conn->prepare($consulta);
        //     $sentencia->bind_param("s", $Nombre);
        //     $sentencia->bind_result($Nombre);
        //     $info = array();
        //     $sentencia->execute();
        //     while($sentencia->fetch()){
        //         array_push($info, [$Nombre]);
        //     };
        //     $sentencia->close();
        //     return $info;
        // }
    }
    ?>