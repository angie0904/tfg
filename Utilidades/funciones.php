<?php


//     require_once('../Modelo/class.clientes.php');
//     $clientes=new pacientes;
//     $lista = $clientes->ExistePaciente();
//     require_once('../Vista/principal/header.html');
//     require_once('../Vista/listarclientes.php');
// }
// function iniciarSesion(){
//         require_once("../Modelo/class.db.php");
//         $modelo = new db();

//         if($modelo->compCredenciales($_POST["nom"], $_POST["psw"])){
//             if(session_status() == PHP_SESSION_NONE){
//                 session_start();
//                 $_SESSION["nom"] = $_POST["nom"];
//             }
//             if(isset($_POST["rec"])){
//                 $_COOKIE["nom"] = $_POST["nom"];
//                 setcookie("nom", $_POST["nom"], time() + (86400 * 30), "/");
//             }else{
//                 unset($_COOKIE["nom"]);
//                 setcookie("nom", "", time() - 3600, "/");
//             }
//             require_once("../Modelo/class.bd.php");
//             $usu = new Usuarios();
//             $id = $usu->getID($_SESSION["nombre"]);
//             // if($id[0][1] == 0){
//             //     $_SESSION["tipo"] = true;
//             // }else{
//             //     $_SESSION["tipo"] = false;
//             // }
//             // $_SESSION["id"] = $idTipo[0][0];
//             // // header("Location:../controladores/index.php?action=listarAmigos");
//         }else{
//             $err = "<p style='color:red'>El usuario o la contraseña son incorrectos</p>";
//             require_once("../Vista/login.php");
//         }
// }

function iniciarSesion()
{

    require_once("./Modelo/class.db.php");
    require_once("./Modelo/usuarios.php");

    $modelo = new db();

    if (isset($_POST["nom"]) && isset($_POST["psw"])) {
        if ($modelo->compCredenciales($_POST["nom"], $_POST["psw"])) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
                $_SESSION["nom"] = $_POST["nom"];
            }
            if (isset($_POST["rec"])) {
                $_COOKIE["nom"] = $_POST["nom"];
                setcookie("nom", $_POST["nom"], time() + (86400 * 30), "/");
            } else {
                unset($_COOKIE["nom"]);
                setcookie("nom", "", time() - 3600, "/");
            }
            $usu = new Usuarios();
            $idTipo = $usu->getId(nomUsu: $_SESSION["nom"]);
            if ($idTipo[0][1] == "Administrador") {
                $_SESSION["tipo_usuario"] = true;
                //hacer vista y ventanada para el modo administrador
                echo ("usuario administrador");
            } elseif ($idTipo[0][1] == "Paciente") {
                $_SESSION["tipo_usuario"] = false;
                // // hacer vista y ventana para el paciente.
                // condicional: Si id_usuario existe como login_pa dentro de tabla Paciente - es ok
                //     - select * from pacientes where login_pa = id_usuario
                //     - mando a vista de paciente ya creado en tabla pacientes.
                //     - Sino existe en tabla paciente.
                //         - le mando a un formulario de registro para crear el paciente en tabla pacientes

                echo ("usuario paciente");
                require_once("../Vista/principal/header.html");
                require_once("../Vista/paciente.php");
            } else {
                //hacer vista y ventana para el modo medico
                $_SESSION["tipo_usuario"] = false;
                echo ("usuario sanitario");
                require_once("../Vista/principal/header.html");
                require_once("../Vista/listaPacientes.php");
            }
            $_SESSION["id_usuario"] = $idTipo[0][0];
            //lleva al paciente
        } else {
            echo ("el paciente no existe, tengo que enviarle la ventana para crear el usuario");
            require_once("../Vista/insertarmodificarPaciente.php");
        }

    } else {
        echo ("usuario no logueado");
        require_once("./Vista/login.php");
    }



}




