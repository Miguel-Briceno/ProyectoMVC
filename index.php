<?php
error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set('error_log',__DIR__."/php-error.log");
error_log("Hello, errors!");

session_start(); // Inicia la sesión al comienzo

require_once 'config/config.php';
require_once 'controllers/User_controller.php';
require_once 'controllers/Propiedades_controller.php';

// Verifica si hay una sesión activa
if (isset($_SESSION['usuario'])) {
    // Si hay una sesión activa, redirige según la acción
    $controllerPro = new ControllerPropiedades;
    $controller = new ControllerUser;    
    if (isset($_GET['accion']) && method_exists('ControllerPropiedades', $_GET['accion'])) {
        $controllerPro->{$_GET['accion']}();
    } else {        
        $controller->pagInicio();// Redirige a la página de inicio de productos si no se especifica una acción
    }    
} else {
    $controller = new ControllerUser;// Si no hay una sesión activa, redirige a la página de inicio de usuario
    if (isset($_GET['accion']) && method_exists('ControllerUser', $_GET['accion'])) {
        $controller->{$_GET['accion']}();
    } else {// Redirige a la página de inicio de usuario si no se especifica una acción
        $controller->pagInicio();
    }
}
?>


