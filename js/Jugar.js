var contAciertos=0;
var contErrores=0;
var listClaves = [];

$(document).ready(function(){

    inicializar();
    console.log(listClaves);
    jugar();
    
});

//Inicializa la lista de claves de las preguntas sobre el tema seleccionado
function inicializar(){
    var strClaves = $('#claves-preguntas').val();
    listClaves = strClaves.split("&");

    //Elimino el primer elemento que es un str vacio.
    listClaves.shift();
    console.log(listClaves);

}

//Elige una pregunta al azar y la muestra al usuario
function jugar(){
    console.log(listClaves);
    $('#resul').empty();
    if(listClaves.length>0){
        var num = getRandomArbitrary(0,listClaves.length);
        generarPregunta(listClaves[num]);
        listClaves.splice(num,1);
    }else{
        $('#juego').html("<h1>Ya no quedan preguntas!</h1>");
        $('#resul').html("<h3 style=\"color: green\">Numero de Aciertos: "+contAciertos+"</h3><h3 style=\"color: red\">Numero de Errores: "+contErrores+"</h3><input type=\"button\" value=\"Volver al inicio.\" onclick=\"javascript:location.href='../php/Layout.php'\">");
        almacenarRegistro();
    }
    
}

//Almacena en la Bd los aciertos y errores del usuario
function almacenarRegistro() {
    $.ajax({
        type: "GET",
        url: "../php/AlmacenarJuegoEnBd.php?nickname="+$('#nickname').val()+"&aciertos="+contAciertos+"&errores="+contErrores+"&tema="+$('#tema').text() ,
        cache: false,
        async: false,
        success: function (response) {
        }
    });
}

//Se ejecuta cuando el usuario decide terminar, aqunque queden preguntas disponibles.
function terminar(){
    if(confirm("¿Estas seguro de que deseas salir?")){
        $('#juego').html("<h1>Este es tu resultado!</h1>");
        $('#resul').html("<h3 style=\"color: green\">Numero de Aciertos: "+contAciertos+"</h3><h3 style=\"color: red\">Numero de Errores: "+contErrores+"</h3><input type=\"button\" value=\"Volver al inicio.\" onclick=\"javascript:location.href='../php/Layout.php'\">");
        almacenarRegistro();
    }
}


//Comprueba si la respuesta seleccionada por el usuario es la correcta
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
                $('#resul').html("<h3 style=\"color: green\">Respuesta Correcta!</h3><input type=\"button\" onclick=\"terminar()\" id=\"boton-volver\" value=\"Terminar\"><input type=\"button\" id=\"boton-siguiente\" value=\"Siguiente Pregunta\" onclick=\"jugar()\">");
                contAciertos += 1;
            }else{
                $('#resul').html("<h3 style=\"color: red\">Respuesta Incorrecta!</h3><input type=\"button\" onclick=\"terminar()\" id=\"boton-volver\" value=\"Terminar\"><input type=\"button\" id=\"boton-siguiente\" value=\"Siguiente Pregunta\" onclick=\"jugar()\">");
                contErrores += 1;
            }
        }
    });
}

//Genera la pregunta en funcion de la id que se le pasa como parametro.
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

// Retorna un número natural aleatorio entre min (incluido) y max (excluido)
function getRandomArbitrary(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
  }