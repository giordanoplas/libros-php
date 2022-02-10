<?php

require 'admin/config.php';
require 'funciones.php';

$session = comprobar_session();

if(!isset($_GET['lib'])) {
    header('Location: ' . RUTA);
}

$conexion = conexion($bd_config);
if(!$conexion) {
    header('Location: ' . RUTA . 'error.php');
}

$libroId = limpiarId($_GET['lib']); 
if(empty($libroId)) {
    close_conexion($conexion);
    header('Location: ' . RUTA);
}

$librosML = obtener_libros_mas_leidos($conexion, 6);
if(!$librosML) {
    close_conexion($conexion);
    header('Location: ' . RUTA);
}

$libro = obtener_libro_por_id($conexion, $libroId)[0];
if(!$libro) {
    close_conexion($conexion);
    header('Location: ' . RUTA);
}

if($session) {    
    $rolID = obtener_usuario($conexion, $_SESSION['usuario'])[0]['rolID'];
    if($rolID !== 1) {
        $rolID = null;
    }
}

$vl = obtener_libro_veces_leido($conexion, $libro['id']); 
if(!$vl) {
    $vecesLeido = 0;
} else {
    $vecesLeido = (int)$vl[0]['veces_leido'];
}

close_conexion($conexion);

require 'views/single.view.php';