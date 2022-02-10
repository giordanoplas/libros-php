<?php

require 'admin/config.php';
require 'funciones.php';

$session = comprobar_session();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['bus'])) {
    $conexion = conexion($bd_config);
    if(!$conexion) {
        header('Location: ' . RUTA . 'error.php');
    }

    $i = 0;
    $index = 1;
    $busqueda = limpiarDatos($_GET['bus']);    

    if(empty($busqueda)) {
        close_conexion($conexion);
        header('Location: ' . RUTA);
    }

    if($session) {    
        $rolID = obtener_usuario($conexion, $_SESSION['usuario'])[0]['rolID'];
        if($rolID !== 1) {
            $rolID = null;
        }
    }

    $librosML = buscar_libro($conexion, $busqueda);

    if(!$librosML) {
        $busqueda = '';
    } 

    close_conexion($conexion);
} else {
    header('Location: ' . RUTA);
}


require 'views/buscar.view.php';