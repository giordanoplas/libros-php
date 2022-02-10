(function() {
    $('#categorias1').change(function() {
        if($(this).val() > 0) {
            $('#categorias2').removeAttr('disabled');
        } else {
            $('#categorias2').prop("disabled", true);
            $('#categorias3').prop("disabled", true);

            $('#categorias2').val(0);
            $('#categorias3').val(0);
        }
    });

    $('#categorias2').change(function() {
        if($(this).val() > 0) {
            $('#categorias3').removeAttr('disabled');
        } else {
            $('#categorias3').prop("disabled", true);
            $('#categorias3').val(0);
        }
    });

    $('#btnCancelar').on('click', function(e) {
        e.preventDefault();
        window.location.href = 'modificar.php';
    });

    $('#btnActualizar').on('click', function(e) {
        e.preventDefault();

        setInterval(function(){
            $('#leidos_form').submit();
        }, 5000);
    });
}());

(function() {
    $('#btnSubir').click(function(e) {
        e.preventDefault();

        loc = window.location.pathname.substring(33);

        form = $('#agregar-libro-form');
        error = $('#error');
        success = $('#success');

        nombre = $('#nombre');
        autor = $('#autor');
        extracto = $('#extracto');
        descripcion = $('#descripcion');

        portada = $('#portada');
        thumb = $('#thumb');
        archivo = $('#archivo');        

        var allowedExtensionsImg = /(.jpg|.jpeg|.png)$/i;
        var allowedExtensionsFile = /(.pdf)$/i;        

        if(nombre.val().length < 1 || autor.val().length < 1 || extracto.val().length < 1 || descripcion.val().length < 1) {
            success.text('');
            success.addClass('d-none');
            success.removeClass('alert alert-success');
            error.removeClass('d-none');
            error.text("Por favor, llena todos los campos y carga todos los archivos");
            error.addClass('alert alert-danger');              
        } else if(nombre.val().length > 40 || autor.val().length > 40) {
            success.text('');
            success.addClass('d-none');
            success.removeClass('alert alert-success');
            error.removeClass('d-none');
            error.text("Nombre y Autor, no deben exceder los 40 caracteres");
            error.addClass('alert alert-danger');
        } else if(extracto.val().length > 250) {
            success.text('');
            success.addClass('d-none');
            success.removeClass('alert alert-success');
            error.removeClass('d-none');
            error.text("El extracto no debe exceder los 250 caracteres");
            error.addClass('alert alert-danger');
        } else if(descripcion.val().length > 600) {
            success.text('');
            success.addClass('d-none');
            success.removeClass('alert alert-success');
            error.removeClass('d-none');
            error.text("La descripción no debe exceder los 250 caracteres");
            error.addClass('alert alert-danger');
        } else if(portada.val().length < 1 || thumb.val().length < 1 || archivo.val().length < 1) {
            switch(loc) {
                case 'agregar.php':  
                    success.text('');
                    success.addClass('d-none');
                    success.removeClass('alert alert-success');
                    error.removeClass('d-none');
                    error.text("Por favor, llena todos los campos y carga todos los archivos");
                    error.addClass('alert alert-danger');                      
                    break;
                case 'modificar.php':
                    portada_guardada = $('#portada_guardada');
                    thumb_guardado = $('#thumb_guardado');
                    archivo_guardado = $('#archivo_guardado');

                    if(portada_guardada.val().length < 1 && portada.val().length < 1) {
                        success.text('');
                        success.addClass('d-none');
                        success.removeClass('alert alert-success');
                        error.removeClass('d-none');
                        error.text("Por favor, llena todos los campos y carga todos los archivos");
                        error.addClass('alert alert-danger');
                    } else {
                        error.text('');
                        error.addClass('d-none');
                        error.removeClass('alert alert-danger');
                        success.removeClass('d-none');
                        success.text('El libro fue agregado/modificado exitosamente.');
                        success.addClass('alert alert-success');

                        setInterval(function(){
                            form.submit();
                        }, 1000);
                    }
                    if(thumb_guardado.val().length < 1 && thumb.val().length < 1) {
                        success.text('');
                        success.addClass('d-none');
                        success.removeClass('alert alert-success');
                        error.removeClass('d-none');
                        error.text("Por favor, llena todos los campos y carga todos los archivos");
                        error.addClass('alert alert-danger');
                    } else {
                        error.text('');
                        error.addClass('d-none');
                        error.removeClass('alert alert-danger');
                        success.removeClass('d-none');
                        success.text('El libro fue agregado/modificado exitosamente.');
                        success.addClass('alert alert-success');

                        setInterval(function(){
                            form.submit();
                        }, 1000);
                    }
                    if(archivo_guardado.val().length < 1 && archivo.val().length < 1) {
                        success.text('');
                        success.addClass('d-none');
                        success.removeClass('alert alert-success');
                        error.removeClass('d-none');
                        error.text("Por favor, llena todos los campos y carga todos los archivos");
                        error.addClass('alert alert-danger');
                    } else {
                        error.text('');
                        error.addClass('d-none');
                        error.removeClass('alert alert-danger');
                        success.removeClass('d-none');
                        success.text('El libro fue agregado/modificado exitosamente.');
                        success.addClass('alert alert-success');

                        setInterval(function(){
                            form.submit();
                        }, 1000);
                    }

                    break;
                default: break;
            } 
        } else if(!allowedExtensionsImg.exec(portada.val()) || !allowedExtensionsImg.exec(thumb.val()) || !allowedExtensionsFile.exec(archivo.val())) {
            success.text('');
            success.addClass('d-none');
            success.removeClass('alert alert-success');
            error.removeClass('d-none');
            error.text("Solo es permitido subir .jpg, .jpeg, .png y .pdf");
            error.addClass('alert alert-danger');
        } else {
            error.text('');
            error.addClass('d-none');
            error.removeClass('alert alert-danger');
            success.removeClass('d-none');
            success.text('El libro fue agregado/modificado exitosamente.');
            success.addClass('alert alert-success');

            setInterval(function(){
                form.submit();
            }, 1000);
        }
    });
}());