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

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = limpiarId($_GET['id']);
    $libro = obtener_libro_por_id($conexion, $id);
    $libro = $libro ? $libro[0] : null;   
    $libro_categorias = obtener_categorias_por_libro($conexion, $id);
    $libro_categorias = $libro_categorias ? $libro_categorias : null;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $success = '';
    $errores = '';

    $id = utf8_decode(limpiarId($_POST['id']));
    $nombre = utf8_decode(limpiarDatos($_POST['nombre']));
    $autor = utf8_decode(limpiarDatos($_POST['autor']));
    $extracto = utf8_decode(limpiarDatos($_POST['extracto']));
    $descripcion = utf8_decode(nl2br($_POST['descripcion']));
    $portada_guardada = utf8_decode($_POST['portada_guardada']);
    $thumb_guardado = utf8_decode($_POST['thumb_guardado']);
    $archivo_guardado = utf8_decode($_POST['archivo_guardado']);
    $portada = $_FILES['portada'];
    $thumb = $_FILES['thumb'];
    $archivo = $_FILES['archivo'];

    $allowedImg = array("image/jpeg", "image/jpg", "image/png");
    $allowedFile = array("application/pdf");

    if(empty($nombre) || empty($autor) || empty($extracto) || empty($descripcion)) {
        $errores = "Por favor, llena todos los campos";;
    } elseif(strlen($nombre) > 40 || strlen($autor) > 40) {
        $errores = "Nombre y Autor, no deben exceder los 40 caracteres";
    } elseif(strlen($extracto) > 250) {
        $errores = "El extracto no debe exceder los 250 caracteres";;
    } elseif(strlen($descripcion) > 600) {
        $errores = "La descripción no debe exceder los 600 caracteres";
    } else {
        $errores = '';
    }

    if(empty($portada['name'])) {
        $portada = $portada_guardada;
    } else {
        $portada_cargar = '../../' . $book_config['carpeta_portadas'] . $_FILES['portada']['name'];            

        if(!in_array($_FILES['portada']['type'], $allowedImg)) {
            $errores = "Solo es permitido subir .jpg, .jpeg, .png y .pdf";
        } else {
            copy($_FILES['portada']['tmp_name'], $portada_cargar);
            $portada = $_FILES['portada']['name'];
        }
    }

    if(empty($thumb['name'])) {
        $thumb = $thumb_guardado;
    } else {
        $thumb_cargar = '../../' . $book_config['carpeta_portadas'] . $_FILES['thumb']['name'];            

        if(!in_array($_FILES['thumb']['type'], $allowedImg)) {
            $errores = "Solo es permitido subir .jpg, .jpeg, .png y .pdf";
        } else {
            copy($_FILES['thumb']['tmp_name'], $thumb_cargar);
            $thumb = $_FILES['thumb']['name'];
        }
    }

    if(empty($archivo['name'])) {
        $archivo = $archivo_guardado;
    } else {
        $archivo_cargar = '../../' . $book_config['carpeta_archivos'] . $_FILES['archivo']['name'];

        if(!in_array($_FILES['archivo']['type'], $allowedFile)) {
            $errores = "Solo es permitido subir .jpg, .jpeg, .png y .pdf";
        } else {
            copy($_FILES['archivo']['tmp_name'], $archivo_cargar);
            $archivo = $_FILES['archivo']['name'];
        }
    } 
    
    $categoria1 = (int)limpiarDatos($_POST['categorias1']);
    $categoria2 = isset($_POST['categorias2']) ? (int)limpiarDatos($_POST['categorias2']) : 0;
    $categoria3 = isset($_POST['categorias3']) ? (int)limpiarDatos($_POST['categorias3']) : 0;

    if(!$errores) {
        $st = $conexion->prepare("
            UPDATE libros
            SET nombre=?, autor=?, extracto=?, descripcion=?, portada=?, thumb=?, archivo=?
            WHERE id=?
        ");
        $st->bind_param('sssssssi', $nombre, $autor, $extracto, $descripcion, 
                                    utf8_decode($portada), utf8_decode($thumb), utf8_decode($archivo), $id);
        $st->execute();

        $libro_categorias = obtener_categorias_por_libro($conexion, $id);

        if(!$libro_categorias) {
            if($categoria1 > 0) {
                $stCategoria1 = $conexion->prepare("
                    INSERT INTO libro_categorias(libroID, categoriaID)
                    VALUES(?,?)
                ");
                $stCategoria1->bind_param('ii', $id, $categoria1);
                $stCategoria1->execute();
            }
            if($categoria2 > 0) {
                $stCategoria2 = $conexion->prepare("
                    INSERT INTO libro_categorias(libroID, categoriaID)
                    VALUES(?,?)
                ");
                $stCategoria2->bind_param('ii', $id, $categoria2);
                $stCategoria2->execute();
            }
            if($categoria3 > 0) {
                $stCategoria3 = $conexion->prepare("
                    INSERT INTO libro_categorias(libroID, categoriaID)
                    VALUES(?,?)
                ");
                $stCategoria3->bind_param('ii', $id, $categoria3);
                $stCategoria3->execute();
            } 
        } else {
            $categoriasNuevasID = array($categoria1, $categoria2, $categoria3);

            for($i = 0; $i < count($categoriasNuevasID); $i++) {
                $catActualID = (isset($libro_categorias[$i]['id'])) ? (int)$libro_categorias[$i]['id'] : null;
                $catNuevaID = (int)$categoriasNuevasID[$i];

                if($catNuevaID === 0 && isset($catActualID)) {
                    $st = $conexion->prepare("
                        DELETE FROM libro_categorias
                        WHERE categoriaID=? AND libroID=?
                    ");
                    $st->bind_param('ii', $catActualID, $id);
                    $st->execute();
                } /*elseif($catNuevaID === 0 && !isset($catActualID)) {

                }*/ elseif($catNuevaID !== 0 && !isset($catActualID)) {
                    $st = $conexion->prepare("
                        INSERT INTO libro_categorias(libroID, categoriaID)
                        VALUES(?,?)
                    ");
                    $st->bind_param('ii', $id, $catNuevaID);
                    $st->execute();
                } elseif($catNuevaID !== 0 && isset($catActualID)) {
                    $st = $conexion->prepare("
                        UPDATE libro_categorias
                        SET categoriaID=?
                        WHERE categoriaID=? AND libroID=?
                    ");
                    $st->bind_param('iii', $catNuevaID, $catActualID, $id);
                    $st->execute();
                } else {
                    //$errores = "Hubo un error inesperado";
                }                             
            }
        }

        $success = "El libro fue modificado exitosamente.";
    }
}

close_conexion($conexion);

require 'views/modificar.view.php';