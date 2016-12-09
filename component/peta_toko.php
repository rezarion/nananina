
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">

<script type="text/javascript" src="js1/markerclusterer_packed.js"></script>
<script type="text/javascript" src="js1/jquery.js"></script>
<!--<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js' type='text/javascript'></script>-->
<!-- load googlemaps api dulu -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-EiBwX-b-KOGPbWUIlXdRbvVl7WfN9vo&callback=peta_awal" type="text/javascript"></script>-->

<script type="text/javascript">
var peta;
//var gambar_tanda;
//gambar_tanda = '../img/marker_toko.png';
var x = new Array();
var y = new Array();
var nama_toko = new Array();

function peta_awal(){
	// posisi default peta saat diload
	
	var lokasibaru = new google.maps.LatLng(-6.966667,110.416667);
	var petaoption = {
		zoom: 13,
		center: lokasibaru,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	peta = new google.maps.Map(document.getElementById("map_canvas"),petaoption);
	// memanggil function ambilpeta() untuk menampilkan koordinat
	ambilpeta();
}

function ambilpeta(){
    url = "component/json_toko.php";
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
			 var markers = [];
			 var info = [];
			 //$i = 0;
			 
            for(i=0;i<msg.penempatantoko.lokasi_toko.length;i++){
				x[i] = msg.penempatantoko.lokasi_toko[i].x;
				y[i] = msg.penempatantoko.lokasi_toko[i].y;
				nama_toko[i] = msg.penempatantoko.lokasi_toko[i].nama_toko;
               
                //set koordinat marker
                var point = new google.maps.LatLng(parseFloat(msg.penempatantoko.lokasi_toko[i].x),parseFloat(msg.penempatantoko.lokasi_toko[i].y));
        		
				//masukin info marker
               	var contentString = "<table>"+
                					"<tr>"+"<td>"+String(msg.penempatantoko.lokasi_toko[i].nama_toko)+"</td>"+"</tr>"
                					"</table>";
               // var contentString = String(msg.penempatantoko.lokasi_toko[i].nama_toko);
                
                var infowindow = new google.maps.InfoWindow({
                        //content: parseFloat(msg.penempatantoko.lokasi_toko[i].nama_toko);
                    	//content : msg.penempatantoko.lokasi_toko[i].nama_toko
                    	content : contentString
                });
                
                //var infowindow = new google.maps.InfoWindow(String(msg.penempatantoko.lokasi_toko[i].nama_toko));
				
				tanda = new google.maps.Marker({
						position: point,
						map: peta,
						//icon: gambar_tanda,
						clickable: true
				});
				
				markers.push(tanda); 	//keluarkan marker
              	info.push(infowindow);  //keluarkan info
              	
              	//fungsi menampilkan info kalo diklik
              	/*google.maps.event.addListener(tanda, "click", function() {
		  			infowindow.open(peta,tanda);
				});*/
				
				/*tanda.addListener('click', function() {
		  			infowindow.open(peta, tanda);
				});*/
				
				(function(tanda, contentString) {

  					// Attaching a click event to the current marker
					google.maps.event.addListener(tanda, "click", function(e) {
    					infowindow.setContent(contentString);
					    infowindow.open(peta, tanda);
  					});

				})(tanda, contentString);
				
			}
			//membuat marker cluster	
			var markerCluster = new MarkerClusterer(peta, markers,
			{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'}
			);
        }
    });
}
</script> 
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-EiBwX-b-KOGPbWUIlXdRbvVl7WfN9vo&callback=peta_awal" type="text/javascript"></script>

<body onload="peta_awal()">

	<center>
		<h4><b>Peta Lokasi Toko Modern Semarang</b></h4>
		<!--<p>Kota Semarang merupakan ibu kota propinsi Jawa Tengah yang terdiri dari 16 kecamatan dan 177 kelurahan.
		Anda dapat melihat informasi setiap kelurahan dengan mengarahkan mouse dan memilih salah satu kelurahan pada peta berikut.
		</p>-->
	</center>
		<br>
		
	<div id="map_canvas" style="height:500px"></div>
	<!--<div id="map_canvas" style="width:100%; height:100%; position:absolute;"></div>-->


</body>