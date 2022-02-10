(function() {

    var i = 0;
    var images = [];
    var time = 3000;
    //var flechaIzquierda = document.getElementById("flecha_izquierda");
    //var flechaDerecha = document.getElementById("flecha_derecha");
    var slide = document.getElementById("slide");

    images[0] = "img/1.jpg";
    images[1] = "img/2.jpg";
    images[2] = "img/3.jpg";
    images[3] = "img/4.jpg";

    // flechaIzquierda.onclick = changeImg("Iz");
    // flechaDerecha.onclick = changeImg("Der");

    function changeImg(IzDer) {
        if(IzDer === "Der") {
            i++;
            slide.src = images[i];        
        } else if(IzDer === "Iz") {
            i = (i > 0) ? (i - 1) : 0;
            slide.src = images[i];        
        } else {
            i = 0;
            slide.src = images[i];                
        }

        if(i == images.length - 1) {
            //Poner la clase para ocultar la flecha de la derecha
            document.getElementById("derecha").classList.add("hidden");
        } else {
            document.getElementById("derecha").classList.remove("hidden");
        }

        if(i == 0) {
            //Poner la clase para ocultar la flecha de la derecha
            document.getElementById("izquierda").classList.add("hidden");
        } else {
            document.getElementById("izquierda").classList.remove("hidden");
        }

        //setTimeout("changeImg()", time);
    }
    slide.src = images[i];

}())
