<table class="bordered highlight">
	<tr class="deep-purple-text text-lighten-5 red darken-3"><td>No</td><td>Tahun</td><td>Formasi</td><td>Detail</td></tr>
	@foreach($formasi as $f)
	<tr>
		<td>{{$no++}}</td>
		<td>{{ $f->tahun}}</td>
		<td>{{$f->nama_pengadaan}}</td>
		<td><a href="javascript:void(0)" onclick="detail_formasi({{$f->id}})">Lihat pendaftar</a></td>
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
</script>
