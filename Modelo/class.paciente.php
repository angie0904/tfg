<?php
require_once('class.db.php');
class paciente{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        
        public function getResultados(){
        
        // SELECT * FROM `resultados` WHERE login_pa = 11223344 and Validado = 1;
            $sent = "SELECT Prueba,Resultados,Valores,Descripción,login_pa,login_sa FROM resultados";
            $cons = $this->conn->prepare($sent);
            $cons->execute();
            $cons->bind_result( $Prueba, $Resultados, $Valores, $Descripcion, $login_pa, $login_sa);
            $result = array();
            while($cons->fetch()){
                $result[] = array($Prueba, $Resultados, $Valores, $Descripcion, $login_pa, $login_sa);
            }
            $cons->close();
            return $result;
    }
}
    
    ?>