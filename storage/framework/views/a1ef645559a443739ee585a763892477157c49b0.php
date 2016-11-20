<div id="info"></div>
<table class="responsive-table bordered highlight">
	<tr class="deep-purple-text text-lighten-5 red darken-3"><td>No</td><td>Email</td><td>Password</td><td>Nama</td>
		<td>Tgl Registrasi</td><td>Formasi</td><td>Detail</td>
	</tr>
	<?php foreach($registrasi as $r): ?>
	<tr>
		<td><?php echo e($no++); ?></td>
		<td><?php echo e($r->username); ?></td>
		<td><?php echo e($r->password); ?></td>
		<td><?php if($r->nama==''): ?>--belum diisi--<?php else: ?><?php echo e($r->nama); ?><?php endif; ?></td>
		<td><?php if($r->created_at!=''): ?><?php echo e(strftime("%d %B %Y",strtotime($r->created_at))); ?><?php else: ?> --kosong--<?php endif; ?></td>
		<td><?php if($r->nama_formasi!=''): ?><?php echo e($r->nama_formasi); ?><?php else: ?> --kosong--<?php endif; ?></td>
		<td><a href="javascript:void(0)" onclick="cetak_detail_peserta('biodata','<?php echo e($r->username); ?>')">Download biodata</a></td>
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
