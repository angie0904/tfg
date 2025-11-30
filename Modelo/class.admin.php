<?php
require_once('class.db.php');
class admin
{
    public $db;
        public $conn;

    // Constructor: se inicializa la conexión a la base de datos
        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

// OBTENER MÉDICOS
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

// OBTENER PACIENTES
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

// OBTENER INFORMES
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

// CREAR PRUEBA NUEVA
function crearPrueba($codigo, $descripcion)
{
    $consulta = "INSERT INTO pruebas (cod_prueba, descripcion) VALUES (?, ?)";
    $sentencia = $this->conn->prepare($consulta);
    
    if (!$sentencia) {
        return false;
    }
    
    $sentencia->bind_param("ss", $codigo, $descripcion);
    $resultado = $sentencia->execute();
    
    $sentencia->close();
    return $resultado;
}

// CREAR MODALIDAD
function crearModalidad($codigoModalidad, $modalidad)
{
    $consulta = "INSERT INTO modalidad (cod_modalidad, descripcion) VALUES (?, ?)";
    $sentencia = $this->conn->prepare($consulta);
    
    if (!$sentencia) {
        return false;
    }
    
    $sentencia->bind_param("ss", $codigoModalidad, $modalidad);
    $resultado = $sentencia->execute();
    
    $sentencia->close();
    return $resultado;
}

 // OBTENER USUARIO POR LOGIN
public function getPacienteByLogin($login)
    {
        $sent = "SELECT login, password, tipo, activo FROM usuarios WHERE login = ?";
        $cons = $this->conn->prepare($sent);
        
        if (!$cons) {
            return false;
        }
        
        $cons->bind_param("s", $login);
        $cons->execute();
        $cons->bind_result($loginResult, $password, $tipo, $activo);
        
        if ($cons->fetch()) {
            $result = array($loginResult, $password, $tipo, $activo);
        } else {
            $result = false;
        }
        
        $cons->close();
        return $result;
    }

    // DAR DE BAJA USUARIO (poner activo = 0)
    public function darDeBaja($login)
    {
        // Marcar usuario como inactivo (activo = 0)
        $sent = "UPDATE usuarios SET activo = 0 WHERE login = ?";
        
        $cons = $this->conn->prepare($sent);
        
        if (!$cons) {
            return false;
        }
        
        $cons->bind_param("s", $login);
        $resultado = $cons->execute();
        
        $cons->close();
        return $resultado;
    }

 // ALTAS DE MÉDICOS 
    public function altasMedicos($login, $password)
{
    // Hash de la contraseña
    $hashPassword = password_hash($password, PASSWORD_BCRYPT);
    
    // INSERT en usuarios con activo = 1
    $sent = "INSERT INTO usuarios (login, password, tipo, activo) VALUES (?, ?, 'Sanitario', 1)";
    $cons = $this->conn->prepare($sent);
    
    if (!$cons) {
        return false;
    }
    
    $cons->bind_param("ss", $login, $password);
    $resultado = $cons->execute();
    
    $cons->close();
    return $resultado;

}

// LISTAR MODALIDADES
public function crearModalidadesv2()
{
    $sent = "Select cod_modalidad, descripcion FROM modalidad";
    $cons = $this->conn->prepare($sent);
    $cons->execute();    
    $cons->bind_result($cod_modalidad,$descripcion);
    $found = array();
        while($cons->fetch()){
                array_push($found, [$cod_modalidad,$descripcion]);
        };
    
    
    
    $cons->close();
    return $found;
}

// LISTAR PRUEBAS

public function crearPruebasv2()
{
    // Mostramos medicos.
    $sent = "Select cod_prueba, descripcion,modalidad FROM pruebas";
    $cons = $this->conn->prepare($sent);
    $cons->execute();    
    $cons->bind_result($cod_modalidad,$descripcion,$modalidad);
    $found = array();
        while($cons->fetch()){
                array_push($found, [$cod_modalidad,$descripcion,$modalidad]);
        };
    
    
    
    $cons->close();
    return $found;
}


public function altaMedicosv2()
{
    // Mostramos medicos.
    $sent = "Select a.login, a.password,b.nombre,b.apellidos FROM usuarios a, medico b WHERE a.login=b.login";
    $cons = $this->conn->prepare($sent);
    $cons->execute();    
    $cons->bind_result($login,$password,$Nombre,$Apellidos);
    $found = array();
        while($cons->fetch()){
                array_push($found, [$login,$password, $Nombre, $Apellidos]);
        };
    
    
    
    $cons->close();
    return $found;
}

