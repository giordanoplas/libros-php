<?php 
    $conexion = conexion($bd_config);
    if(!$conexion) {
        header('Location: ' . RUTA . 'error.php');
    }
    
    $estadisticas = obtener_estadisticas($conexion);
    $visitas = 0;
    $registros = 0;
    $ingresos = 0;
    
    if($estadisticas) {
        $estadisticas = $estadisticas[0];
        $visitas = $estadisticas['visitas'];
        $registros = $estadisticas['registros'];
        $ingresos = $estadisticas['ingresos'];
    }

    close_conexion($conexion);
?>

<div class="columna col-lg-5">
    <div class="widget estadisticas">
        <h3 class="titulo">Estadísticas</h3>
        <div class="contenedor d-flex flex-wrap">
            <div class="caja">
                <h3><?php echo $visitas; ?></h3>
                <p>Visitas</p>
            </div>
            <div class="caja">
                <h3><?php echo $registros; ?></h3>
                <p>Registros</p>
            </div>
            <div class="caja">
                <h3><?php echo $ingresos; ?></h3>
                <p>Ingresos</p>
            </div>
        </div>
    </div>
</div>