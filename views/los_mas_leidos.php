<?php 
    $vecesLeido = 0;                 
?>

<div class="container bg-white">
    <div class="row d-flex justify-content-center align-items-center">        
        <?php if(!isset($busqueda)): ?>
            <div class="col-12">
                <p class="titulo-mas-leidos mt-5 mb-4">Los más leídos</p>
            </div>   
            <div class="col-12 card-mas-leidos d-flex justify-content-center align-items-center">            
                <div class="card-columns text-center">
                <?php foreach($librosML as $libro): ?>
                    <div class="card">
                        <a href="single.php?lib=<?php echo $libro['id']; ?>">
                            <img src="<?php echo $book_config['carpeta_portadas'] . $libro['portada']; ?>" class="card-img-top img-fluid">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $libro['nombre']; ?></h5>
                            <p class="card-text autor-libro"><b><?php echo $libro['autor']; ?></b></p> 
                            <?php 
                                $conexion = conexion($bd_config);
                                if(!$conexion) {
                                    header('Location: ' . RUTA . 'error.php');
                                }

                                $vl = obtener_libro_veces_leido($conexion, $libro['id']);
                                
                                if(!$vl) {
                                    $vecesLeido = 0;
                                } else {
                                    $vecesLeido = (int)$vl[0]['veces_leido'];
                                }

                                close_conexion($conexion);
                            ?>           
                            <p class="card-text text-success"><b>Veces leído: <?php echo $vecesLeido; ?></b></p>              
                        </div>                         
                    </div>
                <?php endforeach; ?>
                </div>            
            </div>
        <?php else: ?>
            <div class="col-12">
                <?php if(empty($busqueda)): ?>
                    <h1 class="text-center text-danger my-5">No hubo resultados de tu búsqueda.</h1>
                <?php else: ?>
                    <?php if(isset($categoria) && !empty($categoria)): ?>
                    <h1 class="text-center text-primary my-5"><b><?php echo $busqueda ?></b></h1>
                    <?php else: ?>
                    <h1 class="text-center text-primary my-5"><b>Resultado de: <span class="text-secondary"><u><?php echo $busqueda ?></u></span></b></h1>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-12 card-mas-leidos d-flex justify-content-center align-items-center">
                <?php if($librosML): ?>
                    <div class="card-columns text-center">
                    <?php foreach($librosML as $libro): ?>
                        <div class="card">
                            <a href="single.php?lib=<?php echo $libro['id']; ?>">
                                <img src="<?php echo $book_config['carpeta_portadas'] . $libro['portada']; ?>" class="card-img-top img-fluid">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $libro['nombre']; ?></h5>
                                <p class="card-text autor-libro"><b><?php echo $libro['autor']; ?></b></p> 
                                <?php 
                                    $conexion = conexion($bd_config);
                                    if(!$conexion) {
                                        header('Location: ' . RUTA . 'error.php');
                                    }

                                    $vl = obtener_libro_veces_leido($conexion, $libro['id']);
                                    
                                    if(!$vl) {
                                        $vecesLeido = 0;
                                    } else {
                                        $vecesLeido = (int)$vl[0]['veces_leido'];
                                    }

                                    close_conexion($conexion);
                                ?>           
                                <p class="card-text text-success"><b>Veces leído: <?php echo $vecesLeido; ?></b></p>              
                            </div>                         
                        </div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>            
        <?php endif; ?>        
    </div>
</div>