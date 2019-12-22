$(document).ready(function(){   
    setInterval(cuantosConectados,5000);
});

function cuantosConectados(){
    $.ajax({
        type: "GET",
        url:"../xml/Counter.xml",
        dataType: "xml",
        async: false,
        cache: false,
        success: function(xml){
            var numUsus = 0;
            numUsus = $(xml).find("user").text();        
            $('#usuariosTotales').text(numUsus);    
        } 
    });
}