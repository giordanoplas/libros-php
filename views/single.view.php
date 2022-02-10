<?php require 'views/header.php'; ?>

<main>
    <div class="container bg-white">        
        <div class="row">
            <div class="col-12 p-0 m-0">
                <div class="fondo-translucido-single"></div>
                <img src="<?php echo $book_config['carpeta_portadas'] . $libro['thumb'] ?>" class="img img-fluid portada-fondo-single">                                             
            </div>
            <div class="col p-5 d-flex justify-content-center align-items-center">                  
                <div class="row info">
                    <div class="col-12 col-sm-auto d-flex justify-content-center align-items-center">
                        <img src="<?php echo $book_config['carpeta_portadas'] . $libro['portada'] ?>" class="portada-single">
                    </div>
                    <div class="col text-center text-sm-left">
                        <p class="titulo-single"><?php echo $libro['nombre'] ?></p>
                        <p class="autor-single"><?php echo $libro['autor'] ?></p>
                        <p class="veces-leido-single">Veces leído: <?php echo $vecesLeido; ?></p>
                        <p class="descripcion-single"><?php echo $libro['descripcion'] ?></p>
                        <a href="leer_libro.php?lib=<?php echo $libro['id'] ?>" class="btn btn-outline-info px-5">Leer libro</a>
                    </div>
                </div>                           
            </div>
        </div>
    </div>
    <?php require 'views/los_mas_leidos.php'; ?>
</main>

<?php require 'views/footer.php'; ?>