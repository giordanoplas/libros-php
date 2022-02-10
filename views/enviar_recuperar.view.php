<?php require 'views/header.php'; ?>

<main>
    <div class="container">
        <div class="row p-5 bg-white">
            <div class="col text-center text-sm-left">                
                <form id="formEnviarRecuperar" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <h2 class="text-secondary">Recuperar Contraseña</h2>
                    <div class="input-group-lg my-3">
                        <input type="text" id="usuario" name="usuario" class="form-control text-white" placeholder="Usuario" style="background: #bfbdbd;">
                    </div> 
                    
                    <?php if(!empty($errores)): ?>                        
                        <div class="alert" style="background: #ba1a1a; color: white;">
                            <b><?php echo $errores ?></b>
                        </div>
                    <?php elseif(!empty($success)): ?>
                        <div class="alert alert-info">
                            <b><?php echo $success ?></b>
                        </div>
                    <?php endif; ?>

                    <input type="submit" id='enviarRecuperar' class="btn btn-lg btn-outline-secondary w-100" value="Enviar">
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo RUTA ?>js/redirect_enviar_recuperar.js"></script>
</main>

<?php require 'views/footer.php'; ?>