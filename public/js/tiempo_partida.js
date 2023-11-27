function move() {
    var elem = document.getElementById("myBar");
    var width = 100; // Ancho inicial
    var duration = 30000; // Duración en milisegundos (5 segundos)
    var frameRate = 10; // Intervalo de actualización (ms)
    var frames = duration / frameRate;
    var step = width / frames;
    var i = 0;

    function frame() {
        if (i < frames) {
            i++;
            width -= step;
            elem.style.width = width + "%";
            var remainingTime = (frames - i) * frameRate / 1000;
        } else {
            clearInterval(id);
        }
    }
    var id = setInterval(frame, frameRate);
}

move();