$(document).ready(function(){   
    setInterval(verNumeroPreguntas,5000);
});


function  verNumeroPreguntas(){
    var cont = 0;
    var contEmail = 0;
    var email = $('#dirCorreo').val();
    $.ajax({
        type: "GET",
        url:"../xml/Questions.xml",
        dataType: "xml",
        async: false,
        cache: false,
        success: function(xml){
            $(xml).find("assessmentItem").each(function(){
            emailXml = $(this).attr('author');
            if(email.valueOf()==emailXml.valueOf()){
                contEmail += 1;
            }
                cont += 1;
        });
            $('#contador-preguntas').empty();
            $('#contador-preguntas').append("<a>"+contEmail+"</a> / <a>"+cont+"</a>");
    }
        
    });   
}




