var map;
var markers = [];

//Callback functions
var error = function (err, response, body) {
    console.log('ERROR [%s]', err);
};
var success = function (data) {
    console.log('Data [%s]', data);
};

scrollView = function ($elem) {
    return $elem.each(function () {
        $('html, body').animate({
            scrollTop: $elem.offset().top
        }, 1000);
    });
}

function initialize() {
    var mapProp = {
        center:new google.maps.LatLng(49.811680,15.447711),
        zoom:7,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };

    map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    google.maps.event.addListener(map, 'click', function(event) {
	    clearMap()
        twittie(event.latLng.lat(),event.latLng.lng());
        setUpPoints(event.latLng);
		scrollView($('.toScroll'));

    });
    getPreviousSearches();
}

function setUpPoints(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
    markers.push(marker);
}

function getPreviousSearches() {
    $("#history_cont").empty();
    $.ajax({
        url: "https://loctweet.apispark.net/v1/Searched_coordinates?$page=1&$size=20&$sort=published DESC",
        type: "GET",
        Accept: "application/json",
        cache: false,
        contentType: "application/json",
        cache: false,
		 dataType: "json",
        complete: function(responseTxt, statusTxt, xhr){
           // alert(JSON.stringify(responseTxt));
            var i;
            var that = $("#history_cont");
            that.html('<ul style="margin:auto;"></ul>');
            for(i = 0; i < responseTxt.responseJSON.length; i++) {
                that.find('ul').append('<li class="centered">' + responseTxt.responseJSON[i].latitude + "," + responseTxt.responseJSON[i].longtitude + "-" + responseTxt.responseJSON[i].location + '</li>');
            }
        }
    });
}
/**
 * Tweetie: A simple Twitter feed plugin
 * Author: Sonny T. <hi@sonnyt.com>, sonnyt.com
 */

   function twittie($latitude, $longitude) {
            var options = (arguments[0] instanceof Object) ? arguments[0] : {},
                callback = (typeof arguments[0] === 'function') ? arguments[0] : arguments[1];

            // Default settings
            var settings = $.extend({
                'latitude': $latitude,
                'longitude': $longitude,
                'max_results': 20,
                'apiPath': 'api/tweet.php',
                'loadingText': 'Loading...'
            }, options);

            // Set loading
            $('.MyTweets .tweets').html('<span>' + settings.loadingText + '</span>');
            var that = $('.MyTweets .tweets');
            $.getJSON(settings.apiPath, {
                lat: settings.latitude,
                long: settings.longitude,
                max_results: settings.max_results,
            }, function (twt) {                
                that.find('span').fadeOut('fast', function () {
                    //alert(JSON.stringify(twt.result.places, null, 2));
                    that.html('<ul></ul>');
                    var saved = false;
                    for (var i = 0; i < twt.result.places.length; i++) {
                        if(i<1 && !saved){
                            $.ajax({
                                url: "https://loctweet.apispark.net/v1/Searched_coordinates",
                                type: "POST",
                                Accept: "application/json",
                                cache: false,
                                contentType: "application/json",
                                dataType: "json",
                                data: JSON.stringify({
                                    "latitude": settings.latitude,
                                    "longtitude": settings.longitude,
                                    "location": twt.result.places[i].full_name,
                                    "published": Date.now().toString()
                                }),
                                success: function(response){
                                    saved = true;
                                    //alert(JSON.stringify(response));
                                },
                                error: function(response){
                                    saved = true;
                                    //alert(JSON.stringify(response));
                                }
                            });
                        }
                        if(twt.result.places[i].place_type != "admin")
                        that.find('ul').append('<li>' + twt.result.places[i].place_type + ": " + twt.result.places[i].full_name + '</li>');
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng(twt.result.places[i].centroid[1],twt.result.places[i].centroid[0]),
							map: map
						});
						markers.push(marker);
						console.log(markers);
                    }
                    getPreviousSearches();
                    if (typeof callback === 'function') {
                        callback();
                    }
                });
            });
        };

 function clearMap(){
 for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers=[];
 
 }

google.maps.event.addDomListener(window, 'load', initialize);
