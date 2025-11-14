<?php
    require_once(__DIR__."../../Utilidades/cred.php");

    class db{
        private $conn;
        public function __construct(){
            $this->conn = new mysqli("localhost", USUARIO_CON, PSW_CON, "controlt2_ok");
            $this->conn->set_charset("utf8");
        }

        public function getConn() {
            return $this->conn;
        }
        public function compCredenciales(String $nom, String $psw){
            $sentencia = "SELECT count(*) FROM usuarios WHERE login = ? AND password = ?"; 
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

        public function pswIncorrecta( String $psw){
            $sentencia = "SELECT count(*) FROM usuarios WHERE  password = ?"; 
            $consulta = $this->conn->prepare($sentencia);
            //$consulta->bind_param("ss", $nom, $psw);
            
            $consulta->bind_param("s",  $psw);
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