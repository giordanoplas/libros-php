<?php
    if($categoriaID) {
        $conexion = conexion($bd_config);
        if(!$conexion) {
            header('Location: ' . RUTA . 'error.php');
        }
        $numero_paginas = numero_paginas($conexion, $book_config['libros_por_pagina'], $categoriaID);
        close_conexion($conexion);
    }
?>

    <nav>
        <ul class="pagination d-flex justify-content-center m-0 p-0">
        <?php if(pagina_actual() === 1): ?>
            <li class="page-item disabled">
                <span class="page-link"><i class="fas fa-angle-double-left"></i></span>
            </li>
        <?php else: ?> 
            <li class="page-item">
                <a class="page-link" href="categoria.php?cat=<?php echo $categoria; ?>&p=<?php echo pagina_actual() - 1 ?>">
                    <span><i class="fas fa-angle-double-left"></i></span>
                </a>
            </li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $numero_paginas; $i++): ?>
        <?php if(pagina_actual() === $i): ?>
            <li class="page-item active"><span class="page-link"><?php echo $i; ?></span></li>
        <?php else: ?>
            <li class="page-item"><a href="categoria.php?cat=<?php echo $categoria; ?>&p=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
        <?php endif; ?>
        <?php endfor; ?>
        <?php if(pagina_actual() == $numero_paginas): ?>
            <li class="page-item disabled">
                <span class="page-link"><i class="fas fa-angle-double-right"></i></span>
            </li>
        <?php else: ?>
            <li class="page-item">
                <a class="page-link" href="categoria.php?cat=<?php echo $categoria; ?>&p=<?php echo pagina_actual() + 1; ?>">
                    <span><i class="fas fa-angle-double-right"></i></span>
                </a>
            </li>
        <?php endif; ?>
        </ul>
    </nav>