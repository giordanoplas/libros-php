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

$categorias = obtener_categorias($conexion);
if(!$categorias) {
    $categorias = array('No hay categorías creadas');
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $success = '';
    $errores = '';

    $nombre = limpiarDatos($_POST['nombre']);
    $autor = limpiarDatos($_POST['autor']);
    $extracto = limpiarDatos($_POST['extracto']);
    $descripcion = nl2br($_POST['descripcion']);
    $portada = $_FILES['portada'];
    $thumb = $_FILES['thumb'];
    $archivo = $_FILES['archivo'];

    $categoria1 = (int)limpiarDatos($_POST['categorias1']);
    $categoria2 = isset($_POST['categorias2']) ? (int)limpiarDatos($_POST['categorias2']) : 0;
    $categoria3 = isset($_POST['categorias3']) ? (int)limpiarDatos($_POST['categorias3']) : 0;

    $allowedImg = array("image/jpeg", "image/jpg", "image/png");
    $allowedFile = array("application/pdf");

    if(empty($nombre) || empty($autor) || empty($extracto) || empty($descripcion) || empty($portada['name']) || empty($thumb['name']) || empty($archivo['name'])) {
        $errores = 'Por favor, llena todos los campos y carga todos los archivos';
    } elseif(!in_array($portada['type'], $allowedImg) || !in_array($thumb['type'], $allowedImg) || !in_array($archivo['type'], $allowedFile)) {
        $errores = "Solo es permitido subir .jpg, .jpeg, .png y .pdf";
    } elseif(strlen($nombre) > 40 || strlen($autor) > 40) {
        $errores = "Nombre y Autor, no deben exceder los 40 caracteres";
    } elseif(strlen($extracto) > 250) {
        $errores = "El extracto no debe exceder los 250 caracteres";
    } elseif(strlen($descripcion) > 600) {
        $errores = "La descripción no debe exceder los 600 caracteres";
    } else {
        $errores = '';
    }

    if(!$errores) {
        $st = $conexion->prepare("
            INSERT INTO libros(nombre,autor,extracto,descripcion,portada,thumb,archivo)
            VALUES(?,?,?,?,?,?,?)
        ");
        $st->bind_param('sssssss', $nombre, $autor, $extracto, $descripcion, 
                                   $portada['name'], $thumb['name'], $archivo['name']);
        $st->execute();

        if($conexion->affected_rows) {
            $portada_cargar = '../../' . $book_config['carpeta_portadas'] . $portada['name'];
            $thumb_cargar = '../../' . $book_config['carpeta_portadas'] . $thumb['name'];    
            $archivo_cargar = '../../' . $book_config['carpeta_archivos'] . $archivo['name'];  
            
            copy($portada['tmp_name'], $portada_cargar);
            copy($thumb['tmp_name'], $thumb_cargar);
            copy($archivo['tmp_name'], $archivo_cargar);

            $libroID = $conexion->insert_id;

            if($categoria1 > 0) {
                $stCategoria1 = $conexion->prepare("
                    INSERT INTO libro_categorias(libroID, categoriaID)
                    VALUES(?,?)
                ");
                $stCategoria1->bind_param('ii', $libroID, $categoria1);
                $stCategoria1->execute();
            }
            if($categoria2 > 0) {
                $stCategoria2 = $conexion->prepare("
                    INSERT INTO libro_categorias(libroID, categoriaID)
                    VALUES(?,?)
                ");
                $stCategoria2->bind_param('ii', $libroID, $categoria2);
                $stCategoria2->execute();
            }
            if($categoria3 > 0) {
                $stCategoria3 = $conexion->prepare("
                    INSERT INTO libro_categorias(libroID, categoriaID)
                    VALUES(?,?)
                ");
                $stCategoria3->bind_param('ii', $libroID, $categoria3);
                $stCategoria3->execute();
            }

            $success = "El libro fue agregado exitosamente.";
        } 
    }
}

close_conexion($conexion);

include 'views/agregar.view.php';