<?php
// ...existing code...
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// funcion para obtener todos los medicos
function getMedicos()
{
    $sent = "SELECT nºColegiado, nombre, apellidos, especialidad FROM medico";
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

// funcion para crear pruebas
function crearPruebas()
{
    // Si es POST, procesar el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $codigo = trim($_POST['codigo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $modalidad = trim($_POST['modalidad'] ?? '');
        
        // Validar que no estén vacíos
        if (empty($codigo) || empty($descripcion) ) {
            $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">Por favor rellena todos los campos.</div>';
        } else {
            $modelPath = __DIR__ . '/../Modelo/class.admin.php';
            if (file_exists($modelPath)) {
                require_once $modelPath;
                $model = new admin();
                
                if ($model->crearPrueba($codigo, $descripcion)) {
                    $msg = '<div class="mt-4 p-4 bg-green-100 text-green-700 rounded">Prueba creada correctamente.</div>';
                } else {
                    $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">Error al crear la prueba.</div>';
                }
            }
        }
    }
    
    // Mostrar el formulario
    require_once __DIR__ . '/../Vista/administrador/crearPruebas.php';
}

// funcion para crear modalidades
function crearModalidades()
{
    // Si es POST, procesar el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $codigoModalidad = trim($_POST['codigoModalidad'] ?? '');
        $modalidad = trim($_POST['modalidad'] ?? '');
        
        // Validar que no estén vacíos
        if (empty($codigoModalidad) || empty($modalidad) ) {
            $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">Por favor rellena todos los campos.</div>';
        } else {
            $modelPath = __DIR__ . '/../Modelo/class.admin.php';
            if (file_exists($modelPath)) {
                require_once $modelPath;
                $model = new admin();
                
                if ($model->crearModalidad($codigoModalidad, $modalidad)) {
                    $msg = '<div class="mt-4 p-4 bg-green-100 text-green-700 rounded">Prueba creada correctamente.</div>';
                } else {
                    $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">Error al crear la prueba.</div>';
                }
            }
        }
    }
    
    // Mostrar el formulario
    require_once __DIR__ . '/../Vista/administrador/crearModalidades.php';
}

// funcion para buscar paciente por NHC

function buscarPaciente()
{
    $modelPath = __DIR__ . '/../Modelo/class.medico.php';
    require_once $modelPath;
    
    $resul = new medico();
    if($arrayResultados = $resul->getPacienteByNHC($nhc)){
        
        require_once(__DIR__.'/../Vista/medico/busqueda.php');
        require_once(__DIR__.'/../Vista/principal/header.html');
        
    // require_once('./Vista/resultados.php');
    } else {
        echo "No se encontraron resultados.";
    }
}

// funcion para ver las bajas
function bajas()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/bajas.php');

}

// funcion para desvalidar informes
function desvalidarInformes()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/desvalidarInformes.php');
}