// Funciones de los usuarios, para mostrarle el formulario y para obtener la respuesta e insertar el usuario
// Con esta función se listan los usuarios del sistema (Administrador)
function listarUsuarios($msg = "")
{
    // No compruebo la sesión porque solo el administrador puede acceder a esta función
    // require_once("../Modelo/usuarios.php");
    $usu = new Usuarios();
    $listaUsuarios = $usu->listarUsuarios();
    echo ("estoy en listarusuarios, entiendo que se ha registrado el usuario.");
    require_once("../Vista/principal/header.html");
    require_once("../Vista/paciente.php");
    // require_once("../vistas/usuarios.php");
    // require_once("../header&footer/footer.html");
}
function formInsertarUsuario()
{
    require_once("../header&footer/head.html");
    require_once("../header&footer/headerAdmin.html");
    require_once("../vistas/insertarmodificarUsuario.php");
    require_once("../header&footer/footer.html");
}
function insertarUsuario()
{
    require_once("../Modelo/usuarios.php");
    $usu = new Usuarios();
    if ($usu->insertarUsuario($_POST["nom"], $_POST["psw"])) {
        $msg = "<p style='color:green'>Usuario insertado correctamente</p>";
    } else {
        $msg = "<p style='color:red'>Error al insertar usuario</p>";
    }
    listarUsuarios($msg);
}
function vistaModificarUsuario()
{
    require_once("../Modelo/usuarios.php");
    $usu = new Usuarios();
    $usuario = $usu->seleccionarUsuario($_POST["nombre"]);
    require_once("../Vista/principal/header.html");
    require_once("../Vista/insertarmodificarPaciente.php");


}
function modificarUsuario()
{
    require_once("../modelo/usuarios.class.php");
    $usu = new Usuarios();
    if ($usu->modificarUsuario($_POST["idUsu"], $_POST["nombreModif"], $_POST["pswdModif"])) {
        $msg = "<p style='color:green'>Usuario modificado correctamente</p>";
    } else {
        $msg = "<p style='color:red'>Error al modificar usuario</p>";
    }
    listarUsuarios($msg);
}
function formBuscarUsuario($usuarioSeleccionado = "", $contrasena = "123456789")
{
    require_once("../header&footer/head.html");
    require_once("../header&footer/headerAdmin.html");
    require_once("../vistas/buscarUsuario.php");
    require_once("../header&footer/footer.html");
}
function mostrarUsuarios()
{
    require_once("../Modelo/perfil.php");
    $usu = new Usuarios();
    $usuarios = $usu->seleccionarUsuario($_POST["nom"]);
    formBuscarUsuario($usuarios);
}
function formPaciente()
{
    require_once('../Vista/principal/header.html');
    require_once('../Vista/paciente.php');


}

function listaResul()
{
    require_once('../Modelo/class.resultados.php');
    $resul = new resultados();
    $resul = $resul->getResultados();
    require_once('../Vista/principal/header.html');
    require_once('../Vista/resultados.php');
}



//     require_once('../Modelo/class.clientes.php');
//     $clientes= new Clientes();
//     $err = $clientes->insertarCliente($_POST['nom'], $_POST['ape'], $_POST['dir'], $_POST['tlf']);
//     if(!$err){
//         listaClientes();
//     }else{
//         formCliente();
//     }
// }

// function modFormCli(){
//     require_once('../Modelo/class.clientes.php');
//     $clientes=new clientes();
//     $datos = $clientes->getCliente($_POST['id']);
//     require_once('../Vista/clientes.php');
// }

// function modCli(){
//     require_once('../Vista/principal/header.html');
//     require_once('../Modelo/class.clientes.php');
//     $clientes=new clientes();
//     $modi=$clientes->modificarClientes($_POST['id'], $_POST['nom'], $_POST['ape'], $_POST['dir'], $_POST['tlf']);
//     modFormCli();
// }


// function listaInmuebles(){
//     require_once('../Modelo/class.inmuebles.php');
//     $inmuebles=new Inmuebles();
//     $inmuebles = $inmuebles->getInmuebles();
//     require_once('../Vista/principal/header.html');
//     require_once('../Vista/listarinmuebles.php');
// }

// function formInmueble(){
//     require_once('../Vista/principal/header.html');
//     require_once('../Vista/inmuebles.php');
// }

// function aniadirInmu(){
//     $url = compRuta($_FILES["foto"]["tmp_name"], $_FILES["foto"]["name"]);
//     require_once('../Modelo/class.inmuebles.php');
//     $inmuebles= new inmuebles();
//     $err = $inmuebles->insertarInmueble($url, $_POST['dir'], $_POST['precio']);
//     if(!$err){
//         listainmuebles();
//     }else{
//         formInmueble();
//     }
// }

// function modFormInmu(){
//     require_once('../Modelo/class.inmuebles.php');
//     $inmuebles=new inmuebles();
//     $datos = $inmuebles->getInmuebles($_POST['id_inmuebles']);
//     require_once('../Vista/inmuebles.php');
// }

// function modInmu(){
//     require_once('../Vista/principal/header.html');
//     require_once('../Modelo/class.inmuebles.php');
//     $inmuebles=new inmuebles();
//     $modi=$inmuebles->modificarinmueble($_POST['id_inmuebles'], $_POST['dir'], $_POST['precio']);
//     modFormInmu();
// }

// function compRuta(String $origen, String $nomFile){
//     if(!file_exists('./Recursos/img/')){
//         mkdir('./Recursos/img/');
//     }

//     move_uploaded_file($origen,'./Recursos/img/'.$nomFile);

//     return './Recursos/img/'.$nomFile;
// }
// function borrarInmueble(){
//     require_once('../Modelo/class.inmuebles.php');
//     $inmuebles=new inmuebles();
//     $borrar=$inmuebles->borrarInmueble($_POST['id']);
//     listainmuebles();
// }
// function buscarInmueble(){
//     require_once('../Modelo/class.inmuebles.php');
//     $inmuebles=new inmuebles();
//     $inmuebles=$inmuebles->buscarInmueble($_POST['buscarInmueble']);
//     require_once('../Vista/principal/header.html');
//     require_once('../Vista/listarinmuebles.php');
// }

?>