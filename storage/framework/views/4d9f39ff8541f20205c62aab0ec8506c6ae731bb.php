<div class="row">
	<form class="col s12" autocomplete="off">
		<h2>Akademik</h2>
		<div class="row">
			<div class="input-field col s12">
			<table class="bordered responsive-table">
				<tr><th>No</th><th>Jenjang</th><th>Tahun selesai</th><th>Prodi/Konsentrasi</th><th>IPK</th><th>Perguruan tinggi</th><th><i class="material-icons">toc</i></th></tr>
				<?php $no=1 ?>
				<?php foreach($akademik as $a): ?>
				<tr><td><?php echo e($no++); ?></td><td><?php echo e(strtoupper($a->jenjang)); ?></td><td><?php echo e($a->tahun_selesai); ?></td><td><?php echo e($a->prodi); ?></td><td><?php echo e($a->ipk); ?></td><td><?php echo e($a->pt); ?></td>
					<td><a href="javascript:void(0)" class="btn-flat sembunyi" onclick="hapus_akademik(<?php echo e($a->id); ?>)">Hapus</a></td></tr>
				
				<?php endforeach; ?>
			</table>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s6">
				<a href="javascript:void(0)" class=" btn waves-effect waves-light sembunyi" onclick="tambah_akademik()"><i class="material-icons left">add</i> Tambah pendidikan</a>
			</div>		
			<div class="right input-field col s6">
				<a href="javascript:void(0)" class="right btn waves-effect waves-light" onclick="lanjut()" id="simpan_biodata">Selanjutnya
					<i class="material-icons right">send</i>
				  </a>
			</div>		
		</div>
	</form>
</div>
<div id="modal_akademik" class="modal modal-fixed-footer">
	<div class="modal-content">
		<p id="isimodal"></p>
	</div>
	<div class="modal-footer">
		<a href="javascript:void(0)" onclick="simpan_akademik()" class="waves-effect waves-green btn-flat">Simpan</a>
	</div>
</div>
<script>
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
function lanjut()
{
	var menu="<?php echo e(session()->get('menu')); ?>";
	var mn="simpan_";
	var links=mn.concat(menu);
	var token="<?php echo e(csrf_token()); ?>";
	$.ajax({
			url      : links,
			data     : ({ _token:token}),
			type     : 'post',
			dataType : 'html',
			success  : function(respon){
					$('html, body').animate({ scrollTop: 0 }, 'slow');	
					$('#konten').html(respon);
					},
		})
}
function hapus_akademik(id)
{
	var token="<?php echo e(csrf_token()); ?>";
				$.ajax({
						url      : "hapus_akademik",
						data     : ({ _token:token,id:id}),
						type     : 'post',
						dataType : 'html',
						success  : function(respon){
								$('#konten').html(respon);
								},
				})
}
function tambah_akademik()
{
	$('#modal_akademik').openModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      starting_top: '4%', // Starting top style attribute
      ending_top: '10%', // Ending top style attribute
      ready: function() { 
				var token="<?php echo e(csrf_token()); ?>";
				$.ajax({
						url      : "tambah_akademik",
						data     : ({ _token:token}),
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
</script>
