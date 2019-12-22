lat=0.0;
lng=0.0;
function initialize() {
    // Posicionamiento de la Facultad de Informática
    var latlng = new google.maps.LatLng(lat, lng);
    var myOptions = {
        zoom: 2,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.SATELLITE
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    var marker = new google.maps.Marker({
        position: map.getCenter(),
        map: map,
        title: 'Haz click aquí para hacer Zoom'
    });

    google.maps.event.addListener(marker, 'click', function() {
        if (map.getZoom() == 2)
            map.setZoom(20);
        else
            map.setZoom(2);
    });

    google.maps.event.addListener(map, 'click', function(e) {
        alert('Latitud: ' + e.latLng.lat() + '\nLongitud: ' + e.latLng.lng());
    });
}

$(document).ready(function(){
    $.ajax({
        type: 'GET',
        url: '../php/ClientGetUserLocation.php',
        dataType:'json',
        async: false,
        cache: false,
        success: function(data){
            lat = data.geoplugin_latitude;
            lng = data.geoplugin_longitude;
            $("#location-info").html("<table border = \1\" style=\"margin-right:auto; margin-left:auto\"><tr><th>Ciudad: </th><td>"+data.geoplugin_city+"</td></tr><tr><th>Region: </th><td>"+data.geoplugin_regionName+"</td></tr><tr><th>Pais: </th><td>"+data.geoplugin_countryName+"</td></tr></table>");
            
        }
    });
    
     $.ajax({
        type: 'GET',
        url: '../php/ClientLocationWeather.php?lat='+lat+'&lon='+lng,
        dataType:'json',
        async: false,
        cache: false,
        success: function(data){
            $("#weather-info").html("<table border = \1\" style=\"margin-right:auto; margin-left:auto\"><tr><th>Estado del cielo: </th><td>"+data.list[0].weather[0].main+"</td></tr><tr><th>Descripcion: </th><td>"+data.list[0].weather[0].description+"</td></tr><tr><th>Temperatura: </th><td>"+data.list[0].main.temp+"ºC</td></tr></table>");
            
        }
    });
    initialize();
});