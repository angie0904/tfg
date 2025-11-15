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
?>