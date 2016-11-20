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
<div class="kanan"><img src="data:../download;base64, <?php echo e(DNS1D::getBarcodePNG('$tahun.$unit','C39+')); ?>"/>
</div>
<h2 class="tengah">PERENCANAAN <br>IAIN PALU TAHUN 2016</h2>
<table border="0">
<tr><td width="20%">Tahun Anggaran</td><td>: <?php echo e($tahun); ?></td></tr>
<tr><td>Satuan Kerja</td><td>: Institut Agama Islam Negeri (IAIN) Palu</td></tr>
<tr><td>Unit Kerja</td><td>: <?php echo e($unit->nama_unit); ?></td></tr>
</table>
<table border="1">
	<tr class="tengah"><th width="5%">No</th><th width="70%">Nama Kegiatan / Rincian</th><th width="25%">Jumlah</th></tr>
<?php foreach($data as $k): ?>
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
		<td class="tengah"><?php echo e($no++); ?></td>
		<td>
			<strong><?php echo e($k->nama_kegiatan); ?></strong>
			<ol>
				<?php /**/ $totalss =0 /**/ ?>
				<?php foreach($rincian as $r): ?>
					<li>
							<?php echo e($r->rincian_kegiatan); ?> 
							<?php if($r->jumlah1 !=''): ?><?php echo e($r->jumlah1); ?> <?php echo e($r->ns1); ?> x <?php /**/ $total = $r->jumlah1 /**/ ?><?php endif; ?>
							<?php if($r->jumlah2 !=''): ?><?php echo e($r->jumlah2); ?> <?php echo e($r->ns2); ?> x <?php /**/ $total = $r->jumlah1 * $r->jumlah2 /**/ ?><?php endif; ?>
							<?php if($r->jumlah3 !=''): ?><?php echo e($r->jumlah3); ?> <?php echo e($r->ns3); ?> x <?php /**/ $total = $r->jumlah1 * $r->jumlah2 * $r->jumlah3 /**/ ?><?php endif; ?>
							<?php if($r->harga !=''): ?><?php echo e(number_format($r->harga)); ?><?php endif; ?>
							= <strong><?php echo e(number_format($total * $r->harga)); ?><?php /**/ $totals = ($total * $r->harga) /**/ ?></strong>
					</li>
					<?php /**/ $totalss +=$totals /**/ ?>
				<?php endforeach; ?>
			</ol>
		</td>
		<td class="kanan"><?php echo e(number_format($totalss)); ?></td>
	</tr>
	<?php /**/ $tot +=$totalss /**/ ?>
<?php endforeach; ?>
<tr class="kanan"><td colspan="2">Total</td><td><?php echo e(number_format($tot)); ?></td></tr>
</table>
