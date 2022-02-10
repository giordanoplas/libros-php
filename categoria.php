<?php

require 'admin/config.php';
require 'funciones.php';

$session = comprobar_session();

if(!isset($_GET['cat']) || empty($_GET['cat'])) {
    header('Location: ' . RUTA);
}

$conexion = conexion($bd_config);
if(!$conexion) {
    header('Location: ' . RUTA . 'error.php');
}

$categoria = limpiarDatos($_GET['cat']);
$categoriaID = obtener_categoria_por_categoria($conexion, $categoria)[0]['id'];

$librosML = obtener_libros_por_categoria($conexion, $book_config['libros_por_pagina'], $categoria);
if(!$librosML || !$categoriaID) {
    $busqueda = 'La categoría ' . '"' . $categoria . '"' . ' no tiene libros';
} else {
    $busqueda = $categoria;
}

close_conexion($conexion);

require 'views/categoria.view.php';