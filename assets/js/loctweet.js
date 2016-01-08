var map;
var marker;

//Callback functions
var error = function (err, response, body) {
    console.log('ERROR [%s]', err);
};
var success = function (data) {
    console.log('Data [%s]', data);
};




function initialize() {
    var mapProp = {
        center:new google.maps.LatLng(49.811680,15.447711),
        zoom:7,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
    });
}


function placeMarker(location) {
    if (marker) {
        marker.setMap(null);
    }
    marker = new google.maps.Marker({
        position: location,
        map: map,
    });


}


google.maps.event.addDomListener(window, 'load', initialize);