 // MODIFICAR DATOS DE MÉDICOS
public function formularioAltaMedicos($newLogin, $nombre, $apellidos, $oldLogin)
{
    $sent = "UPDATE medico SET login = ?, nombre = ?, apellidos = ? WHERE login = ?";
    $cons = $this->conn->prepare($sent);
    
    if (!$cons) {
        return false;
    }
    
    $cons->bind_param("ssss", $newLogin, $nombre, $apellidos, $oldLogin);
    $resultado = $cons->execute();
    
    $cons->close();
    return $resultado;
}


public function modificarMedicos($login, $nombre, $apellidos)
{
    $sent = "update medico set nombre = ?, apellidos = ? where login = ?";
    $cons = $this->conn->prepare($sent);
    
    $cons->bind_param("sss",  $nombre, $apellidos,$login);
     $sentencia->execute();
        $bool = false;
        if ($sentencia->affected_rows == 1) {
            $bool = true;
        }
        $sentencia->close();
        return $bool;

}


   // INSERTAR NUEVO MÉDICO (INSERT en usuarios + medico
    public function formularioAltasMedicos($login, $password, $num_Colegiado, $nombre, $apellidos)
    {
        if (empty($login) || empty($password) || empty($nombre) || empty($apellidos)) {
            return false;
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);

        // Intentar iniciar transacción
        @$this->conn->begin_transaction();

        // Insertar en usuarios
        $sql1 = "INSERT INTO usuarios (login, password, nombre, apellidos, tipo, activo) VALUES (?, ?, ?, ?, 'Sanitario', 1)";
        $stmt1 = $this->conn->prepare($sql1);
        if (!$stmt1) {
            $this->conn->rollback();
            return false;
        }
        $stmt1->bind_param("ssss", $login, $hash, $nombre, $apellidos);
        $ok1 = $stmt1->execute();
        $stmt1->close();

        if (!$ok1) {
            $this->conn->rollback();
            return false;
        }

        // Insertar en medico
        $sql2 = "INSERT INTO medico (num_Colegiado, nombre, apellidos, activo, login) VALUES (?, ?, ?, 1, ?)";
        $stmt2 = $this->conn->prepare($sql2);
        if (!$stmt2) {
            $this->conn->rollback();
            return false;
        }
        $stmt2->bind_param("isss", $num_Colegiado, $nombre, $apellidos, $login);
        $ok2 = $stmt2->execute();
        $stmt2->close();

        if (!$ok2) {
            $this->conn->rollback();
            return false;
        }

        // Commit
        @$this->conn->commit();
        return true;
    }


    // ALTA DE MÉDICO
public function medicosAdmin($num_Colegiado, $nombre, $apellidos, $login)
{
    $sent = "INSERT INTO medico (num_Colegiado, nombre, apellidos, activo,login) VALUES (?, ?, ?, 1,?)";
    $cons = $this->conn->prepare($sent);
    
    if (!$cons) {
        return false;
    }
    
    $cons->bind_param("isss", $num_Colegiado, $nombre, $apellidos,$login);
    $resultado = $cons->execute();
    
    $cons->close();
    return $resultado;
}

 // MODIFICAR PACIENTES
public function modificarPacientes($nhc, $nombre, $apellidos, $f_nac, $edad, $sexo, $tlf)
{
    $sent = "UPDATE pacientes SET nombre = ?, apellidos = ?, f_nac = ?, edad = ?, sexo = ?, tlf = ? WHERE NHC = ?";
    $cons = $this->conn->prepare($sent);
    
    if (!$cons) {
        return false;
    }
    
    $cons->bind_param("sssisii", $nombre, $apellidos, $f_nac, $edad, $sexo, $tlf, $nhc);
    $resultado = $cons->execute();
    
    $cons->close();
    return $resultado;
}

// OBTENER INFORME VALIDADO POR ID

public function getInformeById($id)
{
    $sent = "SELECT id_informe, resultados, Validado, f_informe FROM informes WHERE id_informe = ? AND Validado = 1";
    $cons = $this->conn->prepare($sent);
    
    if (!$cons) {
        return false;
    }
    
    $cons->bind_param("i", $id);
    $cons->execute();
    $cons->bind_result($id_informe, $resultados, $Validado, $f_informe);
    
    if ($cons->fetch()) {
        $result = array($id_informe, $resultados, $Validado, $f_informe);
    } else {
        $result = false;
    }
    
    $cons->close();
    return $result;
}

// DESVALIDAR INFORME (poner Validado = 0)
public function desvalidarInforme($id)
{
    $sent = "UPDATE informes SET Validado = 0 WHERE id_informe = ?";
    $cons = $this->conn->prepare($sent);
    
    if (!$cons) {
        return false;
    }
    
    $cons->bind_param("i", $id);
    $resultado = $cons->execute();
    
    $cons->close();
    return $resultado;
}
}
?>