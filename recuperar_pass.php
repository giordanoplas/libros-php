<?php

require 'admin/config.php';
require 'funciones.php';

if(!isset($_GET['usuario']) || !isset($_GET['codigo']) || empty($_GET['usuario']) || empty($_GET['codigo'])){
    header('Location ' . RUTA);
}

$user = limpiarDatos($_GET['usuario']);
$code = limpiarDatos($_GET['codigo']);

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['password']) && isset($_GET['confirmar_password'])) {
    $errores = '';
    $success = '';
    
    $usuario = limpiarDatos($_GET['usuario']);
    $codigo = limpiarDatos($_GET['codigo']);

    $pass = limpiarDatos($_GET['password']);
    $confirmar_pass = limpiarDatos($_GET['confirmar_password']); 

    if(empty($pass) || empty($confirmar_pass)) {
        $errores = "Por favor, llena todos los campos";
        $success = '';
    } else {
        if($pass === $confirmar_pass) {
            $pass = encriptarPassword($pass);            
        } else {
            $errores = "Las contraseÃ±as deben ser iguales";
            $success = '';
        }
    }
    
    if(empty($errores)) {
        $conexion = conexion($bd_config);
        if(!$conexion) {
            header('Location: error.php');
        }

        $usuarioDB = obtener_usuario($conexion, $usuario);
        if(!$usuarioDB) {
            header('Location ' . RUTA);
        } else {
            $usuarioDB = $usuarioDB[0];
        }

        $st = $conexion->prepare("
            UPDATE usuarios
            SET pass=?, codigo=NULL
            WHERE id=?
        ");
        $st->bind_param('ss', $pass, $usuarioDB['id']);
        $st->execute();

        if($conexion->affected_rows) {
            close_conexion($conexion);
            header('Location: login.php');
        } else {
            close_conexion($conexion);
            $errores = "La contraseña no pudo ser actualizada.<br>Por favor intenta de nuevo.";
        }
    }
}

require 'views/recuperar_pass.view.php';