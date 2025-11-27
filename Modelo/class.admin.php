<?php
require_once('class.db.php');
class admin
{
    public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }


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


public function medicosAdmin($nColegiado, $nombre, $apellidos, $login)
{
    $sent = "INSERT INTO medico (num_Colegiado, nombre, apellidos, activo,login) VALUES (?, ?, ?, 1,?)";
    $cons = $this->conn->prepare($sent);
    
    if (!$cons) {
        return false;
    }
    
    $cons->bind_param("isss", $nColegiado, $nombre, $apellidos,$login);
    $resultado = $cons->execute();
    
    $cons->close();
    return $resultado;
}

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