var contAciertos=0;
var contErrores=0;
var listClaves = [];

$(document).ready(function(){

    inicializar();
    console.log(listClaves);
    jugar();
    
});

function inicializar(){
    var strClaves = $('#claves-preguntas').val();
    listClaves = strClaves.split("&");

    //Elimino el primer elemento que es un str vacio.
    listClaves.shift();
    console.log(listClaves);

}

function jugar(){
    console.log(listClaves);
    $('#resul').empty();
    if(listClaves.length>0){
        var num = getRandomArbitrary(0,listClaves.length);
        generarPregunta(listClaves[num]);
        listClaves.shift();
    }else{
        $('#juego').html("<h1>Ya no quedan preguntas!</h1>");
        $('#resul').html("<h3 style=\"color: green\">Numero de Aciertos: "+contAciertos+"</h3><h3 style=\"color: red\">Numero de Errores: "+contErrores+"</h3>");
    }
    
}

function comprobar(idPregunta){
    $('#resul').empty();
    var respuesta = $("input[type='radio'][name='respuesta']:checked").val();
    $.ajax({
        type: "GET",
        url: "../php/ComprobarRespuesta.php?id="+idPregunta+"&respuesta="+respuesta,
        async: false,
        cache: false,
        success: function (response) {
            $('#submit').prop('disabled', true);
            if(response==="true"){
                $('#resul').html("<h3 style=\"color: green\">Respuesta Correcta!</h3><input type=\"button\" id=\"boton-volver\" value=\"Terminar\"><input type=\"button\" id=\"boton-siguiente\" value=\"Siguiente Pregunta\" onclick=\"jugar()\">");
                contAciertos += 1;
            }else{
                $('#resul').html("<h3 style=\"color: red\">Respuesta Incorrecta!</h3><input type=\"button\" id=\"boton-volver\" value=\"Terminar\"><input type=\"button\" id=\"boton-siguiente\" value=\"Siguiente Pregunta\" onclick=\"jugar()\">");
                contErrores += 1;
            }
        }
    });
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