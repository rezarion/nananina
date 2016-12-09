<?php
	if(ISSET($_SESSION['success'])){
		echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
		unset($_SESSION['success']);
	}else if(ISSET($_SESSION['error'])){
		echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
		unset($_SESSION['error']);
	}
?>
	
<div class="widget">	
	<h4 class="widgettitle">Form Data Titik Rekomendasi</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_input_titik.php" method="post" enctype="multipart/form-data">		
						
			<p>
				<label>Nama Titik</label>
				<span class="field"><input type="text" id="nama_titik" name="nama_titik" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" placeholder="masukkan nama titik" required/></span>
			</p>	
			<p>
				<label>Keberadaan Sarana/label>
				<span class="field"><input type="text" onkeypress="return numbersonly(event, false)" id="val_keberadaan" name="keberadaan" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" placeholder="masukkan keberadaan sarana" required/></span>
			</p>
			<p>
				<label>Kepadatan Penduduk</label>
				<span class="field"><input type="text" onkeypress="return numbersonly(event, false)" id="val_kepadatan" name="kepadatan" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" placeholder="masukkan kepadatan pendududuk" required/></span>
			</p>
			<p>
				<label>Perkembangan Pemukiman/label>
				<span class="field"><input type="text" onkeypress="return numbersonly(event, false)" id="val_perkembangan" name="perkembangan" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" placeholder="masukkan perkembangan pemukiman" required/></span>
			</p>
			<p>
				<label>Potensi Ekonomi</label>
				<span class="field"><input type="text" id="val_potensi" name="potensi" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" placeholder="masukkan potensi ekonomi" required/></span>
			</p>
			<p>
				<label>Arus Lalu Lintas</label>
				<span class="field"><input type="text" id="val_arus" name="arus" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" placeholder="masukkan arus lalu lintas" required/></span>
			</p>
			<p>
				<label>Koordinat</label>
				<span class="field">
					<input type="text" id="lat" name="lat" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" placeholder="masukkan latitude" required/>
					<input type="text" id="lng" name="lng" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" placeholder="masukkan langitude" required/>
				</span>
			</p>
			
			<p class="stdformbutton">
                <button type="submit" class="btn btn-primary" name="input" style='margin-left:-9% !important'><a href="" style="text-decoration=:none; color:white;"></span>Submit</a></button>
                <button type="reset" class="btn" >Reset</button>
            </p>
		</form>
	</div>
</div>