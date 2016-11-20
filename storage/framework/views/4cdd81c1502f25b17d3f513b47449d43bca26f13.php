<div class="row">
	<form class="col s12" autocomplete="off">
		<h2>Biodata</h2>
		<div class="row">
			<div class="input-field col s2">
				<span class="green-text text-green-4">NIK</span>
			</div>
			<div class="input-field col s10">
				<input disabled id="nama" type="text"  value="<?php echo e($bio->nik); ?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col s2">
				<span class="green-text text-green-4">Nama</span>
			</div>
			<div class="input-field col s10">
				<input placeholder="Nama" id="nama" type="text"  value="<?php echo e($bio->nama); ?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col s2">
				<span class="green-text text-green-4">Tempat lahir</span>
			</div>
			<div class="input-field col s10">
				<input id="tempat_lahir" type="text" value="<?php echo e($bio->tempat_lahir); ?>">
			</div>	
		</div>
		<div class="row">
			<div class="input-field col s2">
				<span class="green-text text-green-4">Agama</span>
			</div>
			<div class="input-field col s10">
				<select id="agama" style="width:50%" class="browser-default">
				  <option <?php if($bio->agama==1): ?> selected <?php endif; ?> value="1">Islam</option>
				  <option <?php if($bio->agama==2): ?> selected <?php endif; ?> value="2">Protestan</option>
				  <option <?php if($bio->agama==3): ?> selected <?php endif; ?> value="3">Katholik</option>
				  <option <?php if($bio->agama==4): ?> selected <?php endif; ?> value="4">Hindu</option>
				  <option <?php if($bio->agama==5): ?> selected <?php endif; ?> value="5">Budha</option>
				</select>
			</div>	
		</div>
		<div class="row">
			<div class="input-field col s2">
				<span class="green-text text-green-4">Tanggal lahir</span>
			</div>
			<div class="input-field col s10">
				<input id="tanggal_lahir" type="text" class="datepicker">
			</div>
		</div>
		<div class="row">
			<div class="input-field col s2">
				<span class="green-text text-green-4">HP</span>
			</div>
			<div class="input-field col s10">
				<input class="validate" id="hp" type="text" value="<?php echo e($bio->hp); ?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col s2">
				<span class="green-text text-green-4">Jenis kelamin</span>
			</div>
			<div class="input-field col s10">
				<select id="jender" style="width:50%" class="browser-default">
				  <option <?php if($bio->jender=="L"): ?> selected <?php endif; ?> value="L">laki-laki</option>
				  <option <?php if($bio->jender=="P"): ?> selected <?php endif; ?> value="P">Perempuan</option>
				</select>
			</div>	
		</div>
		<div class="row">
			<div class="input-field col s2">
				<span class="green-text text-green-4">Alamat</span>
			</div>
			<div class="input-field col s10">
				<input class="validate"id="alamat" type="text" value="<?php echo e($bio->alamat); ?>">
			</div>			
		</div>
		<div class="row">
			<div class="right input-field col s12">
				<a href="javascript:void(0)" class="right btn waves-effect waves-light" onclick="lanjut()" id="simpan_biodata">Selanjutnya
					<i class="material-icons right">send</i>
				  </a>
			</div>		
		</div>
	</form>
</div>
<script>
	
$(document).ready(function() {
	$("#tanggal_lahir").pickadate
	({
		format: 'dd-mm-yyyy',
		selectMonths: true, 
		selectYears: 44,
		min: '31-12-1950',
		max: '31-12-1999'
	})
	<?php if($bio->tanggal_lahir!=""): ?>
	var date = new Date(<?php echo e(date_format(date_create($bio->tanggal_lahir),"Y,m-1,d")); ?>);
    var picker = $('#tanggal_lahir').pickadate('picker');
    picker.set('select', date);
	<?php endif; ?>
	
	var menu="<?php echo e(session()->get('menu')); ?>";
	$("li").removeClass("active");
	$("#"+menu).addClass("disabled active");
	$("title").html("Pendaftar &rarr; "+menu);
	
	if(<?php echo e(session()->get("status")); ?>>0)
	{
		$("input").prop('disabled',true);
		$("select").prop('disabled',true);
	}
	Materialize.updateTextFields();
});
	
function lanjut()
{
	var token="<?php echo e(csrf_token()); ?>";
	var nama=$('#nama').val(),tempat_lahir=$('#tempat_lahir').val(),agama=$('#agama').val(),
		tanggal_lahir=$('#tanggal_lahir').val(),jender=$('#jender').val(),hp=$('#hp').val(),
		alamat=$('#alamat').val();
	if(nama==''){$('#nama').focus();Materialize.toast('Nama wajib diisi', 3000, 'rounded');$('html, body').animate({ scrollTop: 0 }, 'slow');return false;}
	else if(tempat_lahir==''){$('#tempat_lahir').focus();Materialize.toast('Tempat lahir wajib diisi', 3000, 'rounded');$('html, body').animate({ scrollTop: 0 }, 'slow');return false;}
	else if(tanggal_lahir==''){$('#tanggal_lahir').focus();Materialize.toast('Tanggal lahir wajib diisi', 3000, 'rounded');return false;}
	else if(hp==''){$('#hp').focus();Materialize.toast('No. HP wajib diisi', 3000, 'rounded');return false;}
	else if(alamat==''){$('#alamat').focus();Materialize.toast('Alamat wajib diisi', 3000, 'rounded');return false;}
	$.ajax({
			url      : "simpan_biodata",
			data     : ({ _token:token,nama:nama,tempat_lahir:tempat_lahir,agama:agama,tanggal_lahir:tanggal_lahir
							,jender:jender,hp:hp,alamat:alamat}),
			type     : 'post',
			dataType : 'html',
			success  : function(respon){
					$('html, body').animate({ scrollTop: 0 }, 'slow');	
					$('#konten').html(respon);
					},
		})
}
</script>
