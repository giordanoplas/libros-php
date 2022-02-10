<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<div class="barra-lateral col-12 col-sm-auto">
    <input type="hidden" name="current_page" id="current_page" value="<?php echo $current_page; ?>">
    <div class="logo d-flex justify-content-center align-items-center">
        <a href="<?php echo RUTA; ?>" target="_blank"><img src="<?php echo RUTA . $book_config['carpeta_imagenes']; ?>logotipo/gplibros.png"></a>
    </div>
    <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
        <a id="menu1" href="<?php echo RUTA; ?>admin/dashboard/"><i class="fas fa-house-user"></i><span>Inicio</span></a>
        <a id="menu2" href="<?php echo RUTA; ?>admin/dashboard/agregar.php"><i class="fas fa-swatchbook"></i><span>Agregar Libro</span></a>
        <a id="menu3" href="<?php echo RUTA; ?>admin/dashboard/modificar.php"><i class="fas fa-pen-fancy"></i><span>Modificar Libro</span></a>
        <a id="menu4" href="<?php echo RUTA; ?>admin/dashboard/leidos.php"><i class="fas fa-book-reader"></i><span>Más Leídos</span></a>
        <a href="<?php echo RUTA; ?>cerrar.php"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a>
    </nav>
    <script src="<?php echo $book_admin['dashboard']; ?>js/selected.js"></script>
</div>