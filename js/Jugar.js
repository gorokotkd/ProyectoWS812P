$(document).ready(function(){

    jugar();
    
});


function jugar(){
    var strClaves = $('#claves-preguntas').val();
    var listClaves = strClaves.split("&");
    //Elimino el primer elemento que es un str vacio.
    listClaves.shift();
    console.log(listClaves);

   /* while(listClaves.length>0){
        var num = getRandomArbitrary(0,listClaves.length);
        generarPregunta(num);
    }*/

    var num = getRandomArbitrary(0,listClaves.length);
    console.log(num);
    console.log(listClaves[num]);
    generarPregunta(listClaves[num]);
}

function generarPregunta(idPregunta){
    $.ajax({
        type: "GET",
        url: "../php/MostrarPregunta.php?id="+idPregunta,
        async: false,
        cache: false,
        success: function (response) {
            $('#juego').html(response);
        }
    });
}

// Retorna un número aleatorio entre min (incluido) y max (excluido)
function getRandomArbitrary(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
  }