<style>
.tengah{text-align:center;}
.kanan	{text-align:right;}
.kiri	{text-align:left;}
.kecil	{font-size:0.8em;}
.mini	{font-size:0.6em;}
.fkiri	{float:left;}
.atas10	{margin-top:10px;}
.atas10	{margin-bottom:10px;}
body	{font-size:0.9em;}
kabur	{color:#D0D0D0;}
.kotak {
    width: 40px;
    border: 0.5px solid black;
    padding: 25px 25px 25px;
    margin: 25px;
}
</style>
<?php 
	setlocale(LC_ALL, 'id_ID', 'Indonesian_indonesia', 'Indonesian');
	$no=1;
	use App\Mst_kegiatan_rincian;

?>
<div class="kanan"><img src="data:../download;base64, {{ DNS1D::getBarcodePNG('$tahun.$unit','C39+') }}"/>
</div>
<h2 class="tengah">PERENCANAAN <br>IAIN PALU TAHUN 2016</h2>
<table border="0">
<tr><td width="20%">Tahun Anggaran</td><td>: {{ $tahun }}</td></tr>
<tr><td>Satuan Kerja</td><td>: Institut Agama Islam Negeri (IAIN) Palu</td></tr>
<tr><td>Unit Kerja</td><td>: {{ $unit->nama_unit }}</td></tr>
</table>
<table border="1">
	<tr class="tengah"><th width="5%">No</th><th width="70%">Nama Kegiatan / Rincian</th><th width="25%">Jumlah</th></tr>
@foreach($data as $k)
	<tr>
	<?php 
			$rincian=Mst_kegiatan_rincian::select(
			'mst_kegiatan_rincian.*',
			't1.nama_satuan as ns1',
			't2.nama_satuan as ns2',
			't3.nama_satuan as ns3'
			)->
			leftJoin('tbl_satuan as t1','mst_kegiatan_rincian.satuan1','=','t1.id')->
			leftJoin('tbl_satuan as t2','mst_kegiatan_rincian.satuan2','=','t2.id')->
			leftJoin('tbl_satuan as t3','mst_kegiatan_rincian.satuan3','=','t3.id')->
			where('id_kegiatan',$k->id)->get(); 
			$tot=0;
	?>	
		<td class="tengah">{{ $no++ }}</td>
		<td>
			<strong>{{ $k->nama_kegiatan }}</strong>
			<ol>
				{{--*/ $totalss =0 /*--}}
				@foreach($rincian as $r)
					<li>
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
		</td>
		<td class="kanan">{{number_format($totalss)}}</td>
	</tr>
	{{--*/ $tot +=$totalss /*--}}
@endforeach
<tr class="kanan"><td colspan="2">Total</td><td>{{ number_format($tot) }}</td></tr>
</table>
