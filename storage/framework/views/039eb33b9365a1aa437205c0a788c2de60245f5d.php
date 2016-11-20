<h2>Melamar untuk formasi</h2>
<p>
<h4>Formasi dipilih:
<?php if(!empty($formasi_terpilih)): ?>
<?php echo e($formasi_terpilih->nama_formasi); ?>

<input id="status_formasi" type="hidden" value="1">
<?php else: ?>
<span class="red-text text-darken-4">
	Belum ada formasi dipilih
</span>
<input id="status_formasi" type="hidden" value="0">

<?php endif; ?>
</h4>
<table class="bordered responsive-table sembunyi">
	<tr><th>No</th><th>Formasi</th><th>Pilih</th></tr>
	<?php $no=1; ?>
	<?php foreach($formasi as $f): ?>
	<tr>
		<td><?php echo e($no++); ?></td>
		<td><?php echo e($f->nama_pengadaan); ?></td>
		<td><a onclick="detail_formasi(<?php echo e($f->id); ?>)" data-target="modal1" class="btn modal-trigger" href="javascript:void(0)">Pilih</a></td>
	</tr>
	<?php endforeach; ?>
</table>

<div class="row">
			<div class="right input-field col s12">
				<a href="javascript:void(0)" class="sembunyi right btn waves-effect waves-light" onclick="finalisasi()">Finalisasi
					<i class="material-icons right">send</i>
				  </a>
			</div>		
		</div>
</p>

<div id="modal_detail_formasi" class="modal">
	<div class="modal-content">
		<p id="isimodal"></p>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
	</div>
</div>
<div id="finalisasi" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Finalisasi data pelamar</h4>
      <p>
		Dengan menekan tombol setuju maka bersedia untuk mematuhi segala peraturan rekrutmen pada IAIN Palu,
		data akan disimpan permanen dan tidak dapat lagi diubah, 
		pastikan kembali data yang diisi sudah sesuai dengan aslinya, jika kurang yakin tekan tombol 
		<a href="javascript:void(0)" class="modal-action modal-close " onclick="menu_biodata()">TINJAU KEMBALI</a>
		untuk melihat dan memperbaiki data,
		kesalahan pengisian data dapat mengakibatkan pelamar tidak lolos administrasi,
		pemalsuan data akan berakibat pelamar tidak lolos administrasi dan akan dilaporkan ke pihak berwajib.
      </p>
      <p>
		Setelah data difinalisasi silahkan mencetak bukti registrasi, bukti registrasi dilampirkan bersama 
		berkas yang dikirim ke panitia. 
      </p>
    </div>
    <div class="modal-footer">
      <a href="#!" onclick="menu_biodata()" class="modal-action modal-close waves-effect waves-green btn-flat ">Tinjau kembali</a>
      <a href="#!" onclick="simpan_formasi()" class="waves-effect waves-green btn-flat ">Setuju</a>
    </div>
  </div>
          
<script>
function finalisasi()
{
	$('#finalisasi').openModal();
}
function detail_formasi(id)
{
	$('#modal_detail_formasi').openModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      starting_top: '4%', // Starting top style attribute
      ending_top: '10%', // Ending top style attribute
      ready: function() { 
				var token="<?php echo e(csrf_token()); ?>";
				$.ajax({
						url      : "detail_formasi",
						data     : ({ _token:token,id:id}),
						type     : 'post',
						dataType : 'html',
						success  : function(respon){
								$('#isimodal').html(respon);
								},
				})
		     }, 
      complete: function() { $('#isimodal').html(""); }
    });
}
$(document).ready(function() {
	
	var menu="<?php echo e(session()->get('menu')); ?>";
	$("li").removeClass("active");
	$("#"+menu).addClass("active");
	$("title").html("Pendaftar &rarr; "+menu);
	if(<?php echo e(session()->get("status")); ?>>0)
	{
		$(".sembunyi").hide();
	}
})
function menu_biodata()
{
var token="<?php echo e(csrf_token()); ?>";
	$.ajax({
			url      : "menu_biodata",
			data     : ({ _token:token}),
			type     : 'post',
			dataType : 'html',
			success  : function(respon){
					$('#konten').html(respon);
					},
	})
}
function simpan_formasi()
{
	if($("#status_formasi").val()=="0")
	{
		alert("Belum ada formasi yang dipilih, periksa lagi");
		$('#finalisasi').closeModal();
		return false;
	}
	
	var token="<?php echo e(csrf_token()); ?>";
	$.ajax({
			url      : "simpan_formasi",
			data     : ({ _token:token}),
			type     : 'post',
			dataType : 'html',
			success  : function(respon){
					$("#finalisasi").closeModal();
					$("#konten").html(respon);
					},
	})
}
</script>
