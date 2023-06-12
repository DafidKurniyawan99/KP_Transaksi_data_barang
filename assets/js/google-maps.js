function initMap() {
    // Latitude and Longitude
    var myLatLng = {lat: -7.2167268, lng: 109.8545443};

    var map = new google.maps.Map(document.getElementById('myMap'), {
        zoom: 20,
        center: myLatLng
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Batur, Banjarnegara - Jawa Tengah' // Title Location
    });
}
