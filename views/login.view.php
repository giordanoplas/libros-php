<?php require 'views/header.php'; ?>

<main>
    <div class="container">
        <div class="row p-5 bg-white">
            <div class="col text-center text-sm-left">                
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <h2 class="text-primary">Iniciar Sesión</h2>
                    <div class="input-group-lg my-3">
                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">   
                        <input type="password" id="password" name="password" class="form-control mt-2" placeholder="Contraseña">                     
                    </div> 
                    
                    <?php if(isset($errores)): ?>                        
                        <div class="alert" style="background: #ba1a1a; color: white;">
                            <b><?php echo $errores ?></b>
                        </div>
                    <?php endif; ?>
                    
                    <a href="<?php echo RUTA ?>enviar_recuperar.php" class="btn btn-lg btn-link">¿Olvidaste la contraseña?</a>
                    <input type="submit" class="btn btn-lg btn-outline-info" value="Iniciar Sesión">
                </form>
            </div>
        </div>
    </div>
</main>

<?php require 'views/footer.php'; ?>