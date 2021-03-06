<div id="info"></div>
<table class="bordered highlight">
	<tr class="deep-purple-text text-lighten-5 red darken-3"><td>No</td><td>Tahun</td><td>Detail Formasi</td><td>Detail</td></tr>
	<?php foreach($detail as $d): ?>
	<tr>
		<td><?php echo e($no++); ?></td>
		<td><?php echo e($d->nama); ?></td>
		<td><?php echo e($d->nama_formasi); ?></td>
		<td><a href="javascript:void(0)" onclick="cetak_detail_peserta('biodata','<?php echo e($d->username); ?>')">Download biodata</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<script>
function detail_formasi(id)
{
	var token="<?php echo e(csrf_token()); ?>"
	$.ajax({
	url      : "detail_formasi",
	data     : ({ _token:token,id:id}),
	type     : 'post',
	dataType : 'html',
	success  : function(respon){
			$('html, body').animate({ scrollTop: 0 }, 'slow');	
			$('#konten').html(respon);
			return false;
			},
	})
}
function cetak_detail_peserta(param,username)
{
	$('#info').html('');
	var token="<?php echo e(csrf_token()); ?>"
	$.ajax({
	url      : "cetak_detail_peserta",
	data     : ({ _token:token,username:username,param:param}),
	type     : 'post',
	dataType : 'html',
	success  : function(respon){
			$('html, body').animate({ scrollTop: 0 }, 'slow');	
			$('#info').html(respon);
			return false;
			},
	})
}
</script>
