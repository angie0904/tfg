<?php
    require_once("./Utilidades/cred.php");

    class db{
        private $conn;
        public function __construct(){
            $this->conn = new mysqli("localhost", USUARIO_CON, PSW_CON, "controlt");
            $this->conn->set_charset("utf8");
        }

        public function getConn() {
            return $this->conn;
        }
        public function compCredenciales(String $nom, String $psw){
            $sentencia = "SELECT count(*) FROM usuarios WHERE nombre = ? AND psw = ?"; 
            $consulta = $this->conn->prepare($sentencia);
            //$consulta->bind_param("ss", $nom, $psw);
            
            $consulta->bind_param("ss", $nom, $psw);
            $consulta->bind_result($count);
            $consulta->execute();

            $consulta->fetch();

            $existe = false;

            if($count == 1){
                $existe = true;

            }

            $consulta->close();
            return $existe;
        }
        
        // Comprobamos si las credenciales son correctas
       
    }
?>