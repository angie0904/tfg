<?php
    require_once("class.db.php");

    class usuarios{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        // Obtenemos el id_usuario del usuario con su nombre
        public function getId($nomUsu){
            $consulta = "SELECT id_usuario, tipo_usuario FROM usuarios WHERE nombre = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("s", $nomUsu);
            $sentencia->bind_result($id_usuario, $type);
            $info = array();
            $sentencia->execute();
            if($sentencia ==[] or $sentencia == null){
                array_push($info, ['', '']);
                
            }else {
                while($sentencia->fetch()){
                array_push($info, [$id_usuario, $type]);
                };
            }
            $sentencia->close();
            return $info;
        }

        // Listamos todos los usuarios del sistema
        public function listarUsuarios(){
            $consulta = "SELECT id_usuario, nombre, psw FROM usuarios Where tipo_usuario = 'Paciente'";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_result($idUsu, $nomUsu, $psw);
            $info = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($info, [$idUsu, $nomUsu, $psw]);
            };
            $sentencia->close();
            return $info;
        }

        // Insertamos un usuario en la base de datos
        public function insertarUsuario($nom, $psw){
            $consulta = "INSERT INTO usuarios (nombre, psw, tipo_usuario) VALUES (?,?,'Paciente')";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("ss", $nom, $psw);
            $sentencia->execute();
            $bool = false;
            if($sentencia->affected_rows == 1){
                $bool = true;
            };
            $sentencia->close();
            return $bool;
        }

        // Seleccionamos un usuario en concreto para poder modificarlo
        public function seleccionarUsuario($nomUsu){
            $consulta = "SELECT id_usuario, nombre, psw FROM usuarios WHERE nombre = ? AND tipo_ususario = 1";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("s", $nomUsu);
            $sentencia->bind_result($idUsu, $nomUsu, $contraseña);
            $info = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($info, [$idUsu, $nomUsu, $contraseña]);
            };
            $sentencia->close();
            return $info;
        }

        // Modificamos un usuario en la base de datos
        public function modificarUsuario($idUsu, $nomUsu, $contraseña){
            $consulta = "UPDATE usuarios SET nombre = ?, contraseña = ? WHERE id_usuario = ? AND tipo_usuario = 1";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("ssi", $nomUsu, $contraseña, $idUsu);
            $sentencia->execute();
            $bool = false;
            if($sentencia->affected_rows == 1){
                $bool = true;
            };
            $sentencia->close();
            return $bool;
        }
    }
?>