<?php
include('./Utilidades/funciones.php');

if (isset($_REQUEST['action'])) {
    $action = strtolower($_REQUEST['action']);

    $action();
} else {
    
    require_once('./Vista/principal/head.html');


    require_once('./Vista/principal/header.html');

    
    require_once('./Vista/principal/Inicio.html');
}



?>
