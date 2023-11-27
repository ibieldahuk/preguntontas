let timer = 15;
let mostrarTiempo = document.getElementById("time");
let tiempoRegresivoId = null;

contarTiempo();

function contarTiempo(){
    tiempoRegresivoId = setInterval(()=>{
        timer--;
        if(timer < 10){
            mostrarTiempo.innerHTML = `00:0${timer}`;
        }else{
            mostrarTiempo.innerHTML = `00:${timer}`;
        }
        if(timer == 0){
            clearInterval(tiempoRegresivoId);
        }
    }, 1000);
}

