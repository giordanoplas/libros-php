<?php

define('RUTA', 'http://localhost:8080/projects/libros/');

$bd_config = array(
    'host' => 'localhost',
    'basedatos' => 'gpdesign_librosdb',
    'usuario' => 'root',
    'pass' => ''
);

$book_config = array(
    'carpeta_imagenes' => 'img/',
    'carpeta_portadas' => 'img/portadas/',
    'carpeta_archivos' => 'librospdf/',
    'libros_por_pagina' => 12
);

$book_admin = array(
    'rolID' => 2,
    'correo' => 'info@gpdesign.site',
    'dashboard' => RUTA . 'admin/dashboard/'
);