$(document).ready(function(){
    var emailCorrecto = false;
    var passCorrecta = false;
    $('#dirCorreo').blur(function(){
        $.ajax({
            type: 'GET',
            url: '../php/ClientVerifyEnrollment.php?dirCorreo='+$('#dirCorreo').val(),
            async: false,
            cache: false,
            success: function(data){
                if(data === "SI"){
                    emailCorrecto = true;
                    comprobar(emailCorrecto, passCorrecta);
                     $('#correo-div').html('<h4 style="color: green">El email es VIP</h4>');
                }else{
                    emailCorrecto = false;
                    comprobar(emailCorrecto, passCorrecta);
                    $('#correo-div').html('<h4 style="color: red">El email no es VIP</h4>');
                }
            }
        });
    });
    
    $('#pass').blur(function(){
        $.ajax({
            type: 'GET',
            url: '../php/ClientVerifyPass.php?pass='+$('#pass').val(),
            async: false,
            cache: false,
            success: function(data){
                console.log(data);
                if(data.valueOf() == "VALIDA"){
                    passCorrecta = true;
                    comprobar(emailCorrecto, passCorrecta);
                     $('#pass-div').html('<h4 style="color: green">La contraseña es VALIDA</h4>');
                }else{
                    passCorrecta = false;
                    comprobar(emailCorrecto, passCorrecta);
                    $('#pass-div').html('<h4 style="color: red">La contraseña es INVALIDA</h4>');
                }
            }
        });
    });
    
});

function comprobar(email, pass){
        if(email && pass){
        $("#submit").prop('disabled', false);
    }else{
        $("#submit").prop('disabled', true);
    }
}