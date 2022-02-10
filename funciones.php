<?php session_start();

function conexion($bd_config) {
    $conn = new mysqli($bd_config['host'], $bd_config['usuario'], $bd_config['pass'], $bd_config['basedatos']);
    if($conn->connect_errno) {
        return false;
    } else {
        return $conn;
    }
}

function close_conexion($conexion) {
    $thread = $conexion->thread_id;
    $conexion->kill($thread);
    $conexion->close();
}

function limpiarDatos($datos) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    
    return $datos;
}

function limpiarId($id) {
    return (int)limpiarDatos($id);
}

function limpiarCorreo($correo) {
    return filter_var($correo, FILTER_SANITIZE_EMAIL);
}

function encriptarPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT, [20]);
}

function verificarPassword($password, $passEncriptado) {
    return password_verify($password, $passEncriptado);
}

function parse_results($stmt)
{
    $params = array();
    $data = array();
    $results = array();
    $meta = $stmt->result_metadata();
    
    while($field = $meta->fetch_field())
        $params[] = &$data[$field->name]; // pass by reference
    
    call_user_func_array(array($stmt, 'bind_result'), $params);
    
    while($stmt->fetch()) {
        foreach($data as $key => $val) {
            $c[$key] = $val;
        }
        $results[] = $c;
    }
    
    return $results;
}

