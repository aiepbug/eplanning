<h4><?php echo e($formasi->nama_pengadaan); ?></h4>
<?php if(!empty($detail)): ?>
	<table class="bordered responsible-table highlight">
	<tr><th>No</th><th>Nama formasi</th><th>Kuota</th><th>Persyaratan</th><th>Pilih</th></tr>
	<?php $no=1;?>
	<?php foreach($detail as $d): ?>
	<tr>
		<td><?php echo e($no++); ?></td>
		<td><?php echo e($d->nama_formasi); ?></td>
		<td class="center"><strong><?php echo e($d->jumlah); ?></strong></td>
		<td>
			<ul>
				<li>Usia : <?php echo e($d->usia); ?></li>
				<li>Kualifikasi : <?php echo e($d->kualifikasi_akademik); ?></li>
				<li>Ket : <?php echo e($d->keterangan); ?></li>
			</ul>
		</td>
		<td><a onclick="pilih_formasi('<?php echo e($d->id); ?>','<?php echo e($d->tahun); ?>')" class="btn modal-trigger" href="javascript:void(0)">Pilih</a></td>
	</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>
	<div class=" ">Tidak ada formasi yang bisa dipilih</div>
<?php endif; ?>
<script>
function pilih_formasi(id,tahun)
{
	var token="<?php echo e(csrf_token()); ?>";
	$.ajax({
			url      : "pilih_formasi",
			data     : ({ _token:token,id:id,tahun:tahun}),
			type     : 'post',
			dataType : 'html',
			success  : function(respon){
					$('#modal_detail_formasi').closeModal();
					$('html, body').animate({ scrollTop: 0 }, 'slow');	
					$('#konten').html(respon);
					},
		})
}
</script>
