<?php include 'views/header.php'; ?>

<body>
    <div class="container-fluid">
        <div class="row"> 
            <?php include 'views/barra_lateral.php'; ?>

            <main class="main col">
                <div class="row">
                    <div class="columna col-lg-7">
                        <img class="mb-3" src="<?php echo RUTA . $book_config['carpeta_imagenes'] ?>/logotipo/dashboard.png" width="250px" alt="">
                        <h2 class="text-success text-center shadow mb-4 p-2"><strong>GP Libros</strong></h2>    
                        <h4 class="text-justify">Mediante este panel, puedes administrar la web de GP Libros de forma dinámica y desde cualquier dispositivo.</h4>
                        <h5 class="mt-3"><b>Instrucciones:</b></h5>
                        <div class="alert alert-info">
                            <strong>1.</strong> Debes ser usuario logueado y con privilegios de administrador.
                        </div>
                        <div class="alert alert-success">
                            <strong>2.</strong> Debes haber recibido el entrenamiento previo para administrar los libros.
                        </div>
                        <div class="alert alert-secondary">
                            <strong>3.</strong> Si cumples con las condiciones del paso 1 y 2, solo debes seleccionar en la barra de la izquierda, la opción deseada.
                        </div>
                        <div class="alert alert-primary">
                            <strong>4.</strong> Una vez hayas terminado tu trabajo, debes salir del sistema, seleccionando la opción de Salir en la barra de la izquierda.
                        </div>                       
                    </div>

                    <?php include 'views/estadisticas.php' ?>
                </div>
            </main>
        </div> 
    </div>
</body>
</html>