function obtener_usuario($conexion, $usuario) {
    $statement = $conexion->prepare("
        SELECT * FROM usuarios WHERE usuario=? LIMIT 1
    ");
    $statement->bind_param('s', $usuario);
    $statement->execute();

    $resultado = parse_results($statement);

    return ($resultado) ? $resultado : false;
}

function obtener_todos_libros($conexion) {
    $query = $conexion->query("
        SELECT * FROM libros
    ");

    $resultado = array();

    while($row = $query->fetch_array(MYSQLI_ASSOC)) {
        $resultado[] = $row;
    }

    return ($resultado) ? $resultado : false;
}

function obtener_libro_por_id($conexion, $id) {
    $statement = $conexion->prepare("
        SELECT * FROM libros WHERE id=? LIMIT 1
    ");
    $statement->bind_param('i', $id);
    $statement->execute();

    $resultado = parse_results($statement);

    return ($resultado) ? $resultado : false;
}

function obtener_libros_slider($conexion, $limite) {
    $query = $conexion->query("
        SELECT * FROM libros ORDER BY RAND() LIMIT $limite
    ");

    $resultado = array();

    while($row = $query->fetch_array(MYSQLI_ASSOC)) {
        $resultado[] = $row;
    }

    return count($resultado) > 0 ? $resultado : false;
}

function obtener_libros_con_limite($conexion, $limite) {
    $query = $conexion->query("
        SELECT * FROM libros LIMIT $limite
    ");

    $resultado = array();

    while($row = $query->fetch_array(MYSQLI_ASSOC)) {
        $resultado[] = $row;
    }

    return count($resultado) > 0 ? $resultado : false;
}

function obtener_libros_mas_leidos($conexion, $limite) {
    $query = $conexion->query("
        SELECT lib.id, lib.nombre, lib.autor, lib.portada FROM libros lib
        INNER JOIN libros_mas_leidos libml ON lib.id = libml.libroID
        ORDER BY libml.orden ASC
        LIMIT $limite
    ");

    $resultado = array();

    while($row = $query->fetch_array(MYSQLI_ASSOC)) {
        $resultado[] = $row;
    }

    return count($resultado) > 0 ? $resultado : false;
}

function actualizar_mas_leidos($conexion, $limite) {    
    $query = $conexion->query("
        SELECT * FROM libros_veces_leidos
        ORDER BY veces_leido DESC
        LIMIT $limite
    ");

    $resultado = array();

    while($row = $query->fetch_array(MYSQLI_ASSOC)) {
        $resultado[] = $row;
    }

    if(count($resultado) > 0) {
        $i = 1;

        foreach($resultado as $dato) {
            $st = $conexion->prepare("
                INSERT INTO libros_mas_leidos(libroID, orden)
                VALUES(?,?)
            ");
            $st->bind_param('ii', $dato['libroID'], $i);
            $st->execute();

            $i++;
        }
    }

    return ($conexion->affected_rows) ? true : false;
}

function obtener_libro_veces_leido($conexion, $libroID) {
    $statement = $conexion->prepare("
        SELECT libroID, COUNT(libroID) 'veces_leido' FROM usuario_leidos
        WHERE libroID=? LIMIT 1
    ");
    $statement->bind_param('i', $libroID);
    $statement->execute();

    $resultado = parse_results($statement);

    return ($resultado) ? $resultado : false;
}

function eliminar_libros_veces_leido($conexion) {
    $query = $conexion->query("
        DELETE FROM libros_veces_leidos
    ");

    return ($conexion->affected_rows) ? true : false;
}

function eliminar_mas_leidos($conexion) {
    $query = $conexion->query("
        DELETE FROM libros_mas_leidos
    ");

    return ($conexion->affected_rows) ? true : false;
}

function obtener_categorias($conexion) {
    $query = $conexion->query("
        SELECT * FROM categorias
    ");

    $resultado = array();

    while($row = $query->fetch_array(MYSQLI_ASSOC)) {
        $resultado[] = $row;
    }

    return ($resultado) ? $resultado : false;
}

function obtener_libros_por_categoria($conexion, $libros_por_categoria, $categoria) {
    /*
    $statement = $conexion->prepare('
        SELECT lib.id, lib.nombre, lib.autor, lib.portada FROM libros lib
        INNER JOIN libro_categorias lc ON lib.id = lc.libroID
        INNER JOIN categorias cat ON cat.id = lc.categoriaID
        WHERE cat.categoria = ?
        ORDER BY lib.nombre ASC  
    ');
    $statement->bind_param('s', $categoria);
    $statement->execute();

    $resultado = parse_results($statement);

    return ($resultado) ? $resultado : false;
    */

    $inicio = (pagina_actual() > 1) ? pagina_actual() * $libros_por_categoria - $libros_por_categoria : 0;
    
    $statement = $conexion->prepare("
        SELECT SQL_CALC_FOUND_ROWS lib.id, lib.nombre, lib.autor, lib.portada FROM libros lib
        INNER JOIN libro_categorias lc ON lib.id = lc.libroID
        INNER JOIN categorias cat ON cat.id = lc.categoriaID
        WHERE cat.categoria = ?
        ORDER BY lib.nombre ASC  
        LIMIT $inicio, $libros_por_categoria
    ");
    $statement->bind_param('s', $categoria);
    $statement->execute();

    $resultado = parse_results($statement);

    return ($resultado) ? $resultado : false;
}

function obtener_categorias_por_libro($conexion, $libroID) {
    $statement = $conexion->prepare('
        SELECT cat.id, cat.categoria FROM libro_categorias lc
        INNER JOIN categorias cat ON cat.id=lc.categoriaID
        WHERE lc.libroID=? LIMIT 3 
    ');
    $statement->bind_param('i', $libroID);
    $statement->execute();

    $resultado = parse_results($statement);

    return ($resultado) ? $resultado : false;
}

function obtener_categoria_por_categoria($conexion, $categoria) {
    $statement = $conexion->prepare('
        SELECT * FROM categorias
        WHERE categoria=? LIMIT 1
    ');
    $statement->bind_param('s', $categoria);
    $statement->execute();

    $resultado = parse_results($statement);

    return ($resultado) ? $resultado : false;
}

function obtener_estadisticas($conexion) {
    $query = $conexion->query("
        SELECT * FROM estadisticas LIMIT 1
    ");

    $resultado = array();

    while($row = $query->fetch_array(MYSQLI_ASSOC)) {
        $resultado[] = $row;
    }

    return ($resultado) ? $resultado : false;
}

function pagina_actual() {
    if(isset($_GET['p']) && !empty($_GET['p'])) {
        return (int)$_GET['p'];
    } else {
        return 1;
    }
}

function numero_paginas($conexion, $libros_por_categoria, $categoriaID) {
    $total_post = $conexion->query("SELECT COUNT(*) total FROM libro_categorias WHERE categoriaID=$categoriaID");
    $total_post = $total_post->fetch_array(MYSQLI_ASSOC)['total'];

    $numero_paginas = ceil($total_post / $libros_por_categoria);

    return $numero_paginas;
}

function buscar_libro($conexion, $busqueda) {
    $busqueda_param = '%' . $busqueda . '%';

    $statement = $conexion->prepare("
        SELECT * FROM libros WHERE nombre LIKE ? LIMIT 12
    ");
    $statement->bind_param('s', $busqueda_param);
    $statement->execute();

    $resultado = parse_results($statement);

    return ($resultado) ? $resultado : false;
}

function obtener_veces_libro_leido($conexion, $usuarioID, $libroID) {
    $statement = $conexion->prepare("
        SELECT * FROM usuario_leidos 
        WHERE usuarioID=? AND libroID=?
    ");
    $statement->bind_param('ii', $usuarioID, $libroID);
    $statement->execute();

    $resultado = parse_results($statement);

    return ($resultado) ? (int)count($resultado) : 0;
}

function comprobar_session() {
    return isset($_SESSION['usuario']) ? true : false;
}

function cerrar_session() {
    session_destroy();
    $_SESSION = null;
}

function enviar_correo($to, $subject, $message, $headers) {
    return mail($to, $subject, $message, $headers) ? true : false;
}

function confirmar_email($from, $to, $codigo, $ruta) {
    $subject = 'Confirmación correo de usuario de gpdesign.site/pages/libros/';
    $headers = 'From: ' . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $msn = '<html><body>';
    $msn .= '<h3>Confirmación de Correo</h3>';
    $msn .= '<p>Por favor confirma tu correo dando click en el siguiente enlace:<br/>' . $ruta . 'confirmar_email.php?codigo=' . $codigo . '</p>';                
    $msn .= '</body></html>';
    $sent = enviar_correo($to, $subject, $msn, $headers);

    if($sent) {
        return true;
    } else {
        return false;
    }
}

function codigo_random($min, $max) {
    $float_part = mt_rand(0, mt_getrandmax())/mt_getrandmax();
    $integer_part = mt_rand($min, $max - 1);
    return (string)$integer_part + $float_part;
}

function obtener_usuario_por_codigo($conexion, $codigo) {
    $statement = $conexion->prepare("
        SELECT * FROM usuarios
        WHERE codigo=? LIMIT 1
    ");
    $statement->bind_param('s', $codigo);
    $statement->execute();

    $resultado = parse_results($statement);

    return ($resultado) ? $resultado : false;
}