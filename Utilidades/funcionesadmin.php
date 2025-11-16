<?php
// ...existing code...

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

function crearPruebas()
{
    // Si es POST, procesar el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $codigo = trim($_POST['codigo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $modalidad = trim($_POST['modalidad'] ?? '');
        
        // Validar que no estén vacíos
        if (empty($codigo) || empty($descripcion) || empty($modalidad)) {
            $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">Por favor rellena todos los campos.</div>';
        } else {
            $modelPath = __DIR__ . '/../Modelo/class.admin.php';
            if (file_exists($modelPath)) {
                require_once $modelPath;
                $model = new admin();
                
                if ($model->crearPrueba($codigo, $descripcion, $modalidad)) {
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

function bajas()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/bajas.php');

}



function altaMedicos()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/altasMedicos.php');
}



function crearModalidades()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/crearMOdalidades.php');
}

function desvalidarInformes()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/desvalidarInformes.php');
}

function altasMedicos()
{
     $modelPath = __DIR__ . '/../Modelo/class.admin.php';
    require_once $modelPath;
    
    $resultado = new admin();
    if($resultado->altasMedicos(    $_POST["login"], $_POST["password"])){
        if($resultado->medicosAdmin($_POST["num_Colegiado"], $_POST["nombre"], $_POST["apellidos"], $_POST["login"])){

            require_once(__DIR__.'/../Vista/administrador/altasMedicos.php');
            require_once(__DIR__.'/../Vista/principal/header.html');
        }
        
    // require_once('./Vista/resultados.php');
    } else {
        echo "No se encontraron resultados.";
    }

}

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
?>