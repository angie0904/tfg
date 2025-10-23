<?php
require_once('class.db.php');
class paciente{
    public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        // Obtenemos el id del usuario con su nombre
        public function getId($nombre){
            $consulta = "SELECT id FROM pacientes WHERE nombre = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("s", $nombre);
            $sentencia->bind_result($id);
            $info = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($info, [$id]);
            };
            $sentencia->close();
            return $info;
        }
    // private $db;
    // public function __construct(){
    //     $this->db=new db();
    // }

    public function getClientes(){
        $conn=$this->db->conn;
        $sent="SELECT * FROM pacientes";
        $cons=$conn->prepare($sent);
        $cons->bind_result($NHC,$Nombre,$Apellidos);
        $cons->execute();
        $result=array();
        while($cons->fetch()){
            $clientes[$NHC] = array('nom'=>$Nombre,'ape'=>$Apellidos);
        }
        $cons->close();
        return $clientes;
    }
    public function getCliente(string $login){
        $conn=$this->db->conn;
        $sent="SELECT  NHC,Nombre,Apellidos FROM pacientes WHERE login=?";
        $cons=$conn->prepare($sent);
        $cons->bind_param('i',$login);
        // $cons->bind_result($id_clientes,$nombre,$apellidos,$dirección,$telefono);
        $cons->execute();
        $res=false;
        if($cons->affected_rows==1) $res=true;
        $cons->close();
        return $res;
    }
            public function getID($Nombre){
            $conn=$this->db->conn;
            $consulta = "SELECT Nombre, NHC FROM pacientes WHERE login = ?";
            $sentencia = $this->$conn->prepare($consulta);
            $sentencia->bind_param("s", $Nombre);
            $sentencia->bind_result($Nombre);
            $info = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($info, [$Nombre]);
            };
            $sentencia->close();
            return $info;
        }
    }
    ?>