$(document).ready(function () {
    mostrarTopTen();
});

function mostrarTopTen(){
    $.ajax({
        type: "GET",
        url: "../php/MostrarTopTen.php",
        async: false,
        cache: false,
        success: function (response) {
            $('#tabla-quizers').html(response);
        }
    });
}