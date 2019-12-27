$(document).ready(function () {
    
    

    $('#pass').blur(function(){
        console.log("algo");
        console.log($('#pass').val());
        $.ajax({
            type: 'GET',
            url: '../php/ClientVerifyPass.php?pass='+$('#pass').val(),
            async: false,
            cache: false,
            success: function(data){
                console.log(data);
                if(data.valueOf() == "VALIDA"){
                    $('#pass-div').html('<h4 style="color: green">La contraseña es VALIDA</h4>');
                }else{
                    $('#pass-div').html('<h4 style="color: red">La contraseña es INVALIDA</h4>');
                }
            }
        });
    });

    $('#pass2').blur(function(){
        if($('#pass').val()!=$('#pass2').val()){
            $('#pass2-div').html('<h4 style="color: red">Las contraseñas no coinciden.</h4>');
        }else{
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