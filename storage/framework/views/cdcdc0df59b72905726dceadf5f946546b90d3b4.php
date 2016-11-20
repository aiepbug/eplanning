<h4>Tambah akademik</h4>
<table>
	<tr>
		<td>Perguruan Tinggi</td>
		<td>:</td>
		<td>
			<input type="text" id="pt" />
		</td>
	</tr>
	<tr>
		<td>Kab./Kota</td>
		<td>:</td>
		<td><input type="text" id="kota" class="autocomplete"></td>
	</tr>
	<tr>
		<td>Tahun Masuk</td>
		<td>:</td>
		<td><input type="number" id="tahun_masuk"></td>
	</tr>
	<tr>
		<td>Tahun Selesai</td>
		<td>:</td>
		<td><input type="number" id="tahun_selesai"></td>
	</tr>
	<tr>
		<td width="20%">Jenjang</td>
		<td width="5%">:</td>
		<td>
			<input class="with-gap" name="jenjang" type="radio" id="s1" value="s1" checked />
			<label for="s1">S1</label>
			<input class="with-gap" name="jenjang" type="radio" id="s2" value="s2"/>
			<label for="s2">S2</label>
			<input class="with-gap" name="jenjang" type="radio" id="s3" value="s3"/>
			<label for="s3">S3</label>
		</td>
	</tr>
	<tr>
		<td>Prodi/Konsentrasi</td>
		<td>:</td>
		<td>
			<input type="text" id="prodi" />
		</td>
	</tr>
	<tr>
		<td>IPK</td>
		<td>:</td>
		<td>
			<input type="text" id="ipk" />
		</td>
	</tr>
</table>
<script>
function simpan_akademik()
{
	var jenjang=$('input[name="jenjang"]:checked').val();
	var token="<?php echo e(csrf_token()); ?>";
	var pt=$("#pt").val(),kota=$("#kota").val(),tahun_masuk=$("#tahun_masuk").val(),tahun_selesai=$("#tahun_selesai").val(),
		prodi=$("#prodi").val(),ipk=$("#ipk").val();
	if(pt==''){$('#pt').focus();Materialize.toast('Nama perguruan tinggi wajib diisi', 3000, 'rounded');$('html, body').animate({ scrollTop: 0 }, 'slow');return false;}
	else if(kota==''){$('#kota').focus();Materialize.toast('Kab./Kota wajib diisi', 3000, 'rounded');$('html, body').animate({ scrollTop: 0 }, 'slow');return false;}
	else if(tahun_masuk==''){$('#tahun_masuk').focus();Materialize.toast('Tahun masuk wajib diisi', 3000, 'rounded');$('html, body').animate({ scrollTop: 0 }, 'slow');return false;}
	else if(tahun_selesai==''){$('#tahun_selesai').focus();Materialize.toast('Tahun selesai wajib diisi', 3000, 'rounded');$('html, body').animate({ scrollTop: 0 }, 'slow');return false;}
	else if(prodi==''){$('#prodi').focus();Materialize.toast('Nama prodi wajib diisi', 3000, 'rounded');$('html, body').animate({ scrollTop: 0 }, 'slow');return false;}
	else if(ipk==''){$('#ipk').focus();Materialize.toast('IPK wajib diisi', 3000, 'rounded');$('html, body').animate({ scrollTop: 0 }, 'slow');return false;}
	$.ajax({
				url      : "update_akademik",
				data     : ({ _token:token,pt:pt,kota:kota,tahun_masuk:tahun_masuk,tahun_selesai:tahun_selesai
								,prodi:prodi,ipk:ipk,jenjang:jenjang}),
				type     : 'post',
				dataType : 'html',
				success  : function(respon){
					
						$('#modal_akademik').closeModal();
        				$('html, body').animate({ scrollTop: 0 }, 'slow');	
						$('#konten').html(respon);
						},
			})
		
}
$('input.autocomplete').autocomplete({
    data: {
      <?php foreach($kab as $k): ?>
      "<?php echo e($k->nama_kab); ?>":null,
      <?php endforeach; ?>
    }
  });
</script>
