<?php

require 'config.php';
require '../funciones.php';

$session = comprobar_session();
if(!$session) {
    header('Location: ' . RUTA);
}

$conexion = conexion($bd_config);
if(!$conexion) {
    header('Location: ' . RUTA . 'error.php');
}

$usuarioRol = obtener_usuario($conexion, $_SESSION['usuario'])[0]['rolID'];
if($usuarioRol !== 1) {
    close_conexion($conexion);
    header('Location: ' . RUTA);
} else {
    close_conexion($conexion);
    header('Location: ' . $book_admin['dashboard']);
}

close_conexion($conexion);