    $(function(){

        // HTML5 Geolocation
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = new google.maps.LatLng(position.coords.latitude,
                                               position.coords.longitude);

                // masukkan posisi latitude pada input id latitude
                $("#latitude").val(position.coords.latitude);
                // masukkan posisi longitude pada input id longitude
                $("#longitude").val(position.coords.longitude);

                
            }, function() {
                handleNoGeolocation(true);
            });
        } 
        else {
          // Browser doesn't support Geolocation
          handleNoGeolocation(false);
        }

        $("#kepadatan").on("changed", function(e, val){
            $("#val_kepadatan").val(val);
            if (val <= 50) {
                $("#ket_kepadatan").html('Prioritas Sangat Rendah');
                $("#ket_kepadatan").removeClass();
                $("#ket_kepadatan").addClass('label default');
            }
            else if (val >=51 && val <= 65 ) {
                $("#ket_kepadatan").html('Prioritas Rendah');
                $("#ket_kepadatan").removeClass();
                $("#ket_kepadatan").addClass('label info');
            }
            else if (val >=66 && val <= 80 ) {
                $("#ket_kepadatan").html('Prioritas Cukup');
                $("#ket_kepadatan").removeClass();
                $("#ket_kepadatan").addClass('label success');
            }
            else if (val >=81 && val <= 90 ) {
                $("#ket_kepadatan").html('Prioritas Tinggi');
                $("#ket_kepadatan").removeClass();
                $("#ket_kepadatan").addClass('label warning');
            }
            else if (val >=91 && val <= 100 ) {
                $("#ket_kepadatan").html('Prioritas Sangat Tinggi');
                $("#ket_kepadatan").removeClass();
                $("#ket_kepadatan").addClass('label alert');
            }

        });
        $("#perkembangan").on("changed", function(e, val){
            $("#val_perkembangan").val(val);
            if (val <= 40) {
                $("#ket_perkembangan").html('Prioritas Sangat Rendah');
                $("#ket_perkembangan").removeClass();
                $("#ket_perkembangan").addClass('label default');
            }
            else if (val >=41 && val <= 60 ) {
                $("#ket_perkembangan").html('Prioritas Rendah');
                $("#ket_perkembangan").removeClass();
                $("#ket_perkembangan").addClass('label info');
            }
            else if (val >=61 && val <= 80 ) {
                $("#ket_perkembangan").html('Prioritas Cukup');
                $("#ket_perkembangan").removeClass();
                $("#ket_perkembangan").addClass('label success');
            }
            else if (val >=81 && val <= 90 ) {
                $("#ket_perkembangan").html('Prioritas Tinggi');
                $("#ket_perkembangan").removeClass();
                $("#ket_perkembangan").addClass('label warning');
            }
            else if (val >=91 && val <= 100 ) {
                $("#ket_perkembangan").html('Prioritas Sangat Tinggi');
                $("#ket_perkembangan").removeClass();
                $("#ket_perkembangan").addClass('label alert');
            }
        });
        $("#potensi").on("changed", function(e, val){
            $("#val_potensi").val(val);
            if (val <= 40) {
                $("#ket_potensi").html('Prioritas Sangat Rendah');
                $("#ket_potensi").removeClass();
                $("#ket_potensi").addClass('label default');
            }
            else if (val >=41 && val <= 60 ) {
                $("#ket_potensi").html('Prioritas Rendah');
                $("#ket_potensi").removeClass();
                $("#ket_potensi").addClass('label info');
            }
            else if (val >=61 && val <= 80 ) {
                $("#ket_potensi").html('Prioritas Cukup');
                $("#ket_potensi").removeClass();
                $("#ket_potensi").addClass('label success');
            }
            else if (val >=81 && val <= 90 ) {
                $("#ket_potensi").html('Prioritas Tinggi');
                $("#ket_potensi").removeClass();
                $("#ket_potensi").addClass('label warning');
            }
            else if (val >=91 && val <= 100 ) {
                $("#ket_potensi").html('Prioritas Sangat Tinggi');
                $("#ket_potensi").removeClass();
                $("#ket_potensi").addClass('label alert');
            }
        });

        $("#jarak").on("changed", function(e, val){
            $("#val_jarak").val(val);
            if (val <= 3) {
                $("#ket_jarak").html('Prioritas Tinggi');
                $("#ket_jarak").removeClass();
                $("#ket_jarak").addClass('label default');
            }
            else if (val >=4 && val <= 6 ) {
                $("#ket_jarak").html('Prioritas');
                $("#ket_jarak").removeClass();
                $("#ket_jarak").addClass('label info');
            }
            else if (val >=7 ) {
                $("#ket_jarak").html('Prioritas Rendah');
                $("#ket_jarak").removeClass();
                $("#ket_jarak").addClass('label success');
            }
        });

        $("#harga").on("changed", function(e, val){
            $("#harga").val(val);
            if (val == 1) {
                $("#ket_harga").html('Murah');
                $("#ket_harga").removeClass();
                $("#ket_harga").addClass('label default');
            }
            else if (val == 2) {
                $("#ket_harga").html('Sedang');
                $("#ket_harga").removeClass();
                $("#ket_harga").addClass('label info');
            }
            else if (val ==3 ) {
                $("#ket_harga").html('Mahal');
                $("#ket_harga").removeClass();
                $("#ket_harga").addClass('label success');
            }
        });

        $('#sembunyi-foto').addClass('hide');
        $('#carousel-example-generic').addClass('hide'); 


        $('#tampil-foto').click(function(){
             $('#carousel-example-generic').removeClass('hide');
             $('#tampil-foto').addClass('hide');
             $('#sembunyi-foto').removeClass('hide'); 
        });

        $('#sembunyi-foto').click(function(){
             $('#carousel-example-generic').addClass('hide'); 
             $('#tampil-foto').removeClass('hide');
             $('#sembunyi-foto').addClass('hide'); 
        });

    })