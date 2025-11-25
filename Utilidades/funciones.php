<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function iniciarSesion()
{
    
    require_once("./Modelo/class.db.php");
    require_once("./Modelo/usuarios.php");

    $modelo = new db();

    if (isset($_POST["nom"]) && isset($_POST["psw"])) {
        if ($modelo->compCredenciales($_POST["nom"], $_POST["psw"])) {

            // Asegurarnos de que la sesión esté iniciada y refrescar id para evitar session fixation
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (function_exists('session_regenerate_id')) {
                session_regenerate_id(true);
            }
            // Guardar nombre de usuario en la sesión (siempre sobrescribir)
            $_SESSION["nom"] = $_POST["nom"];
            if (isset($_POST["rec"])) {
                $_COOKIE["nom"] = $_POST["nom"];
                setcookie("nom", $_POST["nom"], time() + (86400 * 30), "/");
            } else {
                unset($_COOKIE["nom"]);
                setcookie("nom", "", time() - 3600, "/");
            }

            $usu = new Usuarios();
            $idTipo = $usu->getId(nomUsu: $_SESSION["nom"]);

            // Guardar id de usuario y tipo antes de redirigir
            $_SESSION["id_usuario"] = $idTipo[0][0];
            if ($idTipo[0][1] == "Administrador") {
                $_SESSION["tipo_usuario"] = true;
                //hacer vista y ventanada para el modo administrador
                header("Location: ./Controlador/administrador/index.php");
                exit;
            } elseif ($idTipo[0][1] == "Paciente") {
                $_SESSION["tipo_usuario"] = false;
                
                //require_once("./Vista/principal/header.html");
                
                header("Location: ./Controlador/paciente/index.php");
                exit;
            } else {
                //hacer vista y ventana para el modo medico
                $_SESSION["tipo_usuario"] = false;
                header("Location: ./Controlador/medico/index.php");
                exit;
            }
        }
        elseif($modelo->pswIncorrecta($_POST["nom"], !$_POST["psw"])){
            $err = "";
            require_once("./Vista/login.php");

            

        } else {
            $err = "";
 
            require_once(__DIR__.'/../Vista/principal/header.html');
            require_once("./Vista/crearUsuario.php");
            require_once(__DIR__.'/../Vista/principal/footer.html');
        }

    } else {
        // echo ("usuario no logueado");
        require_once("./Vista/login.php");
    }



}

function listaResul()
{
    $modelPath = __DIR__ . '/../Modelo/class.paciente.php';
    require_once $modelPath;
    
    $result = new paciente();
    if($arrayResultados = $result->getResultados()){
        require_once(__DIR__.'/../Vista/principal/head.html');
        
        require_once(__DIR__.'/../Vista/paciente/resultados.php');
        
        require_once(__DIR__.'/../Vista/principal/header.html');
        
        
    // require_once('./Vista/resultados.php');
    } else {
        echo "No se encontraron resultados.";
    }
}

