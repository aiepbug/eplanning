<div id="info"></div>
<table class="responsive-table bordered highlight">
	<tr class="deep-purple-text text-lighten-5 red darken-3"><td>No</td><td>Email</td><td>Password</td><td>Nama</td>
		<td>Tgl Registrasi</td><td>Formasi</td><td>Detail</td>
	</tr>
	@foreach($registrasi as $r)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $r->username }}</td>
		<td>{{ $r->password }}</td>
		<td>@if($r->nama=='')--belum diisi--@else{{ $r->nama }}@endif</td>
		<td>@if($r->created_at!=''){{ strftime("%d %B %Y",strtotime($r->created_at)) }}@else --kosong--@endif</td>
		<td>@if($r->nama_formasi!=''){{ $r->nama_formasi }}@else --kosong--@endif</td>
		<td><a href="javascript:void(0)" onclick="cetak_detail_peserta('biodata','{{ $r->username }}')">Download biodata</a></td>
	</tr>
	@endforeach
</table>
<script>
function detail_formasi(id)
{
	var token="{{ csrf_token() }}"
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
	var token="{{ csrf_token() }}"
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
