<?php

require 'admin/config.php';
require 'funciones.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errores = '';
    $success = '';

    $usuario = limpiarDatos($_POST['usuario']);
    if(empty($usuario)) {
        $errores .= 'Por favor, escribe el usuario';
        $success = '';
    } else {
        $conexion = conexion($bd_config);
        if(!$conexion) {
            header('Location: ' . RUTA . 'error.php');
        }
        
        $usuarioDB = obtener_usuario($conexion, $usuario);
        if(!$usuarioDB) {
            $errores .= 'Este usuario no existe en el sistema';
            $success = '';
        }

        if(empty($errores)) {
            $usuarioDB = $usuarioDB[0];
            $codigo = (string)codigo_random(51, 100);
            $usuarioCodigo = obtener_usuario_por_codigo($conexion, $codigo);
            while($usuarioCodigo) {
                $codigo = codigo_random(51, 100);
                $usuarioCodigo = obtener_usuario_por_codigo($conexion, $codigo);
            }

            $st = $conexion->prepare("
                UPDATE usuarios
                SET codigo=?
                WHERE id=?
            ");
            $st->bind_param('si', $codigo, $usuarioDB['id']);
            $st->execute();

            if($conexion->affected_rows) {
                $to = $usuarioDB['email'];
                $subject = 'Recuperación de contraseña para usuario ' . $usuarioDB['usuario'];
                $headers = 'From: ' . $book_admin['correo'] . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $msn = '<html><body>';
                $msn .= '<h3>Recuperar contraseña</h3>';
                $msn .= '<p>Por favor, ingresa al siguiente link para recuperar tu contraseña: <br/>' . RUTA . 'recuperar_pass.php?usuario=' . $usuarioDB['usuario'] . '&codigo=' . $codigo; '</p>';                
                $msn .= '</body></html>';
                $sent = enviar_correo($to, $subject, $msn, $headers);

                if($sent) {
                    $success = 'Un correo te ha sido enviado para que puedas recuperar la contraseña';
?>                  <script src="<?php echo RUTA ?>js/redirect.js"></script>
<?php
                } else {
                    $errores = 'El correo de recuperación no pudo ser enviado';
                }                
            }            
        } 
        
        close_conexion($conexion);
    } 
}

require 'views/enviar_recuperar.view.php';