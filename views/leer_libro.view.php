<?php require 'views/header.php'; ?>
<main>
    <div class="container shadow-lg p-0">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12">
                <form id="form-book" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <?php if(!isset($session) || !$session): ?>
                        <div class="alert m-0" style="background: #ba1a1a; color: white;">
                            <strong>Aviso:</strong> Por favor, Inicia Sesión para marcar este libro como leído.
                        </div>                
                    <?php else: ?>    
                        <div class="alert alert-primary m-0 d-block d-sm-flex justify-content-between align-items-center text-center">   
                            <h6 class="m-2 m-sm-0">Veces leído por usted: <span class="badge badge-pill badge-danger"><?php echo $vecesLeido ?></span></h6> 
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" id="leido" name="leido" class="custom-control-input">
                                <label for="leido" class="custom-control-label"><b>Marcar como leído</b></label>                        
                            </div>         
                        </div>             
                    <?php endif; ?>
                    <input type="hidden" name="libro" id="libro" value="<?php echo $libroId ?>">
                </form>
            </div>
            <div class="col m-0">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?php echo RUTA . $file ?>"></iframe>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo RUTA ?>js/validations.js"></script>
</main>
<?php require 'views/footer.php'; ?>