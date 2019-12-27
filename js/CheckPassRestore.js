$(document).ready(function () {
    
    var passValida = false;
    var passCoinciden = false;

    $('#pass').blur(function(){
        $.ajax({
            type: 'GET',
            url: '../php/ClientVerifyPass.php?pass='+$('#pass').val(),
            async: false,
            cache: false,
            success: function(data){

                if(data.valueOf() == "VALIDA"){
                    passValida = true;
                    comprobar(passValida,passCoinciden);
                    $('#pass-div').html('<h4 style="color: green">La contraseña es VALIDA</h4>');
                }else{
                    passValida = false;
                    comprobar(passValida,passCoinciden);
                    $('#pass-div').html('<h4 style="color: red">La contraseña es INVALIDA</h4>');
                }
            }
        });
    });

    $('#pass2').blur(function(){
        if($('#pass').val()!=$('#pass2').val()){
            passCoinciden = false;
            comprobar(passValida,passCoinciden);
            $('#pass2-div').html('<h4 style="color: red">Las contraseñas no coinciden.</h4>');
        }else{
            passCoinciden = true;
            comprobar(passValida,passCoinciden);
            $('#pass2-div').empty();
        }
    });

    $('#enviar').click(function(e){
        e.preventDefault();
        var frm = $('#form');
        var datos = frm.serialize();

        $.ajax({
            type: 'POST',
            url: '../php/ModifyPassInBd.php',
            async: false,
            cache: false,
            data: datos,
            success: function(data){
                $('#resul').html(data);
            }
        });
    });

});

function comprobar(valida, coinciden){
    if(valida && coinciden){
    $("#enviar").prop('disabled', false);
}else{
    $("#enviar").prop('disabled', true);
}
}
