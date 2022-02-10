<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="<?php echo RUTA; ?>img/favicon.ico"/>
    <script src="https://kit.fontawesome.com/ba3661d33a.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Lato:wght@400;700&family=Open+Sans:wght@400;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    <link rel="stylesheet" href="<?php echo RUTA; ?>css/normalize.css">
    <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css">
    <title>Libros GP Design</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center my-4">
                <div class="col-5 col-md-3 order-1">
                    <a href="<?php echo RUTA; ?>"><img src="<?php echo RUTA . $book_config['carpeta_imagenes']; ?>logotipo/gplibros.png" width="150px"></a>
                </div>
                <div class="col-12 col-md-6 order-3 order-md-2 mt-3 mt-md-0">
                    <form name="buscar" action="<?php echo RUTA; ?>buscar.php" method="get">
                        <div class="input-group">
                            <input type="text" name="bus" placeholder="Buscar Libro" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-secondary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>                  
                    </form>
                </div>
                <div class="col-7 col-md-3 order-2 order-md-3 d-block d-lg-flex justify-content-end align-items-center">
                    <?php if(!isset($session) || !$session): ?>
                        <a href="<?php echo RUTA ?>login.php" class="btn btn-outline-primary mr-0 mr-lg-1 mb-1 mb-lg-0 w-100"><b>Login</b></a>
                        <a href="<?php echo RUTA ?>registro.php" class="btn btn-outline-info w-100"><b>Registro</b></a>             
                    <?php else: ?>
                        <a href="<?php echo RUTA ?>cerrar.php" class="btn btn-outline-dark w-100"><b>Cerrar Sesión</b></a>                    
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>