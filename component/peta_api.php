<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-EiBwX-b-KOGPbWUIlXdRbvVl7WfN9vo&callback=initialize" type="text/javascript"></script>
		
		<!--<script type="text/javascript" src = "http://maps.googleapis.com/maps/api/js?sensor=false";></script>-->
		<!--<script type="text/javascript" src = "http://maps.googleapis.com/maps/api/js?v=3&sensor=false";></script>-->
		<!-- memanggil library geoxml3 untuk parsing data kml ke peta -->
		<!--<script type="text/javascript" src="http://geoxml3.googlecode.com/svn/branches/polys/geoxml3.js"></script> <!--alamat sudah expired-->
		<script type="text/javascript" src="component/geoxml3.js"></script>
		<!--<script type="text/javascript" defer="defer" src="../js/jquery-1.9.1.min.js"></script>-->
		<!--<script type="text/javascript" defer="defer" src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js' ></script>-->
	</head>

	<body onload="initialize">
		<center><h4><b>Peta Kota Semarang</b></h4>
			<!--<p>Kota Semarang merupakan ibu kota propinsi Jawa Tengah yang terdiri dari 16 kecamatan dan 177 kelurahan.
			Anda dapat melihat informasi setiap kelurahan dengan mengarahkan mouse dan memilih salah satu kelurahan pada peta berikut.
			</p>-->
		</center>
		<br>
		<center><div id="map_kanvas" style="height: 100%; width: 90%"></div></center>
	

		<script type="text/javascript">
		//var f=jQuery.noConflict(); 
		var geoXml="";
		var map;
		var infoWindow;

		function initialize(){
			//var jawa_barat = new google.maps.LatLng(-7.090911,107.668887);
			//var semarang_kel = new google.maps.LatLng(-6.966667,110.416667); //kota semarang
			var semarang_kel = new google.maps.LatLng(-7.037179337839661, 110.39773285388947);
			var petaoption = {
				zoom: 15,
				//center: jawa_barat,
				center: semarang_kel,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
	 
			map = new google.maps.Map(document.getElementById("map_kanvas"),petaoption);
			
			/* disini kita panggil function dari geoXML3 untuk memparsing file kml */
			geoXml = new geoXML3.parser({
				map: map,
				//zoom: true,
				//createMarker: addMyMarker,
				//createPolygon: addMyPolygon,
				//singleInfoWindow: true,
				//suppressInfoWindows: true
				//infoWindowOptions: addinfoWindow
			});


			/* LETAK FILE .kml */
			//geoXml.parse('jawa_barat.kml');
			geoXml.parse('component/semarang_kel.kml');

			/*function addinfoWindow(placemark){
				var infoWindow = geoXml.createinfoWindow(placemark);
				google.maps.event.addListener(infoWindow, 'click', function() {
				var semarang_kel = event.latLng;
				infoWindow.setContent("<b>"+placemark.name+"</b><br>"+placemark.description+"<br>"+event.latLng.lat() + ',' + event.latLng.lng());   
				infoWindow.setPosition(semarang_kel);
				infoWindow.open(map);
				});
			};*/
			
				/*function addMyMarker(placemark) {
			        var marker = geoXml.createMarker(placemark);
			            //marker.setAnimation(google.maps.Animation.BOUNCE);
			            google.maps.event.addListener(marker, 'click', function() {
			                infoWindow.setContent(placemark.description);   
			                infoWindow.setPosition(marker.getPosition());
			                infoWindow.open(map,marker);
			            });
		        };*/


		        /*function addMyPolygon(placemark) {
				    var polygon = geoXml.createPolygon(placemark);
				    google.maps.event.addListener(polygon, 'click', function(event) {
				       	 	//var lat = parseFloat(document.getElementById('markerLat').value);
    						//var lng = parseFloat(document.getElementById('markerLng').value);
    						//var LatLng = new google.maps.latLng(lat, lng);
    						//marker.setPosition(latLng);
				        var semarang_kel = event.latLng;
				        infoWindow.setContent("<b>"+placemark.name+"</b><br>"+"<b>"+placemark.description+"</b><br>"+event.latLng.lat() + ',' + event.latLng.lng());   
				        infoWindow.setPosition(semarang_kel);
				        infoWindow.open(map);
				    });
				    return polygon;
				};*/

		    //};
		    //google.maps.event.addDomListener(window, 'load', initialize);


			/*google.maps.event.addListener(peta,'click',function(event){
				kasihtanda(event.latLng);
			});*/
			
			//geoXml.setMap(map);
			//geoXml.addListener('click', showArrays);
			//infoWindow = new google.maps.infoWindow;

			/* VERSI LAIN */
			//var myParser = new geoXML3.parser({map: map});
			//myParser.parse('jawa_barat.kml');

		
		/** @this {google.maps.Polygon}
	      function showArrays(event) {
	        // Since this polygon has only one path, we can call getPath() to return the
	        // MVCArray of LatLngs.
	        var vertices = this.getPath();

	        var contentString = '<b>Bermuda Triangle polygon</b><br>' +
	            'Clicked location: <br>' + event.latLng.lat() + ',' + event.latLng.lng() +
	            '<br>';

	        // Iterate over the vertices.
	        for (var i =0; i < vertices.getLength(); i++) {
	          var xy = vertices.getAt(i);
	          contentString += '<br>' + 'Coordinate ' + i + ':<br>' + xy.lat() + ',' +
	              xy.lng();
	        }

	        // Replace the info window's content and position.
	        infoWindow.setContent(contentString);
	        infoWindow.setPosition(event.latLng);

	        infoWindow.open(peta);
	      }*/
	  	};

		</script>
	</body>
</html>