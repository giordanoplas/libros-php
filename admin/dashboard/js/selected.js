(function(){
    page = $('#current_page').val();
    switch(page) {
        case 'index.php':
            $('#menu1').toggleClass('selected');
            break;
        case 'agregar.php':
            $('#menu2').toggleClass('selected');
            break;
        case 'modificar.php':
            $('#menu3').toggleClass('selected');
            break;
        case 'leidos.php':
            $('#menu4').toggleClass('selected');
            break;
        default:
            break;
    }
}());