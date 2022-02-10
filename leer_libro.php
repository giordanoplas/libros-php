<?php

require 'admin/config.php';
require 'funciones.php';

$session = comprobar_session();

$conexion = conexion($bd_config);
if(!$conexion) {
    header('Location: ' . RUTA . 'error.php');
}

if(!isset($_GET['lib'])) {
    header('Location: ' . RUTA);
} else {
    $libroId = limpiarId($_GET['lib']); 
    $libro = obtener_libro_por_id($conexion, $libroId);
    if(!$libro) {
        close_conexion($conexion);
        header('Location: ' . RUTA);
    } else {
        $libro = $libro[0];
    }

    if(isset($_SESSION['usuario'])) {
        $usuarioID = obtener_usuario($conexion, $_SESSION['usuario'])[0]['id'];
        $libroID = $libro['id'];   
        $vecesLeido = obtener_veces_libro_leido($conexion, $usuarioID, $libroID);
    } else {
        $vecesLeido = 0;
    }

    $file = $book_config['carpeta_archivos'] . $libro['archivo'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $checkLeido = $_POST['leido'];

    if(isset($_SESSION['usuario'])) {
        $usuarioID = obtener_usuario($conexion, $_SESSION['usuario'])[0]['id'];
        $libroID = limpiarId($_POST['libro']);

        $st = $conexion->prepare("
            INSERT INTO usuario_leidos(usuarioID, libroID)
            VALUES(?, ?)
        ");
        $st->bind_param('ii', $usuarioID, $libroID);
        $st->execute();

        close_conexion($conexion);
        header('Location: ' . RUTA . 'leer_libro.php?lib=' . $libroID);
    }     
}

close_conexion($conexion);

require 'views/leer_libro.view.php';