function solicitarPrueba()
{
   
    

    // require_once(__DIR__.'/../Vista/paciente/formularioprueba.html');
    require_once(__DIR__.'/../Vista/paciente/resultados.php');
    /*$modelPath = __DIR__ . '/../Modelo/class.paciente.php';
    require_once $modelPath;
    $result = new paciente();
    if($arrayResultados = $result->getResultados()){
        require_once(__DIR__.'/../Vista/resultados.php');
        require_once(__DIR__.'/../Vista/principal/header.html');
        
    // require_once('./Vista/resultados.php');
    } else {
        echo "No se encontraron resultados.";
    }*/

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
function EstudiosPedientes()
{
    $modelPath = __DIR__ . '/../Modelo/class.medico.php';
    require_once $modelPath;
    
    $resul = new medico();
    if($arrayResultados = $resul->getPacienteByNHC($nhc)){
        
        require_once(__DIR__.'/../Vista/medico/estudiosPendientes.php');
        require_once(__DIR__.'/../Vista/principal/header.html');
        
    // require_once('./Vista/resultados.php');
    } else {
        echo "No se encontraron resultados.";
    }
}

function crearUsuario(){
 $modelPath = __DIR__ . '/../Modelo/usuarios.php';
 $modelPath2 = __DIR__ . '/../Modelo/class.paciente.php';
    require_once $modelPath;
    require_once $modelPath2;
    $resul = new usuarios();
    $resul2 = new paciente();
    if($resul->CrearUsuario($_POST["login"],$_POST["password"])){
        if ($resul2->CrearPaciente( $_POST["nombre"],
        $_POST["apellidos"],
        $_POST["fechaNacimiento"], 
        $_POST["edad"],
        $_POST["sexo"],
        $_POST["telefono"],
        $_POST["login"])) {
                    
            require_once(__DIR__.'/../Vista/login.php');
            require_once(__DIR__.'/../Vista/principal/header.html');
        } else {
            echo "<p style='color:red'>Error al insertar paciente</p>";
        }
    // require_once('./Vista/resultados.php');
    } else {
        echo "Error al insertar el usuario";
    }
    
    
}

function insertarPrueba()
{
    $modelPath = __DIR__ . '/../Modelo/class.paciente.php';
    require_once $modelPath;
    $resul = new paciente();
    $login = $_SESSION['id_usuario'];

    $cod_prueba = $resul->buscarPrueba($_POST["prueba"]);
    $NHC = $resul->buscarPaciente($login);
    if ($cod_prueba && $NHC) {
        // La prueba existe, insertamos en estudios
        if ($resul->insertarPrueba($cod_prueba, $NHC)) {
            $msg = "<p style='color:green'>Usuario insertado correctamente</p>";
        } else {
            echo "Error al insertar la prueba.";
        }
    } else {
        echo "Error al insertar la prueba.";
    }

}

function misEstudiosPendientes()
{
    $modelPath = __DIR__ . '/../Modelo/class.medico.php';
    require_once $modelPath;
    $login = $_SESSION['id_usuario'];
    $resul = new medico();
    if($arrayResultados = $resul->misEstudiosPendientes($login)){
        
        require_once(__DIR__.'/../Vista/medico/estudiosPendientes.php');
        require_once(__DIR__.'/../Vista/principal/header.html');
        
    // require_once('./Vista/resultados.php');
    } else {
        echo "No se encontraron resultados.";
    }
}
function estudiosPendientes()
{
    $modelPath = __DIR__ . '/../Modelo/class.medico.php';
    require_once $modelPath;
    $login = $_SESSION['id_usuario'];
    $resul = new medico();
    if($arrayResultados = $resul->estudiosPendientes()){
        
        require_once(__DIR__.'/../Vista/medico/estudiosPendientes.php');
        require_once(__DIR__.'/../Vista/principal/header.html');
        
    // require_once('./Vista/resultados.php');
    } else {
        echo "No se encontraron resultados.";
    }
}
function getInforme()
{
    $modelPath = __DIR__ . '/../Modelo/class.medico.php';
    require_once $modelPath;
    $id_estudio = isset($_GET['id']) ? intval($_GET['id']) : null;
    $resul = new medico();
    if($arrayResultados = $resul->getInforme($id_estudio)){
        
        require_once(__DIR__.'/../Vista/medico/informe.php');
        require_once(__DIR__.'/../Vista/principal/header.html');
        
    // require_once('./Vista/resultados.php');
    } else {
        echo "No se encontraron resultados.";
    }
}
function guardarInforme(){
    // Procesa el formulario enviado desde Vista/medico/informe.php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }
    $diagnostico = trim($_POST['diagnostico'] ?? '');
    $id_informe = isset($_POST['id_informe']) ? intval($_POST['id_informe']) : null;
    $id_estudio = isset($_POST['id_estudio']) ? intval($_POST['id_estudio']) : null;
    $login = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;
    $num_colegiado ='';

    // Validación básica
    if ($diagnostico === '') {
        echo "<p style='color:red'>Faltan campos obligatorios.</p>";
        return;
    }

    // Si existe modelo medico, intentar delegar el guardado
    $modelPath = __DIR__ . '/../Modelo/class.medico.php';
    if (file_exists($modelPath)) {
        require_once $modelPath;
        if (class_exists('medico')) {
            $med = new medico();
            if (method_exists($med, 'guardarInforme')) {
                if($id_informe == null  || $id_informe == ''){    
                    $ok = $med->guardarInforme($diagnostico);
                    if ($ok) {
                        $num_colegiado = $med->buscarMedico($login);
                        if ($med->actualizarEstudioInformeSinValidar($ok, $num_colegiado,$id_estudio)) {
                            echo "<p style='color:green'>Informe guardado  y estudio guardado correctamente.</p>";    
                        }else {
                            echo "<p style='color:red'>Informe guardado correctamente., pero no actualizado el estudio</p>";
                        }
                    
                        return;
                    }
                }else {
                    
                    if($med ->guardarInformeSinValidar($diagnostico,$id_informe) ){
                        $num_colegiado = $med->buscarMedico($login);
                        if($med->actualizarEstudioInformeSinValidar($id_informe, $num_colegiado,$id_estudio)) {
                            echo "<p style='color:green'>Informe actualizado correctamente en guardarinformesinvalidar.</p>";    
                        }else {
                            echo "<p style='color:red'>Informe guardado correctamente., pero no actualizado el estudio</p>";
                        }
                        return;
                    }else {
                         echo "<p style='color:red'>Error al validar el informe.</p>";
                    }
                }     
            }
        }
    }


}
function validarInforme()
{
    // Procesa el formulario enviado desde Vista/medico/informe.php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        // Mostrar formulario si se accede por GET
        require_once(__DIR__ . '/../Vista/medico/informe.php');
        return;
    }

    $diagnostico = trim($_POST['diagnostico'] ?? '');
    $id_informe = isset($_POST['id_informe']) ? intval($_POST['id_informe']) : null;
    $id_estudio = isset($_POST['id_estudio']) ? intval($_POST['id_estudio']) : null;
    $login = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

    // Validación básica
    if ( $diagnostico === '') {
        $err = "<p style='color:red'>Faltan campos obligatorios.</p>";
        require_once(__DIR__ . '/../Vista/medico/informe.php');
        return;
    }

    // Si existe modelo medico, intentar delegar la validación/guardado
    $modelPath = __DIR__ . '/../Modelo/class.medico.php';
    if (file_exists($modelPath)) {
        require_once $modelPath;
        if (class_exists('medico')) {
            $med = new medico();
            if (method_exists($med, 'validarInforme')) {
                if($id_informe == null  || $id_informe == ''){    
                    $ok = $med->validarInforme($diagnostico);
                    if ($ok) {
                        $num_colegiado = $med->buscarMedico($login);
                        if ($med->actualizarEstudioInformeSinValidar($ok,$num_colegiado, $id_estudio)) {
                            echo "<p style='color:green'>Informe validado  y estudio validad correctamente.</p>";    
                        }else {
                            echo "<p style='color:red'>Informe validado correctamente., pero no actualizado el estudio</p>";
                        }
                    
                        return;
                    }
                }else {
                    if($med ->validarInformeGuardado($diagnostico,$id_informe)){
                        $num_colegiado = $med->buscarMedico($login);
                        if ($med->actualizarEstudioInforme($id_informe,$num_colegiado,$id_estudio)) {
                            echo "<p style='color:green'>Informe validado  y estudio validao correctamente.</p>";    
                        }else {
                            echo "<p style='color:red'>Informe validado correctamente., pero no actualizado el estudio</p>";
                        }
                        return;
                    }else {
                        echo "<p style='color:red'>Error al validar el informe.</p>";
                    }
                }
            }
        }
    }
}

function informe()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/medico/informe.php');
}

function guardarInfo()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/login.php');
}

function validarInfo()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/login.php');
}

//Admin

function bajas()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/bajas.php');

}

function altaPacientes()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/altasPacientes.php');
}

function altaMedicos()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/altasMedicos.php');
}

function crearPruebas()
{
     require_once(__DIR__.'/../Vista/principal/header.html');
    require_once(__DIR__.'/../Vista/administrador/crearPruebas.php');
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


?>
 
<?php
function logout()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Clear session variables
    $_SESSION = array();

  
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'], $params['secure'], $params['httponly']
        );
    }

    session_unset();
    session_destroy();

    // cokies
    if (isset($_COOKIE['nom'])) {
        setcookie('nom', '', time() - 3600, '/');
        unset($_COOKIE['nom']);
    }

        // redirige al proyecto raiz en localhost
        header('Location: /tfg/');
        exit;
    
}
