function inicioSesion(img,email,tipo,google){
    if(tipo=="user"){
        $('#id-question').show();
        $('#questions').show();
        $('#jugar').show();
    }else{
        $('#users').show();
    }
       
    $('#register').hide();
    $('#login').hide();
    $('#login-google').remove();
    $('#logout').show();

    
    
    
    $("#h1").append("<p>"+email+"</p>");
    if(!google){
        $("#h1").append("<img width=\"50\" height=\"60\" src=\"data:image/*;base64,"+img+"\"alt=\"Imagen\"/>");
    }else{
        $("#h1").append("<img width=\"50\" height=\"50\" src=\""+img+"\"alt=\"Imagen\"/>");
    }
    
}