// funcion para dar de alta medicos
function altaMedicos()
{
    $modelPath = __DIR__ . '/../Modelo/class.admin.php';
    if (file_exists($modelPath)) {
        require_once $modelPath;
    }

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = trim($_POST['login'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $numColegiado = trim($_POST['num_Colegiado'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');

        if (!empty($login) && !empty($password)) {
            $resultado = new admin();
            if ($resultado->altasMedicos($login, $password)) {
                if ($resultado->medicosAdmin($numColegiado, $nombre, $apellidos, $login)) {
                    $msg = '<div class="mt-4 p-4 bg-green-100 text-green-700  rounded">Médico creado correctamente.</div>';
                } else {
                    $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">Error al crear el médico en la tabla médico.</div>';
                }
            } else {
                $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">Error al crear el usuario.</div>';
            }
        } else {
            $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">Por favor rellena los campos de login y password.</div>';
        }
    }

    require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/altasMedicos.php');
}

// funcion para modificar pacientes

function modificarPacientes()
{
    $modelPath = __DIR__ . '/../Modelo/class.admin.php';
    require_once $modelPath;
    
    // Verificar que sea POST y que existan los datos
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
        $nhc = trim($_POST['nhc'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $f_nac = trim($_POST['f_nac'] ?? '');
        $edad = trim($_POST['edad'] ?? '');
        $sexo = trim($_POST['sexo'] ?? '');
        $tlf = trim($_POST['tlf'] ?? '');
        
        if (!empty($nhc) && !empty($nombre) && !empty($apellidos)) {
            $resultado = new admin();
            $resultado->modificarPacientes($nhc, $nombre, $apellidos, $f_nac, $edad, $sexo, $tlf);
        }
    }
    
    // Mostrar la vista siempre
    require_once(__DIR__.'/../Vista/administrador/modificarPacientes.php');
}

// funcion para modificar medicos
function modificarMedicos()
{
    $modelPath = __DIR__ . '/../Modelo/class.admin.php';
    require_once $modelPath;
    
    $msg = '';
    
    // Verificar que sea POST y que existan los datos
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificarMedicos'])) {
        $original_login = trim($_POST['original_login'] ?? '');
        $login = trim($_POST['login'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        
        if (empty($original_login) || empty($login) || empty($nombre) || empty($apellidos)) {
            $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Por favor rellena los campos obligatorios.</div>';
        } else {
            $resultado = new admin();
            if ($resultado->formularioAltaMedicos($login, $nombre, $apellidos, $original_login)) {
                $msg = '<div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-300">Médico modificado correctamente.</div>';
            } else {
                $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Error al modificar el médico.</div>';
            }
        }
    }
    
    // Obtener resultados y mostrar la vista
    $resul = new admin();
    $arrayResultados = $resul->altaMedicosv2();
    
    require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/altaMedicosv2.php');
}
 // Logout function
function logout()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Clear session variables
    $_SESSION = array();

    // If there's a session cookie, delete it
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'], $params['secure'], $params['httponly']
        );
    }

    // Destroy the session
    session_unset();
    session_destroy();

    // Remove remembered username cookie if present
    if (isset($_COOKIE['nom'])) {
        setcookie('nom', '', time() - 3600, '/');
        unset($_COOKIE['nom']);
    }

    // Redirect to project root on localhost
    header('Location: /tfg/');
    exit;

}
// funcion para dar de alta medicos y modificarlos
function altaMedicosv2()
{
    $modelPath = __DIR__ . '/../Modelo/class.admin.php';
    require_once $modelPath;
    $resul = new admin();
    $msg = '';

    // Procesar el POST si se ha enviado el formulario de modificación
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificarMedicos'])) {
        $original_login = trim($_POST['original_login'] ?? '');
        $login = trim($_POST['login'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');

        if (!empty($original_login) && !empty($login) && !empty($nombre) && !empty($apellidos)) {
            $ok = $resul->formularioAltaMedicos($login, $nombre, $apellidos, $original_login);
            if ($ok) {
                $msg = '<div class="mt-4 p-4 bg-green-100 text-green-700 rounded">Datos modificados correctamente.</div>';
            } else {
                $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">Error al modificar los datos.</div>';
            }
        } else {
            $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">Faltan datos para modificar.</div>';
        }
    }

    // Obtener resultados y mostrar la vista
    $arrayResultados = $resul->altaMedicosv2();
    if ($arrayResultados) {
        require_once(__DIR__.'/../Vista/principal/header.html');
        require_once(__DIR__.'/../Vista/administrador/altaMedicosv2.php');
    } else {
        echo "No se encontraron resultados.";
    }
}

// funcion para crear modalidades
function crearModalidadesv2()
{
    $modelPath = __DIR__ . '/../Modelo/class.admin.php';
    require_once $modelPath;
    $resul = new admin();
    if($arrayResultados = $resul->crearModalidadesv2()){
        
        require_once(__DIR__.'/../Vista/administrador/crearModalidadesv2.php');
        require_once(__DIR__.'/../Vista/principal/header.html');
        
    // require_once('./Vista/resultados.php');
    } else {
        echo "No se encontraron resultados.";
    }


    
}

// funcion para crear pruebas
function crearPruebasv2()
{
    $modelPath = __DIR__ . '/../Modelo/class.admin.php';
    require_once $modelPath;
    $resul = new admin();
    if($arrayResultados = $resul->crearPruebasv2()){
        
        require_once(__DIR__.'/../Vista/administrador/crearPruebasv2.php');
        require_once(__DIR__.'/../Vista/principal/header.html');
        
    // require_once('./Vista/resultados.php');
    } else {
        echo "No se encontraron resultados.";
    }


    
}
?>