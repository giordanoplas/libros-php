(function() {
    $("#leido").change(function(e) {
        e.preventDefault();
        if(this.checked) {
            $('#form-book').submit();
        }
    });
}());