<div class="modal-content">	
	<?php if(isset($kegiatan)): ?>
		<a href="#!" title="Hapus kegiatan" onclick="hapus_kegiatan('<?php echo e($kegiatan->id); ?>')" class="btn-floating btn-small waves-effect waves-light red right"><i class="material-icons">delete</i></a>
	<?php endif; ?>

	<h4>Tambah kegiatan tahun <?php echo e(session()->get('tahun')); ?></h4>
	<input type="text" placeholder="Nama kegiatan" id="kegiatan" value="<?php echo e(isset($kegiatan->nama_kegiatan) ? $kegiatan->nama_kegiatan : ''); ?>">
</div>
<div class="modal-footer">
	<?php if(isset($kegiatan)): ?>
		<a href="#!" onclick="simpan_rincian('update','<?php echo e($kegiatan->id); ?>')" class="modal-action modal-close waves-effect waves-green btn-flat ">Update</a>
	<?php else: ?>
		<a href="#!" onclick="simpan_rincian('simpan','0')" class="modal-action modal-close waves-effect waves-green btn-flat ">Simpan</a>
	<?php endif; ?>
</div>
<script>
var token="<?php echo e(csrf_token()); ?>"
function simpan_rincian(param,id)
{
	var kegiatan=$("#kegiatan").val()
	if(kegiatan==''){$("#kegiatan").focus();Materialize.toast('Belum terisi', 2000);return false;}	
	$.ajax({
		url		:"simpan_kegiatan",
		data	:({ _token:token,kegiatan:kegiatan,param:param,id:id }),
		type	:"post",
		success : function(respon)
		{
				 $('#modal1').closeModal();
				 $('#konten').html(respon);
		},
	});
}
function hapus_kegiatan(id)
{
	alert('akan menghapus kegiatan dan semua rinciannya?')
	$.ajax({
		url		:"hapus_kegiatan",
		data	:({ _token:token,id:id}),
		type	:"post",
		success : function(respon)
		{
				 $('#modal1').closeModal();
				 $('#konten').html(respon);
		},
	});
}
</script>
