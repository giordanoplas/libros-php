<?php 

require 'admin/config.php';
require 'funciones.php';

$session = comprobar_session();
if($session) {
    header('Location: ' . RUTA);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errores = '';

    $usuario = limpiarDatos($_POST['usuario']);
    $pass = limpiarDatos($_POST['password']);

    if(empty($usuario) || empty($pass)) {
        $errores .= "Por favor, llena todos los campos";
    } else {
        $conexion = conexion($bd_config);
        if(!$conexion) {
            header('Location: ' . RUTA . 'error.php');
        }

        $usuarioDB = obtener_usuario($conexion, $usuario);

        if($usuarioDB) {       
            $usuarioDB = $usuarioDB[0];

            if($usuarioDB['codigo'] == NULL) {
                $comparePass = verificarPassword($pass, $usuarioDB['pass']);           

                if($comparePass) {                    
                    $_SESSION['usuario'] = $usuario;

                    $estadisticas = obtener_estadisticas($conexion);
                    if($estadisticas) {
                        $estadisticas = $estadisticas[0];
                        $ingresos = (int)$estadisticas['ingresos'];
                        $ingresos++;
                        
                        $st = $conexion->prepare("
                            UPDATE estadisticas
                            SET ingresos=?
                            WHERE id=?
                        ");
                        $st->bind_param('ii', $ingresos, $estadisticas['id']);
                        $st->execute();
                    } 
                    
                    close_conexion($conexion);
                    header('Location: ' . RUTA);                
                } else {
                    close_conexion($conexion);
                    $errores .= 'Datos incorrectos o no encontrados';
                }       
            } else {
                $errores .= 'Por favor, confirma el correo de este usuario';                
            }   
        } else {
            close_conexion($conexion);
            $errores .= 'Datos incorrectos o no encontrados';
        }  
    }   
}

require 'views/login.view.php';