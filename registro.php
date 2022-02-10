<?php

require 'admin/config.php';
require 'funciones.php';

$session = comprobar_session();
if($session) {
    header('Location: ' . RUTA);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errores = '';
    $success = '';

    $usuario = limpiarDatos($_POST['usuario']);
    $email = limpiarCorreo($_POST['email']);
    $pass = limpiarDatos($_POST['password']);
    $confirmar_pass = limpiarDatos($_POST['confirmar_password']); 
    $rolID = $book_admin['rolID'];
    $codigo = codigo_random(2, 50);

    if(empty($usuario) || empty($email) || empty($pass) || empty($confirmar_pass)) {
        $errores .= "Por favor, llena todos los campos";
        $success = '';
    } else {
        if($pass === $confirmar_pass) {
            $pass = encriptarPassword($pass);            
        } else {
            $errores .= "Las contraseÃ±as deben ser iguales";
            $success = '';
        }
    }

    if(empty($errores)) {
        $conexion = conexion($bd_config);
        if(!$conexion) {
            header('Location: ' . RUTA . 'error.php');
        }

        $comprobar_usuario = obtener_usuario($conexion, $usuario);
        if($comprobar_usuario) {
            $errores .= 'Este usuario ya existe';
            $success = '';
        } else {
            $usuarioCodigo = obtener_usuario_por_codigo($conexion, $codigo);
            while($usuarioCodigo) {
                $codigo = codigo_random(2, 50);
                $usuarioCodigo = obtener_usuario_por_codigo($conexion, $codigo);
            }
            
            $st = $conexion->prepare("
                INSERT INTO usuarios(usuario, pass, email, rolID, codigo)
                VALUES(?, ?, ?, ?, ?)
            ");
            $st->bind_param('sssis', $usuario, $pass, $email, $rolID, $codigo);
            $st->execute();

            if($conexion->affected_rows) {               
                $sent = confirmar_email($book_admin['correo'], $email, $codigo, RUTA);
                if(!$sent) {
                    $success = '';
                    $errores = 'El correo de confirmación no pudo ser enviado.';
                } else {
                    $errores = '';
                    $success = 'El usuario ha sido almacenado correctamente.<br/>Ahora debes confirmar tu correo antes de Iniciar Sesión.';
                }
            }
        }

        close_conexion($conexion);
    }
} 

require 'views/registro.view.php';