<?php require 'views/header.php'; ?>

<body>
    <div class="container-fluid">
        <div class="row"> 
            <?php include 'views/barra_lateral.php'; ?>

            <main class="col">
                <div class="row">
                    <div class="columna col-lg-7">
                        <div class="widget">
                            <h3 class="titulo">Actualizar más leídos</h3>
                            <form id="leidos_form" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <button id="btnActualizar" class="btn-success btn-lg w-100" data-cantainer="body" data-placement="bottom" data-toggle="popover" title="Mensaje:" data-content="Los libros más leídos están siendo actualizados. En breve serás redirigido.">Actualizar</button>
                            </form>
                        </div>
                    </div>

                    <?php include 'views/estadisticas.php'; ?>
                </div>         
            </main>
        </div> 
    </div>
    <script>
        $(function(){
            $('[data-toggle="popover"]').popover();
        })
    </script>
    <script src="<?php echo $book_admin['dashboard']; ?>js/validation.js"></script>
</body>
</html>