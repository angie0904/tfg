<?php
require_once('class.db.php');
class medico{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        
        public function getPacientes(){
        
        // SELECT * FROM `resultados` WHERE login_pa = 11223344 and Validado = 1;
            $sent = "SELECT NHC, Nombre, Apellidos, f_nac, login_pa FROM pacientes";
            $cons = $this->conn->prepare($sent);
            $cons->execute();
            $cons->bind_result( $NHC, $Nombre, $Apellido, $f_nac, $login_pa);
            $result = array();
            while($cons->fetch()){
                $result[] = array($NHC, $Nombre, $Apellido, $f_nac, $login_pa);
            }
            $cons->close();
            return $result;
    }
    public function getPacienteByNHC($nhc){
        $sent = "SELECT  a.NHC, a.Nombre, a.Apellidos, a.f_nac, a.login_pa, b.Prueba, b.Resultados, b.Valores, b.Descripción from pacientes a left join resultados b on a.NHC = b.login_pa where a.NHC = ?";
        $cons = $this->conn->prepare($sent);
        if(!$cons) return null;
        $cons->bind_param("s", $nhc);
        $cons->execute();
        $cons->bind_result($NHC, $Nombre, $Apellidos, $f_nac, $login_pa , $Prueba, $Resultados, $Valores, $Descripcion);
        $found = array();
        while($cons->fetch()){
                array_push($found, [$NHC, $Nombre, $Apellidos, $f_nac, $login_pa , $Prueba, $Resultados, $Valores, $Descripcion]);
        };
        // if($cons->fetch()){
        //     $found = array(
        //         'NHC' => $NHC,
        //         'Nombre' => $Nombre,
        //         'Apellidos' => $Apellidos,
        //         'f_nac' => $f_nac,
        //         'Prueba' => $Prueba,
        //         'Resultados' => $Resultados,
        //         'Valores' => $Valores,
        //         'Descripcion' => $Descripcion
        //     );
        
        // }
        $cons->close();
        return $found;
    }

    
}
    
    ?>