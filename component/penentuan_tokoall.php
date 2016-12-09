
<script type="text/javascript" src = "http://maps.googleapis.com/maps/api/js?sensor=true";></script>
<!--<script type="text/javascript" src = "http://maps.googleapis.com/maps/api/js?v=3sensor=true";></script>-->
<script type="text/javascript" src = "js2/index.js";></script>

<div class="widget">
	<h4 class="widgettitle">Penempatan Toko Modern</h4>
	<div class="widgetcontent">

		<legend>Silakan Masukkan Kriteria Anda</legend>
        <p>
			<label>Bagaimana kami mengetahui lokasi Anda ?</label>
		</p>
			
		<form class="stdform" action="main.php?menu=hasilHitungall" method="post" enctype="multipart/form-data">
			<?php
				if(ISSET($_SESSION['success'])){
					echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
					unset($_SESSION['success']);
				}else if(ISSET($_SESSION['error'])){
					echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
					unset($_SESSION['error']);
				}
			?>			
		
		<p>
		<div class="input-control password" data-role="input-control">
            <div class="input-control">
                <a class="btn btn-warning btn-rounded" id="" href="#"><i class="icon-map-marker"></i> Lokasi Anda Saat Ini</a>
				<input type="text" name="latitude" id="latitude" class="input-large" style= 'margin-left:0.1%;!important' maxlength="50" readonly>
                <input type="text" name="longitude" id="longitude" class="input-large" style= 'margin-left:0.1%;!important' maxlength="50" readonly>
				<br/>
                
                <!--<div id="carousel-example-generic">-->
				<a class="btn btn-danger btn-rounded" id="" href="#"><i class="icon-pencil"></i> Masukkan Manual</a>
                <input type="text" name="lokasi" id='lokasi' value='' class="input-large" style= 'margin-left:1%;!important' maxlength="50" placeholder="Masukkan Koordinat Lokasi">
                    contoh = -7.0520829, 110.4399777
                <!--</div>-->
				
			</div>
		</div>
		</p>
		
		<p>
				<label>Keberadaan Sarana</label>
				<span class="field">
				<div class="input-control text" data-role="input-control" id="keberadaan">
					<input type="text"  name="keberadaan" id="val_keberadaan" class="input-medium" style= 'margin-left:1%;!important' onkeypress="return numbersonly(event, false)" maxlength="20" readonly required/>
					<span class="label" id="ket_keberadaan"></span>
				</div>
				</span>
		</p>

		<p>
				<label>Kepadatan Penduduk</label>
				<span class="field">
				<div class="input-control text" data-role="input-control" id="kepadatan">
					<input type="text"  name="kepadatan" id="val_kepadatan" class="input-medium" style= 'margin-left:1%;!important' onkeypress="return numbersonly(event, false)" maxlength="20" readonly required/>
					<span class="label" id="ket_kepadatan"></span>
				</div>
				</span>
		</p>
			
		<p>
				<label>Perkembangan Pemukiman Baru</label>
				<span class="field">
				<div class="input-control text" data-role="input-control" id="perkembangan">
					<input type="text"  name="perkembangan" id="val_perkembangan" class="input-medium" style= 'margin-left:1%;!important' onkeypress="return numbersonly(event, false)" maxlength="20" readonly required/>
					<span class="label" id="ket_perkembangan"></span>
				</div>
				</span>
		</p>
				
		<p>	
				<label>Arus Lalu Lintas</label>
				<span class="field">
				<div class="input-control text" data-role="input-control" id="arus">
					<input type="text"  name="arus" id="val_arus" class="input-medium" style= 'margin-left:1%;!important' onkeypress="return numbersonly(event, false)" maxlength="20" readonly required/>
					<span class="label" id="ket_arus"></span>
				</div>
		</p>			
			
		<p>	
				<label>Potensi Ekonomi</label>
				<span class="field">
				<div class="input-control text" data-role="input-control" id="potensi">
					<input type="text"  name="potensi" id="val_potensi" class="input-medium" style= 'margin-left:1%;!important' onkeypress="return numbersonly(event, false)" maxlength="20" readonly required/>
					<span class="label" id="ket_potensi"></span>
				</div>
				</span>
		</p>	
			
		<!--<p>	
				<label>Jarak</label>
				<span class="field">
				<div class="input-control text" data-role="input-control" id="jarak">
					<input type="text"  name="jarak" id="val_jarak" class="input-medium" style= 'margin-left:1%;!important' onkeypress="return numbersonly(event, false)" maxlength="20" required/>
					<span class="label" id="ket_jarak"></span>
				</div>
				</span>
		</p>-->	
			
			<p class="stdformbutton">
				<button class="btn btn-primary" id="submit-button" type="submit">Submit</button>
				<button class="btn" type="reset">Reset</button>
			</p>

		</form>
	</div>
</div>

<script>
	$('#lokasi').blur(function(){
		$.post("component/autofill_kelurahan.php",{koordinat: $("#lokasi").val()},
			function(data,status){
				a= JSON.parse(data);
				$("#val_keberadaan").val(a.ambil_keberadaan);
				$("#val_kepadatan").val(a.ambil_kepadatan);
				$("#val_perkembangan").val(a.ambil_perkembangan);
				$("#val_potensi").val(a.ambil_potensi);
				$("#val_arus").val(a.ambil_arus);
				console.log(a);
			}
		)
	})
	/*$( document ).ready(function() {
	    $("#lokasi").val($("#latitude").val()+','+$("#latitude").val());
		$("#lokasi").trigger('blur');
	});*/

	// $('body').on('click','#submit-button',function (e) {
	// 	// var lok = parseFloat(document.getElementById('lokasi').value);
	// 	console.log($('#lokasi').val());

	//     // console.log(lok);
	//     e.preventDefault();
	// });

	// function myPos() {
	    //var lok = parseFloat(document.getElementById('lokasi').value);
	    // console.log(string($('#lokasi').val()));
	    // preventDefault();
	    // var newLatLng = new google.maps.LatLng(lok);
	    // marker.setPosition(newLatLng)
	// }

	// function initialize() {
	// 	<?php 	
	// 	   	//echo "var latlng = new google.maps.LatLng(-6.989772,110.422229);"; //simpang lima
	// 	   	//echo "var latlng = new google.maps.LatLng(-6.966667,110.416667);"; //kota semarang
	// 		//extract($_POST, EXTR_SKIP);
	// 		//echo "var lat = parseFloat(document.getElementById('latitude').value);";
	// 		//echo "var lng = parseFloat(document.getElementById('longitude').value);";
	// 		//echo "var newLatLng = new google.maps.LatLng(lat, lng);";
	// 	?>

	// 	var latlng = new google.maps.LatLng(-6.989772,110.422229);

	// 	var myOptions = {
	// 		zoom : 10,
	// 		center : latlng,
	// 		//radius: 1,
 //    		//color: '#FFFF99',
	// 		mapTypeId: google.maps.MapTypeId.ROADMAP //bisa HYBRID atau lainnya
	// 	};

	// 	var map = new google.maps.Map(document.getElementById("kanvas_peta"),myOptions);

 //        //map.setCenter(newLatLng);
		
	// 	marker = new google.maps.Marker({
	// 	 	position: newLatLng,
	// 	 	map: map,
	// 	 	draggable: false
	// 	});
	// }
	
</script>

<!--coba -7.084578903734799,110.343589570984037-->