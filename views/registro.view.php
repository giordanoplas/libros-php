<?php require 'views/header.php'; ?>

<main>
    <div class="container">
        <div class="row p-5 bg-white">
            <div class="col text-center text-sm-left">                
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <h2 class="text-info">Registrarse como lector</h2>
                    <div class="input-group-lg my-3">
                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">    
                        <input type="email" id="email" name="email" class="form-control mt-2" placeholder="Correo electrónico">       
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
                    <div class="d-block d-sm-flex justify-content-between">
                        <input type="submit" class="btn btn-lg btn-outline-primary" value="Registrarse">
                        <a href="<?php echo RUTA ?>login.php" class="btn btn-lg btn-link"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
                    </div>            
                </form>
            </div>
        </div>
    </div>
</main>

<?php require 'views/footer.php'; ?>