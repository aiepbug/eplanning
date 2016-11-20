<div class="container">
<!--
	<?php echo QrCode::generate("Make me a QrCode with special symbols"); ?>

-->
<!--
	<img src="data:<?php echo e($_SERVER['DOCUMENT_ROOT']); ?>rekrutmen/public/download/<?php echo e(DNS1D::getBarcodePNG('4', 'C39+')); ?>"/>
-->
<!--
<?php echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T"); ?>

-->
	<h2> </h2>
	<a class="btn" href="javascript:void(0)" onclick="cetak2('registrasi')">Cetak bukti registrasi</a>
	<div id="info"></div>
	<p>
		<div class="row">
			<div class="col s2">
				Nomor registrasi
			</div>
			<div class="col s10">
				: 4516<?php echo e(str_pad($formasi->id_formasi_detail,2,'0', STR_PAD_LEFT)); ?><?php echo e(str_pad($user->id,3,'0', STR_PAD_LEFT)); ?>

			</div>
		</div>
		<div class="row">
			<div class="col s2">
				Nama
			</div>
			<div class="col s10">
				: <?php echo e($bio->nama); ?>

			</div>
		</div>
		<div class="row">
			<div class="col s2">
				Alamat
			</div>
			<div class="col s10">
				: <?php echo e($bio->alamat); ?>

			</div>
		</div>
		<div class="row">
			<div class="col s2">
				Mendaftar formasi
			</div>
			<div class="col s10">
				: <?php echo e($formasi->nama_formasi); ?>

			</div>
		</div>
	</p>
</div>
<script>
var menu="<?php echo e(session()->get('menu')); ?>";
$("li").removeClass("active");
$("#"+menu).addClass("active");
$("title").html("Pendaftar &rarr; "+menu);

function cetak(param)
{
	var _token="<?php echo e(csrf_token()); ?>";
	window.open('download/'+_token+'/'+param,'','width=800,height=600');
}
function cetak2(param)
{
	$('#info').html('');
	var token="<?php echo e(csrf_token()); ?>";
	$.ajax({
		url      : "cetak2",
		data     : ({ _token:token,param:param }),
		type     : 'POST',
		dataType : 'html',
		success  : function(respon){
				if(param=="registrasi")
				{
					$('#info').html('Sukses, download registrasi <a class="garis" target="_blank" href="../download/'+respon+'.pdf" download="registrasi">klik disini</a>');
				}
				else
				{
					return false;
				}
					
			},
	})
}
</script>
