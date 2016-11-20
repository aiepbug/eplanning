<?php 
$no=1;
use App\Mst_kegiatan_rincian;
?>
<div id="konten">
	<div class="fixed-action-btn horizontal" style="bottom: 45px; right: 24px;">
		<a class="btn-floating btn-large red">
			<i class="large material-icons">print</i>
		</a>
		<ul>
			<li><a onclick="cetak('unit_tahun0',<?php echo e($unit->id); ?>)"class="btn blue darken-1">Perbandingan Tahun sebelumya</a></li>
			<li><a onclick="cetak('unit_tahun1',<?php echo e($unit->id); ?>)" class="btn red">Tahun ini</a></li>
		</ul>
	</div>
        

	<!--<a onclick="tambahKegiatan()" class="btn yellow darken-3 right" href="javascript:void(0)"><i class="tiny material-icons">add</i> Tambah kegiatan</a>-->
	<h5>Perencanaan <?php echo e($unit->nama_unit); ?> (<?php echo e($tahun); ?>)</h5> 
	<table class="bordered responsive-table">
		<tr><th>No</th><th>Nama Kegiatan / Rincian</th><th>Total</th></tr>
		<?php foreach($kegiatan as $k): ?>
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

			<td style="vertical-align: top;"><?php echo e($no++); ?></td>
			<td>
				<!--<a onclick="editKegiatan('<?php echo e($k->id); ?>')" href="javascript:void(0)"><i class="tiny material-icons">mode_edit</i></a>-->
				<strong><?php echo e($k->nama_kegiatan); ?></strong>
				<ol>
				<?php /**/ $totalss =0 /**/ ?>
				<?php foreach($rincian as $r): ?>
					<li>
						<!--<a onclick="editRincian('<?php echo e($r->id); ?>')" href="javascript:void(0)"><i class="tiny material-icons">mode_edit</i></a>--> 
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
				<!--<a onclick="tambahRincian(<?php echo e($k->id); ?>)" class="btn btn-floating" href="javascript:void(0)"><i class="tiny material-icons">add</i></a>-->
			</td>
			<td style="vertical-align: top;"><strong class="red-text text-red text-darken-4 "><?php echo e(number_format($totalss)); ?></strong></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<div id="modal1" class="modal modal-fixed-footer"></div>
</div>
<script>
var token="<?php echo e(csrf_token()); ?>"
function cetak(param,id)
{
	$.ajax({
	url      : "cetak",
	data     : ({ _token:token,param:param,id:id}),
	type     : 'post',
	dataType : 'html',
	success  : function(respon){
			$('html, body').animate({ scrollTop: 0 }, 'slow');
			$('#notification').html(respon);
			//~ $('#notification').delay(5000).html('');
			},
	})
}
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
