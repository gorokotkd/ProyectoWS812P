function temaSeleccionado(){
        
    if($('#temas').val()==="ninguno"){
        $('#error').html('<h4 style="color: red">Selecciona un tema.</h4>');
    }else{
        window.location.href= 'IniciarJuego.php?tema='+$('#temas').val();
    }
    
}