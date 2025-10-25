<?php
session_start();

// Verificamos que esté logueado
include(__DIR__.'/../../Utilidades/funciones.php');
// Verificamos que esté logueado
 if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

require_once(__DIR__.'/../../Vista/principal/head.html');
require_once(__DIR__.'/../../Vista/principal/header.html');
// echo "Bienvenido, " . $_SESSION['nom'];
require_once(__DIR__.'/../../Vista/administrador/admin.php');

if (isset($_REQUEST['action'])) {
    $action = strtolower($_REQUEST['action']);

    $action();
} 
?>