<?php

require '../config.php';
require '../../funciones.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $conexion = conexion($bd_config);
    if(!$conexion) {
        header('Location: ' . RUTA . 'error.php');
    }

    $search = limpiarDatos($_POST['search']);

    $libros = buscar_libro($conexion, $search);
    $libsel = array();
    
    if(!$libros) {
        $libsel[] = 'No hay libros para modificar';
    } else {
        foreach($libros as $lib) {
            $libsel[] = array(
                'id' => $lib['id'],
                'nombre' => $lib['nombre']
            );
        }
    }

    close_conexion($conexion);

    header('Content-type: application/json');
    echo json_encode($libsel);
}