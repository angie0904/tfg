<?php
require_once('class.db.php');
class medico{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

    //OBTENER LISTA DE PACIENTES    
        public function getPacientes(){
        
        // SELECT * FROM `resultados` WHERE login_pa = 11223344 and Validado = 1;
            $sent = "SELECT NHC, Nombre, Apellidos, f_nac, login FROM pacientes";
            $cons = $this->conn->prepare($sent);
            $cons->execute();
            $cons->bind_result( $NHC, $Nombre, $Apellido, $f_nac, $login);
            $result = array();
            while($cons->fetch()){
                $result[] = array($NHC, $Nombre, $Apellido, $f_nac, $login);
            }
            $cons->close();
            return $result;
    }

    // OBTENER PACIENTE POR NHC
    public function getPacienteByNHC($nhc){
        $sent = "select b.NHC,b.nombre, b.apellidos, b.f_nac,b.login,c.descripcion,
                    case when d.resultados is null then 'Pendiente'
                    ELSE 'Informado' end as Resultados,a.informado,a.f_informado
                from estudios a left join pacientes b on a.NHC = b.NHC
                    left join pruebas c on a.cod_prueba = c.cod_prueba
                    LEFT join informes d on a.id_informe = d.id_informe
                where a.NHC =? and a.informado = 1
union 
select b.NHC,b.nombre, b.apellidos, b.f_nac,b.login,c.descripcion,
                    case when d.resultados is null then 'Pendiente'
                    ELSE 'Pendiente' end as Resultados,a.informado,a.f_informado
                from estudios a left join pacientes b on a.NHC = b.NHC
                    left join pruebas c on a.cod_prueba = c.cod_prueba
                    LEFT join informes d on a.id_informe = d.id_informe
                where a.NHC =? and a.informado = 0";
        $cons = $this->conn->prepare($sent);
        if(!$cons) return null;
        $cons->bind_param("ss", $nhc,$nhc);
        $cons->execute();
        $cons->bind_result($NHC, $Nombre, $Apellidos, $f_nac, $login_pa , $Prueba, $Resultados,$informado,$f_informado);
        $found = array();
        while($cons->fetch()){
                array_push($found, [$NHC, $Nombre, $Apellidos, $f_nac, $login_pa , $Prueba, $Resultados,$informado,$f_informado]);
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

// OBTENER LISTA DE RESULTADOS
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
    // insertar un informe y validarlo, devuelve el id del informe insertado
     function validarInforme($diagnostico){

        $consulta = "insert into informes (resultados,validado,f_informe) values (?,1,now())";
        $sentencia = $this->conn->prepare($consulta);
        $sentencia->bind_param("s", $diagnostico);
        $sentencia->execute();
        $last_id = $sentencia->insert_id;
        $bool = false;
        if ($sentencia->affected_rows == 1) {
            $bool = true;
        }
        $sentencia->close();
        return $last_id;
        
    }
    // validar un informe previamente guardado, devuelve true si se ha validado correctamente
    function validarInformeGuardado($diagnostico,$id_informe){

        $consulta = "update informes set validado = 1,resultados = ?, f_informe = now()  where id_informe = ?";
        $sentencia = $this->conn->prepare($consulta);
        $sentencia->bind_param("si", $diagnostico, $id_informe);
        $sentencia->execute();
        // $last_id = $sentencia->insert_id;
        $bool = false;
        if ($sentencia->affected_rows == 1) {
            $bool = true;
        }
        $sentencia->close();
        return $bool;
        
    }

    // funcion para actualizar un estudio ya existente.
    function actualizarEstudioInforme($id_informe,$num_colegiado,$id_estudio){
        $consulta = "update estudios set informado = 1, f_informado = now(),f_ultimaActu = now()
        ,f_realizado = now(),realizado=1,id_informe = ?,num_colegiado=?
        where id_estudio = ?";
        $sentencia = $this->conn->prepare($consulta);
        $sentencia->bind_param("isi", $id_informe,$num_colegiado, $id_estudio);
        $sentencia->execute();
        $bool = false;
        if ($sentencia->affected_rows == 1) {
            $bool = true;
        }
        $sentencia->close();
        return $bool;
    
   
    }
        // funcion para insertear un informe sin validar y que no exista previamente.
        function guardarInforme($diagnostico){

        $consulta = "insert into informes (resultados,validado,f_informe) values (?,0,now())";
        $sentencia = $this->conn->prepare($consulta);
        $sentencia->bind_param("s", $diagnostico);
        $sentencia->execute();
        $last_id = $sentencia->insert_id;
        $bool = false;
        if ($sentencia->affected_rows == 1) {
            $bool = true;
        }
        $sentencia->close();
        return $last_id;
        
        }
        // funcion para actualizar un informe sin validar ya existente.
       function guardarInformeSinValidar($diagnostico,$id_informe){

        $consulta = "update informes set resultados = ? where id_informe = ?";
        $sentencia = $this->conn->prepare($consulta);
        $sentencia->bind_param("si", $diagnostico, $id_informe);
        $sentencia->execute();
        $last_id = $sentencia->insert_id;
        $bool = false;
        if ($sentencia->affected_rows == 1) {
            $bool = true;
        }
        $sentencia->close();
        return $bool;
        
        }

        // funcion para actualizar un estudio ya existente sin validar.
       function actualizarEstudioInformeSinValidar($id_informe,$num_colegiado,$id_estudio){//nhc sera el id del estudio - añadir f_modi
        $consulta = "update estudios set id_informe = ?, informado = 0, f_ultimaActu = now()
        ,f_realizado = now(),realizado=1,num_colegiado = ?
        where id_estudio = ?";
        $sentencia = $this->conn->prepare($consulta);
        $sentencia->bind_param("iii", $id_informe,$num_colegiado, $id_estudio);
        $sentencia->execute();
        $bool = false;
        if ($sentencia->affected_rows == 1) {
            $bool = true;
        }
        $sentencia->close();
        return $bool;
    
   
    }

    // funcion para buscar el num_colegiado de un medico a partir de su login
    function buscarMedico($login){
        $consulta = "select num_colegiado from medico where login = ?";
        $sentencia = $this->conn->prepare($consulta);
        $sentencia->bind_param("s",$login);
        $sentencia->execute();
        $sentencia->bind_result( $num_colegiado);
        $result= null;
        while ($sentencia->fetch()) {
            $result = $num_colegiado;
        } 

        $sentencia->close();
        return $result;

    }
    // funcion para obtener los estudios pendientes de un medico
    function misEstudiosPendientes($login){
        $sent = "SELECT a.id_estudio, a.NHC, a.cod_prueba, c.descripcion,
                    case when d.resultados is null then 'Pendiente'
                    ELSE 'Informado' end as Resultados,a.informado,a.f_informado
                from estudios a left join pacientes b on a.NHC = b.NHC
                    left join pruebas c on a.cod_prueba = c.cod_prueba
                    LEFT join informes d on a.id_informe = d.id_informe
                    left join medico e on a.num_colegiado = e.num_Colegiado 
                where (a.informado = 0  or a.informado is null )and e.login = ?";
            $cons = $this->conn->prepare($sent);
            $cons->bind_param("s", $login);
            $cons->execute();

            $cons->bind_result( $id_estudio, $NHC, $cod_prueba, $descripcion, $Resultados,$informado,$f_informado);
            $result = array();
            while($cons->fetch()){
                $result[] = array($id_estudio, $NHC, $cod_prueba, $descripcion, $Resultados,$informado,$f_informado);
            }
            $cons->close();
            return $result;
    }
    // funcion para obtener todos los estudios pendientes
    function estudiosPendientes(){
        $sent = "SELECT a.id_estudio, a.NHC, a.cod_prueba, c.descripcion,
                    case when d.resultados is null then 'Pendiente'
                    when d.resultados = 0 then 'Pendiente'
                    ELSE 'Informado' end as Resultados,a.informado,a.f_informado
                from estudios a left join pacientes b on a.NHC = b.NHC
                    left join pruebas c on a.cod_prueba = c.cod_prueba
                    LEFT join informes d on a.id_informe = d.id_informe
                    left join medico e on a.num_colegiado = e.num_Colegiado 
                where (a.informado = 0 or a.informado is null) ";
            $cons = $this->conn->prepare($sent);
            $cons->execute();

            $cons->bind_result( $id_estudio, $NHC, $cod_prueba, $descripcion, $Resultados,$informado,$f_informado);
            $result = array();
            while($cons->fetch()){
                $result[] = array($id_estudio, $NHC, $cod_prueba, $descripcion, $Resultados,$informado,$f_informado);
            }
            $cons->close();
            return $result;
    }

    // funcion para obtener el informe de un estudio por su id_estudio
    function getInforme($id_estudio){
        $sent = "select b.NHC, b.nombre,b.apellidos,b.f_nac,c.descripcion,d.resultados,
                a.id_informe
                from estudios a LEFT JOIN pacientes b on a.NHC = b.NHC
                    left join pruebas c on a.cod_prueba = c.cod_prueba
                    left join informes d on a.id_informe = d.id_informe
                where id_estudio = ?";
            $cons = $this->conn->prepare($sent);
            $cons->bind_param("i", $id_estudio);
            $cons->execute();
            $cons->bind_result( $nhc, $nombre, $apellidos, $f_nac, $descripcion, $resultados, $id_informe);
            $found= array();
            if($cons->fetch()){
                $found[] = array($nhc, $nombre, $apellidos, $f_nac, $descripcion, $resultados,  $id_informe);
            }
            $cons->close();
            return $found;

    }

}
    
    ?>