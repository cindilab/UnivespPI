function initMap() {
    // Latitude and Longitude
    var myLatLng = {lat: -22.326831741627544, lng: -49.06085953675373};

    var map = new google.maps.Map(document.getElementById('google-maps'), {
        zoom: 17,
        center: myLatLng
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Polo UNIVESP Bauru' // Title Location
    });
}