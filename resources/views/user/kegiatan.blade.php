<?php 
$no=1;
use App\Mst_kegiatan_rincian;
?>
<div id="konten">
	<a onclick="tambahKegiatan()" class="btn yellow darken-3 right" href="javascript:void(0)"><i class="tiny material-icons">add</i> Tambah kegiatan</a>
	<h4>Tahun anggaran {{ $tahun }}</h4> 
	<table class="bordered responsive-table">
		<tr><th>No</th><th>Nama Kegiatan / Rincian</th><th>Total</th></tr>
		@foreach($kegiatan as $k)
		<tr>
		<?php $rincian=Mst_kegiatan_rincian::select(
				'mst_kegiatan_rincian.*',
				't1.nama_satuan as ns1',
				't2.nama_satuan as ns2',
				't3.nama_satuan as ns3'
				)->
				leftJoin('tbl_satuan as t1','mst_kegiatan_rincian.satuan1','=','t1.id')->
				leftJoin('tbl_satuan as t2','mst_kegiatan_rincian.satuan2','=','t2.id')->
				leftJoin('tbl_satuan as t3','mst_kegiatan_rincian.satuan3','=','t3.id')->
				where('id_kegiatan',$k->id)->get(); 
		?>

			<td style="vertical-align: top;">{{ $no++ }}</td>
			<td>
				<a onclick="editKegiatan('{{ $k->id }}')" href="javascript:void(0)"><i class="tiny material-icons">mode_edit</i></a>
				<strong>{{ $k->nama_kegiatan }}</strong>
				<ol>
				{{--*/ $totalss =0 /*--}}
				@foreach($rincian as $r)
					<li><a onclick="editRincian('{{ $r->id }}')" href="javascript:void(0)"><i class="tiny material-icons">mode_edit</i></a> 
							{{ $r->rincian_kegiatan }} 
							@if($r->jumlah1 !=''){{ $r->jumlah1 }} {{  $r->ns1 }} x {{--*/ $total = $r->jumlah1 /*--}}@endif
							@if($r->jumlah2 !=''){{ $r->jumlah2 }} {{  $r->ns2 }} x {{--*/ $total = $r->jumlah1 * $r->jumlah2 /*--}}@endif
							@if($r->jumlah3 !=''){{ $r->jumlah3 }} {{  $r->ns3 }} x {{--*/ $total = $r->jumlah1 * $r->jumlah2 * $r->jumlah3 /*--}}@endif
							@if($r->harga !=''){{ number_format($r->harga) }}@endif
							= <strong>{{number_format($total * $r->harga)}}{{--*/ $totals = ($total * $r->harga) /*--}}</strong>
					</li>
					{{--*/ $totalss +=$totals /*--}}
				@endforeach
				</ol>
				<a onclick="tambahRincian({{$k->id}})" class="btn btn-floating" href="javascript:void(0)"><i class="tiny material-icons">add</i></a>
			</td>
			<td style="vertical-align: top;"><strong class="red-text text-red text-darken-4 ">{{number_format($totalss)}}</strong></td>
		</tr>
		@endforeach
	</table>
	<div id="modal1" class="modal modal-fixed-footer"></div>
</div>
<script>
var token="{{ csrf_token() }}"
function editRincian(id)
{
	$('#modal1').openModal();
	$.ajax({
		url		:"editRincian",
		data	:({ _token:token,id:id }),
		type	:"post",
		success : function(respon)
		{
				$("#modal1").html(respon)
		},
	});
}
function tambahRincian(id)
{
	$('#modal1').html('');
	$('#modal1').openModal();
	$.ajax({
		url		:"tambahRincian",
		data	:({ _token:token,id:id }),
		type	:"post",
		success : function(respon)
		{
				$("#modal1").html(respon)
		},
	});
}
function tambahKegiatan()
{
	$('#modal1').html('');
	$('#modal1').openModal();
	$.ajax({
		url		:"tambahKegiatan",
		data	:({ _token:token }),
		type	:"post",
		success : function(respon)
		{
				$("#modal1").html(respon)
		},
	})
}
function editKegiatan(id)
{
	$('#modal1').html('');
	$('#modal1').openModal();
	$.ajax({
		url		:"editKegiatan",
		data	:({ _token:token,id:id }),
		type	:"post",
		success : function(respon)
		{
				$("#modal1").html(respon)
		},
	})
}
</script>
