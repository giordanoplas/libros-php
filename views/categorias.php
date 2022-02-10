<?php 
    $colores_btn = array('primary', 'secondary', 'success', 'info', 'warning', 'danger', 'dark', 'info', 'success', 'primary');
    $i = 0;
?>

<div class="container bg-white">
    <div class="row d-flex align-content-center justify-content-center">
        <div class="col-12 mt-5">
            <p class="titulo-categoria mb-4">Categorías</p>            
        </div>
        <div class="col text-center categorias">
            <?php foreach($categorias as $categoria): ?> 
                <a href="categoria.php?cat=<?php echo $categoria['categoria']; ?>" class="btn btn-<?php echo $colores_btn[$i]; ?> py-2 btn-categoria"><?php echo $categoria['categoria']; ?></a>                               
                <?php $i++; ?>
            <?php endforeach; ?>         
        </div>
    </div>
</div>