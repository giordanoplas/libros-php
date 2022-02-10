<?php

require 'admin/config.php';
require 'funciones.php';

if(!isset($_GET['email']) && !isset($_GET['codigo'])) {
    header('Location: ' . RUTA);
} else {
    $errores = '';
    $success = '';
    $email = limpiarCorreo($_GET['email']);
    $codigo = limpiarDatos($_GET['codigo']);

    $conexion = conexion($bd_config);
    if(!$conexion) {
        header('Location: ' . RUTA . 'error.php');
    }

    $usuario = obtener_usuario_por_codigo($conexion, $codigo);
    
    if(!$usuario) {
        $errores = 'Ocurrió un error inesperado.<br>' . 'Por favor intenta más tarde.';
        $success = '';
    } else {
        $usuario = $usuario[0];
        
        $st = $conexion->prepare("
            UPDATE usuarios 
            SET codigo=NULL
            WHERE id=?
        ");
        $st->bind_param('i', $usuario['id']);
        $st->execute();

        if($conexion->affected_rows) {
            $errores = '';
            $success = 'Este correo ha sido confirmado satisfactoriamente.<br>En breve serás redirigido para que inicies sesión.';
        }
    }

    close_conexion($conexion);
}

require 'views/confirmar_email.view.php';