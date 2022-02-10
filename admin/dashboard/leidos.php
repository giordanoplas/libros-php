<?php

require '../config.php';
require '../../funciones.php';

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
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eliminadoMasLeidos = eliminar_mas_leidos($conexion);
    $eliminadoVecesLeidos = eliminar_libros_veces_leido($conexion);

    $libros = obtener_todos_libros($conexion);
    $i = 0; 

    foreach($libros as $libro) {
        $libroVecesLeido = obtener_libro_veces_leido($conexion, $libro['id'])[0];

        if($libroVecesLeido) {
            $st = $conexion->prepare("
                INSERT INTO libros_veces_leidos(libroID, veces_leido)
                VALUES(?,?)
            ");
            $st->bind_param('ii', $libroVecesLeido['libroID'], $libroVecesLeido['veces_leido']);
            $st->execute();
        }
    }   

    $actualizadoMasLeidos = actualizar_mas_leidos($conexion, 12);
    close_conexion($conexion);
    header('Location: ' . $book_admin['dashboard']);
}

close_conexion($conexion);

include 'views/leidos.view.php';