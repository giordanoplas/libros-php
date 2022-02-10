<?php 

require 'admin/config.php';
require 'funciones.php';

$session = comprobar_session();

$conexion = conexion($bd_config);
if(!$conexion) {
    header('Location: ' . RUTA . 'error.php');
}

$estadisticas = obtener_estadisticas($conexion);

if($estadisticas) {
    $estadisticas = $estadisticas[0];    
    $visitas = (int)$estadisticas['visitas'];
    $visitas++;

    $st = $conexion->prepare("
        UPDATE estadisticas
        SET visitas=?
        WHERE id=?
    ");
    $st->bind_param('ii', $visitas, $estadisticas['id']);
    $st->execute();
}

$i = 0;
$index = 1;

$librosSS = obtener_libros_slider($conexion, 10);
$librosML = obtener_libros_mas_leidos($conexion, 12);
$categorias = obtener_categorias($conexion);

if(!$librosSS || !$librosML || !$categorias) {
    close_conexion($conexion);
    //die("No hay datos en la DB");
    header('Location: error.php');
}

close_conexion($conexion);

require 'views/index.view.php';