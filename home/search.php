<style>
	.table, .table td, .table th{
		border:0px solid #DDD;
		border-collapse : collapse;
	}
	
	.table td, .table th{
		padding:5px;
		text-align:justify;
	}
	
	.span {
		background: none repeat scroll 0 0 #56a8e4;
		border-color: #999999 #4496D2 #EBEBEB;
		border-style: dotted solid solid;
		border-width: 0 1px 5px;
		color: #FFFFFF;
		height: 27px;
		padding:3px;
		margin-left:10px;
	}
</style>

<div class='l-content-wrap' style='font-family:Trebuchet MS;'>
	<table class='testable table' id='examples' style='width:100%;padding:3px;'>
		<thead>
			<tr>
				
			</tr>
		</thead>
		<tbody>
			<?php

				//form untuk pemrosesan pencarian
				
				require 'koneksi.php';
				
				if((isset($_POST['cari'])) && ($_POST['keywords'] !=""))
				{
					$search = htmlentities(addslashes($_POST['keywords']));
					//melakukan SELECT query dengan operator LIKE,hasil disimpan di $sql
					$sql = mysql_query("SELECT * FROM berita WHERE judul LIKE '%$search%'");
					//menampilkan jumlah hasil pencarian
					$jumlah = mysql_num_rows($sql);
					if ($jumlah > 0){
						echo "<div class='span' style='margin-top:10px; margin-right:10px; background: grey ' !important;> Ada $jumlah informasi yang sesuai dengan kata kunci $search</div>";
						while ($hasil = mysql_fetch_array($sql)){
							$is= "";
							$is = explode(" ",$hasil['isi']);
							$fa = "";
							
							if(count($is) >= 50){
								for($i=0;$i<50;$i++){
									$fa .= $is[$i]." ";
								}
							}else{
								$fa = implode(" ",$is);
							}
							
							if(count($is) >= 45){
								$g = mysql_query("SELECT * FROM user WHERE id_user = '$hasil[id_user]'");
								$l = mysql_fetch_array($g);
								echo "	
									<tr><td>
										<!-- standard post -->
										<div class='m-page-title'>
										  <h1> $hasil[judul] </h1>
										</div><!-- m-page-title -->
										<div class='row l-user-profile'>
											<div class='col-lg-3 col-md-3 col-sm-3 user-avatar'>
												<img src='component/gambar/$hasil[gambar]' width='121px' height='122'/>
											</div>
											<div class='col-lg-9 col-md-9 col-sm-9 user-info'>
											<h2></h2>
											<span>$hasil[tanggal], Oleh : $l[nama]</span>
											<p class='font'>$fa .... 
												<a href='home.php?menu=detail_berita&id=$hasil[id_berita]' >
													<i>read more</i>
												</a>
											</p>
											</div><!-- col-lg-9 -->
										</div> <!-- row 1-user-profile-->
											<div style=\"margin-top:40px !important\"></div>
											
									</td></tr>";	
							}else{
								$g = mysql_query("SELECT * FROM user WHERE id_user = '$hasil[id_user]'");
								$l = mysql_fetch_array($g);
								echo "	
									<tr><td>
											<p><img src='../component/gambar/$hasil[gambar]' width='121px' height='122'/></p>
											<p>$hasil[judul]</p>
											<div style=\"margin-top:5px !important\"></div>
											<p><i>$hasil[tanggal]</i> Oleh <i>$l[nama]</i></p>
											<div style=\"margin-top:15px !important\"></div>
											<p class='font'>
												$hasil[isi]
											</p>
											<p align='right'>
												<a href='home.php?menu=detail_berita&id=$hasil[id_berita]'>Komentar</a>
											</p>
											<div style=\"margin-top:70px !important\"></div>
											
									</td></tr>";	
							}
							$i++;
						}
					}else{
						// menampilkan pesan zero data
						echo "<div class=\"span\">Maaf, hasil pencarian tidak ditemukan</div>";
					}

				}else{ 
					echo "<div class=\"span\">Anda belum memasukkan kata kunci!</div>";
				}
			?>
		</tbody>
	</table>
</div>