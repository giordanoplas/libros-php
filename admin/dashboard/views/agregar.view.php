<?php require 'views/header.php'; ?>

<body>
    <div class="container-fluid">
        <div class="row"> 
            <?php include 'views/barra_lateral.php'; ?>

            <main class="col">
                <div class="row">
                    <div class="columna col-lg-7">
                        <div class="widget">
                            <h3 class="titulo">Agregar Libro</h3>
                            <form id="agregar-libro-form" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre:">
                                <input type="text" name="autor" id="autor" placeholder="Autor:">
                                <input type="text" name="extracto" id="extracto" placeholder="Extracto:">
                                <textarea name="descripcion" id="descripcion" placeholder="Descripción:"></textarea>                    
                                <hr>

                                <label class="label">Cargar Portada: <input type="file" name="portada" id="portada" accept="image/jpeg, image/jpg, image/png"></label>
                                <label class="label">Cargar Fondo: <input type="file" name="thumb" id="thumb" accept="image/jpeg, image/jpg, image/png"></label>
                                <label class="label">Cargar Archivo: <input type="file" name="archivo" id="archivo" accept="application/pdf"></label>
                                <hr>                                

                                <div class="form-group">
                                    <label for="categorias1">Categoría 1:</label>
                                    <select name="categorias1" id="categorias1" class="custom-select">
                                        <option value="0" class="red-msn">N/A</option>
                                        <?php foreach($categorias as $categoria): ?>
                                            <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                        <?php endforeach; ?>
                                    </select>                                    
                                </div>        
                                
                                <div class="form-group">
                                    <label for="categorias2">Categoría 2:</label>
                                    <select name="categorias2" id="categorias2" class="custom-select" disabled>
                                        <option value="0" class="red-msn">N/A</option>
                                        <?php foreach($categorias as $categoria): ?>
                                            <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                        <?php endforeach; ?>
                                    </select>                                    
                                </div>

                                <div class="form-group">
                                    <label for="categorias3">Categoría 3:</label>
                                    <select name="categorias3" id="categorias3" class="custom-select" disabled>
                                        <option value="0" class="red-msn">N/A</option>
                                        <?php foreach($categorias as $categoria): ?>
                                            <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <hr>

                                <?php if(!empty($errores)): ?>                        
                                    <div class="alert" style="background: #ba1a1a; color: white;">
                                        <b><?php echo $errores ?></b>
                                    </div>
                                <?php elseif(!empty($success)): ?>
                                    <div class="alert alert-info">
                                        <b><?php echo $success ?></b>
                                    </div>
                                <?php endif; ?>     

                                <div class="d-flex justify-content-center my-4">
                                    <button id="btnSubir" class="btn btn-primary px-5 py-2"><i class="fas fa-edit"></i> <b>Subir Libro</b></button>
                                </div>
                                
                            </form>
                        </div>
                    </div>

                    <?php include 'views/estadisticas.php'; ?>
                </div>
            </main>
        </div> 
    </div>
    <!--<script src="<?php echo $book_admin['dashboard']; ?>js/validation.js"></script>-->
</body>
</html>