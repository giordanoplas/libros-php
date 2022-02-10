<?php require 'views/header.php'; ?>

<body>
    <div class="container-fluid">
        <div class="row"> 
            <?php include 'views/barra_lateral.php'; ?>

            <main class="col">
                <div class="row">
                    <div class="columna col-lg-7">
                        <div class="widget">
                            <h3 class="titulo">Modificar Libro</h3>
                            <form id="agregar-libro-form" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">                                                            
                                <?php if(isset($libro)): ?>
                                    <div class="alert alert-warning text-center">
                                        <h4><strong><?php echo $libro['nombre']; ?></strong></h4>
                                    </div>	
                                    <input type="hidden" name="id" id="id" value="<?php echo $libro['id']; ?>">
                                    <input type="text" name="nombre" id="nombre" placeholder="Nombre:" value="<?php echo $libro['nombre']; ?>">
                                    <input type="text" name="autor" id="autor" placeholder="Autor:" value="<?php echo $libro['autor']; ?>">
                                    <input type="text" name="extracto" id="extracto" placeholder="Extracto:" value="<?php echo $libro['extracto']; ?>">
                                    <textarea name="descripcion" id="descripcion" placeholder="Descripción:"><?php echo $libro['descripcion']; ?></textarea>                    
                                    <hr>

                                    <label class="label">Cargar Portada: <input type="file" name="portada" id="portada" accept="image/jpeg, image/jpg, image/png"></label>
                                    <label class="label">Cargar Fondo: <input type="file" name="thumb" id="thumb" accept="image/jpeg, image/jpg, image/png"></label>
                                    <label class="label">Cargar Archivo: <input type="file" name="archivo" id="archivo" accept="application/pdf"></label>
                                    <input type="hidden" id="portada_guardada" name="portada_guardada" value="<?php echo $libro['portada']; ?>">
                                    <input type="hidden" id="thumb_guardado" name="thumb_guardado" value="<?php echo $libro['thumb']; ?>">
                                    <input type="hidden" id="archivo_guardado" name="archivo_guardado" value="<?php echo $libro['archivo']; ?>">
                                    <hr>       
                                    
                                    <?php if(isset($libro_categorias)): ?>   
                                        <div class="form-group">
                                            <label for="categorias1">Categoría 1:</label>
                                            <select name="categorias1" id="categorias1" class="custom-select">
                                                <option value="0" class="red-msn">N/A</option>
                                                <?php if(count($libro_categorias) > 0): ?>                           
                                                    <?php foreach($categorias as $categoria): ?>
                                                        <?php if($categoria['categoria'] === $libro_categorias[0]['categoria']): ?>
                                                            <option value="<?php echo $categoria['id'] ?>" selected><?php echo $categoria['categoria'] ?></option>                                         
                                                        <?php else: ?>
                                                            <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                                        <?php endif; ?>                      
                                                    <?php endforeach; ?>                                 
                                                <?php else: ?>                                
                                                    <?php foreach($categorias as $categoria): ?>
                                                        <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>                                
                                                    <?php endforeach; ?>                            
                                                <?php endif; ?>
                                            </select>                                    
                                        </div>                                                                 
                                        <div class="form-group">
                                            <label for="categorias2">Categoría 2:</label>
                                            <?php if(count($libro_categorias) > 0): ?>
                                                <select name="categorias2" id="categorias2" class="custom-select">
                                                    <option value="0" class="red-msn">N/A</option>                                                                       
                                                    <?php foreach($categorias as $categoria): ?>
                                                        <?php if($categoria['categoria'] === $libro_categorias[1]['categoria']): ?>
                                                            <option value="<?php echo $categoria['id'] ?>" selected><?php echo $categoria['categoria'] ?></option>                                         
                                                        <?php else: ?>
                                                            <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                                        <?php endif; ?>                      
                                                    <?php endforeach; ?>                                 
                                                                                
                                                    <?php foreach($categorias as $categoria): ?>
                                                        <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>                                
                                                    <?php endforeach; ?>                                          
                                                </select>  
                                            <?php else: ?>   
                                                <select name="categorias3" id="categorias3" class="custom-select" disabled>
                                                    <option value="0" class="red-msn">N/A</option>
                                                    <?php foreach($categorias as $categoria): ?>
                                                        <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                                    <?php endforeach; ?>
                                                </select> 
                                            <?php endif; ?>                              
                                        </div>
                                        <div class="form-group">
                                            <label for="categorias3">Categoría 3:</label>
                                            <?php if(count($libro_categorias) > 2): ?>
                                                <select name="categorias3" id="categorias3" class="custom-select">
                                                    <option value="0" class="red-msn">N/A</option>                                                                       
                                                    <?php foreach($categorias as $categoria): ?>
                                                        <?php if($categoria['categoria'] === $libro_categorias[2]['categoria']): ?>
                                                            <option value="<?php echo $categoria['id'] ?>" selected><?php echo $categoria['categoria'] ?></option>                                         
                                                        <?php else: ?>
                                                            <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                                        <?php endif; ?>                      
                                                    <?php endforeach; ?>                                 
                                                                                
                                                    <?php foreach($categorias as $categoria): ?>
                                                        <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>                                
                                                    <?php endforeach; ?>                                          
                                                </select>  
                                            <?php else: ?>   
                                                <select name="categorias3" id="categorias3" class="custom-select" disabled>
                                                    <option value="0" class="red-msn">N/A</option>
                                                    <?php foreach($categorias as $categoria): ?>
                                                        <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                                    <?php endforeach; ?>
                                                </select> 
                                            <?php endif; ?>    
                                        </div>
                                        <hr>
                                    <?php else: ?>
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
                                    <?php endif; ?>
                                    <?php if(!empty($errores)): ?>                        
                                        <div class="alert" style="background: #ba1a1a; color: white;">
                                            <b><?php echo $errores ?></b>
                                        </div>
                                    <?php elseif(!empty($success)): ?>
                                        <div class="alert alert-info">
                                            <b><?php echo $success ?></b>
                                        </div>
                                    <?php endif; ?>   	

                                    <div class="d-block d-sm-flex justify-content-center my-4">
                                        <button id="btnSubir" class="btn btn-primary py-2 px-4"><i class="fas fa-pen-nib"></i> <b>Modificar</b></button>
                                        <button id="btnCancelar" class="btn btn-secondary mx-0 ml-sm-2 my-2 my-sm-0 py-2 px-4"><i class="far fa-window-close"></i> <b>Cancelar</b></button>
                                    </div>
                                <?php else: ?>
                                    <input type="text" name="autocomplete" id="autocomplete" placeholder="Buscar libro:">
                                    <input type="text" name="nombre" id="nombre" placeholder="Nombre:" disabled>
                                    <input type="text" name="autor" id="autor" placeholder="Autor:" disabled>
                                    <input type="text" name="extracto" id="extracto" placeholder="Extracto:" disabled>
                                    <textarea name="descripcion" id="descripcion" placeholder="Descripción:" disabled></textarea>                    
                                    <hr>

                                    <label class="label">Cargar Portada: <input type="file" name="portada" id="portada" accept="image/jpeg, image/jpg, image/png" disabled></label>
                                    <label class="label">Cargar Fondo: <input type="file" name="thumb" id="thumb" accept="image/jpeg, image/jpg, image/png" disabled></label>
                                    <label class="label">Cargar Archivo: <input type="file" name="archivo" id="archivo" accept="application/pdf" disabled></label>
                                    <hr>                                

                                    <div class="form-group">
                                        <label for="categorias1">Categoría 1:</label>
                                        <select name="categorias1" id="categorias1" class="custom-select" disabled>
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

                                    <div class="d-block d-sm-flex justify-content-center my-4">
                                        <button id="btnSubir" class="btn btn-primary py-2 px-4" disabled><i class="fas fa-pen-nib"></i> <b>Modificar</b></button>
                                        <button id="btnCancelar" class="btn btn-secondary mx-0 ml-sm-2 my-2 my-sm-0 py-2 px-4" disabled><i class="far fa-window-close"></i> <b>Cancelar</b></button>
                                    </div>
                                <?php endif; ?>                        
                            </form>
                        </div>
                    </div>

                    <?php include 'views/estadisticas.php'; ?>
                </div>
            </main>
        </div> 
    </div>
    <script src="<?php echo $book_admin['dashboard']; ?>js/validation.js"></script>
    <script src="<?php echo $book_admin['dashboard']; ?>js/autocomplete.js"></script>
</body>
</html>