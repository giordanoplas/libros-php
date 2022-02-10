<?php require 'views/header.php' ?>

<main>
    <div class="container bg-white">
        <div class="row">
            <div class="col">
                <?php require 'views/los_mas_leidos.php' ?>                 
            </div>
            <div class="col-12 mt-5">
                <?php if($librosML): ?>
                    <?php require 'views/paginacion.php'; ?>
                <?php endif; ?>  
            </div>
        </div>
    </div>    
</main>

<?php require 'views/footer.php' ?>