function verPreguntas(){
    clean();
    $.ajax({
        url: '../php/ShowXmlQuestions.php',
        beforeSend:function(){$('#content').html('<div><img src="../images/loading.gif"/></div>')},
        success:function(datos){
           $('#tabla-preguntas').append(datos);
        },
        error:function(){
            $('#tabla-preguntas').fadeIn().html('<p class="error"><strong>El servidor parece que no responde</p>');
        }
    });
}
