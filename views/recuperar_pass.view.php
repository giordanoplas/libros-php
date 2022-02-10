<?php require 'views/header.php'; ?>

<main>
    <div class="container">
        <div class="row p-5 bg-white">
            <div class="col text-center text-sm-left">                
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <h2 class="text-success">Recuperar Contraseña</h2>
                    <input type="hidden" name="usuario" value="<?php echo $user; ?>">
                    <input type="hidden" name="codigo" value="<?php echo $code; ?>">
                    <div class="input-group-lg my-3">      
                        <input type="password" id="password" name="password" class="form-control mt-2" placeholder="Contraseña">
                        <input type="password" id="confirmar_password" name="confirmar_password" class="form-control mt-2" placeholder="Confirmar Contraseña">              
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
                    <input type="submit" class="btn btn-lg btn-outline-success w-100" value="Actualizar">          
                </form>
            </div>
        </div>
    </div>
</main>

<?php require 'views/footer.php'; ?>