 
function calcRoute(startt, endd) {
    var start = startt;
    var end = endd;
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      }
    });
  } 

  function tambah_marker(mpeta,mjudul,mposisi,mikon,mdesk,mlink,bounce) {
    if (mikon=="") {mikon="http://www.google.com/mapfiles/marker.png"};
    var marker = new google.maps.Marker({
      map:mpeta,
      title:mjudul,
      icon: mikon,
      position: mposisi
    });

    if(bounce=='set'){
    marker.setAnimation(google.maps.Animation.BOUNCE);}
 
    var boxText = document.createElement("div");
    boxText.style.cssText = "-webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); -moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);-moz-border-radius: 5px;-webkit-border-radius: 5px; background:#eee; margin-top: 8px; padding: 10px; border-radius: 5px;";
    boxText.innerHTML = '<div style="text-shadow: 0px -1px 2px #A9A9A9; color: #000;font-family: Helvetica Neue, Helvetica, arial;font-size: 18px;font-weight: bold;text-align:center; padding:5px 0px;">'+mjudul+'</div><center>'+mposisi+'</center><br/>'+mdesk;

    var myOptions = {
       content: boxText
      ,disableAutoPan: false
      ,maxWidth: 0
      ,pixelOffset: new google.maps.Size(-140, 0)
      ,zIndex: null
      ,boxStyle: { 
         background: "url('http://google-maps-utility-library-v3.googlecode.com/svn/tags/infobox/1.1.5/examples/tipbox.gif') no-repeat"
       ,opacity: 1
        ,width: "280px"
       }
      ,closeBoxMargin: "10px 2px 2px 2px"
      ,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
      ,infoBoxClearance: new google.maps.Size(1, 1)
      ,isHidden: false
      ,pane: "floatPane"
      ,enableEventPropagation: false
    };

    google.maps.event.addListener(marker, "click", function (e) {
       
    ib.open(mpeta, marker);
    });

    var ib = new InfoBox(myOptions); 
  }


  function handleNoGeolocation(errorFlag) {
    if (errorFlag) {
      var content = 'Error: The Geolocation service failed.';
    } else {
      var content = 'Error: Your browser doesn\'t support geolocation.';
    }

    var options = {
      map: map,
      position: new google.maps.LatLng(60, 105),
      content: content
    };

    var infowindow = new google.maps.InfoWindow(options);
    map.setCenter(options.position);
  }

  function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
      // convert from degrees to radians
      $latFrom = deg2rad($latitudeFrom);
      $lonFrom = deg2rad($longitudeFrom);
      $latTo = deg2rad($latitudeTo);
      $lonTo = deg2rad($longitudeTo);

      $latDelta = $latTo - $latFrom;
      $lonDelta = $lonTo - $lonFrom;

      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      $result = ($angle * $earthRadius) / 1000;
      return $result;
  }
