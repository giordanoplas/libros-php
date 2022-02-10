<?php require 'views/header.php'; ?>

<main>
    <div class="container">
        <div class="row p-5 bg-white">
            <div class="col text-center text-sm-left">                
                <h2 class="text-info">Confirmar correo: <?php echo $email; ?></h2>             
                <?php if(!empty($errores)): ?>                        
                    <div class="alert" style="background: #ba1a1a; color: white;">
                        <b><?php echo $errores ?></b>
                    </div>
                <?php elseif(!empty($success)): ?>
                    <div class="alert alert-info">
                        <b><?php echo $success ?></b>
                    </div>
                <?php endif; ?>   
            </div>
        </div>
    </div>
    <script src="<?php RUTA ?>js/redirect.js"></script>
</main>

<?php require 'views/footer.php'; ?>