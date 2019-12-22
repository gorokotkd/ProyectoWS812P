function inicioSesion(img,email,tipo){
    console.log(tipo);
    if(tipo=="user"){
        $('#id-question').show();
        $('#questions').show();
    }else{
        $('#users').show();
    }
       
    $('#register').hide();
    $('#login').hide();
    $('#logout').show();
    
    
    
    $("#h1").append("<p>"+email+"</p>");
    $("#h1").append("<img width=\"50\" height=\"60\" src=\"data:image/*;base64,"+img+"\"alt=\"Imagen\"/>");
}