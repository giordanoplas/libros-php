$(function() { 
    function selectedData(id) {
        window.location.href = 'modificar.php?id=' + id;
    }

    $( "#autocomplete" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "libros_json.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                    //response( data );
                    response($.map(data, function (dat) {
                        return {
                            label: dat.nombre,
                            value: dat.id
                        };
                    }));
                }
            });
        },
        focus: function (event, ui) {
            $('#autocomplete').val(ui.item.label);
            event.preventDefault();
            return false;
        },
        select: function (event, ui) {
            $('#autocomplete').val(ui.item.label);
            selectedData(ui.item.value);            
            event.preventDefault();
            return false;
        },
        click: function (event, ui) {
            $('#autocomplete').val(ui.item.label);
            selectedData(ui.item.value);            
            event.preventDefault();
            return false;
        }
    });

}());