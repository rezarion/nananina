<style>
	table a:link {
	color: #666;
	font-weight: bold;
	text-decoration:none;
	}
	table a:visited {
		color: #999999;
		font-weight:bold;
		text-decoration:none;
	}
	table a:active,
	table a:hover {
		color: #bd5a35;
		text-decoration:underline;
	}
	table {
		color:#666;
		font:17px;
		text-shadow: 1px 1px 0px #fff;
		background:#eaebec;
		margin-top:2px;
		margin-left:15px;
		border:#ccc 1px solid;

		-moz-border-radius:3px;
		-webkit-border-radius:3px;
		border-radius:3px;

		-moz-box-shadow: 0 1px 2px #d1d1d1;
		-webkit-box-shadow: 0 1px 2px #d1d1d1;
		box-shadow: 0 1px 2px #d1d1d1;
	}
	table th {
		padding:5px 10px 5px 5px;
		border-top:1px solid #fafafa;
		border-bottom:1px solid #e0e0e0;
		color:#fff;
		text-align: center;
		background: #56a8e4;
		background: -webkit-gradient(linear, left top, left bottom, from(##56a8e4), to(##56a8e4));
		background: -moz-linear-gradient(top,  #56a8e4,  #56a8e4);
	}
	table th:first-child {
		text-align: center;
		padding-left:20px;
	}
	table tr:first-child th:first-child {
		-moz-border-radius-topleft:3px;
		-webkit-border-top-left-radius:3px;
		border-top-left-radius:3px;
	}
	table tr:first-child th:last-child {
		-moz-border-radius-topright:3px;
		-webkit-border-top-right-radius:3px;
		border-top-right-radius:3px;
	}
	table tr {
		text-align: center;
		padding-left:20px;
	}
	table td:first-child {
		text-align: left;
		padding-left:20px;
		border-left: 0;
		font-weight:bold;
	}
	table td {
		padding:10px;
		border-top: 1px solid #ffffff;
		border-bottom:1px solid #e0e0e0;
		border-left: 1px solid #e0e0e0;
		text-align: left;
		background: #f1f4f9;
		background: -webkit-gradient(linear, left top, left bottom, from(#f1f4f9), to(#f1f4f9));
		background: -moz-linear-gradient(top,  #f1f4f9,  #f1f4f9);
	}
	table tr.even td {
		background: #f1f4f9;
		background: -webkit-gradient(linear, left top, left bottom, from(#f1f4f9), to(#f1f4f9));
		background: -moz-linear-gradient(top,  #f1f4f9,  #f1f4f9);
	}
	table tr:last-child td {
		border-bottom:0;
	}
	table tr:last-child td:first-child {
		-moz-border-radius-bottomleft:3px;
		-webkit-border-bottom-left-radius:3px;
		border-bottom-left-radius:3px;
	}
	table tr:last-child td:last-child {
		-moz-border-radius-bottomright:3px;
		-webkit-border-bottom-right-radius:3px;
		border-bottom-right-radius:3px;
	}
	table tr:hover td {
		background: #fff;
		background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#fff));
		background: -moz-linear-gradient(top,  #fff,  #fff);	
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

<div class='services' style='font-family:Trebuchet MS; margin:55px 55px 55px 50px;width:70%'>
	<div class='span'>Detail Pimpinan</div>
	<div style='margin-top:10px;'></div>
	<div style='width:150px;  height:180px; border:1px solid #4496d2; float:left; margin-left:10px; !important'>
	<?php
		$s = mysql_query("SELECT * FROM pegawai WHERE id_pegawai='$_GET[id]'");
		while ($p = mysql_fetch_array($s)){
			echo "<img src = 'component/foto/$p[foto]'  style='margin:0px 0 0 0px; width:160px; height:175px;'/>";
			echo"<div class='clr'><br/></div>";
		}
		
	?>
	
	</div>
	<div  style='float:right;  width:550px; margin-right:15px;!important'>
		<table>
			<tbody>
				<?php
					include "koneksi.php";
					$s = mysql_query("SELECT * FROM pegawai WHERE id_pegawai='$_GET[id]'");
					while ($p = mysql_fetch_array($s)){
						echo "
							<tr>
								<td width='30%'> Nama </td>
								<td>$p[nama_pegawai]</td>
							</tr>
							<tr>
								<td> NIP </td>
								<td>$p[id_pegawai]</td>
							</tr>
							<tr>
								<td> Tempat lahir </td>
								<td>$p[tempat_lahir]</td>
							</tr>
							<tr>
								<td> Tanggal Lahir </td>
								<td>$p[tanggal_lahir]</td>
							</tr>
							
						";
					}
				?>
			</tbody>
		</table>
	</div>
</div>