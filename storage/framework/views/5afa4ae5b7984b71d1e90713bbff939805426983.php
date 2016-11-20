<style>
.tengah{text-align:center;}
.kanan	{text-align:right;}
.kiri	{text-align:left;}
.kecil	{font-size:0.8em;}
.mini	{font-size:0.6em;}
.fkiri	{float:left;}
.atas10	{margin-top:10px;}
.atas10	{margin-bottom:10px;}
body	{font-size:0.9em;}
kabur	{color:#D0D0D0;}
.kotak {
    width: 40px;
    border: 0.5px solid black;
    padding: 25px 25px 25px;
    margin: 25px;
}
</style>
<?php 
	setlocale(LC_ALL, 'id_ID', 'Indonesian_indonesia', 'Indonesian');
	$reg='4516'.str_pad($formasi->id_formasi_detail,2,'0', STR_PAD_LEFT).str_pad($user->id,3,'0', STR_PAD_LEFT); 
	$no=1;
?>
<div class="kanan"><img src="data:../download;base64, <?php echo e(DNS1D::getBarcodePNG('$reg','C39+')); ?>"/>
<div><?php echo e($reg); ?></div>
</div>
<h2 class="tengah">PENERIMAAN DOSEN TETAP BUKAN PNS <br>IAIN PALU TAHUN 2016</h2>
<table border="0">
	<tr><td width="25%"></td><td width="55%"></td><td width="20%" rowspan="7">
				<table border="1">
					<tr>
						<td class="tengah"><br><br><br><br>Foto<br><br><br><br></td>
					</tr>
				</table>
	</td></tr>
	<tr><td>No. Registrasi</td><td>: <?php echo e($reg); ?></td></tr>
	<tr><td>No. Identitas KTP</td><td>: <?php echo e($bio->nik); ?></td></tr>
	<tr><td>Nama</td><td>: <?php echo e($bio->nama); ?></td></tr>
	<tr><td>Tempat/Tanggal lahir</td><td>: <?php echo e($bio->tempat_lahir); ?> / <?php echo e(date("d-m-Y",strtotime($bio->tanggal_lahir))); ?></td></tr>
	<tr><td>Jenis kelamin</td><td>: <?php if($bio->jender=='L'): ?> Pria <?php elseif($bio->jender=='P'): ?> Wanita <?php endif; ?></td></tr>
	<tr><td>Alamat</td><td>: <?php echo e($bio->alamat); ?></td></tr>
	<tr><td>No. HP</td><td>: <?php echo e($bio->hp); ?></td><td></td></tr>
	<tr><td>Formasi dilamar</td><td>: <?php echo e($formasi->nama_formasi); ?></td><td></td></tr>
	<tr><td>Kualifikasi akademik</td><td colspan="2">: 
		<table width="100%" class="" border="1">
			<tr class="tengah"><td width="10%">No</td><td width="15%">Jenjang</td><td width="40%">Prodi/Konsetrasi</td><td width="35%">Perguruan Tinggi</td></tr>
			<?php foreach($akademik as $a): ?>
			<tr class="tengah"><td><?php echo e($no++); ?></td><td><?php echo e(strtoupper($a->jenjang)); ?></td><td class="kiri"><?php echo e($a->prodi); ?></td><td class="kiri"><?php echo e($a->pt); ?></td></tr>
			<?php endforeach; ?>
		</table>
	</td></tr>
	<tr><td>Lokasi ujian</td><td>: IAIN Palu</td><td></td></tr>
</table>
<br><br><br>
<table>
<tr>
	<td width="60%" class="justi"></td><td width="10%"></td><td width="30%">............, <?php echo e(strftime("%d %B %Y")); ?></td></tr>
<tr><td>Dengan menandatangani form ini, maka saya menyatakan data yang saya isi adalah benar adanya
	dan bila ternyata isian yang dibuat tidak benar, saya bersedia menanggung akibat hukum yagn ditimbulkannya.</td><td></td><td></td></tr>
<tr><td></td><td></td><td><?php echo e($bio->nama); ?><br>(TANDA TANGAN) *</td></tr>
</table>
<br><br><br>
<p class="kecil">
* Form ini ditanda tangani, kemudian dikirim bersama berkas lainnya berupa :
		<ol>
			<li>Lamaran ditujukan ke Rektor IAIN Palu ditulis tangan</li>
			<li>Fotokopi sah ijazah dan transkrip nilai yang dilegalisasi</li>
			<li>Pasfoto berwarna ukuran 3x4 sebanyak dua lembar</li>
			<li>Fotokopi KTP yang masih berlaku</li>
		</ol>
</p>
